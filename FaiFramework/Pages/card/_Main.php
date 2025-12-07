<?php
//echo '<pre>';print_r($page);
if($card['listing_type'] == "listingmenu"){
        $fai->view('card/_MainListingMenu.blade.php',$page,array('card'=>$card,'type'=>$type,'id'=>$id,'nama_type'=>$nama_type,'nama_array'=>$nama_type,'array'=>$array,'this_card'=>$this_card));
}else if($card['listing_type'] == "profile-menu"){
        $fai->view('card/_MainProfilMenu.blade.php',$page,array('card'=>$card,'type'=>$type,'id'=>$id,'nama_type'=>$nama_type,'nama_array'=>$nama_type,'array'=>$array,'this_card'=>$this_card));
}else if($card['listing_type'] == "backend"){
        $fai->view('card/_MainListingMenu.blade.php',$page,array('card'=>$card,'type'=>$type,'id'=>$id,'nama_type'=>$nama_type,'nama_array'=>$nama_type,'array'=>$array,'this_card'=>$this_card));
}else{
        $fai->view('card/_MainContentCard.blade.php',$page,array('card'=>$card,'type'=>$type,'id'=>$id,'nama_type'=>$nama_type,'nama_array'=>$nama_type,'array'=>$array,'this_card'=>$this_card)); 
}
?> 