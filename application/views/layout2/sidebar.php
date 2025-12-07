<?php if(isset($header_right) or isset($header) ){?>
<div class="screenB">
			<div class="pn-ProductNav_Wrapper d-flex">
				<div class="flex-start">
					<button id="pnAdvancerLeft" class="pn-Advancer pn-Advancer_Left" type="button" style="align-content: center;display: flow-root;width: heigh;height: 100%;background: #fff;width: 30px;">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="15 6 9 12 15 18" /></svg>
					</button>
				</div>
		
				<nav id="pnProductNav" class="pn-ProductNav pn-ProductNav w-100 bg-white">
					<ul  class="pn-ProductNav_Contents"  id="pnProductNavContents" class="pn-ProductNav_Contents " class="" style="background: white;margin-bottom: 0;padding-left: 0;">

						<?php
						for($i = 0;$i < count($header['nama']);$i++){


							?>
			
							<a href="<?=$header['link'][$i]?>" class="pn-ProductNav_Link" <?= $i==1?'aria-selected="true"':'';?>><?=$header['nama'][$i]?></a>
      
							<?php
						}?>
						<span id="pnIndicator" class="pn-ProductNav_Indicator"></span>

		
					</ul> 

				</nav>
				<div class="flex-end"> 
			
					<button id="pnAdvancerRight" class="pn-Advancer pn-Advancer_Right " type="button" style="align-content: center;display: flow-root;width: heigh;height: 100%;background: #fff;width: 30px;">
						<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="9 6 15 12 9 18" /></svg>  
					</button>
				</div>
				<?php

				if(isset($header_right) and $header_right!='') {
				
					for($i = 0;$i < count($header_right['icon']);$i++){
						?>
				
				
						<div class="nav-item dropdown flex-end bg-white" style="align-content: center;display: flex;">
							<a href="<?=$header_right['link'][$i]?>" class="nav-link d-flex  text-reset " <?php if(isset($header_right['sub'][$i]['nama'][0]))echo 'data-bs-toggle="dropdown"';?>  aria-label="Open user menu">
								<span class="">
									<?=$header_right['icon'][$i]?>
								</span>
							</a>
							<?php if(isset($header_right['sub'][$i]['nama'][0])){
								?>
					
								<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" style="width: 250px;">
									<?php for($j = 0;$j < count($header_right['sub'][$i]['nama']);$j++){?>
										<a href="<?=$header_right['sub'][$i]['link'][$j]?>" class="dropdown-item">
											<?=$header_right['sub'][$i]['nama'][$j]?>
										</a>
										<?php }?>
								</div>
								<?php
							}
							?>
						</div>
						</li>
						<?php
					}}?>
			</div>
			</div>
		

	<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 screenA" style="margin-top: 50px !important" data-color="success">

    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
        	<?php
							for($i = 0;$i < count($header['nama']);$i++){


								?>
								<li class="nav-item">
									<a class="nav-link <?= $header['active'][$i];?>" href="<?=$header['link'][$i]?>" >
										<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                       					<?php if(isset($header['icon'][$i])) echo $header['icon'][$i];?>
                    </div>
                  
										<span class="nav-link-title nav-link-text ms-1">
											<?=$header['nama'][$i]?> 	
										</span>
										
									</a>
								</li>

								<?php
							}
							if(isset($header_right) and $header_right!=''){
				
					for($i = 0;$i < count($header_right['icon']);$i++){
							?>
								<li class="nav-item">
									<a class="nav-link <?= $header_right['active'][$i];?>" href="<?=$header_right['link'][$i]?>" >
										<div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                       					<?php if(isset($header_right['icon'][$i])) echo $header_right['icon'][$i];?>
                    </div>
                  
										<span class="nav-link-title nav-link-text ms-1">
											<?php if(isset($header_right['nama'][$i])) echo $header_right['nama'][$i];?>
											
										</span>
										
									</a>
								</li>

								<?php
							}}?>
            
           
           
        </ul>
    </div>
    
</aside>


<main class="main-content position-relative  h-100 mt-1 border-radius-lg ">
<?php }?>