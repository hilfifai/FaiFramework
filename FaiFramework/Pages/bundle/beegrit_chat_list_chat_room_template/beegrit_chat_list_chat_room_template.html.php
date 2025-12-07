<li class="py-3 px-4 chat-item contacts-link row" onclick="to_chat_room(<ID_CHAT></ID_CHAT>)">
<!-- contact link -->

<!-- <div class="d-flex justify-content-between align-items-center"> -->
<!-- media -->
<!-- <div class=""> -->
<div class="avatar avatar-md avatar-indicators avatar-online col-2">
<img src="../assets/images/avatar/avatar-2.jpg" alt="Image" class="rounded-circle">
</div>
<!-- media body -->
<div class=" ms-2  col-9">
<h5 class="mb-0  " style="vertical-align: middle;align-items: center;">
<NAMA-ROOM></NAMA-ROOM>
<span class="text">
<span class="icon-shape2 icon-xs text-white bg-danger  fs-6" style="padding: 2px;border-radius: 10px;"><BELUM-BACA></BELUM-BACA></span>
</span>
<small class="text-muted text-right" style="float:right"><WAKTU-LAST></WAKTU-LAST></small>
</h5>
<p class="mb-0 text-muted text-truncate">
<LAST-MESSAGE></LAST-MESSAGE>
</p>
</div>
<!-- </div> -->

<!-- </div> -->
<!-- chat action -->
<div class="chat-actions col-auto">
<!-- dropdown -->
<div class="dropdown dropstart">
<a href="#!" class="btn btn-white btn-icon btn-sm rounded-circle primary-hover" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i data-feather="more-horizontal" class="icon-xs"></i>
</a>
<div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
<a class="dropdown-item" href="#!"><i class="bi-pin-angle dropdown-item-icon"></i>Pin</a>
<a class="dropdown-item" href="#!"><i class="bi-person-x dropdown-item-icon"></i>Mute</a>
<a class="dropdown-item" href="#!"><i class="bi-eye-slash dropdown-item-icon"></i>Hide</a>
<a class="dropdown-item" href="#!"><i class="bi-person-plus dropdown-item-icon"></i>Add
to Favorite</a>
</div>
</div>
</div>
</li>