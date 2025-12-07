<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    .order-container {
        font-family: 'Poppins', sans-serif;
        background-color: #f0f2f5;
        margin: 0;
        padding: 20px;
        color: #333;
    }

    .order-container {
        max-width: 90%;
        margin: 0 auto;
        background-color: #fff;
        padding: 24px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    h1 {
        font-size: 24px;
        color: #1a1a1a;
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
    }

    h1 i {
        color: #ff6600;
        margin-right: 10px;
    }

    .order-tabs {
        display: flex;
        overflow-x: auto;
        border-bottom: 2px solid #e0e0e0;
        margin-bottom: 20px;
    }

    .tab-button {
        padding: 10px 20px;
        font-size: 15px;
        font-weight: 500;
        cursor: pointer;
        background-color: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        color: #666;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .tab-button:hover {
        color: #ff6600;
    }

    .tab-button.active {
        color: #ff6600;
        border-bottom: 3px solid #ff6600;
    }

    .order-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .order-card {
        background-color: #ffffff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 16px;
        transition: box-shadow 0.3s ease;
    }

    .order-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }

    .shop-info {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }

    .status {
        font-size: 14px;
        font-weight: 600;
    }

    .status-selesai {
        color: #28a745;
    }

    .status-dikirim {
        color: #17a2b8;
    }

    .status-dibatalkan {
        color: #dc3545;
    }

    /* BARU: Kontainer untuk beberapa produk */
    .product-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
        /* Jarak antar produk dalam satu pesanan */
        border-top: 1px solid #f0f0f0;
        padding-top: 16px;
    }

    .product-item {
        display: flex;
        gap: 12px;
    }

    .product-item img {
        width: 80px;
        height: 80px;
        border-radius: 4px;
        object-fit: cover;
        border: 1px solid #eee;
    }

    .product-details {
        flex-grow: 1;
    }

    .product-name {
        font-weight: 500;
        margin: 0 0 4px 0;
    }

    .product-variant,
    .product-qty {
        font-size: 14px;
        color: #666;
        margin: 0;
    }

    /* DIMODIFIKASI: Penataan ringkasan pesanan */
    .card-summary {
        text-align: right;
        padding-top: 16px;
        border-top: 1px solid #f0f0f0;
        margin-top: 16px;
        margin-bottom: 16px;
    }

    /* BARU: Teks untuk jumlah produk */
    .product-count {
        font-size: 14px;
        color: #666;
        margin: 0 0 8px 0;
    }

    .total-price {
        font-size: 18px;
        font-weight: 700;
        color: #ff6600;
    }

    .card-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .btn {
        padding: 8px 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.2s ease;
    }

    .btn-primary {
        background-color: #ff6600;
        color: white;
        border-color: #ff6600;
    }

    .btn-primary:hover {
        background-color: #e65c00;
    }

    .btn-secondary {
        background-color: white;
        color: #333;
        border: 1px solid #ccc;
    }

    .btn-secondary:hover {
        background-color: #f5f5f5;
    }

    .order-card.hidden {
        display: none;
    }
</style>