<?php

class AuthContent
{

    public static function login_page_1($page, $type = -1)
    {
        $template = [];

        $set_type = "login";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::login_page_1($page);
            $template[$set_type]['array'][] = ["TOP", 'AuthContent', 'login_page_1', "top"];
            $template[$set_type]['array'][] = ["TITLE", 'AuthContent', 'login_page_1', "title"];
            $template[$set_type]['array'][] = ["FORM-CONTENT", 'AuthContent', 'login_page_1', "form_content"];
            $template[$set_type]['array'][] = ["FOOTERCONTENT", 'AuthContent', 'login_page_1', "footer_content"];
        }
        $set_type = "daftar_step_1";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content'] = Bundlecontent::login_page_1($page);
            $template[$set_type]['array'][] = ["TOP", 'AuthContent', 'login_page_1', "top"];
            $template[$set_type]['array'][] = ["TITLE", 'AuthContent', 'login_page_1', "title"];
            $template[$set_type]['array'][] = ["FORM-CONTENT", 'AuthContent', 'login_page_1', "form_content"];
            $template[$set_type]['array'][] = ["FOOTERCONTENT", 'AuthContent', 'login_page_1', "footer_content"];
        }





        $set_type = "top";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']["html"] = '<div class="row justify-content-center">
										
										<div class="col-lg-5 text-center mx-auto">
										<img src = "<LOGO></LOGO>" style="width:150px">
												<h1 class=" mb-2 mt-5">Welcome!</h1>
												<p class="text-lead ">Welcome to <META-TITLE></META-TITLE></p>
											</div>
										</div>';
            $template[$set_type]['array'][] = ["LOGO", 'bundle', 'logo'];
            $template[$set_type]['array'][] = ["META-TITLE", 'bundle', 'meta_tile'];
        }
        $set_type = "title";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']["html"] = '<h3 class="mb-2 text-center">LOGIN</h3><p class="mb-4 text-center"></p>';
        }
        $set_type = "form_content";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']["html"] = '<div class="mb-4 mt-3 fv-plugins-icon-container">
              <label for="email" class="form-label">Email or Username</label>
              <input id="usermail" type="text" class="form-control " name="username" value="" required autocomplete="username" autofocus placeholder="Username/Email">
                          
            
            </div>
            
            
            <div class="mb-5 form-password-toggle fv-plugins-icon-container">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
                
              </div>
              <div class="input-group input-group-merge has-validation">
                 <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password" placeholder="Password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>  
                    <span class="input-group-text cursor-pointer" onclick="show_password()"><i class="bx bx-hide"></i></span>
              </div>
            </div>
            
            <div class="mb-3">
              <button class="btn bg-gradient-success w-100" type="button" onclick="check_login_js()">Sign in</button>
            </div>
            <script>
            function show_password(){
                 var input = $("#password").val();
                  if (input.attr("type") == "password") {
                    input.attr("type", "text");
                  } else {
                    input.attr("type", "password");
                  }
            }
            </script>';
        }

        $set_type = "footer_content";
        if ($type == -1 or $type == $set_type) {
            $template[$set_type]['content']["html"] = '<div class="text-center">

                Belum punya akun?<br>
                <b>
                    <a href="<BE3-LINK-REGISTER></BE3-LINK-REGISTER>" class="text-center">

                        Daftar
                    </a>
                </b>
            </div> ';
            $template[$set_type]['array'][] = ["BE3-LINK-REGISTER", 'bundle', 'meta_tile'];
        }
        // $set_type = "sidebar";
        // if ($type == -1 or $type == $set_type) {
        //     $template[$set_type]['content'] = Bundlecontent::finapp___sidebarpage($page);

        // }
        return $template;
    }
}
