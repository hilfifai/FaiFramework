  console.log("data", data.app.versions.Inventaris_aset.bangunan);
                get_data = data.app.versions.Inventaris_aset.bangunan;
                last_version = get_data.last_version;
                bangunan = get_data.versions[last_version];
                console.log(bangunan);
               //
               
               parse_form(bangunan.page.crud,'form-alamat-penerima','tambah',null);

                return;