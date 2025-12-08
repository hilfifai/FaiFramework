<tr id="store_cart-<ID-CART></ID-CART>">

    <td>
        <label class="form-check">
            <input type="checkbox" name="form-project-manager[]" id="bismillah_beli-<ID-CART></ID-CART>" class="form-check-input" value="<ID-CART></ID-CART>" onclick="cek_harga(<ID-CART></ID-CART>);" <CHECKED></CHECKED>>

        </label>
    </td>
    <td class="cart__product__item">
        <div style="width:30%;margin: 10px;border-radius: 100%;" id="image_cart-<ID-CART></ID-CART>">
            <IMAGE-CART></IMAGE-CART>
        </div>
    </td>
    <td class="cart__product__item">

        <input type="hidden" id="is_varian-<ID-CART></ID-CART>" value="<IS_VARIAN></IS_VARIAN>">
        <input type="hidden" id="max_varian-<ID-CART></ID-CART>" value="<MAX_VARIAN></MAX_VARIAN>">

        <img src="img/shop-cart/cp-1.jpg" alt="">
        <div class="cart__product__item__title">
            <h6><NAMA-PRODUK></NAMA-PRODUK></h6>
            Varian : <div id="nama-varian-<ID-CART></ID-CART>"><NAMA-VARIAN></NAMA-VARIAN></div>
            <VARIAN></VARIAN>
            <IF-VARIAN></IF-VARIAN>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
            </div>
        </div>
    </td>
    <td class="cart__price" id="satuan-harga-<ID-CART></ID-CART>"><HARGA-SATUAN></HARGA-SATUAN> </td>
    <td class="cart__quantity">
        <div class="pro-qty">
            <input type="text" id="set_qty-<ID-CART></ID-CART>" value="<QTY></QTY>" onkeyup="cek_harga('<ID-CART></ID-CART>')" onchange="cek_harga('<ID-CART></ID-CART>');">
        </div>
    </td>
    <td class="cart__total"><span id="view-harga-<ID-CART></ID-CART>">
            <HARGA></HARGA>
        </span></td>
    <td class="cart__close"><span class="icon_close" onclick="delete_cart(<ID-CART></ID-CART>)"></span></td>
</tr>