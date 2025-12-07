<html>

<head>
    <title>
        Customer Details
    </title>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/> -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <style>
        :root {
            --primary-color: #185ee0;
            --secondary-color: #e6eef9;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F5F7FA;
            margin: 0;
            padding: 0;
        }
        .containerboard {
            height: 100vh;
            padding: 0 70px;
        }

        .sidebar {
            width: 250px;
            background-color: #FFFFFF;
            border-right: 1px solid #E5E7EB;
            padding: 20px;
        }

        .sidebar .logo {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .sidebar .logo i {
            font-size: 24px;
            color: #3B82F6;
            margin-right: 10px;
        }

        .sidebar .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .menu li {
            margin-bottom: 20px;
        }

        .sidebar .menu li a {
            text-decoration: none;
            color: #6B7280;
            display: flex;
            align-items: center;
        }

        .sidebar .menu li a i {
            font-size: 20px;
            margin-right: 10px;
        }

        .sidebar .patient-queue {
            margin-top: 20px;
        }

        .sidebar .patient-queue h3 {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 10px;
        }

        .sidebar .patient-queue .search {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .sidebar .patient-queue .search input {
            width: 100%;
            padding: 8px;
            border: 1px solid #E5E7EB;
            border-radius: 4px;
            margin-right: 10px;
        }

        .sidebar .patient-queue .search i {
            font-size: 20px;
            color: #6B7280;
        }

        .sidebar .patient-queue .tabs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .sidebar .patient-queue .tabs button {
            background: none;
            border: none;
            font-size: 14px;
            color: #6B7280;
            cursor: pointer;
        }

        .sidebar .patient-queue .patient-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar .patient-queue .patient-list li {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #E5E7EB;
            border-radius: 4px;
            margin-bottom: 10px;
            background-color: #FFFFFF;
        }

        .sidebar .patient-queue .patient-list li img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .sidebar .patient-queue .patient-list li .info {
            flex-grow: 1;
        }

        .sidebar .patient-queue .patient-list li .info h4 {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .sidebar .patient-queue .patient-list li .info p {
            font-size: 12px;
            color: #6B7280;
            margin: 0;
        }

        .sidebar .patient-queue .patient-list li .actions {
            display: flex;
            align-items: center;
        }

        .sidebar .patient-queue .patient-list li .actions i {
            font-size: 20px;
            color: #6B7280;
            cursor: pointer;
        }

        .habist {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .habist .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .habist .header .breadcrumbs {
            display: flex;
            align-items: center;
        }

        .habist .header .breadcrumbs a {
            text-decoration: none;
            color: #3B82F6;
            font-size: 14px;
            margin-right: 10px;
        }

        .habist .header .breadcrumbs span {
            font-size: 14px;
            color: #6B7280;
        }

        .habist .header .user-info {
            display: flex;
            align-items: center;
        }

        .habist .header .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .habist .header .user-info .details {
            display: flex;
            flex-direction: column;
        }

        .habist .header .user-info .details h4 {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .habist .header .user-info .details p {
            font-size: 12px;
            color: #6B7280;
            margin: 0;
        }

        .habist .main {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .habist .main .card {
            background-color: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 8px;
            padding: 20px;
            flex: 1;
            min-width: 300px;
        }

        .habist .main .card h3 {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 20px;
        }

        .habist .main .card .info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .habist .main .card .info img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .habist .main .card .info .details {
            display: flex;
            flex-direction: column;
        }

        .habist .main .card .info .details h4 {
            font-size: 16px;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .habist .main .card .info .details p {
            font-size: 12px;
            color: #6B7280;
            margin: 0;
        }

        .habist .main .card .info .details .badge {
            background-color: #10B981;
            color: #FFFFFF;
            font-size: 12px;
            padding: 2px 8px;
            border-radius: 4px;
            margin-top: 5px;
        }

        .habist .main .card .details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .habist .main .card .details .item {
            display: flex;
            align-items: center;
        }

        .habist .main .card .details .item i {
            font-size: 16px;
            color: #6B7280;
            margin-right: 10px;
        }

        .habist .main .card .details .item p {
            font-size: 14px;
            color: #111827;
            margin: 0;
        }

        .habist .main .card .details .item .value {
            font-size: 14px;
            color: #6B7280;
            margin-left: auto;
        }

        .habist .main .card .details .sources {
            display: flex;
            gap: 10px;
        }

        .habist .main .card .details .sources i {
            font-size: 20px;
            color: #6B7280;
        }

        .habist .main .card .history {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .habist .main .card .history th,
        .habist .main .card .history td {
            border: 1px solid #E5E7EB;
            padding: 10px;
            text-align: left;
        }

        .habist .main .card .history th {
            background-color: #F9FAFB;
            font-size: 14px;
            color: #6B7280;
        }

        .habist .main .card .history td {
            font-size: 14px;
            color: #111827;
        }

        .habist .main .card .history .status {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .habist .main .card .history .status i {
            font-size: 14px;
        }

        .habist .main .card .history .status.pending i {
            color: #F59E0B;
        }

        .habist .main .card .history .status.paid i {
            color: #10B981;
        }

        .habist .main .card .assurance {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
            color: #FFFFFF;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .habist .main .card .assurance h4 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .habist .main .card .assurance p {
            font-size: 14px;
            margin: 0;
        }

        .habist .main .card .assurance .details {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 10px;
        }

        .habist .main .card .assurance .details .item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .habist .main .card .assurance .details .item p {
            font-size: 12px;
            margin: 0;
        }

        .habist .main .card .assurance .details .item .value {
            font-size: 14px;
            font-weight: 600;
        }

        .habist .main .card .dentalica {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .habist .main .card .dentalica .days {
            font-size: 32px;
            font-weight: 600;
            color: #111827;
        }

        .habist .main .card .dentalica .extend {
            background-color: #3B82F6;
            color: #FFFFFF;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }

        .habist .main .card .documents {
            margin-top: 20px;
        }

        .habist .main .card .documents .document {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border: 1px solid #E5E7EB;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        .habist .main .card .documents .document i {
            font-size: 20px;
            color: #6B7280;
        }

        .habist .main .card .documents .document .info {
            display: flex;
            flex-direction: column;
        }

        .habist .main .card .documents .document .info h4 {
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            margin: 0;
        }

        .habist .main .card .documents .document .info p {
            font-size: 12px;
            color: #6B7280;
            margin: 0;
        }


        .tabs {
            display: flex;
            position: relative;
            background-color: #fff;
            box-shadow: 0 0 1px 0 rgba(#185ee0, 0.15), 0 6px 12px 0 rgba(#185ee0, 0.15);
            padding: 0.75rem;
            /* border-radius: 99px;  */
        }

        input[type="radio"] {
            display: none;
        }

        .tab {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            width: 100%;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: color 0.15s ease-in;
        }

        .notification {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 1.25rem;
            height: 1.25rem;
            margin-left: 0.75rem;
            border-radius: 50%;
            background-color: var(--secondary-color);
            transition: 0.15s ease-in;
        }

        input[type="radio"]:checked+label {
            color: var(--primary-color);
            background: var(--secondary-color);
            border-radius: 20px;
            height: 40px;
            color: black;
        }

        input[type="radio"]:checked+label>.notification {
            background-color: var(--primary-color);
            color: #fff;
        }

        @media (max-width: 700px) {
            .tabs {
                transform: scale(0.6);
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 100%;
            }
        }


        .card {

            border-radius: 15px;
            padding: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s ease, background-color 0.3s ease;
        }

        avatars__item {
            background-color: #596376;
            border: 2px solid #1f2532;
            border-radius: 100%;
            color: #ffffff;
            display: block;
            font-family: sans-serif;
            font-size: 12px;
            font-weight: 100;
            height: 25px;
            width: 25px;
            line-height: 45px;
            text-align: center;
            transition: margin 0.1s ease-in-out;
            overflow: hidden;
            margin-left: -10px;
        }

        .avatars__item img {

            height: 25px !important;
            width: 25px !important;
            margin: 0 -7px 0 0 !important;
        }

        .settings {
            position: relative;
            height: auto;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .settings .setting {
            position: relative;
            width: 100%;
            height: calc(65px - 10px);
            background: var(--secondary-color);
            border-radius: 8px;
            display: flex;
            align-items: center;
            padding: 10px 25px;
            color: #000;
            margin-bottom: 8px;
        }

        .settings .setting input {
            opacity: 0;
            position: absolute;
        }

        .settings .setting input+label {
            user-select: none;
        }

        .settings .setting input+label::before,
        .settings .setting input+label::after {
            content: "";
            position: absolute;
            transition: 150ms cubic-bezier(0.24, 0, 0.5, 1);
            transform: translateY(-50%);
            top: 50%;
            right: 10px;
            cursor: pointer;
        }

        .settings .setting input+label::before {
            height: 30px;
            width: 50px;
            border-radius: 30px;
            background: rgba(214, 214, 214, 0.434);
        }

        .settings .setting input+label::after {
            height: 24px;
            width: 24px;
            border-radius: 60px;
            right: 32px;
            background: #fff;
        }

        .settings .setting input:checked+label:before {
            background: #5d68e2;
            transition: all 150ms cubic-bezier(0, 0, 0, 0.1);
        }

        .settings .setting input:checked+label:after {
            right: 14px;
        }

        .settings .setting input:focus+label:before {
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.75);
        }

        .settings .setting input:disabled+label:before,
        .settings .setting input:disabled+label:after {
            cursor: not-allowed;
        }

        .settings .setting input:disabled+label:before {
            background: #4f4f6a;
        }

        .settings .setting input:disabled+label:after {
            background: #909090;
        }
    </style>
</head>

<body>
    <div class="containerboard">
        <div class="row">
            <div class="col-3">

                <div class="sidebar">

                    <div class="patient-queue">
                        <h3>
                            Board
                        </h3>
                        <div class="search">
                            <input placeholder="Search..." type="text" id="search_board" onkeyup="" />
                            <i class="fas fa-search">
                            </i>
                        </div>
                        <button class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#exampleModal">Tambah</button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="add.php" method="POST">
                                            <div class="mb-3">
                                                <label for="kode_board" class="form-label">Kode Board</label>
                                                <input type="text" class="form-control" id="kode_board" name="kode_board" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama_board" class="form-label">Nama Board</label>
                                                <input type="text" class="form-control" id="nama_board" name="nama_board" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="brusor" class="form-label">Brusor</label>
                                                <input type="text" class="form-control" id="brusor" name="brusor">
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            get_content_board()
                            function get_content_board() {
                                searchData = $('#search_board').val();
                                $.ajax({

                                    type: 'get',
                                    dataType: 'html',
                                    data: {
                                        'first': link_route,
                                        'link_route': $('#load_link_route').val(),
                                        'apps': 'Amal',
                                        'page_view': 'board',
                                        'type': 'list_board_amalan',
                                        'id': $('#load_id').val(),
                                        'frameworksubdomain': $('#load_domain').val(),
                                        'seeach': searchData,
                                        'contentfaiframework': 'get_pages',
                                        "MainAll": 2
                                    },
                                    url: link_route,
                                    dataType: 'html',
                                    success: function(responseData) {

                                        $("#content_board").html(responseData);



                                    }
                                });
                            }
                        </script>

                        <ul class="patient-list" id="content_board">

                            
                            <li>
                                <img alt="Profile picture of Jerome Bellingham" height="40" src="https://storage.googleapis.com/a1aa/image/VaI0l8gyyY4xPdpcDylFAaV8c0eFcQT2mezXdaH5Ulk75JrTA.jpg" width="40" />
                                <div class="info">
                                    <h4>
                                        Jerome Bellingham
                                    </h4>
                                    <p>
                                        Register: 12 March 2023
                                    </p>
                                </div>
                                <div class="actions">
                                    <i class="fas fa-chevron-right">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <img alt="Profile picture of Darlene Robertson" height="40" src="https://storage.googleapis.com/a1aa/image/TxiTGBnM87JMN9RT8LvRCO4LkNRWRo5x5EbKcnOhLrpgek1JA.jpg" width="40" />
                                <div class="info">
                                    <h4>
                                        Darlene Robertson
                                    </h4>
                                    <p>
                                        Register: 12 March 2023
                                    </p>
                                </div>
                                <div class="actions">
                                    <i class="fas fa-chevron-right">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <img alt="Profile picture of Albert Flores" height="40" src="https://storage.googleapis.com/a1aa/image/huRt9j1kx9JRKtDAW9eJhf5FKBvZTgfw4bym8hosAYHA0TWnA.jpg" width="40" />
                                <div class="info">
                                    <h4>
                                        Albert Flores
                                    </h4>
                                    <p>
                                        Register: 12 March 2023
                                    </p>
                                </div>
                                <div class="actions">
                                    <i class="fas fa-chevron-right">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <img alt="Profile picture of Savannah Nguyen" height="40" src="https://storage.googleapis.com/a1aa/image/9MZyzC0wBk4NAhvw8tt1NYq49XxNKmLXt6jAjlfwx5oC9k1JA.jpg" width="40" />
                                <div class="info">
                                    <h4>
                                        Savannah Nguyen
                                    </h4>
                                    <p>
                                        Register: 12 March 2023
                                    </p>
                                </div>
                                <div class="actions">
                                    <i class="fas fa-chevron-right">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <img alt="Profile picture of Jenny Wilson" height="40" src="https://storage.googleapis.com/a1aa/image/QDsIyU53aUpwAZXZpNgku8uHUYPXTb71rxeiYRPcfVpfzTWnA.jpg" width="40" />
                                <div class="info">
                                    <h4>
                                        Jenny Wilson
                                    </h4>
                                    <p>
                                        Register: 12 March 2023
                                    </p>
                                </div>
                                <div class="actions">
                                    <i class="fas fa-chevron-right">
                                    </i>
                                </div>
                            </li>
                            <li>
                                <img alt="Profile picture of Kathryn Murphy" height="40" src="https://storage.googleapis.com/a1aa/image/IVVzwbG84BZoNdbC3NBKfnEwSxw9AcJ2enS8fPoIzqfPonsOB.jpg" width="40" />
                                <div class="info">
                                    <h4>
                                        Kathryn Murphy
                                    </h4>
                                    <p>
                                        Register: 12 March 2023
                                    </p>
                                </div>
                                <div class="actions">
                                    <i class="fas fa-chevron-right">
                                    </i>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-9">

                <div class="habist p-0">
                    <div class="tabs">

                        <input type="radio" id="radio-1" name="tabs" checked />
                        <label class="tab" for="radio-1">Overview<span class="notification">2</span></label>
                        <input type="radio" id="radio-2" name="tabs" />
                        <label class="tab" for="radio-2">Role</label>
                        <input type="radio" id="radio-3" name="tabs" />
                        <label class="tab" for="radio-3">Anggota</label>
                        <input type="radio" id="radio-4" name="tabs" />
                        <label class="tab" for="radio-4">Muktabaah Yaumiyah</label>
                        <input type="radio" id="radio-5" name="tabs" />
                        <label class="tab" for="radio-5">Leaderboard</label>
                        <input type="radio" id="radio-7" name="tabs" />
                        <label class="tab" for="radio-7">Setting</label>
                        <span class="glider"></span>
                    </div>
                    <div class="header">


                        <div class="user-info p-5 pb-3">
                            <img alt="Profile picture of Alexander Arnold" height="50" src="https://storage.googleapis.com/a1aa/image/vo3t1Je6hQycUS4Mw3N86CJlDDjiGXITWeekduag7Rs6zTWnA.jpg" width="50" />
                            <div class="details">
                                <h4>
                                    Board Hamasah <button class="btn btn-default btn-sm">Share Board</button>
                                </h4>
                                <p>
                                    <style>

                                    </style>
                                <div class="avatars">
                                    <a href="#" class="avatars__item avat"><img class="avatar" src="https://randomuser.me/api/portraits/women/65.jpg" alt=""></a>
                                    <a href="#" class="avatars__item"><img class="avatar" src="https://randomuser.me/api/portraits/men/25.jpg" alt=""></a>
                                    <a href="#" class="avatars__item"><img class="avatar" src="https://randomuser.me/api/portraits/women/25.jpg" alt=""></a>
                                    <a href="#" class="avatars__item"><img class="avatar" src="https://randomuser.me/api/portraits/men/55.jpg" alt=""></a>
                                    <a href="#" class="avatars__item"><img class="avatar" src="https://via.placeholder.com/300/09f/fff.png" alt=""></a>
                                </div>
                                </p>
                                <p>
                                    as a Administrator
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="main p-5 pt-0 " style="padding-top: 0px !important;">

                        <div class="settings">
                            <span class="settings__title field-title">Tambah Amalan</span>
                            <div class="setting">
                                <input type="checkbox" id="uppercase" checked />
                                <label for="uppercase">Include Uppercase</label>
                            </div>
                            <div class="setting">
                                <input type="checkbox" id="lowercase" checked />
                                <label for="lowercase">Include Lowercase</label>
                            </div>
                            <div class="setting">
                                <input type="checkbox" id="number" checked />
                                <label for="number">Include Numbers</label>
                            </div>
                            <div class="setting">
                                <input type="checkbox" id="symbol" />
                                <label for="symbol">Include Symbols</label>
                            </div>
                        </div>

                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                        <style>
                            .alarm-icon {
                                color: #ccc;
                                font-size: 1.5em;
                                cursor: pointer;
                                margin-right: 15px;
                            }

                            .alarm-icon.active {
                                color: #5d68e2;
                            }

                            .alarm-time {
                                display: none;
                                margin-left: 10px;
                            }
                        </style>
                        </head>

                        <body>

                            <div class="container my-4">
                                <div class="settings">
                                    <span class="settings__title field-title">Tambah Amalan</span>

                                    <div class="setting">
                                        <i class="fas fa-bell alarm-icon" onclick="toggleAlarm(this)"></i>
                                        <span>Dzikir Pagi</span>
                                        <input type="time" class="alarm-time">
                                        <input type="checkbox" id="uppercase" checked>
                                        <label for="uppercase">Include Uppercase</label>
                                    </div>

                                    <div class="setting">
                                        <i class="fas fa-bell alarm-icon" onclick="toggleAlarm(this)"></i>
                                        <span>Shalat Dhuha</span>
                                        <input type="time" class="alarm-time">
                                        <input type="checkbox" id="lowercase" checked>
                                        <label for="lowercase">Include Lowercase</label>
                                    </div>

                                    <div class="setting">
                                        <i class="fas fa-bell alarm-icon" onclick="toggleAlarm(this)"></i>
                                        <span>Baca Al-Qur'an</span>
                                        <input type="time" class="alarm-time">
                                        <input type="checkbox" id="number" checked>
                                        <label for="number">Include Numbers</label>
                                    </div>

                                    <div class="setting">
                                        <i class="fas fa-bell alarm-icon" onclick="toggleAlarm(this)"></i>
                                        <span>Shalat Tahajud</span>
                                        <input type="time" class="alarm-time">
                                        <input type="checkbox" id="symbol">
                                        <label for="symbol">Include Symbols</label>
                                    </div>
                                </div>
                            </div>

                            <script>
                                function toggleAlarm(icon) {
                                    // Toggle kelas "active" untuk ikon
                                    icon.classList.toggle("active");

                                    // Tampilkan atau sembunyikan form waktu alarm
                                    const timeInput = icon.nextElementSibling.nextElementSibling;
                                    timeInput.style.display = timeInput.style.display === "none" ? "inline-block" : "none";
                                }
                            </script>

                        </body>


                        <button class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#exampleModal">Tambah</button>
                        <div class="card" id="profileCard">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
                            <h2 class="noSelect">John Doe</h2>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                        <div class="card" id="profileCard">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
                            <h2 class="noSelect">John Doe</h2>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                        <div class="card" id="profileCard">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
                            <h2 class="noSelect">John Doe</h2>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                        <div class="card" id="profileCard">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
                            <h2 class="noSelect">John Doe</h2>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>

                        <div class="info-box" id="infoBox">
                            <h2 class="noSelect">About Me</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, quibusdam delectus? Officia optio eveniet molestias explicabo culpa quos delectus ratione laudantium. Laborum obcaecati totam quasi animi illum veritatis laboriosam veniam?
                                Quis impedit eveniet, asperiores atque neque debitis aliquid quisquam, odit itaque reprehenderit quidem! Exercitationem aperiam dolore laborum aliquam, vitae incidunt animi mollitia amet. Impedit, qui! Provident, dicta molestiae. Exercitationem, voluptates.</p>

                            <div class="pills">
                                <span class="pill">JavaScript</span>
                                <span class="pill">Python</span>
                                <span class="pill">Java</span>
                                <span class="pill">C#</span>
                                <span class="pill">HTML</span>
                                <span class="pill">CSS</span>
                                <span class="pill">SQL</span>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="info">
                            <img alt="Profile picture of Jerome Bellingham" height="60" src="https://storage.googleapis.com/a1aa/image/VaI0l8gyyY4xPdpcDylFAaV8c0eFcQT2mezXdaH5Ulk75JrTA.jpg" width="60" />
                            <div class="details">
                                <h4>
                                    Jerome Bellingham
                                </h4>
                                <p>
                                    Joined Since : 12 March 2023
                                </p>
                                <div class="badge">
                                    MEMBER
                                </div>
                            </div>
                        </div>
                        <h3>
                            Basic Informational
                        </h3>
                        <div class="details">
                            <div class="item">
                                <i class="fas fa-male">
                                </i>
                                <p>
                                    Gender
                                </p>
                                <p class="value">
                                    Male
                                </p>
                            </div>
                            <div class="item">
                                <i class="fas fa-birthday-cake">
                                </i>
                                <p>
                                    Birthday
                                </p>
                                <p class="value">
                                    12 August 2001
                                </p>
                            </div>
                            <div class="item">
                                <i class="fas fa-phone">
                                </i>
                                <p>
                                    Phone Number
                                </p>
                                <p class="value">
                                    +62 837 356 343 23
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>