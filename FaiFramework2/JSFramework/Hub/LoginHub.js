import FaiModule from '../FaiModule.js';
export default class LoginHub extends FaiModule {
    constructor() {
        super();
        this.base_url_BASED = this.getModule('base_url') + '/app2';
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
                    window.location.href = window.fai.getModule('base_url') + '/app2';

                } else {
                    setShowAlert(msg.keterangan, "danger");
                }
            },
            error: function (data) {
                setShowAlert("Logout Gagal", "danger");
                console.log('error:', data)
            },
        })
    }

    is_login() {
        $.ajax({
            type: 'POST',
            url: this.getModule('base_url') + "api/is_login",
            
            cache: false,

            dataType: 'json',
            success: function (msg) {
                if (msg.is_login) {
                    // $('#asgouest-form-container').hide();
                    // $('#asgouest-verifikasi-container').hide();
                    // const data = {
                    //     id: "current",
                    //     isLoggedIn: true,
                    //     userId: msg.id_apps_user, // misal nama, id, dsb
                    //     template: msg.template, // misal nama, id, dsb
                    //     id_first_menu: msg.id_first_menu, // misal nama, id, dsb
                    //     id_role_user: msg.id_role_user, // misal nama, id, dsb
                    //     id_role_akses: msg.id_role_akses, // misal nama, id, dsb
                    //     waktuLogin: Date.now()
                    // };
                    // document.body.classList.remove("blurred");
                    // saveSession(data);
                    // success_login();
                } else {
                    jsLogout();
                }
            },
            error: function (data) {
                console.log('error:', data)
            },
        })
    }

    verifikasi_code(kode, id) {
        $.ajax({
            type: 'POST',
            url: this.getModule('base_url') + "api/verifikasi_wa",
            data: {

                kode: kode,
                id: id
            },
            cache: false,

            dataType: 'json',
            success: function (msg) {
                if (msg.status) {
                    $('#asgouest-form-container').hide();
                    $('#asgouest-verifikasi-container').hide();
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
                    document.body.classList.remove("blurred");
                    saveSession(data);
                    success_login();
                } else {
                    setShowAlert('Kode Verifikasi Salah', "danger");
                }
            },
            error: function (data) {
                console.log('error:', data)
            },
        })
    }

    get_guest(phone) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'POST',
                url: this.getModule('base_url') + "api/register_guest",
                data: {
                    phone: phone
                },
                cache: false,
                dataType: 'json',

                success: (msg) => { // <-- arrow function, this aman
                    if (msg.status) {
                        resolve({
                            success: true,
                            id_apps_user: msg.id_apps_user,
                            message: msg.keterangan ?? 'Berhasil'
                        });
                        setShowAlert("Berhasil", "success");
                    } else {
                        resolve({
                            success: false,
                            id_apps_user: null,
                            message: msg.keterangan ?? 'Gagal'
                        });
                        setShowAlert(msg.keterangan, "danger");
                    }
                },

                error: (err) => {
                    reject({
                        success: false,
                        id_apps_user: null,
                        message: 'Login Gagal',
                        error: err
                    });
                }
            });
        });
    }
    resend_wa(id) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'POST',
                url: this.getModule('base_url') + "api/resend_wa",
                data: {
                    id: id
                },
                cache: false,
                dataType: 'json',

                success: (msg) => { // <-- arrow function, this aman
                    if (msg.status) {
                        resolve({
                            success: true,
                            id_apps_user: msg.id_apps_user,
                            message: msg.keterangan ?? 'Berhasil'
                        });
                        setShowAlert("Berhasil", "success");
                    } else {
                        resolve({
                            success: false,
                            id_apps_user: null,
                            message: msg.keterangan ?? 'Gagal'
                        });
                        setShowAlert(msg.keterangan, "danger");
                    }
                },

                error: (err) => {
                    reject({
                        success: false,
                        id_apps_user: null,
                        message: 'Login Gagal',
                        error: err
                    });
                }
            });
        });
    }


    get_login() {
        let base_url_BASED = this.getModule('base_url') + '/app2';
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

                    saveSession(data);
                    success_login();
                    if (msg.template) {

                        if (document.getElementById("template").value != msg.template) {
                            window.location.href = base_url_BASED;
                            document.getElementById("template").innerHTML = msg.template
                        }
                    }
                } else {
                    setShowAlert(msg.keterangan, "danger");
                }
            },
            error: function (data) {
                setShowAlert("Login Gagal", "danger");
                console.log('error:', data)
            },
        })
    }
    save_register(dataRegister) {
        let base_url_BASED = this.getModule('base_url') + '/app2';
        $.ajax({
            type: 'POST',
            url: this.getModule('base_url') + "api/save_register",
            data: dataRegister,
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
                    setShowAlert(msg.keterangan, "danger");
                }
            },
            error: function (data) {
                setShowAlert("Login Gagal", "danger");
                console.log('error:', data)
            },
        })
    }
}