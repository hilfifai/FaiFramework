<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url(); ?>assets/vendor/soft-ui-dashboard/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="<?= base_url(); ?>assets/vendor/soft-ui-dashboard/assets/img/favicon.png">
    <title>
        HiBe3 
    </title>
    <!--     Fonts and icons    -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/bootstrap\dist\css/bootstrap.min.css"
          >  
    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/materializeicon/material-icons.css">
    <!-- Nucleo Icons -->
    <link href="<?= base_url(); ?>assets/vendor/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url(); ?>assets/vendor/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons-->
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"> </script>
	<!-- CSS Files -->
    <link href="<?= base_url(); ?>assets/vendor/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />

    <link rel="stylesheet" href="<?= base_url(); ?>assets/vendor/select2/dist/css/select2.min.css">

    <link id="pagestyle" href="<?= base_url(); ?>assets/vendor/soft-ui-dashboard/assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
    <link id="pagestyle" href="<?= base_url(); ?>assets/dist/style.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>

<div class="row no-gutters vh-100 loader-screen" style="background: white !important;">
    <div class="col align-self-center text-white text-center">
        <img src="<?= base_url(); ?>assets/images/logo.png" alt="logo" width="200px">
        <h1 class="mt-3  text-white" style="color: #04684d !important;"><span class="font-weight-light text-gradient-success  text-white" style="color:#bfd200 !important;">Hi</span>Be3</h1>

        <div class="loadingCircle">
            <div class="circleOuter"></div>
            <div class="circleLoader"></div>
        </div>
    </div>
    <div style="text-align: center; position: absolute; bottom: 60px">
        <h6 class="mt-3"><span class="font-weight-light text-gradient-success text-white" style="color: #04684d !important;">Powered By</h6>
        <img src="<?= base_url(); ?>assets/images/logo.png" alt="logo" width="50px">
    </div>
</div>
<style>
.dropdown-divider {
  height: 0;
  margin: .5rem 0;
  overflow: hidden;
  border-top: 1px solid #e9ecef;
}
.ps--active-x > .ps__rail-x, .ps--active-y > .ps__rail-y {
  display: none;
  background-color: transparent;
}
.page-item.active .page-link {
  z-index: 3;
  color: #fff;
  background-color: #82d616;
  border-color: #82d616;
}
.avatar {
 --tblr-avatar-size:2.5rem;
 position:relative;
 width:var(--tblr-avatar-size);
 height:var(--tblr-avatar-size);
 font-size:calc(var(--tblr-avatar-size)/ 2.8571429);
 font-weight:500;
 display:inline-flex;
 align-items:center;
 justify-content:center;
 color:#656d77;
 text-align:center;
 text-transform:uppercase;
 vertical-align:bottom;
 -webkit-user-select:none;
 -moz-user-select:none;
 -ms-user-select:none;
 user-select:none;
 background:#f0f2f6 no-repeat center/cover;
 border-radius:4px
}
.avatar svg {
 width:1.5rem;
 height:1.5rem
}
.avatar .badge {
 position:absolute;
 right:0;
 bottom:0;
 border-radius:50%;
 box-shadow:0 0 0 2px #fff
}
a.avatar {
 cursor:pointer
}
.avatar-rounded {
 border-radius:50%
}
.avatar-xs {
 --tblr-avatar-size:1.25rem
}
.avatar-xs .badge:empty {
 width:.3125rem;
 height:.3125rem
}
.avatar-sm {
 --tblr-avatar-size:2rem
}
.avatar-sm .badge:empty {
 width:.5rem;
 height:.5rem
}
.avatar-md {
 --tblr-avatar-size:3.75rem
}
.avatar-md .badge:empty {
 width:.9375rem;
 height:.9375rem
}
.avatar-lg {
 --tblr-avatar-size:5rem
}
.avatar-lg .badge:empty {
 width:1.25rem;
 height:1.25rem
}
.avatar-xl {
 --tblr-avatar-size:7rem
}
.avatar-xl .badge:empty {
 width:1.75rem;
 height:1.75rem
}
.avatar-list {
 display:inline-flex;
 padding:0;
 margin:0 0 -.5rem
}
.avatar-list .avatar {
 margin-bottom:.5rem
}
.avatar-list .avatar:not(:last-child) {
 margin-right:.5rem
}
.avatar-list a.avatar:hover {
 z-index:1
}
.avatar-list-stacked .avatar {
 margin-right:-.5rem!important;
 box-shadow:0 0 0 2px #fff
}
.card-footer .avatar-list-stacked .avatar {
 box-shadow:0 0 0 2px #f4f6fa
}
.avatar-upload {
 width:4rem;
 height:4rem;
 border:1px dashed #e6e8e9;
 background:#fff;
 flex-direction:column;
 transition:.3s color,.3s background-color
}
.avatar-upload svg {
 width:1.5rem;
 height:1.5rem;
 stroke-width:1
}
.avatar-upload:hover {
 border-color:#206bc4;
 color:#206bc4;
 text-decoration:none
}
.avatar-upload-text {
 font-size:.625rem;
 line-height:1;
 margin-top:.25rem
}
.badge {
 display:inline-flex;
 justify-content:center;
 align-items:center;
 background:#c6cad0;
 overflow:hidden;
 -webkit-user-select:none;
 -moz-user-select:none;
 -ms-user-select:none;
 user-select:none;
 padding:calc(.25rem - 1px) .25rem;
 height:1.25rem;
 border:1px solid transparent;
 min-width:1.25rem
}
a.badge {
 color:#fff
}
.badge:empty {
 display:inline-block;
 width:.5rem;
 height:.5rem;
 min-width:0;
 min-height:auto;
 padding:0;
 border-radius:50%
}
.badge .avatar {
 box-sizing:content-box;
 width:1.25rem;
 height:1.25rem;
 margin:0 .5rem 0 -.5rem
}
.badge-outline {
 background-color:transparent;
 border:1px solid currentColor
}
.badge-pill {
 border-radius:100px;
 min-width:1.75em
}
.breadcrumb {
 padding:0;
 margin:0;
 background:0 0
}
.avatar{
	background: #f0f2f6 no-repeat center/contain;
}.skeleton-box {
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
@-webkit-keyframes shimmer {
  100% {
    transform: translateX(100%);
  }
}
@keyframes shimmer {
  100% {
    transform: translateX(100%);
  }
}
    [contenteditable]:empty:before {
        content: attr(data-placeholder);
        color: grey;
        display: inline-block;
    }

    .select2-container--default .select2-selection--single {
        border: 1px solid #d7dbde;
        height: 35px;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background: #2db4a3;
        color: white
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid #2db4a3;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
        border: 1px solid #2db4a3;
    }

    .select2-container--classic .select2-selection--single:focus {
        border: 1px solid #2db4a3
    }

    .loadingBarContainer {
        width: 100%;
        background: #eee;
        height: 10px;
        display: block;
        margin: 50px 0 0;
        overflow: hidden;
    }

    .loadingbar {
        width: 100%;
        height: 10px;
        background: #000;
        position: absolute;
        left: -100%;
    }

    .loadingCircle {
        width: 40px;
        height: 40px;
        margin: 30px auto 0;
        background: #fff;
        display: block;
        border-radius: 50%;
        position: relative;
        overflow: hidden;
    }

    .circleOuter {
        width: 30px;
        height: 30px;
        background: #fff;
        border-radius: 50%;
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
    }

    .circleLoader {
        width: 40px;
        height: 40px;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 1) 0%, rgba(125, 185, 232, 0) 100%);
        position: absolute;
        right: 50%;
        bottom: 50%;
        transform-origin: bottom right;
        z-index: 1;
        animation: rotateLoader 1.5s linear infinite;
    }

    @keyframes rotateLoader {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    .loader-screen {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 999999999;
        background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%) !important;
    }

    .teal-theme-bg,
    .teal-theme body,
    .teal-theme body.sidemenu-open,
    .teal-theme .bg-template,
    .teal-theme .loader-screen {
        background: #d4f29c;
        background: -moz-linear-gradient(-45deg, #d4f29c 0%, #00a888 100%);
        background: -webkit-gradient(left top, right bottom, color-stop(0%, #d4f29c), color-stop(100%, #00a888));
        background: -webkit-linear-gradient(-45deg, #d4f29c 0%, #00a888 100%);
        background: -o-linear-gradient(-45deg, #d4f29c 0%, #00a888 100%);
        background: -ms-linear-gradient(-45deg, #d4f29c 0%, #00a888 100%);
        background: linear-gradient(135deg, #d4f29c 0%, #00a888 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5ba8ff', endColorstr='#00a888', GradientType=1);
    }

    .form-control:focus {
        box-shadow: 0px 0px !important;
        border: 1px solid #11aa97;
    }

    .form-control {
        border-radius: 4px !important;
        padding: 0.4375rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.4285714;
    }

    #snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;

        color: #fff;
        border-radius: 2px;
        padding: 16px;
        position: fixed;
        z-index: 1;
        right: 2%;
        top: 90px;
    }

    #snackbar.show {
        z-index: 99999;
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    #snackbar-container {
        position: fixed;
        right: 2%;
        top: 90px;
    }

    .snackbar {
        visibility: hidden;
        min-width: 250px;
        margin-left: -125px;
        background-color: #333;
        margin-bottom: 20px;
        color: #fff;
        text-align: center;
        border-radius: 2px;
        padding: 16px;
        z-index: 1;
        right: 2%;
        top: 90px;
        font-size: 17px;
    }

    .snackbar.show {
        visibility: visible;
        -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
        animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }

    @-webkit-keyframes fadein {
        from {
            top: 0;
            opacity: 0;
        }

        to {
            top: 90px;
            opacity: 1;
        }
    }

    @keyframes fadein {
        from {
            top: 0;
            opacity: 0;
        }

        to {
            top: 90px;
            opacity: 1;
        }
    }

    @-webkit-keyframes fadeout {
        from {
            top: 90px;
            opacity: 1;
        }

        to {
            top: 0;
            opacity: 0;
        }
    }

    @keyframes fadeout {
        from {
            top: 90px;
            opacity: 1;
        }

        to {
            top: 0;
            opacity: 0;
        }
    }


    .form-selectgroup {
        display: inline-flex;
        margin: 0 -.5rem -.5rem 0;
        flex-wrap: wrap;
    }

    .form-selectgroup .form-selectgroup-item {
        margin: 0 .5rem .5rem 0;
    }

    .form-selectgroup-vertical {
        flex-direction: column;
    }

    .form-selectgroup-item {
        display: block;
        position: relative;
    }

    .form-selectgroup-input {
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
        opacity: 0;
    }

    .form-selectgroup-label {
        position: relative;
        display: block;
        min-width: calc(1.4285714em + 0.875rem + 2px);
        margin: 0;
        padding: 0.4375rem 0.75rem;
        font-size: 0.875rem;
        line-height: 1.4285714;
        color: #656d77;
        background: #ffffff;
        text-align: center;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid #dadcde;
        border-radius: 3px;
        transition: border-color .3s, background .3s, color .3s;
    }

    .form-selectgroup-label .icon:only-child {
        margin: 0 -.25rem;
    }

    .form-selectgroup-label:hover {
        color: #232e3c;
    }

    .form-selectgroup-check {
        display: inline-block;
        width: 1rem;
        height: 1rem;
        border: 1px solid rgba(101, 109, 119, 0.24);
        vertical-align: middle;
    }

    .form-selectgroup-input[type="checkbox"]+.form-selectgroup-label .form-selectgroup-check {
        border-radius: 4px;
    }

    .form-selectgroup-input[type="radio"]+.form-selectgroup-label .form-selectgroup-check {
        border-radius: 50%;
    }

    .form-selectgroup-input:checked+.form-selectgroup-label .form-selectgroup-check {
        background-color: #009688;
        background-repeat: repeat;
        background-position: center;
        background-size: 1rem;
        border-color: rgba(101, 109, 119, 0.24);
    }

    .form-selectgroup-input[type="checkbox"]:checked+.form-selectgroup-label .form-selectgroup-check {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' width='16' height='16'%3e%3cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 8.5l2.5 2.5l5.5 -5.5'/%3e%3c/svg%3e");
    }

    .form-selectgroup-input[type="radio"]:checked+.form-selectgroup-label .form-selectgroup-check {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3ccircle r='3' fill='%23ffffff' cx='8' cy='8' /%3e%3c/svg%3e");
    }

    .form-selectgroup-input:checked+.form-selectgroup-label {
        z-index: 1;
        color: #009688;
        background: #0096880d;
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

    /**
	Select group
	*/
    .form-selectgroup-pills {
        flex-wrap: wrap;
        align-items: flex-start;
    }

    .form-selectgroup-pills .form-selectgroup-item {
        flex-grow: 0;
    }

    .form-selectgroup-pills .form-selectgroup-label {
        border-radius: 50px;
    }

    /**
	Bootstrap color input
	*/
    .form-control-color::-webkit-color-swatch {
        border: none;
    }

    .avatar-upload {
        align-content: center;
        display: flex;
    }

    .avatar-upload {
        position: relative;
        height: 100%;
        width: 100%;
        align-items: center;
        border: 0;
    }

    .avatar-upload .avatar-edit {
        position: absolute;

        z-index: 1;
        top: 0px;
        margin-left: 160px;

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
        content: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' class='icon' width='20' height='20' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4' /><line x1='13.5' y1='6.5' x2='17.5' y2='10.5' /></svg>");


        color: #757575;
        position: absolute;

        left: 0;
        right: 0;
        text-align: center;
        margin: auto;
    }

    .avatar-upload .avatar-preview {
        width: 90px;
        height: 90px;
        position: relative;
        border-radius: 20px 40px;
        border: 6px solid #F8F8F8;
        box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
    }

    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 15px 30px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .table td,
    .table th {
        border-color: #fff !important;
        padding-left: 15px
    }

    .navbar-collapse .navbar {
        flex-grow: 1;
    }

    .navbar-light {
        box-shadow: inset 0 -1px 0 0 rgba(101, 109, 119, 0.16);
        background-color: #ffffff;
    }

    .navbar {
        align-items: stretch;
        min-height: 0.5rem;
        background: transparent;
        background-color: transparent;
        color: rgba(35, 46, 60, 0.7);
    }

    .p-0 {
        padding: 0 !important;
    }

    .m-0 {
        margin: 0 !important;
    }

    .navbar {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }

    @media only screen and (max-width: 1200px) {
        .screenA {
            display: none !important
        }

        .screenB {
            display: inline !important;
        }
    }

    .screenA {
        display: inline;
    }

    .screenB {
        display: none;
    }

    .pn-ProductNav_Wrapper {
        position: relative;
        padding: 0 0px;
        box-sizing: border-box;
    }

    .pn-ProductNav {
        /* Make this scrollable when needed */
        overflow-x: hidden;
        /* We don't want vertical scrolling */
        overflow-y: hidden;
        /* For WebKit implementations, provide inertia scrolling */
        -webkit-overflow-scrolling: touch;
        /* We don't want internal inline elements to wrap */
        white-space: nowrap;

        /* If JS present, let's hide the default scrollbar */
        . js & {
            /* Make an auto-hiding scroller for the 3 people using a IE */
            -ms-overflow-style: -ms-autohiding-scrollbar;

            /* Remove the default scrollbar for WebKit implementations */
            &::-webkit-scrollbar {
                display: none;
            }
        }

        /* positioning context for advancers */
        position: relative;
        // Crush the whitespace here
        font-size: 0;
    }

    .pn-ProductNav_Contents {
        float: left;
        transition: transform .2s ease-in-out;
    }

    .pn-ProductNav_Contents-no-transition {
        transition: none;
    }

    .pn-ProductNav_Link {
        text-decoration: none;
        color: #888;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        min-height: 44px;
        border: 1px solid transparent;
        padding: 0 11px;

        &+& {
            border-left-color: #eee;
        }

        &[aria-selected="true"] {
            color: #111;
        }
    }

    .pn-Advancer {
        /* Reset the button */
        appearance: none;
        background: transparent;
        padding: 0;
        border: 0;

        &:focus {
            outline: 0;
        }

        &:hover {
            cursor: pointer;
        }

        /* Now style it as needed */
        position: absolute;
        top: 0;
        bottom: 0;
        /* Set the buttons invisible by default */

        transition: opacity .3s;
    }

    .pn-Advancer_Left {
        left: 0;
        [ data-overflowing="
both"] ~ &,
[ data-overflowing="
left"] ~ & {
opacity: 1;
    }
    }

    .pn-Advancer_Right {
        right: 0;
        [ data-overflowing="
both"]  ~ &,
[ data-overflowing="
right"] ~ & {
opacity: 1;
    }
    }

    .pn-Advancer_Icon {
        width: 20px;
        height: 44px;
        fill: #bbb;
    }

    .pn-ProductNav_Indicator {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        width: 100px;
        background-color: transparent;
        transform-origin: 0 0;
        transition: transform .2s ease-in-out;
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
.avatar-upload .avatar-edit input + label {
  display: inline-block;
  width: 25px;
  height: 25px;
  align:center;
  text-align:center;
  margin-bottom: 0;
  border-radius: 100%;
  background: #FFFFFF;
  border: 1px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  font-weight: normal;
  transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
  content: "\f040";
  font-family: 'FontAwesome';
  color: #757575;
  position: absolute;
  
  left: 0;
  right: 0;
  text-align: center;
  margin: auto;
}
.avatar-upload .avatar-preview {
  width: 90px;
  height: 90px;
  position: relative;
  border-radius: 20px 40px;
  border: 6px solid #F8F8F8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 15px 30px;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}
</style>

<script>
    $(window).on('load', function() {
        //$('.loader-screen').fadeOut('slow');
        $('.loader-screen').delay(500).css('display', 'none');
    });
</script>

<body class="g-sidenav-show  bg-gray-100 homepage">