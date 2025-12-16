import FaiModule from '../FaiModule.js';
export default class LoginHub extends FaiModule {
    constructor() {
        super();
        this.base_url_BASED = this.getModule('base_url')+'/app2';
    }
    open_register() {
        $("#login-container").hide();
        $("#asgouest-form-container").hide();
        $("#register-modal").show();
    }

    open_login() {
        document.body.classList.add("blurred");
        $("#register-modal").hide();
        $("#login-container").show();
        $("#asgouest-form-container").hide();
    }

    close_login() {
        document.body.classList.remove("blurred");
        $("#register-modal").hide();
        $("#login-container").hide();
        $("#asgouest-form-container").hide();
    }

    close_all() {
        document.body.classList.remove("blurred");
        $("#toko-dropship-container").hide();
        $("#alamat-penerima-container").hide();
        $("#register-modal").hide();
        $("#login-container").hide();
        $("#asgouest-form-container").hide();
    }

    open_guest() {
        $("#register-modal").hide();
        $("#asgouest-form-container").show();
        $("#login-container").hide();
    }

    open_verifikasi() {

        $("#register-modal").hide();
        $("#asgouest-form-container").hide();
        $("#login-container").hide();

        $("#asgouest-verifikasi-container").show();
    }
    success_login() {
        $('#login-container').hide();

        $('#asgouest-thank-container').show();
        $('.is_login').show();
        $('.not_login').hide();
        setTimeout(function () {
            document.body.classList.remove("blurred");

            $('#asgouest-thank-container').hide()

        }, 2000)
    }
    saveSession(data) {
        return new Promise((resolve, reject) => {
            const request = indexedDB.open("myAppDB", 1);

            request.onerror = () => reject("Gagal buka database");
            request.onsuccess = () => {
                const db = request.result;
                const tx = db.transaction("session", "readwrite");
                const store = tx.objectStore("session");



                const putReq = store.put(data);
                putReq.onsuccess = () => resolve(true);
                putReq.onerror = () => reject("Gagal simpan session");
            };

            request.onupgradeneeded = (event) => {
                const db = event.target.result;
                if (!db.objectStoreNames.contains("session")) {
                    db.createObjectStore("session", {
                        keyPath: "id"
                    });
                }
            };
        });

    }
    jsLogout() {
        $.ajax({
            type: 'POST',
            url: window.fai.getModule('base_url') + "api/get_logout",

            cache: false,

            dataType: 'json',
            success: function (msg) {
                if (msg.status) {
                    const data = {
                        id: "current",
                        isLoggedIn: false,
                        userId: null, // misal nama, id, dsb
                        waktuLogin: Date.now(),
                        waktuLogout: Date.now()
                    };
                    window.fai.getModule('loginHub').saveSession(data);
                    window.fai.getModule('loginHub').success_login();
                    window.fai.getModule('loginHelper').checkLoginStatus().then((isLoggedIn) => {
                        if (isLoggedIn) {
                            $('.is_login').show();
                            $('.not_login').hide();
                            // Arahkan ke dashboard atau homepage
                        } else {
                            $('.is_login').hide();
                            $('.not_login').show();
                        }
                    });
                    if(document.getElementById('template').value!=document.getElementById('base_template').value){
                        window.location.href=this.base_url_BASED;
                        document.getElementById('template').value = document.getElementById('base_template').value
                    }
                } else {
                    setShowAlert(msg.keterangan,"danger");
                }
            },
            error: function (data) {
                setShowAlert("Logout Gagal","danger");
                console.log('error:', data)
            },
        })
    }

    verifikasi_code() {
        $.ajax({
            type: 'POST',
            url: this.getmodule('base_url') + "api/verifikasi_wa",
            data: {

                kode: $('#verificationCode').val()
            },
            cache: false,

            dataType: 'json',
            success: function (msg) {
                if (msg.status) {
                    $('#asgouest-form-container').hide();
                    $('#asgouest-verifikasi-container').hide();
                    success_login();
                } else {
                    setShowAlert('Kode Verifikasi Salah',"danger");
                }
            },
            error: function (data) {
                console.log('error:', data)
            },
        })
    }

    get_guest() {
        $.ajax({
            type: 'POST',
            url: this.getmodule('base_url') + "api/register_guest",
            data: {


                phone: $('#nowa').val()
            },
            cache: false,

            dataType: 'json',
            success: function (msg) {
                if (msg.status) {
                    const data = {
                        id: "current",
                        isLoggedIn: true,
                        userId: msg.id_apps_user, // misal nama, id, dsb
                        waktuLogin: Date.now()
                    };
                    saveSession(data);
                    success_login();
                    $('#asgouest-verifikasi-container').show();
                } else {
                    setShowAlert(msg.keterangan,"danger");
                }
            },
            error: function (data) {
                setShowAlert("Login Gagal","danger");
                console.log('error:', data)
            },
        })
    }

    get_login() {
        let base_url_BASED = this.getModule('base_url')+'/app2';
        $.ajax({
            type: 'POST',
            url: this.getModule('base_url') + "api/get_login",
            data: {


                id_board: this.getModule('domainDetail').id_board,
                email: $('#emailLGN').val(),
                password: $('#passwordLGN').val()
            },
            cache: false,

            dataType: 'json',
            success: function (msg) {
                if (msg.status) {
                    const data = {
                        id: "current",
                        isLoggedIn: true,
                        userId: msg.id_apps_user, // misal nama, id, dsb
                        template: msg.template, // misal nama, id, dsb
                        id_first_menu: msg.id_first_menu, // misal nama, id, dsb
                        id_role_user: msg.id_role_user, // misal nama, id, dsb
                        id_role_akses: msg.id_role_akses, // misal nama, id, dsb
                        waktuLogin: Date.now()
                    };
                    console.log(data);

                    saveSession(data);
                    success_login();
                    if (msg.template) {

                        if (document.getElementById("template").value != msg.template) {
                            window.location.href = base_url_BASED;
                            document.getElementById("template").innerHTML = msg.template
                        }
                    }
                } else {
                    setShowAlert(msg.keterangan,"danger");
                }
            },
            error: function (data) {
                setShowAlert("Login Gagal","danger");
                console.log('error:', data)
            },
        })
    }
}