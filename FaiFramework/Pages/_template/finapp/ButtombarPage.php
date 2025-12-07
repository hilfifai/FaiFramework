<link style="" href="<?= $this->urlframework($page['template'], 'dist/bottombar.css') ?>">
<style>
  .appBottomMenu {
    height: 40px;
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
<?php
$session_name = $page['load']['footer_menu']['session_name'];

if (isset($_SESSION[$session_name])) {
  if (isset($page['load']['footer_menu']['akses_menu'][$_SESSION[$session_name]])) { ?>
    <div class="appBottomMenu">
      <?php

      $menu = $page['load']['footer_menu']['akses_menu'][$_SESSION[$session_name]];
      //  print_r($menu);
      for ($i = 0; $i < count($menu); $i++) {



        if ($menu[$i][0] == 'group') {
        } else if ($menu[$i][0] == 'menu') {
          $onclick = "";
          if ($page['load']['link'] == 'js') {
            $onclick .= 'onclick="';
            if (isset($menu[$i][4])) {
              $onclick .= 'changeMenu(' . "'" . $menu[$i][4][0] . "'" . ',' . "'" . $menu[$i][4][1] . "'" . ',' . "'" . $menu[$i][4][2] . "'" . ');';
            }
            $onclick .= 'reach_page_first(' . "'" . $menu[$i][2][0] . "'" . ',' . "'" . $menu[$i][2][1] . "'" . ',' . "'" . $menu[$i][2][2] . "'" . ',' . "'" . $menu[$i][2][3] . "'" . ');';
            $onclick .= '"';
          } else {
            $onclick .= '' . Partial::link_direct($page, $page['load']['link_route'], [$menu[$i][2][0], $menu[$i][2][1], $menu[$i][2][2], $menu[$i][2][3]]) . '';
          }
          echo '
          				<a ' . $onclick . ' class="item">
            <div class="col">
                ' . $menu[$i][3] . '
                <strong>' . $menu[$i][1] . '</strong>
            </div>
        </a>
          				';
        }
      } ?>
    </div>
<?php  }
} ?>