

<div id="store_cart-<ID-CART></ID-CART>">
    <div>
        <label class="form-selectgroup-item flex-fill" style="margin-right: 10px;;
  margin-top: 25px;">
            <input type="checkbox" name="form-project-manager[]" id="bismillah_beli-<ID-CART></ID-CART>" class="form-selectgroup-input" value="<ID-CART></ID-CART>" onclick="cek_harga(<ID-CART></ID-CART>);" <CHECKED></CHECKED>>
            <div class="form-selectgroup-label d-flex align-items-center p-3" style="border-radius: 20px;padding-bottom:0px">
                <div class="me-1">
                    <span class="form-selectgroup-check">
                    </span>
                </div>
                <div class="form-selectgroup-label-content d-flex" style=" width: 100%;">
                     <input type="hidden" id="is_varian-<ID-CART></ID-CART>" value="<IS_VARIAN></IS_VARIAN>">
                     <input type="hidden" id="max_varian-<ID-CART></ID-CART>" value="<MAX_VARIAN></MAX_VARIAN>">
                     <input type="hidden" id="list_diskon-<ID-CART></ID-CART>" value="<LIST-DISKON></LIST-DISKON>">
                <div style="width:30%;margin: 10px;border-radius: 100%;" id="image_cart-<ID-CART></ID-CART>">
                        <IMAGE-CART></IMAGE-CART>
                        </div>
                    <div class="row ms-2" style="width: 100%;">
                        <div class="font-weight-medium pb-2 d-flex" style="font-weight: 700;">
                            <NAMA-PRODUK></NAMA-PRODUK> <span class="ms-auto">
                            
                            <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip" onclick="delete_cart(<ID-CART></ID-CART>)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 icon-xs"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                <div id="trashOne" class="d-none">
                                  <span>Delete</span>
                                </div>
                              </a>
                            </span>
                            <IF-VARIAN></IF-VARIAN>
                        </div>




                        <div class="row pe-10 ">
                            <VARIAN></VARIAN>
                            <div id="nama-varian-<ID-CART></ID-CART>"><NAMA-VARIAN></NAMA-VARIAN></div>
                        </div>

                        <div class="add-to-cart ">
                            <div class="qty-label" style="font-weight: bold;">

                                <div class="input-number" style="width: 90px;">

                                    <input type="number" style="" id="set_qty-<ID-CART></ID-CART>" value="<QTY></QTY>" onkeyup="cek_harga('<ID-CART></ID-CART>')" onchange="cek_harga('<ID-CART></ID-CART>');">
                                    <span class="qty-up" style="color: #555;">+</span>
                                    <span class="qty-down" style="color: #555;">-</span> 
                                </div>
                            </div>

                        </div>
                        <h3 class="text-teal pt-2" style="padding-bottom: 0;margin-bottom: 0;">
                            <span id="view-harga-<ID-CART></ID-CART>">
                                <HARGA></HARGA>
                            </span>
                        </h3>
                    </div>

                </div>


            </div>

            
        </label>
    </div>
</div>