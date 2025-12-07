<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme" data-bg-class="bg-menu-theme" style="overflow-y:scroll;max-height:80%">
  <div class="app-brand demo">
    <a href="index.html" class="app-brand-link">
      <span class="app-brand-logo demo">
        <BRAND-LOGO></BRAND-LOGO>
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">
        <BRAND-LOGOTEXT></BRAND-LOGOTEXT>
      </span>

    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1 pb-5  ps--active-y" style="overflow-y: scroll;max-height: 100vh;">
    <?php
    /*	 
          		}*/
    $configuration['prefix']['grup'] = '<li class="menu-header small text-uppercase">
		                  <span class="menu-header-text">';
    $configuration['sufix']['grup'] = '</span>
		                </li>';

    $configuration['prefix']['menu'] = '<li class="menu-item">
                <a href="javascript:void(0)" |LINK| class="menu-link">';
    $configuration['sufix']['menu'] = '
                </a>
              </li>';

    echo  Partial::navbar_menu($page, $page['load']['sidebar'], $configuration);
    ?>




    <!-- User interface -->

    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
      <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps__rail-y" style="top: 0px; height: 390px; right: 4px;">
      <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 68px;"></div>
    </div>
  </ul>
</aside>