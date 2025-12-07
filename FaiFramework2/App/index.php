<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token">
    <title></title>

    <!-- CSS Libraries -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.7.0/css/select.bootstrap5.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link style="<?php echo base_url(); ?>FaiFramework/Pages/OrderSystem/style.css">

    <style>
        table>tbody>tr>td {
            vertical-align: top
        }

        .swal2-popup {
            opacity: 1 !important;
            transform: scale(1) !important;
        }

        .swal2-show {
            animation: swal2-show 0.3s !important;
        }

        @keyframes swal2-show {
            0% {
                transform: scale(0.9) !important;
                opacity: 0 !important;
            }

            100% {
                transform: scale(1) !important;
                opacity: 1 !important;
            }
        }

        div.dataTables_scrollBody {
            max-height: 400px !important;
            overflow-y: auto !important;
        }

        /* Popup Container */
        #popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.85);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            flex-direction: column;
        }

        #popup-img {
            max-width: 90%;
            max-height: 90%;
            transition: transform 0.3s ease;
        }

        .popup-close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 30px;
            color: white;
            cursor: pointer;
            z-index: 10000;
        }

        .zoom-controls {
            position: absolute;
            top: 20px;
            right: 70px;
            display: flex;
            gap: 10px;
            z-index: 10001;
        }

        .zoom-btn {
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        body.no-scroll {
            overflow: hidden;
        }

        #popup {
            overflow: auto;
        }

        .form-control {
            border: var(--bs-border-width) solid #E4DFDF !important;
        }

        .pilih_ongkir {
            padding: 20px;
            background: #fafafa;
            font-size: 18px;
            font-weight: bold;
            color: black;
        }

        /* Login Container */
        .login-container {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            background-color: white;
            border-radius: 8px;
            overflow: auto;
            pointer-events: auto;
            z-index: 999999;
        }

        .login-container .login-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .login-container .login-title {
            font-size: 1.25rem;
            font-weight: bold;
            text-transform: capitalize;
        }

        .login-container .close-icon {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .login-container .form-label {
            margin: 16px 0;
        }

        .login-container .form-label-text {
            font-size: 0.875rem;
            color: #4B4B4B;
        }

        .login-container .form-input {
            width: 100%;
            padding: 12px;
            font-size: 1rem;
            color: #000;
            border: none;
            outline: none;
            border-bottom: 1px solid #D8D8D8;
        }

        .login-container .divider {
            width: 100%;
            height: 1px;
            background-color: #D8D8D8;
        }

        .login-container .password-container {
            position: relative;
        }

        .login-container .password-icon {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            width: 24px;
            height: 24px;
        }

        .login-container .login-btn {
            width: 100%;
            padding: 12px;
            background-color: #000;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 16px;
        }

        .login-container .login-btn:hover {
            background-color: #4B4B4B;
        }

        .login-container .login-btn:disabled {
            background-color: #A3A3A3;
            cursor: not-allowed;
        }

        .login-container .guest-btn {
            width: 100%;
            padding: 12px;
            background-color: white;
            color: #000;
            font-weight: bold;
            text-transform: uppercase;
            border: 1px solid #000;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 16px;
        }

        .login-container .guest-btn:hover {
            background-color: #D3D3D3;
        }

        .login-container .or-container {
            position: relative;
            margin: 24px 0;
            text-align: center;
        }

        .login-container .or-text {
            background-color: white;
            padding: 0 8px;
            font-size: 13px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .login-container .or-line {
            width: 100%;
            height: 1px;
            background-color: #6D6D6D;
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        .login-container .forgot-password {
            font-size: 0.875rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 12px;
        }

        .login-container .register-link {
            text-align: center;
            margin-top: 16px;
        }

        .login-container .register-now {
            font-size: 0.875rem;
            font-weight: bold;
            text-decoration: underline;
            cursor: pointer;
        }

        .login-container .form-label {
            margin: 16px 0;
            margin-top: 16px;
            margin-bottom: 16px;
            width: 100%;
        }

        .login-container .otp-form {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            width: 100%;
        }

        .login-container .otp-container,
        .login-container .email-otp-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .login-container .otp-input,
        .login-container .email-otp-input {
            width: 40px;
            height: 40px;
            text-align: center;
            font-size: 18px;
            margin: 0 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s;
        }

        .login-container .otp-input:focus,
        .login-container .email-otp-input:focus {
            border-color: #007bff;
        }

        .login-container #verificationCode,
        .login-container #emailverificationCode {
            width: 100%;
            margin-top: 15px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            transition: border-color 0.3s;
        }

        .login-container #verificationCode:focus,
        .login-container #emailverificationCode:focus {
            border-color: #007bff;
        }

        .login-container .email-otp {
            margin-top: 25px;
        }

        .login-container button {
            margin-top: 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        body.blurred>*:not(.login-container) {
            pointer-events: none;
        }

        .sso-container {
            display: flex;
            justify-content: center;
            gap: 16px;
            margin: 20px 0;
        }

        .sso-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 1px solid #D8D8D8;
            background: white;
            transition: all 0.3s;
        }

        .sso-btn:hover {
            background: #f5f5f5;
            transform: translateY(-2px);
        }

        .sso-btn img {
            width: 24px;
            height: 24px;
        }

        #loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
</head>

<body>
    <div id="fai_init"></div>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <!-- Container untuk ListTableBuilder -->
                <div id="my-table-container"></div>
            </div>
        </div>
    </div>

    <!-- Modal untuk FormBuilder -->
    <div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Form Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="data-form">
                    <div class="modal-body">
                        <!-- Form fields will be injected here by FormBuilder -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Loading Overlay -->
    <div id="loading-overlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Image Popup -->
    <div id="popup" onclick="closePopup(event)">
        <div class="zoom-controls">
            <button class="zoom-btn" type="button" onclick="zoomIn(event)">🔍＋</button>
            <button class="zoom-btn" type="button" onclick="zoomOut(event)">🔍－</button>
        </div>
        <span class="popup-close" onclick="closePopup()">×</span>
        <img id="popup-img" src="" alt="Popup Gambar" style="transform: scale(3.2) translate(0px); transform-origin: 60.6748% 58.3089% 0px;">
    </div>

    <!-- Login Container -->
    <div id="login-builder-container"></div>

    <!-- Hidden Inputs -->
    <input type="hidden" id="template" value="<?php echo base_url(); ?>">
    <input type="hidden" id="base_template" value="<?php echo base_url(); ?>">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <input type="hidden" id="base_url_object" value="index.php/FaiServer/app2">
    <input type="hidden" id="base_url_non_index" value="<?php echo str_replace('index.php/', '', base_url()); ?>">

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@fingerprintjs/fingerprintjs@3/dist/fp.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Fungsi untuk popup gambar
        function closePopup(event) {
            if (!event || event.target.id === 'popup') {
                document.getElementById('popup').style.display = 'none';
                document.body.classList.remove('no-scroll');
            }
        }

        function zoomIn(event) {
            event.stopPropagation();
            const img = document.getElementById('popup-img');
            const currentScale = parseFloat(img.style.transform.match(/scale\(([^)]+)\)/)[1]);
            img.style.transform = img.style.transform.replace(/scale\([^)]+\)/, `scale(${currentScale + 0.2})`);
        }

        function zoomOut(event) {
            event.stopPropagation();
            const img = document.getElementById('popup-img');
            const currentScale = parseFloat(img.style.transform.match(/scale\(([^)]+)\)/)[1]);
            if (currentScale > 0.4) {
                img.style.transform = img.style.transform.replace(/scale\([^)]+\)/, `scale(${currentScale - 0.2})`);
            }
        }

        // Fungsi untuk menampilkan gambar di popup
        function showImagePopup(imageSrc) {
            const popup = document.getElementById('popup');
            const popupImg = document.getElementById('popup-img');

            popupImg.src = imageSrc;
            popupImg.style.transform = 'scale(1) translate(0px)';
            popupImg.style.transformOrigin = 'center';

            popup.style.display = 'flex';
            document.body.classList.add('no-scroll');
        }

        // Inisialisasi tooltip Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    <script type="module">
        import {
            FaiFramework
        } from '<?php echo str_replace('index.php/', '', base_url()); ?>FaiFramework2/JSFramework/FaiFramework.js';
        const base_url = document.getElementById('base_url').value;
        const base_url_non_index = document.getElementById('base_url_non_index').value;
        const base_url_object = document.getElementById('base_url_object').value;
        window.fai = new FaiFramework();
        await window.fai.init("fai_init", "moesneeds.id", 'v1.0.4-alpha41', base_url, base_url_non_index, base_url_object);
        await window.fai.setupFullWebContent();
        /*
        const crudArray = [
          ['ID', 'id', 'number-list'],
          ['Judul', 'title', 'text-list-crud-req'],
          ['Deskripsi', 'description', 'textarea-list-crud-req'],
          ['Jumlah', 'amount', 'currency-list-crud-req'],
          ['Status', 'status', 'select_manual-list', {
            pending: 'Pending',
            approved: 'Approved',
            rejected: 'Rejected',
            processed: 'Processed'
          }],
        ];


        fai.crud(crudArray);
        */
    </script>