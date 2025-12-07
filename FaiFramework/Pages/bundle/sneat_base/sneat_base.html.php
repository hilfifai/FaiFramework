  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <div id="LoadSidebar" >
          <SIDEBAR></SIDEBAR>
      </div>
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
            <!--<div class="navbar-nav align-items-center">-->
            <!--  <div class="nav-item d-flex align-items-center">-->
            <!--    <i class="bx bx-search fs-4 lh-0"></i>-->
            <!--    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />-->
            <!--  </div>-->
            <!--</div>-->
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- Place this tag where you want the button to render. -->


              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <div class="dropdown-container-be3">
				<details class="dropdown right">
					<summary class="avatar">
						<img src="https://gravatar.com/avatar/00000000000000000000000000000000?d=mp">
					</summary>
					<ul>
						<!-- Optional: user details area w/ gray bg -->
						<li>
							<p>
								<span class="block bold"><BE3-NAMA-LENGKAP></BE3-NAMA-LENGKAP></span>
								<span class="block italic"><BE3-PANEL></BE3-PANEL></span>
							</p>
						</li>
						<!-- Menu links -->
						<li>
							<a href="#">
								 Account
							</a>
						</li>
						<li>
							<a href="#">
								 Settings
							</a>
						</li>
						<li>
							<a href="#">
								Help
							</a>
						</li>
						<!-- Optional divider -->
						<li class="divider"></li>
						<li>
							<a href="<BE3-LINK-LOGOUT></BE3-LINK-LOGOUT>"> 
								Logout
							</a>
						</li>
					</ul>
				</details>
			</div>
			
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
              <div id="contentFaiFramework">
                  <FILE-CONTENT></FILE-CONTENT>
              </div>
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

