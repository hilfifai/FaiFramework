<?php
?>
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
    <link style="<?=  base_url() ?>FaiFramework/Pages/OrderSystem/style.css" rel="stylesheet">
    <link style="<?=  base_url() ?>FaiFramework/Pages/_template/select_search/style.css" rel="stylesheet">

    <style>
        /* SELECT SEARCH CSS */
.select-search-container {
    position: relative;
    width: 100%;
    margin-bottom: 1rem;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.select-search-box {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border: 1px solid #d1d5db;
    border-radius: 0.5rem;
    background-color: white;
    cursor: pointer;
    user-select: none;
    min-height: 48px;
    position: relative;
    transition: all 0.2s ease;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.select-search-box:hover {
    border-color: #9ca3af;
}

.select-search-box.open {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
}

.select-search-box.disabled {
    background-color: #f3f4f6;
    cursor: not-allowed;
    opacity: 0.6;
}

.select-search-placeholder {
    color: #9ca3af;
    flex-grow: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    padding-right: 1.5rem;
}

.select-search-placeholder.has-value {
    color: #374151;
}

.select-search-arrow {
    color: #6b7280;
    font-size: 0.75rem;
    transition: transform 0.2s ease;
    flex-shrink: 0;
}

.select-search-box.open .select-search-arrow {
    transform: rotate(180deg);
}

.select-search-clear {
    position: absolute;
    right: 2.5rem;
    color: #9ca3af;
    cursor: pointer;
    font-size: 1.25rem;
    line-height: 1;
    padding: 0.25rem;
    display: none;
    z-index: 1;
}

.select-search-clear:hover {
    color: #ef4444;
}

.select-search-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.375rem;
    flex-grow: 1;
}

.select-search-tag {
    background-color: #dbeafe;
    color: #1e40af;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    max-width: 200px;
}

.select-search-remove-tag {
    cursor: pointer;
    font-size: 1.125rem;
    line-height: 1;
    padding-left: 0.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.select-search-remove-tag:hover {
    color: #dc2626;
}

.select-search-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background-color: white;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    z-index: 50;
    max-height: 300px;
    overflow: hidden;
    display: none;
    margin-top: 0.25rem;
}

.select-search-dropdown.open {
    display: block;
}

.select-search-input {
    padding: 0.75rem 1rem;
    border: none;
    border-bottom: 1px solid #e5e7eb;
    width: 100%;
    font-size: 0.875rem;
    outline: none;
    box-sizing: border-box;
}

.select-search-input:focus {
    border-bottom-color: #3b82f6;
}

.select-search-options {
    list-style: none;
    margin: 0;
    padding: 0;
    max-height: 250px;
    overflow-y: auto;
}

.select-search-option {
    padding: 0.75rem 1rem;
    cursor: pointer;
    transition: background-color 0.15s ease;
    font-size: 0.875rem;
    border-bottom: 1px solid #f3f4f6;
}

.select-search-option:last-child {
    border-bottom: none;
}

.select-search-option:hover {
    background-color: #f3f4f6;
}

.select-search-option.selected {
    background-color: #eff6ff;
    color: #1e40af;
    font-weight: 500;
}

.select-search-option.disabled {
    color: #9ca3af;
    cursor: not-allowed;
    background-color: #f9fafb;
}

.select-search-option.disabled:hover {
    background-color: #f9fafb;
}

.select-search-highlight {
    background-color: #fef3c7;
    font-weight: 600;
    padding: 0 1px;
    border-radius: 2px;
}

.select-search-loading,
.select-search-no-results {
    padding: 1.5rem 1rem;
    text-align: center;
    color: #6b7280;
    font-size: 0.875rem;
}

.select-search-info {
    padding: 0.75rem 1rem;
    border-top: 1px solid #e5e7eb;
    font-size: 0.75rem;
    color: #6b7280;
    background-color: #f9fafb;
    display: none;
}

.select-search-info.error {
    color: #dc2626;
    background-color: #fee2e2;
}

.select-search-info.success {
    color: #059669;
    background-color: #d1fae5;
}

/* Responsive */
@media (max-width: 640px) {
    .select-search-dropdown {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90vw;
        max-width: 400px;
        max-height: 70vh;
    }
    
    .select-search-tag {
        max-width: 150px;
    }
}
/* --- Reset & Base Styles --- */
.dropdown-container-be3 {
  position: relative;
  display: inline-block;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

/* --- Menghilangkan panah default pada tag <details/summary> --- */
details > summary {
  list-style: none;
  cursor: pointer;
}

details > summary::-webkit-details-marker {
  display: none;
}

/* --- Avatar Style (Trigger) --- */
.avatar img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #e2e8f0; /* Border halus */
  transition: all 0.2s ease;
}

.avatar img:hover {
  border-color: #cbd5e0;
  box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2); /* Efek glow saat hover */
}

/* --- Dropdown Menu Container (UL) --- */
details ul {
  position: absolute;
  top: 100%; /* Posisi tepat di bawah avatar */
  margin-top: 10px; /* Jarak sedikit dari avatar */
  right: 0; /* Align ke kanan karena class .right */
  width: 240px; /* Lebar dropdown */
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  border: 1px solid #f1f1f1;
  padding: 8px 0;
  list-style: none;
  z-index: 1000;
  
  /* Animasi Sederhana saat muncul */
  transform-origin: top right;
  animation: fadeIn 0.2s ease-out;
}

/* Panah kecil (segitiga) di atas box dropdown - Opsional */
details ul::before {
  content: "";
  position: absolute;
  top: -6px;
  right: 14px;
  width: 12px;
  height: 12px;
  background: #fff;
  transform: rotate(45deg);
  border-left: 1px solid #f1f1f1;
  border-top: 1px solid #f1f1f1;
}

/* --- User Info Section (Header Menu) --- */
details ul li:first-child {
  padding: 8px 20px 12px 20px;
  border-bottom: 1px solid #f1f1f1;
  margin-bottom: 8px;
  background-color: #fcfcfc; /* Sedikit beda warna */
  border-radius: 8px 8px 0 0;
}

details ul li p {
  margin: 0;
  line-height: 1.4;
  color: #2d3748;
}

/* --- Typography Helpers --- */
.block {
  display: block;
}

.bold {
  font-weight: 600;
  font-size: 14px;
  color: #1a202c;
}

.italic {
  font-style: italic;
  font-size: 12px;
  color: #718096;
}

/* --- Menu Links --- */
details ul li a {
  display: block;
  padding: 8px 20px;
  font-size: 14px;
  color: #4a5568;
  text-decoration: none;
  transition: background-color 0.2s;
}

details ul li a:hover {
  background-color: #f7fafc;
  color: #2b6cb0;
}

/* --- Divider --- */
.divider {
  height: 1px;
  background-color: #e2e8f0;
  margin: 8px 0;
}

/* --- Custom Elements (be3 tags) --- */
be3-nama-lengkap,
be3-panel {
  display: inline;
}

/* --- Keyframes Animation --- */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: scale(0.95) translateY(-10px);
  }
  to {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}
        /* .blurred > * {
    filter: blur(5px); 
    transition: filter 0.3s ease; 
} */
    .login-container {
    /* Properti lain untuk elemen */
    /* ... */
    
    /* Syntax: H-offset V-offset Blur-radius Spread-radius Color */
    box-shadow: 0 8px 30px 6px rgba(0, 0, 0, 0.25);
}
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

        /* Container Utama */
        .discount__content {
            background: #fdfdfd;
            padding: 20px;
            border: 1px solid #eee;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        /* Judul Voucher */
        .discount__content h6 {
            color: #1c1c1c;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 15px;
            font-size: 14px;
            letter-spacing: 1px;
        }

        /* Form Wrapper - Menggunakan Relative Positioning */
        .discount__content form {
            position: relative;
            width: 100%;
            margin-bottom: 15px;
        }

        /* Input Field */
        .discount__content form input {
            width: 100%;
            height: 50px;
            font-size: 14px;
            color: #444;
            padding-left: 20px;
            padding-right: 100px;
            /* Memberi ruang untuk tombol di kanan */
            border: 1px solid #ddd;
            border-radius: 50px;
            /* Bentuk Pill/Oval */
            outline: none;
            transition: all 0.3s;
            background: #fff;
        }

        .discount__content form input:focus {
            border-color: #e3a53e;
            /* Merah saat aktif */
        }

        /* Tombol Apply */
        .discount__content form .site-btn {
            position: absolute;
            right: 4px;
            top: 4px;
            height: 42px;
            /* Sedikit lebih kecil dari input */
            border: none;
            background: #e3a53e;
            /* Warna utama */
            color: #ffffff;
            padding: 0 25px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
        }

        .discount__content form .site-btn:hover {
            background: #a31111;
        }

        /* --- Styling untuk Custom Tags (Voucher Aktif & List) --- */

        /* Voucher yang sedang digunakan (Success Alert style) */
        voucher_digunakan {
            display: block;
            margin-top: 10px;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 13px;
        }

        /* List Voucher yang tersedia */
        voucher_list {
            display: block;
            margin-top: 15px;
            border-top: 1px dashed #ddd;
            padding-top: 10px;
        }

        /* Contoh jika voucher list berisi item (div/li) */
        voucher_list>div {
            padding: 8px 0;
            font-size: 13px;
            color: #666;
            border-bottom: 1px solid #f1f1f1;
        }

        /* Reset dasar untuk elemen terkait */
        .product__details__button,
        .product__details__button * {
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
            /* Ganti dengan font website Anda */
        }

        /* Container Utama */
        .product__details__button {
            display: flex;
            align-items: center;
            gap: 20px;
            /* Jarak antara quantity dan tombol */
            margin-top: 20px;
            flex-wrap: wrap;
            /* Agar responsif di layar kecil */
        }

        /* Bagian Quantity */
        .quantity {
            display: flex;
            align-items: center;
        }

        .quantity span {
            font-weight: 600;
            color: #333;
            margin-right: 10px;
        }

        /* Wrapper Input Quantity */
        .pro-qty {
            width: 100px;
            /* Lebar area input */
            height: 50px;
            display: inline-block;
            position: relative;
            background: #f5f5f5;
            /* Background abu-abu muda */
            border-radius: 25px;
            /* Membuat bentuk oval/pill */
            overflow: hidden;
            border: 1px solid #ddd;
        }

        .pro-qty input {
            height: 100%;
            width: 100%;
            text-align: center;
            font-size: 16px;
            color: #444;
            font-weight: 600;
            border: none;
            background: transparent;
            outline: none;
        }

        /* Tombol Add to Cart */
        .cart-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            color: #ffffff;
            background: #e3a53e;
            /* Warna Merah Utama (Bisa diganti) */
            padding: 14px 30px;
            border-radius: 50px;
            /* Tombol bulat */
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(202, 21, 21, 0.3);
        }

        .cart-btn span {
            margin-right: 5px;
            font-size: 18px;
            margin-bottom: 3px;
            /* Penyesuaian ikon */
        }

        /* Efek Hover Tombol */
        .cart-btn:hover {
            background: #a31111;
            /* Warna lebih gelap saat hover */
            transform: translateY(-2px);
            /* Efek naik sedikit */
            box-shadow: 0 8px 20px rgba(202, 21, 21, 0.4);
        }

        /* Responsif untuk HP */
        @media (max-width: 480px) {
            .product__details__button {
                justify-content: center;
            }

            .quantity {
                margin-bottom: 15px;
            }
        }

        /* 1. Container Utama - Posisi Fixed di Pojok Kanan Atas */
        #alertContainer {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            width: 100%;
            max-width: 350px;
            /* Lebar maksimal toast */
            display: flex;
            flex-direction: column;
            gap: 10px;
            /* Jarak antar toast jika muncul lebih dari satu */
            pointer-events: none;
            /* Agar area kosong tidak memblokir klik di belakangnya */
        }

        /* 2. Style Dasar Alert (Toast) */
        .alert-global {
            position: relative;
            padding: 16px;
            padding-right: 40px;
            /* Ruang untuk tombol close */
            margin-bottom: 0;
            border: none;
            border-radius: 8px;
            /* Sudut melengkung */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            /* Efek melayang */
            color: #fff;
            /* Teks warna putih */
            font-size: 14px;
            pointer-events: auto;
            /* Mengaktifkan klik pada alert */
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease-in-out;
        }

        /* Animasi untuk Bootstrap 'show' */
        .alert-global.show {
            opacity: 1;
            transform: translateX(0);
        }

        /* 3. Tombol Close (Menyesuaikan agar berwarna putih) */
        .alert-global .btn-close {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            filter: invert(1) grayscale(100%) brightness(200%);
            /* Membuat icon X menjadi putih */
            opacity: 0.8;
        }

        .alert-global .btn-close:hover {
            opacity: 1;
        }

        /* 4. Varian Warna (Success, Danger, Primary, Default) */

        /* Success - Hijau */
        .global-alert-success {
            background-color: #28a745;
            /* Bisa diganti #198754 (Bootstrap 5) */
            background-image: linear-gradient(45deg, #28a745, #34ce57);
        }

        /* Danger - Merah */
        .global-alert-danger {
            background-color: #dc3545;
            background-image: linear-gradient(45deg, #dc3545, #e4606d);
        }

        /* Primary - Biru */
        .global-alert-primary {
            background-color: #0d6efd;
            background-image: linear-gradient(45deg, #0d6efd, #4690ff);
        }

        /* Default - Abu-abu gelap */
        .global-alert-default {
            background-color: #343a40;
            background-image: linear-gradient(45deg, #343a40, #4b545c);
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
    <div id="alertContainer"></div>
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
        } from '../FaiFramework2/JSFramework/FaiFramework.js';
        const base_url = document.getElementById('base_url').value;
        const base_url_non_index = document.getElementById('base_url_non_index').value;
        const base_url_object = document.getElementById('base_url_object').value;
        window.fai = new FaiFramework();
        var option = {
            pending_order: true
        }
        await window.fai.init("fai_init", option, "moesneeds.id", 'v1.0.4-alpha46',

            base_url, base_url_non_index, base_url_object);
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
</body>

</html>