
import FaiModule from '../FaiModule.js';
export default class ViewWebsiteProcessing extends FaiModule {
    constructor() {
        super();
    }

    async view_website(page, content_template = { html: "", css: "", js: "" }) {
        try {
            await this._loadDatabaseConfigs(page);

            const validatedTemplate = await this._validateContentTemplate(content_template);
            const processedContent = await this._processContentList(page, validatedTemplate);

            return await this._formatFinalResult(processedContent);
        } catch (error) {
            console.error('Error in view_website:', error);
            return this._createErrorResponse(error.message);
        }
    }

    async _loadDatabaseConfigs(page) {
        if (!page.view.config?.database) return;

        const entries = Object.entries(page.view.config.database);

        for (const [key, value] of entries) {
            const storeName = `config_database-${page.view.load.apps}-${page.view.load.page_view}-${key}`;
            const search = {
                tipe: 'config_database',
                apps: page.view.load.apps,
                page_view: page.view.load.page_view,
                key: key,
                live: 1
            };

            if (!page.row_section) {
                page.row_section = [];
            }


            page.row_section[key] = await this.getModule('Data').getApiData(storeName, search);
        }
    }

    _validateContentTemplate(content_template) {
        return (typeof content_template === 'object' && content_template !== null)
            ? content_template
            : { html: "", css: "", js: "" };
    }

    async _processContentList(page, content_template) {
        const contentList = page.website.content;
        const keys = Object.keys(contentList);

        for (const key of keys) {
            const contentItem = contentList[key];
            const processedContent = await this._processContentItem(page, contentItem);

            await this._handleTemplateArrays(page, contentItem, processedContent);

            await this._appendToTemplate(content_template, processedContent, contentItem);
        }

        return content_template;
    }

    async _processContentItem(page, contentItem) {
        const tempFirst = { ...contentItem };
        const keyArray = contentItem.tag || "";
        let content = { html: "", css: "", js: "" };

        const result = await this.getModule("Bundle").router(page, 'array', tempFirst);

        if (result.includes(keyArray)) {
            content = await this.getModule("Bundle").router(page, 'content', contentItem, keyArray);
        }

        if (contentItem.content_source) {
            content = await this.getModule("Partial").content_source(page, contentItem);
        }

        return await this._wrapContentWithContainer(content, contentItem);
    }

    async _wrapContentWithContainer(content, contentItem) {
        let wrappedContent = { ...content };

        if (contentItem.row) {
            wrappedContent.html = `<div class="${contentItem.row}">${content.html}</div>`;
        } else if (contentItem.col_row) {
            wrappedContent.html = `<div class="${contentItem.col_row}">${content.html}</div>`;
        } else {
            wrappedContent.html = `<div class="col-md-12">${content.html}</div>`;
        }

        return wrappedContent;
    }

    async _handleTemplateArrays(page, contentItem, content) {
        if (!Array.isArray(contentItem.template_array)) return;

        for (let j = 0; j < contentItem.template_array.length; j++) {
            const arrayItem = { ...contentItem.template_array[j] };
            await this._processTemplateArrayItem(page, arrayItem, content, j);
        }
    }

    async _processTemplateArrayItem(page, arrayItem, content, index) {
        this._validateArrayItem(arrayItem);

        const resultTag = this.getModule("Bundle").router(page, 'array', arrayItem);

        if (this._isPredefinedTag(resultTag, arrayItem.tag)) {
            await this.getModule("Bundle").router(page, 'content', arrayItem, arrayItem.tag);
        } else {
            await this._handleCustomArrayItem(page, arrayItem, content, index);
        }
    }

    _validateArrayItem(arrayItem) {
        if (!arrayItem.refer) {
            arrayItem.refer = "text";
            arrayItem.text = "";
        }

        if (arrayItem.refer === "database" && !arrayItem.database_refer) {
            throw new Error(`${arrayItem.tag} harus disertai database_refer`);
        }
    }

    _isPredefinedTag(resultTag, tag) {
        return (Array.isArray(resultTag) || typeof resultTag === 'string') && resultTag.includes(tag);
    }

    async _handleCustomArrayItem(page, arrayItem, content, index) {
        await this._processArrayItemProperties(arrayItem);

        if (arrayItem.database_refer !== undefined) {
            await this._handleDatabaseReferencedItem(page, arrayItem, content, index);
        } else {
            await this._handleDefaultItem(page, arrayItem, content, index);
        }
    }

    _processArrayItemProperties(arrayItem) {
        if (arrayItem.refer === "text" && arrayItem.value) {
            arrayItem.text = arrayItem.value;
        }

        if (arrayItem.refer === "database" && arrayItem.database_row) {
            arrayItem.row = arrayItem.database_row;
        }
    }

    async _handleDatabaseReferencedItem(page, arrayItem, content, index) {
        const dbRefer = arrayItem.database_refer;

        if (dbRefer <= -1) {
            await this._processNegativeDatabaseRefer(page, arrayItem);
        }

        if (page.row_section[dbRefer]?.num_rows) {
            await this.getModule("Partial").array_website(
                page, content, arrayItem, arrayItem.tag, index, page.row_section[dbRefer].row[0]
            );
        }
    }

    async _processNegativeDatabaseRefer(page, arrayItem) {
        const databaseDb = arrayItem.database;

        if (databaseDb.where_get_array) {
            await this._processWhereGetArray(databaseDb, page);
        }

        if (!page.row_section[arrayItem.database_refer]) {
            page.row_section[arrayItem.database_refer] = {
                row: [{ object: 'foreach_1_row' }],
                num_rows: 1
            };
        }

        page.row_section[arrayItem.database_refer] = await this._database.database_coverter(
            page, databaseDb, [], 'all'
        );
    }

    _processWhereGetArray(databaseDb, page) {
        for (const whereGet of databaseDb.where_get_array) {
            const varGetData = whereGet.get_row;
            const arrayRow = whereGet.array_row;

            if (page[arrayRow] && page[arrayRow][varGetData] !== undefined) {
                databaseDb.where = databaseDb.where || [];
                databaseDb.where.push([whereGet.row, '=', page[arrayRow][varGetData]]);
            }
        }
    }

    async _handleDefaultItem(page, arrayItem, content, index) {
        const row = { object: 'foreach_1_row' };
        await this.getModule("Partial").array_website(page, content, arrayItem, arrayItem.tag, index, row);
    }

    _appendToTemplate(content_template, processedContent, contentItem) {
        const tag = contentItem.tag || "-99999999999";

        if (contentItem.tag && content_template.html.includes(`<${tag}></${tag}>`)) {
            // Handle tag replacement logic here if needed
        } else {
            content_template.html += processedContent.html || "";
            content_template.css += processedContent.css || "";
            content_template.js += processedContent.js || "";
        }
    }

    _formatFinalResult(content_template) {
        return {
            css: content_template.css,
            js: content_template.js,
            html: `<div class="row">${content_template.html}</div>`
        };
    }

    _createErrorResponse(message) {
        return {
            css: "",
            js: "",
            html: `<div class="alert alert-danger">Error: ${message}</div>`
        };
    }
}

// Cara penggunaan:
// const websiteViewer = new WebsiteViewer(bundles, partial, Database);
// const result = await websiteViewer.view_website(page, content_template);