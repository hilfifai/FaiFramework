<style>
    body,
    p,
    h5,
    label {
        color: #000 !important;
    }

    .heading-h5 {
        font-size: 1rem;
        /* Sesuaikan ukuran font sesuai tampilan h5 yang diinginkan */
        font-weight: 500;
        /* Atur ketebalan font jika perlu */
        line-height: 1.2;
        /* Sesuaikan jarak antar baris */
        margin-bottom: 0.5rem;
        /* Atur margin bawah agar mirip dengan h5 */
    }

    .detail-text {
        font-size: 12px;
        line-height: 1;
        text-align: justify;
        margin: 0;
        /* Menghilangkan margin default container */
        font-weight: normal;
        /* Teks non-judul tampil normal */
    }

    /* Atur judul (h1-h6) agar tampil bold dan dengan margin minimal */
    .detail-text h1,
    .detail-text h2,
    .detail-text h3,
    .detail-text h4,
    .detail-text h5,
    .detail-text h6 {
        font-size: 12px;
        line-height: 1.2;
        margin: 2px 0;
        /* Margin minimal antar judul */
        font-weight: bold;
    }

    /* Atur paragraf dengan margin minimal */
    .detail-text p {
        margin: 2px 0;
        line-height: 1.2;
    }

    /* Atur daftar (ordered dan unordered) dengan padding dan margin minimal */
    .detail-text ol,
    .detail-text ul {
        padding-left: 20px;
        margin: 2px 0;
        line-height: 1.2;
    }

    /* Atur jarak antar item dalam daftar */
    .detail-text li {
        margin: 1px 0;
        line-height: 1.2;
    }

    /* Jika ada elemen lain (misalnya blockquote) dapat ditambahkan aturan serupa, contoh: */
    .detail-text blockquote {
        margin: 2px 0;
        padding-left: 15px;
        border-left: 2px solid #ccc;
    }

    /* Kartu layanan */
    .layanan-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        transition: box-shadow 0.3s, background-color 0.3s, border-color 0.3s;
        cursor: pointer;
        padding: 10px;
        background-color: #fff;
        margin-bottom: 10px;
    }

    .layanan-card.selected {
        border-color: #28a745;
        background-color: #e9f7ef;
    }

    .layanan-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .layanan-icon {
        max-width: 30px;
        margin-right: 10px;
    }

    .nama-layanan-form {
        font-size: 12px;
        font-weight: 600;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .payment-price,
    .nominal-price {
        font-size: 12px;
        color: #006631;
    }

    .info-metode {
        color: #6a6a6a;
    }

    /* Style untuk metode pembayaran */
    .badge-square {
        background-color: #006631;
        color: #fff;
    }

    .btn-green {
        background-color: #006631;
    }

    /* Style untuk detail kategori */
    .detail-text {
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    /* Pada mobile: default collapsed (hanya menampilkan beberapa baris) */
    @media (max-width: 767px) {
        .detail-text.collapsed {
            max-height: 100px;
            /* sesuaikan tinggi sesuai kebutuhan */
        }
    }

    /* Pada desktop: default expanded (tampil penuh), namun bisa di-collapse */
    @media (min-width: 768px) {
        .detail-text.collapsed {
            max-height: 200px;
            /* contoh tinggi jika user menekan "Sembunyikan" */
        }
    }

    /* Style untuk tautan toggle */
    #toggleDetailLink {
        color: #006631;
        font-weight: bold;
        cursor: pointer;
        text-decoration: none;
    }

    #payment {
        color: #b41414;
    }

    .list-group1 input[type="radio"]:checked+.list-group-item:before {
        color: inherit;
    }

    .list-group1 input[type="radio"]:checked+.list-group-item {
        background-color: #ffffff;
        color: #0297da;
        font-size: 12px;
        display: block;
        -webkit-filter: grayscale(0%);
        /* Safari 6.0 - 9.0 */
        filter: grayscale(0%);
    }

    .list-group1 input[type="radio"]+.list-group-item:hover {
        cursor: pointer;
        background-color: #ffffff;
        color: #0297da;
        border-color: #ffffff;
        box-shadow: 0 1px 1px 0 rgba(0, 0, 0, 0.2), 0 2px 5px 0 rgba(0, 0, 0, 0.19);
        font-size: 12px;
        border-radius: 3px;
    }

    .list-group1 input[type="radio"]:checked+.list-group-item:before {
        color: inherit;
    }

    .list-group-item {
        user-select: none;
    }

    .paymentSort {
        font-size: 9px;
        font-style: italic;
        color: #0297da;
    }



    .child-box {
        border: 1px solid #e0e0e0;
        margin-bottom: 18px;
        border-radius: 7px !important;
        background: rgba(235, 235, 235, 0.035);
    }

    .child-box:hover {
        border: 1px solid #26CFC5;
    }

    .button-action-payment li.active {
        border: 1px solid #0297da;
        background: rgb(232, 232, 232);
        filter: grayscale(0%);
    }

    .child-box .header {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: space-between;
        align-items: center;
        padding: 11px 15px;
        border-top-left-radius: 7px;
        border-top-right-radius: 7px;
        cursor: pointer;
        position: relative;
    }

    .child-box .header .left {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-content: center;
        justify-content: flex-start;
        align-items: center;
    }

    .child-box .button-action-payment {
        padding: 15px;
        display: none;
    }

    .child-box .short-payment-support-info {
        background: rgb(255 255 255);
        padding: 11px 15px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-end;
        align-items: center;
        cursor: pointer;
        border-bottom-left-radius: 7px;
        border-bottom-right-radius: 7px;
    }

    .child-box .short-payment-support-info img {
        height: 13px;
        margin-right: 7px;
    }

    .child-box .short-payment-support-info .open-button-action-payment {
        color: #414141;
        font-size: 13px;
        margin-left: 10px;
    }

    .child-box .short-payment-support-info {
        background: rgba(174, 174, 174, .261);
        padding: 11px 15px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        align-content: center;
        justify-content: flex-end;
        align-items: center;
        cursor: pointer;
        border-bottom-left-radius: 7px;
        border-bottom-right-radius: 7px;
    }

    .button-action-payment .info-top {
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: space-between;
        margin-bottom: 10px;
        padding-bottom: 10px;
    }

    .button-action-payment .info-top {
        font-size: 12px;
        font-weight: 600;
    }

    .radio-nominal {
        color: white;
        display: none;
        margin: 10px;
        cursor: pointer;
    }

    .radio-nominal:checked+label {
        text-align: center;
        background-image: none;
        background-color: #2a8a8a;
        color: white;
        cursor: pointer;
        border-radius: 5px;
        width: 49%;
        font-size: 14px;
        border-color: #2a8a8a;
    }

    .radio-nominal+label {
        text-align: center;
        color: #fff;
        display: inline-block;
        padding: 5px;
        background-color: #132239;
        border: 1px solid #2a8a8a;
        cursor: pointer;
        border-radius: 5px;
        width: 49%;
        font-size: 14px;
    }

    .radio-pembayaran {
        color: white;
        display: none;
        margin: 10px;
        cursor: pointer;
    }

    .radio-pembayaran:checked+label {
        background-image: none;
        background-color: #0297da;
        color: black;
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
        font-size: 14px;
        border-color: #0297da;
    }

    .radio-pembayaran+label {
        color: #000;
        display: inline-block;
        padding: 5px;
        background-color: #fff;
        border: 1px solid black;
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
        font-size: 14px;
    }

    .radio-pembayaran:hover+label {
        border-color: #0297da;
    }

    @media (min-width: 576px) {
        .radio-nominal:checked+label {
            width: 32%;
            font-size: 14px;
            padding: 5px;
        }

        .radio-nominal+label {
            width: 32%;
            font-size: 14px;
            padding: 5px;
        }

    }

    @media (min-width: 768px) {
        .radio-nominal:checked+label {
            width: 32%;
            font-size: 14px;
            padding: 5px;
        }

        .radio-nominal+label {
            width: 32%;
            font-size: 14px;
            padding: 5px;
        }
    }

    @media (min-width: 992px) {

        .radio-nominal:checked+label {
            width: 32%;
            font-size: 14px;
            padding: 5px;
        }

        .radio-nominal+label {
            width: 32%;
            font-size: 14px;
            padding: 5px;
        }

        .product-new {
            padding: 0.75rem !important;
            background: #fff;
            border-radius: 0.75rem !important;
            height: 100%;
            box-shadow: 0px 1px 5px rgba(31, 31, 31, 0.15);
        }

    }

    @media (min-width: 1200px) {
        .radio-nominal:checked+label {
            width: 24%;
            font-size: 14px;
            padding: 5px;
        }

        .radio-nominal+label {
            width: 24%;
            font-size: 14px;
            padding: 5px;
        }
    }

    .selected-pembayarandiv {
        background: floralwhite !important;;
        border: 1px solid orange !important;;
    }
</style>