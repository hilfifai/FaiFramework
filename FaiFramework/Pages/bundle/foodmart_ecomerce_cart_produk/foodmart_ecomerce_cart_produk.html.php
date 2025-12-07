<div class="col-md-12 mt-3 card" id="store_cart-<ID-CART></ID-CART>">
    <div class="row">
        <div class="col-2" style="
                                        align-items: center;
                                        justify-content: center;
                                        display: flex;
                                    ">
            <label class="form-check">
                <input type="checkbox" style="border:1px solid black" name="form-project-manager[]" id="bismillah_beli-<ID-CART></ID-CART>" class="form-check-input cart-produk" value="<ID-CART></ID-CART>" onclick="js_cek_harga(<ID-CART></ID-CART>);" <CHECKED></CHECKED>>

            </label>
            <div class="cart__close"><a href="javascript:void(0)" class="icon_close" onclick="js_delete_cart(<ID-CART></ID-CART>)"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7l16 0" />
                        <path d="M10 11l0 6" />
                        <path d="M14 11l0 6" />
                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                    </svg></a></div>

        </div>
        <div class="col-3 cart__product__item">
            <div style="margin: 10px 0;border-radius: 100%;" id="image_cart-<ID-CART></ID-CART>">
                <img src="<IMAGE-CART></IMAGE-CART>">
            </div>
        </div>
        <div class=" col-7 cart__product__item p-2">

            <input type="hidden" id="is_varian-<ID-CART></ID-CART>" value="<IS_VARIAN></IS_VARIAN>">
            <input type="hidden" id="max_varian-<ID-CART></ID-CART>" value="<MAX_VARIAN></MAX_VARIAN>">


            <div class="cart__product__item__title">
                <h6><NAMA-PRODUK></NAMA-PRODUK></h6>
                Varian : <Span id="nama-varian-<ID-CART></ID-CART>"><NAMA-VARIAN></NAMA-VARIAN></span>
                <div class="">
                    <span class="cart__price" id="satuan-harga-<ID-CART></ID-CART>"><HARGA-SATUAN></HARGA-SATUAN> </span>
                    <input class="cart__price" id="satuan-harga-val<ID-CART></ID-CART>" value="<HARGA-SATUAN></HARGA-SATUAN>" type="hidden">
                    <span class="cart__price" id="stok-<ID-CART></ID-CART>" style="text-align: right;float: right;margin: 0 25px;">Stok: <STOK></STOK>
                    </span>
                </div>
                <input class="cart__price" id="stok-val<ID-CART></ID-CART>" value="<STOK></STOK>" type="hidden">

            </div>
            <div class="cart__quantity">
                <div class="pro-qty">
                    <input type="text" class="form-control" id="set_qty-<ID-CART></ID-CART>" value="<QTY></QTY>" onkeyup="js_cek_harga('<ID-CART></ID-CART>')" onchange="js_cek_harga('<ID-CART></ID-CART>');">
                </div>
            </div>
            <div class="cart__total"><span id="view-harga-<ID-CART></ID-CART>">
                    <HARGA></HARGA>
                </span></div>

        </div>
        <div class="col-md-1">

        </div>
    </div>
    <input type="hidden" name="varian_<ID-CART></ID-CART>[1]" id="varian-1-<ID-CART></ID-CART>" value="<VARIAN1><VARIAN1>" />
    <input type="hidden" name="varian_<ID-CART></ID-CART>[2]" id="varian-2-<ID-CART></ID-CART>" value="<VARIAN2><VARIAN2>" />
    <input type="hidden" name="varian_<ID-CART></ID-CART>[3]" id="varian-3-<ID-CART></ID-CART>" value="<VARIAN3><VARIAN3>" />
</div>