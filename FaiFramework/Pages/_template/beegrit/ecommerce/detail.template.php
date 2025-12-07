<div class="content p-0 mt-0 mb-0">

    <div class="ps-md-12" style="width:100%">

        <!-- Page title -->
        <style>
            .primary-btn {
                display: inline-block;
                padding: 12px 30px;
                background-color: #009688;
                border: none;
                border-radius: 40px;
                color: #FFF;
                text-transform: uppercase;
                font-weight: 700;
                text-align: center;
                -webkit-transition: 0.2s all;
                transition: 0.2s all;
            }

            .primary-btn:hover,
            .primary-btn:focus {
                opacity: 0.9;
                color: #FFF;
            }

            /*----------------------------*\
	Inputs
\*----------------------------*/

            /*-- Text input --*/

            .input {
                height: 40px;
                padding: 0px 15px;
                border: 1px solid #E4E7ED;
                background-color: #FFF;
                width: 100%;
            }

            textarea.input {
                padding: 15px;
                min-height: 90px;
            }

            /*-- Number input --*/

            .input-number {
                position: relative;
            }

            .input-number input[type="number"]::-webkit-inner-spin-button,
            .input-number input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            .input-number input[type="number"] {
                -moz-appearance: textfield;
                height: 40px;
                width: 100%;
                border: 1px solid #E4E7ED;
                background-color: #FFF;
                padding: 0px 35px 0px 15px;
            }

            .input-number .qty-up,
            .input-number .qty-down {
                position: absolute;
                display: block;
                width: 20px;
                height: 20px;
                border: 1px solid #E4E7ED;
                background-color: #FFF;
                text-align: center;
                font-weight: 700;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .input-number .qty-up {
                right: 0;
                top: 0;
                border-bottom: 0px;
            }

            .input-number .qty-down {
                right: 0;
                bottom: 0;
            }

            .input-number .qty-up:hover,
            .input-number .qty-down:hover {
                background-color: #E4E7ED;
                color: #009688;
            }

            /*-- Select input --*/

            .input-select {
                padding: 0px 15px;
                background: #FFF;
                border: 1px solid #E4E7ED;
                height: 40px;
            }

            /*-- checkbox & radio input --*/

            .input-radio,
            .input-checkbox {
                position: relative;
                display: block;
            }

            .input-radio input[type="radio"]:not(:checked),
            .input-radio input[type="radio"]:checked,
            .input-checkbox input[type="checkbox"]:not(:checked),
            .input-checkbox input[type="checkbox"]:checked {
                position: absolute;
                margin-left: -9999px;
                visibility: hidden;
            }

            .input-radio label,
            .input-checkbox label {
                font-weight: 500;
                min-height: 20px;
                padding-left: 20px;
                margin-bottom: 5px;
                cursor: pointer;
            }

            .input-radio input[type="radio"]+label span,
            .input-checkbox input[type="checkbox"]+label span {
                position: absolute;
                left: 0px;
                top: 4px;
                width: 14px;
                height: 14px;
                border: 2px solid #E4E7ED;
                background: #FFF;
            }

            .input-radio input[type="radio"]+label span {
                border-radius: 50%;
            }

            .input-radio input[type="radio"]+label span:after {
                content: "";
                position: absolute;
                left: 50%;
                top: 50%;
                -webkit-transform: translate(-50%, -50%) scale(0);
                -ms-transform: translate(-50%, -50%) scale(0);
                transform: translate(-50%, -50%) scale(0);
                background-color: #FFF;
                width: 4px;
                height: 4px;
                border-radius: 50%;
                opacity: 0;
                -webkit-transition: all 0.2s;
                transition: all 0.2s;
            }

            .input-checkbox input[type="checkbox"]+label span:after {
                content: '✔';
                position: absolute;
                top: -2px;
                left: 1px;
                font-size: 10px;
                color: #FFF;
                opacity: 0;
                -webkit-transform: scale(0);
                -ms-transform: scale(0);
                transform: scale(0);
                -webkit-transition: all 0.2s;
                transition: all 0.2s;
            }

            .input-radio input[type="radio"]:checked+label span,
            .input-checkbox input[type="checkbox"]:checked+label span {
                background-color: #009688;
                border-color: #009688;
            }

            .input-radio input[type="radio"]:checked+label span:after {
                opacity: 1;
                -webkit-transform: translate(-50%, -50%) scale(1);
                -ms-transform: translate(-50%, -50%) scale(1);
                transform: translate(-50%, -50%) scale(1);
            }

            .input-checkbox input[type="checkbox"]:checked+label span:after {
                opacity: 1;
                -webkit-transform: scale(1);
                -ms-transform: scale(1);
                transform: scale(1);
            }

            .input-radio .caption,
            .input-checkbox .caption {
                margin-top: 5px;
                max-height: 0;
                overflow: hidden;
                -webkit-transition: 0.3s max-height;
                transition: 0.3s max-height;
            }

            .input-radio input[type="radio"]:checked~.caption,
            .input-checkbox input[type="checkbox"]:checked~.caption {
                max-height: 800px;
            }

            /* Please ? this if you like it! */
            .sidebarEffectSub {
                color: #fff;
                background: #009688;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins", sans-serif;
            }

            .navbar .navbar-nav .nav-link {
                color: #fff;
            }

            .section-fluid-main {
                position: relative;
                display: block;
                width: 100%;
                overflow: hidden;
            }

            [type="radio"]:checked,
            [ type="radio"]:not(:checked) {
                position: absolute;
                visibility: hidden;
            }

            .color-btn:checked+label,
            .color-btn:not(:checked)+label {
                position: relative;
                height: 40px;
                transition: all 200ms linear;
                border-radius: 4px;
                width: 40px;
                overflow: hidden;
                border: none;
                cursor: pointer;
                color: #ffeba7;
                margin-right: 10px;
                box-shadow: 0 12px 35px 0 rgba(16, 39, 112, .25);
                z-index: 10;
                background-position: center;
                background-size: cover;
                border: 3px solid transparent;
            }

            .color-btn:checked+label {
                border-color: #434343;
                transform: scale(1.1);
            }

            label.first-color {

                background-image: url('https://assets.codepen.io/1462889/mat1.jpg');
            }

            label.color-2 {
                background-image: url('https://assets.codepen.io/1462889/mat2.jpg');
            }

            label.color-3 {
                background-image: url('https://assets.codepen.io/1462889/mat3.jpg');
            }

            label.color-4 {
                background-image: url('https://assets.codepen.io/1462889/mat4.jpg');
            }

            label.color-5 {
                background-image: url('https://assets.codepen.io/1462889/mat5.jpg');
            }

            label.color-6 {
                background-image: url('https://assets.codepen.io/1462889/mat6.jpg');
            }

            .img-wrap {
                position: absolute;
                top: 100px;
                left: 0;

                height: 410px;
                display: inline-block;
                z-index: 9;
                transition: all 550ms linear;
                transition-delay: 100ms;
                background-position: center top;
                background-size: 100%;
                background-repeat: no-repeat;
                background-image: url('https://assets.codepen.io/1462889/ch1.png');
                opacity: 0;
            }

            .color-btn:checked~.img-wrap.chair-1 {
                opacity: 1;
                animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
            }

            .img-wrap.chair-2 {
                background-image: url('https://assets.codepen.io/1462889/ch2.png');
            }

            .for-color-2:checked~.img-wrap.chair-2 {
                opacity: 1;
                animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
            }

            .img-wrap.chair-3 {
                background-image: url('https://assets.codepen.io/1462889/ch3.png');
            }

            .for-color-3:checked~.img-wrap.chair-3 {
                opacity: 1;
                animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
            }

            .img-wrap.chair-4 {
                background-image: url('https://assets.codepen.io/1462889/ch4.png');
            }

            .for-color-4:checked~.img-wrap.chair-4 {
                opacity: 1;
                animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
            }

            .img-wrap.chair-5 {
                background-image: url('https://assets.codepen.io/1462889/ch5.png');
            }

            .for-color-5:checked~.img-wrap.chair-5 {
                opacity: 1;
                animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
            }

            .img-wrap.chair-6 {
                background-image: url('https://assets.codepen.io/1462889/ch6.png');
            }

            .for-color-6:checked~.img-wrap.chair-6 {
                opacity: 1;
                animation: shake 0.7s cubic-bezier(.36, .07, .19, .97) both;
            }

            @keyframes shake {

                10%,
                90% {
                    transform: translate3d(-1px, 0, 0) rotate(-1deg);
                }

                20%,
                80% {
                    transform: translate3d(2px, 0, 0) rotate(2deg);
                }

                30%,
                50%,
                70% {
                    transform: translate3d(-3px, 0, 0) rotate(-3deg);
                }

                40%,
                60% {
                    transform: translate3d(3px, 0, 0) rotate(3deg);
                }
            }


            .back-color {

                width: 100%;
                height: 100%;
                display: block;
                z-index: 1;
                background-image: linear-gradient(196deg, #f1a9a9, #e66767);
                transition: all 250ms linear;
                transition-delay: 300ms;
            }

            .back-color.chair-2 {
                background-image: linear-gradient(196deg, #4c4c4c, #262626);
                opacity: 0;
            }

            .for-color-2:checked~.back-color.chair-2 {
                opacity: 1;
            }

            .back-color.chair-3 {
                background-image: linear-gradient(196deg, #8a9fb2, #5f7991);
                opacity: 0;
            }

            .for-color-3:checked~.back-color.chair-3 {
                opacity: 1;
            }

            .back-color.chair-4 {
                background-image: linear-gradient(196deg, #97afc3, #6789a7);
                opacity: 0;
            }

            .for-color-4:checked~.back-color.chair-4 {
                opacity: 1;
            }

            .back-color.chair-5 {
                background-image: linear-gradient(196deg, #afa6a0, #8c7f76);
                opacity: 0;
            }

            .for-color-5:checked~.back-color.chair-5 {
                opacity: 1;
            }

            .back-color.chair-6 {
                background-image: linear-gradient(196deg, #aaadac, #838786);
                opacity: 0;
            }

            .for-color-6:checked~.back-color.chair-6 {
                opacity: 1;
            }

            .info-wrap {
                position: relative;

                z-index: 10;
                display: block;
                text-align: left;
            }

            .title-up {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1px;
                font-size: 13px;
                line-height: 1.2;
                color: #fff;
                margin-top: 0;
                margin-bottom: 10px;
            }

            h2 {
                font-family: 'Poppins', sans-serif;
                font-weight: 800;
                font-size: 34px;
                line-height: 1.2;
                color: #fff;
                margin-top: 0;
                margin-bottom: 10px;
            }

            h4 {
                font-family: 'Poppins', sans-serif;
                font-weight: 500;
                font-size: 26px;
                line-height: 1.2;
                color: #fff;
                margin-top: 0;
                margin-bottom: 30px;
            }

            h4 span {
                text-decoration: line-through;
                font-size: 20px;
                opacity: 0.6;
                padding-left: 15px;
            }

            h5 {
                font-family: 'Poppins', sans-serif;
                font-weight: 600;
                font-size: 18px;
                line-height: 1.2;
                color: #fff;
                margin-top: 0;
                margin-bottom: 20px;
            }

            .desc-btn:checked+label,
            .desc-btn:not(:checked)+label {
                position: relative;
                transition: all 200ms linear;
                display: inline-block;
                border: none;
                cursor: pointer;
                color: #ffeba7;
                font-family: 'Poppins', sans-serif;
                font-weight: 600;
                font-size: 18px;
                line-height: 1.2;
                color: #fff;
                margin-right: 25px;
                opacity: 0.5;
            }

            .desc-btn:checked+label {
                opacity: 1;
            }

            .desc-btn:not(:checked)+label:hover {
                opacity: 0.8;
            }

            .desc-sec {
                padding-top: 20px;
                padding-bottom: 30px;
                transition: all 250ms linear;
                opacity: 0;
                overflow: hidden;
                pointer-events: none;
                transform: translateY(20px);
            }

            .desc-sec.accor-2 {
                position: absolute;
                top: 25px;
                left: 0;
                width: 100%;
                z-index: 2;
            }

            #desc-1:checked~.desc-sec.accor-1 {
                opacity: 1;
                pointer-events: auto;
                transform: translateY(0);
            }

            #desc-2:checked~.desc-sec.accor-2 {
                opacity: 1;
                pointer-events: auto;
                transform: translateY(0);
            }

            .section-inline {
                position: relative;
                display: inline-block;
                margin-right: 20px;
            }

            .section-inline p span {
                font-size: 30px;
                line-height: 1.1;
            }

            .btn-cart {
                position: relative;
                font-family: 'Poppins', sans-serif;
                font-weight: 500;
                font-size: 14px;
                line-height: 2;
                height: 48px;
                border-radius: 25px;
                width: 210px;
                letter-spacing: 1px;
                display: -webkit-inline-flex;
                display: -ms-inline-flexbox;
                display: inline-flex;
                -webkit-align-items: center;
                -moz-align-items: center;
                -ms-align-items: center;
                align-items: center;
                -webkit-justify-content: center;
                -moz-justify-content: center;
                -ms-justify-content: center;
                justify-content: center;
                border: none;
                cursor: pointer;
                overflow: hidden;
                background-color: white;
                color: #0aaa9b;
                box-shadow: 0 6px 15px 0 rgba(16, 39, 112, .15);
                transition: all 250ms linear;
                text-decoration: none;
                margin-top: 50px;
            }

            .icon {
                padding-right: 7px;
                font-size: 20px;
            }

            .for-color-2:checked~.info-wrap .btn:before {
                background-color: #1a1a1a;
            }

            .for-color-3:checked~.info-wrap .btn:before {
                background-color: #40566e;
            }

            .for-color-4:checked~.info-wrap .btn:before {
                background-color: #5e89b2;
            }

            .for-color-5:checked~.info-wrap .btn:before {
                background-color: #8c7f76;
            }

            .for-color-6:checked~.info-wrap .btn:before {
                background-color: #5d6160;
            }

            .clearfix {
                width: 100%;
            }

            .clearfix::after {
                display: block;
                clear: both;
                content: "";
            }

            @media screen and (max-width: 991px) {
                .section {
                    margin: 0 auto;
                    text-align: center;
                    max-width: calc(100% - 40px);
                    width: 370px;
                }

                label.first-color {
                    margin-left: 0;
                }

                .info-wrap {
                    margin-left: 0;
                    width: 370px;
                    margin: 0 auto;
                    text-align: center;
                }

                .img-wrap {
                    width: 375px;
                    height: 308px;
                    left: 50%;
                    margin-left: -190px;
                }

                .mob-margin {}

                .qty-label {
                    display: flex;
                    justify-content: center;
                }

                .desc-btn:checked+label,
                .desc-btn:not(:checked)+label {
                    margin-right: 15px;
                    margin-left: 15px;
                }

                .color-btn:checked+label,
                .color-btn:not(:checked)+label {
                    height: 40px;
                    width: 40px;
                    margin: 5px auto;
                    text-align: center;
                }

                .section-inline {
                    margin: 0 5px;
                }
            }

            @media screen and (max-width: 875px) {
                .section {
                    width: 280px;
                    margin-top: 0;
                    padding-top: 0;
                }

                .info-wrap {
                    width: 280px;
                }

                .color-btn:checked+label,
                .color-btn:not(:checked)+label {
                    height: 30px;
                    width: 30px;
                }

                .section-inline p span {
                    font-size: 24px;
                    line-height: 1.1;
                }

                .section-inline p {
                    font-size: 14px;
                }

                #imgFull {
                    padding-bottom: 0;
                }
            }

            @keyframes shake {
                0% {
                    transform: translate(1px, 1px) rotate(0deg);
                }

                10% {
                    transform: translate(-1px, -2px) rotate(-1deg);
                }

                20% {
                    transform: translate(-3px, 0px) rotate(1deg);
                }

                30% {
                    transform: translate(3px, 2px) rotate(0deg);
                }

                40% {
                    transform: translate(1px, -1px) rotate(1deg);
                }

                50% {
                    transform: translate(-1px, 2px) rotate(-1deg);
                }

                60% {
                    transform: translate(-3px, 1px) rotate(0deg);
                }

                70% {
                    transform: translate(3px, 1px) rotate(-1deg);
                }

                80% {
                    transform: translate(-1px, -1px) rotate(1deg);
                }

                90% {
                    transform: translate(1px, 2px) rotate(0deg);
                }

                100% {
                    transform: translate(1px, -2px) rotate(-1deg);
                }
            }
        </style>
        <style>

        </style>


        <!-- partial:index.partial.html -->
            <style>
            .detail-banner{
              transition: all 250ms linear;transition-delay: 0s;transition-delay: 300ms;margin:0;padding: 20px 50px;
            } .xzoom-container{
                text-align: center;max-width:70%
            }
            @media screen and (max-width: 691px) {
                .detail-banner{
                    padding:0;
                }.xzoom-container{
                text-align: center;max-width:100%
            }
            }
           
            </style>

        <div class=" row detail-banner" style="">
        <!-- section -->
            <div class=" col-md-6" id="imgFull" style="transition: all 550ms linear;transition-delay: 0s;transition-delay: 100ms;padding-bottom: 0;">
                <div style="width:100%">
                    <section id="lens">
                        <div class="row">
                            <div class="large-5 column" style="text-align: center;margin: 0;padding: 0;">
                                <div class="xzoom-container" id="image_detail">
                                    <SAMPUL></SAMPUL>
                                    <div class="xzoom-thumbs" style="display: flex;overflow-x: scroll;">
                                        <TUMB></TUMB>
                                    </div>
                                </div>
                            </div>
                            <div class="large-7 column"></div>
                        </div>
                    </section>
                </div>
            </div>
            <div class=" col-md-6" style="">
                <div class="mob-margin2" text-white>


                    <p class="title-up" style="color: #009688;"><NAMA-TOKO></NAMA-TOKO></p>
                    <h2 class="mb-2 pb-0"style="color: #009688;  font-size: 23px;"><NAMA-PRODUK></NAMA-PRODUK></h2>
                    <div class="">
                        <!-- review -->
                        <!--<span><span class="me-2 text-white ">4.4<i class="mdi mdi-star text-success "></i>-->
                        <!--    </span>592 Customer Reviews</span>-->
                    </div>
                     <!-- <span class="text-warning  text-bold" style="font-size: 10px; font-weight:800" >(45% OFF)</span> -->
                    <hr>
                    <h4 class="mb-2 pb-0" style="color: #009688;" id="harga_akhir"><HARGA-AKHIR></HARGA-AKHIR> 
                       
                    </h4><span class="text-muted text-decoration-line-through text-bold"><HARGA-AWAL></HARGA-AWAL></span>

                    <DISKON></DISKON>
                    <p class="title-up pt-0 mt-1 small" style="color: #009688;"><DONASI-BAITUL-MAL></DONASI-BAITUL-MAL></p>

                </div>
                <VARIAN></VARIAN>
                <input type="hidden" id="id_asset" value="<ID-ASSET></ID-ASSET>">
                <input type="hidden" id="id_produk" value="<ID-PRODUK></ID-PRODUK>">
                <input type="hidden" id="id_asset_varian" value="">
                <input type="hidden" id="id_produk_varian" value="">
                <input type="hidden" id="id_varian_1" value="">
                <input type="hidden" id="id_varian_2" value="">
                <input type="hidden" id="id_varian_3" value="">
                <input type="hidden" id="level" value="">
                <input type="hidden" id="id_varian_list" value="">

                <br>

                <div class="mb-3 cart">


                    <div class="clearfix"></div>


                    <div class="clearfix"></div>
                    <div class="info-wrap">
                        <div class="add-to-cart ">
                            <div class="qty-label" style="font-weight: bold;">
                                <span style="display: flex;align-content: center;align-items: center;margin-right: 25px;">Qty</span>
                                <div class="input-number" style="width: 90px;">
                                    <input type="number" value="1" id="set_qty">
                                    <span class="qty-up" style="color: #555;">+</span>
                                    <span class="qty-down" style="color: #555;">-</span>
                                </div>
                            </div>

                        </div>
                        <div href="#" onclick="add_cart()" class="btn-cart"><i class="uil uil-shopping-cart "></i> Add To Cart</div>
                    </div>

                </div>

            </div>
        </div>
        <!-- partial -->
        <div style="background: #fafafa;">
            <!--<div class="bg-white mt-3 p-7 ps-md-15"> 
			<h3>Fitur</h3>
			<p>The chair construction is made of ash tree. Upholstery and wood color at customer's request.</p>
			</div>-->

            <div class="bg-white mt-3 p-7 ps-md-15">
                <h3>Spesifikasi</h3>
                <SPESIFIKASI></SPESIFIKASI>

            </div>

            <div class="bg-white mt-3 p-7 ps-md-15">
                <h3>Deskripsi</h3>
                <DESKRIPSI></DESKRIPSI>
            </div>

            <div class="bg-white mt-3 p-7 ps-md-15">
                <h3>Profil Penjual</h3>
                <div class="user-box">
                    <div class="u-text" onc="" style="display: flex;">
                        <IMAGE-TOKO></IMAGE-TOKO>

                        <h4 style="font-size: 12px;font-weight: 550;color: #555;">
                            <NAMA-TOKO></NAMA-TOKO><br>
                            <div class="text-muted" style="color:rgba(35, 46, 60, 0.7) !important">
                                BE3 ID:<BE3-TOKO></BE3-TOKO>
                            </div>
                        </h4>
                        <style>
                            .maincard-button_right {

                                color: #fff;
                                padding: 4px;

                                display: inline-flex;
                                align-items: center;
                                justify-content: center;

                                margin-left: auto;
                                cursor: pointer;
                                transition: 0.3s;
                            }

                            .maincard-header__add2 {
                                background-color: #ea4e34;
                                border: none;
                                color: #fff;
                                padding: 4px;
                                width: 36px;
                                height: 36px;
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                border-radius: 10px;
                                cursor: pointer;
                                transition: 0.3s;
                                margin-right: 10px;
                            }

                            .maincard-header__add2 svg {
                                width: 20px;

                                height: 20px;

                            }  
                        </style>
                        <div class="maincard-button_right">
                            <a class="btn btn-primary btn-sm mr-2 me-2" href="<LINK-PROFILTOKO></LINK-PROFILTOKO>">
                                Profil
                            </a>
                            <a class="btn btn-primary btn-sm mr-2 me-2" href="<LINK-PROFILTOKO></LINK-PROFILTOKO>">
                                Share
                            </a>
                            <button class="btn btn-primary  btn-sm mr-2 me-2" <LINK-CHAT></LINK-CHAT>>

                                Chat Penjual
                            </button>
                            <button class="btn btn-primary btn-sm  mr-2">

                                Daftar Reseller
                            </button>
                            <button class="btn btn-primary  btn-sm  mr-2">

                                Api
                            </button>

                        </div>
                    </div>

                </div>
                <div class="row m-0 p-2">

                    <div class="col-6">
                        <h6 class="m-0" style="font-weight: 500;color: #555;">
                            Rating
                        </h6>
                        <h6 class="m-0"><RATING-TOKO></RATING-TOKO></h6>
                    </div>
                    <div class="col-6">
                        <h6 class="m-0" style="font-weight: 500;color: #555;">
                            Total Penjualan
                        </h6>
                        <h6 class="m-0">
                            <TOTAL-JUAl-TOKO></TOTAL-JUAl-TOKO> Terjual
                        </h6>
                    </div>
                </div>
            </div>
            <!--<div class="bg-white mt-3 p-7 ps-md-15">-->
            <!--    <h3>Galeri Produk</h3>-->
            <!--    <div class="row">-->

            <!--        <div class="col-md-5 col-md-push-2 text-center">-->
            <!--            <div id="product-main-img" class="slick-initialized slick-slider">-->


            <!--                <div class="slick-list draggable">-->
            <!--                    <div class="slick-track" style="opacity: 1; width: 0px;"></div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->

            <!--        <div class="col-md-2  col-md-pull-5">-->
            <!--            <div id="product-imgs" class="slick-initialized slick-slider slick-vertical">-->
            <!--                <div class="slick-list draggable" style="padding: 0px;">-->
            <!--                    <div class="slick-track" style="opacity: 1;"></div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            <!--<div class="bg-white mt-3 p-7  ps-md-15">-->
            <!--    <h3 class="mb-4">Ratings & Reviews</h3>-->
            <!--    <div class="row align-items-center mb-4">-->
            <!--        <div class="col-md-4 mb-4 mb-md-0">-->
                        <!-- rating -->
            <!--            <h3 class="display-2 ">4.5</h3>-->
            <!--            <i class="bi bi-star-fill text-success"></i>-->
            <!--            <i class="bi bi-star-fill text-success"></i>-->
            <!--            <i class="bi bi-star-fill text-success"></i>-->
            <!--            <i class="bi bi-star-fill text-success"></i>-->
            <!--            <i class="bi bi-star-fill text-success"></i>-->
            <!--            <p class="mb-0">595 Verified Buyers</p>-->
            <!--        </div>-->
            <!--        <div class="offset-lg-1 col-lg-7 col-md-8">-->
                        <!-- progress -->
            <!--            <div class="d-flex align-items-center mb-2">-->
            <!--                <div class="text-nowrap me-3 text-muted"><span class="d-inline-block align-middle text-muted">5</span><i class="bi bi-star-fill ms-1 fs-6"></i></div>-->
            <!--                <div class="w-100">-->
            <!--                    <div class="progress" style="height: 6px;">-->
            <!--                        <div class="progress-bar bg-success" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>-->
            <!--                    </div>-->
            <!--                </div><span class="text-muted ms-3">420</span>-->
            <!--            </div>-->
                        <!-- progress -->
            <!--            <div class="d-flex align-items-center mb-2">-->
            <!--                <div class="text-nowrap me-3 text-muted"><span class="d-inline-block align-middle text-muted">4</span><i class="bi bi-star-fill ms-1 fs-6"></i></div>-->
            <!--                <div class="w-100">-->
            <!--                    <div class="progress" style="height: 6px;">-->
            <!--                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="50"></div>-->
            <!--                    </div>-->
            <!--                </div><span class="text-muted ms-3">90</span>-->
            <!--            </div>-->
                        <!-- progress -->
            <!--            <div class="d-flex align-items-center mb-2">-->
            <!--                <div class="text-nowrap me-3 text-muted"><span class="d-inline-block align-middle text-muted">3</span><i class="bi bi-star-fill ms-1 fs-6"></i></div>-->
            <!--                <div class="w-100">-->
            <!--                    <div class="progress" style="height: 6px;">-->
            <!--                        <div class="progress-bar bg-success" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="35"></div>-->
            <!--                    </div>-->
            <!--                </div><span class="text-muted ms-3">33</span>-->
            <!--            </div>-->
                        <!-- progress -->
            <!--            <div class="d-flex align-items-center mb-2">-->
            <!--                <div class="text-nowrap me-3 text-muted"><span class="d-inline-block align-middle text-muted">2</span><i class="bi bi-star-fill ms-1 fs-6"></i></div>-->
            <!--                <div class="w-100">-->
            <!--                    <div class="progress" style="height: 6px;">-->
            <!--                        <div class="progress-bar bg-warning" role="progressbar" style="width: 22%;" aria-valuenow="22" aria-valuemin="0" aria-valuemax="22"></div>-->
            <!--                    </div>-->
            <!--                </div><span class="text-muted ms-3">12</span>-->
            <!--            </div>-->
                        <!-- progress -->
            <!--            <div class="d-flex align-items-center mb-2">-->
            <!--                <div class="text-nowrap me-3 text-muted"><span class="d-inline-block align-middle text-muted">1</span><i class="bi bi-star-fill ms-1 fs-6"></i></div>-->
            <!--                <div class="w-100">-->
            <!--                    <div class="progress" style="height: 6px;">-->
            <!--                        <div class="progress-bar bg-danger" role="progressbar" style="width: 14%;" aria-valuenow="14" aria-valuemin="0" aria-valuemax="14"></div>-->
            <!--                    </div>-->
            <!--                </div><span class="text-muted ms-3">40</span>-->
            <!--            </div>-->

            <!--        </div>-->
            <!--    </div>-->
            <!--    <div>-->
                    <!-- review -->
            <!--        <div class="border-top py-4 mt-4">-->
            <!--            <div class="border d-inline-block px-2 py-1 rounded-pill mb-3">-->
                            <!-- rating -->
            <!--                <span class="text-dark  ">4.4 <i class="bi bi-star-fill text-success fs-6"></i></span>-->
            <!--            </div>-->
                        <!-- text -->
            <!--            <p>It's awesome , I never thought about Dash UI that awesome shoes.very pretty.</p>-->
            <!--            <div>-->
            <!--                <span>James Ennis</span>-->
            <!--                <span class="ms-4">28 Nov 2023</span>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="border-top py-4">-->
            <!--            <div class="border d-inline-block px-2 py-1 rounded-pill mb-3">-->
                            <!-- rating -->
            <!--                <span class="text-dark  ">5.0 <i class="bi bi-star-fill text-success fs-6"></i></span>-->
            <!--            </div>-->
                        <!-- text -->
            <!--            <p>Quality is more than good that I was expected for buying. I first time-->
            <!--                purchase Dash UI shoes & this brand is good. Thanks to Dash UI delivery-->
            <!--                was faster than fast ...Love Dash UI</p>-->
            <!--            <div>-->
            <!--                <span>Bradley Mouton</span>-->
            <!--                <span class="ms-4">21 Apr 2023-->
            <!--                </span>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="border-top py-4 border-bottom">-->

            <!--            <div class="border d-inline-block px-2 py-1 rounded-pill mb-3">-->
                            <!-- rating -->
            <!--                <span class="text-dark  ">4.4 <i class="bi bi-star-fill text-success fs-6"></i></span>-->
            <!--            </div>-->
                        <!-- text -->
            <!--            <p>Excellent shoes with original logo , Thanks Dash UI , Buy these shoes-->
            <!--                without any tension</p>-->
            <!--            <div class="mb-5">-->
                            <!-- img -->
            <!--                <img src="../assets/images/ecommerce/product-1.jpg" alt="Image" class="avatar-md rounded-2">-->
            <!--                <img src="../assets/images/ecommerce/product-2.jpg" alt="Image" class="avatar-md rounded-2">-->
            <!--                <img src="../assets/images/ecommerce/product-3.jpg" alt="Image" class="avatar-md rounded-2">-->
            <!--            </div>-->
            <!--            <div>-->
                            <!-- text -->
            <!--                <span>Kieth J. Watson </span>-->
            <!--                <span class="ms-4">21 May 2023</span>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--        <div class="my-3">-->
                        <!-- btn-link -->
            <!--            <a href="#!" class="btn-link fw-semi-bold ">View all 89 reviews</a>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>



    </div>
</div>
</div>

<script>
    (function($) {
        $(document).ready(function() {
            $('.xzoom, .xzoom-gallery').xzoom({
                zoomWidth: 400,
                title: true,
                tint: '#333',
                Xoffset: 15
            });
            $('.xzoom2, .xzoom-gallery2').xzoom({
                position: '#xzoom2-id',
                tint: '#ffa200'
            });
            $('.xzoom3, .xzoom-gallery3').xzoom({
                position: 'lens',
                lensShape: 'circle',
                sourceClass: 'xzoom-hidden'
            });
            $('.xzoom4, .xzoom-gallery4').xzoom({
                tint: '#006699',
                Xoffset: 15
            });
            $('.xzoom5, .xzoom-gallery5').xzoom({
                tint: '#006699',
                Xoffset: 15
            });

            //Integration with hammer.js
            var isTouchSupported = 'ontouchstart' in window;

            if (isTouchSupported) {
                //If touch device
                $('.xzoom, .xzoom2, .xzoom3, .xzoom4, .xzoom5').each(function() {
                    var xzoom = $(this).data('xzoom');
                    xzoom.eventunbind();
                });

                $('.xzoom, .xzoom2, .xzoom3').each(function() {
                    var xzoom = $(this).data('xzoom');
                    $(this).hammer().on("tap", function(event) {
                        event.pageX = event.gesture.center.pageX;
                        event.pageY = event.gesture.center.pageY;
                        var s = 1,
                            ls;

                        xzoom.eventmove = function(element) {
                            element.hammer().on('drag', function(event) {
                                event.pageX = event.gesture.center.pageX;
                                event.pageY = event.gesture.center.pageY;
                                xzoom.movezoom(event);
                                event.gesture.preventDefault();
                            });
                        }

                        xzoom.eventleave = function(element) {
                            element.hammer().on('tap', function(event) {
                                xzoom.closezoom();
                            });
                        }
                        xzoom.openzoom(event);
                    });
                });

                $('.xzoom4').each(function() {
                    var xzoom = $(this).data('xzoom');
                    $(this).hammer().on("tap", function(event) {
                        event.pageX = event.gesture.center.pageX;
                        event.pageY = event.gesture.center.pageY;
                        var s = 1,
                            ls;

                        xzoom.eventmove = function(element) {
                            element.hammer().on('drag', function(event) {
                                event.pageX = event.gesture.center.pageX;
                                event.pageY = event.gesture.center.pageY;
                                xzoom.movezoom(event);
                                event.gesture.preventDefault();
                            });
                        }

                        var counter = 0;
                        xzoom.eventclick = function(element) {
                            element.hammer().on('tap', function() {
                                counter++;
                                if (counter == 1) setTimeout(openfancy, 300);
                                event.gesture.preventDefault();
                            });
                        }

                        function openfancy() {
                            if (counter == 2) {
                                xzoom.closezoom();
                                $.fancybox.open(xzoom.gallery().cgallery);
                            } else {
                                xzoom.closezoom();
                            }
                            counter = 0;
                        }
                        xzoom.openzoom(event);
                    });
                });

                $('.xzoom5').each(function() {
                    var xzoom = $(this).data('xzoom');
                    $(this).hammer().on("tap", function(event) {
                        event.pageX = event.gesture.center.pageX;
                        event.pageY = event.gesture.center.pageY;
                        var s = 1,
                            ls;

                        xzoom.eventmove = function(element) {
                            element.hammer().on('drag', function(event) {
                                event.pageX = event.gesture.center.pageX;
                                event.pageY = event.gesture.center.pageY;
                                xzoom.movezoom(event);
                                event.gesture.preventDefault();
                            });
                        }

                        var counter = 0;
                        xzoom.eventclick = function(element) {
                            element.hammer().on('tap', function() {
                                counter++;
                                if (counter == 1) setTimeout(openmagnific, 300);
                                event.gesture.preventDefault();
                            });
                        }

                        function openmagnific() {
                            if (counter == 2) {
                                xzoom.closezoom();
                                var gallery = xzoom.gallery().cgallery;
                                var i, images = new Array();
                                for (i in gallery) {
                                    images[i] = {
                                        src: gallery[i]
                                    };
                                }
                                $.magnificPopup.open({
                                    items: images,
                                    type: 'image',
                                    gallery: {
                                        enabled: true
                                    }
                                });
                            } else {
                                xzoom.closezoom();
                            }
                            counter = 0;
                        }
                        xzoom.openzoom(event);
                    });
                });

            } else {
                //If not touch device

                //Integration with fancybox plugin
                $('#xzoom-fancy').bind('click', function(event) {
                    var xzoom = $(this).data('xzoom');
                    xzoom.closezoom();
                    $.fancybox.open(xzoom.gallery().cgallery, {
                        padding: 0,
                        helpers: {
                            overlay: {
                                locked: false
                            }
                        }
                    });
                    event.preventDefault();
                });

                //Integration with magnific popup plugin
                $('#xzoom-magnific').bind('click', function(event) {
                    var xzoom = $(this).data('xzoom');
                    xzoom.closezoom();
                    var gallery = xzoom.gallery().cgallery;
                    var i, images = new Array();
                    for (i in gallery) {
                        images[i] = {
                            src: gallery[i]
                        };
                    }
                    $.magnificPopup.open({
                        items: images,
                        type: 'image',
                        gallery: {
                            enabled: true
                        }
                    });
                    event.preventDefault();
                });
            }
        });
    })(jQuery);
</script>