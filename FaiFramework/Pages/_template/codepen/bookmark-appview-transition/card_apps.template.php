<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="<?= $this->urlframework('codepen', 'bookmark-appview-transition/dist/style.css') ?>">
<link rel="stylesheet" href="./style.css">
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

  .sidebarcard .nav-link {
    display: inline-flex;
    width: 100%;
    align-items: center;
    align-items: center;
    color: #020202;
  }

  ul.nav.flex-column li.nav-item a.nav-link {
    padding-left: 10px;
  }

  ul.nav.flex-column li.nav-item div ul li.nav-item a.nav-link {
    padding-left: 25px;
  }

  ul.nav.flex-column li.nav-item div ul.nav.flex-column li.nav-item div ul.nav.flex-column li.nav-item a.nav-link {
    padding-left: 40px;
  }

  /* .has-arrow {
  height: 0;
  width: 0;
	border-left: 10px solid transparent;
	border-right: 10px solid transparent;
	border-top: 10px solid #333;
  position: relative;
  top: 45px;
  left: 350px;
} */
  .app {
    background-color: var(--theme-bg-color);
    width: 100%;
    border-radius: 20px;
    position: relative;
    margin: 0 100px;
  }

  @media screen and (max-width: 600px) {
    .app {
      margin: 0;
    }
  }

  .nav-item {
    margin-right: 0 !important;
    margin-top: 10px;
  }
</style>
<div class=" row " style="">
  <div class="col-md-3 sidebarcard" style="  margin: 20px;flex-basis: 317px;">
    <?php
    $panel = PanelFunc::panel_initial($page, 'all');
    $page['section'] = 'board';
    $board['utama'] = 'web__list_apps_board';
    $board['where'][] = array('web__list_apps_board.id', '=', $page['load']['board']);
    $board = Database::database_coverter($page, $board, array(), 'all');
    $role['utama'] = 'web__list_apps_board__role__akses';
    $role['where'][] = array('id_web__list_apps_board', '=', $page['load']['board']);
    $role['where'][] = array('id', ' in ', "(select distinct(id_role) from web__list_apps_board__role__user where id_web__list_apps_board=" . $page['load']['board'] . " and id_user=" . $_SESSION['id_apps_user'] . ")");
    $role = Database::database_coverter($page, $role, array(), 'all');
    //echo $_SESSION['id_apps_user'];
    if (!$role['num_rows']) {
      // print_r($role);
    }
    if (!isset($_SESSION['board_role-' . $page['load']['board']]) and $role['num_rows']) {

      $_SESSION['board_role-' . $page['load']['board']] = $role['row'][0]->id;
    }
    $menu = array();
    $iapps = Partial::input('id');
    if( $_SESSION['board_role-' . $page['load']['board']]){
    $query = " 
	    select * from web__list_apps_board__role__akses
	    where id=" . $_SESSION['board_role-' . $page['load']['board']];
    $db = DB::fetchResponse(DB::select($query));
    if ($db[0]->semua_menu == 1) {
      $query = "select * from web__list_apps_board__menu 
	            join web__list_apps_menu on id_apps_menu = web__list_apps_menu.id
	            where id_web__list_apps_board=" . $page['load']['board'] . "
	            and web__list_apps_board__menu.active=1
	            and web__list_apps_menu.active=1
	            and load_apps = '" . $page['load']['apps'] . "'
	        ";
      $menu =  Partial::get_menu($page, $query, 'id_apps_menu', 'get_array');
    } else {
      $query = "
	        select *,web__list_apps_board__role__akses__menu.id_menu as id_apps_menu
	            from web__list_apps_board__role__akses__menu 
	            join web__list_apps_menu on web__list_apps_board__role__akses__menu.id_menu = web__list_apps_menu.id 
	            where 
	                id_web__list_apps_board__role__akses=" . $_SESSION['board_role-' . $page['load']['board']] . " 
	                and web__list_apps_menu.active=1 
	                and web__list_apps_board__role__akses__menu.active=1 
	                and web__list_apps_menu.active=1 
	                and akses_menu='1'
	            and load_apps = '" . $page['load']['apps'] . "'
	        
	        ";
      $menu = Partial::get_menu($page, $query, 'id_apps_menu', 'get_array');
    }
    }

    if (!count($menu)) {

      $Apps = $page['load']['apps'];
      $function = "menu_";
      $menu = $Apps::menu_basic();
    } else {
      // echo '<pre>';
      //  print_r($menu); die;
    }

    // $menu['utama'] = 'web__list_apps_paket__list__detail';
    // $menu['where'][] = array('web__list_apps_board.id', '=', $page['load']['board']);
    // $menu = Database::database_coverter($page, $board, array(), 'all'); 
    $page['section'] = 'board';
    $board_apps['select'][] = '*';
    $board_apps['select'][] = 'web__list_apps_board__apps.id_apps';
    $board_apps['utama'] = 'web__list_apps_board__apps';
    $board_apps['join'][] = array('web__list_apps', 'web__list_apps.id', "web__list_apps_board__apps.id_apps");
    $board_apps['join'][] = array('web__menu', 'web__menu.id', "web__list_apps.id_first_menu");
    $board_apps['where'][] = array('web__list_apps_board__apps.id_web__list_apps_board', '=', $page['load']['board']);
    $board_apps['where'][] = array('web__list_apps_board__apps.id_apps', ' in ', "(select distinct(id_apps) from web__list_apps_board__menu 
                                join web__list_apps_menu on id_apps_menu = web__list_apps_menu.id 
                                where id_web__list_apps_board = " . $page['load']['board'] . "
                                )");
    $board_apps['order'][] = array("web__list_apps.urutan_workspace", "asc");
    $board_apps['order'][] = array("web__list_apps_board__apps.urutan", "asc");
    // $board_apps['group'][] = ("web__list_apps_board__apps.id_apps  ");
    $board_apps = Database::database_coverter($page, $board_apps, array(), 'all');


    ?>
    <div class="">
      <!--left-sidebar p-0 navbar-vertical navbar nav-dashboard  style="position: fixed;left: 78px;width: ;top: 115px;overflow-y: scroll;height: 100%;z-index:99;background:white"-->
      <div class="profileBox pt-2 pb-2">
        <div class="image-wrapper">
          <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2360&q=80" alt="image" class="user-photo imaged  w36">
        </div>
        <div class="in">
          <div class="user-name" style="font-size:10px"><?= $panel['get_panel_detail']->nama_lengkap; ?></div>
          <strong><?= $panel['get_panel_detail']->nama_detail_panel; ?></strong>
          <div class="text-muted" style="font-size:9px">Panel <?= $panel['get_panel_detail']->be3_id; ?></div>
          <div class="text-muted">Be3 ID: <?= $panel['get_panel_detail']->be3_id; ?></div>
        </div>

      </div>

      <div style="display: block;">
        <label>Panel</label>
        <select class="form-control" id="panel-<?= $page['load']['board'] ?>" onchange="direct_panel(this,<?= $page['load']['board'] ?>)">
          <?php

          if (count($page['get_panel']['panel_list'])) {
            foreach ($page['get_panel']['panel_list'] as $i => $panel_list) {
              echo '<option value="' . $panel_list['id_panel'] . '" ' . ($_SESSION['board_role-' . $page['load']['board']] == $panel_list['id_panel'] ? 'selected' : '') . '>' . $panel_list['nama_panel'] . '</option>';
            }
          }
          $page['route_type'] = "just_link";
          ?>
        </select>

      </div>
      <div style="display: block;">
        <label>Role</label>
        <select class="form-control" id="role-<?= $page['load']['board'] ?>" onchange="direct_role(this,<?= $page['load']['board'] ?>)">
          <?php
          if ($role['num_rows']) {
            foreach ($role['row'] as $role) {
              echo '<option value="' . $role->id . '" ' . ($_SESSION['board_role-' . $page['load']['board']] == $role->id ? 'selected' : '') . '>' . $role->nama_role . '</option>';
            }
          }
          $page['route_type'] = "just_link";
          ?>
        </select>
      </div>
      <ul class="navbar-nav flex-column" id="sideNavbar" style="max-height: 600px;">

        <?php
        $page['route_type'] = "";
        $configuration['prefix']['grup'] = ' <div class="listview-title mt-1"><ul class="navbar-nav flex-column" id="sideNavbar">
       
        ';
        $configuration['sufix']['grup'] = ' <content-grup></content-grup>
        </ul></div>
        ';

        $configuration['prefix']['menu'] = '<li class="nav-item">
            <a class="nav-link has-arrow  collapsed " |LINK| >
                  <div class="icon-box bg-primary">
                        <ICON></ICON>
                       </div>
                      ';
        $configuration['sufix']['menu'] = '
            
            </a>
            </li>';
        $configuration['prefix']['dropdown'][0] = '<li class="nav-item">
        <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevel|NAVSUB|" aria-expanded="true" aria-controls="navMenuLevel|NAVSUB|">
           
                  <div class="icon-box bg-primary">
                         <ICON></ICON>
                    </div>  
                      ';
        $configuration['sufix']['dropdown'][0] = '
            
            </a>
            <div id="navMenuLevel|NAVSUB|" class="collapsed "
          data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <SUB></SUB>
              </ul>
              </div>
            </li>
            ';
        $configuration['prefix']['dropdown'][1] = '<li class="nav-item">
        <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevel|NAVSUB|" aria-expanded="true" aria-controls="navMenuLevel|NAVSUB|">
           
                  <div class="icon-box bg-primary">
                         <ICON></ICON>
                    </div>  
                      ';
        $configuration['sufix']['dropdown'][1] = '
            
            </a>
            <div id="navMenuLevel|NAVSUB|" class="collapsed "
          data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <SUB></SUB>
              </ul>
              </div>
            </li>
            ';
        $configuration['prefix']['dropdown'][2] = '<li class="nav-item">
        <a class="nav-link has-arrow" href="#!" data-bs-toggle="collapse" data-bs-target="#navMenuLevel|NAVSUB|" aria-expanded="true" aria-controls="navMenuLevel|NAVSUB|">
           
                  <div class="icon-box bg-primary">
                         <ICON></ICON>
                    </div>  
                      ';
        $configuration['sufix']['dropdown'][2] = '
            
            </a>
            <div id="navMenuLevel|NAVSUB|" class="collapsed "
          data-bs-parent="#sideNavbar">
              <ul class="nav flex-column">
                <SUB></SUB>
              </ul>
              </div>
            </li>
            ';


        // echo '<pre>';print_r($menu);


        echo Partial::navbar_menu($page, $menu, $configuration);
        ?>

        <!-- * send money -->

        .<li style="padding-bottom:100px"></li>
    </div>

  </div>

  <div class="col-md-8 maincard">
    <div class="maincard-header">
      <div style="display:block">
        <div class="maincard-header__title"><?= $board['row'][0]->nama_board; ?></div>
        <div class="maincard-header__subtitle">Be3 ID:<?= $board['row'][0]->be3_id; ?></div>

        <div class="maincard-header__avatars ">
          <img class="maincard-header__avatar" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80" alt="avatar">
          <img class="maincard-header__avatar" src="https://images.unsplash.com/photo-1683392969197-17547ac3e06e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1587&q=80" alt="avatar">
          <img class="maincard-header__avatar" src="https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1760&q=80" alt="avatar">
          <button class="add-button"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg></button>
        </div>
      </div>
      <button class="maincard-header__add">
        <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
        </svg>
      </button>

    </div>
    <div class="horizontal-tabs">

      <a <?php echo $page['load']['apps'] == 'Workspace' ? 'class="active"' : ''; ?> <?= Partial::link_direct($page, $page['load']['link_route'], array("Workspace", "admin", 'list', -1, -1, -1, $page['load']['board'])) ?>>Workspace</a>
      <?php
      $page_temp = $page;
      $page_temp['route_page'] = "just_link";
      $board_apps['num_rows'];
      if ($board_apps['num_rows']) {
        $list_apps = array();
        foreach ($board_apps['row'] as $apps) {
          if (!in_array($apps->id_apps, $list_apps)) {
      ?>
            <a <?= $page['id_list_apps'] == $apps->id_apps ? 'class="active"' : ''; ?> <?= Partial::link_direct($page, $page['load']['link_route'], array($apps->load_apps, "Dashboard_workspace", 'view_layout', -1, -1, -1, $page['load']['board'])) ?>><?= $apps->nama_apps; ?></a>
        <?php
            $list_apps[] = $apps->id_apps;
          }
        } ?>
      <?php } ?>


    </div>
    <div class="mt-5">