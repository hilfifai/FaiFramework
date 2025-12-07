<!-- Libs CSS -->
<link rel="stylesheet" href="<?= $this->urlframework('tabler', 'base\dist\css\tabler.css') ?>">
<!-- <link href="<?= $this->urlframework('hibe3', 'assets/libs/bootstrap-icons/font/bootstrap-icons.css') ?>" rel="stylesheet"> -->
<link href="<?= $this->urlframework('hibe3', 'assets/libs/%40mdi/font/css/materialdesignicons.min.css') ?>" rel="stylesheet">
<link href="<?= $this->urlframework('hibe3', 'horizontal/assets/libs/simplebar/dist/simplebar.min.css') ?>" rel="stylesheet">
<link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
<script src="https://code.iconify.design/2/2.0.4/iconify.min.js"></script>

<link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="<?= $this->urlframework('codepen', 'bookmark-appview-transition/dist/style.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/theme.min.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/style2.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/style.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/mainsidebar.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/navbar_stisla.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/sidebarWai.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/sidebar_left_wai.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/subheader_pnProduct.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/checkbox.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/bootstraps_grid.css') ?>">
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/navbar_vertica_soft_ui.css') ?>">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>
<link rel="stylesheet" href="<?= $this->urlframework('hibe3', 'horizontal/assets/css/swipper.css') ?>">

<link href="<?= $this->urlframework('hibe3', 'horizontal/assets/libs/dropzone/dist/dropzone.css') ?>" rel="stylesheet">
<link href="<?= $this->urlframework('hibe3', 'horizontal/assets/libs/%40yaireo/tagify/dist/tagify.css') ?>" rel="stylesheet">

<script type="text/javascript" src="<?= $this->urlframework('assets', 'xzoom/dist/xzoom.min.js') ?>"></script>
<link rel="stylesheet" type="text/css" href="<?= $this->urlframework('assets', 'xzoom/dist/xzoom.css') ?>" media="all" />
<script type="text/javascript" src="<?= $this->urlframework('assets', 'xzoom/example/hammer.js/1.0.5/jquery.hammer.min.js') ?>"></script>
<link type="text/css" rel="stylesheet" media="all" href="<?= $this->urlframework('assets', 'xzoom/example/fancybox/source/jquery.fancybox.css') ?>" />
<link type="text/css" rel="stylesheet" media="all" href="<?= $this->urlframework('assets', 'xzoom/example/magnific-popup/css/magnific-popup.css') ?>" />
<script type="text/javascript" src="<?= $this->urlframework('assets', 'xzoom/example/fancybox/source/jquery.fancybox.js') ?>"></script>
<script type="text/javascript" src="<?= $this->urlframework('assets', 'xzoom/example/magnific-popup/js/magnific-popup.js') ?>"></script>


<style>
  .navbar-custom .nav-top-wrap .dropdown-menu {
    /* margin: 0.75rem -12.25rem !important */
    min-width: 200px;
  }

  .control-label  {
    padding: 10 0 ;
  }
  .xzoom3 {
    max-width: 100% !important;
    min-width: 100% !important;
  }
  .avatar-upload{
    border : 0px;
    width: 100%;
  }
  
  td{
        font-size: 11px;
  }
</style>
<style>
  .form-selectgroup-input[type="checkbox"]:checked+.form-selectgroup-label .form-selectgroup-check {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' width='16' height='16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8.5l2.5 2.5l5.5 -5.5'/%3e%3c/svg%3e");
  }

  .form-selectgroup-input[type="radio"]:checked+.form-selectgroup-label .form-selectgroup-check {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3ccircle r='3' fill='%23ffffff' cx='8' cy='8' /%3e%3c/svg%3e");
  }

  .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-check {
    background-color: #009688;
    background-repeat: repeat;
    background-position: center;
    background-size: 1rem;
    border-color: rgba(101, 109, 119, 0.24);
  }

  .form-selectgroup-input:checked+.form-selectgroup-label {
    z-index: 1;
    color: #009688;
    background: #009688a0d;
    border-color: #11aa97;
  }

  .form-selectgroup-input:focus+.form-selectgroup-label {
    z-index: 2;
    color: #009688;
    border-color: #11aa97;
    /* box-shadow: 0 0 0 0.25rem rgba(32, 107, 196, 0.25);*/
  }

  /**
Alternate version of form select group
 */
  .form-selectgroup-boxes .form-selectgroup-label {
    text-align: left;
    padding: 1rem 1rem;
    color: inherit;
  }

  .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label {
    color: inherit;
  }

  .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-title {
    color: #009688;
  }

  .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-label-content {
    opacity: 1;
  }

  .form-selectgroup-boxes .form-selectgroup-label {
    text-align: left;
    padding: 1rem 1rem;
    color: inherit;
  }

  .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label {
    color: inherit;
  }

  .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-title {
    color: #009688;
  }

  .form-selectgroup-boxes .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-label-content {
    opacity: 1;
  }

  .btn-primary-soft {
    background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%);
    color: #fff;
    border: #98ec2d;
  }

  .btn-primary {
    background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%);
    color: #fff;
    border: #98ec2d;
  }

  *-primary {
    background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%);
    color: #fff;
    border: #98ec2d;
  }

  .wallet-card {
    background: #ffffff;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.09);
    border-radius: 10px;
    padding: 20px 24px;
    position: relative;
    z-index: 1;
  }

  .wallet-card .balance {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    height: 100px;
  }

  .wallet-card .balance .left {
    padding-right: 10px;
  }

  .wallet-card .balance .right {
    padding: 0;
  }

  .wallet-card .balance .right .button {
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1em;
    color: #6236FF;
    background: rgba(98, 54, 255, 0.1);
    width: 50px;
    height: 64px;
    font-size: 26px;
    border-radius: 10px;
  }

  .wallet-card .balance .right .button:hover {
    background: #6236FF;
    color: #fff;
  }

  .wallet-card .balance .title {
    color: #27173E;
    font-weight: 500;
    display: block;
    margin-bottom: 8px;
  }

  .wallet-card .balance .total {
    font-weight: 700;
    letter-spacing: -0.01em;
    line-height: 1em;
    font-size: 32px;
  }

  .wallet-card .wallet-footer {
    border-top: 1px solid #DCDCE9;
    padding-top: 20px;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
  }

  .wallet-card .wallet-footer .item {
    flex: 1;
    text-align: center;
  }

  .wallet-card .wallet-footer .item a {
    display: block;
  }

  .wallet-card .wallet-footer .item a:active {
    transform: scale(0.94);
  }

  .wallet-card .wallet-footer .item .icon-wrapper {
    background: #6236FF;
    width: 48px;
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    color: #fff;
    font-size: 24px;
    margin-bottom: 14px;
  }

  .wallet-card .wallet-footer .item strong {
    display: block;
    color: #27173E;
    font-weight: 500;
    font-size: 11px;
    line-height: 1.2em;
  }

  .stat-box {
    background: #ffffff;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.09);
    border-radius: 10px;
    padding: 20px 24px;
  }

  .stat-box .title {
    font-size: 13px;
    color: #958d9e;
    font-weight: 500;
    display: block;
    margin-bottom: 8px;
    line-height: 1.4em;
  }

  .stat-box .value {
    font-size: 24px;
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1em;
    color: #27173E;
  }

  .form-control {
    margin: 5px 0px;

  }

  .form-control:focus {

    box-shadow: 0 0 0 0 rgba(28, 175, 55) !important;
    border: 1px solid rgba(28, 175, 55) !important;
  }

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

  .input-number input[type="number"] {

    border-radius: 10px;
  }

  .input-number .qty-up {

    border-radius: 0 10px 0 0;
  }

  .input-number .qty-down {

    border-radius: 0 0 10px 0;
  }
</style>
<style>
  .product {
    position: relative;
    margin: 15px 0px;
    -webkit-box-shadow: 0px 0px 0px 0px #E4E7ED, 0px 0px 0px 1px #E4E7ED;
    box-shadow: 0px 0px 0px 0px #E4E7ED, 0px 0px 0px 1px #E4E7ED;
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
  }

  .product:hover {
    -webkit-box-shadow: 0px 0px 6px 0px #E4E7ED, 0px 0px 0px 2px #009688;
    box-shadow: 0px 0px 6px 0px #E4E7ED, 0px 0px 0px 2px #009688;
  }

  .product .product-img {
    position: relative;
  }

  .product .product-img>img {
    width: 100%;
  }

  .product .product-img .product-label {
    position: absolute;
    top: 15px;
    right: 15px;
  }

  .product .product-img .product-label>span {
    border: 2px solid;
    padding: 2px 10px;
    font-size: 12px;
  }

  .product .product-img .product-label>span.sale {
    background-color: #FFF;
    border-color: #009688;
    color: #009688;
  }

  .product .product-img .product-label>span.new {
    background-color: #009688;
    border-color: #009688;
    color: #FFF;
  }

  .product .product-body {
    position: relative;
    padding: 15px;
    background-color: #FFF;
    text-align: center;
    z-index: 20;
  }

  .product .product-body .product-category {
    text-transform: uppercase;
    font-size: 12px;
    color: #8D99AE;
  }

  .product .product-body .product-name {
    text-transform: uppercase;
    font-size: 14px;
  }

  .product .product-body .product-name>a {
    font-weight: 700;
  }

  .product .product-body .product-name>a:hover,
  .product .product-body .product-name>a:focus {
    color: #009688;
  }

  .product .product-body .product-price {
    color: #009688;
    font-size: 18px;
  }

  .product .product-body .product-price .product-old-price {
    font-size: 70%;
    font-weight: 400;
    color: #8D99AE;
  }

  .product .product-body .product-rating {
    position: relative;
    margin: 15px 0px 10px;
    height: 20px;
  }

  .product .product-body .product-rating>i {
    position: relative;
    width: 14px;
    margin-right: -4px;
    background: #FFF;
    color: #E4E7ED;
    z-index: 10;
  }

  .product .product-body .product-rating>i.fa-star {
    color: #009688;
  }

  .product .product-body .product-rating:after {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%);
    height: 1px;
    background-color: #E4E7ED;
  }

  .product .product-body .product-btns>button {
    position: relative;
    width: 40px;
    height: 40px;
    line-height: 40px;
    background: transparent;
    border: none;
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
  }

  .product .product-body .product-btns>button:hover {
    background-color: #E4E7ED;
    color: #009688;
    border-radius: 50%;
  }

  .product .product-body .product-btns>button .tooltipp {
    position: absolute;
    bottom: 100%;
    left: 50%;
    -webkit-transform: translate(-50%, -15px);
    -ms-transform: translate(-50%, -15px);
    transform: translate(-50%, -15px);
    width: 150px;
    padding: 10px;
    font-size: 12px;
    line-height: 10px;
    background: #1e1f29;
    color: #FFF;
    text-transform: uppercase;
    z-index: 10;
    opacity: 0;
    visibility: hidden;
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
  }

  .product .product-body .product-btns>button:hover .tooltipp {
    opacity: 1;
    visibility: visible;
    -webkit-transform: translate(-50%, -5px);
    -ms-transform: translate(-50%, -5px);
    transform: translate(-50%, -5px);
  }

  .product .add-to-cart {
    position: absolute;
    left: 1px;
    right: 1px;
    bottom: 1px;
    padding: 15px;
    background: #1e1f29;
    text-align: center;
    -webkit-transform: translateY(0%);
    -ms-transform: translateY(0%);
    transform: translateY(0%);
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
    z-index: 2;
  }

  .product:hover .add-to-cart {
    -webkit-transform: translateY(100%);
    -ms-transform: translateY(100%);
    transform: translateY(100%);
  }

  .product .add-to-cart .add-to-cart-btn {
    position: relative;
    border: 2px solid transparent;
    height: 40px;
    padding: 0 30px;
    background-color: #009688;
    color: #FFF;
    text-transform: uppercase;
    font-weight: 700;
    border-radius: 40px;
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
  }

  .product .add-to-cart .add-to-cart-btn>i {
    position: absolute;
    left: 0;
    top: 0;
    width: 40px;
    height: 40px;
    line-height: 38px;
    color: #009688;
    opacity: 0;
    visibility: hidden;
  }

  .product .add-to-cart .add-to-cart-btn:hover {
    background-color: #FFF;
    color: #009688;
    border-color: #009688;
    padding: 0px 30px 0px 50px;
  }

  .product .add-to-cart .add-to-cart-btn:hover>i {
    opacity: 1;
    visibility: visible;
  }

  .product-image {
    /* margin-top: -4rem;
    padding: 0 0.5rem; */
  }

  .product-image+* {
    margin-top: 0rem;
  }

  .product-title {
    font-size: 0.8rem;
    margin-bottom: 0em;
    height: 60px;
    max-height: 60px;overflow: scroll;
  }
  .card-title{
    font-weight: 700;
    font-size: 10px;
  }
  .product-rating svg {
    width: 9px;
    height: 9px;
  }

  .product-price {
    font-size: 0.7rem;
    color: #009688;
  }

  .product-btn {
    width: 30px;
    height: 30px;
  }

  .product-btn svg {
    width: 16px;
    height: 16px;
  }

  .product-rating {
    margin-top: 0rem;
    color: teal;
  }

  .product {
    display: flex;

    flex-direction: column;

    background-color: var(--c-grey-000);

    box-shadow: 0 5px 20px 0 rgba(150, 132, 254, 0.1), 0 15px 30px 0 rgba(150, 132, 254, 0.05);

    border-radius: 15px;

    margin-top: 5.5rem;

  }

  .product {
    border-radius: 25px;

    background: #fff;

    background-color: rgb(255, 255, 255);

  }

  .product {
    position: relative;

    margin: 15px 0px;

    margin-top: 15px;

    -webkit-box-shadow: 0px 0px 0px 0px #E4E7ED, 0px 0px 0px 1px #E4E7ED;

    box-shadow: 0px 0px 0px 0px #E4E7ED, 0px 0px 0px 1px #E4E7ED;

    -webkit-transition: 0.2s all;

    transition: 0.2s all;

  }
</style>
<style>
  .btn-primary-soft {
    background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%);
    color: #fff;
    border: #98ec2d;
  }

  .btn-primary {
    background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%);
    color: #fff;
    border: #98ec2d;
  }

  *-primary {
    background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%);
    color: #fff;
    border: #98ec2d;
  }

  .wallet-card {
    background: #ffffff;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.09);
    border-radius: 10px;
    padding: 20px 24px;
    position: relative;
    z-index: 1;
  }

  .wallet-card .balance {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
    height: 100px;
  }

  .wallet-card .balance .left {
    padding-right: 10px;
  }

  .wallet-card .balance .right {
    padding: 0;
  }

  .wallet-card .balance .right .button {
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1em;
    color: #6236FF;
    background: rgba(98, 54, 255, 0.1);
    width: 50px;
    height: 64px;
    font-size: 26px;
    border-radius: 10px;
  }

  .wallet-card .balance .right .button:hover {
    background: #6236FF;
    color: #fff;
  }

  .wallet-card .balance .title {
    color: #27173E;
    font-weight: 500;
    display: block;
    margin-bottom: 8px;
  }

  .wallet-card .balance .total {
    font-weight: 700;
    letter-spacing: -0.01em;
    line-height: 1em;
    font-size: 32px;
  }

  .wallet-card .wallet-footer {
    border-top: 1px solid #DCDCE9;
    padding-top: 0;
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
  }

  .wallet-card .wallet-footer .item {
    flex: 1;
    text-align: center;
  }

  .wallet-card .wallet-footer .item a {
    display: block;
  }

  .wallet-card .wallet-footer .item a:active {
    transform: scale(0.94);
  }

  .wallet-card .wallet-footer .item .icon-wrapper {
    background: #6236FF;
    width: 48px;
    height: 48px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    color: #fff;
    font-size: 24px;
    margin-bottom: 14px;
  }

  .wallet-card .wallet-footer .item strong {
    display: block;
    color: #27173E;
    font-weight: 500;
    font-size: 11px;
    line-height: 1.2em;
  }

  .form-control {
    margin: 0;
  }
 
  @media (max-width: 900px) {
    .main-wrapper{
      margin-top: 50px !important;
    }
  }
  @media (max-width: 500px) {
    .main-wrapper{
      margin-top: 30px !important;
    }
  }
</style>
<div id="LoadNavbar" <?= isset($page['load']['template']['load_header']['class']) ? "class='" . $page['load']['template']['load_header']['class'] . "'" : '' ?>>
    <?php 
	    	if ($page['load']['type'] !== 'view_website') {
	    	    $fai = new MainFaiFramework();
	    	    $fai->AllPage($page,$page['load']['menuApps'],'navbar',2);
	    	    
	    	}
	    ?>
</div>
<div id="LoadHeader">
    <?php 
	    	if ($page['load']['type'] !== 'view_website') {
	    	    $fai = new MainFaiFramework();
	    	    $fai->AllPage($page,$page['load']['menuApps'],'header',2);
	    	    
	    	}
	    ?>
</div>

<div id="LoadSidebar">
    <?php 
	    	if ($page['load']['type'] !== 'view_website') {
	    	    $fai = new MainFaiFramework();
	    	    $fai->AllPage($page,$page['load']['menuApps'],'sidebar',2);
	    	    
	    	}
	    ?>
</div>
<div id="LoadSidebarIn">

  <main id="main-wrapper" class="main-wrapper" style="margin-top: 70px;">
    <div id="app-content" class="pt-2 ">

      <div id="contentFaiFramework"> </div>
    </div>
</div>
</div>
</main>
<div id="LoadButtombar">
    <?php 
	    	if ($page['load']['type'] !== 'view_website') {
	    	    $fai = new MainFaiFramework();
	    	    $fai->AllPage($page,$page['load']['menuApps'],'buttombar',2);
	    	    
	    	}
	    ?>
</div>
</div>




<!-- navbar horizontal -->
<!-- navbar -->

<!-- Scripts -->



<!-- Libs JS -->
<script src="<?= $this->urlframework('assets', 'xzoom/example/js/foundation.min.js') ?>"></script>
<script src="<?= $this->urlframework('assets', 'xzoom/example/js/setup.js') ?>"></script>
<!-- <script src="<?= $this->urlframework('hibe3', 'assets/libs/jquery/dist/jquery.min.js') ?>"></script>-->
<script src="<?= $this->urlframework('hibe3', 'assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= $this->urlframework('hibe3', 'assets/libs/feather-icons/dist/feather.min.js') ?>"></script>
<script src="<?= $this->urlframework('hibe3', 'assets/libs/simplebar/dist/simplebar.min.js') ?>"></script>



<script src="<?= $this->urlframework('hibe3', 'assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>

<!-- popper js -->
<script src="<?= $this->urlframework('hibe3', 'assets/libs/%40popperjs/core/dist/umd/popper.min.js') ?>"></script>
<!-- tippy js -->
<script src="<?= $this->urlframework('hibe3', 'assets/libs/tippy.js/dist/tippy-bundle.umd.min.js') ?>"></script>
<script src="<?= $this->urlframework('hibe3', '/assets/js/vendors/tooltip.js') ?>"></script>
<!-- Scripts -->
<script src="<?= $this->urlframework('hibe3', '/assets/libs/bs-stepper/dist/js/bs-stepper.min.js') ?>"></script>
<script src="<?= $this->urlframework('hibe3', '/assets/js/vendors/beStepper.js') ?>"></script>

<!-- Theme JS -->
<script src="<?= $this->urlframework('hibe3', 'assets/js/theme.min.js') ?>"></script>


<script src="<?= $this->urlframework('hibe3', 'assets/libs/%40popperjs/core/dist/umd/popper.min.js') ?>"></script>
<script src="<?= $this->urlframework('hibe3', 'assets/libs/tippy.js/dist/tippy-bundle.umd.min.js') ?>"></script>
<script src="<?= $this->urlframework('hibe3', 'assets/js/vendors/tooltip.js') ?>"></script>
<script src="<?= $this->urlframework('hibe3', 'assets/js/vendors/chat.js') ?>"></script>
<link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>

</body>
<script>
  function toggleSidebar(ref) {
    document.getElementById("sidebarinLeft").classList.toggle('show-left-sidebar');
  }

  function togle_sidebar_wai() {
    let sidebar = document.querySelector(".sidebarWai");
    let openBtn = document.querySelector("#btnSidebarWAI");
    let closeBtn = document.querySelector(".btnClassClosSideBar");
    sidebar.classList.toggle("open");
    menuBtnChange();
  }

  function show_profile() {
    $('#dropdown-profile-menu').toggle(function() {
        $('#another-element').show("slide", {
          direction: "right"
        }, 1000);
      },
      function() {
        $('#another-element').hide("slide", {
          direction: "right"
        }, 1000);
      });
  }





  // following are the code to change sidebar button(optional)
  function menuBtnChange() {
    if (sidebar.classList.contains("open")) {
      closeBtn.classList.replace("bx-menu", "bx-menu-alt-right"); //replacing the iocns class
      //document.body.style = "background-color:rgba(0,0,0,0.3)";
      document.getElementsByClassName("sidebarEffectHeader").style = "background-color:#00968854 !important"; //#00968854 !important//#009688 !important
      document.getElementsByClassName("sidebarEffectSub").style = "background-color:rgb(0,0,0,0) !important"; //#00968854 !important//#009688 !important
    } else {
      closeBtn.classList.replace("bx-menu-alt-right", "bx-menu"); //replacing the iocns class
      // document.body.style = "background-color:white";
      document.getElementsByClassName("sidebarEffectHeader").style = "";
      document.getElementsByClassName("sidebarEffectSub").style = "";

    }
  }
</script>
<script>

</script>

<script>
  var update_sidebar_nicescroll = function() {
    let a = setInterval(function() {
      if (sidebar_nicescroll != null)
        sidebar_nicescroll.resize();
    }, 10);

    setTimeout(function() {
      clearInterval(a);
    }, 600);
  }
  $("[data-toggle='sidebar']").click(function() {
    var body = $("body"),
      w = $(window);

    if (w.outerWidth() <= 1024) {
      body.removeClass('search-show search-gone');
      if (body.hasClass('sidebar-gone')) {
        body.removeClass('sidebar-gone');
        body.addClass('sidebar-show');
      } else {
        body.addClass('sidebar-gone');
        body.removeClass('sidebar-show');
      }

      update_sidebar_nicescroll();
    } else {
      body.removeClass('search-show search-gone');
      if (body.hasClass('sidebar-mini')) {
        toggle_sidebar_mini(false);
      } else {
        toggle_sidebar_mini(true);
      }
    }

    return false;
  });
  $("[data-toggle='search']").click(function() {
    var body = $("body");

    if (body.hasClass('search-gone')) {
      body.addClass('search-gone');
      body.removeClass('search-show');
    } else {
      body.removeClass('search-gone');
      body.addClass('search-show');
    } 
  });
  var toggleLayout = function() {
    var w = $(window),
      layout_class = $('body').attr('class') || '',
      layout_classes = (layout_class.trim().length > 0 ? layout_class.split(' ') : '');

    if (layout_classes.length > 0) {
      layout_classes.forEach(function(item) {
        if (item.indexOf('layout-') != -1) {
          now_layout_class = item;
        }
      });
    }

    if (w.outerWidth() <= 1024) {
      if ($('body').hasClass('sidebar-mini')) {
        toggle_sidebar_mini(false);
        $('.main-sidebar').niceScroll(sidebar_nicescroll_opts);
        sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
      }

      $("body").addClass("sidebar-gone");
      $("body").removeClass("layout-2 layout-3 sidebar-mini sidebar-show");
      $("body").off('click').on('click', function(e) {
        if ($(e.target).hasClass('sidebar-show') || $(e.target).hasClass('search-show')) {
          $("body").removeClass("sidebar-show");
          $("body").addClass("sidebar-gone");
          $("body").removeClass("search-show");

          update_sidebar_nicescroll();
        }
      });

      update_sidebar_nicescroll();

      if (now_layout_class == 'layout-3') {
        let nav_second_classes = $(".navbar-secondary").attr('class'),
          nav_second = $(".navbar-secondary");

        nav_second.attr('data-nav-classes', nav_second_classes);
        nav_second.removeAttr('class');
        nav_second.addClass('main-sidebar');

        let main_sidebar = $(".main-sidebar");
        main_sidebar.find('.container').addClass('sidebar-wrapper').removeClass('container');
        main_sidebar.find('.navbar-nav').addClass('sidebar-menu').removeClass('navbar-nav');
        main_sidebar.find('.sidebar-menu .nav-item.dropdown.show a').click();
        main_sidebar.find('.sidebar-brand').remove();
        main_sidebar.find('.sidebar-menu').before($('<div>', {
          class: 'sidebar-brand'
        }).append(
          $('<a>', {
            href: $('.navbar-brand').attr('href'),
          }).html($('.navbar-brand').html())
        ));
        setTimeout(function() {
          sidebar_nicescroll = main_sidebar.niceScroll(sidebar_nicescroll_opts);
          sidebar_nicescroll = main_sidebar.getNiceScroll();
        }, 700);

        sidebar_dropdown();
        $(".main-wrapper").removeClass("container");
      }
    } else {
      $("body").removeClass("sidebar-gone sidebar-show");
      if (now_layout_class)
        $("body").addClass(now_layout_class);

      let nav_second_classes = $(".main-sidebar").attr('data-nav-classes'),
        nav_second = $(".main-sidebar");

      if (now_layout_class == 'layout-3' && nav_second.hasClass('main-sidebar')) {
        nav_second.find(".sidebar-menu li a.has-dropdown").off('click');
        nav_second.find('.sidebar-brand').remove();
        nav_second.removeAttr('class');
        nav_second.addClass(nav_second_classes);

        let main_sidebar = $(".navbar-secondary");
        main_sidebar.find('.sidebar-wrapper').addClass('container').removeClass('sidebar-wrapper');
        main_sidebar.find('.sidebar-menu').addClass('navbar-nav').removeClass('sidebar-menu');
        main_sidebar.find('.dropdown-menu').hide();
        main_sidebar.removeAttr('style');
        main_sidebar.removeAttr('tabindex');
        main_sidebar.removeAttr('data-nav-classes');
        $(".main-wrapper").addClass("container");
        // if(sidebar_nicescroll != null)
        //   sidebar_nicescroll.remove();
      } else if (now_layout_class == 'layout-2') {
        $("body").addClass("layout-2");
      } else {
        update_sidebar_nicescroll();
      }
    }
  }
  toggleLayout();
  $(window).resize(toggleLayout);
</script>
<script src="swipper.js" type="module"></script>


</html>