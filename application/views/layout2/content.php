<?php $this->view('layout/header');?>
<?php $this->view('layout/nav_header.php');?>
<?php $this->view('layout/sidebar'); ?>
<!-- [ Header ] end -->

		
<?php /*
if(isset($content))
//$this->view($content);
if($varcontent)
	echo $varcontent;
 */?>
 <?php
					
						$this->load->view($content);
					?>
 
	</div>
</main>

<?php $this->view('layout/nav_footer.php'); ?>
<?php  $this->view('layout/footer'); ?>
<!--   Core JS Files   -->
