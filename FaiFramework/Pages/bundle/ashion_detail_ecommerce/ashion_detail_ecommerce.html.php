<section class="product-details spad">
<div class="container">
<div class="row">
    <div class="col-lg-6">
        <div class="product__details__pic">
            <div class="product__details__pic__left product__thumb nice-scroll">
                <TUMB-LIST-ASHION></TUMB-LIST-ASHION>
            </div>
            <div class="product__details__slider__content">
                <div class="product__details__pic__slider owl-carousel" id="image_detail">
                     <IMG-LIST-ASHION></IMG-LIST-ASHION>
                    
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="product__details__text">
            <h3><NAMA-PRODUK></NAMA-PRODUK></h3>
            <div class="rating">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <span>( 0 reviews )</span>
            </div>
            <div class="product__details__price"> <div id="harga_akhir"><HARGA-AKHIR></HARGA-AKHIR></div> <span><HARGA-AWAL></HARGA-AWAL> </span></div>
           
<input type="hidden" id="id_asset" value="<ID-ASSET></ID-ASSET>">
<input type="hidden" id="id_produk" value="<ID-PRODUK></ID-PRODUK>">
<input type="hidden" id="id_asset_varian" value="">
<input type="hidden" id="id_produk_varian" value="">
<input type="hidden" id="id_varian_1" value="">
<input type="hidden" id="id_varian_2" value="">
<input type="hidden" id="id_varian_3" value="">
<input type="hidden" id="level" value="">
<input type="hidden" id="id_varian_list" value="">

            <div class="product__details__button">
                <div class="quantity">
                    <span>Quantity:</span>
                    <div class="pro-qty">
                        <input type="text" value="1"  id="set_qty">
                    </div>
                </div>
                <a href="#" class="cart-btn" onclick="add_cart()"><span class="icon_bag_alt"></span> Tambahkan ke cart</a>
                <!-- 
  <ul>
                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                    <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                </ul>
  -->
            </div>
<VARIAN></VARIAN>

            <div class="product__details__widget">
                
                    <li>
                        <span>Promotions:</span>
                        <p><DISKON></DISKON> </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="product__details__tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                    <h6>Description</h6>
                    <p> <DESKRIPSI></DESKRIPSI> </p>
                </div>
                <div class="tab-pane" id="tabs-2" role="tabpanel">
                    <h6>Spesifikasi</h6>
                    <p><SPESIFIKASI></SPESIFIKASI> </p>
                </div>
                <div class="tab-pane" id="tabs-3" role="tabpanel">
                    <h6>Reviews </h6>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</section>
