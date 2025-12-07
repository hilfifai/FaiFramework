<div class="card-footer border-top-0 chat-footer mt-auto rounded-bottom">
<div class="mt-1">
<form id="chatinput-form">
<div class="position-relative">
<textarea class="form-control" placeholder="Type a New Message" id="chat-input"></textarea>
</div>
<div class="position-absolute end-0 top-0 mt-4 me-4">
<button type="button" onclick="kirim_pesan(<ID-CHAT></ID-CHAT>)" class="fs-3 btn text-primary btn-focus-none">
<i class="bi bi-send"></i>

</button>
</div>
</form>
</div>
<div class="mt-3 d-flex">
<div>
<a href="#!" class="text-inherit me-2 fs-4"><i class="bi-emoji-smile"></i></a>
<a href="#!" class="text-inherit me-2 fs-4"><i class="bi-paperclip"></i></a>
<a href="#!" class="text-inherit me-3   fs-4"><i class="bi-mic"></i></a>
</div>
<div class="dropdown">
<a href="#!" class="text-inherit fs-4" id="moreAction" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<i class="fe fe-more-horizontal"></i>
</a>
<div class="dropdown-menu" aria-labelledby="moreAction">
<a class="dropdown-item" href="#!">Action</a>
<a class="dropdown-item" href="#!">Another action</a>
<a class="dropdown-item" href="#!">Something else
here</a>
</div>
</div>
</div>
</div>