<!-- Core CSS -->
<link rel="stylesheet" href="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
<link rel="stylesheet" href="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />
<link rel="stylesheet" href="<?= $this->urlframework($page['template'], 'sneat/assets/css/demo.css') ?>" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

<link rel="stylesheet" href="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/libs/apex-charts/apex-charts.css') ?>" />
<link rel="stylesheet" href="<?= $this->urlframework('dist', 'style.css') ?>" />

<!-- Page CSS -->

<!-- Helpers -->
<script src="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/js/helpers.js'); ?>"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="<?= $this->urlframework($page['template'], 'sneat/assets/js/config.js'); ?>"></script>
<Style>
  .form-group {
    padding: 5px 0;
  }

  .avatar {
    background: #f0f2f6 no-repeat center/contain;
  }

  .skeleton-box {
    display: inline-block;
    height: 1em;
    position: relative;
    overflow: hidden;
    background-color: #DDDBDD;
  }

  .skeleton-box::after {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    transform: translateX(-100%);
    background-image: linear-gradient(90deg, rgba(255, 255, 255, 0) 0, rgba(255, 255, 255, 0.2) 20%, rgba(255, 255, 255, 0.5) 60%, rgba(255, 255, 255, 0));
    -webkit-animation: shimmer 2s infinite;
    animation: shimmer 2s infinite;
    content: "";
  }

  .skeleton {
    background: #fff;
    border: 1px solid;
    border-color: #e5e6e9 #dfe0e4 #d0d1d5;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    margin: 10px 15px;
  }

  .skeleton.skeleton--card {
    width: 500px;
    display: inline-block;
    vertical-align: text-top;
  }

  .skeleton .skeleton--content {
    height: 150px;
    padding: 15px;
    position: relative;
  }

  .skeleton .skeleton--content .loader {
    background: #f6f7f8;
    -webkit-animation-duration: 1s;
    -webkit-animation-fill-mode: forwards;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-name: placeholderSkeleton;
    -webkit-animation-timing-function: linear;
    background-image: -webkit-linear-gradient(left, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
    background-repeat: no-repeat;
    background-size: 800px 104px;
    height: 104px;
    position: relative;
  }

  .skeleton .skeleton--content .skeleton--table .skeleton--tr {
    display: flex;
  }

  .skeleton .skeleton--content .skeleton--table .skeleton--tr .skeleton--th {
    flex: 1 1 100%;
    height: 15px;
    margin: 5px 10px 15px;
  }

  .skeleton .skeleton--content .skeleton--table .skeleton--tr .skeleton--td {
    flex: 1 1 100%;
    height: 10px;
    margin: 5px 10px;
  }

  .skeleton .skeleton--content .skeleton--table .skeleton--tr .skeleton--td__2 {
    flex-basis: 300%;
  }

  .skeleton .skeleton--content .skeleton--table .skeleton--tr .skeleton--td__3 {
    flex-basis: 500%;
  }

  .skeleton .skeleton--content .skeleton--table .skeleton--tr .skeleton--td__4 {
    flex-basis: 700%;
  }

  .skeleton .skeleton--content .skeleton--table .skeleton--tr .skeleton--td__5 {
    flex-basis: 900%;
  }

  .skeleton .skeleton--content .skeleton--title {
    margin: 5px 10px;
    height: 20px;
    width: 200px;
  }

  .skeleton .skeleton--content .skeleton--hr {
    height: 2px;
    width: calc(100% - 20px);
    margin: 0 10px 10px;
  }

  .skeleton .skeleton--content .skeleton--line {
    height: 10px;
    width: calc(100% - 20px);
    margin: 10px;
  }

  .skeleton .skeleton--content .skeleton--line.skeleton--line__short {
    width: 120px;
  }

  .skeleton .skeleton--content .skeleton--circle {
    margin: 5px 10px 10px;
    height: 60px;
    width: 60px;
    border-radius: 10px;
  }

  .skeleton .skeleton--content .fl {
    display: inline-block;
    width: auto;
    vertical-align: text-top;
  }

  @-webkit-keyframes placeholderSkeleton {
    0% {
      background-position: -468px 0;
    }

    100% {
      background-position: 468px 0;
    }
  }

  .container-fluid {

    padding-right: 0.5rem !important;
    padding-left: 0.5rem !important;
  }

  .icon {
    fill: white;
    stroke: none;
  }

  .avatar-upload {
    position: relative;

  }

  .avatar-upload .avatar-edit {
    position: absolute;
    right: 12px;
    z-index: 1;
    top: 10px;
  }

  .avatar-upload .avatar-edit input {
    display: none;
  }

  .avatar-upload .avatar-edit input+label {
    display: inline-block;
    width: 25px;
    height: 25px;
    align: center;
    text-align: center;
    margin-bottom: 0;
    border-radius: 100%;
    background: #FFFFFF;
    border: 1px solid transparent;
    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    font-weight: normal;
    transition: all 0.2s ease-in-out;
  }

  .avatar-upload .avatar-edit input+label:hover {
    background: #f1f1f1;
    border-color: #d6d6d6;
  }

  .avatar-upload .avatar-edit input+label:after {
    content: "\f040";
    font-family: 'FontAwesome';
    color: #757575;
    position: absolute;

    left: 0;
    right: 0;
    text-align: center;
    margin: auto;
  }
</Style>

</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <div id="LoadSidebar"></div>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->


              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  {{Auth::user()->name}}
                </a>
                <ul class="dropdown-menu dropdown-menu-end">

                  <li>
                    <a class="dropdown-item" href="{{route('logout')}}">
                      <i class="bx bx-power-off me-2"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content

            <div class="container-xxl flex-grow-1 container-p-y" >-->

          <div class="p-5">
            <main>
              <div id="contentFaiFramework"></div>
            </main>
          </div>
          <!-- / Content -->

          <!-- Footer -->

          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

  </div>
  <!-- / Layout wrapper -->


  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <!-- <script src="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/libs/jquery/jquery.js'); ?>"></script> -->
  <script src="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/libs/popper/popper.js'); ?>"></script>
  <script src="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/js/bootstrap.js'); ?>"></script>
  <script src="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js'); ?>"></script>

  <script src="<?= $this->urlframework($page['template'], 'sneat/assets/vendor/js/menu.js'); ?>"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->

  <!-- Main JS -->
  <script src="<?= $this->urlframework($page['template'], 'sneat/assets/js/main.js'); ?>"></script>