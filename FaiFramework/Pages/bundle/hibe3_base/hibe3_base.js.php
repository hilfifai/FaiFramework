
      <!-- navbar horizontal -->
      <!-- navbar -->

      <!-- Scripts -->



      <!-- Libs JS -->
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>assets/xzoom/example/js/foundation.min.js"></script>
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>assets/xzoom/example/js/setup.js"></script>
      <!-- <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/libs/jquery/dist/jquery.min.js"></script>-->
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/libs/feather-icons/dist/feather.min.js"></script>
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/libs/simplebar/dist/simplebar.min.js"></script>



      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

      <!-- popper js -->
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/libs/%40popperjs/core/dist/umd/popper.min.js"></script>
      <!-- tippy js -->
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/libs/tippy.js/dist/tippy-bundle.umd.min.js"></script>
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3//assets/js/vendors/tooltip.js"></script>
      <!-- Scripts -->
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3//assets/libs/bs-stepper/dist/js/bs-stepper.min.js"></script>
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3//assets/js/vendors/beStepper.js"></script>

      <!-- Theme JS -->
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/js/theme.min.js"></script>


      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/libs/%40popperjs/core/dist/umd/popper.min.js"></script>
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/libs/tippy.js/dist/tippy-bundle.umd.min.js"></script>
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/js/vendors/tooltip.js"></script>
      <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>hibe3/assets/js/vendors/chat.js"></script>
      <link rel="stylesheet" href="https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css">

      </body>
      <script>
        function toggleSidebar(ref) {
          document.getElementById("sidebarinLeft").classList.toggle("show-left-sidebar");
        }

        function togle_sidebar_wai() {
          let sidebar = document.querySelector(".sidebarWai");
          let openBtn = document.querySelector("#btnSidebarWAI");
          let closeBtn = document.querySelector(".btnClassClosSideBar");
          sidebar.classList.toggle("open");
          menuBtnChange();
        }

        function show_profile() {
          $("#dropdown-profile-menu").toggle(function() {
              $("#another-element").show("slide", {
                direction: "right"
              }, 1000);
            },
            function() {
              $("#another-element").hide("slide", {
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
            body.removeClass("search-show search-gone");
            if (body.hasClass("sidebar-gone")) {
              body.removeClass("sidebar-gone");
              body.addClass("sidebar-show");
            } else {
              body.addClass("sidebar-gone");
              body.removeClass("sidebar-show");
            }

            update_sidebar_nicescroll();
          } else {
            body.removeClass("search-show search-gone");
            if (body.hasClass("sidebar-mini")) {
              toggle_sidebar_mini(false);
            } else {
              toggle_sidebar_mini(true);
            }
          }

          return false;
        });
        $("[data-toggle="search"]").click(function() {
          var body = $("body");

          if (body.hasClass("search-gone")) {
            body.addClass("search-gone");
            body.removeClass("search-show");
          } else {
            body.removeClass("search-gone");
            body.addClass("search-show");
          } 
        });
        var toggleLayout = function() {
          var w = $(window),
            layout_class = $("body").attr("class") || "",
            layout_classes = (layout_class.trim().length > 0 ? layout_class.split(" ") : "");

          if (layout_classes.length > 0) {
            layout_classes.forEach(function(item) {
              if (item.indexOf("layout-") != -1) {
                now_layout_class = item;
              }
            });
          }

          if (w.outerWidth() <= 1024) {
            if ($("body").hasClass("sidebar-mini")) {
              toggle_sidebar_mini(false);
              $(".main-sidebar").niceScroll(sidebar_nicescroll_opts);
              sidebar_nicescroll = $(".main-sidebar").getNiceScroll();
            }

            $("body").addClass("sidebar-gone");
            $("body").removeClass("layout-2 layout-3 sidebar-mini sidebar-show");
            $("body").off("click").on("click", function(e) {
              if ($(e.target).hasClass("sidebar-show") || $(e.target).hasClass("search-show")) {
                $("body").removeClass("sidebar-show");
                $("body").addClass("sidebar-gone");
                $("body").removeClass("search-show");

                update_sidebar_nicescroll();
              }
            });

            update_sidebar_nicescroll();

            if (now_layout_class == "layout-3") {
              let nav_second_classes = $(".navbar-secondary").attr("class"),
                nav_second = $(".navbar-secondary");

              nav_second.attr("data-nav-classes", nav_second_classes);
              nav_second.removeAttr("class");
              nav_second.addClass("main-sidebar");

              let main_sidebar = $(".main-sidebar");
              main_sidebar.find(".container").addClass("sidebar-wrapper").removeClass("container");
              main_sidebar.find(".navbar-nav").addClass("sidebar-menu").removeClass("navbar-nav");
              main_sidebar.find(".sidebar-menu .nav-item.dropdown.show a").click();
              main_sidebar.find(".sidebar-brand").remove();
              main_sidebar.find(".sidebar-menu").before($("<div>", {
                class: "sidebar-brand"
              }).append(
                $("<a>", {
                  href: $(".navbar-brand").attr("href"),
                }).html($(".navbar-brand").html())
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

            let nav_second_classes = $(".main-sidebar").attr("data-nav-classes"),
              nav_second = $(".main-sidebar");

            if (now_layout_class == "layout-3" && nav_second.hasClass("main-sidebar")) {
              nav_second.find(".sidebar-menu li a.has-dropdown").off("click");
              nav_second.find(".sidebar-brand").remove();
              nav_second.removeAttr("class");
              nav_second.addClass(nav_second_classes);

              let main_sidebar = $(".navbar-secondary");
              main_sidebar.find(".sidebar-wrapper").addClass("container").removeClass("sidebar-wrapper");
              main_sidebar.find(".sidebar-menu").addClass("navbar-nav").removeClass("sidebar-menu");
              main_sidebar.find(".dropdown-menu").hide();
              main_sidebar.removeAttr("style");
              main_sidebar.removeAttr("tabindex");
              main_sidebar.removeAttr("data-nav-classes");
              $(".main-wrapper").addClass("container");
              // if(sidebar_nicescroll != null)
              //   sidebar_nicescroll.remove();
            } else if (now_layout_class == "layout-2") {
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
      