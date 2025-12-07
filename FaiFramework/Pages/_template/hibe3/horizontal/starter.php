<!DOCTYPE html>
<html lang="en" data-layout="horizontal">

<!-- Mirrored from dashui.codescandy.com/dashuipro/horizontal/starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Sep 2023 09:32:15 GMT -->

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Codescandy">

  <!-- Google tag (gtag.js) -->


  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/x-icon" href="../assets/images/favicon/favicon.ico">


  <!-- Libs CSS -->
  <link href="../assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/libs/%40mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="../assets/libs/simplebar/dist/simplebar.min.css" rel="stylesheet">
  <link rel="stylesheet" href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css'>
  <script src="https://code.iconify.design/2/2.0.4/iconify.min.js"></script>


  <link rel="stylesheet" href="../assets/css/theme.min.css">
  <link rel="stylesheet" href="../assets/css/theme.min.css">
  <link href="../assets/libs/dropzone/dist/dropzone.css" rel="stylesheet">
  <link href="../assets/libs/%40yaireo/tagify/dist/tagify.css" rel="stylesheet">
  <title>Starter Page | Dash UI - Bootstrap 5 Admin Dashboard Template</title>


  <style>
    :root {
      --c-text-primary: #282a32;
      --c-text-secondary: #686b87;
      --c-text-action: #404089;
      --c-accent-primary: #434ce8;
      --c-border-primary: #eff1f6;
      --c-background-primary: #ffffff;
      --c-background-secondary: #fdfcff;
      --c-background-tertiary: #ecf3fe;
      --c-background-quaternary: #e9ecf4;
    }

    body {
      -webkit-text-size-adjust: 100%;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
      background-color: var(--dashui-body-bg);
      color: var(--dashui-body-color);
      font-family: "Inter", "sans-serif";
      font-size: var(--dashui-body-font-size);
      font-weight: var(--dashui-body-font-weight);
      line-height: var(--dashui-body-line-height);
      margin: 0;
      text-align: var(--dashui-body-text-align);
    }

    body {
      line-height: 1.5;
      min-height: 100vh;
      background-color: var(--c-background-secondary);
      color: var(--c-text-primary);
    }

    .responsive-wrapper {
      width: 90%;
      max-width: 1280px;
      margin-left: auto;
      margin-right: auto;
    }

    /*
    .header {
      display: flex;
      align-items: center;
      height: 80px;
      border-bottom: 1px solid var(--c-border-primary);
      background-color: var(--c-background-primary);
    }

    .header-content {
      display: flex;
      align-items: center;
    }

    .header-content>a {
      display: none;
    }

    @media (max-width: 1200px) {
      .header-content {
        justify-content: space-between;
      }

      .header-content>a {
        display: inline-flex;
      }
    }

    .header-logo {
      margin-right: 2.5rem;
    }

    .header-logo a {
      display: flex;
      align-items: center;
    }

    .header-logo a div {
      flex-shrink: 0;
      position: relative;
    }

    .header-logo a div:after {
      display: block;
      content: "";
      position: absolute;
      left: 0;
      top: auto;
      right: 0;
      bottom: 0;
      overflow: hidden;
      height: 50%;
      border-bottom-left-radius: 8px;
      border-bottom-right-radius: 8px;
      background-color: rgba(255, 255, 255, 0.2);
      -webkit-backdrop-filter: blur(4px);
      backdrop-filter: blur(4px);
    }

    .header-navigation {
      display: flex;
      flex-grow: 1;
      align-items: center;
      justify-content: space-between;
    }

    @media (max-width: 1200px) {
      .header-navigation {
        display: none;
      }
    }

    .header-navigation-links {
      display: flex;
      align-items: center;
    }

    .header-navigation-links a {
      text-decoration: none;
      color: var(--c-text-action);
      font-weight: 500;
      transition: 0.15s ease;
    }

    .header-navigation-links a+* {
      margin-left: 1.5rem;
    }

    .header-navigation-links a:hover,
    .header-navigation-links a:focus {
      color: var(--c-accent-primary);
    }

    .header-navigation-actions {
      display: flex;
      align-items: center;
    }

    .header-navigation-actions>.avatar {
      margin-left: 0.75rem;
    }

    .header-navigation-actions>.icon-button+.icon-button {
      margin-left: 0.25rem;
    }

    .header-navigation-actions>.button+.icon-button {
      margin-left: 1rem;
    }
    */
    .button {
      font: inherit;
      color: inherit;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0 1em;
      height: 40px;
      border-radius: 8px;
      line-height: 1;
      border: 2px solid var(--c-border-primary);
      color: var(--c-text-action);
      font-size: 0.875rem;
      transition: 0.15s ease;
      background-color: var(--c-background-primary);
    }

    .button i {
      margin-right: 0.5rem;
      font-size: 1.25em;
    }

    .button span {
      font-weight: 500;
    }

    .button:hover,
    .button:focus {
      border-color: var(--c-accent-primary);
      color: var(--c-accent-primary);
    }

    .icon-button {
      font: inherit;
      color: inherit;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 8px;
      color: var(--c-text-action);
      transition: 0.15s ease;
    }

    .icon-button i {
      font-size: 1.25em;
    }

    .icon-button:focus,
    .icon-button:hover {
      background-color: var(--c-background-tertiary);
      color: var(--c-accent-primary);
    }

    .avatar {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 44px;
      border-radius: 50%;
      overflow: hidden;
    }

    .main {
      padding-top: 3rem;
    }

    .main-header {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
    }

    .main-header h1 {
      font-size: 1.75rem;
      font-weight: 600;
      line-height: 1.25;
    }

    @media (max-width: 550px) {
      .main-header h1 {
        margin-bottom: 1rem;
      }
    }

    .search {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
      max-width: 340px;
    }

    .search input {
      font: inherit;
      color: inherit;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0 1em 0 36px;
      height: 40px;
      border-radius: 8px;
      border: 2px solid var(--c-border-primary);
      color: var(--c-text-action);
      font-size: 0.875rem;
      transition: 0.15s ease;
      width: 100%;
      line-height: 1;
    }

    .search input::-moz-placeholder {
      color: var(--c-text-action);
    }

    .search input:-ms-input-placeholder {
      color: var(--c-text-action);
    }

    .search input::placeholder {
      color: var(--c-text-action);
    }

    .search input:focus,
    .search input:hover {
      border-color: var(--c-accent-primary);
    }

    .search button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 0;
      background-color: transparent;
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      font-size: 1.25em;
      color: var(--c-text-action);
      padding: 0;
      height: 40px;
    }

    .horizontal-tabs {
      margin-top: 1.5rem;
      display: flex;
      align-items: center;
      overflow-x: auto;
    }

    @media (max-width: 1000px) {
      .horizontal-tabs {
        scrollbar-width: none;
        position: relative;
      }

      .horizontal-tabs::-webkit-scrollbar {
        display: none;
      }
    }

    .horizontal-tabs a {
      display: inline-flex;
      flex-shrink: 0;
      align-items: center;
      height: 48px;
      padding: 0 0.25rem;
      font-weight: 500;
      color: inherit;
      border-bottom: 3px solid transparent;
      text-decoration: none;
      transition: 0.15s ease;
    }

    .horizontal-tabs a:hover,
    .horizontal-tabs a:focus,
    .horizontal-tabs a.active {
      color: var(--c-accent-primary);
      border-bottom-color: var(--c-accent-primary);
    }

    .horizontal-tabs a+* {
      margin-left: 1rem;
    }

    .content-header {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: space-between;
      padding-top: 3rem;
      margin-top: -1px;
      border-top: 1px solid var(--c-border-primary);
    }

    .content-header-intro h2 {
      font-size: 1.25rem;
      font-weight: 600;
    }

    .content-header-intro p {
      color: var(--c-text-secondary);
      margin-top: 0.25rem;
      font-size: 0.875rem;
      margin-bottom: 1rem;
    }

    @media (min-width: 800px) {
      .content-header-actions a:first-child {
        display: none;
      }
    }

    .content {
      border-top: 1px solid var(--c-border-primary);
      margin-top: 2rem;
      display: flex;
      align-items: flex-start;
    }

    .content-panel {
      display: none;
      max-width: 280px;
      width: 25%;
      padding: 2rem 1rem 2rem 0;
      margin-right: 3rem;
    }

    @media (min-width: 800px) {
      .content-panel {
        display: block;
      }
    }

    .vertical-tabs {
      display: flex;
      flex-direction: column;
    }

    .vertical-tabs a {
      display: flex;
      align-items: center;
      padding: 0.75em 1em;
      background-color: transparent;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 500;
      color: var(--c-text-action);
      transition: 0.15s ease;
    }

    .vertical-tabs a:hover,
    .vertical-tabs a:focus,
    .vertical-tabs a.active {
      background-color: var(--c-background-tertiary);
      color: var(--c-accent-primary);
    }

    .vertical-tabs a+* {
      margin-top: 0.25rem;
    }

    .content-main {
      padding-top: 2rem;
      padding-bottom: 6rem;
      flex-grow: 1;
    }

    .carddashboardui-grid {
      display: grid;
      grid-template-columns: repeat(1, 1fr);
      -moz-column-gap: 1.5rem;
      column-gap: 1.5rem;
      row-gap: 1.5rem;
    }

    @media (min-width: 600px) {
      .carddashboardui-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (min-width: 1200px) {
      .carddashboardui-grid {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    .carddashboardui {
      background-color: var(--c-background-primary);
      box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.05), 0 5px 15px 0 rgba(0, 0, 0, 0.05);
      border-radius: 8px;
      overflow: hidden;
      display: flex;
      flex-direction: column;
    }

    .carddashboardui-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      padding: 1.5rem 1.25rem 1rem 1.25rem;
    }

    .carddashboardui-header div {
      display: flex;
      align-items: center;
    }

    .carddashboardui-header div span {
      width: 40px;
      height: 40px;
      border-radius: 8px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .carddashboardui-header div span img {
      max-height: 100%;
    }

    .carddashboardui-header div h3 {
      margin-left: 0.75rem;
      font-weight: 500;
    }

    .toggle span {
      display: block;
      width: 40px;
      height: 24px;
      border-radius: 99em;
      background-color: var(--c-background-quaternary);
      box-shadow: inset 1px 1px 1px 0 rgba(0, 0, 0, 0.05);
      position: relative;
      transition: 0.15s ease;
    }

    .toggle span:before {
      content: "";
      display: block;
      position: absolute;
      left: 3px;
      top: 3px;
      height: 18px;
      width: 18px;
      background-color: var(--c-background-primary);
      border-radius: 50%;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.15);
      transition: 0.15s ease;
    }

    .toggle input {
      clip: rect(0 0 0 0);
      -webkit-clip-path: inset(50%);
      clip-path: inset(50%);
      height: 1px;
      overflow: hidden;
      position: absolute;
      white-space: nowrap;
      width: 1px;
    }

    .toggle input:checked+span {
      background-color: var(--c-accent-primary);
    }

    .toggle input:checked+span:before {
      transform: translateX(calc(100% - 2px));
    }

    .toggle input:focus+span {
      box-shadow: 0 0 0 4px var(--c-background-tertiary);
    }

    .carddashboardui-body {
      padding: 1rem 1.25rem;
      font-size: 0.875rem;
    }

    .carddashboardui-footer {
      margin-top: auto;
      padding: 1rem 1.25rem;
      display: flex;
      align-items: center;
      justify-content: flex-end;
      border-top: 1px solid var(--c-border-primary);
    }

    .carddashboardui-footer a {
      color: var(--c-text-action);
      text-decoration: none;
      font-weight: 500;
      font-size: 0.875rem;
    }

    html::-webkit-scrollbar {
      width: 12px;
    }

    html::-webkit-scrollbar-thumb {
      background-color: var(--c-text-primary);
      border: 4px solid var(--c-background-primary);
      border-radius: 99em;
    }
  </style>
  <style> 
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
</style>
  <style>
    /*
    .navbar-stisla {
      height: 70px;
      left: 250px;
      right: 5px;
      position: absolute;
      z-index: 890;
      background-color: transparent;
    }
    */
    .navbar-stisla.active {
      background-color: color(--c-background-primary);
    }

    .navbar-stisla-bg {
      content: ' ';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 115px;
      background-color: color(--c-background-primary);
      z-index: -1;
    }

    .navbar-stisla {
      align-items: center;
    }

    .navbar-stisla .navbar-stisla-brand {
      color: #fff;
      text-transform: uppercase;
      letter-spacing: 3px;
      font-weight: 700;
    }

    .navbar-stisla .form-inline .form-control {
      background-color: #fff;
      border-color: transparent;
      padding-left: 20px;
      padding-right: 0;
      margin-right: -6px;
      min-height: 46px;
      font-weight: 500;
      border-radius: 3px 0 0 3px;
      transition: all 1s;
    }

    .navbar-stisla .form-inline .form-control:focus,
    .navbar-stisla .form-inline .form-control:focus+.btn {
      position: relative;
      z-index: 9001;
    }

    .navbar-stisla .form-inline .form-control:focus+.btn+.search-backdrop {
      opacity: 0.6;
      visibility: visible;
    }

    .navbar-stisla .form-inline .form-control:focus+.btn+.search-backdrop+.search-result {
      opacity: 1;
      visibility: visible;
      top: 80px;
    }

    .navbar-stisla .form-inline .btn {
      border-radius: 0 3px 3px 0;
      background-color: #fff;
      padding: 9px 15px 9px 15px;
      border-color: transparent;
    }

    .navbar-stisla .form-inline .search-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9000;
      background-color: #000;
      opacity: 0;
      visibility: hidden;
      transition: all 0.5s;
    }

    .navbar-stisla .form-inline .search-result {
      position: absolute;
      z-index: 9002;
      top: 100px;
      background-color: #fff;
      border-radius: 3px;
      width: 450px;
      opacity: 0;
      visibility: hidden;
      transition: all 0.5s;
    }

    .navbar-stisla .form-inline .search-result:before {
      position: absolute;
      top: -26px;
      left: 34px;
      content: '\f0d8';
      font-weight: 600;
      color: #fff;
      font-size: 30px;
    }

    .navbar-stisla .form-inline .search-result .search-header {
      padding: 13px 18px 2px 18px;
      text-transform: uppercase;
      letter-spacing: 1.3px;
      font-weight: 600;
      font-size: 10px;
      color: color_lighten(font, 30%);
    }

    .navbar-stisla .form-inline .search-result .search-item {
      display: flex;
    }

    .navbar-stisla .form-inline .search-result .search-item a {
      display: block;
      padding: 13px 18px;
      text-decoration: none;
      color: color(fontdark);
      font-weight: 600;
      display: flex;
      align-items: center;
    }

    .navbar-stisla .form-inline .search-result .search-item a:hover {
      background-color: color_lighten(primary, 32%);
    }

    .navbar-stisla .form-inline .search-result .search-item a:not(.search-close) {
      width: 100%;
    }

    .navbar-stisla .form-inline .search-result .search-item a i {
      margin-left: 0 !important;
    }

    .navbar-stisla .form-inline .search-result .search-item .search-icon {
      width: 35px;
      height: 35px;
      line-height: 35px;
      text-align: center;
      border-radius: 50%;
    }

    .navbar-stisla .active .nav-link {
      color: #fff;
      font-weight: 700;
    }

    .navbar-stisla .navbar-stisla-text {
      color: #fff;
    }

    .navbar-stisla .nav-link {
      color: #f2f2f2;
      padding-left: 15px !important;
      padding-right: 15px !important;
      padding-top: 0 !important;
      padding-bottom: 0 !important;
      height: 100%;
    }

    .navbar-stisla .nav-link.nav-link-lg div {
      margin-top: 3px;
    }

    .navbar-stisla .nav-link.nav-link-lg i {
      margin-left: 0 !important;
      font-size: 18px;
      line-height: 32px;
    }

    .navbar-stisla .nav-link.nav-link-user {
      color: #fff;
      padding-top: 4px;
      padding-bottom: 4px;
      font-weight: 600;
    }

    .navbar-stisla .nav-link.nav-link-user img {
      width: 30px;
    }

    .navbar-stisla .nav-link.nav-link-img {
      padding-top: 4px;
      padding-bottom: 4px;
      border-radius: 50%;
      overflow: hidden;
    }

    .navbar-stisla .nav-link.nav-link-img .flag-icon {
      border-radius: 50%;
      line-height: 18px;
      height: 22px;
      width: 22px;
      background-size: cover;
    }

    .remove-caret:after {
      display: none;
    }

    .navbar-stisla .nav-link:hover {
      color: #fff;
    }

    .navbar-stisla .nav-link.disabled {
      color: #fff;
      opacity: 0.6;
    }

    .nav-collapse {
      display: flex;
    }

    @media only screen and (max-width: 600px)) {
      body.search-show .navbar-stisla .form-inline .search-element {
        display: inline-flex;
      }

      .navbar-stisla .form-inline .search-element {
        position: absolute;
        top: 10px;
        left: 10px;
        right: 10px;
        z-index: 892;
        display: none;
      }

      .navbar-stisla .form-inline .search-element .form-control {
        float: left;
        border-radius: 3px 0 0 3px;
        width: calc(100% - 43px) !important;
      }

      .navbar-stisla .form-inline .search-element .btn {
        margin-top: 1px;
        border-radius: 0 3px 3px 0;
      }

      .navbar-stisla .form-inline .search-result {
        width: 100%;
      }

      .navbar-stisla .form-inline .search-backdrop {
        display: none;
      }

      .navbar-stisla .nav-link.nav-link-lg div {
        display: none;
      }
    }

    @media only screen and (min-width: 600px) {
      .navbar-stisla .form-inline .search-element {
        display: flex;
      }
    }

    @media only screen and (min-width: 768px) {
      .collapse {
        position: relative;
      }

      .collapse .navbar-stisla-nav {
        position: absolute;
      }
    }

    @media (max-width: 1024px) {
      .nav-collapse {
        position: relative;
      }

      .nav-collapse .navbar-stisla-nav {
        position: absolute;
        top: 40px;
        left: 0;
        width: 200px;
        display: none;
      }

      .nav-collapse .navbar-stisla-nav.show {
        display: block;
      }

      .nav-collapse .navbar-stisla-nav .nav-item:first-child {
        border-radius: 3px 3px 0 0;
      }

      .nav-collapse .navbar-stisla-nav .nav-item:last-child {
        border-radius: 0 0 3px 3px;
      }

      .nav-collapse .navbar-stisla-nav .nav-item .nav-link {
        background-color: #fff;
        color: color(font);
      }

      .nav-collapse .navbar-stisla-nav .nav-item .nav-link:hover {
        background-color: color_lighten(light, 7.6%);
        color: color(primary);
      }

      .nav-collapse .navbar-stisla-nav .nav-item:focus>a,
      .nav-collapse .navbar-stisla-nav .nav-item.active>a {
        background-color: color(primary);
        color: #fff;
      }

      .navbar-stisla .dropdown-menu {
        position: absolute;
      }

      .navbar-stisla .navbar-stisla-nav {
        flex-direction: row;
      }

      .navbar-stisla-expand-lg .navbar-stisla-nav .dropdown-menu-right {
        right: 0;
        left: auto;
      }
    }

    .search-show .navbar-stisla .form-inline {
      display: block !important;
      display: block !important;
      position: absolute;
      top: 0;
    }
	.search-show .navbar-stisla .container-fluid {
		margin-left: -12px;
    }
  </style>


</head>

<body>
  <style>
    .sticky-top {
      position: -webkit-sticky;
      position: sticky;
      top: 0;
      z-index: 1020;
    }
  </style>
  <style>
    .sidebarWai {
      position: fixed;
      left: 0;
      top: 0;
      height: 100%;
      width: 78px;
      background: #fff;
      padding: 6px 14px;
      z-index: 88;
      transition: all 0.5s ease;
      box-shadow: 10px -1px 8px -7px rgba(171, 171, 171, 0.75);
      -webkit-box-shadow: 10px -1px 8px -7px rgba(171, 171, 171, 0.75);
      -moz-box-shadow: 10px -1px 8px -7px rgba(171, 171, 171, 0.75);
    }

    .sidebarWai.open {
      width: 250px;
      left: 0 !important;
    }

    .sidebarWai .logo-details {
      height: 60px;
      display: flex;
      align-items: center;
      position: relative;
    }

    .sidebarWai .logo-details .icon {
      opacity: 0;
      transition: all 0.5s ease;
    }

    .sidebarWai .logo-details .logo_name {
      color: #232e3c;
      font-size: 18px;
      font-weight: 600;
      opacity: 0;
      transition: all 0.5s ease;
    }

    .sidebarWai.open .logo-details .icon,
    .sidebarWai.open .logo-details .logo_name {
      opacity: 1;
    }

    .sidebarWai .logo-details #btn {
      position: absolute;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      font-size: 22px;
      transition: all 0.4s ease;
      font-size: 23px;
      text-align: center;
      cursor: pointer;
      transition: all 0.5s ease;
    }

    .sidebarWai.open .logo-details #btn {
      text-align: right;
    }

    .sidebarWai ol,
    ul {
      padding-left: 0rem;
    }

    .sidebarWai i {
      color: #232e3c;
      height: 60px;
      min-width: 50px;
      font-size: 28px;
      text-align: center;
      line-height: 60px;
    }

    .sidebarWai i.bx.bx-menu-alt-right {
      display: content;
    }

    .sidebarWai i.bx.bx-menu {
      display: none;
    }

    .sidebarWai .nav-list {
      margin-top: 20px;
      height: 100%;
    }

    .sidebarWai li {
      position: relative;
      margin: 8px 0;
      list-style: none;
    }

    .sidebarWai li .tooltip {
      position: absolute;
      top: -20px;
      left: calc(100% + 15px);
      z-index: 3;
      background: #fff;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
      padding: 6px 12px;
      border-radius: 4px;
      font-size: 15px;
      font-weight: 400;
      opacity: 0;
      white-space: nowrap;
      pointer-events: none;
      transition: 0s;
    }

    .sidebarWai li:hover .tooltip {
      opacity: 1;
      pointer-events: auto;
      transition: all 0.4s ease;
      top: 50%;
      transform: translateY(-50%);
    }

    .sidebarWai.open li .tooltip {
      display: none;
    }

    .sidebarWai input {
      font-size: 15px;
      color: #FFF;
      font-weight: 400;
      outline: none;
      height: 50px;
      width: 100%;
      width: 50px;
      border: none;
      border-radius: 12px;
      transition: all 0.5s ease;
      background: #1d1b31;
    }

    .sidebarWai.open input {
      padding: 0 20px 0 50px;
      width: 100%;
    }

    .sidebarWai .bx-search {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      font-size: 22px;
      background: #1d1b31;
      color: #FFF;
    }

    .sidebarWai.open .bx-search:hover {
      background: #1d1b31;
      color: #FFF;
    }

    .sidebarWai .bx-search:hover {
      background: #a23c3c;
      color: #284366;
    }

    .sidebarWai li a {
      display: flex;
      height: 100%;
      width: 100%;
      border-radius: 12px;
      align-items: center;
      text-decoration: none;
      transition: all 0.4s ease;
      background: #ffffff;
    }

    .sidebarWai li a:hover {
      background: #009688;
    }

    .sidebarWai li a .links_name {
      color: #232e3c;
      font-size: 15px;
      font-weight: 400;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: 0.4s;
    }

    .sidebarWai.open li a .links_name {
      opacity: 1;
      pointer-events: auto;
    }

    .sidebarWai li a:hover .links_name,
    .sidebarWai li a:hover i {
      transition: all 0.5s ease;
      color: #ffffff;
    }

    .sidebarWai li i {
      height: 50px;
      line-height: 50px;
      font-size: 18px;
      border-radius: 12px;
    }

    .sidebarWai li.profile {

      position: fixed;
      height: 60px;
      width: 78px;
      left: -0;
      bottom: 48px;
      padding: 10px 14px;
      background: #009688;
      transition: all 0.5s ease;
      overflow: hidden;
    }

    .sidebarWai.open li.profile {
      width: 250px;
      left: 0px;
    }

    .sidebarWai li .profile-details {
      display: flex;
      align-items: center;
      flex-wrap: nowrap;
    }

    .sidebarWai li img {
      height: 45px;
      width: 45px;
      object-fit: cover;
      border-radius: 6px;
      margin-right: 10px;
    }

    .sidebarWai li.profile .name,
    .sidebarWai li.profile .job {
      font-size: 15px;
      font-weight: 400;
      color: #fff;
      white-space: nowrap;
    }

    .sidebarWai li.profile .job {
      font-size: 12px;
    }

    .sidebarWai .profile #log_out {
      position: absolute;
      top: 50%;
      right: 0;
      transform: translateY(-50%);
      background: #fff;
      width: 100%;
      height: 60px;
      line-height: 60px;
      border-radius: 0px;
      transition: all 0.5s ease;
    }

    .sidebarWai.open .profile #log_out {
      width: 50px;
      background: none;
    }

    .home-section {
      position: relative;
      background: #E4E9F7;
      min-height: 100vh;
      top: 0;
      left: 78px;
      width: calc(100% - 78px);
      transition: all 0.5s ease;
      z-index: 2;
    }

    .sidebarWai.open~.home-section {
      left: 250px;
      width: calc(100% - 250px);
    }

    .home-section .text {
      display: inline-block;
      color: #11101d;
      font-size: 25px;
      font-weight: 500;
      margin: 18px
    }

    @media (max-width: 1220px) {
      .sidebarWai li .tooltip {
        display: none;
      }

      .sidebarWai li.profile {
        left: -78px;
      }

      .sidebarWai {
        left: -78px !important;
      }

    }
	.navbar-toggler:focus {
  box-shadow:0 0 0 0;
  outline:0;
  text-decoration:none
}
  </style>
  <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>
  <style>
    :root {
      --swiper-image-ratio: 33.3%;
      /* ratio 16:9 = 56.25% */

      --swiper-width: 70%;
      --swiper-inactive-scale: .85;
      /* makes the other slide smaller */

      /* responsive settings */
      --swiper-mobile-width: 90%;
      --swiper-mobile-inactive-scale: .95;
    }

    .swiper {
      position: relative;
      width: 100%;
      height: calc(var(--swiper-width) * var(--swiper-image-ratio) / 100%);
      overflow: hidden;
    }

    .swiper-slide {
      position: relative;
      width: var(--swiper-width);
      opacity: .5;
      transform: scale(.84);
      transition: all .3s ease-in-out;
      overflow: hidden;
      border-radius: 0.4285rem;
    }

    .swiper-backface-hidden .swiper-slide {
      transform: scale(.84) translateZ(0);
    }

    .swiper-slide.swiper-slide-active {
      transform: scale(1) !important;
      opacity: 1 !important;
    }

    .swiper-backface-hidden .swiper-slide.swiper-slide-active {
      transform: scale(1) translateZ(0) !important;
    }

    .swiper-image {
      position: relative;
      width: 100%;
      padding-top: var(--swiper-image-ratio);
    }

    .swiper-image .image {
      position: absolute;
      top: 0;
      left: 0;
      bottom: 0;
      width: 100%;
      height: 100%;
      background-color: #929ec9;
    }

    .swiper-button-next,
    .swiper-button-prev {
      padding: 8px;
      width: 12px;
      height: 12px;
      margin-top: 0;
      background-color: rgba(0, 0, 0, .4);
      border-radius: 50%;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
      color: #fff;
      font-size: 12px;
    }

    .swiper-button-next {
      transform: translate(50%, -50%);
      right: calc((100% - var(--swiper-width)) / 2);
    }

    .swiper-button-prev {
      transform: translate(-50%, -50%);
      left: calc((100% - var(--swiper-width)) / 2);
    }

    @media only screen and (max-width: 768px) {
      .swiper {
        height: calc(var(--swiper-mobile-width) * var(--swiper-image-ratio) / 100%);
      }

      .swiper-slide {
        width: var(--swiper-mobile-width);
        transform: scale(var(--swiper-mobile-inactive-scale));
      }

      .swiper-backface-hidden .swiper-slide.swiper-slide {
        transform: scale(var(--swiper-mobile-inactive-scale)) translateZ(0);
      }

      .swiper-button-next {
        right: calc((100% - var(--swiper-mobile-width)) / 2);
      }

      .swiper-button-prev {
        left: calc((100% - var(--swiper-mobile-width)) / 2);
      }
    }
  </style>
  <style>
    .checkbox-group {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      width: 100%;

      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .checkbox-group>* {
      margin: 0.5rem 0.5rem;
    }

    .checkbox-group-legend {
      font-size: 1.5rem;
      font-weight: 700;
      color: #9c9c9c;
      text-align: center;
      line-height: 1.125;
      margin-bottom: 1.25rem;
    }

    .checkbox-input {
      clip: rect(0 0 0 0);
      -webkit-clip-path: inset(100%);
      clip-path: inset(100%);
      height: 1px;
      overflow: hidden;
      position: absolute;
      white-space: nowrap;
      width: 1px;
    }

    .checkbox-input:checked+.checkbox-tile {
      border-color: #2260ff;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
      color: #2260ff;
    }

    .checkbox-input:checked+.checkbox-tile:before {
      transform: scale(1);
      opacity: 1;
      background-color: #2260ff;
      border-color: #2260ff;
    }

    .checkbox-input:checked+.checkbox-tile .checkbox-icon,
    .checkbox-input:checked+.checkbox-tile .checkbox-label {
      color: #2260ff;
    }

    .checkbox-input:focus+.checkbox-tile {
      border-color: #2260ff;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #b5c9fc;
    }

    .checkbox-input:focus+.checkbox-tile:before {
      transform: scale(1);
      opacity: 1;
    }
    .checkbox-input:disabled+.checkbox-tile {
      border-color: transparent;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
      color: #2260ff;
    }
    .checkbox-input:disabled+.checkbox-tile:before {
      border-color: transparent;
      box-shadow: 0 0x 0px ;
      color: #2260ff;
    }
    .checkbox-tile {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      width: 7rem;
      min-height: 7rem;
      border-radius: 0.5rem;
      border: 2px solid #b5bfd9;
      background-color: #fff;
      /* box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1); */
      transition: 0.15s ease;
      cursor: pointer;
      position: relative;
    }

    .checkbox-tile:before {
      content: "";
      position: absolute;
      display: block;
      width: 1.25rem;
      height: 1.25rem;
      border: 2px solid #b5bfd9;
      background-color: #fff;
      border-radius: 50%;
      top: 0.25rem;
      left: 0.25rem;
      opacity: 0;
      transform: scale(0);
      transition: 0.25s ease;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
      background-size: 12px;
      background-repeat: no-repeat;
      background-position: 50% 50%;
    }

    .checkbox-tile:hover {
      border-color: #2260ff;
    }

    .checkbox-tile:hover:before {
      transform: scale(1);
      opacity: 1;
    }

    .checkbox-icon {
      transition: 0.375s ease;
      color: #494949;
    }

    .checkbox-icon svg {
      width: 3rem;
      height: 3rem;
    }

    .checkbox-label {
      color: #707070;
      transition: 0.375s ease;
      text-align: center;
    }
  </style>
  <style>
    .main-sidebar .sidebar-brand {
      display: inline-block;
      width: 100%;
      text-align: center;
      height: 60px;
      line-height: 60px;
    }

    .main-sidebar .sidebar-brand.sidebar-brand-sm {
      display: none;
    }

    .main-sidebar .sidebar-brand a {
      text-decoration: none;
      text-transform: uppercase;
      letter-spacing: 1.5px;
      font-weight: 700;
      color: #000;
    }

    .main-sidebar .sidebar-user {
      display: inline-block;
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
    }

    .main-sidebar .sidebar-user .sidebar-user-picture {
      float: left;
      margin-right: 10px;
    }

    .main-sidebar .sidebar-user .sidebar-user-picture img {
      width: 50px;
      border-radius: 50%;
    }

    .main-sidebar .sidebar-menu {
      padding: 0;
      margin: 0;
    }

    .main-sidebar .sidebar-menu li {
      display: block;
    }

    .main-sidebar .sidebar-menu li.menu-header {
      padding: 3px 15px;
      color: color_lighten(font, 30%);
      font-size: 10px;
      text-transform: uppercase;
      letter-spacing: 1.3px;
      font-weight: 600;
    }

    .main-sidebar .sidebar-menu li.menu-header:not(:first-child) {
      margin-top: 10px;
    }

    .main-sidebar .sidebar-menu li a {
      position: relative;
      display: flex;
      align-items: center;
      height: 50px;
      padding: 0 20px;
      width: 100%;
      letter-spacing: 0.3px;
      color: color_lighten(font, 10%);
      text-decoration: none;
    }

    .main-sidebar .sidebar-menu li a .badge {
      float: right;
      padding: 5px 10px;
      margin-top: 2px;
    }

    .main-sidebar .sidebar-menu li a i {
      width: 28px;
      margin-right: 20px;
      text-align: center;
    }

    .main-sidebar .sidebar-menu li a span {
      margin-top: 3px;
      width: 100%;
    }

    .main-sidebar .sidebar-menu li a:hover {
      background-color: color_lighten(light, 7.6%);
    }

    .main-sidebar .sidebar-menu li.active a {
      color: color(primary);
      font-weight: 600;
      background-color: color_lighten(light, 7.6%);
    }

    .main-sidebar .sidebar-menu li.active ul.dropdown-menu {
      background-color: color_lighten(light, 7.6%);
    }

    .main-content {
      padding-left: 280px;
      padding-right: 30px;
      padding-top: 80px;
      width: 100%;
      position: relative;
    }

    .main-footer {
      padding: 20px 30px 20px 280px;
      margin-top: 40px;
      color: color(muted);
      border-top: 1px solid color(light);
      display: inline-block;
      width: 100%;
    }

    .main-footer .footer-left {
      float: left;
    }

    .main-footer .footer-right {
      float: right;
    }

    .simple-footer {
      text-align: center;
      margin-top: 40px;
      margin-bottom: 40px;
    }

    body:not(.sidebar-mini) .sidebar-style-1 .sidebar-menu li.active a {
      background-color: color(primary);
      color: #fff;
    }

    body:not(.sidebar-mini) .sidebar-style-1 .sidebar-menu li.active ul.dropdown-menu li a {
      color: color_lighten(primary, 28%);
    }

    body:not(.sidebar-mini) .sidebar-style-1 .sidebar-menu li.active ul.dropdown-menu li a:hover {
      background-color: color(primary);
      color: #fff;
    }

    body:not(.sidebar-mini) .sidebar-style-1 .sidebar-menu li.active ul.dropdown-menu li.active a {
      color: #fff;
    }

    body:not(.sidebar-mini) .sidebar-style-2 .sidebar-menu>li.active>a {
      padding-left: 16px;
      background-color: transparent;
      position: relative;
    }

    body:not(.sidebar-mini) .sidebar-style-2 .sidebar-menu>li.active>a:before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      height: 25px;
      width: 4px;
      background-color: color(primary);
    }

    body:not(.sidebar-mini) .sidebar-style-2 .sidebar-menu li.active ul.dropdown-menu li a {
      padding-left: 61px;
      background-color: #fff;
    }

    @media (max-width: 1024px) {
      .sidebar-gone-hide {
        display: none !important;
      }

      .sidebar-gone-show {
        display: block !important;
      }

      .main-sidebar {
        position: fixed !important;
        margin-top: 0 !important;
        z-index: 891;
      }

      body.layout-2 .main-wrapper,
      body.layout-3 .main-wrapper {
        width: 100%;
        padding: 0;
        display: block;
      }

      .main-content {
        padding-left: 30px;
        padding-right: 30px;
        width: 100% !important;
      }

      .main-footer {
        padding-left: 30px;
      }

      body.search-show {
        overflow: hidden;
      }

      body.search-show .navbar {
        z-index: 892;
      }

      body.sidebar-show {
        overflow: hidden;
      }

      body.search-show:before,
      body.sidebar-show:before {
        content: '';
        position: fixed;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background-color: #000;
        opacity: 0;
        z-index: 891;
        -webkit-animation-name: fadeinbackdrop;
        animation-name: fadeinbackdrop;
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: forwards;
        animation-fill-mode: forwards;
      }

      @-webkit-keyframes fadeinbackdrop {
        to {
          opacity: 0.6;
        }
      }

      @keyframes fadeinbackdrop {
        to {
          opacity: 0.6;
        }
      }
    }
  </style>
  <style>
    .d-none {
      display: none !important
    }

    .d-inline {
      display: inline !important
    }

    .d-inline-block {
      display: inline-block !important
    }

    .d-block {
      display: block !important
    }

    .d-table {
      display: table !important
    }

    .d-table-row {
      display: table-row !important
    }

    .d-table-cell {
      display: table-cell !important
    }

    .d-flex {
      display: -ms-flexbox !important;
      display: flex !important
    }

    .d-inline-flex {
      display: -ms-inline-flexbox !important;
      display: inline-flex !important
    }

    @media (min-width:576px) {
      .d-sm-none {
        display: none !important
      }

      .d-sm-inline {
        display: inline !important
      }

      .d-sm-inline-block {
        display: inline-block !important
      }

      .d-sm-block {
        display: block !important
      }

      .d-sm-table {
        display: table !important
      }

      .d-sm-table-row {
        display: table-row !important
      }

      .d-sm-table-cell {
        display: table-cell !important
      }

      .d-sm-flex {
        display: -ms-flexbox !important;
        display: flex !important
      }

      .d-sm-inline-flex {
        display: -ms-inline-flexbox !important;
        display: inline-flex !important
      }
    }

    @media (min-width:768px) {
      .d-md-none {
        display: none !important
      }

      .d-md-inline {
        display: inline !important
      }

      .d-md-inline-block {
        display: inline-block !important
      }

      .d-md-block {
        display: block !important
      }

      .d-md-table {
        display: table !important
      }

      .d-md-table-row {
        display: table-row !important
      }

      .d-md-table-cell {
        display: table-cell !important
      }

      .d-md-flex {
        display: -ms-flexbox !important;
        display: flex !important
      }

      .d-md-inline-flex {
        display: -ms-inline-flexbox !important;
        display: inline-flex !important
      }
    }

    @media (min-width:992px) {
      .d-lg-none {
        display: none !important
      }

      .d-lg-inline {
        display: inline !important
      }

      .d-lg-inline-block {
        display: inline-block !important
      }

      .d-lg-block {
        display: block !important
      }

      .d-lg-table {
        display: table !important
      }

      .d-lg-table-row {
        display: table-row !important
      }

      .d-lg-table-cell {
        display: table-cell !important
      }

      .d-lg-flex {
        display: -ms-flexbox !important;
        display: flex !important
      }

      .d-lg-inline-flex {
        display: -ms-inline-flexbox !important;
        display: inline-flex !important
      }
    }

    @media (min-width:1200px) {
      .d-xl-none {
        display: none !important
      }

      .d-xl-inline {
        display: inline !important
      }

      .d-xl-inline-block {
        display: inline-block !important
      }

      .d-xl-block {
        display: block !important
      }

      .d-xl-table {
        display: table !important
      }

      .d-xl-table-row {
        display: table-row !important
      }

      .d-xl-table-cell {
        display: table-cell !important
      }

      .d-xl-flex {
        display: -ms-flexbox !important;
        display: flex !important
      }

      .d-xl-inline-flex {
        display: -ms-inline-flexbox !important;
        display: inline-flex !important
      }
    }

    @media print {
      .d-print-none {
        display: none !important
      }

      .d-print-inline {
        display: inline !important
      }

      .d-print-inline-block {
        display: inline-block !important
      }

      .d-print-block {
        display: block !important
      }

      .d-print-table {
        display: table !important
      }

      .d-print-table-row {
        display: table-row !important
      }

      .d-print-table-cell {
        display: table-cell !important
      }

      .d-print-flex {
        display: -ms-flexbox !important;
        display: flex !important
      }

      .d-print-inline-flex {
        display: -ms-inline-flexbox !important;
        display: inline-flex !important
      }
    }
  </style>
  <style>
    @media (max-width: 575.98px) {
      .navbar-stisla .form-inline .search-element .form-control {
        float: left;
        border-radius: 3px 0 0 3px;
        width: calc(100% - 43px) !important;
      }
    }

    .form-inline {
      display: -ms-flexbox;
      display: inherit;
      -ms-flex-flow: row wrap;
      flex-flow: row wrap;
      -ms-flex-align: center;
      align-items: center;
    }

    .bg-primary {
      background: linear-gradient(310deg, #17ad37 0%, #98ec2d 100%);
      color: rgba(255, 255, 255, 0.7);
    }

    @media (max-width: 1075.98px) {
      body.search-show .navbar .form-inline .search-element {
        display: inline-flex;
      }
    }

    @media (max-width: 1075.98px) {
      .navbar .form-inline .search-element {
        position: absolute;
        top: 10px;
        left: -15px;
        right: 30px;
        z-index: 892;
        display: none;
      }
    }

    @media (min-width: 576px) and (max-width: 767.98px) {
      .navbar .form-inline .search-element {
        display: block;
      }
    }

    @media (max-width: 1075.98px) {
      .navbar .form-inline .search-result {
        width: 100%;
      }
    }

    .navbar .form-inline .search-result {
      position: absolute;
      z-index: 9002;
      top: 100px;
      background-color: #fff;
      border-radius: 3px;
      width: 450px;
      opacity: 0;
      visibility: hidden;
      transition: all .5s;
    }
  </style>
  <style>
    .listview-title {
      color: #958d9e;
      padding: 7px 16px;
      font-size: 13px;
      font-weight: 500;
    }

    .listview {
      display: block;
      padding: 0;
      margin: 0;
      color: #27173E;
      background: #fff;
      border-top: 1px solid #DCDCE9;
      border-bottom: 1px solid #DCDCE9;
      line-height: 1.3em;
    }

    .listview .text-muted {
      font-size: 13px;
      color: #A9ABAD !important;
    }

    .listview .text-small {
      font-size: 13px;
      color: #958d9e;
    }

    .listview .text-xsmall {
      font-size: 11px;
      color: #A9ABAD;
    }

    .listview>li {
      padding: 11px 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: relative;
      min-height: 50px;
    }

    .listview>li:after {
      content: "";
      display: block;
      position: absolute;
      left: 0;
      right: 0;
      bottom: 0;
      height: 1px;
      background: #DCDCE9;
    }

    .listview>li:last-child:after {
      display: none;
    }

    .listview>li footer,
    .listview>li header {
      font-size: 12px;
      margin: 0;
      line-height: 1.2em;
    }

    .listview>li footer {
      color: #958d9e;
      margin-top: 3px;
    }

    .listview>li header {
      margin-bottom: 3px;
    }

    .listview>li.divider-title {
      background: rgba(220, 220, 233, 0.5);
      margin-top: -1px;
      border-top: 1px solid #DCDCE9;
      border-bottom: 1px solid #DCDCE9;
      padding: 12px 16px;
      font-size: 13px;
      min-height: auto;
      color: #958d9e;
    }

    .listview>li.divider-title:after {
      display: none;
    }

    .listview.flush {
      border-top: 0;
      border-bottom: 0;
    }

    .listview.transparent {
      background: transparent;
    }

    .link-listview>li {
      padding: 0;
      min-height: auto;
    }

    .link-listview>li a {
      padding: 11px 36px 11px 16px;
      min-height: 50px;
      display: flex;
      width: 100%;
      align-items: center;
      justify-content: space-between;
      color: #27173E !important;
    }

    .link-listview>li a:after {
      content: "\f3d1";
      font-family: "Ionicons";
      font-size: 18px;
      position: absolute;
      right: 16px;
      height: 18px;
      top: 50%;
      margin-top: -9px;
      line-height: 1em;
      color: #A9ABAD;
      opacity: 0.6;
    }

    .link-listview>li a:active {
      background: rgba(220, 220, 233, 0.3);
    }

    .link-listview>li.active a {
      background: rgba(220, 220, 233, 0.3) !important;
    }

    .image-listview>li {
      padding: 0;
      min-height: auto;
    }

    .image-listview>li:after {
      left: 68px;
    }

    .image-listview>li .item {
      padding: 11px 16px;
      width: 100%;
      min-height: 50px;
      display: flex;
      align-items: center;
    }

    .image-listview>li .item .image {
      width: 36px;
      height: 36px;
      border-radius: 400px;
      margin-right: 16px;
    }

    .image-listview>li .item .icon-box {
      min-width: 36px;
      max-width: 36px;
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      line-height: 1em;
      font-size: 22px;
      border-radius: 400px;
      margin-right: 16px;
    }

    .image-listview>li .item .in {
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
    }

    .image-listview>li a.item {
      color: #27173E !important;
      padding-right: 36px;
    }

    .image-listview>li a.item:active {
      background: rgba(220, 220, 233, 0.3);
    }

    .image-listview>li a.item:after {
      content: "\f3d1";
      font-family: "Ionicons";
      font-size: 18px;
      position: absolute;
      right: 16px;
      color: #A9ABAD;
      opacity: 0.6;
      line-height: 1em;
      height: 18px;
      top: 50%;
      margin-top: -9px;
    }

    .image-listview>li.active .item {
      background: rgba(220, 220, 233, 0.3) !important;
    }

    .image-listview.text>li:after {
      left: 16px;
    }

    .image-listview.media>li {
      border-bottom: 1px solid #DCDCE9;
    }

    .image-listview.media>li:last-child {
      border-bottom: 0;
    }

    .image-listview.media>li .imageWrapper {
      margin-right: 16px;
    }

    .image-listview.media>li:after {
      display: none;
    }

    .listview.no-line>li:after,
    .listview.no-line .item:after {
      display: none;
    }

    .listview.no-space>li .item {
      padding: 0;
    }

    .listview.no-space>li {
      padding-left: 0;
      padding-right: 0;
    }


    .sidebar-balance {
      padding: 6px 16px;
      background: #6236FF;
    }

    .sidebar-balance .listview-title {
      padding-right: 0;
      padding-left: 0;
      color: #FFF;
      opacity: .6;
    }

    .sidebar-balance .amount {
      font-weight: 700;
      letter-spacing: -0.01em;
      line-height: 1em;
      font-weight: 32px;
      color: #FFF;
      margin-bottom: 6px;
    }

    .profileBox {
      padding: 0 16px;
      display: flex;
      align-items: center;
    }

    .profileBox .image-wrapper {
      margin-right: 16px;
    }

    .profileBox .in {
      line-height: 1.4em;
      padding-right: 25px;
    }

    .profileBox .in strong {
      display: block;
      font-weight: 500;
      color: #27173E;
    }

    .profileBox .in .text-muted {
      font-size: 14px;
      color: #A9ABAD !important;
    }

    .action-group {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      padding: 0px 16px 10px 16px;
      background: #6236FF;
    }

    .action-group .action-button {
      padding: 10px 2px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      font-size: 11px;
      line-height: 1em;
      color: rgba(255, 255, 255, 0.7);
    }

    .action-group .action-button .iconbox {
      background: rgba(0, 0, 0, 0.3);
      width: 38px;
      height: 38px;
      margin: 0 auto 8px auto;
      border-radius: 100%;
      font-size: 18px;
      color: #FFF;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .action-group .action-button:last-child {
      border-right: 0;
    }

    .sidebar-balance {
      padding: 6px 16px;
      background: #6236FF;
    }

    .sidebar-balance .listview-title {
      padding-right: 0;
      padding-left: 0;
      color: #FFF;
      opacity: .6;
    }

    .sidebar-balance .amount {
      font-weight: 700;
      letter-spacing: -0.01em;
      line-height: 1em;
      font-weight: 32px;
      color: #FFF;
      margin-bottom: 6px;
    }

    dl,
    ol,
    ul {
      margin-bottom: 1rem;
      margin-top: 0;
      list-style: none;
    }
  </style>
  <style>
    array{
      display: none;
    }
  </style>
  <style>
  
.navbar-vertical-soft-ui .navbar-brand>img,
.navbar-vertical-soft-ui .navbar-brand-img {
  max-width: 100%;
  max-height: 2rem;
}

.navbar-vertical-soft-ui .navbar-nav .nav-link {
  padding-left: 0px;
  padding-right: 1rem;
  font-weight: 500;
  color: #67748e;
}

.navbar-vertical-soft-ui .navbar-nav .nav-link>i {
  min-width: 1.8rem;
  font-size: 0.9375rem;
  line-height: 1.5rem;
}

.navbar-vertical-soft-ui .navbar-nav .nav-link .dropdown-menu {
  border: none;
}

.navbar-vertical-soft-ui .navbar-nav .nav-link .dropdown-menu .dropdown-menu {
  margin-left: 0.5rem;
}

.navbar-vertical-soft-ui .navbar-nav .nav-sm .nav-link {
  font-size: 0.8125rem;
}

.navbar-vertical-soft-ui .navbar-nav .nav-link {
  display: flex;
  align-items: center;
  white-space: nowrap;
}

.navbar-vertical-soft-ui .navbar-heading {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.04em;
}

.navbar-vertical-soft-ui.navbar-expand-xs {
  display: block;
  position: relative;
  top: 0;
  bottom: 0;
  width: 100%;
  max-width: 15.625rem !important;
  overflow-y: auto;
  padding: 0;
  box-shadow: none;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-collapse {
  display: block;
  overflow: auto;
  height: calc(100vh - 360px);
}

.navbar-vertical-soft-ui.navbar-expand-xs>[class*="container"] {
  flex-direction: column;
  align-items: stretch;
  min-height: 100%;
  padding-left: 0;
  padding-right: 0;
}

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
  .navbar-vertical-soft-ui.navbar-expand-xs>[class*="container"] {
    min-height: none;
    height: 100%;
  }
}

.navbar-vertical-soft-ui.navbar-expand-xs.fixed-start {
  left: 0;
}

.navbar-vertical-soft-ui.navbar-expand-xs.fixed-end {
  right: 0;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav .nav-link {
  padding-top: 0.675rem;
  padding-bottom: 0.675rem;
  margin: 0 1rem;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav .nav-link .nav-link-text,
.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav .nav-link .sidenav-mini-icon,
.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav .nav-link .sidenav-normal,
.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav .nav-link i {
  pointer-events: none;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav .nav-item {
  width: 100%;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav>.nav-item {
  margin-top: 0.125rem;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav>.nav-item .icon .ni {
  top: 0;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav>.nav-item>.nav-link .icon svg .color-background {
  fill: #3A416F;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav>.nav-item>.nav-link .icon svg .color-foreground {
  fill: #141727;
}

.navbar-vertical-soft-ui.navbar-expand-xs .lavalamp-object {
  width: calc(100% - 1rem) !important;
  background: theme-color("primary");
  color: color-yiq(#cb0c9f);
  margin-right: 0.5rem;
  margin-left: 0.5rem;
  padding-left: 1rem;
  padding-right: 1rem;
  border-radius: 0.25rem;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav .nav .nav-link {
  padding-top: 0.45rem;
  padding-bottom: 0.45rem;
  padding-left: 15px;
}

.navbar-vertical-soft-ui.navbar-expand-xs .navbar-nav .nav .nav-link>span.sidenav-normal {
  transition: all 0.1s ease 0s;
}

@media (min-width: 576px) {
  .navbar-vertical-soft-ui.navbar-expand-sm {
    display: block;
    position: fixed;
    top: 0;
    bottom: 0;
    width: 100%;
    max-width: 15.625rem !important;
    overflow-y: auto;
    padding: 0;
    box-shadow: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-collapse {
    display: block;
    overflow: auto;
    height: calc(100vh - 360px);
  }

  .navbar-vertical-soft-ui.navbar-expand-sm>[class*="container"] {
    flex-direction: column;
    align-items: stretch;
    min-height: 100%;
    padding-left: 0;
    padding-right: 0;
  }
}

@media all and (min-width: 576px) and (-ms-high-contrast: none),
(min-width: 576px) and (-ms-high-contrast: active) {
  .navbar-vertical-soft-ui.navbar-expand-sm>[class*="container"] {
    min-height: none;
    height: 100%;
  }
}

@media (min-width: 576px) {
  .navbar-vertical-soft-ui.navbar-expand-sm.fixed-start {
    left: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm.fixed-end {
    right: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav .nav-link {
    padding-top: 0.675rem;
    padding-bottom: 0.675rem;
    margin: 0 1rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav .nav-link .nav-link-text,
  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav .nav-link .sidenav-mini-icon,
  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav .nav-link .sidenav-normal,
  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav .nav-link i {
    pointer-events: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav .nav-item {
    width: 100%;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav>.nav-item {
    margin-top: 0.125rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav>.nav-item .icon .ni {
    top: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav>.nav-item>.nav-link .icon svg .color-background {
    fill: #3A416F;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav>.nav-item>.nav-link .icon svg .color-foreground {
    fill: #141727;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .lavalamp-object {
    width: calc(100% - 1rem) !important;
    background: theme-color("primary");
    color: color-yiq(#cb0c9f);
    margin-right: 0.5rem;
    margin-left: 0.5rem;
    padding-left: 1rem;
    padding-right: 1rem;
    border-radius: 0.25rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav .nav .nav-link {
    padding-top: 0.45rem;
    padding-bottom: 0.45rem;
    padding-left: 15px;
  }

  .navbar-vertical-soft-ui.navbar-expand-sm .navbar-nav .nav .nav-link>span.sidenav-normal {
    transition: all 0.1s ease 0s;
  }
}

@media (min-width: 768px) {
  .navbar-vertical-soft-ui.navbar-expand-md {
    display: block;
    position: fixed;
    top: 0;
    bottom: 0;
    width: 100%;
    max-width: 15.625rem !important;
    overflow-y: auto;
    padding: 0;
    box-shadow: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-collapse {
    display: block;
    overflow: auto;
    height: calc(100vh - 360px);
  }

  .navbar-vertical-soft-ui.navbar-expand-md>[class*="container"] {
    flex-direction: column;
    align-items: stretch;
    min-height: 100%;
    padding-left: 0;
    padding-right: 0;
  }
}

@media all and (min-width: 768px) and (-ms-high-contrast: none),
(min-width: 768px) and (-ms-high-contrast: active) {
  .navbar-vertical-soft-ui.navbar-expand-md>[class*="container"] {
    min-height: none;
    height: 100%;
  }
}

@media (min-width: 768px) {
  .navbar-vertical-soft-ui.navbar-expand-md.fixed-start {
    left: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-md.fixed-end {
    right: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav .nav-link {
    padding-top: 0.675rem;
    padding-bottom: 0.675rem;
    margin: 0 1rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav .nav-link .nav-link-text,
  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav .nav-link .sidenav-mini-icon,
  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav .nav-link .sidenav-normal,
  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav .nav-link i {
    pointer-events: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav .nav-item {
    width: 100%;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav>.nav-item {
    margin-top: 0.125rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav>.nav-item .icon .ni {
    top: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav>.nav-item>.nav-link .icon svg .color-background {
    fill: #3A416F;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav>.nav-item>.nav-link .icon svg .color-foreground {
    fill: #141727;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .lavalamp-object {
    width: calc(100% - 1rem) !important;
    background: theme-color("primary");
    color: color-yiq(#cb0c9f);
    margin-right: 0.5rem;
    margin-left: 0.5rem;
    padding-left: 1rem;
    padding-right: 1rem;
    border-radius: 0.25rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav .nav .nav-link {
    padding-top: 0.45rem;
    padding-bottom: 0.45rem;
    padding-left: 15px;
  }

  .navbar-vertical-soft-ui.navbar-expand-md .navbar-nav .nav .nav-link>span.sidenav-normal {
    transition: all 0.1s ease 0s;
  }
}

@media (min-width: 992px) {
  .navbar-vertical-soft-ui.navbar-expand-lg {
    display: block;
    position: fixed;
    top: 0;
    bottom: 0;
    width: 100%;
    max-width: 15.625rem !important;
    overflow-y: auto;
    padding: 0;
    box-shadow: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-collapse {
    display: block;
    overflow: auto;
    height: calc(100vh - 360px);
  }

  .navbar-vertical-soft-ui.navbar-expand-lg>[class*="container"] {
    flex-direction: column;
    align-items: stretch;
    min-height: 100%;
    padding-left: 0;
    padding-right: 0;
  }
}

@media all and (min-width: 992px) and (-ms-high-contrast: none),
(min-width: 992px) and (-ms-high-contrast: active) {
  .navbar-vertical-soft-ui.navbar-expand-lg>[class*="container"] {
    min-height: none;
    height: 100%;
  }
}

@media (min-width: 992px) {
  .navbar-vertical-soft-ui.navbar-expand-lg.fixed-start {
    left: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg.fixed-end {
    right: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav .nav-link {
    padding-top: 0.675rem;
    padding-bottom: 0.675rem;
    margin: 0 1rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav .nav-link .nav-link-text,
  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav .nav-link .sidenav-mini-icon,
  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav .nav-link .sidenav-normal,
  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav .nav-link i {
    pointer-events: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav .nav-item {
    width: 100%;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav>.nav-item {
    margin-top: 0.125rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav>.nav-item .icon .ni {
    top: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav>.nav-item>.nav-link .icon svg .color-background {
    fill: #3A416F;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav>.nav-item>.nav-link .icon svg .color-foreground {
    fill: #141727;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .lavalamp-object {
    width: calc(100% - 1rem) !important;
    background: theme-color("primary");
    color: color-yiq(#cb0c9f);
    margin-right: 0.5rem;
    margin-left: 0.5rem;
    padding-left: 1rem;
    padding-right: 1rem;
    border-radius: 0.25rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav .nav .nav-link {
    padding-top: 0.45rem;
    padding-bottom: 0.45rem;
    padding-left: 15px;
  }

  .navbar-vertical-soft-ui.navbar-expand-lg .navbar-nav .nav .nav-link>span.sidenav-normal {
    transition: all 0.1s ease 0s;
  }
}

@media (min-width: 1200px) {
  .navbar-vertical-soft-ui.navbar-expand-xl {
    display: block;
    position: fixed;
    top: 0;
    bottom: 0;
    width: 100%;
    max-width: 15.625rem !important;
    overflow-y: auto;
    padding: 0;
    box-shadow: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-collapse {
    display: block;
    overflow: auto;
    height: calc(100vh - 360px);
  }

  .navbar-vertical-soft-ui.navbar-expand-xl>[class*="container"] {
    flex-direction: column;
    align-items: stretch;
    min-height: 100%;
    padding-left: 0;
    padding-right: 0;
  }
}

@media all and (min-width: 1200px) and (-ms-high-contrast: none),
(min-width: 1200px) and (-ms-high-contrast: active) {
  .navbar-vertical-soft-ui.navbar-expand-xl>[class*="container"] {
    min-height: none;
    height: 100%;
  }
}

@media (min-width: 1200px) {
  .navbar-vertical-soft-ui.navbar-expand-xl.fixed-start {
    left: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl.fixed-end {
    right: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav .nav-link {
    padding-top: 0.675rem;
    padding-bottom: 0.675rem;
    margin: 0 1rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav .nav-link .nav-link-text,
  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav .nav-link .sidenav-mini-icon,
  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav .nav-link .sidenav-normal,
  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav .nav-link i {
    pointer-events: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav .nav-item {
    width: 100%;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav>.nav-item {
    margin-top: 0.125rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav>.nav-item .icon .ni {
    top: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav>.nav-item>.nav-link .icon svg .color-background {
    fill: #3A416F;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav>.nav-item>.nav-link .icon svg .color-foreground {
    fill: #141727;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .lavalamp-object {
    width: calc(100% - 1rem) !important;
    background: theme-color("primary");
    color: color-yiq(#cb0c9f);
    margin-right: 0.5rem;
    margin-left: 0.5rem;
    padding-left: 1rem;
    padding-right: 1rem;
    border-radius: 0.25rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav .nav .nav-link {
    padding-top: 0.45rem;
    padding-bottom: 0.45rem;
    padding-left: 15px;
  }

  .navbar-vertical-soft-ui.navbar-expand-xl .navbar-nav .nav .nav-link>span.sidenav-normal {
    transition: all 0.1s ease 0s;
  }
}

@media (min-width: 1400px) {
  .navbar-vertical-soft-ui.navbar-expand-xxl {
    display: block;
    position: fixed;
    top: 0;
    bottom: 0;
    width: 100%;
    max-width: 15.625rem !important;
    overflow-y: auto;
    padding: 0;
    box-shadow: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-collapse {
    display: block;
    overflow: auto;
    height: calc(100vh - 360px);
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl>[class*="container"] {
    flex-direction: column;
    align-items: stretch;
    min-height: 100%;
    padding-left: 0;
    padding-right: 0;
  }
}

@media all and (min-width: 1400px) and (-ms-high-contrast: none),
(min-width: 1400px) and (-ms-high-contrast: active) {
  .navbar-vertical-soft-ui.navbar-expand-xxl>[class*="container"] {
    min-height: none;
    height: 100%;
  }
}

@media (min-width: 1400px) {
  .navbar-vertical-soft-ui.navbar-expand-xxl.fixed-start {
    left: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl.fixed-end {
    right: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav .nav-link {
    padding-top: 0.675rem;
    padding-bottom: 0.675rem;
    margin: 0 1rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav .nav-link .nav-link-text,
  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav .nav-link .sidenav-mini-icon,
  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav .nav-link .sidenav-normal,
  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav .nav-link i {
    pointer-events: none;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav .nav-item {
    width: 100%;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav>.nav-item {
    margin-top: 0.125rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav>.nav-item .icon .ni {
    top: 0;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav>.nav-item>.nav-link .icon svg .color-background {
    fill: #3A416F;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav>.nav-item>.nav-link .icon svg .color-foreground {
    fill: #141727;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .lavalamp-object {
    width: calc(100% - 1rem) !important;
    background: theme-color("primary");
    color: color-yiq(#cb0c9f);
    margin-right: 0.5rem;
    margin-left: 0.5rem;
    padding-left: 1rem;
    padding-right: 1rem;
    border-radius: 0.25rem;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav .nav .nav-link {
    padding-top: 0.45rem;
    padding-bottom: 0.45rem;
    padding-left: 15px;
  }

  .navbar-vertical-soft-ui.navbar-expand-xxl .navbar-nav .nav .nav-link>span.sidenav-normal {
    transition: all 0.1s ease 0s;
  }
}
.icon-shape {
  width: 48px;
  height: 48px;
  background-position: center;
  border-radius: 0.75rem;
}.border-radius-md {
  border-radius: 0.5rem;
}.icon-sm {
  width: 32px;
  height: 32px;
}
  </style>
  <style>
  
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
}.pn-ProductNav_Wrapper {
				position: relative;
				padding: 0 0px;
				box-sizing: border-box;
			}

			
  </style>
  
  <div class="sticky-top">
    <div class="header">
      <!-- navbar -->
      <div class="navbar-custom navbar navbar-expand-lg bg-primary  navbar-stisla">
        <div class="container-fluid px-0">
          <button class="navbar-toggler" type="button" id="btnSidebarWAI" style="display: block;font-size: 25px;width: 10%;text-align: left;padding-left:0px;border: 0px;color: white;">
            
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M15 11h7v2h-7zm1 4h6v2h-6zm-2-8h8v2h-8zM4 19h10v-1c0-2.757-2.243-5-5-5H7c-2.757 0-5 2.243-5 5v1h2zm4-7c1.995 0 3.5-1.505 3.5-3.5S9.995 5 8 5 4.5 6.505 4.5 8.5 6.005 12 8 12z"></path></svg>

          </button>
          <a class="navbar-brand d-block d-md-none" href="index.html">
            <img src="assets/images/brand/logo/logo-2.svg" alt="Image">
          </a>




         
            <!-- Form -->
            <form class="form-inline mr-auto d-none d-md-none d-lg-block" style="width: 100%;">


              <div class="input-group ">
                <div class="search-element" style="width: 100%;">
                  <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250">
                  <button class="btn" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                      <path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path>
                    </svg></button>
                  <div class="search-backdrop"></div>
                  <div class="search-result">
                    <div class="search-header">
                      Histories
                    </div>
                    <div class="search-item">
                      <a href="#">How to hack NASA using CSS</a>
                      <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="search-item">
                      <a href="#">Kodinger.com</a>
                      <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="search-item">
                      <a href="#">#Stisla</a>
                      <a href="#" class="search-close"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="search-header">
                      Result
                    </div>
                    <div class="search-item">
                      <a href="#">
                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-3-50.png" alt="product">
                        oPhone S9 Limited Edition
                      </a>
                    </div>
                    <div class="search-item">
                      <a href="#">
                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-2-50.png" alt="product">
                        Drone X2 New Gen-7
                      </a>
                    </div>
                    <div class="search-item">
                      <a href="#">
                        <img class="mr-3 rounded" width="30" src="assets/img/products/product-1-50.png" alt="product">
                        Headphone Blitz
                      </a>
                    </div>
                    <div class="search-header">
                      Projects
                    </div>
                    <div class="search-item">
                      <a href="#">
                        <div class="search-icon bg-danger text-white mr-3">
                          <i class="fas fa-code"></i>
                        </div>
                        Stisla Admin Template
                      </a>
                    </div>
                    <div class="search-item">
                      <a href="#">
                        <div class="search-icon bg-primary text-white mr-3">
                          <i class="fas fa-laptop"></i>
                        </div>
                        Create a new Homepage Design
                      </a>
                    </div>
                  </div>
                </div>
                <!-- <input class="form-control rounded-3" type="search" value="" id="searchInput" placeholder="Search">
                <span class="input-group-append">
                  <button class="btn  ms-n10 rounded-0 rounded-end" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search text-dark">
                      <circle cx="11" cy="11" r="8"></circle>
                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                  </button>
                </span> -->
              </div>
            </form>
          
          <!--Navbar nav -->
          <ul class="navbar-nav navbar-right-wrap ms-lg-auto d-flex nav-top-wrap align-items-center ms-4 ms-lg-0" >

            <button type="button" data-toggle="search" class="btn btn-md btn-icon rounded-circle nav-link nav-link-lg d-lg-none" style="background: transparent;border: 0;fill: white;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255,255,255);transform: ;msFilter:;">
                <path d="M19.023 16.977a35.13 35.13 0 0 1-1.367-1.384c-.372-.378-.596-.653-.596-.653l-2.8-1.337A6.962 6.962 0 0 0 16 9c0-3.859-3.14-7-7-7S2 5.141 2 9s3.14 7 7 7c1.763 0 3.37-.66 4.603-1.739l1.337 2.8s.275.224.653.596c.387.363.896.854 1.384 1.367l1.358 1.392.604.646 2.121-2.121-.646-.604c-.379-.372-.885-.866-1.391-1.36zM9 14c-2.757 0-5-2.243-5-5s2.243-5 5-5 5 2.243 5 5-2.243 5-5 5z"></path>
              </svg></button>
            </li>

            <li class="dropdown stopevent ms-2">
              <a class="btn btn-ghost btn-icon rounded-circle" href="#!" role="button" id="dropdownNotification" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                  <path d="M19 13.586V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v3.586l-1.707 1.707A.996.996 0 0 0 3 16v2a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-2a.996.996 0 0 0-.293-.707L19 13.586zM19 17H5v-.586l1.707-1.707A.996.996 0 0 0 7 14v-4c0-2.757 2.243-5 5-5s5 2.243 5 5v4c0 .266.105.52.293.707L19 16.414V17zm-7 5a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22z"></path>
                </svg>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="dropdownNotification">
                <div>
                  <div class="border-bottom px-3 pt-2 pb-3 d-flex
                      justify-content-between align-items-center">
                    <p class="mb-0 text-dark fw-medium fs-4">Notifications</p>
                    <a href="#!" class="text-muted">
                      <span>
                        <i class="me-1 icon-xs" data-feather="settings"></i>
                      </span>
                    </a>
                  </div>
                  <div data-simplebar style="height: 250px;">
                    <!-- List group -->
                    <ul class="list-group list-group-flush notification-list-scroll">
                      <!-- List group item -->
                      <li class="list-group-item bg-light">


                        <a href="#!" class="text-muted">
                          <h5 class=" mb-1">Rishi Chopra</h5>
                          <p class="mb-0">
                            Mauris blandit erat id nunc blandit, ac eleifend dolor pretium.
                          </p>
                        </a>



                      </li>
                      <!-- List group item -->
                      <li class="list-group-item">


                        <a href="#!" class="text-muted">
                          <h5 class=" mb-1">Neha Kannned</h5>
                          <p class="mb-0">
                            Proin at elit vel est condimentum elementum id in ante. Maecenas et sapien metus.
                          </p>
                        </a>



                      </li>
                      <!-- List group item -->
                      <li class="list-group-item">


                        <a href="#!" class="text-muted">
                          <h5 class=" mb-1">Nirmala Chauhan</h5>
                          <p class="mb-0">
                            Morbi maximus urna lobortis elit sollicitudin sollicitudieget elit vel pretium.
                          </p>
                        </a>



                      </li>
                      <!-- List group item -->
                      <li class="list-group-item">


                        <a href="#!" class="text-muted">
                          <h5 class=" mb-1">Sina Ray</h5>
                          <p class="mb-0">
                            Sed aliquam augue sit amet mauris volutpat hendrerit sed nunc eu diam.
                          </p>
                        </a>



                      </li>
                    </ul>
                  </div>
                  <div class="border-top px-3 py-2 text-center">
                    <a href="#!" class="text-inherit ">
                      View all Notifications
                    </a>
                  </div>
                </div>
              </div>
            </li>
            <!-- List -->
            <li class="dropdown ms-2">
              <a class="rounded-circle" href="#!" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md avatar-indicators avatar-online">
                  <img alt="avatar" src="assets/images/avatar/avatar-11.jpg" class="rounded-circle">
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                <div class="user-box">
                  <span class="avatar mt-1">
                    <span class="avatar avatar-sm" style="">HM</span> </span>
                  <div class="u-text" onclick="">
                    <h4 style="font-size: 12px;font-weight: 550;color: #555;">
                      Hilfi Muhamad Aryawan </h4>
                    <div class="text-muted" style="color:rgba(35, 46, 60, 0.7) !important">
                      Be3 ID:aaaaa </div>
                  </div>
                </div>

                <div class="row m-0 p-2">

                  <div class="col-6">
                    <h6 class="m-0  fz-12" style="font-weight: 500;color: #555;">
                      Saldo Donasi
                    </h6>
                    <h6 class="m-0">
                      Rp 0(0)
                    </h6>
                  </div>
                  <div class="col-6">
                    <h6 class="m-0 fz-12" style="font-weight: 500;color: #555;">
                      Saldo WAIPay
                    </h6>
                    <h6 class="m-0">

                      0
                      <a href="#" class="tooltipA">
                        <span class="tooltiptext">
                          Refund
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" style="width: 1rem;height: 1rem;font-size: 1.25rem;vertical-align: top;" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M11 7h-5a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-5"></path>
                          <line x1="10" y1="14" x2="20" y2="4"></line>
                          <polyline points="15 4 20 4 20 9"></polyline>
                        </svg>
                      </a>
                    </h6>
                  </div>
                </div>
                <a href="https://localhost/beegrit.com/Admin/Dashboard" class="dropdown-item">
                  Panel Admin
                </a>
                <div class="dropdown-divider">
                </div>

                <a href="#" class="dropdown-item">
                  Tentang Kami
                </a>
                <a href="#" class="dropdown-item">
                  Rencana Pengembangan
                </a>
                <a href="#" class="dropdown-item">
                  Donasi
                </a>
                <div class="dropdown-divider">
                </div>
                <a href="https://localhost/beegrit.com/d/4WntJgNvWZNng5Y9A3A65SqgWvjtsV2Qm3jNHEvfAdPz2srkLpRpCRQgAI6IyTnUO1pG6rGyQ7EvE0m7kYIW4TXVnNMI7zB743YXwwnpsbSfAAUcTwjh8E1pdp5NtJvm9L3ngEDX9nDdcXMH1AERH1gG0zNHVb2Jv8XK7Ecjjw4NOdFa2FaIWjtEvQ74NO1jtQgO1ntQ7B7nNQgCREvjtntB7AAVbAAHEVbY9HEGyHENnHEg5Y9NnY9g5cjA3GyFaAAVbAAY95SHEAA5SHEg5/WzXB1pTpVO65DXsQ1Lx7RqTSy8LsR2jq8cEdrP8E91GPr7cY1SUwLU0qPJ7cfbExAv0Ev99Lybv0GjK9VMRTXdQsjBESKhEyCR7AAY78DWPQ4HDTK7Kf2fBwkxSERG41XVbJtsCJ8MLd0wr9CQW4LDrI4VkcDIAhhwUqtXQ7bS5NTPFa2FaFa4HDI4HsQRqrP4HRqrPDX" class="dropdown-item">
                  Profil &amp; Akun
                </a>

                <a href="#" class="dropdown-item">
                  Pengaturan
                </a>
                <a href="https://localhost/beegrit.com/auth/logout" class="dropdown-item">
                  Keluar
                </a>
                <div class="px-4 pb-0 pt-2">


                  <div class="lh-1 ">
                    <h5 class="mb-1"> John E. Grainger</h5>
                    <a href="#!" class="text-inherit fs-6">View my profile</a>
                  </div>
                  <div class=" dropdown-divider mt-3 mb-2"></div>
                </div>

                <ul class="list-unstyled">

                  <li>
                    <a class="dropdown-item d-flex align-items-center" href="#!">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="user"></i>Edit
                      Profile
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#!">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="activity"></i>Activity Log
                    </a>


                  </li>


                  <li>
                    <a class="dropdown-item d-flex align-items-center" href="#!">

                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="settings"></i>Settings
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="index.html">
                      <i class="me-2 icon-xxs dropdown-item-icon" data-feather="power"></i>Sign Out
                    </a>
                  </li>
                </ul>

              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>

  </div>
  <div class="sidebar sidebarWai" style="z-index: 999;">
    <i class='btnClassClosSideBar' style=""></i>
    <ul class="nav-list " style="
    margin-top: 66px;
    ">

      <li>
        <a href="https://localhost/beegrit.com/">
          <i class="bx bx-grid-alt"></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>

      <li>
        <a href="https://localhost/beegrit.com/d/xx0CIAKAUKTqb5Eh6pBx32tptr9j9Q9dLEOpBOz8cPHNONRBLTVAvtqzKb9cR4GOMrSD10O38pVnDWKVXLAStI9TthKxyHbgxLNsU6hHYdrOsnmWUJrs2UYjGbZfx2yv9Dkmn5tRAKr92gIM3AOtR14OJ6yN4XJVfIEkBKX00xIEPxFa2Fa9dvtvttpbg9jUJJ68pKAFasn4XsnEh32BOsn32BOb5/PLNjc0PKCyjJAB846BESIRY3k8g7pZAbCHmU7WKdUnPp0sfnqwHNtYnLEYj7gGn43JvHVbhDC0A24VDTOcX255DWrJGKWAxJRbzNJnhEbPIVfA2H2txtBg2YW3AHJCM3ITvhSz5Q6GGNRM0fvGzAnTZPjbs8yZ7my1cshML5P4ZB0nFa2FaZB3JDWn4zNFafAyZfA84IR7WfAIR7WAB">
          <i class="bx bx-chat"></i>
          <span class="links_name">Messages</span>
        </a>
        <span class="tooltip">Messages</span>
      </li>
      <li>
        <a href="https://localhost/beegrit.com/d/n0j4KtzTKE371b0zPdWwVAxTgqfSGsLchAtUsYQ0QwAwQLwCPXDMO6tLOvH5JXNBxSH1t8UbLZMgb7EURM89VO5MVYRG9rCkq7p8hpBLsOVpYjN2Nt6BgKyPEMLI998JJCUG8UnbWK4MNCgjQCZKvqhJX3KUjxgfWRHSEw4ApvRcYDFa2Fa89fSq7p8RcCkfSNtX3LZzTFaYjjxYj0zVAsYYjVAsY1b/N3nEnVmkwTLALR5kmvWRf4PDYb0t11yBp4WyDILNwEtQywx600n1L7BYhstH1Rb5IfGMdZr2zB9dCwhjhM9jt4AVzsGTB4pYIUVz9VS9v7SWxvrNPMnw5jVIEfDTrREx8CYfck86VnXB5bxZXZ79NcYUsC6KCyDk0SUmxM45L3IKNBFa2FaIKzsBYL7CwBYb5PDFaxvCyxv5kf4DIxvf4DILR">
          <i class="bx bx-pie-chart-alt-2"></i>
          <span class="links_name">Program</span>
        </a>
        <span class="tooltip">Program</span>
      </li>
      <li>
        <a href="https://localhost/beegrit.com/d/8czgEKbJ6Bw1R5sdsq7y7GUqM4Lq46pPkYvyZpbtNr4hjysTQs2nqk2jw8nvK8tXtrObB0qNxQSrnA5CZrcMUU0WAdLE9g1VGAJnn8VjKWWEPU3DnB5UT8vNrf0OdVgx4rq3jZQI1OEHTZPwCXt2w6qCdXKGTNxYVHD0RPdEcCPypGFa2Fat2tXRPLqJnGA1VLqnBdXxQbJFaPUTNPUsd7GZpPU7GZpR5/SjIp1ZCL29Vr7rs51O3HZsjZwJ6gLJwdvyW6jdH3wNZXKNAVtfDp11HsqBgPMQLQkxDzT7EyyIhz9m3h0GBKBhTWmcd4Nkj3dM9GCTWdB1IZ6G1YO6p7YG7ItHGdLdnc8qkOZbcZcUx2J91Hghdm9tM1ZQLBfzXWVz3v39A9pzQJcjFa2FaQJIp6ghzyI9G6gjZyIQJpz11HsLBFa6Gfz6Gs5Zsjd6GZsjd7r">
          <i><span class="iconify" data-icon="healthicons:i-schedule-school-date-time-outline"></span></i>
          <span class="links_name">Life Time Works</span>
        </a>
        <span class="tooltip">Life Time Works</span>
      </li>

      <li>
        <a href="https://localhost/beegrit.com/d/X9fvTCtQpUxNSGJG7LMPfY9MEIOKjxSRyqL4kJBdQvgJDZkvgQZmLrfDs9dk5dEORkRTUbAqPgp2ns0P2MLxy4vMW0DtUhTxUZPz8R4qj37zPq2nSfQ9qHTpHGpDWHRc4PqngntZTZqCt7p0fgWZGRIIw9pwc2jwVY6n66O0VfN1JKFa2Fa2nLrUZPzTxOKSfw9PgtQFaPqc2PqJGfYkJPqfYkJSG/Isjh8EDWwyNcMPUKmqjZtMMt1NjmP3VxLYHRvxUYdH46O7vM4ZnTH68g2ZdP6KK9YQ0V5Bh8N1cQv072K2CYIhNw1PxsV6Y6Xs8LBZkXTMgYW8RPnMJEgTBrUMOxOjEr6tTBP2VXYB9NO4DxCqhHESs4IOYDgZDqw3NhmMdcm0pAB9Fa2FapAO41PIOK98LN1FaW8gZW8UKtMvxW8tMvxMP">
          <i><span class="iconify" data-icon="dashicons:update"></span></i>
          <span class="links_name">Update Post</span>
        </a>
        <span class="tooltip">Update Post</span>
      </li>
      <li>
        <a href="https://localhost/beegrit.com/d/TWLmLsMjGMnME9UDgjPnv6LdG6gS0UXAAJEpQs1T5CUVybSO74xY0npOAD7B8TfUymRDYcJjpbjXOB3V7c1K1LpdP2Y8gwmwMBE8zbzvrNgX3sf8yzEXbH7jjfbgAbyxG9g5J5jms2TrknbcwPwUNMN7BwnIStD5RKDnHGpTssNjIUFa2FaxYpd0nP2mwgSyzBwpbMjFa3sSt3sUDv6Qs3sv6QsE9/XRqfLcyXrfAZArVVkr47bJYKPRBT8EmUMKhAxkHM2ELAMhORZ3PgnwPxc97Nfn1OEz6w8hT7ttSqgQVEpVXHWZsh6krLVby6V9fPQh6vnrKWsOBrC6bQvRqh7VK4nhncAvB5X6QQcWJ98M39S5IvXTCrbUsjqrjBUjypHO8fEAchwrFa2FachV9fPnwPxttFasOqrsOVVbJxksObJxkAr">
          <i><span class="iconify" data-icon="emojione-monotone:department-store"></span></i>
          <span class="links_name">Store</span>
        </a>
        <span class="tooltip">Store</span>
      </li>
      <li>
        <a href="https://localhost/beegrit.com/d/kRM4cBmPTfMKyJvRUDDykChmThWLOfYvGKkPp754NSTdK0nZ0ykh4KhERbTOKIsIWERDNRw9m2dPXQxyLUPLJJ2kWHLdPOm7TxpJ96AASgY7KhsrptmUyDdbs0KHGT5fv7DAEd8VSvYpX3YsVA9xgswOdZnRIQBmndCRkNR2VKPE9KFa2FaYv4K4Khmm7WLptdZm2mPFaKhIQKhvRkCp7KhkCp7yJ/5fX7QxgQS3ypV0GMRbREKgTrJ9JTS1GtKX4E3EZSdvmqJU35MUd8CXw9UcRYpOY7fskUWzf95jzfLnG1YNScwNp2IVZr4vSKMJtyOqjLWk3wtbSHH4NMv2CUBUWPhfXB4y6OLM1XwUpsZTJ7tzIt6RWOqrE8JYDN2HyOyKbLYWP7PTFa2FaP7fsp2Y7tyFatbJYtbGMKg3EtbKg3EV0">
          <i><span class="iconify" data-icon="ic:baseline-event"></span></i>
          <span class="links_name">Kegiatan</span>
        </a>
        <span class="tooltip">Kegiatan</span>
      </li>
      <li>
        <a href="https://localhost/beegrit.com/d/2t4hWdD9y8gnMCKzsttcfH01K5O6KTcc9T7J8A1ERZRXTqh9VhBdOYc4nxt1XHMYBMyrwjf1KKxAWKhqEOZQ8CDR2cvdDYbmsgJNknRMzgdnrTjDd714M3Hp0WfLBthYE9VvAHBTZU9r04Xw4EJqG6QQysdIxECzHhwmAmrQpts017Fa2FaccOYOY01bmO6d7ysKKD9FarTxErTKzfH8ArTfH8AMC/hsT9ydykQKmOmtNI2Trb4Qm6nsCzTsGYYzQtS48qzr93mMfyzcEGGyI6EYtscjk0UkDhUz7CTL10MYzUWt6ETQ4CbmL1yprZdhA0nDfcIxvrCsvpdkNzdKX4c6t60Txr64D0YxTZjDpvrEJmgYg3Ax4x9LIbs1QA9JVA47fSn70NghFa2Fa0NUk4Ck0A0FaCss1CsNI4QS4Cs4QS4mt">
          <i class="bx bx-chat"></i>
          <span class="links_name">Crowd Funding</span>
        </a>
        <span class="tooltip">Crowd Funding</span>
      </li>
      <li class="profile">
        <div class="profile-details">
          <!--  <img src="" alt="profileImg">-->
          <div class="name_job">
            <div class="name">Hilfi Muhamad Aryawan</div>
            <div class="job">User</div>
          </div>
        </div>
        <i class="bx bx-log-out" id="log_out"></i>
      </li>
    </ul>
  </div>
   <div class="navbar-horizontal nav-dashboard " style="position:fixed; width:100%;z-index:999">
      <div class="container-fluid d-flex ">

          <!-- Collapse -->
		 <a href="https://localhost/beegrit.com/d/DpZntZjY1Y33n8Hd7C7AGRfAUhWRxV75qmkH1HJEB9kAkwgWWT0ZSgBwsUtHHXW6L1rgwZ8LsqsrPz1KmpULsJMpQgCCBNGcfZg5rXthKVMXQCVqTVyJHQDw8Rf4DnXkSKgXEN94SEJ070HqBm5EQH5xbPpVdrWBR0BjPMcdG51R1XFa2Fa75SgSgfAGcWRTVbPsqjYGcGcGcL1MpW6g51RQgW6TVsqZnGcQgBwSgPzBwW6fAGc1HFaQCdrQCHdGR1HQCGRQC5x/pVxtR3p1T1H4jRkE2NSY4KTL2GV6bV5H4Mh0Igfcx8AIbEIrxrcEGC44wZYfJSOQWMz4T3TGn45MQvrqjL2b6jmLY094MgfUhxBhPhXkTxMrQD7R4s2QMHpY89gG78twvVBQ9A1KwEZ5G38Hd6yg8Pgzhj4Un90SCRVQNfc0OZN9sNFa2FaN9WMmLOQBhFaQDn9QDkE4KIgQD4KQDgz" class="nav-link d-flex  text-reset "  style="align-content: center;align-items: center;" aria-label="Open user menu">
								
			<span class="bx bx-menu"></span>
		</a>
		  <nav class="pn-ProductNav_Wrapper d-flex
		   w-100">
			<div class="nav-item dropdown flex-start bg-white" style="align-content: center;display: flex;">
							
													</div>		
            <div class="flex-start" style="width: 30px;">
			
                                    <button id="pnAdvancerLeft" class="pn-Advancer pn-Advancer_Left" type="button" style="align-content: center;display: flow-root;width: heigh;height: 100%;background: #fff;width: 30px;">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="15 6 9 12 15 18"></polyline>
                                      </svg>
                                    </button>
                                  </div>
								  <nav id="pnProductNav" class="pn-ProductNav pn-ProductNav w-100 bg-white">
								  <ul class="pn-ProductNav_Contents" id="pnProductNavContents" style="background: white; margin-bottom:0">

									
							<a href="https://localhost/beegrit.com/d/Wf36sYcLQXdp9bspk5XMwZWC3U9cjHb2ChvcyYQr2qVAZxU7jSOfDZxs8EQY3n8y55htqcnvc470jBGMJLfG1jkmNY6bRyUW3pgk4cxYpR44QWPSrmRdUpTnONcfV5pAm8TpJmxmHGsQmqJHHsDJRqY5z8rwzdhJsMMjrgMY4BI8zzFa2FasY36c48yxsrm9crmjBUW9crmz8c4cLUWyYFaQWzdQWspwZyYQWwZQWY5/7ybAZ1xBM20z8A2nKVNZjIddsX1v48I8MM8G2LKksPkNjVTZnpJACEhjGV7nVpsmCw36w3BP17yh3IT7nxAc9P1P3CjQGYfhPK8j79RjcBx72PSQftKR3sSOWV0gsZpXqLSrc3UBB9OjKByVBNYcWHRczTINkWbjdTw1vt2DJfP2M6Fa2FaP23ChjCE3IhjsmddFa2PkW2P2njI2L2PjI2PRc" class="pn-ProductNav_Link">Home</a>
      
										
							<a href="https://localhost/beegrit.com/d/dVLtJ7HpJKyJkEQ9sGctddRB8tSBB3IqpXWCyhHCQgfOKm0zWT5dwx0IzvWnbVk3fN4kGtEQBA7GcrKyX73qrHSWdwfP1fmU32E8O7wsBpUv2cyTA9LyN5WLgwXv0Cz23rZsDstZWKShD5f2ppmH9y4sfV8T6LxEMfNHGpyCTqcUz5Fa2FaJ7LtBAk30IA9SBA9crmULtSB32E8cU8TBALtk332mUyhFa2c6L2cQ9ddyh2cdd2c4s/8Add8Wms4ZZpRI2gDbmRhs5sKTwcYDdPHgkvnTHLxWZtpMxjysvtO6KMJZtZcAWHwD0Y6kNJjhpK313X1xZZ2mD1m4qgBqvRwPOH2j3rbyD4nE9x4Ic1xCMMHjUWnrrIpffSNVTSDZdjZEZWLnHv6ZnOxHIhGT7AfY87cqKEUS54GDFa2Fa54m4KMO631KMWH5sFanEGTnE2ghsnTnEhsnEnO" class="pn-ProductNav_Link" aria-selected="true">Classroom</a>
      
										
							<a href="https://localhost/beegrit.com/d/qy56GwY8cZ5X42IM9U9dmR9zWKIDRdp4HNq3Unb5ksKQBE3S12dq5QnJ1TDvYdQMqCJEnQ6BgDxKds1HEMtHKfBX2L1nITEddvj0vBw1KI3Gs5GBOhnASfmxzfzrhYS8zhKXsLb319KGnRdUYrQQQ8r2pDk2TfrN1dxVkJL73MdBH1Fa2FaGw56gDQMnJOhIDOhdsEd2LQMdsgDdBnJgDvBIDgD3MEdUnFas5Tfs5IMmRUns5mRs5r2/HIB5n85rAXvPPOTf40UdU4hYq8H2wcOOZtIEkKUVEBH6TQy3LMJwbhLtmb8bIGkE9g1ADRhgrH6ynGCEHkSSdtEW5PxQv4jWfhC10bY5y2Sb61K157sXBc8MSNMj41bJmRXMr2zBdgqXHJG9sByypS2xS0Zs6JPpBWCUWvpxcwGTqhFa2FaGT5PLtbhnGLtkEhYFa616J61TfU4kK61U4612x" class="pn-ProductNav_Link">Review</a>
      
										
							<a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a><a href="https://localhost/beegrit.com/d/InrWMO3VEb3TCrhNg5OKsBbHxwHgQICN1S4jH6hhdS8MLwnQbpOE1EjSdDL0g1mp7JRL74205pc1VXZGzyGNtmmfmCUz0pjITcQ5U8C6brhYY17kH0jYcxVYW0gsxSKPYs6R8mXXT3jgy1RRI7ISLxXpQU1h3mYbMj5JdJTJyQGvr5Fa2FaMOrW5pmpjSH0HgH0VXjICNmpmC1EjSQ5jIH6FaY13mY1hNsBH6Y1sBY1Xp/wtOEcdWphD6M3yP4V1Lqr6YLD6mOrvcESvx90kQPpZVtv2PbMqxzXH4MLtkTZvp7xBs1xLypYq4S0LK0AHtLbbNZVKmGHc8DhXZBOPgv1vBCtUxxhg9yxpJVGLy8n3tYT0LgtIAPgLP3X82PRI4Zmfhd9CGpZIb9by4H2R42Aw20jEFa2Fa20VK4MXH0L4Mp7YLFatUZItUP4r60ktUr6tUhd" class="pn-ProductNav_Link">Transkrips</a>
      
													<span id="pnIndicator" class="pn-ProductNav_Indicator"></span>

		
					</ul>
			</nav>
			<div class="flex-end" style="width: 30px;">

                                    <button id="pnAdvancerRight" class="pn-Advancer pn-Advancer_Right " type="button" style="align-content: center;display: flow-root;width: heigh;height: 100%;background: #fff;width: 30px;">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="9 6 15 12 9 18"></polyline>
                                      </svg>
                                    </button>
                                  </div>
			<div class="nav-item dropdown flex-end bg-white " style="align-content: center;display: flex; margin-right:10px">
							<ul class="navbar-nav d-flex"  >
             <!-- <li class="nav-item ">
                <a class="nav-link" href="#" >
                  <span class="bx bx-plus"></span>
                </a>
				</li>-->
              <li class="nav-item dropdown">
                <a class="nav-link " href="#" id="navbarBaseUI" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M4 4h4v4H4zm6 0h4v4h-4zm6 0h4v4h-4zM4 10h4v4H4zm6 0h4v4h-4zm6 0h4v4h-4zM4 16h4v4H4zm6 0h4v4h-4zm6 0h4v4h-4z"></path></svg>
							
                </a>
                <div class="dropdown-menu dropdown-menu-xl" aria-labelledby="navbarBaseUI">
                  <div class="row">
                    <div class="col-lg-4">
                      <ul class="list-unstyled">
					  
                        <li class="nav-item">
                          <a href="components/accordions.html" class="dropdown-item">
                            Accordions
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="dropdown-item" href="components/alerts.html"> Alert</a>
                        </li>

                        <li class="nav-item">
                          <a href="components/badge.html" class="dropdown-item">
                            Badge
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="components/breadcrumb.html" class="dropdown-item">
                            Breadcrumb
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/buttons.html" class="dropdown-item">
                            Buttons
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/button-group.html" class="dropdown-item">
                            Button group
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/card.html" class="dropdown-item">
                            Card
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/carousel.html" class="dropdown-item">
                            Carousel
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/close-button.html" class="dropdown-item">
                            Close Button
                          </a>
                        </li>

                      </ul>
                    </div>
                    <div class="col-lg-4">
                      <ul class="list-unstyled">

                        <li class="nav-item">
                          <a href="components/collapse.html" class="dropdown-item">
                            Collapse
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/dropdowns.html" class="dropdown-item">
                            Dropdowns
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/forms.html" class="dropdown-item">
                            Forms
                          </a>
                        </li>

                        <li class="nav-item">
                          <a href="components/list-group.html" class="dropdown-item">
                            List group
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/modal.html" class="dropdown-item">
                            Modal
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/navs-tabs.html" class="dropdown-item">
                            Navs and tabs
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/navbar.html" class="dropdown-item">
                            Navbar
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/offcanvas.html" class="dropdown-item">
                            Offcanvas
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/pagination.html" class="dropdown-item">
                            Pagination
                          </a>
                        </li>
                      </ul>
                    </div>
                    <div class="col-lg-4">
                      <ul class="list-unstyled">


                        <li class="nav-item">
                          <a href="components/placeholders.html" class="dropdown-item">
                            Placeholders
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/popovers.html" class="dropdown-item">
                            Popovers
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/progress.html" class="dropdown-item">
                            Progress
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/scrollspy.html" class="dropdown-item">
                            Scrollspy
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/spinners.html" class="dropdown-item">
                            Spinners
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/tables.html" class="dropdown-item">
                            Tables
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/toasts.html" class="dropdown-item">
                            Toasts
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="components/tooltips.html" class="dropdown-item">
                            Tooltips
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>






                </div>
              </li>

            </ul>
			
							
							
													</div>
						
										
				
						
			</nav>				
          </div>

        	

      </div>
    </div>
  <main id="main-wrapper" class="main-wrapper">
    


    <!-- navbar horizontal -->
    <!-- navbar -->
   
    <!-- page content -->
	<div class="navbar-horizontal nav-dashboard">
  <div class="container-fluid ">

    <nav class="navbar navbar-expand-lg navbar-default navbar-dropdown p-0 py-lg-2">
      <div class="d-flex d-lg-block justify-content-between align-items-center w-100 w-lg-0 py-2  px-4 px-md-2 px-lg-0">
        <span class="d-lg-none">Menu</span>
        <!-- Button -->
        <button class="navbar-toggler collapsed ms-2" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="icon-bar top-bar mt-0"></span>
          <span class="icon-bar middle-bar"></span>
          <span class="icon-bar bottom-bar"></span>
        </button>
      </div>
      <!-- Collapse -->
      <div class="collapse navbar-collapse  px-6 px-lg-0" id="navbar-default">
        <ul class="navbar-nav">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDashboard" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false" data-bs-display="static">
              Dashboard
            </a>
            <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarDashboard">
              <li>
                <a class="dropdown-item" href="index.html">
                  Project
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="dashboard-analytics.html">
                  Analytics</a>
              </li>
              <li>
                <a class="dropdown-item" href="dashboard-ecommerce.html">
                  Ecommerce</a>
              </li>
              <li>
                <a class="dropdown-item" href="dashboard-crm.html">
                  CRM</a>
              </li>
              <li>
                <a class="dropdown-item" href="dashboard-finance.html">
                  Finance</a>
              </li>
              <li>
                <a class="dropdown-item" href="dashboard-blog.html">
                  Blog</a>
              </li>


            </ul>
          </li>




          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarApps" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              Apps
            </a>
            <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarApps">

              <li>
                <a class="dropdown-item" href="calendar.html">
                  Calendar
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="apps-file-manager.html">
                  File Manager
                </a>
              </li>

              <li>
                <a class="dropdown-item" href="chat-app.html">
                  Chat
                </a>
              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                  Kanban
                </a>
                <ul class="dropdown-menu">

                  <li>
                    <a href="task-kanban-grid.html" class="dropdown-item">
                      Board
                    </a>
                  </li>
                  <li>
                    <a href="task-kanban-list.html" class="dropdown-item">
                      List
                    </a>
                  </li>


                </ul>

              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                  Email
                </a>
                <ul class="dropdown-menu">

                  <li>
                    <a href="mail.html" class="dropdown-item">
                      Inbox
                    </a>
                  </li>
                  <li>
                    <a href="mail-details.html" class="dropdown-item">
                      Details
                    </a>
                  </li>
                  <li>
                    <a href="mail-draft.html" class="dropdown-item">
                      Draft
                    </a>
                  </li>


                </ul>

              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                  Ecommerce
                </a>
                <ul class="dropdown-menu">

                  <li>
                    <a href="ecommerce-products.html" class="dropdown-item">
                      Products
                    </a>
                  </li>
                  <li>
                    <a href="ecommerce-products-details.html" class="dropdown-item">
                      Prouduct Details
                    </a>
                  </li>
                  <li>
                    <a href="ecommerce-product-edit.html" class="dropdown-item">
                      Add Product
                    </a>
                  </li>

                  <li>
                    <a href="ecommerce-order-list.html" class="dropdown-item">
                      Orders
                    </a>
                  </li>
                  <li>
                    <a href="ecommerce-order-detail.html" class="dropdown-item">
                      Order Details
                    </a>
                  </li>
                  <li>
                    <a href="ecommerce-cart.html" class="dropdown-item">
                      Shopping Cart
                    </a>
                  </li>
                  <li>
                    <a href="ecommerce-checkout.html" class="dropdown-item">
                      Checkout
                    </a>
                  </li>
                  <li>
                    <a href="ecommerce-customer.html" class="dropdown-item">
                      Customers
                    </a>
                  </li>
                  <li>
                    <a href="ecommerce-seller.html" class="dropdown-item">
                      Seller
                    </a>
                  </li>






                </ul>

              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                  Project
                </a>
                <ul class="dropdown-menu">

                  <li class="nav-item">
                    <a class="dropdown-item " href="project-grid.html">
                      Grid
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="dropdown-item" href="project-list.html">
                      List
                    </a>
                  </li>

                  <li class="dropdown-submenu dropend">
                    <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                      Single
                    </a>
                    <ul class="dropdown-menu">

                      <li class="nav-item">
                        <a class="dropdown-item " href="project-overview.html">
                          Overview
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item " href="project-task.html">
                          Task
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item " href="project-budget.html">
                          Budget
                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="dropdown-item " href="project-files.html">
                          File
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="dropdown-item " href="project-team.html">
                          Team
                        </a>
                      </li>
                    </ul>
                  </li>


                </ul>

              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                  CRM
                </a>
                <ul class="dropdown-menu">

                  <li>
                    <a href="crm-company.html" class="dropdown-item">
                      Company
                    </a>
                  </li>
                  <li>
                    <a href="crm-contacts.html" class="dropdown-item">
                      Contacts
                    </a>
                  </li>


                </ul>

              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                  Invoice
                </a>
                <ul class="dropdown-menu">

                  <li>
                    <a href="invoice-list.html" class="dropdown-item">
                      List
                    </a>
                  </li>
                  <li>
                    <a href="invoice-detail.html" class="dropdown-item">
                      Details
                    </a>
                  </li>
                  <li>
                    <a href="create-invoice.html" class="dropdown-item">
                      Create Invoice
                    </a>
                  </li>


                </ul>

              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                  Profile
                </a>
                <ul class="dropdown-menu">

                  <li>
                    <a href="profile-overview.html" class="dropdown-item">
                      Overview
                    </a>
                  </li>
                  <li>
                    <a href="profile-project.html" class="dropdown-item">
                      Project
                    </a>
                  </li>
                  <li>
                    <a href="profile-file.html" class="dropdown-item">
                      Files
                    </a>
                  </li>
                  <li>
                    <a href="profile-team.html" class="dropdown-item">
                      Team
                    </a>
                  </li>
                  <li>
                    <a href="profile-followers.html" class="dropdown-item">
                      Followers
                    </a>
                  </li>
                  <li>
                    <a href="profile-activity.html" class="dropdown-item">
                      Activity
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="profile-settings.html">
                      Settings
                    </a>
                  </li>


                </ul>

              </li>
              <li class="dropdown-submenu dropend">
                <a class="dropdown-item dropdown-list-group-item dropdown-toggle" href="#">
                  Blog
                </a>
                <ul class="dropdown-menu">

                  <li>
                    <a class="dropdown-item" href="blog-author.html">

                      Author
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="blog-author-detail.html">

                      Detail
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="create-blog-post.html">

                      Create Post
                    </a>
                  </li>


                </ul>

              </li>






            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarAuthentication" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Authentication
            </a>
            <ul class="dropdown-menu dropdown-menu-arrow" aria-labelledby="navbarAuthentication">


              <li>
                <a class="dropdown-item" href="sign-in.html">
                  Sign In
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="sign-up.html">
                  Sign Up
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="forget-password.html">
                  Forgot Password
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="maintenance.html">
                  maintenance
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="404-error.html">
                  404 Error
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item dropdown ">
            <a class="nav-link dropdown-toggle" href="#" id="layoutsDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Layouts
            </a>
            <ul class="dropdown-menu dropdown-menu-start" aria-labelledby="layoutsDropdown">
              <li><span class="dropdown-header"> Layouts</span></li>
              <li class="nav-item">
                <a class="dropdown-item" href="../index.html">
                  Default
                </a>
              </li>

              <li class="nav-item">
                <a class="dropdown-item" href="index.html">Horizontal</a>
              </li>



            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarPages" data-bs-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              Pages
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarPages">

              <li>
                <a class="dropdown-item" href="pricing.html">
                  Pricing
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="starter.html">
                  Starter
                </a>
              </li>

              <li>
                <a class="dropdown-item" href="maintenance.html">
                  Maintenance
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="404-error.html">
                  404 Error
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="404-error.html">
                  Coming Soon
                </a>
              </li>




            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarBaseUI" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Components
            </a>
            <div class="dropdown-menu dropdown-menu-xl" aria-labelledby="navbarBaseUI">
              <div class="row">
                <div class="col-lg-4">
                  <ul class="list-unstyled">
                    <li class="nav-item">
                      <a href="components/accordions.html" class="dropdown-item">
                        Accordions
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="dropdown-item" href="components/alerts.html"> Alert</a>
                    </li>

                    <li class="nav-item">
                      <a href="components/badge.html" class="dropdown-item">
                        Badge
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="components/breadcrumb.html" class="dropdown-item">
                        Breadcrumb
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/buttons.html" class="dropdown-item">
                        Buttons
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/button-group.html" class="dropdown-item">
                        Button group
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/card.html" class="dropdown-item">
                        Card
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/carousel.html" class="dropdown-item">
                        Carousel
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/close-button.html" class="dropdown-item">
                        Close Button
                      </a>
                    </li>

                  </ul>
                </div>
                <div class="col-lg-4">
                  <ul class="list-unstyled">

                    <li class="nav-item">
                      <a href="components/collapse.html" class="dropdown-item">
                        Collapse
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/dropdowns.html" class="dropdown-item">
                        Dropdowns
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/forms.html" class="dropdown-item">
                        Forms
                      </a>
                    </li>

                    <li class="nav-item">
                      <a href="components/list-group.html" class="dropdown-item">
                        List group
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/modal.html" class="dropdown-item">
                        Modal
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/navs-tabs.html" class="dropdown-item">
                        Navs and tabs
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/navbar.html" class="dropdown-item">
                        Navbar
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/offcanvas.html" class="dropdown-item">
                        Offcanvas
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/pagination.html" class="dropdown-item">
                        Pagination
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-4">
                  <ul class="list-unstyled">


                    <li class="nav-item">
                      <a href="components/placeholders.html" class="dropdown-item">
                        Placeholders
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/popovers.html" class="dropdown-item">
                        Popovers
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/progress.html" class="dropdown-item">
                        Progress
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/scrollspy.html" class="dropdown-item">
                        Scrollspy
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/spinners.html" class="dropdown-item">
                        Spinners
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/tables.html" class="dropdown-item">
                        Tables
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/toasts.html" class="dropdown-item">
                        Toasts
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="components/tooltips.html" class="dropdown-item">
                        Tooltips
                      </a>
                    </li>
                  </ul>
                </div>
              </div>






            </div>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <i data-feather="more-horizontal" class="icon-xxs"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-md" aria-labelledby="navbarDropdown">
              <div class="list-group">
                <a class="list-group-item list-group-item-action border-0" href="../docs/index.html">
                  <div class="d-flex align-items-center">
                    <i data-feather="file-text" class=" icon-sm text-primary"></i>

                    <div class="ms-3">
                      <h5 class="mb-0">Documentations</h5>
                      <p class="mb-0 fs-6">
                        Browse the all documentation
                      </p>
                    </div>
                  </div>
                </a>
                <a class="list-group-item list-group-item-action border-0" href="../docs/changelog.html">
                  <div class="d-flex align-items-center">
                    <i data-feather="layers" class=" icon-sm text-primary"></i>
                    <div class="ms-3">
                      <h5 class="mb-0">
                        Changelog <span class="text-primary ms-1">v1.0.0</span>
                      </h5>
                      <p class="mb-0 fs-6">See what's new</p>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </li>
        </ul>
      </div>

    </nav>

  </div>
</div>
    <div id="app-content">
    
      <div class="app-content-area">
    <div class="bg-primary pt-10 pb-21 mt-n8 mx-n4"></div>
    
      <div class="container-fluid mt-n22 " style="padding-left: 10%;">
      <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <!-- Page header -->
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <div class="mb-2 mb-lg-0">
                                    <h3 class="mb-0  text-white">Projects</h3>
                                </div>
                                <div>
                                    <a href="#!" class="btn btn-white">Create New Project</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    
        <div class="swiper mb-2">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
              <div class="swiper-image">
                <div class="image"></div>
              </div>
            </div>
            <!-- Slide 2 -->
            <div class="swiper-slide">
              <div class="swiper-image">
                <div class="image"></div>
              </div>
            </div>
            <!-- Slide 3 -->
            <div class="swiper-slide">
              <div class="swiper-image">
                <div class="image"></div>
              </div>
            </div>
          </div>

          <!-- If we need navigation buttons -->
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>

        <div class="container-fluid" style="padding-left: 10%;">

          <div class="row">
            <!-- Page header -->
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
              <!-- Bg -->
              <!-- <div class="pt-20 rounded-top" style="
                    background: url(../assets/images/background/profile-cover.jpg)
                      no-repeat;
                    background-size: cover;
                  "></div> -->
              <div class="card rounded-bottom rounded-0 smooth-shadow-sm mb-5" style="margin-top: 70px;">
                <div class="d-flex align-items-center justify-content-between pt-4 pb-6 px-4">
                  <div class="d-flex align-items-center">
                    <!-- avatar -->
                    <div class="avatar-xxl avatar-indicators avatar-online me-2 position-relative d-flex justify-content-end align-items-end mt-n10">
                      <img src="../assets/images/avatar/avatar-11.jpg" class="avatar-xxl
                      rounded-circle border border-2 " alt="Image">
                      <a href="#!" class="position-absolute top-0 right-0 me-2">
                        <img src="../assets/images/svg/checked-mark.svg" alt="Image" class="icon-sm">
                      </a>
                    </div>
                    <!-- text -->
                    <div class="lh-1">
                      <h2 class="mb-0">
                        Jitu Chauhan
                        <a href="#!" class="text-decoration-none">
                        </a>
                      </h2>
                      <p class="mb-0 d-block">@imjituchauhan</p>
                    </div>
                  </div>
                  <div>
                    <a href="#!" class="btn btn-outline-primary d-none d-md-block">Edit Profile</a>
                  </div>
                </div>
                <!-- nav -->
                <ul class="nav nav-lt-tab px-4" id="pills-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="profile-overview.html">Overview</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profile-project.html">Project</a>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="profile-files.html">Files</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profile-team.html">Team</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profile-followers.html"> Followers </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profile-activity.html">Activity</a>
                  </li>
                </ul>
              </div>
              <fieldset class="checkbox-group">
                <legend class="checkbox-group-legend">Choose your favorites</legend>
                <div class="checkbox">
                  <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" />
                    <span class="checkbox-tile">
                      <span class="checkbox-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
                          <rect width="256" height="256" fill="none"></rect>
                          <circle cx="96" cy="144.00002" r="10"></circle>
                          <circle cx="160" cy="144.00002" r="10"></circle>
                          <path d="M74.4017,80A175.32467,175.32467,0,0,1,128,72a175.32507,175.32507,0,0,1,53.59754,7.99971" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M181.59717,176.00041A175.32523,175.32523,0,0,1,128,184a175.32505,175.32505,0,0,1-53.59753-7.99971" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M155.04392,182.08789l12.02517,24.05047a7.96793,7.96793,0,0,0,8.99115,4.20919c24.53876-5.99927,45.69294-16.45908,61.10024-29.85086a8.05225,8.05225,0,0,0,2.47192-8.38971L205.65855,58.86074a8.02121,8.02121,0,0,0-4.62655-5.10908,175.85294,175.85294,0,0,0-29.66452-9.18289,8.01781,8.01781,0,0,0-9.31925,5.28642l-7.97318,23.91964" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M100.95624,182.08757l-12.02532,24.0508a7.96794,7.96794,0,0,1-8.99115,4.20918c-24.53866-5.99924-45.69277-16.459-61.10006-29.85069a8.05224,8.05224,0,0,1-2.47193-8.38972L50.34158,58.8607a8.0212,8.0212,0,0,1,4.62655-5.1091,175.85349,175.85349,0,0,1,29.66439-9.18283,8.0178,8.0178,0,0,1,9.31924,5.28642l7.97318,23.91964" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                        </svg>
                      </span>
                      <span class="checkbox-label">Discord</span>
                    </span>
                  </label>
                </div>
                <div class="checkbox">
                  <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" checked />
                    <span class="checkbox-tile">
                      <span class="checkbox-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
                          <rect width="256" height="256" fill="none"></rect>
                          <polygon points="56 100 56 168 128 236 128 168 200 168 56 32 200 32 200 100 56 100" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></polygon>
                        </svg>
                      </span>
                      <span class="checkbox-label">Framer</span>
                    </span>
                  </label>
                </div>
                <div class="checkbox">
                  <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" disabled/>
                    <span class="checkbox-tile">
                      <span class="checkbox-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
                          <rect width="256" height="256" fill="none"></rect>
                          <polygon points="72 40 184 40 240 104 128 224 16 104 72 40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></polygon>
                          <polygon points="177.091 104 128 224 78.909 104 128 40 177.091 104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></polygon>
                          <line x1="16" y1="104" x2="240" y2="104" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></line>
                        </svg>
                      </span>
                      <span class="checkbox-label">Sketch</span>
                    </span>
                  </label>
                </div>
                <div class="checkbox">
                  <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" />
                    <span class="checkbox-tile">
                      <span class="checkbox-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
                          <rect width="256" height="256" fill="none"></rect>
                          <circle cx="128" cy="128" r="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle>
                          <rect x="36" y="36" width="184" height="184" rx="48" stroke-width="12" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" fill="none"></rect>
                          <circle cx="180" cy="75.99998" r="10"></circle>
                        </svg>
                      </span>
                      <span class="checkbox-label">Instagram</span>
                    </span>
                  </label>
                </div>
                <div class="checkbox">
                  <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" />
                    <span class="checkbox-tile">
                      <span class="checkbox-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
                          <rect width="256" height="256" fill="none"></rect>
                          <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle>
                          <path d="M71.0247,205.27116a159.91145,159.91145,0,0,1,136.98116-77.27311q8.09514,0,15.99054.78906" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M188.0294,53.09083A159.68573,159.68573,0,0,1,64.00586,111.99805a160.8502,160.8502,0,0,1-30.15138-2.83671" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M85.93041,41.68508a159.92755,159.92755,0,0,1,78.99267,138.00723,160.35189,160.35189,0,0,1-4.73107,38.77687" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                        </svg>
                      </span>
                      <span class="checkbox-label">Dribbble</span>
                    </span>
                  </label>
                </div>
                <div class="checkbox">
                  <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" />
                    <span class="checkbox-tile">
                      <span class="checkbox-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
                          <rect width="256" height="256" fill="none"></rect>
                          <circle cx="128" cy="128" r="96" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle>
                          <g>
                            <path d="M179.1333,108.32931a112.19069,112.19069,0,0,0-102.3584.04859" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                            <path d="M164.29541,136.71457a79.94058,79.94058,0,0,0-72.68359.04736" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                            <path d="M149.47217,165.07248a47.97816,47.97816,0,0,0-43.03662.04736" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          </g>
                        </svg>
                      </span>
                      <span class="checkbox-label">Spotify</span>
                    </span>
                  </label>
                </div>
                <div class="checkbox">
                  <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" />
                    <span class="checkbox-tile">
                      <span class="checkbox-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
                          <rect width="256" height="256" fill="none"></rect>
                          <circle cx="162" cy="128" r="34" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></circle>
                          <path d="M128,94V26.00089H94a34,34,0,0,0,0,68Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M128,161.99911V94H94a34,34,0,0,0,0,68Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M128,94V26.00089h34a34,34,0,0,1,0,68Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M128,161.99911v34.00044A34,34,0,1,1,94,162Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                        </svg>
                      </span>
                      <span class="checkbox-label">Figma</span>
                    </span>
                  </label>
                </div>
                <div class="checkbox">
                  <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" checked />
                    <span class="checkbox-tile">
                      <span class="checkbox-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="192" height="192" fill="currentColor" viewBox="0 0 256 256">
                          <rect width="256" height="256" fill="none"></rect>
                          <path d="M80,56.00005h24a0,0,0,0,1,0,0v72a24,24,0,0,1-24,24h0a24,24,0,0,1-24-24V80a24,24,0,0,1,24-24Z" transform="translate(184.00005 24.00003) rotate(90)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M128,80H104a24,24,0,0,1-24-24V56a24,24,0,0,1,24-24h0a24,24,0,0,1,24,24Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M152,32.00007h24a0,0,0,0,1,0,0v72a24,24,0,0,1-24,24h0a24,24,0,0,1-24-24V56a24,24,0,0,1,24-24Z" transform="translate(304 160.00011) rotate(180)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M176,128V104a24,24,0,0,1,24-24h0a24,24,0,0,1,24,24v0a24,24,0,0,1-24,24Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M176,104.00005h24a0,0,0,0,1,0,0v72a24,24,0,0,1-24,24h0a24,24,0,0,1-24-24V128A24,24,0,0,1,176,104.00005Z" transform="translate(23.99995 328.00003) rotate(-90)" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M128,176h24a24,24,0,0,1,24,24v0a24,24,0,0,1-24,24h0a24,24,0,0,1-24-24Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M104,128h24a0,0,0,0,1,0,0v72a24,24,0,0,1-24,24h0a24,24,0,0,1-24-24V152A24,24,0,0,1,104,128Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                          <path d="M80,128v24a24,24,0,0,1-24,24h0a24,24,0,0,1-24-24v0a24,24,0,0,1,24-24Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="12"></path>
                        </svg>
                      </span>
                      <span class="checkbox-label">Slack</span>
                    </span>
                  </label>
                </div>
              </fieldset>
              <div>
                <main>
                  <div id="contentFaiFramework">
                    <div class="g-sidenav-show   homepage">
                     

                      <main>
                        <div id="contentFaiFramework">
                          <div class="row">
                            <div class="col-md-2">
                              <div style="margin-bottom:  60px"></div>
                              <div style="margin-bottom:  60px"></div>
                              <div class="screenB">
                                <div class="pn-ProductNav_Wrapper d-flex">
                                  <div class="flex-start">
                                    <button id="pnAdvancerLeft" class="pn-Advancer pn-Advancer_Left" type="button" style="align-content: center;display: flow-root;width: heigh;height: 100%;background: #fff;width: 30px;">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="15 6 9 12 15 18"></polyline>
                                      </svg>
                                    </button>
                                  </div>

                                  <nav id="pnProductNav" class="pn-ProductNav pn-ProductNav w-100 bg-white">
                                    <ul class="pn-ProductNav_Contents" id="pnProductNavContents" style="background: white;margin-bottom: 0;padding-left: 0;">

                                      <a href="javascript:void(0)" onclick="reach_page('list_kegiatan','view_layout','-1','Todo List')" class="pn-ProductNav_Link">Todo List </a>

                                      <a href="javascript:void(0)" onclick="reach_page('list_kegiatan','view_layout','-1','Kegiatan')" class="pn-ProductNav_Link">Kegiatan </a>

                                      <a href="javascript:void(0)" onclick="reach_page('list_kegiatan','view_layout','-1','Habits')" class="pn-ProductNav_Link">Habits </a>

                                      <a href="javascript:void(0)" onclick="reach_page('list_kegiatan','view_layout','-1','Mutabaah Yaumiyah')" class="pn-ProductNav_Link">Mutabaah Yaumiyah </a>

                                      <a href="javascript:void(0)" onclick="reach_page('list_kegiatan','view_layout','-1','Task Planner')" class="pn-ProductNav_Link">Task Planner </a>







                                    </ul>

                                  </nav>
                                  <div class="flex-end">

                                    <button id="pnAdvancerRight2" class="pn-Advancer pn-Advancer_Right " type="button" style="align-content: center;display: flow-root;width: heigh;height: 100%;background: #fff;width: 30px;">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <polyline points="9 6 15 12 9 18"></polyline>
                                      </svg>
                                    </button>
                                  </div>
                                </div>
                              </div>


                              <aside class="sidenav navbar navbar-vertical-soft-ui navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " style="margin-top: 50px !important;" data-color="success">

    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
        
        Mutabaah Yaumiyah        			<li class="nav-item">
									<a class="nav-link " href="http://localhost/FrameworkServer/FaiServer/page/JCPDBvFHRuDAzrDO2wsmQUnCt">
										

										<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">                </div>
                  
										<span class="nav-link-title nav-link-text ms-1">
											Todo List  	
										</span>
										
									</a>
								</li>
		        			<li class="nav-item">
									<a class="nav-link " href="http://localhost/FrameworkServer/FaiServer/page/XRmoULgHZx43MoltrDKSs5xa9">
										

										<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">                </div>
                  
										<span class="nav-link-title nav-link-text ms-1">
											Kegiatan  	
										</span>
										
									</a>
								</li>
		        			<li class="nav-item">
									<a class="nav-link " href="http://localhost/FrameworkServer/FaiServer/page/x9mEOINLRMsVcVTofg9tPAaB3">
										

										<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">                  </div>
                  
										<span class="nav-link-title nav-link-text ms-1">
											Habits  	
										</span>
										
									</a>
								</li>
		        			<li class="nav-item">
									<a class="nav-link active" href="http://localhost/FrameworkServer/FaiServer/page/lHXLfBPfxNNCd7iFEMqSuNM1r">
										

										<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">                  </div>
                  
										<span class="nav-link-title nav-link-text ms-1">
											Mutabaah Yaumiyah  	
										</span>
										
									</a>
								</li>
		        			<li class="nav-item">
									<a class="nav-link " href="http://localhost/FrameworkServer/FaiServer/page/KcNTvNlMroUJ2lJJEbnI0xlmy">
										

										<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">               </div>
                  
										<span class="nav-link-title nav-link-text ms-1">
											Task Planner  	
										</span>
										
									</a>
								</li>
																		
								            
           
           
        </ul>
    </div>
    
</aside>	 
                            </div>
                            <div class="col-md-10">

                              <main class=" position-relative  h-100 mt-1 border-radius-lg ">
                                <!-- [ Header ] end -->


                                <div id="fai_content">

                                  <input id="total_record" value="3" type="hidden">
                                  <input id="limit_page" value="2" type="hidden">

                                  <div class="">
                                    <!-- <nav class="navbar navbar-expand-lg px-0 shadow-none border-radius-xl card card-body blur" style="padding: 15px;"> -->
                                    <nav class="card card-body p-4" style="padding: 15px;">
                                      <div class=" ">
                                        <!-- py-1 px-3 -->
                                        <nav aria-label="breadcrumb">
                                          <h6 class="font-weight-bolder mb-0">Kegiatan</h6>
                                          <div class="text-muted text-small">Mutabaah Yaumiyah</div>
                                        </nav>



                                      </div>
                                      <ul class="nav nav-lt-tab " id="pills-tab" role="tablist">
                                        <li class="nav-item">
                                          <a class="nav-link" href="http://localhost/FrameworkServer/FaiServer/page/CajyQrxFqsRiF6wwBwzRMM4O5" "="">Muktabaah</a>
                </li>
                                        <li class=" nav-item">
                                            <a class="nav-link" href="http://localhost/FrameworkServer/FaiServer/page/So5e7BrxNRk2KLHCCR8dHOQpl" "="">Board</a>
                </li>
                                                                <li class=" nav-item">
                                              <a class="nav-link" href="http://localhost/FrameworkServer/FaiServer/page/6Bdm6lhoRCxhliKVHg9d5TP3i" "="">Report</a>
                </li>
                                        <li class=" nav-item">
                                                <a class="nav-link" href="http://localhost/FrameworkServer/FaiServer/page/cJQgZ1nTkJFLQF2K85uVZCTKa" "="">Leader Board</a>
                </li>
                                     
         </ul>
              </nav>
 </div>				<!-- End Navbar -->
				<div class=" container-fluid py-4">
                                                  <a class="btn btn-primary btn-sm" href="http://localhost/FrameworkServer/FaiServer/page/RXkypPeS0REWurlQh7FEJEcbo">Tambah Board</a> <a class="btn btn-primary btn-sm" href="http://localhost/FrameworkServer/FaiServer/page/5YczgCZEfU9BfhDFCslpuZXNX">Cari Board</a>
                                                  <div id="contentList">
                                                    <div class="row">
                                                      <array>CARD-IMG||CARD-TITLE||CARD-SUBTITLE||CARD-DESKRIPSI||CARD-FOOTER-BOTTOM||CARD-FOOTER-BOTTOMWITHAVATAR</array>

                                                      <div class="col-xl-2 col-md-6 mb-xl-0 mb-4">
                                                        <div class="card card-body ">
                                                          <div class="avatar position-relative" style="width: 100%;height: 100%;min-height: 100px;text-align: center;vertical-align: middle;display: flex;justify-content: center;justify-items: center;align-content: center;align-items: center;;"><span class="avatar " style=";">T</span></div>
                                                          <div class="px-1 pb-0">
                                                            <a href="javascript::void(0);">
                                                              <h3 class="card-title">
                                                                <be3 text="TEST1" done="true">TEST1</be3>
                                                              </h3>
                                                            </a>
                                                            <h6 class="card-title">Be3 ID: <be3 text="TEST" done="true">TEST</be3>
                                                            </h6>

                                                            <card-footer>

                                                              <a class="btn btn-primary" href="http://localhost/FrameworkServer/FaiServer/page/515YV0PUHmWTouuWLkw8NHlUh">View Board</a>
                                                              <card-footer-bottomwithavatar></card-footer-bottomwithavatar>
                                                            </card-footer>

                                                          </div>
                                                        </div>
                                                      </div>

                                                      <!--?php 

?-->
                                                      <array>CARD-IMG||CARD-TITLE||CARD-SUBTITLE||CARD-DESKRIPSI||CARD-FOOTER-BOTTOM||CARD-FOOTER-BOTTOMWITHAVATAR</array>

                                                      <div class="col-xl-2 col-md-6 mb-xl-0 mb-4">
                                                        <div class="card card-body ">
                                                          <div class="avatar position-relative" style="width: 100%;height: 100%;min-height: 100px;text-align: center;vertical-align: middle;display: flex;justify-content: center;justify-items: center;align-content: center;align-items: center;;"><span class="avatar " style=";">T</span></div>
                                                          <div class="px-1 pb-0">
                                                            <a href="javascript::void(0);">
                                                              <h3 class="card-title">
                                                                <be3 text="TEST2" done="true">TEST2</be3>
                                                              </h3>
                                                            </a>
                                                            <h6 class="card-title">Be3 ID: <be3 text="TEST" done="true">TEST</be3>
                                                            </h6>

                                                            <card-footer>

                                                              <a class="btn btn-primary" href="http://localhost/FrameworkServer/FaiServer/page/2z9ZCTWrnuIhceVJrlh2EXTT8">View Board</a>
                                                              <card-footer-bottomwithavatar></card-footer-bottomwithavatar>
                                                            </card-footer>

                                                          </div>
                                                        </div>
                                                      </div>

                                                      <!--?php 

?-->
                                                    </div>
                                                    <div style="display: grid;text-align: center;justify-content: center;">
                                                      <ul class="pagination m-0 ms-auto" style="align-items: center;">
                                                        <li class="first page-item active"><button type="button" class="page-link" onclick="gantipage(1),load_data_menu()">1</button></li>
                                                        <li class="page-item"><button type="button" class="page-link" onclick="gantipage(2),load_data_menu()">2</button></li>
                                                        <li class="page-item"><button type="button" class="page-link" onclick="gantipage(3),load_data_menu()">3</button></li>
                                                        <li class="page-item"><button type="button" class="page-link" onclick="gantipage(3),load_data_menu()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                              <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                                            </svg></button></li>
                                                        <li class="last page-item"><button type="button" class="page-link" onclick="gantipage(3),load_data_menu()" title="Last"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right">
                                                              <polyline points="13 17 18 12 13 7"></polyline>
                                                              <polyline points="6 17 11 12 6 7"></polyline>
                                                            </svg> </button></li>
                                                      </ul>
                                                    </div>
                                                  </div>

                                  </div>

                                  <script>
                                    var number_page = 1;
                                    var view = "ViewHorizontal";
                                    var numbeArrayEdit = 0;
                                  </script>
                                  <script>
                                    load_data_menu('Mutabaah Yaumiyah');



                                    function load_data_menu(id) {
                                      $('#load_id').val(id);
                                      // /alert($('#load_id').val());
                                      // alert(id);
                                      $.ajax({
                                        url: $('#load_link_route').val(),
                                        data: {
                                          jumlah: $('#limit_page').val(),
                                          total_record: $('#total_record').val(),
                                          datasearch: $('#searchID').val(),
                                          datafilter: $('#filterform').serializeArray(),
                                          page_view: $('#load_page_view').val(),
                                          menu: $('#load_menu').val(),
                                          view: view,
                                          page: number_page,
                                          type: 'load_data',
                                          'contentfaiframework': 'pages',
                                          number_page: number_page,
                                          apps: $('#load_apps').val(),
                                          id: id,
                                        },
                                        type: "get",
                                        dataType: "HTML",

                                        success: function(response, textStatus, xhr) {

                                          $('#contentList').html(response);
                                          eachDe();
                                        },
                                        error: function(error) {

                                          console.log(' Error ${error}')
                                        }
                                      })
                                    }
                                  </script>

                                </div>

                              </main>
                            </div>
                          </div>
                        </div>
                      </main>

                    </div>
                    <div class="" >
                      <!--left-sidebar p-0 navbar-vertical navbar nav-dashboard  style="position: fixed;left: 78px;width: ;top: 115px;overflow-y: scroll;height: 100%;z-index:99;background:white"-->
                      <div class="profileBox pt-2 pb-2">
                        <div class="image-wrapper">
                          <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="imaged  w36">
                        </div>
                        <div class="in">
                          <strong>Sebastian Doe</strong>
                          <div class="text-muted">4029209</div>
                        </div>
                        <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                          <ion-icon name="close-outline"></ion-icon>
                        </a>
                      </div>
                      <!-- * profile box -->
                      <!-- balance -->
                      <div class="sidebar-balance">
                        <div class="listview-title">Balance</div>
                        <div class="in">
                          <h1 class="amount">$ 2,562.50</h1>
                        </div>
                      </div>
                      <!-- * balance -->

                      <!-- action group -->
                      <div class="action-group">
                        <a href="app-index.html" class="action-button">
                          <div class="in">
                            <div class="iconbox">
                              <ion-icon name="add-outline"></ion-icon>
                            </div>
                            Deposit
                          </div>
                        </a>
                        <a href="app-index.html" class="action-button">
                          <div class="in">
                            <div class="iconbox">
                              <ion-icon name="arrow-down-outline"></ion-icon>
                            </div>
                            Withdraw
                          </div>
                        </a>
                        <a href="app-index.html" class="action-button">
                          <div class="in">
                            <div class="iconbox">
                              <ion-icon name="arrow-forward-outline"></ion-icon>
                            </div>
                            Send
                          </div>
                        </a>
                        <a href="app-cards.html" class="action-button">
                          <div class="in">
                            <div class="iconbox">
                              <ion-icon name="card-outline"></ion-icon>
                            </div>
                            My Cards
                          </div>
                        </a>
                      </div>
                      <!-- * action group -->
<div data-simplebar>
<style>
.icon-box {
  min-width: 36px;
  max-width: 36px;
  width: 36px;
  height: 36px;
  display: flex;
  align-items: center;
  justify-content: center;
  line-height: 1em;
  font-size: 22px;
  border-radius: 400px;
  margin-right: 16px;
}
</style>

                      <!-- menu -->
					  

					   </ul>
					   
				 </div>
                      <div class="listview-title mt-1">Menu</div>
					  
                      <ul class="listview flush transparent no-line image-listview   ">
                      <li class="nav-item">
          <a class="nav-link has-arrow  collapsed ">
            <div class="icon-box bg-primary">
              <ion-icon name="pie-chart-outline"></ion-icon>
            </div> Menu Level
          </a>
          <div id="navMenuLevel" class="collapse " data-bs-parent="#sideNavbar">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link has-arrow " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelSecond" aria-expanded="false" aria-controls="navMenuLevelSecond">
                  Two Level
                </a>
                <div id="navMenuLevelSecond" class="collapse" data-bs-parent="#navMenuLevel">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link " href="#!">
                        NavItem 1</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="#!">
                        NavItem 2</a>
                    </li>
                  </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link has-arrow  collapsed  " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelThree" aria-expanded="false" aria-controls="navMenuLevelThree">
                  Three Level
                </a>
                <div id="navMenuLevelThree" class="collapse " data-bs-parent="#navMenuLevel">
                  <ul class="nav flex-column">
                    <li class="nav-item">
                      <a class="nav-link  collapsed " href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevelThreeOne" aria-expanded="false" aria-controls="navMenuLevelThreeOne">
                        NavItem 1
                      </a>
                      <div id="navMenuLevelThreeOne" class="collapse collapse " data-bs-parent="#navMenuLevelThree">
                        <ul class="nav flex-column">
                          <li class="nav-item">
                            <a class="nav-link " href="#!">
                              NavChild Item 1
                            </a>
                          </li>
                        </ul>
                      </div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="#!">
                        Nav Item 2</a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </li>
             <!-- Nav item -->
             <li class="nav-item">
                 <div class="navbar-heading">Documentation</div>
             </li>                      
					  <li>
                          <a href="app-index.html" class="item">
                            <div class="icon-box bg-primary">
                              <ion-icon name="pie-chart-outline"></ion-icon>
                            </div>
                            <div class="in">
                              Overview
                              <span class="badge badge-primary">10</span>
                            </div>
                          </a>
						  <ul>
						   <li>
                          <a href="app-pages.html" class="item">
                            <div class="icon-box bg-primary">
                              <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                            <div class="in">
                              Pages
                            </div>
                          </a>
                        </li>
						</ul>
                        </li>
                       
                        <li>
                          <a href="app-components.html" class="item">
                            <div class="icon-box bg-primary">
                              <ion-icon name="apps-outline"></ion-icon>
                            </div>
                            <div class="in">
                              Components
                            </div>
                          </a>
                        </li>
                        <li>
                          <a href="app-cards.html" class="item">
                            <div class="icon-box bg-primary">
                              <ion-icon name="card-outline"></ion-icon>
                            </div>
                            <div class="in">
                              My Cards
                            </div>
                          </a>
                        </li>
                      </ul>
                      <!-- * menu -->

                      <!-- others -->
                      <div class="listview-title mt-1">Others</div>
                      <ul class="listview flush transparent no-line image-listview">
                        <li>
                          <a href="app-settings.html" class="item">
                            <div class="icon-box bg-primary">
                              <ion-icon name="settings-outline"></ion-icon>
                            </div>
                            <div class="in">
                              Settings
                            </div>
                          </a>
                        </li>
                        <li>
                          <a href="component-messages.html" class="item">
                            <div class="icon-box bg-primary">
                              <ion-icon name="chatbubble-outline"></ion-icon>
                            </div>
                            <div class="in">
                              Support
                            </div>
                          </a>
                        </li>
                        <li>
                          <a href="app-login.html" class="item">
                            <div class="icon-box bg-primary">
                              <ion-icon name="log-out-outline"></ion-icon>
                            </div>
                            <div class="in">
                              Log out
                            </div>
                          </a>
                        </li>
                      </ul>
                      <!-- * others -->

                      <!-- send money -->
                      <div class="listview-title mt-1">Send Money</div>
                      <ul class="listview image-listview flush transparent no-line">
                        <li>
                          <a href="#" class="item">
                            <img src="assets/img/sample/avatar/avatar2.jpg" alt="image" class="image">
                            <div class="in">
                              <div>Artem Sazonov</div>
                            </div>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="item">
                            <img src="assets/img/sample/avatar/avatar4.jpg" alt="image" class="image">
                            <div class="in">
                              <div>Sophie Asveld</div>
                            </div>
                          </a>
                        </li>
                        <li>
                          <a href="#" class="item">
                            <img src="assets/img/sample/avatar/avatar3.jpg" alt="image" class="image">
                            <div class="in">
                              <div>Kobus van de Vegte</div>
                            </div>
                          </a>
                        </li>
                      </ul>
                      <!-- * send money -->

                    </div>x`


<style>
  
.sidebarcard {
  flex-basis: 284px;
  display: flex;
  flex-direction: column;
  height: 100%;
  flex-shrink: 0;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 50px;
}
@media (max-width: 480px) {
  .sidebarcard {
    display: none;
  }
}
.sidebarcard-menu {
  display: inline-flex;
  flex-direction: column;
  /* padding-top: 64px; */
}
.sidebarcard-menu__link {
  color: var(--theme-inactive-color);
  text-decoration: none;
  font-size: 20px;
  font-weight: 500;
  transition: 0.3s;
}
.sidebarcard-menu__link + .sidebarcard-menu__link {
  margin-top: 24px;
}
.sidebarcard-menu__link:hover, .sidebarcard-menu__link.active {
  color: var(--theme-color);
}

.user {
  display: flex;
  flex-direction: column;
  padding-bottom: 20px;
  border-bottom: 1px solid var(--border-color);
}
.user-photo {
  width: 54px;
  height: 54px;
  border-radius: 10px;
  -o-object-fit: cover;
     object-fit: cover;
  flex-shrink: 0;
  margin-bottom: 20px;
}
.user-mail {
  margin-top: 6px;
  color: var(--theme-inactive-color);
  font-size: 14px;
}

.toggle {
  position: relative;
  display: inline-block;
  width: 56px;
  height: 24px;
  margin-top: auto;
}

input[type=checkbox] {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #4649bd;
  transition: 0.3s;
  border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 16px;
  width: 16px;
  left: 6px;
  bottom: 4px;
  background-color: #fff;
  transition: 0.4s;
  border-radius: 50%;
}


.maincard {
  display: flex;
  flex-direction: column;
  flex-grow: 1;
  padding: 50px 50px 50px 20px;
}
@media (max-width: 480px) {
  .maincard {
    padding: 40px 20px;
  }
}
.maincard-header {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}
.maincard-header__title {
  font-size: 28px;
  font-weight: 600;
  margin-right: 24px;
}
.maincard-header__avatars {
  flex-shrink: 0;
  display: flex;
  align-items: center;
}
@media (max-width: 480px) {
  .maincard-header__avatars {
    display: none;
  }
}
.maincard-header__avatars .maincard-header__avatar {
  width: 36px;
  height: 36px;
  -o-object-fit: cover;
     object-fit: cover;
  flex-shrink: 0;
  border-radius: 50%;
  border: 2px solid var(--theme-bg-color);
}
.maincard-header__avatars .maincard-header__avatar + .maincard-header__avatar {
  margin-left: -5px;
}
.maincard-header__avatars .add-button {
  background-color: transparent;
  border: 0;
  padding: 0;
  color: #d8d8d8;
  margin-left: 6px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
}
.maincard-header__avatars .add-button svg {
  width: 28px;
  height: 28px;
  flex-shrink: 0;
}
.maincard-header__add {
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
  margin-left: auto;
  cursor: pointer;
  transition: 0.3s;
}
.maincard-header__add:hover {
  background-color: #e4361a;
}
.maincard-header__add svg {
  width: 20px;
  height: 20px;
}
.maincard-header-nav {
  display: flex;
  align-items: center;
  font-size: 15px;
  padding: 20px 0;
}
.maincard-header-nav .nav-item {
  color: var(--theme-inactive-color);
  text-decoration: none;
  padding-bottom: 6px;
  transition: 0.3s;
  border-bottom: 1px solid transparent;
}
.maincard-header-nav .nav-item:hover {
  color: #fff;
}
.maincard-header-nav .nav-item.active {
  border-bottom: 1px solid #fff;
  color: #fff;
}
.maincard-header-nav * + * {
  margin-left: 24px;
}

.maincard-content {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}
@media (max-width: 480px) {
  .maincard-content {
    gap: 10px;
  }
}

.card.card-1 {
  background-image: url("https://images.unsplash.com/photo-1567653418876-5bb0e566e1c2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1664&q=80");
  view-transition-name: c1;
}
.card.card-2 {
  view-transition-name: c2;
  background-image: url("https://images.unsplash.com/photo-1575500221017-ea5e7b7d0e34?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1635&q=80");
}
.card.card-3 {
  view-transition-name: c3;
  background-image: url("https://images.unsplash.com/photo-1506619216599-9d16d0903dfd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1738&q=80");
}
.card.card-4 {
  background-color: #e3dfec;
  view-transition-name: c4;
  background-image: url("https://images.unsplash.com/photo-1684483871267-739be928cb0e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1yZWxhdGVkfDJ8fHxlbnwwfHx8fHw%3D&auto=format&fit=crop&w=400&q=60");
}
.card.card-5 {
  background-image: url("https://images.unsplash.com/photo-1559181567-c3190ca9959b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1664&q=80");
  view-transition-name: c5;
}
.card.card-6 {
  background-color: #f8d7cd;
  view-transition-name: c6;
  background-image: url("https://images.unsplash.com/photo-1586788224331-947f68671cf1?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1887&q=80");
}

.card-img {
  -o-object-fit: cover;
     object-fit: cover;
  background-size: cover;
  background-position: center;
}

.card-main {
  view-transition-name: card1;
}

.card.active {
  grid-column: 1;
  grid-column-end: 3;
  grid-row: 1;
  grid-row-end: 6;
  z-index: 999;
  aspect-ratio: 1/1;
}
@media (max-width: 480px) {
  .card.active {
    grid-column-end: 4;
    aspect-ratio: 2/1;
  }
}

.maincard-content.expanded .card:not(.active) {
  opacity: 0.4;
  pointer-events: none;
  aspect-ratio: 3/1;
  grid-column-start: 3;
}
@media (max-width: 480px) {
  .maincard-content.expanded .card:not(.active) {
    aspect-ratio: 1;
    grid-column-start: auto;
  }
}
.app {
  background-color: var(--theme-bg-color);
  width: 100%;
  max-width: 1200px;
  border-radius: 20px;
  overflow: hidden;
  display: flex;
  position: relative;
}
</style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="app">
 <div class="sidebarcard">
  <div class="user">
   <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2360&q=80" alt="user photo" class="user-photo">
   <div class="user-name">Alexander</div>
   <div class="user-mail">alexander@email.com</div>

   <div >
    <select class="form-control" id>
      
    </select>
   </div>
  </div>
  <div class="sidebarcard-menu">
   <a href="#" class="sidebarcard-menu__link active">Design</a>
   <a href="#" class="sidebarcard-menu__link">Barbeque</a>
   <a href="#" class="sidebarcard-menu__link">Productivity</a>
   <a href="#" class="sidebarcard-menu__link">Workout</a>
   <a href="#" class="sidebarcard-menu__link">Book</a>
   <a href="#" class="sidebarcard-menu__link">Snack</a>
  </div>
  <label class="toggle">
   <input type="checkbox">
   <span class="slider"></span>
  </label>
 </div>
 <div class="maincard">
  <div class="maincard-header">
   <div class="maincard-header__title">Productivity</div>
   <div class="maincard-header__avatars">
    <img class="maincard-header__avatar" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80" alt="avatar">
    <img class="maincard-header__avatar" src="https://images.unsplash.com/photo-1683392969197-17547ac3e06e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1587&q=80" alt="avatar">
    <img class="maincard-header__avatar" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1760&q=80" alt="avatar">
    <button class="add-button"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
</svg></button>
   </div>
   <button class="maincard-header__add">
    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
</svg>
   </button>
  </div>
  <div class="maincard-header-nav">
    <a href="#" class="nav-item active">All</a>
    <a href="#" class="nav-item">Videos</a>
    <a href="#" class="nav-item">Notes</a>
    <a href="#" class="nav-item">Music</a>
    <a href="#" class="nav-item">To-do list</a>
  </div>
  <div class="maincard-content">
   <div class="card card-2 card-img"></div>
   <div class="card card-3 card-img"></div>
    <div class="card card-img card-1 card-maincard"></div>
   <div class="card card-4 card-img"></div>
   <div class="card card-img card-5"></div>
   <div class="card card-6 card-img"></div>
  </div>
 </div>
</div>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>
<script>
const menuItems = document.querySelectorAll(".sidebar-menu__link");

const navItems = document.querySelectorAll(".nav-item");

menuItems.forEach(menuItem => {
  menuItem.addEventListener("click", e => {
    if (!e.target.classList.contains("active")) {
      document.
      querySelector(".sidebar-menu__link.active").
      classList.remove("active");
      e.target.classList.add("active");
    }
  });
});

navItems.forEach(navItem => {
  navItem.addEventListener("click", e => {
    if (!e.target.classList.contains("active")) {
      document.querySelector(".nav-item.active").classList.remove("active");
      e.target.classList.add("active");
    }
  });
});

const cards = document.querySelectorAll(".card");
const mainContent = document.querySelector(".main-content");

cards.forEach(card => {
  card.addEventListener("click", () => {
    console.log("");
    document.startViewTransition(() => {
      if (!card.classList.contains('active')) {
        mainContent.classList.add("expanded");
        card.classList.add("active");
      } else {
        card.classList.remove("active");
        mainContent.classList.remove("expanded");
      }
    });
  });
});
  </script>



                    <section class="section">
                      <div class="mb-5">
                        <h3 class="mb-0 "> Kategori Produk</h3>
                      </div>


                      <div class="row">


                        <div class="col-md-2">
                          <a class="btn btn-primary" onclick="reachpage('kategori_produk','tambah',-1)"> add Kategori Produk</a>
                        </div>
                        <form method="POST" id="formimexport_fai_framework" enctype="multipart/form-data" "="">
      
       
        <div class=" text-right right">
                          <button onclick="list_imexport('pdf')" type="button" value="pdf" name="Cari" class="btn btn-primary ">PDF </button>
                          <button onclick="list_imexport('excel')" type="button" value="excel" name="Cari" class="btn btn-primary ">Excel </button>

                      </div>

                      <div id="import_content" style="display:none;width: 64%;float: right;">

                        <input type="file" class="form-control" name="excel">
                        <button onclick="list_imexport('excel')" type="button" value="import_excel" name="Cari" style="float: right;" class="btn btn-primary ">Submit</button>
                      </div>

                      </form>


                  </div>

                  <div class="row mt-2">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-body">
                          <div class="pb-3">
                            <form id="formlist_fai_framework" method="get" enctype="multipart/form-data">
                              <div class="row"></div>

                            </form>
                          </div>



                          <div class="row">
                            <div class="col-6 d-flex " style="align-content: center;align-items: center;">Show <select class="form-control " id="show_entry" style="width: 100px">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="250">250</option>
                                <option value="500">500</option>
                              </select> Entries
                            </div>
                            <div class="col-6 d-flex " style="align-content: center;align-items: center;justify-content: end;">
                              Search <input class="form-control" id="search" style="width: 50%">
                            </div>
                            <div class="col-12 mt-3 mb-3">
                              <table class="table table-bordered table-striped" id="example1" style="width: 100%">
                                <thead class="">
                                  <tr>
                                    <th>No</th>
                                    <th>Kode Kategori</th>
                                    <th>Nama Kategori</th>
                                    <th>Action</th>
                                  </tr>
                                  <tr>
                                    <td>Nomor</td>
                                  </tr>

                                </thead>
                                <tbody>
                                </tbody>
                              </table>

                            </div>
                            <div class="col-6 d-flex " style="align-content: center;align-items: center;">
                              Showing 1 to 10 of 16 entries
                            </div>
                            <div class="col-6 d-flex " style="align-content: center;align-items: center;justify-content: end;">
                              <ul class="pagination m-0 ms-auto" style="align-items: center;">
                                <li class="first page-item"><button type="button" class="page-link" onclick="gantipage(1),load_data_menu()" title="First"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left">
                                      <polyline points="11 17 6 12 11 7"></polyline>
                                      <polyline points="18 17 13 12 18 7"></polyline>
                                    </svg> </button></li>
                                <li class="page-item "><button type="button" class="page-link" onclick="gantipage(-1),load_data_menu()" title="Previous"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                                    </svg></button></li>
                                <li class="page-item "> <button type="button" class="page-link" onclick="gantipage(1),load_data_menu()">1</button></li>
                                <li class="page-item active"><button type="button" class="page-link" onclick="gantipage(2),load_data_menu()">2</button></li>
                                <li class="page-item"><button type="button" class="page-link" onclick="gantipage(3),load_data_menu()">3</button></li>
                                <li class="page-item"><button type="button" class="page-link" onclick="gantipage(4),load_data_menu()">4</button></li>
                                <li class="page-item"><button type="button" class="page-link" onclick="gantipage(5),load_data_menu()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                      <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                                    </svg></button></li>
                                <li class="last page-item"><button type="button" class="page-link" onclick="gantipage(22),load_data_menu()" title="Last"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right">
                                      <polyline points="13 17 18 12 13 7"></polyline>
                                      <polyline points="6 17 11 12 6 7"></polyline>
                                    </svg> </button></li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  </section>

                  <script>
                    function show_import() {
                      $('#import_content').show();
                    }

                    function list_from(Cari) {
                      if (Cari == 'pdf') {

                        window.location.href = "http://localhost/FrameworkServer/FaiServer/ApotekPage/all_page?apps=Apotek&page_view=penjualan__tagihan&type=pdf&id=-1";
                      } else if (Cari == 'excel') {
                        window.location.href = "http://localhost/FrameworkServer/FaiServer/ApotekPage/all_page?apps=Apotek&page_view=penjualan__tagihan&type=excel&id=-1";
                      } else {


                        $.ajax({
                          type: 'get',
                          data: $('#formlist_fai_framework').serialize() +
                            '&Cari=' + Cari + '&id=' + '-1' +
                            '&apps=' + $('#load_apps').val() +
                            '&page_view=' + $('#load_page_view').val() +
                            '&type=' + Cari +
                            '&link_route=' + $('#load_link_route').val(),
                          url: $('#load_link_route').val(),
                          dataType: 'html',
                          success: function(data) {
                            $('#contentFaiFramework').html(data);
                          },
                          error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
                          }
                        });
                      }

                    }

                    function list_imexport(Cari) {
                      if (Cari == 'pdf') {

                        window.location.href = "http://localhost/FrameworkServer/FaiServer/ApotekPage/all_page?apps=Apotek&page_view=penjualan__tagihan&type=pdf&id=-1";
                      } else if (Cari == 'excel') {
                        window.location.href = "http://localhost/FrameworkServer/FaiServer/ApotekPage/all_page?apps=Apotek&page_view=penjualan__tagihan&type=excel&id=-1";
                      } else {


                        $.ajax({
                          type: 'get',
                          data: $('#formlist_fai_framework').serialize() +
                            '&Cari=' + Cari + '&id=' + '-1' +
                            '&apps=' + $('#load_apps').val() +
                            '&page_view=' + $('#load_page_view').val() +
                            '&type=' + Cari +
                            '&link_route=' + $('#load_link_route').val(),
                          url: $('#load_link_route').val(),
                          dataType: 'html',
                          success: function(data) {
                            $('#contentFaiFramework').html(data);
                          },
                          error: function(error) {
                            console.log('error; ' + eval(error));
                            //alert(2);
                          }
                        });
                      }

                    }
                  </script>
              </div>
  </main>
  <!-- row -->

  <div class="row">
    <div class="col-lg-8 col-12">
      <!-- card -->
      <div class="card mb-4">
        <!-- card body -->
        <div class="card-body">
          <div>
            <!-- input -->
            <div class="mb-3">
              <label class="form-label">Product Title</label>
              <input type="text" class="form-control" placeholder="Enter Product Title" required="">
            </div>
            <!-- input -->
            <div>
              <label class="form-label">Product Description</label>
              <div class="ql-toolbar ql-snow"><span class="ql-formats"><span class="ql-header ql-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-0"><svg viewBox="0 0 18 18">
                        <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                        <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                      </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-0"><span tabindex="0" role="button" class="ql-picker-item" data-value="1"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="2"></span><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span></span></span><select class="ql-header" style="display: none;">
                    <option value="1"></option>
                    <option value="2"></option>
                    <option selected="selected"></option>
                  </select></span><span class="ql-formats"><span class="ql-font ql-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-1"><svg viewBox="0 0 18 18">
                        <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                        <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                      </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-1"><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="serif"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="monospace"></span></span></span><select class="ql-font" style="display: none;">
                    <option selected="selected"></option>
                    <option value="serif"></option>
                    <option value="monospace"></option>
                  </select></span><span class="ql-formats"><button type="button" class="ql-bold"><svg viewBox="0 0 18 18">
                      <path class="ql-stroke" d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z"></path>
                      <path class="ql-stroke" d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z"></path>
                    </svg></button><button type="button" class="ql-italic"><svg viewBox="0 0 18 18">
                      <line class="ql-stroke" x1="7" x2="13" y1="4" y2="4"></line>
                      <line class="ql-stroke" x1="5" x2="11" y1="14" y2="14"></line>
                      <line class="ql-stroke" x1="8" x2="10" y1="14" y2="4"></line>
                    </svg></button><button type="button" class="ql-underline"><svg viewBox="0 0 18 18">
                      <path class="ql-stroke" d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path>
                      <rect class="ql-fill" height="1" rx="0.5" ry="0.5" width="12" x="3" y="15"></rect>
                    </svg></button><button type="button" class="ql-strike"><svg viewBox="0 0 18 18">
                      <line class="ql-stroke ql-thin" x1="15.5" x2="2.5" y1="8.5" y2="9.5"></line>
                      <path class="ql-fill" d="M9.007,8C6.542,7.791,6,7.519,6,6.5,6,5.792,7.283,5,9,5c1.571,0,2.765.679,2.969,1.309a1,1,0,0,0,1.9-.617C13.356,4.106,11.354,3,9,3,6.2,3,4,4.538,4,6.5a3.2,3.2,0,0,0,.5,1.843Z"></path>
                      <path class="ql-fill" d="M8.984,10C11.457,10.208,12,10.479,12,11.5c0,0.708-1.283,1.5-3,1.5-1.571,0-2.765-.679-2.969-1.309a1,1,0,1,0-1.9.617C4.644,13.894,6.646,15,9,15c2.8,0,5-1.538,5-3.5a3.2,3.2,0,0,0-.5-1.843Z"></path>
                    </svg></button></span><span class="ql-formats"><span class="ql-size ql-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-2"><svg viewBox="0 0 18 18">
                        <polygon class="ql-stroke" points="7 11 9 13 11 11 7 11"></polygon>
                        <polygon class="ql-stroke" points="7 7 9 5 11 7 7 7"></polygon>
                      </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-2"><span tabindex="0" role="button" class="ql-picker-item" data-value="small"></span><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="large"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="huge"></span></span></span><select class="ql-size" style="display: none;">
                    <option value="small"></option>
                    <option selected="selected"></option>
                    <option value="large"></option>
                    <option value="huge"></option>
                  </select></span><span class="ql-formats"><button type="button" class="ql-list" value="ordered"><svg viewBox="0 0 18 18">
                      <line class="ql-stroke" x1="7" x2="15" y1="4" y2="4"></line>
                      <line class="ql-stroke" x1="7" x2="15" y1="9" y2="9"></line>
                      <line class="ql-stroke" x1="7" x2="15" y1="14" y2="14"></line>
                      <line class="ql-stroke ql-thin" x1="2.5" x2="4.5" y1="5.5" y2="5.5"></line>
                      <path class="ql-fill" d="M3.5,6A0.5,0.5,0,0,1,3,5.5V3.085l-0.276.138A0.5,0.5,0,0,1,2.053,3c-0.124-.247-0.023-0.324.224-0.447l1-.5A0.5,0.5,0,0,1,4,2.5v3A0.5,0.5,0,0,1,3.5,6Z"></path>
                      <path class="ql-stroke ql-thin" d="M4.5,10.5h-2c0-.234,1.85-1.076,1.85-2.234A0.959,0.959,0,0,0,2.5,8.156"></path>
                      <path class="ql-stroke ql-thin" d="M2.5,14.846a0.959,0.959,0,0,0,1.85-.109A0.7,0.7,0,0,0,3.75,14a0.688,0.688,0,0,0,.6-0.736,0.959,0.959,0,0,0-1.85-.109"></path>
                    </svg></button><button type="button" class="ql-list" value="bullet"><svg viewBox="0 0 18 18">
                      <line class="ql-stroke" x1="6" x2="15" y1="4" y2="4"></line>
                      <line class="ql-stroke" x1="6" x2="15" y1="9" y2="9"></line>
                      <line class="ql-stroke" x1="6" x2="15" y1="14" y2="14"></line>
                      <line class="ql-stroke" x1="3" x2="3" y1="4" y2="4"></line>
                      <line class="ql-stroke" x1="3" x2="3" y1="9" y2="9"></line>
                      <line class="ql-stroke" x1="3" x2="3" y1="14" y2="14"></line>
                    </svg></button></span><span class="ql-formats"><span class="ql-color ql-picker ql-color-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-3"><svg viewBox="0 0 18 18">
                        <line class="ql-color-label ql-stroke ql-transparent" x1="3" x2="15" y1="15" y2="15"></line>
                        <polyline class="ql-stroke" points="5.5 11 9 3 12.5 11"></polyline>
                        <line class="ql-stroke" x1="11.63" x2="6.38" y1="9" y2="9"></line>
                      </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-3"><span tabindex="0" role="button" class="ql-picker-item ql-selected ql-primary"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffff" style="background-color: rgb(255, 255, 255);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span></span></span><select class="ql-color" style="display: none;">
                    <option selected="selected"></option>
                    <option value="#e60000"></option>
                    <option value="#ff9900"></option>
                    <option value="#ffff00"></option>
                    <option value="#008a00"></option>
                    <option value="#0066cc"></option>
                    <option value="#9933ff"></option>
                    <option value="#ffffff"></option>
                    <option value="#facccc"></option>
                    <option value="#ffebcc"></option>
                    <option value="#ffffcc"></option>
                    <option value="#cce8cc"></option>
                    <option value="#cce0f5"></option>
                    <option value="#ebd6ff"></option>
                    <option value="#bbbbbb"></option>
                    <option value="#f06666"></option>
                    <option value="#ffc266"></option>
                    <option value="#ffff66"></option>
                    <option value="#66b966"></option>
                    <option value="#66a3e0"></option>
                    <option value="#c285ff"></option>
                    <option value="#888888"></option>
                    <option value="#a10000"></option>
                    <option value="#b26b00"></option>
                    <option value="#b2b200"></option>
                    <option value="#006100"></option>
                    <option value="#0047b2"></option>
                    <option value="#6b24b2"></option>
                    <option value="#444444"></option>
                    <option value="#5c0000"></option>
                    <option value="#663d00"></option>
                    <option value="#666600"></option>
                    <option value="#003700"></option>
                    <option value="#002966"></option>
                    <option value="#3d1466"></option>
                  </select><span class="ql-background ql-picker ql-color-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-4"><svg viewBox="0 0 18 18">
                        <g class="ql-fill ql-color-label">
                          <polygon points="6 6.868 6 6 5 6 5 7 5.942 7 6 6.868"></polygon>
                          <rect height="1" width="1" x="4" y="4"></rect>
                          <polygon points="6.817 5 6 5 6 6 6.38 6 6.817 5"></polygon>
                          <rect height="1" width="1" x="2" y="6"></rect>
                          <rect height="1" width="1" x="3" y="5"></rect>
                          <rect height="1" width="1" x="4" y="7"></rect>
                          <polygon points="4 11.439 4 11 3 11 3 12 3.755 12 4 11.439"></polygon>
                          <rect height="1" width="1" x="2" y="12"></rect>
                          <rect height="1" width="1" x="2" y="9"></rect>
                          <rect height="1" width="1" x="2" y="15"></rect>
                          <polygon points="4.63 10 4 10 4 11 4.192 11 4.63 10"></polygon>
                          <rect height="1" width="1" x="3" y="8"></rect>
                          <path d="M10.832,4.2L11,4.582V4H10.708A1.948,1.948,0,0,1,10.832,4.2Z"></path>
                          <path d="M7,4.582L7.168,4.2A1.929,1.929,0,0,1,7.292,4H7V4.582Z"></path>
                          <path d="M8,13H7.683l-0.351.8a1.933,1.933,0,0,1-.124.2H8V13Z"></path>
                          <rect height="1" width="1" x="12" y="2"></rect>
                          <rect height="1" width="1" x="11" y="3"></rect>
                          <path d="M9,3H8V3.282A1.985,1.985,0,0,1,9,3Z"></path>
                          <rect height="1" width="1" x="2" y="3"></rect>
                          <rect height="1" width="1" x="6" y="2"></rect>
                          <rect height="1" width="1" x="3" y="2"></rect>
                          <rect height="1" width="1" x="5" y="3"></rect>
                          <rect height="1" width="1" x="9" y="2"></rect>
                          <rect height="1" width="1" x="15" y="14"></rect>
                          <polygon points="13.447 10.174 13.469 10.225 13.472 10.232 13.808 11 14 11 14 10 13.37 10 13.447 10.174"></polygon>
                          <rect height="1" width="1" x="13" y="7"></rect>
                          <rect height="1" width="1" x="15" y="5"></rect>
                          <rect height="1" width="1" x="14" y="6"></rect>
                          <rect height="1" width="1" x="15" y="8"></rect>
                          <rect height="1" width="1" x="14" y="9"></rect>
                          <path d="M3.775,14H3v1H4V14.314A1.97,1.97,0,0,1,3.775,14Z"></path>
                          <rect height="1" width="1" x="14" y="3"></rect>
                          <polygon points="12 6.868 12 6 11.62 6 12 6.868"></polygon>
                          <rect height="1" width="1" x="15" y="2"></rect>
                          <rect height="1" width="1" x="12" y="5"></rect>
                          <rect height="1" width="1" x="13" y="4"></rect>
                          <polygon points="12.933 9 13 9 13 8 12.495 8 12.933 9"></polygon>
                          <rect height="1" width="1" x="9" y="14"></rect>
                          <rect height="1" width="1" x="8" y="15"></rect>
                          <path d="M6,14.926V15H7V14.316A1.993,1.993,0,0,1,6,14.926Z"></path>
                          <rect height="1" width="1" x="5" y="15"></rect>
                          <path d="M10.668,13.8L10.317,13H10v1h0.792A1.947,1.947,0,0,1,10.668,13.8Z"></path>
                          <rect height="1" width="1" x="11" y="15"></rect>
                          <path d="M14.332,12.2a1.99,1.99,0,0,1,.166.8H15V12H14.245Z"></path>
                          <rect height="1" width="1" x="14" y="15"></rect>
                          <rect height="1" width="1" x="15" y="11"></rect>
                        </g>
                        <polyline class="ql-stroke" points="5.5 13 9 5 12.5 13"></polyline>
                        <line class="ql-stroke" x1="11.63" x2="6.38" y1="11" y2="11"></line>
                      </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-4"><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#000000" style="background-color: rgb(0, 0, 0);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#e60000" style="background-color: rgb(230, 0, 0);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ff9900" style="background-color: rgb(255, 153, 0);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#ffff00" style="background-color: rgb(255, 255, 0);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#008a00" style="background-color: rgb(0, 138, 0);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#0066cc" style="background-color: rgb(0, 102, 204);"></span><span tabindex="0" role="button" class="ql-picker-item ql-primary" data-value="#9933ff" style="background-color: rgb(153, 51, 255);"></span><span tabindex="0" role="button" class="ql-picker-item ql-selected"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#facccc" style="background-color: rgb(250, 204, 204);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ffebcc" style="background-color: rgb(255, 235, 204);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ffffcc" style="background-color: rgb(255, 255, 204);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#cce8cc" style="background-color: rgb(204, 232, 204);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#cce0f5" style="background-color: rgb(204, 224, 245);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ebd6ff" style="background-color: rgb(235, 214, 255);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#bbbbbb" style="background-color: rgb(187, 187, 187);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#f06666" style="background-color: rgb(240, 102, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ffc266" style="background-color: rgb(255, 194, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#ffff66" style="background-color: rgb(255, 255, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#66b966" style="background-color: rgb(102, 185, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#66a3e0" style="background-color: rgb(102, 163, 224);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#c285ff" style="background-color: rgb(194, 133, 255);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#888888" style="background-color: rgb(136, 136, 136);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#a10000" style="background-color: rgb(161, 0, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#b26b00" style="background-color: rgb(178, 107, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#b2b200" style="background-color: rgb(178, 178, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#006100" style="background-color: rgb(0, 97, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#0047b2" style="background-color: rgb(0, 71, 178);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#6b24b2" style="background-color: rgb(107, 36, 178);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#444444" style="background-color: rgb(68, 68, 68);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#5c0000" style="background-color: rgb(92, 0, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#663d00" style="background-color: rgb(102, 61, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#666600" style="background-color: rgb(102, 102, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#003700" style="background-color: rgb(0, 55, 0);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#002966" style="background-color: rgb(0, 41, 102);"></span><span tabindex="0" role="button" class="ql-picker-item" data-value="#3d1466" style="background-color: rgb(61, 20, 102);"></span></span></span><select class="ql-background" style="display: none;">
                    <option value="#000000"></option>
                    <option value="#e60000"></option>
                    <option value="#ff9900"></option>
                    <option value="#ffff00"></option>
                    <option value="#008a00"></option>
                    <option value="#0066cc"></option>
                    <option value="#9933ff"></option>
                    <option selected="selected"></option>
                    <option value="#facccc"></option>
                    <option value="#ffebcc"></option>
                    <option value="#ffffcc"></option>
                    <option value="#cce8cc"></option>
                    <option value="#cce0f5"></option>
                    <option value="#ebd6ff"></option>
                    <option value="#bbbbbb"></option>
                    <option value="#f06666"></option>
                    <option value="#ffc266"></option>
                    <option value="#ffff66"></option>
                    <option value="#66b966"></option>
                    <option value="#66a3e0"></option>
                    <option value="#c285ff"></option>
                    <option value="#888888"></option>
                    <option value="#a10000"></option>
                    <option value="#b26b00"></option>
                    <option value="#b2b200"></option>
                    <option value="#006100"></option>
                    <option value="#0047b2"></option>
                    <option value="#6b24b2"></option>
                    <option value="#444444"></option>
                    <option value="#5c0000"></option>
                    <option value="#663d00"></option>
                    <option value="#666600"></option>
                    <option value="#003700"></option>
                    <option value="#002966"></option>
                    <option value="#3d1466"></option>
                  </select><span class="ql-align ql-picker ql-icon-picker"><span class="ql-picker-label" tabindex="0" role="button" aria-expanded="false" aria-controls="ql-picker-options-5"><svg viewBox="0 0 18 18">
                        <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                        <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                        <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                      </svg></span><span class="ql-picker-options" aria-hidden="true" tabindex="-1" id="ql-picker-options-5"><span tabindex="0" role="button" class="ql-picker-item ql-selected"><svg viewBox="0 0 18 18">
                          <line class="ql-stroke" x1="3" x2="15" y1="9" y2="9"></line>
                          <line class="ql-stroke" x1="3" x2="13" y1="14" y2="14"></line>
                          <line class="ql-stroke" x1="3" x2="9" y1="4" y2="4"></line>
                        </svg></span><span tabindex="0" role="button" class="ql-picker-item" data-value="center"><svg viewBox="0 0 18 18">
                          <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                          <line class="ql-stroke" x1="14" x2="4" y1="14" y2="14"></line>
                          <line class="ql-stroke" x1="12" x2="6" y1="4" y2="4"></line>
                        </svg></span><span tabindex="0" role="button" class="ql-picker-item" data-value="right"><svg viewBox="0 0 18 18">
                          <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                          <line class="ql-stroke" x1="15" x2="5" y1="14" y2="14"></line>
                          <line class="ql-stroke" x1="15" x2="9" y1="4" y2="4"></line>
                        </svg></span><span tabindex="0" role="button" class="ql-picker-item" data-value="justify"><svg viewBox="0 0 18 18">
                          <line class="ql-stroke" x1="15" x2="3" y1="9" y2="9"></line>
                          <line class="ql-stroke" x1="15" x2="3" y1="14" y2="14"></line>
                          <line class="ql-stroke" x1="15" x2="3" y1="4" y2="4"></line>
                        </svg></span></span></span><select class="ql-align" style="display: none;">
                    <option selected="selected"></option>
                    <option value="center"></option>
                    <option value="right"></option>
                    <option value="justify"></option>
                  </select></span><span class="ql-formats"><button type="button" class="ql-link"><svg viewBox="0 0 18 18">
                      <line class="ql-stroke" x1="7" x2="11" y1="7" y2="11"></line>
                      <path class="ql-even ql-stroke" d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z"></path>
                      <path class="ql-even ql-stroke" d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z"></path>
                    </svg></button><button type="button" class="ql-image"><svg viewBox="0 0 18 18">
                      <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect>
                      <circle class="ql-fill" cx="6" cy="7" r="1"></circle>
                      <polyline class="ql-even ql-fill" points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline>
                    </svg></button><button type="button" class="ql-code-block"><svg viewBox="0 0 18 18">
                      <polyline class="ql-even ql-stroke" points="5 7 3 9 5 11"></polyline>
                      <polyline class="ql-even ql-stroke" points="13 7 15 9 13 11"></polyline>
                      <line class="ql-stroke" x1="10" x2="8" y1="5" y2="13"></line>
                    </svg></button><button type="button" class="ql-video"><svg viewBox="0 0 18 18">
                      <rect class="ql-stroke" height="12" width="12" x="3" y="3"></rect>
                      <rect class="ql-fill" height="12" width="1" x="5" y="3"></rect>
                      <rect class="ql-fill" height="12" width="1" x="12" y="3"></rect>
                      <rect class="ql-fill" height="2" width="8" x="5" y="8"></rect>
                      <rect class="ql-fill" height="1" width="3" x="3" y="5"></rect>
                      <rect class="ql-fill" height="1" width="3" x="3" y="7"></rect>
                      <rect class="ql-fill" height="1" width="3" x="3" y="10"></rect>
                      <rect class="ql-fill" height="1" width="3" x="3" y="12"></rect>
                      <rect class="ql-fill" height="1" width="3" x="12" y="5"></rect>
                      <rect class="ql-fill" height="1" width="3" x="12" y="7"></rect>
                      <rect class="ql-fill" height="1" width="3" x="12" y="10"></rect>
                      <rect class="ql-fill" height="1" width="3" x="12" y="12"></rect>
                    </svg></button></span></div>
              <div class="pb-8 ql-container ql-snow" id="editor">
                <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true">
                  <p><br></p>
                </div>
                <div class="ql-clipboard" contenteditable="true" tabindex="-1"></div>
                <div class="ql-tooltip ql-hidden"><a class="ql-preview" rel="noopener noreferrer" target="_blank" href="about:blank"></a><input type="text" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a class="ql-action"></a><a class="ql-remove"></a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- card -->
      <div class="card mb-4">
        <!-- card body -->
        <div class="card-body">
          <div>
            <div class="mb-4">
              <!-- heading -->
              <h4 class="mb-4">Product Gallery</h4>
              <h5 class="mb-1">Product Image</h5>
              <p>Add Product main Image.</p>
              <!-- input -->
              <input type="file" class="form-control">
            </div>
            <div>
              <!-- heading -->
              <h5 class="mb-1">Product Gallery</h5>
              <p>Add Product Gallery Images.</p>
              <!-- input -->
              <form action="#" class="d-block dropzone border-dashed rounded-2 dz-clickable">

                <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files here to upload</button></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <!-- card -->
      <div class="card mb-4">
        <!-- card body -->
        <div class="card-body">
          <!-- input -->
          <div class="form-check form-switch mb-4">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchStock" checked="">
            <label class="form-check-label" for="flexSwitchStock">In Stock</label>
          </div>
          <!-- input -->
          <div>
            <div class="mb-3">
              <label class="form-label">Product Code</label>
              <input type="text" class="form-control" placeholder="Enter Product Title">
            </div>
            <!-- input -->
            <div class="mb-3">
              <label class="form-label">Product SKU</label>
              <input type="text" class="form-control" placeholder="Enter Product Title">
            </div>
            <!-- input -->
            <div class="mb-3">
              <label class="form-label" id="productSKU">Gender</label><br>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                <label class="form-check-label" for="inlineRadio1">Male</label>
              </div>
              <!-- input -->
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                <label class="form-check-label" for="inlineRadio2">Female</label>
              </div>
              <!-- input -->
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option2">
                <label class="form-check-label" for="inlineRadio3">Kids</label>
              </div>
            </div>
            <!-- input -->
            <div class="mb-3">
              <div class="d-flex justify-content-between">
                <label class="form-label">Category</label>
                <a href="#!" class="btn-link fw-semi-bold">Add New</a>
              </div>
              <!-- select menu -->
              <select class="form-select" aria-label="Default select example">
                <option selected="">Shoe</option>
                <option value="1">Sunglasses</option>
                <option value="2">Handbag</option>
                <option value="3">Slingbag</option>
              </select>
            </div>
            <!-- tag -->
            <div class="mb-3">
              <label class="form-label">Tags
              </label>
              <tags class="tagify form-control w-100 tagify--noTags tagify--empty" tabindex="-1">
                <span contenteditable="" tabindex="0" data-placeholder="&ZeroWidthSpace;" aria-placeholder="" class="tagify__input" role="textbox" aria-autocomplete="both" aria-multiline="false"></span>
                &ZeroWidthSpace;
              </tags><input name="tags" value="" class="form-control w-100" tabindex="-1">
            </div>
          </div>
        </div>
      </div>
      <!-- card -->
      <div class="card mb-4">
        <!-- card body -->
        <div class="card-body">
          <!-- select -->
          <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-select" aria-label="Default select example">
              <option selected="">Published</option>
              <option value="1">Unpublished</option>
              <option value="2">Draft</option>
            </select>
          </div>
          <!-- date -->
          <div class="mb-3">
            <label class="form-label">Schedule</label>
            <div class="input-group me-3 flatpickr rounded flatpickr-input" readonly="readonly">
              <input class="form-control " type="text" placeholder="Select Date" aria-describedby="basic-addon2">

              <span class="input-group-text text-muted" id="basic-addon2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar icon-xs">
                  <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                  <line x1="16" y1="2" x2="16" y2="6"></line>
                  <line x1="8" y1="2" x2="8" y2="6"></line>
                  <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg></span>

            </div>
          </div>
        </div>
      </div>
      <!-- card -->
      <div class="card mb-4">
        <!-- card body -->
        <div class="card-body">
          <!-- input -->
          <div class="mb-3">
            <label class="form-label">Regular Price</label>
            <input type="text" class="form-control" placeholder="$ 49.00">
          </div>
          <!-- input -->
          <div class="mb-3">
            <label class="form-label">Sale Price</label>
            <input type="text" class="form-control" placeholder="$ 49.00">
          </div>
          <!-- input -->
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="priceIncluded" checked="">
            <label class="form-check-label" for="priceIncluded">
              Price includes taxes</label>
          </div>
        </div>
      </div>
      <!-- button -->
      <div class="d-grid">
        <a href="#!" class="btn btn-primary">
          Create Product
        </a>
      </div>
    </div>
  </div>
  </div>
  <main class="main">
    <div class="responsive-wrapper">
      <div class="main-header">
        <h1>Settings</h1>
        <div class="search">
          <input type="text" placeholder="Search" />
          <button type="submit">
            <i class="ph-magnifying-glass-bold"></i>
          </button>
        </div>
      </div>
      <div class="horizontal-tabs">
        <a href="#">My details</a>
        <a href="#">Profile</a>
        <a href="#">Password</a>
        <a href="#">Team</a>
        <a href="#">Plan</a>
        <a href="#">Billing</a>
        <a href="#">Email</a>
        <a href="#">Notifications</a>
        <a href="#" class="active">Integrations</a>
        <a href="#">API</a>
      </div>
      <div class="content-header">
        <div class="content-header-intro">
          <h2>Intergrations and connected apps</h2>
          <p>Supercharge your workflow and connect the tool you use every day.</p>
        </div>
        <div class="content-header-actions">
          <a href="#" class="button">
            <i class="ph-faders-bold"></i>
            <span>Filters</span>
          </a>
          <a href="#" class="button">
            <i class="ph-plus-bold"></i>
            <span>Request integration</span>
          </a>
        </div>
      </div>
      <div class="content">
        <div class="content-panel">
          <div class="vertical-tabs">
            <a href="#" class="active">View all</a>
            <a href="#">Developer tools</a>
            <a href="#">Communication</a>
            <a href="#">Productivity</a>
            <a href="#">Browser tools</a>
            <a href="#">Marketplace</a>
          </div>
        </div>
        <div class="content-main">
          <div class="carddashboardui-grid">
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/zeplin.svg" /></span>
                  <h3>Zeplin</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox" checked>
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Collaboration between designers and developers.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/github.svg" /></span>
                  <h3>GitHub</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox" checked>
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Link pull requests and automate workflows.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/figma.svg" /></span>
                  <h3>Figma</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox" checked>
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Embed file previews in projects.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/zapier.svg" /></span>
                  <h3>Zapier</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox">
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Build custom automations and integrations with apps.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/notion.svg" /></span>
                  <h3>Notion</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox" checked>
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Embed notion pages and notes in projects.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/slack.svg" /></span>
                  <h3>Slack</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox" checked>
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Send notifications to channels and create projects.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/zendesk.svg" /></span>
                  <h3>Zendesk</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox" checked>
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Link and automate Zendesk tickets.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/jira.svg" /></span>
                  <h3>Atlassian JIRA</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox">
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Plan, track, and release great software.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/dropbox.svg" /></span>
                  <h3>Dropbox</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox" checked>
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Everything you need for work, all in one place.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/google-chrome.svg" /></span>
                  <h3>Google Chrome</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox" checked>
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Link your Google account to share bookmarks across your entire team.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/discord.svg" /></span>
                  <h3>Discord</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox" checked>
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Keep in touch with your customers without leaving the app.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
            <article class="carddashboardui">
              <div class="carddashboardui-header">
                <div>
                  <span><img src="https://assets.codepen.io/285131/google-drive.svg" /></span>
                  <h3>Google Drive</h3>
                </div>
                <label class="toggle">
                  <input type="checkbox">
                  <span></span>
                </label>
              </div>
              <div class="carddashboardui-body">
                <p>Link your Google account to share files across your entire team.</p>
              </div>
              <div class="carddashboardui-footer">
                <a href="#">View integration</a>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
	<div>
                        <!-- row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header  border-bottom-0">
                                        <div class="row"> 
                                        <div class="col-md-8">
                                        
            <div class="flex-grow-1">
                <a class="btn btn-primary-soft mb-2 me-2" 
                    href="http://localhost/apoteklast/public/inventory/tambah/-1"
                > Add Inventory</a>
            </div>
                                        </div>
                                        <div class="col-md-4 text-right right">
                                            <IMPORTEXPORT-BUTTON></IMPORTEXPORT-BUTTON>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                    <form id="formlist_fai_framework"  method="get" enctype="multipart/form-data">
                            <div class="row"></div>
                            
                            <button type="submit"   value="excel" name="Cari" class="btn btn-info texttooltip me-2 ">Excel</button>
                            <button type="submit"  value="pdf" name="Cari" class="btn btn-info texttooltip me-2 ">PDF</button>
                        </form>
                                    <div class="row">			<div class="col-12 mt-3 mb-3" ><div class="table-responsive table-card">
<table class="table text-nowrap table-centered mt-0" id="example1" border="1" style="border-collapse: collapse;width: 100%">
	<thead  class="table-light" >
		<tr>
			<th>No</th>
			<th>Nama Gudang</th><th>Kode Gudang</th><th>Deskripsi</th><th>Total kuantitas</th><th>Total nilai</th>			<th>Action</th>
		</tr>
	</thead>
	<tbody>
								<tr>
			<td>1</td>
						
						<td>Gudang Online</td>
						
						<td>GO1</td>
						
						<td>Gudang online</td>
						
						<td>0</td>
						
						<td>0</td>
				<td>
							<div class="d-flex">
																					<a title="view" href="http://localhost/apoteklast/public/inventory/view/2" class="btn btn-success texttooltip me-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
											<path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
											<path d="M11.412 8.586c.379.38.588.882.588 1.414h2a3.977 3.977 0 0 0-1.174-2.828c-1.514-1.512-4.139-1.512-5.652 0l1.412 1.416c.76-.758 2.07-.756 2.826-.002z"></path>
										</svg>
										Detail									
									</a>
																			
									<a title="edit" href="http://localhost/apoteklast/public/inventory/edit/2" class="btn btn-info texttooltip me-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
											<path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z"></path>
										</svg>
										Edit									</a>
									

																		
									
									<a title="delete" href="http://localhost/apoteklast/public/inventory/hapus/2" onclick="return confirm('Apakah Anda Yakin?');" class="btn btn-danger texttooltip me-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
											<path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path>
										</svg>
										Delete									</a>
																								</div>
						</td>
					</tr>						<tr>
			<td>2</td>
						
						<td>INHOFTANK</td>
						
						<td>001</td>
						
						<td></td>
						
						<td>0</td>
						
						<td>0</td>
				<td>
							<div class="d-flex">
																					<a title="view" href="http://localhost/apoteklast/public/inventory/view/1" class="btn btn-success texttooltip me-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
											<path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
											<path d="M11.412 8.586c.379.38.588.882.588 1.414h2a3.977 3.977 0 0 0-1.174-2.828c-1.514-1.512-4.139-1.512-5.652 0l1.412 1.416c.76-.758 2.07-.756 2.826-.002z"></path>
										</svg>
										Detail									
									</a>
																			
									<a title="edit" href="http://localhost/apoteklast/public/inventory/edit/1" class="btn btn-info texttooltip me-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
											<path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z"></path>
										</svg>
										Edit									</a>
									

																		
									
									<a title="delete" href="http://localhost/apoteklast/public/inventory/hapus/1" onclick="return confirm('Apakah Anda Yakin?');" class="btn btn-danger texttooltip me-2"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" style="fill: rgb(255, 255, 255);transform: ;msFilter:;">
											<path d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm4 12H8v-9h2v9zm6 0h-2v-9h2v9zm.618-15L15 2H9L7.382 4H3v2h18V4z"></path>
										</svg>
										Delete									</a>
																								</div>
						</td>
					</tr>	</tbody>
</table>
</div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </main>

  </div>
  </div>
  </div>

  </div>
  </div>
  </div>
  </div>
  <div id="LoadButtombar">
    <link style="" href="http://127.0.0.1/FrameworkServer/FaiFramework/Pages/_template/soft-ui/dist/bottombar.css">
    <style>
      .appBottomMenu {
        height: 56px;
        position: fixed;
        z-index: 999;
        bottom: 0;
        left: 0;
        right: 0;
        background: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        border-top: 1px solid #DCDCE9;
        padding-left: 4px;
        padding-right: 4px;
      }

      .appBottomMenu.no-border {
        border: 0 !important;
        box-shadow: 0 !important;
      }

      .appBottomMenu .item {
        font-size: 9px;
        letter-spacing: 0;
        text-align: center;
        width: 100%;
        height: 56px;
        line-height: 1.2em;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
      }

      .appBottomMenu .item:before {
        content: '';
        display: block;
        height: 2px;
        border-radius: 0 0 10px 10px;
        background: transparent;
        position: absolute;
        left: 4px;
        right: 4px;
        top: 0;
      }

      .appBottomMenu .item .col {
        width: 100%;
        padding: 0 4px;
        text-align: center;
      }

      .appBottomMenu .item .icon,
      .appBottomMenu .item ion-icon {
        display: inline-flex;
        margin: 1px auto 3px auto;
        font-size: 24px;
        line-height: 1em;
        color: #27173E;
        transition: 0.1s all;
        display: block;
        margin-top: 1px;
        margin-bottom: 3px;
      }

      .appBottomMenu .item .action-button {
        display: inline-flex;
        width: 50px;
        height: 50px;
        margin-left: -5px;
        margin-right: -5px;
        align-items: center;
        justify-content: center;
        border-radius: 200px;
        background: #6236FF;
      }

      .appBottomMenu .item .action-button.large {
        width: 60px;
        height: 60px;
        margin-top: -20px;
        margin-left: -10px;
        margin-right: -10px;
      }

      .appBottomMenu .item .action-button .icon,
      .appBottomMenu .item .action-button ion-icon {
        color: #FFF !important;
        margin: 0 !important;
        line-height: 0 !important;
      }

      .appBottomMenu .item strong {
        margin-top: 4px;
        display: block;
        color: #27173E;
        font-weight: 400;
        transition: 0.1s all;
      }

      .appBottomMenu .item:active {
        opacity: .8;
      }

      .appBottomMenu .item.active:before {
        background: #6236FF;
      }

      .appBottomMenu .item.active .icon,
      .appBottomMenu .item.active ion-icon,
      .appBottomMenu .item.active strong {
        color: #6236FF !important;
        font-weight: 500;
      }

      .appBottomMenu .item:hover .icon,
      .appBottomMenu .item:hover ion-icon,
      .appBottomMenu .item:hover strong {
        color: #27173E;
      }

      .appBottomMenu.text-light {
        color: #FFF;
      }

      .appBottomMenu.text-light .item {
        color: #FFF;
        opacity: .7;
      }

      .appBottomMenu.text-light .item .icon,
      .appBottomMenu.text-light .item ion-icon,
      .appBottomMenu.text-light .item strong {
        color: #FFF;
      }

      .appBottomMenu.text-light .item.active {
        opacity: 1;
      }

      .appBottomMenu.text-light .item.active .icon,
      .appBottomMenu.text-light .item.active ion-icon,
      .appBottomMenu.text-light .item.active strong {
        color: #FFF !important;
      }

      .appBottomMenu.bg-primary,
      .appBottomMenu.bg-secondary,
      .appBottomMenu.bg-success,
      .appBottomMenu.bg-warning,
      .appBottomMenu.bg-danger,
      .appBottomMenu.bg-info,
      .appBottomMenu.bg-light,
      .appBottomMenu.bg-dark {
        border: 0;
      }

      .appBottomMenu.bg-primary .item:before,
      .appBottomMenu.bg-secondary .item:before,
      .appBottomMenu.bg-success .item:before,
      .appBottomMenu.bg-warning .item:before,
      .appBottomMenu.bg-danger .item:before,
      .appBottomMenu.bg-info .item:before,
      .appBottomMenu.bg-light .item:before,
      .appBottomMenu.bg-dark .item:before {
        display: none;
      }
    </style>
    <div class="appBottomMenu">

      <a href="http://localhost/FrameworkServer/FaiServer/page/K9k6rSkGw354zFl1SeTlKVedk" class="item">
        <div class="col">

          <strong>Dashboard</strong>
        </div>
      </a>

      <a href="http://localhost/FrameworkServer/FaiServer/page/1yuBRGDoK2UIuVmOn2XsxReb3" class="item">
        <div class="col">

          <strong>Organisasi</strong>
        </div>
      </a>

      <a href="http://localhost/FrameworkServer/FaiServer/page/xeVraH4QtocVqckdC4KhmDbx7" class="item">
        <div class="col">

          <strong>Kegiatan</strong>
        </div>
      </a>
    </div>
  </div>
  <!-- Scripts -->

  <!-- Libs JS -->
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/libs/feather-icons/dist/feather.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.min.js"></script>




  <!-- Theme JS -->
  <script src="../assets/js/theme.min.js"></script>


</body>
<script>
  let sidebar = document.querySelector(".sidebarWai");
  let openBtn = document.querySelector("#btnSidebarWAI");
  let closeBtn = document.querySelector(".btnClassClosSideBar");


  closeBtn.addEventListener("click", () => {
    //alert();
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });
  openBtn.addEventListener("click", () => {
    //	alert();
    sidebar.classList.toggle("open");
    menuBtnChange(); //calling the function(optional)
  });



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

var SETTINGS = {
	navBarTravelling: false,
	navBarTravelDirection: "",
	navBarTravelDistance: 150
}

document.documentElement.classList.remove("no-js");
document.documentElement.classList.add("js");

// Out advancer buttons
var pnAdvancerLeft = document.getElementById("pnAdvancerLeft");
var pnAdvancerRight = document.getElementById("pnAdvancerRight");
// the indicator
var pnIndicator = document.getElementById("pnIndicator");

var pnProductNav = document.getElementById("pnProductNav");
var pnProductNavContents = document.getElementById("pnProductNavContents");

pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));

// Set the indicator
moveIndicator(pnProductNav.querySelector("[aria-selected=\"true\"]"));

// Handle the scroll of the horizontal container
var last_known_scroll_position = 0;
var ticking = false;

function doSomething(scroll_pos) {
	pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
}

pnProductNav.addEventListener("scroll", function () {
	last_known_scroll_position = window.scrollY;
	if (!ticking) {
		window.requestAnimationFrame(function () {
			doSomething(last_known_scroll_position);
			ticking = false;
		});
	}
	ticking = true;
});


pnAdvancerLeft.addEventListener("click", function () {
	// If in the middle of a move return
	if (SETTINGS.navBarTravelling === true) {
		return;
	}
	// If we have content overflowing both sides or on the left
	if (determineOverflow(pnProductNavContents, pnProductNav) === "left" || determineOverflow(pnProductNavContents, pnProductNav) === "both") {
		// Find how far this panel has been scrolled
		var availableScrollLeft = pnProductNav.scrollLeft;
		// If the space available is less than two lots of our desired distance, just move the whole amount
		// otherwise, move by the amount in the settings
		if (availableScrollLeft < SETTINGS.navBarTravelDistance * 2) {
			pnProductNavContents.style.transform = "translateX(" + availableScrollLeft + "px)";
		} else {
			pnProductNavContents.style.transform = "translateX(" + SETTINGS.navBarTravelDistance + "px)";
		}
		// We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
		pnProductNavContents.classList.remove("pn-ProductNav_Contents-no-transition");
		// Update our settings
		SETTINGS.navBarTravelDirection = "left";
		SETTINGS.navBarTravelling = true;
	}
	// Now update the attribute in the DOM
	pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
});

pnAdvancerRight.addEventListener("click", function () {
	// If in the middle of a move return
	if (SETTINGS.navBarTravelling === true) {
		return;
	}
	// If we have content overflowing both sides or on the right
	if (determineOverflow(pnProductNavContents, pnProductNav) === "right" || determineOverflow(pnProductNavContents, pnProductNav) === "both") {
		// Get the right edge of the container and content
		var navBarRightEdge = pnProductNavContents.getBoundingClientRect().right;
		var navBarScrollerRightEdge = pnProductNav.getBoundingClientRect().right;
		// Now we know how much space we have available to scroll
		var availableScrollRight = Math.floor(navBarRightEdge - navBarScrollerRightEdge);
		// If the space available is less than two lots of our desired distance, just move the whole amount
		// otherwise, move by the amount in the settings
		if (availableScrollRight < SETTINGS.navBarTravelDistance * 2) {
			pnProductNavContents.style.transform = "translateX(-" + availableScrollRight + "px)";
		} else {
			pnProductNavContents.style.transform = "translateX(-" + SETTINGS.navBarTravelDistance + "px)";
		}
		// We do want a transition (this is set in CSS) when moving so remove the class that would prevent that
		pnProductNavContents.classList.remove("pn-ProductNav_Contents-no-transition");
		// Update our settings
		SETTINGS.navBarTravelDirection = "right";
		SETTINGS.navBarTravelling = true;
	}
	// Now update the attribute in the DOM
	pnProductNav.setAttribute("data-overflowing", determineOverflow(pnProductNavContents, pnProductNav));
});

pnProductNavContents.addEventListener(
	"transitionend",
	function () {
		// get the value of the transform, apply that to the current scroll position (so get the scroll pos first) and then remove the transform
		var styleOfTransform = window.getComputedStyle(pnProductNavContents, null);
		var tr = styleOfTransform.getPropertyValue("-webkit-transform") || styleOfTransform.getPropertyValue("transform");
		// If there is no transition we want to default to 0 and not null
		var amount = Math.abs(parseInt(tr.split(",")[4]) || 0);
		pnProductNavContents.style.transform = "none";
		pnProductNavContents.classList.add("pn-ProductNav_Contents-no-transition");
		// Now lets set the scroll position
		if (SETTINGS.navBarTravelDirection === "left") {
			pnProductNav.scrollLeft = pnProductNav.scrollLeft - amount;
		} else {
			pnProductNav.scrollLeft = pnProductNav.scrollLeft + amount;
		}
		SETTINGS.navBarTravelling = false;
	},
	false
);

// Handle setting the currently active link
pnProductNavContents.addEventListener("click", function (e) {
	var links = [].slice.call(document.querySelectorAll(".pn-ProductNav_Link"));
	links.forEach(function (item) {
		item.setAttribute("aria-selected", "false");
	})
	e.target.setAttribute("aria-selected", "true");
	moveIndicator(e.target);
});

function moveIndicator(item, color) {
	var textPosition = item.getBoundingClientRect();
	var container = pnProductNavContents.getBoundingClientRect().left;
	var distance = textPosition.left - container;
	pnIndicator.style.transform = "translateX(" + (distance + pnProductNavContents.scrollLeft) + "px) scaleX(" + textPosition.width * 0.01 + ")";
	if (color) {
		pnIndicator.style.backgroundColor = colour;
	}
}

function determineOverflow(content, container) {
	var containerMetrics = container.getBoundingClientRect();
	var containerMetricsRight = Math.floor(containerMetrics.right);
	var containerMetricsLeft = Math.floor(containerMetrics.left);
	var contentMetrics = content.getBoundingClientRect();
	var contentMetricsRight = Math.floor(contentMetrics.right);
	var contentMetricsLeft = Math.floor(contentMetrics.left);
	if (containerMetricsLeft > contentMetricsLeft && containerMetricsRight < contentMetricsRight) {
		return "both";
	} else if (contentMetricsLeft < containerMetricsLeft) {
		return "left";
	} else if (contentMetricsRight > containerMetricsRight) {
		return "right";
	} else {
		return "none";
	}
}

var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
	var options = {
		damping: '0.5'
	}
	Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
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


<!-- Mirrored from dashui.codescandy.com/dashuipro/horizontal/starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 19 Sep 2023 09:32:15 GMT -->

</html>