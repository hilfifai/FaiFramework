  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <!-- <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/assets/vendor/libs/jquery/jquery.js"></script> -->
  <!--<script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/assets/vendor/libs/popper/popper.js"></script>-->
  <!--<script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/assets/vendor/js/bootstrap.js"></script>-->
  <!--<script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>-->

  <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/js/apexchart.min.js"></script>
  <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/assets/vendor/js/menu.js"></script>
  <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/assets/js/main.js"></script>
  <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/js/config.js"></script>
  <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/js/main.js"></script>
  <script src="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>sneat/sneat/js/app-ecommerce-dashboard.js"></script>
  
  <script>
      function closeOpenDropdowns(e) {
	let openDropdownEls = document.querySelectorAll("details.dropdown[open]");

	if (openDropdownEls.length > 0) {
		if (e.target.parentElement.nodeName.toUpperCase() !== "SUMMARY") {
			openDropdownEls.forEach((dropdown) => {
				dropdown.removeAttribute("open");
			});
		}
	}
}

document.addEventListener("click", closeOpenDropdowns);

  </script>