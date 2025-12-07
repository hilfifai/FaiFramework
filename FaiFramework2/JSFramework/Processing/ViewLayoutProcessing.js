import FaiModule from '../FaiModule.js';

export default class ViewLayoutProcessing extends FaiModule {
    constructor() {
        super();
    }

    async init(page, type, id, section_menu) {
        const content = {
            html: "",
            css: "",
            js: ""
        };

        if (type === 'load_data') {
            return await this._renderCardSingle(page, type, id, section_menu);
        }

        const layoutList = page.view.view_layout;
        // console.log("layoutList", layoutList);
        for (let i = 0; i < layoutList.length; i++) {
            const layoutType = layoutList[i][0];
            const layoutData = layoutList[i][2];
            // console.log("layoutType", layoutType);
            // console.log("layoutData", layoutData);
            page.view_layout_number = i;

            if (layoutType === 'card') {
                const cardContent = await this._renderCard(page, type, id, section_menu, layoutData);
                this._mergeContent(content, cardContent);
            }

            else if (layoutType === 'website') {
                const websiteContent = await this._renderWebsite(page, layoutData);
                this._mergeContent(content, websiteContent);
            }

            else if (layoutType === 'step') {
                const stepContent = await this._renderStep(page, layoutData);
                this._mergeContent(content, stepContent);
            }
        }

        return content;
    }

    async _renderCardSingle(page, type, id, section_menu) {
        const i_card = this._partial.input('i_card') ?? 0;

        page.section = "card";
        page.view_layout_number = i_card;

        return await Packages.card(
            page,
            type,
            id,
            section_menu,
            page.view.view_layout[i_card][2]
        );
    }

    async _renderCard(page, type, id, section_menu, layoutData) {
        page.section = "card";
        return await Packages.card(page, type, id, section_menu, layoutData);
    }

    async _renderWebsite(page, layoutData) {
        page.website = layoutData;
        return await this.getModule("ViewWebsite").view_website(page, "");
    }

    async _renderStep(page, step) {
        await DB.connection(page);

        page.wizard = step.wizard;

        let database = null;
        if (step.parameter_check.get_data === 'refer') {
            database = page.config.database[step.parameter_check.database_refer];
        }

        const row_base = await Database.database_coverter(page, database, null, 'all');

        let step_id;
        if (row_base.num_rows) {
            const row_step = step.parameter_check.row_data;
            const id_done = row_base.row[0][row_step];
            step_id = (id_done === 0) ? 1 : page.wizard.step[id_done].next;
        } else {
            step_id = 1;
        }

        page.load = {
            step: step_id,
            next_step: page.wizard.step[step_id].next
        };

        return await Packages.step(
            page,
            step_id,
            page.wizard.step[step_id],
            step.content,
            database,
            ""
        );
    }

    _mergeContent(target, source) {
        target.html += source.html || "";
        target.css += source.css || "";
        target.js += source.js || "";
    }
}
