<div class="card">
        <img src="!!IMG-SRC!!" style="width:100%;height: 250px;object-fit: cover;";>
        <div class="card-body" style="padding: 12px;">
        <h5 class="card-title font-sm" style="font-size: 13px;font-weight: 700;">!!NAMA-BARANG!!</h5>
        <p class="card-text font-sm" style="font-size: 11px;">Varian:<br>!!NAMA-VARIAN!!</p>
       <div class="input-group product-qty">
                             <span class="input-group-btn">
                                   <button type="button" class="quantity-left-minus btn-sm btn btn-primary btn-number" data-type="minus">
                                     -
                                   </button>
                               </span>
                               <input type="text" id="quantity-!!ID_ASSET!!-!!ID_PRODUK!!-!!ID_ASSET_VARIAN!!-!!ID_PRODUK_VARIAN!!-!!ID_VARIAN1!!-!!ID_VARIAN2!!-!!ID_VARIAN3!!" name="quantity" class="form-control input-number" value="1">
                               <span class="input-group-btn">
                                   <button type="button" class="quantity-right-plus btn-sm btn btn-primary btn-number" data-type="plus">
                                       +
                                   </button>
                               </span>
                           </div> 
       <button  type="button" style="padding: 0px !important;border-radius: 20px;line-height: 1px;margin-top: 7px;  height: 30px;" onclick="tambah_produk_indexed_db(!!ID_ASSET!!,!!ID_PRODUK!!,'!!ID_ASSET_VARIAN!!','!!ID_PRODUK_VARIAN!!','!!ID_VARIAN1!!','!!ID_VARIAN2!!','!!ID_VARIAN3!!','!!NAMA-BARANG!!','!!NAMA-VARIAN!!','!!IMG-SRC!!','!!HARGA!!','','!!BERAT!!',)"  class="btn btn-outline-primary btn-xs">Tambahkan Produk</a>
        </div>
    </div>