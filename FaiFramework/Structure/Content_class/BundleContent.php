<?php

class BundleContent
{
    public static function router($page, $type, $array_website, $code = '')
    {
        $array = array();
        $array[] = 'BE3-EC-D1';
        $array[] = 'BE3-EC-D2';
        $array[] = 'BE3-EC-D3';
        $array[] = 'BE3-W-VB1';
        $array[] = 'BE3-W-VB2';
        $array[] = 'BE3-E-BOX';
        $array[] = 'BE3-LIST-PANEL-WORKSPACE';
        $array[] = 'BE3-LIST-ROLE-WORKSPACE';
        $array[] = 'BE3-LOGO';
        $array[] = 'BE3-NAMAWEBAPPS';
        $array[] = 'BE3-ASHION-HOME-PRODUK_GROUP_KLASIFIKASI';
        $array[] = 'BE3-ASHION-CONTACT_US';
        $array[] = 'BE3-ASHION-HOME-DISKON';
        $array[] = 'BE3-ASHION-HOME-PROFILE-TOKO';
        $array[] = 'BE3-LINK-LOGIN';
        $array[] = 'BE3-LINK-REGISTER';
        $array[] = 'BE3-LINK-CART';

        if ($type == 'content') {

            if ($code == 'BE3-LOGO') {
                return Bundlecontent::logo($page, $array_website);
            } else if ($code == 'BE3-LINK-CART') {
                // return Bundlecontent::link_cart($page, $array_website);
            } else if ($code == 'BE3-LINK-LOGIN') {
                return Bundlecontent::login($page, $array_website);
            } else if ($code == 'BE3-LINK-REGISTER') {
                return Bundlecontent::daftar($page, $array_website);
            } else if ($code == 'BE3-BASE-URL') {
                return Bundlecontent::base_url($page, $array_website);
            } else if ($code == 'BE3-LIST-PANEL-WORKSPACE') {
                return Bundlecontent::list_panel_workspace($page, $array_website);
            } else if ($code == 'BE3-LIST-ROLE-WORKSPACE') {
                return Bundlecontent::list_role_workspace($page, $array_website);
            } else if ($code == 'BE3-E-BOX') {
                return Bundlecontent::ecommerce_dasboard_box($page, $array_website);
            } else if ($code == 'BE3-EC-D1') {
                return Bundlecontent::ecommerce_dasboard_bundles_1($page, $array_website);
            } else if ($code == 'BE3-EC-D2') {
                return Bundlecontent::ecommerce_dasboard_bundles_2($page, $array_website);
            } else if ($code == 'BE3-EC-D3') {
                return Bundlecontent::ecommerce_dasboard_bundles_3($page, $array_website);
            } else if ($code == 'BE3-W-VB2') {
                return Bundlecontent::visitor_bundles_2($page, $array_website);
            } else if ($code == 'BE3-W-VB1') {
                return Bundlecontent::visitor_bundles_1($page, $array_website);
            } else if ($code == 'BE3-ASHION-HOME-PRODUK_GROUP_KLASIFIKASI') {
                return Bundlecontent::ashion_home_produk_group_klasifikasi($page, $array_website);
            } else if ($code == 'BE3-ASHION-HOME-DISKON') {
                return "";
                //Bundlecontent::ashion_home_diskon($page, $array_website);
            } else if ($code == 'BE3-ASHION-CONTACT_US') {
                return Bundlecontent::ashion_contact_us($page, $array_website);
            } else if ($code == 'BE3-ASHION-HOME-PROFILE-TOKO') {
                return Bundlecontent::ashion_home_profil($page, $array_website);
            }
        } else
        if ($type == 'array') {
            return $array;
        }
    }
    public static function content_admin_ecommerce($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/content_admin_ecommerce/";
        $return["html"] =  file_get_contents($base . "content_admin_ecommerce.html.php");
        return $return;
    }
    public static function ecommerce_dasboard_bundles_1($page)
    {
         $base = __DIR__ . "/../../Pages/bundle/";
        //code BE3-EC-D1
        $return["css"] = file_get_contents( $base . "/ecommerce_dasboard_bundles_1/ecommerce_dasboard_bundles_1.css.php");
        $return["js"] = file_get_contents( $base . "/ecommerce_dasboard_bundles_1/ecommerce_dasboard_bundles_1.js.php");
        $return["html"] = file_get_contents( $base . "/ecommerce_dasboard_bundles_1/ecommerce_dasboard_bundles_1.html.php");
        return $return;

        return '';
    }
    public static function ecommerce_dasboard_box($page)
    {
         $base = __DIR__ . "/../../Pages/bundle/";

        $return["html"] = file_get_contents( $base . "/ecommerce_dasboard_box/ecommerce_dasboard_box.html.php");
        return $return;
        
    }
    // public static function ecommerce_dasboard_bundles_2()
    // {

    //     //code BE3-EC-D2
    //     return '<div class="row">
    //             <div class="col-lg-6 col-md-3 col-6 mb-4">
    //     <div class="card">
    //       <div class="card-body">
    //         <div class="card-title d-flex align-items-start justify-content-between">
    //           <div class="avatar flex-shrink-0">
    //             <img src="../../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
    //           </div>
    //           <div class="dropdown">
    //             <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //               <i class="bx bx-dots-vertical-rounded"></i>
    //             </button>
    //             <div class="dropdown-menu" aria-labelledby="cardOpt6">
    //               <a class="dropdown-item" href="javascript:void(0);">View More</a>
    //               <a class="dropdown-item" href="javascript:void(0);">Delete</a>
    //             </div>
    //           </div>
    //         </div>
    //         <span class="d-block">Sales</span>
    //         <h4 class="card-title mb-1">$4,679</h4>
    //         <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
    //       </div>
    //     </div>
    //   </div>
    //   <div class="col-lg-6 col-md-3 col-6 mb-4">
    //     <div class="card">
    //       <div class="card-body pb-2">
    //         <span class="d-block fw-medium">Profit</span>
    //         <h3 class="card-title mb-0">624k</h3>
    //         <div id="profitChart"></div>
    //       </div>
    //     </div>
    //   </div>
    //   <div class="col-lg-6 col-md-3 col-6 mb-4">
    //     <div class="card">
    //       <div class="card-body pb-0">
    //         <span class="d-block fw-medium">Expenses</span>
    //       </div>
    //       <div id="expensesChart" class="mb-2"></div>
    //       <div class="p-3 pt-2">
    //         <small class="text-muted d-block text-center">$21k Expenses more than last month</small>
    //       </div>
    //     </div>
    //   </div>
    //   <div class="col-lg-6 col-md-3 col-6 mb-4">
    //     <div class="card">
    //       <div class="card-body">
    //         <div class="card-title d-flex align-items-start justify-content-between">
    //           <div class="avatar flex-shrink-0">
    //             <img src="../../assets/img/icons/unicons/briefcase.png" alt="Credit Card" class="rounded">
    //           </div>
    //           <div class="dropdown">
    //             <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    //               <i class="bx bx-dots-vertical-rounded"></i>
    //             </button>
    //             <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt1">
    //               <a class="dropdown-item" href="javascript:void(0);">View More</a>
    //               <a class="dropdown-item" href="javascript:void(0);">Delete</a>
    //             </div>
    //           </div>
    //         </div>
    //         <span class="d-block">Transactions</span>
    //         <h4 class="card-title mb-1">$14,857</h4>
    //         <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
    //       </div>
    //     </div>
    //   </div>
    // </div>';
    // }
    public static function ecommerce_dasboard_bundles_2_2()
    {

        //code BE3-EC-D2
        // return '
        // <div class="col-lg-6 col-md-12 col-6 mb-4">
        //               <div class="card">
        //                 <div class="card-body">
        //                   <div class="card-title d-flex align-items-start justify-content-between">
        //                     <div class="avatar flex-shrink-0">
        //                       <img
        //                         src="../assets/img/icons/unicons/chart-success.png"
        //                         alt="chart success"
        //                         class="rounded"
        //                       />
        //                     </div>
        //                     <div class="dropdown">
        //                       <button
        //                         class="btn p-0"
        //                         type="button"
        //                         id="cardOpt3"
        //                         data-bs-toggle="dropdown"
        //                         aria-haspopup="true"
        //                         aria-expanded="false"
        //                       >
        //                         <i class="bx bx-dots-vertical-rounded"></i>
        //                       </button>
        //                       <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
        //                         <a class="dropdown-item" href="javascript:void(0);">View More</a>
        //                         <a class="dropdown-item" href="javascript:void(0);">Delete</a>
        //                       </div>
        //                     </div>
        //                   </div>
        //                   <span class="fw-semibold d-block mb-1">Profit</span>
        //                   <h3 class="card-title mb-2">$12,628</h3>
        //                   <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
        //                 </div>
        //               </div>
        //             </div>
        //             <div class="col-lg-6 col-md-12 col-6 mb-4">
        //               <div class="card">
        //                 <div class="card-body">
        //                   <div class="card-title d-flex align-items-start justify-content-between">
        //                     <div class="avatar flex-shrink-0">
        //                       <img
        //                         src="../assets/img/icons/unicons/wallet-info.png"
        //                         alt="Credit Card"
        //                         class="rounded"
        //                       />
        //                     </div>
        //                     <div class="dropdown">
        //                       <button
        //                         class="btn p-0"
        //                         type="button"
        //                         id="cardOpt6"
        //                         data-bs-toggle="dropdown"
        //                         aria-haspopup="true"
        //                         aria-expanded="false"
        //                       >
        //                         <i class="bx bx-dots-vertical-rounded"></i>
        //                       </button>
        //                       <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
        //                         <a class="dropdown-item" href="javascript:void(0);">View More</a>
        //                         <a class="dropdown-item" href="javascript:void(0);">Delete</a>
        //                       </div>
        //                     </div>
        //                   </div>
        //                   <span>Sales</span>
        //                   <h3 class="card-title text-nowrap mb-1">$4,679</h3>
        //                   <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
        //                 </div>
        //               </div>
        //             </div>
        //             <div class="col-6 mb-4">
        //               <div class="card">
        //                 <div class="card-body">
        //                   <div class="card-title d-flex align-items-start justify-content-between">
        //                     <div class="avatar flex-shrink-0">
        //                       <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
        //                     </div>
        //                     <div class="dropdown">
        //                       <button
        //                         class="btn p-0"
        //                         type="button"
        //                         id="cardOpt4"
        //                         data-bs-toggle="dropdown"
        //                         aria-haspopup="true"
        //                         aria-expanded="false"
        //                       >
        //                         <i class="bx bx-dots-vertical-rounded"></i>
        //                       </button>
        //                       <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
        //                         <a class="dropdown-item" href="javascript:void(0);">View More</a>
        //                         <a class="dropdown-item" href="javascript:void(0);">Delete</a>
        //                       </div>
        //                     </div>
        //                   </div>
        //                   <span class="d-block mb-1">Payments</span>
        //                   <h3 class="card-title text-nowrap mb-2">$2,456</h3>
        //                   <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
        //                 </div>
        //               </div>
        //             </div>
        //             <div class="col-6 mb-4">
        //               <div class="card">
        //                 <div class="card-body">
        //                   <div class="card-title d-flex align-items-start justify-content-between">
        //                     <div class="avatar flex-shrink-0">
        //                       <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
        //                     </div>
        //                     <div class="dropdown">
        //                       <button
        //                         class="btn p-0"
        //                         type="button"
        //                         id="cardOpt1"
        //                         data-bs-toggle="dropdown"
        //                         aria-haspopup="true"
        //                         aria-expanded="false"
        //                       >
        //                         <i class="bx bx-dots-vertical-rounded"></i>
        //                       </button>
        //                       <div class="dropdown-menu" aria-labelledby="cardOpt1">
        //                         <a class="dropdown-item" href="javascript:void(0);">View More</a>
        //                         <a class="dropdown-item" href="javascript:void(0);">Delete</a>
        //                       </div>
        //                     </div>
        //                   </div>
        //                   <span class="fw-semibold d-block mb-1">Transactions</span>
        //                   <h3 class="card-title mb-2">$14,857</h3>
        //                   <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
        //                 </div>
        //               </div>
        //             </div>
        //             </div>
                   
                
        //         ';
    }
    public static function ecommerce_dasboard_bundles_3($page)
    {
         $base = __DIR__ . "/../../Pages/bundle/";
        $return["html"] = file_get_contents($base."/ecommerce_dasboard_bundles_3/ecommerce_dasboard_bundles_3.html.php");
        return $return;
    }
    public static function visitor_bundles_2()
    {
        // return '
        //             <div class="col-12 mb-4">
        //               <div class="card">
        //                 <div class="card-body">
        //                   <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
        //                     <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
        //                       <div class="card-title">
        //                         <h5 class="text-nowrap mb-2">Profile Report</h5>
        //                         <span class="badge bg-label-warning rounded-pill">Year 2021</span>
        //                       </div>
        //                       <div class="mt-sm-auto">
        //                         <small class="text-success text-nowrap fw-semibold"
        //                           ><i class="bx bx-chevron-up"></i> 68.2%</small
        //                         >
        //                         <h3 class="mb-0">$84,686k</h3>
        //                       </div>
        //                     </div>
        //                     <div id="profileReportChart"></div>
        //                   </div>
        //                 </div>
        //               </div>
        //             </div>
        //           </div>';
    }
    public static function visitor_bundles_1()
    {

        //code BE3-W-VB1
//         return '
//     <div class="card">
//       <div class="card-body row g-4">
//         <div class="col-md-6 pe-md-4 card-separator">
//           <div class="card-title d-flex align-items-start justify-content-between">
//             <h5 class="mb-0">New Visitors</h5>
//             <small>Last Week</small>
//           </div>
//           <div class="d-flex justify-content-between">
//             <div class="mt-auto">
//               <h2 class="mb-2">23%</h2>
//               <small class="text-danger text-nowrap fw-medium"><i class="bx bx-down-arrow-alt"></i> -13.24%</small>
//             </div>
//             <div id="visitorsChart"></div>
//           </div>
//         </div>
//         <div class="col-md-6 ps-md-4">
//           <div class="card-title d-flex align-items-start justify-content-between">
//             <h5 class="mb-0">Activity</h5>
//             <small>Last Week</small>
//           </div>
//           <div class="d-flex justify-content-between">
//             <div class="mt-auto">
//               <h2 class="mb-2">82%</h2>
//               <small class="text-success text-nowrap fw-medium"><i class="bx bx-up-arrow-alt"></i> 24.8%</small>
//             </div>
//             <div id="activityChart"></div>
//           </div>
//         </div>
//       </div>
//     </div>
//   ';
    }
    public static function ecommerce_dasboard_bundles_2()
    {
        $return["css"] = file_get_contents(__DIR__ . "/ecommerce_dasboard_bundles_2/ecommerce_dasboard_bundles_2.css.php");
        $return["js"] = file_get_contents(__DIR__ . "/ecommerce_dasboard_bundles_2/ecommerce_dasboard_bundles_2.js.php");
        $return["html"] = file_get_contents(__DIR__ . "/ecommerce_dasboard_bundles_2/ecommerce_dasboard_bundles_2.html.php");
        return $return;
    }
    public static function  name_webapps($page)
    {
        $sql = DB::fetchResponse(DB::select("select * from web__apps where id=" . $page['load']['id_web__apps'] . " "));
        return $sql[0]->nama_domain;
    }
    public static function link($page, $array, $route_page)
    {

        $page['route_type'] = $route_page;

        return $link = Partial::link_direct($page, $page['load']['link_route'], $array);
    }
    public static function login($page)
    {
        if (
            isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
        ) {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        return $protocol . $page['load']['domain'] . '/login';
    }
    public static function daftar($page)
    {
        if (
            isset($_SERVER['HTTPS']) &&
            ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
            isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
            $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'
        ) {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }
        return $protocol . $page['load']['domain'] . '/daftar';
    }
    public static function logo($page)
    {
        $return = '<BE3-LOGO></BE3-LOGO>';
        if (!isset($page['load']['id_web__apps'])) {
            $fai = new MainFaiFramework();
            $page_temp = $fai->LoadApps($page, $_SERVER['HTTP_HOST'], -1, 'utama');
            if (isset($page_temp['utama']['row'][0]))
                $page['load']['id_web__apps'] = $page_temp['utama']['row'][0]->primary_key;
        }
        if (isset($page['load']['id_web__apps'])) {

            $sql = DB::fetchResponse(DB::select("select * from drive__file where ref_database='web__apps' and ref_external_id=" . $page['load']['id_web__apps'] . " and CAST(sizes AS SIGNED)>0 order by create_date desc, sizes desc"));
            if (($sql))
                $return = ($sql[0]->domain ? $sql[0]->domain : base_url()) . '/uploads/' . $sql[0]->path . '/' . $sql[0]->file_name_save;
            return $return;
        } else {
            return $return;
        }
    }
    public static function base_url($page)
    {
        return base_url();
    }
    public static function list_panel_workspace($page)
    {

        $return_menu = ' <div style="display: block;padding:5px 20px">
				<label class="text-bold bold"><strong>Panel</strong></label>
				<select class="form-control" id="panel-' . $page['load']['board'] . '" onchange="direct_panel(this,' . $page['load']['board'] . ')">
          	';
        if (count($page['get_panel']['panel_list'])) {
            foreach ($page['get_panel']['panel_list'] as $i => $panel_list) {
                $return_menu .= '<option value="' . $panel_list['id_panel'] . '" ' . ((isset($_SESSION['board_role-' . $page['load']['board']]) ? $_SESSION['board_role-' . $page['load']['board']] : -2) == $panel_list['id_panel'] ? 'selected' : '') . '>' . $panel_list['nama_panel'] . '</option>';
            }
        }
        $return_menu .= '
				</select>

			</div>';

        return $return_menu;
    }
    public static function list_role_workspace($page)
    {
        $role['utama'] = 'web__list_apps_board__role__akses';
        $role['where'][] = array('id_web__list_apps_board', '=', $page['load']['board']);
        $role['where'][] = array('id', ' in ', "(select distinct(id_role) from web__list_apps_board__role__user where id_web__list_apps_board=" . $page['load']['board'] . " and id_user=" . $_SESSION['id_apps_user'] . ")");
        $role = Database::database_coverter($page, $role, array(), 'all');

        $return_menu = ' <div style="display: block;padding:5px 20px">
				<label><strong>Role</strong></label>
        		<select class="form-control" id="role-' . $page['load']['board'] . '" onchange="direct_role(this,' . $page['load']['board'] . ')">
        	';
        if ($role['num_rows']) {

            foreach ($role['row'] as $role) {
                $return_menu .= '<option value="' . $role->id . '" ' . ($_SESSION['board_role-' . $page['load']['board']] == $role->id ? 'selected' : '') . '>' . $role->nama_role . '</option>';
            }
        }

        $return_menu .= '
				</select>

			</div>';
        return $return_menu;
    }
    public static function duplicate($page)
    {
        $return['css'] = '';
        $return['js'] = '';
        $return['html'] = '';
        return $return;
    }


    public static function fai_first_template($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/fai_first_template/";
        $return["css"] = file_get_contents($base . "fai_first_template.css.php");
        $return["js"] =  file_get_contents($base . "fai_first_template.js.php");
        $return["html"] =  file_get_contents($base . "fai_first_template.html.php");
        return $return;
    }
    public static function main_all($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/main_all/";
        $return["css"] = file_get_contents($base . "main_all.css.php");
        $return["js"] =  file_get_contents($base . "main_all.js.php");
        $return["html"] =  file_get_contents($base . "main_all.html.php");
        return $return;
    }

    public static function login_page_1($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/login_page_1/";
        //   $return["css"] = file_get_contents($base . "login_page_1.css.php") ;
        $return["js"] =  file_get_contents($base . "login_page_1.js.php");
        $return["html"] =  file_get_contents($base . "login_page_1.html.php");
        return $return;
    }

    public static function hibe3_base($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_base/";
        $return["css"] = file_get_contents($base . "hibe3_base.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_base.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_base.html.php");
        return $return;
    }

    public static function hibe3_card_main_listing($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card_main_listing/";
        $return["css"] = file_get_contents($base . "hibe3_card_main_listing.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card_main_listing.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card_main_listing.html.php");
        return $return;
    }
    public static function hibe3_payment_page($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_payment_page/";
        $return["css"] = file_get_contents($base . "hibe3_payment_page.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_payment_page.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_payment_page.html.php");
        return $return;
    }
    public static function hibe3_payment_page_pembayaran($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_payment_page_pembayaran/";
        $return["html"] =  file_get_contents($base . "hibe3_payment_page_pembayaran.html.php");
        return $return;
    }
    public static function hibe3_payment_page_pembayaran_brand($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_payment_page_pembayaran_brand/";
        $return["html"] =  file_get_contents($base . "hibe3_payment_page_pembayaran_brand.html.php");
        return $return;
    }
    public static function hibe3_bayar_page($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_bayar_page/";
        // $return["css"] =  file_get_contents($base . "hibe3_bayar_page.css.php");
        // $return["js"] =  file_get_contents($base . "hibe3_bayar_page.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_bayar_page.html.php");
        return $return;
    }
    public static function hibe3_list_bayar_page($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_list_bayar_page/";
        $return["css"] =  file_get_contents($base . "hibe3_list_bayar_page.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_list_bayar_page.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_list_bayar_page.html.php");
        return $return;
    }
    public static function hibe3_landing_mitra($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_landing_mitra/";
        $return["css"] =  file_get_contents($base . "hibe3_landing_mitra.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_landing_mitra.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_landing_mitra.html.php");
        return $return;
    }
    public static function hibe3_kontak_kami($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_kontak_kami/";
        $return["css"] =  file_get_contents($base . "hibe3_kontak_kami.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_kontak_kami.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_kontak_kami.html.php");
        return $return;
    }
    public static function hibe3_profil($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_profil/";
        $return["css"] =  file_get_contents($base . "hibe3_profil.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_profil.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_profil.html.php");
        return $return;
    }
    public static function hibe3_profil_bangunan($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_profil_bangunan/";
        //$return["js"] =  file_get_contents($base . "hibe3_profil_bangunan.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_profil_bangunan.html.php");
        return $return;
    }
    public static function hibe3_pesanan_saya($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_pesanan_saya/";
        $return["css"] =  file_get_contents($base . "hibe3_pesanan_saya.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_pesanan_saya.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_pesanan_saya.html.php");
        return $return;
    }
    public static function hibe3_pesanan_saya_list($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_pesanan_saya_list/";
        $return["css"] =  file_get_contents($base . "hibe3_pesanan_saya_list.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_pesanan_saya_list.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_pesanan_saya_list.html.php");
        return $return;
    }
    public static function hibe3_pesanan_saya_list_produk($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_pesanan_saya_list_produk/";
        // $return["css"] =  file_get_contents($base . "hibe3_pesanan_saya_list_produk.css.php");
        // $return["js"] =  file_get_contents($base . "hibe3_pesanan_saya_list_produk.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_pesanan_saya_list_produk.html.php");
        return $return;
    }
    public static function hibe3_pesanan_saya_detail_produk($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_pesanan_saya_detail_produk/";
        // $return["css"] =  file_get_contents($base . "hibe3_pesanan_saya_list_produk.css.php");
        // $return["js"] =  file_get_contents($base . "hibe3_pesanan_saya_list_produk.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_pesanan_saya_detail_produk.html.php");
        return $return;
    }
    public static function hibe3_pesanan_saya_detail($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_pesanan_saya_detail/";
        $return["css"] =  file_get_contents($base . "hibe3_pesanan_saya_detail.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_pesanan_saya_detail.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_pesanan_saya_detail.html.php");
        return $return;
    }
    public static function hibe3_mitra_berhasil($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_mitra_berhasil/";
        $return["css"] =  file_get_contents($base . "hibe3_mitra_berhasil.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_mitra_berhasil.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_mitra_berhasil.html.php");
        return $return;
    }
    public static function hibe3_sukses_bayar_page($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_sukses_bayar_page/";
        $return["css"] =  file_get_contents($base . "hibe3_sukses_bayar_page.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_sukses_bayar_page.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_sukses_bayar_page.html.php");
        return $return;
    }

    public static function hibe3__CardMainListingMenu($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3__CardMainListingMenu/";
        $return["css"] = file_get_contents($base . "hibe3__CardMainListingMenu.css.php");
        $return["js"] =  file_get_contents($base . "hibe3__CardMainListingMenu.js.php");
        $return["html"] =  file_get_contents($base . "hibe3__CardMainListingMenu.html.php");
        return $return;
    }

    public static function default_card_vertical($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/default_card_vertical/";
        $return["row_start"] =  file_get_contents($base . "default_card_vertical.row_start.php");
        $return["html"] =  file_get_contents($base . "default_card_vertical.html.php");
        $return["row_end"] =  file_get_contents($base . "default_card_vertical.row_end.php");
        return $return;
    }

    public static function finapp_base($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/finapp_base/";
        $return["js"] =  file_get_contents($base . "finapp_base.js.php");
        $return["css"] =  file_get_contents($base . "finapp_base.css.php");
        $return["html"] =  file_get_contents($base . "finapp_base.html.php");
        return $return;
    }
    public static function finapp___headerpage($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/finapp___headerpage/";
        $return["html"] =  file_get_contents($base . "finapp___headerpage.html.php");
        return $return;
    }
    public static function finapp___bottompage($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/finapp___bottompage/";
        $return["html"] =  file_get_contents($base . "finapp___bottompage.html.php");
        return $return;
    }
    public static function finapp___sidebarpage($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/finapp___sidebarpage/";
        $return["html"] =  file_get_contents($base . "finapp___sidebarpage.html.php");
        return $return;
    }
    public static function hibe3_card_vertical($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card_vertical/";
        $return["row_start"] =  file_get_contents($base . "hibe3_card_vertical.row_start.php");
        $return["col_start"] =  file_get_contents($base . "hibe3_card_vertical.col_start.php");
        $return["html"] =  file_get_contents($base . "hibe3_card_vertical.html.php");
        $return["col_end"] =  file_get_contents($base . "hibe3_card_vertical.col_end.php");
        $return["row_end"] =  file_get_contents($base . "hibe3_card_vertical.row_end.php");
        return $return;
    }

    public static function ilanding_footer($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_footer/";
        $return["css"] = file_get_contents($base . "ilanding_footer.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_footer.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_footer.html.php");
        return $return;
    }

    public static function ilanding_contact($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_contact/";
        $return["css"] = file_get_contents($base . "ilanding_contact.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_contact.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_contact.html.php");
        return $return;
    }

    public static function ilanding_cta2($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_cta2/";
        $return["css"] = file_get_contents($base . "ilanding_cta2.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_cta2.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_cta2.html.php");
        return $return;
    }

    public static function ilanding_faq($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_faq/";
        $return["css"] = file_get_contents($base . "ilanding_faq.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_faq.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_faq.html.php");
        return $return;
    }

    public static function ilanding_pricing($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_pricing/";
        $return["css"] = file_get_contents($base . "ilanding_pricing.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_pricing.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_pricing.html.php");
        return $return;
    }

    public static function ilanding_service($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_service/";
        $return["css"] = file_get_contents($base . "ilanding_service.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_service.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_service.html.php");
        return $return;
    }

    public static function ilanding_stat($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_stat/";
        $return["css"] = file_get_contents($base . "ilanding_stat.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_stat.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_stat.html.php");
        return $return;
    }

    public static function ilanding_testimonial($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_testimonial/";
        $return["css"] = file_get_contents($base . "ilanding_testimonial.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_testimonial.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_testimonial.html.php");
        return $return;
    }

    public static function ilanding_clients($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_clients/";
        $return["css"] = file_get_contents($base . "ilanding_clients.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_clients.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_clients.html.php");
        return $return;
    }

    public static function ilanding_features_center($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_features_center/";
        $return["css"] = file_get_contents($base . "ilanding_features_center.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_features_center.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_features_center.html.php");
        return $return;
    }

    public static function ilanding_cta($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_cta/";
        $return["css"] = file_get_contents($base . "ilanding_cta.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_cta.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_cta.html.php");
        return $return;
    }

    public static function ilanding_features_card($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_features_card/";
        $return["css"] = file_get_contents($base . "ilanding_features_card.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_features_card.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_features_card.html.php");
        return $return;
    }

    public static function ilanding_features($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_features/";
        $return["css"] = file_get_contents($base . "ilanding_features.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_features.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_features.html.php");
        return $return;
    }

    public static function ilanding_home_about($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_home_about/";
        $return["css"] = file_get_contents($base . "ilanding_home_about.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_home_about.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_home_about.html.php");
        return $return;
    }

    public static function ilanding_home_hero($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_home_hero/";
        $return["css"] = file_get_contents($base . "ilanding_home_hero.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_home_hero.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_home_hero.html.php");
        return $return;
    }

    public static function ilanding_header($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_header/";
        $return["css"] = file_get_contents($base . "ilanding_header.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_header.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_header.html.php");
        return $return;
    }

    public static function ilanding_base($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ilanding_base/";
        $return["css"] = file_get_contents($base . "ilanding_base.css.php");
        $return["js"] =  file_get_contents($base . "ilanding_base.js.php");
        $return["html"] =  file_get_contents($base . "ilanding_base.html.php");
        return $return;
    }

    public static function beegrit_kirim_ke($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_kirim_ke/";
        $return["css"] = file_get_contents($base . "beegrit_kirim_ke.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_kirim_ke.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_kirim_ke.html.php");
        return $return;
    }

    public static function load_json($page, $function, $type, $row_json, $template)
    {
        $base = __DIR__ . "/../../Pages/bundle/load_json/";
        $return["html"] =  file_get_contents($base . "load_json.html.php");
        $return["css"] =  file_get_contents($base . "load_json.css.php");
        $return["js"] =  file_get_contents($base . "load_json.js.php");
        return $return;
    }

    public static function system_pesanan_list_add_produk($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/system_pesanan_list_add_produk/";
        $return["css"] = file_get_contents($base . "system_pesanan_list_add_produk.css.php");
        $return["js"] =  file_get_contents($base . "system_pesanan_list_add_produk.js.php");
        $return["html"] =  file_get_contents($base . "system_pesanan_list_add_produk.html.php");
        return $return;
    }

    public static function system_pesanan($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/system_pesanan/";
        $return["css"] = file_get_contents($base . "system_pesanan.css.php");
        $return["js"] =  file_get_contents($base . "system_pesanan.js.php");
        $return["html"] =  file_get_contents($base . "system_pesanan.html.php");
        $return["html"] =  file_get_contents($base . "system_pesanan.html.php");
        return $return;
    }

    public static function system_produk($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/system_produk/";
        $return["css"] = file_get_contents($base . "system_produk.css.php");
        $return["js"] =  file_get_contents($base . "system_produk.js.php");
        $return["html"] =  file_get_contents($base . "system_produk.html.php");
        return $return;
    }

    public static function malefashion_home_diskon($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/malefashion_home_diskon/";
        $return["html"] =  file_get_contents($base . "malefashion_home_diskon.html.php");
        $return["css"] =  file_get_contents($base . "malefashion_home_diskon.css.php");
        $return["js"] =  file_get_contents($base . "malefashion_home_diskon.js.php");

        return $return;
    }

    public static function file_manager_base($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/file_manager_base/";
        $return["js"] =  file_get_contents($base . "file_manager_base.html.php");
        $return["css"] =  file_get_contents($base . "file_manager_base.css.php");
        $return["html"] =  file_get_contents($base . "file_manager_base.js.php");
        return $return;
    }
    public static function foodmart_header($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/foodmart_header/";
        $return["html"] =  file_get_contents($base . "foodmart_header.html.php");
        return $return;
    }

    public static function foodmart_menu_dropdown($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/foodmart_menu_dropdown/";
        $return["html"] =  file_get_contents($base . "foodmart_menu_dropdown.html.php");
        return $return;
    }

    // public static function foodmart_menu_configuration($page)
    // {
    //     $base = __DIR__ . "/../../Pages/bundle/foodmart_menu_configuration/";
    //     $return["html"] =  file_get_contents($base . "foodmart_menu_configuration.html.php");
    //     return $return;
    // }

    public static function foodmart_navbar($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/foodmart_navbar/";
        $return["html"] =  file_get_contents($base . "foodmart_navbar.html.php");
        return $return;
    }

    public static function form_search_header($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/form_search_header/";
        $return["form"] = file_get_contents($base . "form_search_header.form.php");
        $return["name_search"] = file_get_contents($base . "form_search_header.name_search.php");
        $return["name_category"] = file_get_contents($base . "form_search_header.name_category.php");
        return $return;
    }

    public static function foodmart_search($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/foodmart_search/";
        $return["html"] =  file_get_contents($base . "foodmart_search.html.php");
        return $return;
    }

    public static function foodmart_base($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/foodmart_base/";
        $return["css"] = file_get_contents($base . "foodmart_base.css.php");
        $return["js"] =  file_get_contents($base . "foodmart_base.js.php");
        $return["html"] =  file_get_contents($base . "foodmart_base.html.php");
        return $return;
    }

    public static function foodmart_card_vertical($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/foodmart_card_vertical/";
        $return["row_start"] =  file_get_contents($base . "foodmart_card_vertical.row_start.php");
        $return["col_start"] =  file_get_contents($base . "foodmart_card_vertical.col_start.php");
        $return["html"] =  file_get_contents($base . "foodmart_card_vertical.html.php");
        $return["col_end"] =  file_get_contents($base . "foodmart_card_vertical.col_end.php");
        $return["row_end"] =  file_get_contents($base . "foodmart_card_vertical.row_end.php");
        return $return;
    }

    public static function soft_ui_card_main_listing($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui_card_main_listing/";
        $return["css"] = file_get_contents($base . "soft_ui_card_main_listing.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui_card_main_listing.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui_card_main_listing.html.php");
        return $return;
    }

    public static function codepen_portfolio_webpage_example_timeline_item($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_portfolio_webpage_example_timeline_item/";
        $return["css"] = file_get_contents($base . "codepen_portfolio_webpage_example_timeline_item.css.php");
        $return["js"] =  file_get_contents($base . "codepen_portfolio_webpage_example_timeline_item.js.php");
        $return["html"] =  file_get_contents($base . "codepen_portfolio_webpage_example_timeline_item.html.php");
        return $return;
    }

    public static function codepen_portfolio_webpage_example_timeline($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_portfolio_webpage_example_timeline/";
        $return["css"] = file_get_contents($base . "codepen_portfolio_webpage_example_timeline.css.php");
        $return["js"] =  file_get_contents($base . "codepen_portfolio_webpage_example_timeline.js.php");
        $return["html"] =  file_get_contents($base . "codepen_portfolio_webpage_example_timeline.html.php");
        return $return;
    }

    public static function codepen_portfolio_webpage_example_service_list($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_portfolio_webpage_example_service_list/";
        $return["css"] = file_get_contents($base . "codepen_portfolio_webpage_example_service_list.css.php");
        $return["js"] =  file_get_contents($base . "codepen_portfolio_webpage_example_service_list.js.php");
        $return["html"] =  file_get_contents($base . "codepen_portfolio_webpage_example_service_list.html.php");
        return $return;
    }

    public static function codepen_portfolio_webpage_example($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_portfolio_webpage_example/";
        $return["css"] = file_get_contents($base . "codepen_portfolio_webpage_example.css.php");
        $return["js"] =  file_get_contents($base . "codepen_portfolio_webpage_example.js.php");
        $return["html"] =  file_get_contents($base . "codepen_portfolio_webpage_example.html.php");
        return $return;
    }

    public static function sneat_sidebar($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/sneat_sidebar/";
        $return["css"] = file_get_contents($base . "sneat_sidebar.css.php");
        $return["js"] =  file_get_contents($base . "sneat_sidebar.js.php");
        $return["html"] =  file_get_contents($base . "sneat_sidebar.html.php");
        return $return;
    }

    public static function sneat_base($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/sneat_base/";
        $return["css"] = file_get_contents($base . "sneat_base.css.php");
        $return["js"] =  file_get_contents($base . "sneat_base.js.php");
        $return["html"] =  file_get_contents($base . "sneat_base.html.php");
        return $return;
    }

    public static function profil_dropdown($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/profil_dropdown/";
        $return["css"] = file_get_contents($base . "profil_dropdown.css.php");
        $return["js"] =  file_get_contents($base . "profil_dropdown.js.php");
        $return["html"] =  file_get_contents($base . "profil_dropdown.html.php");
        return $return;
    }
    public static function job_search_plaform_ui($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/job-search-platform-ui/";
        $return["css"] = file_get_contents($base . "job-search-platform-ui.css.php");
        $return["js"] =  file_get_contents($base . "job-search-platform-ui.js.php");
        $return["html"] =  file_get_contents($base . "job-search-platform-ui.html.php");
        return $return;
    }
    public static function job_search_plaform_ui_produk($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/job-search-platform-ui/";

        $return["html"] =  file_get_contents($base . "job-search-platform-ui.produk.php");
        return $return;
    }
    public static function codepen_checkout_page($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_checkout_page/";

        $return["html"] =  file_get_contents($base . "codepen_checkout_page.html.php");
        return $return;
    }

    public static function ashion_ecomerce_checkout($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_ecomerce_checkout/";
        $return["css"] = file_get_contents($base . "ashion_ecomerce_checkout.css.php");
        $return["js"] =  file_get_contents($base . "ashion_ecomerce_checkout.js.php");
        $return["html"] =  file_get_contents($base . "ashion_ecomerce_checkout.html.php");
        return $return;
    }

    public static function ashion_ecomerce_cart_produk($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_ecomerce_cart_produk/";
        $return["css"] = file_get_contents($base . "ashion_ecomerce_cart_produk.css.php");
        $return["js"] =  file_get_contents($base . "ashion_ecomerce_cart_produk.js.php");
        $return["html"] =  file_get_contents($base . "ashion_ecomerce_cart_produk.html.php");
        return $return;
    }

    public static function ashion_ecomerce_cart($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_ecomerce_cart/";
        $return["css"] = file_get_contents($base . "ashion_ecomerce_cart.css.php");
        $return["js"] =  file_get_contents($base . "ashion_ecomerce_cart.js.php");
        $return["html"] =  file_get_contents($base . "ashion_ecomerce_cart.html.php");
        return $return;
    }

    public static function beegrit_ecomerce_cart_toko($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecomerce_cart_toko/";
        $return["css"] = file_get_contents($base . "beegrit_ecomerce_cart_toko.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecomerce_cart_toko.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecomerce_cart_toko.html.php");
        return $return;
    }

    public static function foodmart_ecomerce_cart_produk($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/foodmart_ecomerce_cart_produk/";
        $return["css"] = file_get_contents($base . "foodmart_ecomerce_cart_produk.css.php");
        $return["js"] =  file_get_contents($base . "foodmart_ecomerce_cart_produk.js.php");
        $return["html"] =  file_get_contents($base . "foodmart_ecomerce_cart_produk.html.php");
        return $return;
    }

    public static function foodmart_ecomerce_cart($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/foodmart_ecomerce_cart/";
        $return["css"] = file_get_contents($base . "foodmart_ecomerce_cart.css.php");
        $return["js"] =  file_get_contents($base . "foodmart_ecomerce_cart.js.php");
        $return["html"] =  file_get_contents($base . "foodmart_ecomerce_cart.html.php");
        return $return;
    }

    public static function detailing_data($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/detailing_data/";
        $return["css"] = file_get_contents($base . "detailing_data.css.php");
        $return["js"] =  file_get_contents($base . "detailing_data.js.php");
        $return["html"] =  file_get_contents($base . "detailing_data.html.php");
        return $return;
    }

    public static function ashion_card_main_listing($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_card_main_listing/";
        $return["css"] = file_get_contents($base . "ashion_card_main_listing.css.php");
        $return["js"] =  file_get_contents($base . "ashion_card_main_listing.js.php");
        $return["html"] =  file_get_contents($base . "ashion_card_main_listing.html.php");
        return $return;
    }
    public static function desty_index($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/desty_index/";
        $return["css"] = file_get_contents($base . "desty_index.css.php");
        $return["js"] =  file_get_contents($base . "desty_index.js.php");
        $return["html"] =  file_get_contents($base . "desty_index.html.php");
        return $return;
    }
    public static function _header()
    {
        //primary_key = 16;
        $return["css"] = "";
        $return["js"] = "";
        $return["html"] = '<ul class="header__right__widget">

<li><span class="icon_search search-switch"></span></li>
<li><a href="#"><span class="icon_heart_alt"></span>
<div class="tip">2</div>
</a></li>
<li><a href="#"><span class="icon_bag_alt"></span>
<div class="tip">2</div>
</a></li>
</ul>';
        return $return;
    }

    public static function swipper_slider_centered($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/swipper_slider_centered/";
        $return["html"] =  file_get_contents($base . "swipper_slider_centered.html.php");
        $return["css"] =  file_get_contents($base . "swipper_slider_centered.css.php");
        $return["js"] =  file_get_contents($base . "swipper_slider_centered.js.php");
        return $return;
        //   $return["html"] .= '  <img class="swiper-slide" src="' . Partial::url_file($value) . '" alt="Swiper" style="border-radius: 20px;">';
    }
    public static function swipper_slider_centered_list_image($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/swipper_slider_centered_list_image/";
        $return["html"] =  file_get_contents($base . "swipper_slider_centered_list_image.html.php");
        return $return;
        //   $return["html"] .= '  <img class="swiper-slide" src="' . Partial::url_file($value) . '" alt="Swiper" style="border-radius: 20px;">';
    }
    // }
    //     $return["html"] .= '
    //       </div>
    //       <span class="swiper-pagination"></span>
    //       <span class="swiper-button-prev"></span>
    //       <span class="swiper-button-next"></span>
    //     </div>
    //   </div>
    // </section>
    // </main>';
    //     $return["js"] = file_exists($base . "html__________img_class__swiper-slide__src______Partial__url_file__value_______alt__Swiper__style__border-radius__20px____________________________return__html_________________div__________span_class__swiper-pagination____span__________span_class__swiper-button-prev____span__________span_class__swiper-button-next____span_________div_______div_____section_____main__________return__js.php") ? file_get_contents($base . "swipper_slider_centered.html__________img_class__swiper-slide__src______Partial__url_file__value_______alt__Swiper__style__border-radius__20px____________________________return__html_________________div__________span_class__swiper-pagination____span__________span_class__swiper-button-prev____span__________span_class__swiper-button-next____span_________div_______div_____section_____main__________return__js.php") ;
    //         $return["css"] = file_get_contents($base . "swipper_slider_centered.css.php") ;
    //         return $return;
    //     }

    public static function ashion_home_profil($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_home_profil/";
        $return["html"] =  file_get_contents($base . "ashion_home_profil.html.php");
        $return["css"] =  file_get_contents($base . "ashion_home_profil.css.php");
        $return["js"] =  file_get_contents($base . "ashion_home_profil.js.php");
        return $return;
    }

    public static function ashion_contact_us($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_contact_us/";
        $return["html"] =  file_get_contents($base . "ashion_contact_us.html.php");
        $return["css"] =  file_get_contents($base . "ashion_contact_us.css.php");
        $return["js"] =  file_get_contents($base . "ashion_contact_us.js.php");

        return $return;
    }

    public static function ashion_card_vertical($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_card_vertical/";
        $return["row_start"] =  file_get_contents($base . "ashion_card_vertical.row_start.php");
        $return["col_start"] =  file_get_contents($base . "ashion_card_vertical.col_start.php");
        $return["html"] =  file_get_contents($base . "ashion_card_vertical.html.php");
        $return["col_end"] =  file_get_contents($base . "ashion_card_vertical.col_end.php");
        $return["row_end"] =  file_get_contents($base . "ashion_card_vertical.row_end.php");
        return $return;
    }

    public static function ashion_home_produk_group_klasifikasi($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_home_produk_group_klasifikasi/";
        $return["html"] =  file_get_contents($base . "ashion_home_produk_group_klasifikasi.html.php");
        $return["css"] =  file_get_contents($base . "ashion_home_produk_group_klasifikasi.css.php");
        $return["js"] =  file_get_contents($base . "ashion_home_produk_group_klasifikasi.js.php");

        return $return;
    }

    // public static function name_webapps($page)
    // {
    //     $base = __DIR__ . "/../../Pages/bundle/name_webapps/";

    //     return $return;
    // }

    // public static function base_url($page)
    // {
    //     $base = __DIR__ . "/../../Pages/bundle/base_url/";
    //     $return["css"] = file_get_contents($base . "base_url.css.php") ;
    //     $return["js"] =  file_get_contents($base . "base_url.js.php") ;
    //     $return["html"] =  file_get_contents($base . "base_url.html.php") ;
    //     return $return;
    // }

    public static function _swipper__slide()
    {
        $base = __DIR__ . "/../../Pages/bundle/_swipper__slide/";
        $return["css"] = file_get_contents($base . "_swipper__slide.css.php");
        $return["js"] =  file_get_contents($base . "_swipper__slide.js.php");
        $return["html"] =  file_get_contents($base . "_swipper__slide.html.php");
        return $return;
    }

    public static function _swipper()
    {
        $base = __DIR__ . "/../../Pages/bundle/_swipper/";
        $return["css"] = file_get_contents($base . "_swipper.css.php");
        $return["js"] =  file_get_contents($base . "_swipper.js.php");
        $return["html"] =  file_get_contents($base . "_swipper.html.php");
        return $return;
    }

    public static function hibe3___navbarbuttonsearch()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3___navbarbuttonsearch/";
        $return["css"] = file_get_contents($base . "hibe3___navbarbuttonsearch.css.php");
        $return["js"] =  file_get_contents($base . "hibe3___navbarbuttonsearch.js.php");
        $return["html"] =  file_get_contents($base . "hibe3___navbarbuttonsearch.html.php");
        return $return;
    }

    public static function hibe3___headerlist()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3___headerlist/";
        $return["css"] = file_get_contents($base . "hibe3___headerlist.css.php");
        $return["js"] =  file_get_contents($base . "hibe3___headerlist.js.php");
        $return["html"] =  file_get_contents($base . "hibe3___headerlist.html.php");
        return $return;
    }

    public static function hibe3___navbarpage()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3___navbarpage/";
        $return["css"] = file_get_contents($base . "hibe3___navbarpage.css.php");
        $return["js"] =  file_get_contents($base . "hibe3___navbarpage.js.php");
        $return["html"] =  file_get_contents($base . "hibe3___navbarpage.html.php");
        return $return;
    }

    public static function hibe3___headerpage()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3___headerpage/";
        $return["css"] = file_get_contents($base . "hibe3___headerpage.css.php");
        $return["js"] =  file_get_contents($base . "hibe3___headerpage.js.php");
        $return["html"] =  file_get_contents($base . "hibe3___headerpage.html.php");
        return $return;
    }

    public static function hibe3___navbarlistprofile()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3___navbarlistprofile/";
        $return["css"] = file_get_contents($base . "hibe3___navbarlistprofile.css.php");
        $return["js"] =  file_get_contents($base . "hibe3___navbarlistprofile.js.php");
        $return["html"] =  file_get_contents($base . "hibe3___navbarlistprofile.html.php");
        return $return;
    }

    public static function hibe3___navbarnotification()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3___navbarnotification/";
        $return["css"] = file_get_contents($base . "hibe3___navbarnotification.css.php");
        $return["js"] =  file_get_contents($base . "hibe3___navbarnotification.js.php");
        $return["html"] =  file_get_contents($base . "hibe3___navbarnotification.html.php");
        return $return;
    }

    public static function beegrit_ecommerce___varian_else()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce___varian_else/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce___varian_else.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce___varian_else.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce___varian_else.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_detail()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_detail/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_detail.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_detail.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_detail.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_varian()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_varian/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_varian.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_varian.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_varian.html.php");
        return $return;
    }

    public static function beegrit_img_tumb___detail_ecommerce()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_img_tumb___detail_ecommerce/";
        $return["css"] = file_get_contents($base . "beegrit_img_tumb___detail_ecommerce.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_img_tumb___detail_ecommerce.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_img_tumb___detail_ecommerce.html.php");
        return $return;
    }

    public static function beegrit_detail_spesifikasi()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_detail_spesifikasi/";
        $return["css"] = file_get_contents($base . "beegrit_detail_spesifikasi.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_detail_spesifikasi.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_detail_spesifikasi.html.php");
        return $return;
    }

    public static function beegrit_img_sampul()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_img_sampul/";
        $return["css"] = file_get_contents($base . "beegrit_img_sampul.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_img_sampul.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_img_sampul.html.php");
        return $return;
    }

    public static function beegrit_ecomerce___varian_warna()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecomerce___varian_warna/";
        $return["css"] = file_get_contents($base . "beegrit_ecomerce___varian_warna.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecomerce___varian_warna.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecomerce___varian_warna.html.php");
        return $return;
    }

    public static function beegrit_ecommerce___varian_size()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce___varian_size/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce___varian_size.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce___varian_size.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce___varian_size.html.php");
        return $return;
    }

    public static function ashion___navbar()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___navbar/";
        $return["css"] = file_get_contents($base . "ashion___navbar.css.php");
        $return["js"] =  file_get_contents($base . "ashion___navbar.js.php");
        $return["html"] =  file_get_contents($base . "ashion___navbar.html.php");
        return $return;
    }
    public static function ashion___navbar__cart()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___navbar__cart/";
        $return["css"] = file_get_contents($base . "ashion___navbar__cart.css.php");
        $return["js"] =  file_get_contents($base . "ashion___navbar__cart.js.php");
        $return["html"] =  file_get_contents($base . "ashion___navbar__cart.html.php");
        return $return;
    }

    public static function ashion___banner()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___banner/";
        $return["css"] = file_get_contents($base . "ashion___banner.css.php");
        $return["js"] =  file_get_contents($base . "ashion___banner.js.php");
        $return["html"] =  file_get_contents($base . "ashion___banner.html.php");
        return $return;
    }

    public static function ashion___banner___list()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___banner___list/";
        $return["css"] = file_get_contents($base . "ashion___banner___list.css.php");
        $return["js"] =  file_get_contents($base . "ashion___banner___list.js.php");
        $return["html"] =  file_get_contents($base . "ashion___banner___list.html.php");
        return $return;
    }

    public static function ashion___header_logo()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___header_logo/";
        $return["css"] = file_get_contents($base . "ashion___header_logo.css.php");
        $return["js"] =  file_get_contents($base . "ashion___header_logo.js.php");
        $return["html"] =  file_get_contents($base . "ashion___header_logo.html.php");
        return $return;
    }

    public static function ashion_asion___icon_cart()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_asion___icon_cart/";
        $return["css"] = file_get_contents($base . "ashion_asion___icon_cart.css.php");
        $return["js"] =  file_get_contents($base . "ashion_asion___icon_cart.js.php");
        $return["html"] =  file_get_contents($base . "ashion_asion___icon_cart.html.php");
        return $return;
    }

    public static function ashion_checkout()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_checkout/";
        $return["css"] = file_get_contents($base . "ashion_checkout.css.php");
        $return["js"] =  file_get_contents($base . "ashion_checkout.js.php");
        $return["html"] =  file_get_contents($base . "ashion_checkout.html.php");
        return $return;
    }

    public static function ashion___button_search()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___button_search/";
        $return["css"] = file_get_contents($base . "ashion___button_search.css.php");
        $return["js"] =  file_get_contents($base . "ashion___button_search.js.php");
        $return["html"] =  file_get_contents($base . "ashion___button_search.html.php");
        return $return;
    }

    public static function ashion___banner___utama()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___banner___utama/";
        $return["css"] = file_get_contents($base . "ashion___banner___utama.css.php");
        $return["js"] =  file_get_contents($base . "ashion___banner___utama.js.php");
        $return["html"] =  file_get_contents($base . "ashion___banner___utama.html.php");
        return $return;
    }

    public static function ashion_asion___list_ecommerce()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_asion___list_ecommerce/";
        $return["css"] = file_get_contents($base . "ashion_asion___list_ecommerce.css.php");
        $return["js"] =  file_get_contents($base . "ashion_asion___list_ecommerce.js.php");
        $return["html"] =  file_get_contents($base . "ashion_asion___list_ecommerce.html.php");
        return $return;
    }

    public static function ashion___card_vertical()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___card_vertical/";
        $return["css"] = file_get_contents($base . "ashion___card_vertical.css.php");
        $return["js"] =  file_get_contents($base . "ashion___card_vertical.js.php");
        $return["html"] =  file_get_contents($base . "ashion___card_vertical.html.php");
        return $return;
    }

    public static function ashion_produk_img()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_produk_img/";
        $return["css"] = file_get_contents($base . "ashion_produk_img.css.php");
        $return["js"] =  file_get_contents($base . "ashion_produk_img.js.php");
        $return["html"] =  file_get_contents($base . "ashion_produk_img.html.php");
        return $return;
    }

    public static function ashion___icon_wishlist()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___icon_wishlist/";
        $return["css"] = file_get_contents($base . "ashion___icon_wishlist.css.php");
        $return["js"] =  file_get_contents($base . "ashion___icon_wishlist.js.php");
        $return["html"] =  file_get_contents($base . "ashion___icon_wishlist.html.php");
        return $return;
    }

    public static function ashion___cart_produk()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___cart_produk/";
        $return["css"] = file_get_contents($base . "ashion___cart_produk.css.php");
        $return["js"] =  file_get_contents($base . "ashion___cart_produk.js.php");
        $return["html"] =  file_get_contents($base . "ashion___cart_produk.html.php");
        return $return;
    }

    public static function ashion___cart()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___cart/";
        $return["css"] = file_get_contents($base . "ashion___cart.css.php");
        $return["js"] =  file_get_contents($base . "ashion___cart.js.php");
        $return["html"] =  file_get_contents($base . "ashion___cart.html.php");
        return $return;
    }

    public static function ashion_detail_ecommerce()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_detail_ecommerce/";
        $return["css"] = file_get_contents($base . "ashion_detail_ecommerce.css.php");
        $return["js"] =  file_get_contents($base . "ashion_detail_ecommerce.js.php");
        $return["html"] =  file_get_contents($base . "ashion_detail_ecommerce.html.php");
        return $return;
    }

    public static function ashion___navbar___menu_list()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___navbar___menu_list/";
        $return["css"] = file_get_contents($base . "ashion___navbar___menu_list.css.php");
        $return["js"] =  file_get_contents($base . "ashion___navbar___menu_list.js.php");
        $return["html"] =  file_get_contents($base . "ashion___navbar___menu_list.html.php");
        return $return;
    }

    public static function ashion___navbar___button_list()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion___navbar___button_list/";
        $return["css"] = file_get_contents($base . "ashion___navbar___button_list.css.php");
        $return["js"] =  file_get_contents($base . "ashion___navbar___button_list.js.php");
        $return["html"] =  file_get_contents($base . "ashion___navbar___button_list.html.php");
        return $return;
    }

    public static function sneat_ashion___profil__login()
    {
        $base = __DIR__ . "/../../Pages/bundle/sneat_ashion___profil__login/";
        $return["css"] = file_get_contents($base . "sneat_ashion___profil__login.css.php");
        $return["js"] =  file_get_contents($base . "sneat_ashion___profil__login.js.php");
        $return["html"] =  file_get_contents($base . "sneat_ashion___profil__login.html.php");
        return $return;
    }

    public static function sneat___sibare()
    {
        $base = __DIR__ . "/../../Pages/bundle/sneat___sibare/";
        $return["css"] = file_get_contents($base . "sneat___sibare.css.php");
        $return["js"] =  file_get_contents($base . "sneat___sibare.js.php");
        $return["html"] =  file_get_contents($base . "sneat___sibare.html.php");
        return $return;
    }

    public static function foodmart_home_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/foodmart_home_template/";
        $return["css"] = file_get_contents($base . "foodmart_home_template.css.php");
        $return["js"] =  file_get_contents($base . "foodmart_home_template.js.php");
        $return["html"] =  file_get_contents($base . "foodmart_home_template.html.php");
        return $return;
    }

    public static function adminlte_crud_list_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/adminlte_crud_list_template/";
        $return["css"] = file_get_contents($base . "adminlte_crud_list_template.css.php");
        $return["js"] =  file_get_contents($base . "adminlte_crud_list_template.js.php");
        $return["html"] =  file_get_contents($base . "adminlte_crud_list_template.html.php");
        return $return;
    }

    public static function adminlte_crud_vte_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/adminlte_crud_vte_template/";
        $return["css"] = file_get_contents($base . "adminlte_crud_vte_template.css.php");
        $return["js"] =  file_get_contents($base . "adminlte_crud_vte_template.js.php");
        $return["html"] =  file_get_contents($base . "adminlte_crud_vte_template.html.php");
        return $return;
    }

    public static function ashion_viewvertical_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_viewvertical_template/";
        $return["css"] = file_get_contents($base . "ashion_viewvertical_template.css.php");
        $return["js"] =  file_get_contents($base . "ashion_viewvertical_template.js.php");
        $return["html"] =  file_get_contents($base . "ashion_viewvertical_template.html.php");
        return $return;
    }

    public static function ashion__cardmainlistingmenu_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion__cardmainlistingmenu_template/";
        $return["css"] = file_get_contents($base . "ashion__cardmainlistingmenu_template.css.php");
        $return["js"] =  file_get_contents($base . "ashion__cardmainlistingmenu_template.js.php");
        $return["html"] =  file_get_contents($base . "ashion__cardmainlistingmenu_template.html.php");
        return $return;
    }

    public static function ashion_footer_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_footer_template/";
        $return["css"] = file_get_contents($base . "ashion_footer_template.css.php");
        $return["js"] =  file_get_contents($base . "ashion_footer_template.js.php");
        $return["html"] =  file_get_contents($base . "ashion_footer_template.html.php");
        return $return;
    }

    public static function ashion_home2_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_home2_template/";
        $return["css"] = file_get_contents($base . "ashion_home2_template.css.php");
        $return["js"] =  file_get_contents($base . "ashion_home2_template.js.php");
        $return["html"] =  file_get_contents($base . "ashion_home2_template.html.php");
        return $return;
    }

    public static function ashion_home3_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_home3_template/";
        $return["css"] = file_get_contents($base . "ashion_home3_template.css.php");
        $return["js"] =  file_get_contents($base . "ashion_home3_template.js.php");
        $return["html"] =  file_get_contents($base . "ashion_home3_template.html.php");
        return $return;
    }

    public static function ashion_img_list_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_img_list_template/";
        $return["css"] = file_get_contents($base . "ashion_img_list_template.css.php");
        $return["js"] =  file_get_contents($base . "ashion_img_list_template.js.php");
        $return["html"] =  file_get_contents($base . "ashion_img_list_template.html.php");
        return $return;
    }

    public static function ashion_img_tumb_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/ashion_img_tumb_template/";
        $return["css"] = file_get_contents($base . "ashion_img_tumb_template.css.php");
        $return["js"] =  file_get_contents($base . "ashion_img_tumb_template.js.php");
        $return["html"] =  file_get_contents($base . "ashion_img_tumb_template.html.php");
        return $return;
    }

    public static function beegrit_eccomercedetail_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_eccomercedetail_template/";
        $return["css"] = file_get_contents($base . "beegrit_eccomercedetail_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_eccomercedetail_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_eccomercedetail_template.html.php");
        return $return;
    }

    public static function beegrit_habistboardcontent_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_habistboardcontent_template/";
        $return["css"] = file_get_contents($base . "beegrit_habistboardcontent_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_habistboardcontent_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_habistboardcontent_template.html.php");
        return $return;
    }

    public static function beegrit_habistboardlist_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_habistboardlist_template/";
        $return["css"] = file_get_contents($base . "beegrit_habistboardlist_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_habistboardlist_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_habistboardlist_template.html.php");
        return $return;
    }

    public static function beegrit_habitsboard_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_habitsboard_template/";
        $return["css"] = file_get_contents($base . "beegrit_habitsboard_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_habitsboard_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_habitsboard_template.html.php");
        return $return;
    }

    public static function beegrit_habitsboardcontent_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_habitsboardcontent_template/";
        $return["css"] = file_get_contents($base . "beegrit_habitsboardcontent_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_habitsboardcontent_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_habitsboardcontent_template.html.php");
        return $return;
    }

    public static function beegrit_habitsboardlist_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_habitsboardlist_template/";
        $return["css"] = file_get_contents($base . "beegrit_habitsboardlist_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_habitsboardlist_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_habitsboardlist_template.html.php");
        return $return;
    }

    public static function beegrit_habitsboardlistamalan_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_habitsboardlistamalan_template/";
        $return["css"] = file_get_contents($base . "beegrit_habitsboardlistamalan_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_habitsboardlistamalan_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_habitsboardlistamalan_template.html.php");
        return $return;
    }

    public static function beegrit_habitsboardlistanggota_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_habitsboardlistanggota_template/";
        $return["css"] = file_get_contents($base . "beegrit_habitsboardlistanggota_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_habitsboardlistanggota_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_habitsboardlistanggota_template.html.php");
        return $return;
    }

    public static function beegrit_habitstable_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_habitstable_template/";
        $return["css"] = file_get_contents($base . "beegrit_habitstable_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_habitstable_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_habitstable_template.html.php");
        return $return;
    }

    public static function beegrit_habitstableajax_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_habitstableajax_template/";
        $return["css"] = file_get_contents($base . "beegrit_habitstableajax_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_habitstableajax_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_habitstableajax_template.html.php");
        return $return;
    }

    public static function dashuipro_chat_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/dashuipro_chat_template/";
        $return["css"] = file_get_contents($base . "dashuipro_chat_template.css.php");
        $return["js"] =  file_get_contents($base . "dashuipro_chat_template.js.php");
        $return["html"] =  file_get_contents($base . "dashuipro_chat_template.html.php");
        return $return;
    }

    public static function dashuipro_crud_list_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/dashuipro_crud_list_template/";
        $return["css"] = file_get_contents($base . "dashuipro_crud_list_template.css.php");
        $return["js"] =  file_get_contents($base . "dashuipro_crud_list_template.js.php");
        $return["html"] =  file_get_contents($base . "dashuipro_crud_list_template.html.php");
        return $return;
    }

    public static function dashuipro_crud_vte_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/dashuipro_crud_vte_template/";
        $return["css"] = file_get_contents($base . "dashuipro_crud_vte_template.css.php");
        $return["js"] =  file_get_contents($base . "dashuipro_crud_vte_template.js.php");
        $return["html"] =  file_get_contents($base . "dashuipro_crud_vte_template.html.php");
        return $return;
    }

    public static function dashuipro_ecommerce_cart_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/dashuipro_ecommerce_cart_template/";
        $return["css"] = file_get_contents($base . "dashuipro_ecommerce_cart_template.css.php");
        $return["js"] =  file_get_contents($base . "dashuipro_ecommerce_cart_template.js.php");
        $return["html"] =  file_get_contents($base . "dashuipro_ecommerce_cart_template.html.php");
        return $return;
    }

    public static function dashuipro_pricing_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/dashuipro_pricing_template/";
        $return["css"] = file_get_contents($base . "dashuipro_pricing_template.css.php");
        $return["js"] =  file_get_contents($base . "dashuipro_pricing_template.js.php");
        $return["html"] =  file_get_contents($base . "dashuipro_pricing_template.html.php");
        return $return;
    }

    public static function dashuipro_pricingdetail_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/dashuipro_pricingdetail_template/";
        $return["css"] = file_get_contents($base . "dashuipro_pricingdetail_template.css.php");
        $return["js"] =  file_get_contents($base . "dashuipro_pricingdetail_template.js.php");
        $return["html"] =  file_get_contents($base . "dashuipro_pricingdetail_template.html.php");
        return $return;
    }

    public static function dashuipro_pricingdetail_list_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/dashuipro_pricingdetail_list_template/";
        $return["css"] = file_get_contents($base . "dashuipro_pricingdetail_list_template.css.php");
        $return["js"] =  file_get_contents($base . "dashuipro_pricingdetail_list_template.js.php");
        $return["html"] =  file_get_contents($base . "dashuipro_pricingdetail_list_template.html.php");
        return $return;
    }

    public static function dashuipro_pricinggroup_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/dashuipro_pricinggroup_template/";
        $return["css"] = file_get_contents($base . "dashuipro_pricinggroup_template.css.php");
        $return["js"] =  file_get_contents($base . "dashuipro_pricinggroup_template.js.php");
        $return["html"] =  file_get_contents($base . "dashuipro_pricinggroup_template.html.php");
        return $return;
    }

    public static function esios_crud_list_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/esios_crud_list_template/";
        $return["css"] = file_get_contents($base . "esios_crud_list_template.css.php");
        $return["js"] =  file_get_contents($base . "esios_crud_list_template.js.php");
        $return["html"] =  file_get_contents($base . "esios_crud_list_template.html.php");
        return $return;
    }

    public static function esios_crud_vte_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/esios_crud_vte_template/";
        $return["css"] = file_get_contents($base . "esios_crud_vte_template.css.php");
        $return["js"] =  file_get_contents($base . "esios_crud_vte_template.js.php");
        $return["html"] =  file_get_contents($base . "esios_crud_vte_template.html.php");
        return $return;
    }

    public static function finapp_dashboard_card_footer_item_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/finapp_dashboard_card_footer_item_template/";
        $return["css"] = file_get_contents($base . "finapp_dashboard_card_footer_item_template.css.php");
        $return["js"] =  file_get_contents($base . "finapp_dashboard_card_footer_item_template.js.php");
        $return["html"] =  file_get_contents($base . "finapp_dashboard_card_footer_item_template.html.php");
        return $return;
    }

    public static function finapp_dashboard_card_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/finapp_dashboard_card_template/";
        $return["css"] = file_get_contents($base . "finapp_dashboard_card_template.css.php");
        $return["js"] =  file_get_contents($base . "finapp_dashboard_card_template.js.php");
        $return["html"] =  file_get_contents($base . "finapp_dashboard_card_template.html.php");
        return $return;
    }

    public static function hibe3_chat_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_chat_template/";
        $return["css"] = file_get_contents($base . "hibe3_chat_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_chat_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_chat_template.html.php");
        return $return;
    }

    public static function hibe3_headerlist_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_headerlist_template/";
        $return["css"] = file_get_contents($base . "hibe3_headerlist_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_headerlist_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_headerlist_template.html.php");
        return $return;
    }

    public static function hibe3_headerlistleft_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_headerlistleft_template/";
        $return["css"] = file_get_contents($base . "hibe3_headerlistleft_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_headerlistleft_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_headerlistleft_template.html.php");
        return $return;
    }

    public static function hibe3_navbarbuttonsearch_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_navbarbuttonsearch_template/";
        $return["css"] = file_get_contents($base . "hibe3_navbarbuttonsearch_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_navbarbuttonsearch_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_navbarbuttonsearch_template.html.php");
        return $return;
    }

    public static function hibe3_navbarlistprofile_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_navbarlistprofile_template/";
        $return["css"] = file_get_contents($base . "hibe3_navbarlistprofile_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_navbarlistprofile_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_navbarlistprofile_template.html.php");
        return $return;
    }

    public static function hibe3_navbarlogo_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_navbarlogo_template/";
        $return["css"] = file_get_contents($base . "hibe3_navbarlogo_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_navbarlogo_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_navbarlogo_template.html.php");
        return $return;
    }

    public static function hibe3_navbarnotification_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_navbarnotification_template/";
        $return["css"] = file_get_contents($base . "hibe3_navbarnotification_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_navbarnotification_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_navbarnotification_template.html.php");
        return $return;
    }

    public static function hibe3_navbarsearch_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_navbarsearch_template/";
        $return["css"] = file_get_contents($base . "hibe3_navbarsearch_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_navbarsearch_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_navbarsearch_template.html.php");
        return $return;
    }

    public static function hibe3_navbarsearchresult_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_navbarsearchresult_template/";
        $return["css"] = file_get_contents($base . "hibe3_navbarsearchresult_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_navbarsearchresult_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_navbarsearchresult_template.html.php");
        return $return;
    }

    public static function hibe3_navbartoggle_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_navbartoggle_template/";
        $return["css"] = file_get_contents($base . "hibe3_navbartoggle_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_navbartoggle_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_navbartoggle_template.html.php");
        return $return;
    }

    public static function hibe3_sidebarinprofilebox_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_sidebarinprofilebox_template/";
        $return["css"] = file_get_contents($base . "hibe3_sidebarinprofilebox_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_sidebarinprofilebox_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_sidebarinprofilebox_template.html.php");
        return $return;
    }

    public static function hibe3_sidebarlist_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_sidebarlist_template/";
        $return["css"] = file_get_contents($base . "hibe3_sidebarlist_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_sidebarlist_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_sidebarlist_template.html.php");
        return $return;
    }

    public static function hibe3_sidebarlistbottom_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_sidebarlistbottom_template/";
        $return["css"] = file_get_contents($base . "hibe3_sidebarlistbottom_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_sidebarlistbottom_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_sidebarlistbottom_template.html.php");
        return $return;
    }

    public static function hibe3_blockbanner_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_blockbanner_template/";
        $return["css"] = file_get_contents($base . "hibe3_blockbanner_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_blockbanner_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_blockbanner_template.html.php");
        return $return;
    }

    public static function hibe3_blockbanner_button_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_blockbanner_button_template/";
        $return["css"] = file_get_contents($base . "hibe3_blockbanner_button_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_blockbanner_button_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_blockbanner_button_template.html.php");
        return $return;
    }

    public static function hibe3_checkboxgroup_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_checkboxgroup_template/";
        $return["css"] = file_get_contents($base . "hibe3_checkboxgroup_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_checkboxgroup_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_checkboxgroup_template.html.php");
        return $return;
    }

    public static function hibe3_checkboxgroup_checkbox_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_checkboxgroup_checkbox_template/";
        $return["css"] = file_get_contents($base . "hibe3_checkboxgroup_checkbox_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_checkboxgroup_checkbox_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_checkboxgroup_checkbox_template.html.php");
        return $return;
    }

    public static function hibe3_checkboxgroup_group_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_checkboxgroup_group_template/";
        $return["css"] = file_get_contents($base . "hibe3_checkboxgroup_group_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_checkboxgroup_group_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_checkboxgroup_group_template.html.php");
        return $return;
    }

    public static function hibe3_swipper_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_swipper_template/";
        $return["css"] = file_get_contents($base . "hibe3_swipper_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_swipper_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_swipper_template.html.php");
        return $return;
    }

    public static function soft_ui_carddashboard_right_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui_carddashboard_right_template/";
        $return["css"] = file_get_contents($base . "soft_ui_carddashboard_right_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui_carddashboard_right_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui_carddashboard_right_template.html.php");
        return $return;
    }

    public static function soft_ui_carddashboard_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui_carddashboard_template/";
        $return["css"] = file_get_contents($base . "soft_ui_carddashboard_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui_carddashboard_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui_carddashboard_template.html.php");
        return $return;
    }

    public static function soft_ui_cardinfo1_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui_cardinfo1_template/";
        $return["css"] = file_get_contents($base . "soft_ui_cardinfo1_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui_cardinfo1_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui_cardinfo1_template.html.php");
        return $return;
    }

    public static function soft_ui__cardfilter_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui__cardfilter_template/";
        $return["css"] = file_get_contents($base . "soft_ui__cardfilter_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui__cardfilter_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui__cardfilter_template.html.php");
        return $return;
    }

    public static function soft_ui__cardlistingmenu_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui__cardlistingmenu_template/";
        $return["css"] = file_get_contents($base . "soft_ui__cardlistingmenu_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui__cardlistingmenu_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui__cardlistingmenu_template.html.php");
        return $return;
    }

    public static function soft_ui__cardmainlistingmenu_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui__cardmainlistingmenu_template/";
        $return["css"] = file_get_contents($base . "soft_ui__cardmainlistingmenu_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui__cardmainlistingmenu_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui__cardmainlistingmenu_template.html.php");
        return $return;
    }

    public static function soft_ui__cardmenu_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui__cardmenu_template/";
        $return["css"] = file_get_contents($base . "soft_ui__cardmenu_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui__cardmenu_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui__cardmenu_template.html.php");
        return $return;
    }

    public static function soft_ui__cardmenuscreena_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui__cardmenuscreena_template/";
        $return["css"] = file_get_contents($base . "soft_ui__cardmenuscreena_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui__cardmenuscreena_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui__cardmenuscreena_template.html.php");
        return $return;
    }

    public static function soft_ui__cardmenuscreenb_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui__cardmenuscreenb_template/";
        $return["css"] = file_get_contents($base . "soft_ui__cardmenuscreenb_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui__cardmenuscreenb_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui__cardmenuscreenb_template.html.php");
        return $return;
    }

    public static function soft_ui__cardullinav_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui__cardullinav_template/";
        $return["css"] = file_get_contents($base . "soft_ui__cardullinav_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui__cardullinav_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui__cardullinav_template.html.php");
        return $return;
    }

    public static function soft_ui__cardulnav_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/soft_ui__cardulnav_template/";
        $return["css"] = file_get_contents($base . "soft_ui__cardulnav_template.css.php");
        $return["js"] =  file_get_contents($base . "soft_ui__cardulnav_template.js.php");
        $return["html"] =  file_get_contents($base . "soft_ui__cardulnav_template.html.php");
        return $return;
    }

    public static function tabler_crud_list_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/tabler_crud_list_template/";
        $return["css"] = file_get_contents($base . "tabler_crud_list_template.css.php");
        $return["js"] =  file_get_contents($base . "tabler_crud_list_template.js.php");
        $return["html"] =  file_get_contents($base . "tabler_crud_list_template.html.php");
        return $return;
    }

    public static function tabler_crud_vte_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/tabler_crud_vte_template/";
        $return["css"] = file_get_contents($base . "tabler_crud_vte_template.css.php");
        $return["js"] =  file_get_contents($base . "tabler_crud_vte_template.js.php");
        $return["html"] =  file_get_contents($base . "tabler_crud_vte_template.html.php");
        return $return;
    }

    public static function tabler_section_header_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/tabler_section_header_template/";
        $return["css"] = file_get_contents($base . "tabler_section_header_template.css.php");
        $return["js"] =  file_get_contents($base . "tabler_section_header_template.js.php");
        $return["html"] =  file_get_contents($base . "tabler_section_header_template.html.php");
        return $return;
    }

    public static function topiclisting_banner_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_banner_template/";
        $return["css"] = file_get_contents($base . "topiclisting_banner_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_banner_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_banner_template.html.php");
        return $return;
    }

    public static function topiclisting_banner_detail_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_banner_detail_template/";
        $return["css"] = file_get_contents($base . "topiclisting_banner_detail_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_banner_detail_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_banner_detail_template.html.php");
        return $return;
    }

    public static function topiclisting_contact_section_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_contact_section_template/";
        $return["css"] = file_get_contents($base . "topiclisting_contact_section_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_contact_section_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_contact_section_template.html.php");
        return $return;
    }

    public static function topiclisting_content_tab_pane_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_content_tab_pane_template/";
        $return["css"] = file_get_contents($base . "topiclisting_content_tab_pane_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_content_tab_pane_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_content_tab_pane_template.html.php");
        return $return;
    }

    public static function topiclisting_explore_section_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_explore_section_template/";
        $return["css"] = file_get_contents($base . "topiclisting_explore_section_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_explore_section_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_explore_section_template.html.php");
        return $return;
    }

    public static function topiclisting_faq_detail_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_faq_detail_template/";
        $return["css"] = file_get_contents($base . "topiclisting_faq_detail_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_faq_detail_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_faq_detail_template.html.php");
        return $return;
    }

    public static function topiclisting_faq_section_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_faq_section_template/";
        $return["css"] = file_get_contents($base . "topiclisting_faq_section_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_faq_section_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_faq_section_template.html.php");
        return $return;
    }

    public static function topiclisting_footer_section_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_footer_section_template/";
        $return["css"] = file_get_contents($base . "topiclisting_footer_section_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_footer_section_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_footer_section_template.html.php");
        return $return;
    }

    public static function topiclisting_nav_header_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_nav_header_template/";
        $return["css"] = file_get_contents($base . "topiclisting_nav_header_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_nav_header_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_nav_header_template.html.php");
        return $return;
    }

    public static function topiclisting_nav_item_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_nav_item_template/";
        $return["css"] = file_get_contents($base . "topiclisting_nav_item_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_nav_item_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_nav_item_template.html.php");
        return $return;
    }

    public static function topiclisting_nav_item_header_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_nav_item_header_template/";
        $return["css"] = file_get_contents($base . "topiclisting_nav_item_header_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_nav_item_header_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_nav_item_header_template.html.php");
        return $return;
    }

    public static function topiclisting_tab_pane_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_tab_pane_template/";
        $return["css"] = file_get_contents($base . "topiclisting_tab_pane_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_tab_pane_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_tab_pane_template.html.php");
        return $return;
    }

    public static function topiclisting_timeline_detail_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_timeline_detail_template/";
        $return["css"] = file_get_contents($base . "topiclisting_timeline_detail_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_timeline_detail_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_timeline_detail_template.html.php");
        return $return;
    }

    public static function topiclisting_timeline_section_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_timeline_section_template/";
        $return["css"] = file_get_contents($base . "topiclisting_timeline_section_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_timeline_section_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_timeline_section_template.html.php");
        return $return;
    }

    public static function topiclisting_topic_detail_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/topiclisting_topic_detail_template/";
        $return["css"] = file_get_contents($base . "topiclisting_topic_detail_template.css.php");
        $return["js"] =  file_get_contents($base . "topiclisting_topic_detail_template.js.php");
        $return["html"] =  file_get_contents($base . "topiclisting_topic_detail_template.html.php");
        return $return;
    }

    public static function beegrit_card_img_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_card_img_template/";
        $return["css"] = file_get_contents($base . "beegrit_card_img_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_card_img_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_card_img_template.html.php");
        return $return;
    }

    public static function beegrit_card_layout_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_card_layout_template/";
        $return["css"] = file_get_contents($base . "beegrit_card_layout_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_card_layout_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_card_layout_template.html.php");
        return $return;
    }

    public static function beegrit_chat_chat_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_chat_chat_template/";
        $return["css"] = file_get_contents($base . "beegrit_chat_chat_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_chat_chat_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_chat_chat_template.html.php");
        return $return;
    }

    public static function beegrit_chat_content_footer_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_chat_content_footer_template/";
        $return["css"] = file_get_contents($base . "beegrit_chat_content_footer_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_chat_content_footer_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_chat_content_footer_template.html.php");
        return $return;
    }

    public static function beegrit_chat_content_pesan_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_chat_content_pesan_template/";
        $return["css"] = file_get_contents($base . "beegrit_chat_content_pesan_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_chat_content_pesan_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_chat_content_pesan_template.html.php");
        return $return;
    }

    public static function beegrit_chat_content_pesan_me_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_chat_content_pesan_me_template/";
        $return["css"] = file_get_contents($base . "beegrit_chat_content_pesan_me_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_chat_content_pesan_me_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_chat_content_pesan_me_template.html.php");
        return $return;
    }

    public static function beegrit_chat_content_pesan_other_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_chat_content_pesan_other_template/";
        $return["css"] = file_get_contents($base . "beegrit_chat_content_pesan_other_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_chat_content_pesan_other_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_chat_content_pesan_other_template.html.php");
        return $return;
    }

    public static function beegrit_chat_content_profile_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_chat_content_profile_template/";
        $return["css"] = file_get_contents($base . "beegrit_chat_content_profile_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_chat_content_profile_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_chat_content_profile_template.html.php");
        return $return;
    }

    public static function beegrit_chat_list_buat_chat_room_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_chat_list_buat_chat_room_template/";
        $return["css"] = file_get_contents($base . "beegrit_chat_list_buat_chat_room_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_chat_list_buat_chat_room_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_chat_list_buat_chat_room_template.html.php");
        return $return;
    }

    public static function beegrit_chat_list_chat_room_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_chat_list_chat_room_template/";
        $return["css"] = file_get_contents($base . "beegrit_chat_list_chat_room_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_chat_list_chat_room_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_chat_list_chat_room_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_cart_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_cart_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_cart_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_cart_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_cart_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_cart_option_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_cart_option_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_cart_option_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_cart_option_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_cart_option_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_cart_produk_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_cart_produk_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_cart_produk_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_cart_produk_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_cart_produk_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_cart_toko_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_cart_toko_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_cart_toko_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_cart_toko_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_cart_toko_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_cart_varian_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_cart_varian_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_cart_varian_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_cart_varian_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_cart_varian_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_checkout_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_checkout_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_checkout_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_checkout_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_checkout_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_checkout_kirim_ke_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_checkout_kirim_ke_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_checkout_kirim_ke_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_checkout_kirim_ke_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_checkout_kirim_ke_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_checkout_pembayaran_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_checkout_pembayaran_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_checkout_pembayaran_brand_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_checkout_pembayaran_brand_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_brand_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_brand_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_checkout_pembayaran_brand_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_detail_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_detail_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_detail_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_detail_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_detail_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_detail_spesifikasi_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_detail_spesifikasi_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_detail_spesifikasi_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_detail_spesifikasi_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_detail_spesifikasi_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_img_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_img_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_img_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_img_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_img_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_img_tumb_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_img_tumb_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_img_tumb_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_img_tumb_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_img_tumb_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_invoice_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_invoice_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_invoice_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_invoice_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_invoice_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_invoice_alamat_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_invoice_alamat_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_invoice_alamat_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_invoice_alamat_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_invoice_alamat_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_invoice_pembayaran_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_invoice_pembayaran_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_invoice_pembayaran_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_invoice_pembayaran_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_invoice_pembayaran_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_varian_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_varian_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_varian_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_varian_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_varian_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_varian_else_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_varian_else_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_varian_else_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_varian_else_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_varian_else_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_varian_size_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_varian_size_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_varian_size_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_varian_size_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_varian_size_template.html.php");
        return $return;
    }

    public static function beegrit_ecommerce_varian_warna_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/beegrit_ecommerce_varian_warna_template/";
        $return["css"] = file_get_contents($base . "beegrit_ecommerce_varian_warna_template.css.php");
        $return["js"] =  file_get_contents($base . "beegrit_ecommerce_varian_warna_template.js.php");
        $return["html"] =  file_get_contents($base . "beegrit_ecommerce_varian_warna_template.html.php");
        return $return;
    }

    public static function codepen_bookmark_appview_transition_card_apps_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_bookmark_appview_transition_card_apps_template/";
        $return["css"] = file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_template.css.php");
        $return["js"] =  file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_template.js.php");
        $return["html"] =  file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_template.html.php");
        return $return;
    }

    public static function codepen_bookmark_appview_transition_card_apps_avatar_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_bookmark_appview_transition_card_apps_avatar_template/";
        $return["css"] = file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_avatar_template.css.php");
        $return["js"] =  file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_avatar_template.js.php");
        $return["html"] =  file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_avatar_template.html.php");
        return $return;
    }

    public static function codepen_bookmark_appview_transition_card_apps_header_nav_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_bookmark_appview_transition_card_apps_header_nav_template/";
        $return["css"] = file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_header_nav_template.css.php");
        $return["js"] =  file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_header_nav_template.js.php");
        $return["html"] =  file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_header_nav_template.html.php");
        return $return;
    }

    public static function codepen_bookmark_appview_transition_card_apps_sidebar_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_bookmark_appview_transition_card_apps_sidebar_template/";
        $return["css"] = file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_sidebar_template.css.php");
        $return["js"] =  file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_sidebar_template.js.php");
        $return["html"] =  file_get_contents($base . "codepen_bookmark_appview_transition_card_apps_sidebar_template.html.php");
        return $return;
    }

    public static function codepen_comparision_comparision_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_comparision_comparision_template/";
        $return["css"] = file_get_contents($base . "codepen_comparision_comparision_template.css.php");
        $return["js"] =  file_get_contents($base . "codepen_comparision_comparision_template.js.php");
        $return["html"] =  file_get_contents($base . "codepen_comparision_comparision_template.html.php");
        return $return;
    }

    public static function codepen_learderboard_leaderboard_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_learderboard_leaderboard_template/";
        $return["css"] = file_get_contents($base . "codepen_learderboard_leaderboard_template.css.php");
        $return["js"] =  file_get_contents($base . "codepen_learderboard_leaderboard_template.js.php");
        $return["html"] =  file_get_contents($base . "codepen_learderboard_leaderboard_template.html.php");
        return $return;
    }

    public static function codepen_swipper_swipper_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/codepen_swipper_swipper_template/";
        $return["css"] = file_get_contents($base . "codepen_swipper_swipper_template.css.php");
        $return["js"] =  file_get_contents($base . "codepen_swipper_swipper_template.js.php");
        $return["html"] =  file_get_contents($base . "codepen_swipper_swipper_template.html.php");
        return $return;
    }

    public static function hibe3_card__cardfilter_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card__cardfilter_template/";
        $return["css"] = file_get_contents($base . "hibe3_card__cardfilter_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card__cardfilter_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card__cardfilter_template.html.php");
        return $return;
    }

    public static function hibe3_card__cardlistingmenu_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card__cardlistingmenu_template/";
        $return["css"] = file_get_contents($base . "hibe3_card__cardlistingmenu_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card__cardlistingmenu_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card__cardlistingmenu_template.html.php");
        return $return;
    }

    public static function hibe3_card__cardmainlistingmenu_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card__cardmainlistingmenu_template/";
        $return["css"] = file_get_contents($base . "hibe3_card__cardmainlistingmenu_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card__cardmainlistingmenu_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card__cardmainlistingmenu_template.html.php");
        return $return;
    }

    public static function hibe3_card__cardmenu_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card__cardmenu_template/";
        $return["css"] = file_get_contents($base . "hibe3_card__cardmenu_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card__cardmenu_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card__cardmenu_template.html.php");
        return $return;
    }

    public static function hibe3_card__cardmenuscreena_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card__cardmenuscreena_template/";
        $return["css"] = file_get_contents($base . "hibe3_card__cardmenuscreena_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card__cardmenuscreena_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card__cardmenuscreena_template.html.php");
        return $return;
    }

    public static function hibe3_card__cardmenuscreenb_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card__cardmenuscreenb_template/";
        $return["css"] = file_get_contents($base . "hibe3_card__cardmenuscreenb_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card__cardmenuscreenb_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card__cardmenuscreenb_template.html.php");
        return $return;
    }

    public static function hibe3_card__cardprofilemenu_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card__cardprofilemenu_template/";
        $return["css"] = file_get_contents($base . "hibe3_card__cardprofilemenu_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card__cardprofilemenu_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card__cardprofilemenu_template.html.php");
        return $return;
    }

    public static function hibe3_card__cardullinav_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card__cardullinav_template/";
        $return["css"] = file_get_contents($base . "hibe3_card__cardullinav_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card__cardullinav_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card__cardullinav_template.html.php");
        return $return;
    }

    public static function hibe3_card__cardulnav_template()
    {
        $base = __DIR__ . "/../../Pages/bundle/hibe3_card__cardulnav_template/";
        $return["css"] = file_get_contents($base . "hibe3_card__cardulnav_template.css.php");
        $return["js"] =  file_get_contents($base . "hibe3_card__cardulnav_template.js.php");
        $return["html"] =  file_get_contents($base . "hibe3_card__cardulnav_template.html.php");
        return $return;
    }
    public static function home_produk_group_klasifikasi($page)
    {
        $base = __DIR__ . "/../../Pages/bundle/home_produk_group_klasifikasi/";
        $return["css"] = file_get_contents($base . "home_produk_group_klasifikasi.css.php");
        $return["js"] =  file_get_contents($base . "home_produk_group_klasifikasi.js.php");
        $return["html"] =  file_get_contents($base . "home_produk_group_klasifikasi.html.php");
        return $return;
    }
    public static function home_produk_group_klasifikasi2($page)
    {
        $db['utama'] = "inventaris__asset__list";
        $db['query'] = DatabaseFunc::best_seller($page, 12);
        $get_best_seller = Database::database_coverter($page, $db, [], 'all');
        $db['utama'] = "inventaris__asset__list";
        $db['query'] = DatabaseFunc::new_produk($page, 12);
        $get_new = Database::database_coverter($page, $db, [], 'all');
        ($get_best_seller);
        $return = '
    <style>
      .filter__controls {
        text-align: center;
        margin-bottom: 45px;
      }

      .filter__controls li {
        color: #b7b7b7;
        font-size: 24px;
        font-weight: 700;
        list-style: none;
        display: inline-block;
        margin-right: 88px;
        cursor: pointer;
      }

      .filter__controls li:last-child {
        margin-right: 0;
      }

      .filter__controls li.active {
        color: #111111;
      }
      

      </style>

      <section class="product spad mt-5">
          <div class="container">
              <div class="row">
                
                  <div class="col-12">
                      <ul class="filter__controls">
                          <li class="active"  data-filter="*">All</li>
                          <li data-filter=".produkbaru">New Arrivals</li>
                          <li data-filter=".bestseller">Best Sellers</li>
                          
                      </ul>
                  </div>
              </div>
        <div class="row property__gallery">
        ';
        if ($page['template'] == 'ashion') {
            $template_card = Self::ashion_card_vertical($page);
        } else {
            $template_card = Self::foodmart_card_vertical($page);
        }
        if ($get_new['num_rows']) {
            $return .= $template_card['row_start'];
            foreach ($get_new['row'] as $bs) {
                $get_data_harga = EcommerceApp::get_data_harga($page, '', '', 'min_max', $bs->id_produk);

                $temp_template = $template_card['html'];
                $temp_template = str_replace('<CARD-LINK></CARD-LINK>', Partial::link_direct($page, $page['load']['link_route'], ["Ecommerce", "detail", 'view_layout', $bs->id_produk, '-1', '-1', $page['load']['board']], 'menu', 'just_link'), $temp_template);
                $temp_template = str_replace('<IMG-SRC></IMG-SRC>', Partial::url_file($bs), $temp_template);
                $temp_template = str_replace('<CARD-TITLE></CARD-TITLE>', $bs->nama_barang, $temp_template);
                $temp_template = str_replace('<CARD-SUBTITLE></CARD-SUBTITLE>', $get_data_harga['Min Max Harga Jual Akhir'], $temp_template);

                $return .= str_replace('<CARD-LINK></CARD-LINK>', Partial::link_direct($page, $page['load']['link_route'], ["Ecommerce", "detail", 'view_layout', $bs->id_produk, '-1', '-1', $page['load']['board']], 'menu', 'just_link'), $template_card['col_start']);
                $return .= $temp_template;
                $return .= $template_card['col_end'];
            }
            $return .= $template_card['row_end'];
        }
        if ($get_best_seller['num_rows']) {
            $return .= $template_card['row_start'];
            // echo $get_best_seller['query'];
            foreach ($get_best_seller['row'] as $bs) {
                $get_data_harga = EcommerceApp::get_data_harga($page, '', '', 'min_max', $bs->id_produk);

                $temp_template = $template_card['html'];
                $temp_template = str_replace('<CARD-LINK></CARD-LINK>', Partial::link_direct($page, $page['load']['link_route'], ["Ecommerce", "detail", 'view_layout', $bs->id_produk, '-1', '-1', $page['load']['board']], 'menu', 'just_link'), $temp_template);
                $temp_template = str_replace('<IMG-SRC></IMG-SRC>', Partial::url_file($bs), $temp_template);
                $temp_template = str_replace('<CARD-TITLE></CARD-TITLE>', $bs->nama_barang, $temp_template);
                $temp_template = str_replace('<CARD-SUBTITLE></CARD-SUBTITLE>', $get_data_harga['Min Max Harga Jual Akhir'], $temp_template);

                $return .= str_replace('<CARD-LINK></CARD-LINK>', Partial::link_direct($page, $page['load']['link_route'], ["Ecommerce", "detail", 'view_layout', $bs->id_produk, '-1', '-1', $page['load']['board']], 'menu', 'just_link'), $template_card['col_start']);
                $return .= $temp_template;
                $return .= $template_card['col_end'];
            }
            $return .= $template_card['row_end'];
            // foreach ($get_best_seller['row'] as $bs) {
            //   $get_data_harga = EcommerceApp::get_data_harga($page, '', '', 'min_max', $bs->id_produk);
            //   $return .= '
            //           <div class="col-lg-3 col-md-4 col-sm-6 bestseller"  onclick="window.location.href=\'' . Partial::link_direct($page, $page['load']['link_route'], ["Ecommerce", "detail", 'view_layout', $bs->id_produk, '-1', '-1', $page['load']['board']], 'menu', 'just_link  ') . '\'">
            //           <div class="product__item">
            //               <div class="product__item__pic set-bg" data-setbg="' . Partial::url_file($bs) . '">
            //                   <div class="label ">Best Seller</div>
            //                   <ul class="product__hover">
            //                       <li><a href="' . Partial::url_file($bs) . '" class="image-popup"><span class="arrow_expand"></span></a></li>
            //                       <li><a href="#"><span class="icon_heart_alt"></span></a></li>
            //                       <li><a href="#"><span class="icon_bag_alt"></span></a></li>
            //                   </ul>
            //               </div>
            //               <div class="product__item__text">
            //               <h6><a ' . Partial::link_direct($page, $page['load']['link_route'], ["Ecommerce", "detail", 'view_layout', $bs->id_produk, '-1', '-1', $page['load']['board']], 'menu', 'just_link  ') . '>' . $bs->nama_barang . '</a></h6>
            //               <div class="rating">
            //               <i class="fa fa-star"></i>
            //               <i class="fa fa-star"></i>
            //               <i class="fa fa-star"></i>
            //               <i class="fa fa-star"></i>
            //               <i class="fa fa-star"></i>
            //               </div>
            //               <div class="product__price">' . $get_data_harga['Min Max Harga Jual Akhir'] . '</div>
            //               </div>
            //               </div>
            //               </div>';
            // }
        }
        $return .= '
           
            
        </div>
    </div>
</section>
    ';
        return $return;
    }
    public static function foodmart_menu_configuration($page)
    {
        $configuration['prefix']['grup'] = '<li class="menu-header small text-uppercase">
                            <span class="menu-header-text">';
        $configuration['sufix']['grup'] = '</span>
          <content-grup></content-grup>
                          </li>';

        $configuration['prefix']['menu'] = '
      <li class="nav-item">
                            <a href="|LINK|" class="nav-link">
                   <div class="">
                          <ICON></ICON>
                         </div>';
        $configuration['sufix']['menu'] = '
                  </a>
                </li>';
        return $configuration;
    }
    public static function foodmart_menu_single($page)
    {
        $return["html"] = '<li class="nav-item">
                            <a href="<LINK></LINK>" class="<CLASS></CLASS>"><TEXT></TEXT></a>
                        </li>';
        return $return;
    }
    public static function ashion_ecomerce_detail_produk($page)
    {
        $return['css'] = '
    
      <link rel="stylesheet" href="' . Partial::urlframework("ashion", "css/owl.carousel.min.css") . '" type="text/css">
          
      <script src="' . Partial::urlframework("ashion", "js/owl.carousel.min.js") . '"></script>
          <style>
          .product-details {
        padding-top: 70px;
        padding-bottom: 50px;
      }
      .ps img{ width:100%;}
      .product__details__pic {
        overflow: hidden;
      }

      .product__details__pic__left {
        width: 22%;
        max-height: 574px;
        float: left;
        overflow-y: auto;
      }

      .product__details__pic__left .pt {
        display: block;
        margin-bottom: 20px;
        cursor: pointer;
        position: relative;
      }

      .product__details__pic__left .pt::after {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
        background: #000;
        opacity: 0;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        transition: all 0.3s;
      }

      .product__details__pic__left .pt.active::after {
        opacity: 0.3;
      }

      .product__details__pic__left .pt:last-child {
        margin-bottom: 0;
      }

      .product__details__pic__left .pt img {
        min-width: 100%;
          width: 100%;
      }

      .product__details__slider__content {
        width: calc(78% - 20px);
        float: left;
        margin-left: 20px;
      }

      .product__details__pic__slider.owl-carousel .owl-nav button {
        position: absolute;
        left: 10px;
        top: 50%;
        font-size: 22px;
        color: #111111;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 50%;
        line-height: 44px;
        text-align: center;
        margin-top: -20px;
      }

      .product__details__pic__slider.owl-carousel .owl-nav button.owl-next {
        left: auto;
        right: 10px;
      }

      .product__details__text h3 {
        color: #111111;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 12px;
      }

      .product__details__text h3 span {
        display: block;
        font-size: 14px;
        color: #444444;
        text-transform: none;
        font-weight: 400;
        margin-top: 5px;
      }

      .product__details__text .rating {
        margin-bottom: 16px;
      }

      .product__details__text .rating i {
        font-size: 12px;
        color: #e3c01c;
        margin-right: -4px;
      }

      .product__details__text .rating span {
        font-size: 12px;
        color: #666666;
        margin-left: 5px;
      }

      .product__details__text p {
        color: #444444;
        margin-bottom: 28px;
      }

      .product__details__price {
        font-size: 30px;
        font-weight: 600;
        color: #ca1515;
        margin-bottom: 30px;
      }

      .product__details__price span {
        font-size: 18px;
        color: #b1b0b0;
        text-decoration: line-through;
        margin-left: 10px;
        display: inline-block;
      }

      .quantity {
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
      }

      .quantity>span {
        font-size: 14px;
        color: #111111;
        font-weight: 600;
        float: left;
        margin-top: 14px;
        margin-right: 15px;
      }

      .pro-qty {
        height: 50px;
        width: 150px;
        border: 1px solid #ebebeb;
        border-radius: 50px;
        padding: 0 20px;
        overflow: hidden;
        display: inline-block;
      }

      .pro-qty .qtybtn {
        font-size: 14px;
        color: #666666;
        cursor: pointer;
        float: left;
        width: 12px;
        line-height: 46px;
      }

      .pro-qty input {
        font-size: 14px;
        color: #666666;
        font-weight: 500;
        border: none;
        float: left;
        width: 84px;
        text-align: center;
        height: 48px;
      }

      .product__details__button {
        overflow: hidden;
        margin-bottom: 25px;
      }

      .product__details__button .cart-btn {
        display: inline-block;
        font-size: 14px;
        color: #ffffff;
        background: #ca1515;
        font-weight: 600;
        text-transform: uppercase;
        padding: 14px 30px 15px;
        border-radius: 50px;
        float: left;
        margin-right: 10px;
        margin-bottom: 10px;
      }

      .product__details__button ul {
        float: left;
      }

      .product__details__button ul li {
        list-style: none;
        display: inline-block;
        margin-right: 5px;
      }

      .product__details__button ul li:last-child {
        margin-right: 0;
      }

      .product__details__button ul li a {
        display: inline-block;
        height: 50px;
        width: 50px;
        border: 1px solid #ebebeb;
        border-radius: 50%;
        line-height: 50px;
        text-align: center;
        padding-top: 1px;
      }

      .product__details__button ul li a span {
        font-size: 18px;
        color: #666666;
      }

      .product__details__widget {
        border-top: 1px solid #ebebeb;
        padding-top: 35px;
      }

      .product__details__widget ul li {
        list-style: none;
        margin-bottom: 10px;
      }

      .product__details__widget ul li:last-child {
        margin-bottom: 0;
      }

      .product__details__widget ul li span {
        display: inline-block;
        font-size: 14px;
        font-weight: 600;
        color: #111111;
        width: 150px;
        float: left;
      }

      .product__details__widget ul li .stock__checkbox {
        overflow: hidden;
      }

      .product__details__widget ul li .stock__checkbox label {
        display: block;
        padding-left: 20px;
        font-size: 14px;
        color: #666666;
        position: relative;
        cursor: pointer;
      }

      .product__details__widget ul li .stock__checkbox label input {
        position: absolute;
        visibility: hidden;
      }

      .product__details__widget ul li .stock__checkbox label input:checked~.checkmark {
        border-color: #ca1515;
      }

      .product__details__widget ul li .stock__checkbox label input:checked~.checkmark:after {
        border-color: #ca1515;
        opacity: 1;
      }

      .product__details__widget ul li .stock__checkbox label .checkmark {
        position: absolute;
        left: 0;
        top: 5px;
        height: 10px;
        width: 10px;
        border: 1px solid #444444;
        border-radius: 2px;
      }

      .product__details__widget ul li .stock__checkbox label .checkmark:after {
        position: absolute;
        left: 0px;
        top: -2px;
        width: 11px;
        height: 5px;
        border: solid #ffffff;
        border-width: 1.5px 1.5px 0px 0px;
        -webkit-transform: rotate(127deg);
        -ms-transform: rotate(127deg);
        transform: rotate(127deg);
        opacity: 0;
        content: "";
      }

      .product__details__widget ul li .color__checkbox label {
        display: inline-block;
        cursor: pointer;
        position: relative;
        margin-right: 20px;
      }

      .product__details__widget ul li .color__checkbox label.active input~.checkmark:after {
        border-color: #ffffff;
        opacity: 1;
      }

      .product__details__widget ul li .color__checkbox label:last-child {
        margin-right: 0;
      }

      .product__details__widget ul li .color__checkbox label input {
        position: absolute;
        visibility: hidden;
      }

      .product__details__widget ul li .color__checkbox label input:checked~.checkmark:after {
        border-color: #ffffff;
        opacity: 1;
      }

      .product__details__widget ul li .color__checkbox label .checkmark {
        position: absolute;
        left: 0;
        top: -10px;
        height: 20px;
        width: 20px;
        background: #e31e2f;
        border-radius: 50%;
        content: "";
      }

      .product__details__widget ul li .color__checkbox label .checkmark.black-bg {
        background: #111111;
      }

      .product__details__widget ul li .color__checkbox label .checkmark.grey-bg {
        background: #e4aa8b;
      }

      .product__details__widget ul li .color__checkbox label .checkmark:after {
        position: absolute;
        left: 3px;
        top: 5px;
        width: 13px;
        height: 6px;
        border: solid #ffffff;
        border-width: 1.5px 1.5px 0px 0px;
        -webkit-transform: rotate(127deg);
        -ms-transform: rotate(127deg);
        transform: rotate(127deg);
        opacity: 0;
        content: "";
      }

      .product__details__widget ul li .size__btn label {
        font-size: 14px;
        color: #666666;
        text-transform: uppercase;
        cursor: pointer;
        margin-right: 10px;
        display: inline-block;
        margin-bottom: 0;
      }

      .product__details__widget ul li .size__btn label:last-child {
        margin-right: 0;
      }

      .product__details__widget ul li .size__btn label.active {
        color: #ca1515;
      }

      .product__details__widget ul li .size__btn label input {
        position: absolute;
        visibility: hidden;
      }

      .product__details__widget ul li p {
        margin-bottom: 0;
        color: #666666;
      }

      .product__details__tab {
        padding-top: 80px;
        margin-bottom: 65px;
      }
      </style>';
        $return["js"] = '
    <LOAD-JS></LOAD-JS>
    <script>
    
     $(".product__details__pic__slider").owlCarousel({
        loop: false,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<i class=\'arrow_carrot-left\'></i>","<i class=\'arrow_carrot-right\'></i>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false,
        mouseDrag: false,
        startPosition: \'URLHash\'
    }).on(\'changed.owl.carousel\', function(event) {
        var indexNum = event.item.index + 1;
        product_thumbs(indexNum);
    });

    function product_thumbs (num) {
        var thumbs = document.querySelectorAll(\'.product__thumb a\');
        thumbs.forEach(function (e) {
            e.classList.remove("active");
            if(e.hash.split("-")[1] == num) {
                e.classList.add("active");
            }
        })
    }
                          function update_stok(){
           $.ajax({

            type: "get",
            dataType: "html",
            data: {
              "first": link_route,
              "link_route": $("#load_link_route").val(),
              "frameworksubdomain": $("#load_domain").val(),
              "apps": "Ecommerce",
              "page_view": "update_stok",
              "type": "update_stok",
              "id": $("#load_id").val(),
            
            
              "contentfaiframework": "get_pages",
              "MainAll": 2
            },
            url: link_route,
            dataType: "html",
            success: function (responseData) {
              
              

            }
          });
        }
        function clearance_produk(){
           $.ajax({

            type: "get",
            dataType: "html",
            data: {
              "first": link_route,
              "link_route": $("#load_link_route").val(),
              "frameworksubdomain": $("#load_domain").val(),
              "apps": "Ecommerce",
              "page_view": "clearance_produk",
              "type": "update_stok",
              "id": $("#load_id").val(),
            
            
              "contentfaiframework": "get_pages",
              "MainAll": 2
            },
            url: link_route,
            dataType: "html",
            success: function (responseData) {
              
              

            }
          });
        }
        $(document).ready(function(){
          update_stok();
          clearance_produk();
        
        });
    </script>    ';
        $return["html"] = '<section class="product-details spad">
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
						<VARIAN></VARIAN>
            <div>Stok : <span id="stok_barang"> <STOK-BARANG></STOK-BARANG> </span></div>
                        <div class="product__details__button">
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="pro-qty">
                                    <input type="text" value="1"  id="set_qty" max="<STOK-BARANG></STOK-BARANG>">
                                </div>
                                </div>
                                <div>
                                <a href="#" class="cart-btn" onclick="add_cart()"><span class="icon_bag_alt"></span> Tambahkan ke cart</a>
                                </div>
                            <!-- 
							<ul>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                            </ul>
							-->
                        </div>
						
						
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
    ';
        return $return;
    }
}
