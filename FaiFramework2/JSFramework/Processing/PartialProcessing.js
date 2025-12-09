
import FaiModule from '../FaiModule.js';
export default class PartialProcessing extends FaiModule {
  constructor() {
    super();
  }
  async html_decode(page, view, id, str) {
    const textarea = document.createElement('textarea');
    textarea.innerHTML = str;
    const decoded1 = textarea.value;

    const decoded2 = decoded1
      .replace(/&#039;/g, "'")
      .replace(/{HTTPS}/g, "https")
      .replace(/{HTTP}/g, "http");

    return decoded2;
  }

  async html_encode(page, view, id, str) {
    const encoded = str
      .replace(/'/g, '&#039;')
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;');

    return encoded;
  }
  async content_source(page, template_array) {
    //   console.log("template_array", template_array);

    if (template_array.source && !template_array.content_source) {
      template_array.content_source = template_array.source;
    }

    if (template_array.source_list && !template_array.content_source) {
      template_array.content_source = template_array.source_list;
    }

    if (!template_array.content_source && template_array.template_name) {
      template_array.content_source = "template";
    } else if (!template_array.content_source && template_array.template_content) {
      template_array.content_source = "template_database";
    } else if (!template_array.content_source) {
      if (template_array.template_name) {
        template_array.content_source = "template";
      } else if (template_array.template_content) {
        template_array.content_source = "template_database";
      }
    }
    let result;
    switch (template_array.content_source) {
      case "template_content": {

        const array = [{}];

        for (const [key2, value2] of Object.entries(template_array)) {
          let key = isNaN(parseInt(key2)) ? key2 : parseInt(key2) - 1;
          array[0][key] = value2;
        }

        array[0][0] = template_array.template_class;
        array[0][1] = template_array.template_function;




        result = await this.getModule("ContentProcessing").executeContentLogic(array, 0);
        //console.log("template_content",result);
        break;
      }

      case "text":
        result = {
          html: template_array.content
        };

        break;
      case "function":
        result = {
          html: ""
        };

        break;

      case "template_database":
        result = await this.getModule("Partial").html_decode(page, '', '', template_array.template_content);
        break;

      case "html":

        result = {
          html: await this.getModule("Partial").html_decode(page, '', '', template_array.html)
        };
        break;

      case "file_bundles_database": {
        //  versions = getalldata.myApp.page.app.versions[apps][page_view];
        // last_version = versions.last_version;
        // view = versions.versions[last_version];
        //   console.log("content_search:file_bundles_database");
        const funcName = this.getModule('template');
        const array = [{
          0: funcName,
          1: template_array.template_code,
          return: "html_content"
        },

        ];


        result = await this.getModule("ContentProcessing").executeContentLogic(array, 0);
        //   console.log("file_bundles_database result", result);

        // if (template?.[template_array.template_code]?.content) {

        // } else {
        //     const sql = `
        //         SELECT * FROM website__template__master__kategori 
        //         LEFT JOIN website__template__file ON website__template__file.id_kategori = website__template__master__kategori.id
        //         LEFT JOIN website__template__list ON website__template__file.id_template = website__template__list.id
        //         WHERE kode_kategori = '${template_array.template_code}' 
        //         AND website__template__list.nama_template = '${page.template}'
        //     `;

        //     // await DB.queryRaw(page, sql);
        //     // const get = DB.get('all');

        //     if (get.num_rows) {
        //         result = html_decode(page, '', '', get.row[0].kontent_file);
        //     } else {
        //         result = '';
        //     }
        // }
        break;
      }

      default: {
        //   console.log(template_array);
        const url = await this.urlFramework(template_array.template_name, `${template_array.template_file}.php`);

        const response = await fetch(url, {
          method: 'GET',
          headers: {
            'Content-Type': 'text/html'
          },
        });
        result = await response.text();
      }
    }
    //   console.log("view_source", result);
    return result;
  }
  async urlFramework(template, url) {
    let protocol = location.protocol + "//"; // otomatis 'http://' atau 'https://'
    let host = location.hostname; // sama dengan $_SERVER['SERVER_NAME']
    let port = location.port ? `:${location.port}` : "";
    let suffix = "";

    // if (host === "localhost") {
    //   suffix = "/FrameworkServer_v1";
    // }

    return `${protocol}${host}${port}${suffix}/FaiFramework/Pages/_template/${template}/${url}`;
  }

  async proses_array_website_database_list_array(page, getDatabaseListOnList, dbRow, array, dl, databaseListTemplate,
    databaseListTemplateOnList,
    databaseListTemplateOnListOnList,
    databaseListTemplateOnListOnListOnList) {
    contentArrayTempOnList = await this.array_website(
      page,
      contentArrayTempOnList,
      valueArray,
      keyArrayOnArray,
      dl,
      dbRow,
      databaseListTemplate,
      databaseListTemplateOnList,
      databaseListTemplateOnListOnList,
      databaseListTemplateOnListOnListOnList
    );
  }
  async array_website_datatbase_list(page, array, keyArray, i, database,
    databaseListTemplate = {},
    databaseListTemplateOnList = {},
    databaseListTemplateOnListOnList = {},
    databaseListTemplateOnListOnListOnList = {}) {
    if (!array.content_source)
      array.content_source = 'template';
    let getDatabaseListOnList = await this.content_source(page, array);
    console.log("getDatabaseListOnList", getDatabaseListOnList);
    const dbRefer = array.database_refer;
    let contentArrayTempTo = {
      html: '',
      js: '',
      css: ''
    };
    let dl = 0;

    if (dbRefer <= -1) {
      const dbConf = array.database;

      // if (Array.isArray(dbConf?.where_get_array)) {
      //     dbConf.where = [];

      //     dbConf.where_get_array.forEach(entry => {
      //         const {
      //             get_row,
      //             array_row,
      //             row
      //         } = entry;
      //         const value = (globalThis[array_row] ?? {})[get_row];
      //         dbConf.where.push(value ? [row, '=', value] : [1, '=', 0]);
      //     });
      // }
      let storeName = "config_database-" + page.view.load.apps + "-" + page.view.load.page_view + "-" + keyArray;
      let search = {
        tipe: 'config_database_db_refer-1',
        dbConf: dbConf,
        database: database,
        databaseListTemplate: databaseListTemplate,
        databaseListTemplateOnList: databaseListTemplateOnList,
        databaseListTemplateOnListOnList: databaseListTemplateOnListOnList,
        live: 1
      };

      if (!page.row_section) {
        page.row_section = [];
      }
      // const db = await openDB(transaksiDB, storeName);
      // allData =  await getApiData(db, storeName, search);
      page.row_section[dbRefer] = await this.getModule('Data').getApiData( storeName, search);
      console.log(page.row_section[dbRefer]);
      // page.row_section[dbRefer] = await databaseConverter(page, dbConf, [], 'all');
    }

    let varGetDatabase = 'database';
    if (!Object.keys(databaseListTemplate).length) {
      varGetDatabase = 'database_list_template';
    } else if (!Object.keys(databaseListTemplateOnList).length) {
      varGetDatabase = 'database_list_template_on_list';
    } else if (!Object.keys(databaseListTemplateOnListOnList).length) {
      varGetDatabase = 'database_list_template_on_list_on_list';
    } else if (!Object.keys(databaseListTemplateOnListOnListOnList).length) {
      varGetDatabase = 'database_list_template_on_list_on_list_on_list';
    }
    var contentArrayTempOnList;

    let getDatabaseListOnList_out = {};
    let getDatabaseListOnList_temp = {};
    if (typeof getDatabaseListOnList == 'object') {

      getDatabaseListOnList_temp = getDatabaseListOnList;
    } else {
      getDatabaseListOnList_temp.html = getDatabaseListOnList;
      getDatabaseListOnList_temp.css = "";
      getDatabaseListOnList_temp.js = "";
    }
    const rows = page.row_section[dbRefer]?.row || [];
    if (page.row_section[dbRefer]?.num_rows) {
      for (const dbRow of rows) {
        dl++;
        getDatabaseListOnList_out[dl] = {
          html: "",
          css: "",
          js: ""
        };
        getDatabaseListOnList_out[dl].html = getDatabaseListOnList_temp.html;
        getDatabaseListOnList_out[dl].css = getDatabaseListOnList_temp.css;
        getDatabaseListOnList_out[dl].js = getDatabaseListOnList_temp.js;
        contentArrayTempOnList = await this.proses_array_website_database_list(page, getDatabaseListOnList_out[dl], dbRow, array, dl, databaseListTemplate,
          databaseListTemplateOnList,
          databaseListTemplateOnListOnList,
          databaseListTemplateOnListOnListOnList);
        if (typeof contentArrayTempOnList == 'object') {
          contentArrayTempTo.html += contentArrayTempOnList.html;
          contentArrayTempTo.css += contentArrayTempOnList.css;
        } else {

          contentArrayTempTo.html += contentArrayTempOnList;
        }

      }

    }

    return contentArrayTempTo;
  }
  async proses_array_website_database_list(page, getDatabaseListOnList_in, dbRow, array, dl, databaseListTemplate,
    databaseListTemplateOnList,
    databaseListTemplateOnListOnList,
    databaseListTemplateOnListOnListOnList) {
    let contentArrayTempOnList_in = {

    };
    contentArrayTempOnList_in = {
      html: "",
      css: "",
      js: ""
    };
    contentArrayTempOnList_in.html = getDatabaseListOnList_in.html;
    contentArrayTempOnList_in.css = getDatabaseListOnList_in.css;
    contentArrayTempOnList_in.js = getDatabaseListOnList_in.js;
    //   console.log("dbRow", dbRow);
    //   console.log("contentArrayTempOnList", contentArrayTempOnList_in);
    //   console.log("getDatabaseListOnList", getDatabaseListOnList_in);
    //   console.log("array-Array", Object.entries(array.array));
    let content_result_array;
    for (const [keyArrayOnArray, valueArray] of Object.entries(array.array)) {
      // console.log("keyArrayOnArray", keyArrayOnArray);
      // console.log("valueArray", valueArray);
      content_result_array = await this.array_website(
        page,
        contentArrayTempOnList_in,
        valueArray,
        keyArrayOnArray,
        dl,
        dbRow,
        databaseListTemplate,
        databaseListTemplateOnList,
        databaseListTemplateOnListOnList,
        databaseListTemplateOnListOnListOnList
      );
      if (typeof content_result_array == 'object') {
        if (content_result_array.html)
          contentArrayTempOnList_in.html = content_result_array.html;
        if (content_result_array.css)
          contentArrayTempOnList_in.css = content_result_array.css;
        if (content_result_array.js)
          contentArrayTempOnList_in.js = content_result_array.js;
      } else if (typeof content_result_array == 'string') {
        contentArrayTempOnList_in.html = content_result_array;
      }
    }
    return contentArrayTempOnList_in;
  }




  async array_website(page, contentReturn, array, keyArray, i, database,
    databaseListTemplate = {},
    databaseListTemplateOnList = {},
    databaseListTemplateOnListOnList = {},
    databaseListTemplateOnListOnListOnList = {}) {
    //   console.log("contentReturn before - array_website", contentReturn);
    console.log("contentReturn before - array", array);
    let all_db = [];
    all_db['database'] = database;
    all_db['databaseListTemplate'] = databaseListTemplate;
    all_db['databaseListTemplateOnList'] = databaseListTemplateOnList;
    all_db['databaseListTemplateOnListOnList'] = databaseListTemplateOnListOnList;
    all_db['databaseListTemplateOnListOnListOnList'] = databaseListTemplateOnListOnListOnList;
    if (array.refer === 'database') {
      const rowKey = array.row?.trim?.();
      let toDatabase = database;

      if (!(rowKey in toDatabase) && Object.keys(databaseListTemplate).length)
        toDatabase = databaseListTemplate;
      if (!(rowKey in toDatabase) && Object.keys(databaseListTemplateOnList).length)
        toDatabase = databaseListTemplateOnList;
      if (!(rowKey in toDatabase) && Object.keys(databaseListTemplateOnListOnList).length)
        toDatabase = databaseListTemplateOnListOnList;
      // console.log("toDatabase", toDatabase);
      //console.log("array", array);
      //console.log("keyArray", keyArray);
      const value = toDatabase[rowKey] || '';
      if (typeof contentReturn == 'object') {

        for (const type of ['css', 'html', 'js']) {
          const tagPattern = new RegExp(`<${keyArray}>\\s*<\/${keyArray}>`, 'g');
          contentReturn[type] = await contentReturn[type]?.replace(tagPattern, value)

        }
      } else {

        const tagPattern = new RegExp(`<${keyArray}>\\s*<\/${keyArray}>`, 'g');
        contentReturn = await contentReturn.replace(tagPattern, value);
      }
    } else if (array.refer === 'function') {
      //   if (typeof contentReturn == 'object') {
      //       contentReturn.html = contentReturn.html ;
      //       contentReturn.css =  contentReturn.css;
      //       contentReturn.js = "";
      //     }else{
      //       contentReturn = "";

      //   }
    } else if (array.refer === 'if_database_to_text') {
      const source = array.source_database;
      const rowGetIf = array.row;
      const ifGetValue = all_db[source]?.[rowGetIf]; // diasumsikan data globalThis.data atau lainnya
      let returnIf = "";


      const ifValue = array.if_value || {};

      for (const [keyIf, valueIf] of Object.entries(ifValue)) {
        if (keyIf) {
          if (ifGetValue === keyIf) {
            returnIf = valueIf;
            break;
          }
        }
      }

      if (!returnIf && array.if_else !== undefined) {
        returnIf = array.if_else;
      }
      if (typeof contentReturn == 'object') {

        for (const type of ['css', 'html', 'js']) {
          const tagPattern = new RegExp(`<${keyArray}>\\s*<\/${keyArray}>`, 'g');
          contentReturn[type] = await contentReturn[type]?.replace(tagPattern, returnIf)

        }
      } else {

        const tagPattern = new RegExp(`<${keyArray}>\\s*<\/${keyArray}>`, 'g');
        contentReturn = await contentReturn.replace(tagPattern, returnIf);
      }
      // contentReturn = contentReturn.replaceAll(`<${keyArray}></${keyArray}>`, );

    } else if (array.refer === 'database_list') {
      let contentArrayTempToreturn = await this.array_website_datatbase_list(page, array, keyArray, i, database,
        databaseListTemplate = {},
        databaseListTemplateOnList = {},
        databaseListTemplateOnListOnList = {},
        databaseListTemplateOnListOnListOnList = {});;
      // console.log("contentArrayTempToreturn", contentArrayTempToreturn);
      // console.log("contentReturn before", contentReturn);
      if (!contentReturn) {

      } else
        if (typeof contentReturn == 'object') {

          for (const type of ['css', 'html', 'js']) {
            const tagPattern = new RegExp(`<${keyArray}>\\s*<\/${keyArray}>`, 'g');
            contentReturn[type] = await contentReturn[type]?.replace(tagPattern, contentArrayTempToreturn[type])

          }
        } else {
          let contentReturn_temp = contentReturn;
          contentReturn = {
            css: "",
            html: "",
            js: "",

          };
          contentReturn.html = contentReturn_temp;
          const tagPattern = new RegExp(`<${keyArray}>\\s*<\/${keyArray}>`, 'g');
          if (contentArrayTempToreturn.html)
            contentReturn.html = await contentReturn.html.replace(tagPattern, contentArrayTempToreturn.html);
          else
            contentReturn.html = await contentReturn.html.replace(tagPattern, contentArrayTempToreturn);
          if (contentArrayTempToreturn.css)
            contentReturn.css += await contentArrayTempToreturn.css;
          if (contentArrayTempTo.js)
            contentReturn.js += await contentArrayTempToreturn.js;

        }
      // contentReturn = contentReturn.replaceAll(`<${keyArray}></${keyArray}>`, contentArrayTempTo);
    }

    //console.log("contentReturn after array", array);
    //console.log("contentReturn after", contentReturn);
    return contentReturn;
  }

  async array_website2(input) {

    //console.log("array_website", input);
    const {
      data = {},
      template = {},
      value = {},
      view = {},
      refer = "",
      page = {},
      site = {},
      url = {},
    } = input;

    const result = {
      output: "",
      content: "",
      include: [],
      script: [],
    };

    function get_template(name) {
      return template[name] || "";
    }

    function find_data(name) {
      return data[name] || {};
    }

    function eval_data(templateString, vars) {
      return templateString.replace(/{{(\w+)}}/g, (_, key) => vars[key] || "");
    }

    function inject_content(str) {
      result.content += str;
    }

    function inject_output(str) {
      result.output += str;
    }

    function handle_text() {
      const key = value.key || "";
      const val = value.value || "";
      const tpl = get_template("text");
      inject_output(eval_data(tpl, {
        key,
        value: val
      }));
    }

    function handle_crud() {
      const crud_data = find_data(value.crud);
      const tpl = get_template("crud");
      inject_output(eval_data(tpl, crud_data));
    }

    function handle_database() {
      const db_data = find_data(value.database);
      const tpl = get_template("database");
      inject_output(eval_data(tpl, db_data));
    }

    function handle_include() {
      const files = Array.isArray(value.include) ? value.include : [value.include];
      result.include.push(...files);
    }

    function handle_script() {
      const scripts = Array.isArray(value.script) ? value.script : [value.script];
      result.script.push(...scripts);
    }

    function handle_view() {
      const view_data = view[value.view] || {};
      const tpl = get_template("view");
      inject_output(eval_data(tpl, view_data));
    }

    function handle_default() {
      const tpl = get_template(refer);
      inject_output(eval_data(tpl, value));
    }

    switch (refer) {
      case "text":
        handle_text();
        break;
      case "crud":
        handle_crud();
        break;
      case "database":
        handle_database();
        break;
      case "include":
        handle_include();
        break;
      case "script":
        handle_script();
        break;
      case "view":
        handle_view();
        break;
      default:
        handle_default();
        break;
    }

    return result;
  }




  async encodeDataForHref(obj) {
    const json = JSON.stringify(obj);
    const utf8 = encodeURIComponent(json); // ubah jadi UTF-8 safe
    return btoa(utf8);
  }

  async decodeDataFromHref(encoded) {
    const json = decodeURIComponent(atob(encoded));
    return JSON.parse(json);
  }
}
