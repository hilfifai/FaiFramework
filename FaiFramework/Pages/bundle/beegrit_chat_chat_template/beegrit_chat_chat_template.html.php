<div class="container-fluid">
<div class="card chat-layout">
<div class="row g-0">
<div class="col-xxl-3 col-xl-4 col-md-12 col-12 border-end">
<div class="h-100">
<!-- chat list -->
<div class="chat-window">
<div class="chat-sticky-header sticky-top">
  <div class="px-4 pt-3 pb-4">
      <!-- heading -->
      <div class="d-flex justify-content-between align-items-center">
          <div>
              <h1 class="mb-0  h3">Chat</h1>
          </div>
          <!-- new chat dropdown -->
          <div>
              <a href="#!" class="btn btn-primary rounded-circle btn-icon texttooltip" data-template="newchat" data-bs-toggle="modal" data-bs-target="#newchatModal">
                  <i data-feather="edit" class="icon-xs"></i>
                  <div id="newchat" class="d-none">
                      <span>New Chat</span>
                  </div>
              </a>
              <span class="dropdown dropstart">
                  <a href="#!" class="btn btn-light btn-icon rounded-circle " id="settingLink" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i data-feather="settings" class="icon-xxs"></i></a>
                  <span class="dropdown-menu" aria-labelledby="settingLink">
                      <a class="dropdown-item" href="#!">Setting</a>
                      <a class="dropdown-item" href="#!">Help and Feedback</a>
                  </span>
              </span>
          </div>
      </div>
      <!-- search -->
      <div class="mt-4 mb-4">
          <input type="search" class="form-control" placeholder="Search people, group and messages">
      </div>
      <!-- User chat -->

      <div class="d-flex justify-content-between align-items-center">
          <!-- media -->
          <a href="#!" class="text-inherit">
              <div class="d-flex">
                  <div class="avatar avatar-md avatar-indicators avatar-online">
                      <img src="../assets/images/avatar/avatar-11.jpg" alt="Image" class="rounded-circle">
                  </div>
                  <!-- media body -->
                  <div class=" ms-2">
                      <h5 class="mb-0">Jitu Chauhan</h5>
                      <p class="mb-0 text-muted">Online</p>
                  </div>
              </div>
          </a>
          <!-- dropdown -->
          <div class="dropdown dropstart">
              <a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle" id="userSetting" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="more-horizontal" class="icon-xs"></i></a>
              <ul class="dropdown-menu" aria-labelledby="userSetting">
                  <li class="dropdown-animation dropdown-submenu dropdown-toggle-none">
                      <a class="dropdown-item dropdown-toggle" href="#!" aria-haspopup="true" aria-expanded="false" data-bs-toggle="dropdown">
                          <i class=" dropdown-item-icon" data-feather="circle"></i>Status
                      </a>
                      <ul class="dropdown-menu dropdown-menu-xs">
                          <li>
                              <a class="dropdown-item" href="#!">
                                  <span class="badge-dot bg-success me-2"></span>Online
                              </a>
                          </li>
                          <li>
                              <a class="dropdown-item" href="#!">
                                  <span class="badge-dot bg-secondary me-2"></span>Offline
                              </a>
                          </li>
                          <li>
                              <a class="dropdown-item" href="#!">
                                  <span class="badge-dot bg-warning me-2"></span>Away
                              </a>
                          </li>
                          <li>
                              <a class="dropdown-item" href="#!">
                                  <span class="badge-dot bg-danger me-2"></span>Busy
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li>
                      <a class="dropdown-item" href="#!"><i class=" dropdown-item-icon" data-feather="settings"></i>Setting</a>
                  </li>
                  <li>
                      <a class="dropdown-item" href="#!"><i class=" dropdown-item-icon" data-feather="user"></i>Profile</a>
                  </li>
                  <li>
                      <a class="dropdown-item" href="#!"><i class=" dropdown-item-icon" data-feather="power"></i>Sign Out</a>
                  </li>
              </ul>
          </div>
      </div>
  </div>
  <!-- nav tabs-->

  <ul class="nav nav-line-bottom" id="tab" role="tablist">
      <!-- nav item -->
      <li class="nav-item">
          <a class="nav-link active py-2" id="recent-tab" data-bs-toggle="pill" href="#recent" role="tab" aria-controls="recent" aria-selected="true">Recent</a>
      </li>
      <!-- nav item -->
      <li class="nav-item">
          <a class="nav-link py-2" id="contact-tab" data-bs-toggle="pill" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Contact</a>
      </li>
  </ul>

</div>
<div data-simplebar style="height: 600px; overflow: auto;">
  <!-- tab content -->
  <div class="tab-content" id="tabContent">
      <!-- tab pane -->
      <div class="tab-pane fade show active" id="recent" role="tabpanel" aria-labelledby="recent-tab">
          <!-- contact list -->
          <ul class="list-unstyled contacts-list" id="list_chat_room">
          </ul>
      </div>
      <!-- tab pane -->
      <div class="tab-pane" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <ul class="list-unstyled">
              <!-- list -->
              <li>
                  <div class="bg-light py-1 px-4 border-bottom ">
                      F
                  </div>
                  <a href="#!" class="text-inherit">
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 border-bottom chat-item">
                          <!-- media -->
                          <div class="d-flex position-relative">
                              <div class="avatar avatar-md avatar-indicators avatar-online">
                                  <img src="../assets/images/avatar/avatar-2.jpg" alt="Image" class="rounded-circle">
                              </div>

                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Fatima Darbar</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Online
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center py-3 px-4  chat-item">

                          <!-- media -->
                          <div class="d-flex position-relative">
                              <div class="avatar avatar-md avatar-indicators avatar-offline">
                                  <img src="../assets/images/avatar/avatar-6.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <div class="avatar avatar-sm avatar-primary position-absolute mt-3 ms-n2">
                                  <span class="avatar-initials rounded-circle fs-6">DU</span>
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Figma Design Group</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Offline
                                  </p>
                              </div>
                          </div>
                      </div>
                  </a>
              </li>
              <!-- list -->
              <li>
                  <div class="bg-light py-1 px-4 border-bottom border-top  text-dark">
                      J
                  </div>
                  <a href="#!" class="text-inherit">
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 border-bottom  chat-item">
                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-away">
                                  <img src="../assets/images/avatar/avatar-19.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Jamarcus Streich</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Away
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 chat-item">

                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-away">
                                  <img src="../assets/images/avatar/avatar-21.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Jasmin Poicha</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Away
                                  </p>
                              </div>
                          </div>
                      </div>
                  </a>
              </li>
              <!-- list -->
              <li>
                  <div class="bg-light py-1 px-4 border-bottom border-top  text-dark">
                      O
                  </div>
                  <a href="#!" class="text-inherit">
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 border-bottom chat-item">
                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-online">
                                  <img src="../assets/images/avatar/avatar-2.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Olivia Cooper</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Feeling Happy
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 chat-item">

                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-busy">
                                  <img src="../assets/images/avatar/avatar-12.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Oswal Baug</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Busy
                                  </p>
                              </div>
                          </div>
                      </div>
                  </a>
              </li>
              <!-- list -->
              <li>
                  <div class="bg-light py-1 px-4 border-bottom border-top  text-dark">
                      P
                  </div>
                  <a href="#!" class="text-inherit">
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 chat-item">

                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-online">
                                  <img src="../assets/images/avatar/avatar-5.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Pete Martin</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Online
                                  </p>
                              </div>
                          </div>
                      </div>
                  </a>
                  <a href="#!" class="text-inherit">
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 chat-item">

                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-online">
                                  <img src="../assets/images/avatar/avatar-11.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Kancha China</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Offline
                                  </p>
                              </div>
                          </div>
                      </div>
                  </a>
              </li>
              <!-- list -->
              <li>
                  <div class="bg-light py-1 px-4 border-bottom border-top  text-dark">
                      S
                  </div>
                  <a href="#!" class="text-inherit">

                      <div class="d-flex justify-content-between align-items-center py-3 px-4 chat-item">
                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-online">

                                  <div class="d-flex justify-content-between align-items-center py-3 px-4">
                                      <!-- media -->
                                      <div class="d-flex">
                                          <div class="avatar avatar-md avatar-indicators avatar-online">

                                              <img src="../assets/images/avatar/avatar-4.jpg" alt="Image" class="rounded-circle">
                                          </div>
                                          <!-- media body -->
                                          <div class=" ms-2">

                                              <h5 class="mb-0">Sharad Mishra
                                              </h5>

                                              <p class="mb-0 text-muted text-truncate">
                                                  Busy
                                              </p>
                                          </div>
                                      </div>
                                  </div>
                  </a>
                  <a href="#!" class="text-inherit">
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 chat-item">

                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-online">
                                  <img src="../assets/images/avatar/avatar-8.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Sarita Nigam</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Busy
                                  </p>
                              </div>
                          </div>
                      </div>
                  </a>
              </li>
              <!-- list -->
              <li>
                  <div class="bg-light py-1 px-4 border-bottom border-top  text-dark">
                      T
                  </div>
                  <a href="#!" class="text-inherit">
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 chat-item">

                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-online">
                                  <img src="../assets/images/avatar/avatar-3.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Tanya Davias</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Offline
                                  </p>
                              </div>
                          </div>
                      </div>
                  </a>
                  <a href="#!" class="text-inherit">
                      <div class="d-flex justify-content-between align-items-center py-3 px-4 chat-item">

                          <!-- media -->
                          <div class="d-flex">
                              <div class="avatar avatar-md avatar-indicators avatar-online">
                                  <img src="../assets/images/avatar/avatar-5.jpg" alt="Image" class="rounded-circle">
                              </div>
                              <!-- media body -->
                              <div class=" ms-2">
                                  <h5 class="mb-0">Tushar Mishra</h5>
                                  <p class="mb-0 text-muted text-truncate">
                                      Offline
                                  </p>
                              </div>
                          </div>
                      </div>
                  </a>
              </li>
          </ul>
      </div>
  </div>
</div>
</div>
</div>
</div>


<div class="col-xxl-9 col-xl-8 col-md-12 col-12">
<!-- chat list -->
<div class="chat-body w-100 h-100">
<div id="contentMassage">

<div class="card-body" data-simplebar="" style="height: 650px; overflow:auto">
  <div class=" text-center" style="padding: 150px;">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="width: 100px ; height: 100px">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
          <line x1="8" y1="9" x2="16" y2="9" />
          <line x1="8" y1="13" x2="14" y2="13" />
      </svg>
      <div class="text-muted" style="padding: 20px; font-size:14px">
          Start New Massangger
      </div>
  </div>
</div>
</div>


</div>
</div>
</div>
</div>

<div class="modal fade" id="newchatModal" tabindex="-1" role="dialog" aria-labelledby="newchatModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered " role="document">
<div class="modal-content ">
<div class="modal-header align-items-center">
<h4 class="mb-0" id="newchatModalLabel">Buat Room</h4>
<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

</button>
</div>
<div class="modal-body px-0">
<!-- contact list -->
<ul class="list-unstyled contacts-list mb-0" id="list_buat_chat_room">
</ul>
</div>

</div>
</div>
</div>
<script>
function get_chat_list(limit_start) {

$.ajax({
type: "get",
data: {

"id": -1,
"apps": $("#load_apps").val(),
"page_view": $("#load_page_view").val(),
"type": "list_chat_room",
"contentfaiframework": "pages",
"MainAll": 2
},
url: $("#load_link_route").val(),
dataType: "html",
success: function(data) {


$("#list_chat_room").html(data);

},
error: function(error) {
console.log("error; " + eval(error));
//alert(2);
}
});

}

function list_buat_chat_room(limit_start) {

$.ajax({
type: "get",
data: {

"id": -1,
"apps": $("#load_apps").val(),
"page_view": $("#load_page_view").val(),
"type": "list_buat_chat_room",
"contentfaiframework": "pages",
"MainAll": 2
},
url: $("#load_link_route").val(),
dataType: "html",
success: function(data) {


$("#list_buat_chat_room").html(data);

},
error: function(error) {
console.log("error; " + eval(error));
//alert(2);
}
});

}
function to_chat_room(id) {

$.ajax({
type: "get",
data: {

"id": id,
"apps": $("#load_apps").val(),
"page_view": $("#load_page_view").val(),
"type": "to_chat_room",
"contentfaiframework": "pages",
"MainAll": 2
},
url: $("#load_link_route").val(),
dataType: "html",
success: function(data) {


$("#contentMassage").html(data);
setTimeout(function(){  document.getElementById("list_pesan").scrollTop=document.getElementById("list_pesan").scrollHeight ; }, 1000);

},
error: function(error) {
console.log("error; " + eval(error));
//alert(2);
}
});

}
function get_new_pesan(id) {

$.ajax({
type: "get",
data: {

"id": id,
"apps": $("#load_apps").val(),
"page_view": $("#load_page_view").val(),
"type": "list_pesan",
"contentfaiframework": "pages",
"MainAll": 2
},
url: $("#load_link_route").val(),
dataType: "html",
success: function(data) {


$("#list_pesan").html(data);
document.getElementById("list_pesan").scrollIntoView(); 
},
error: function(error) {
console.log("error; " + eval(error));
//alert(2);
}
});

}
function kirim_pesan(id) {

$.ajax({
type: "get",
data: {

"id": id,
"apps": $("#load_apps").val(),
"page_view": $("#load_page_view").val(),
"pesan": $("#chat-input").val(),
"type": "kirim_pesan",
"contentfaiframework": "pages",
"MainAll": 2
},
url: $("#load_link_route").val(),
dataType: "html",
success: function(data) {
$("#chat-input").val("");
get_new_pesan(id);
setTimeout(function(){  document.getElementById("list_pesan").scrollTop=document.getElementById("list_pesan").scrollHeight ; }, 1000);


},
error: function(error) {
console.log("error; " + eval(error));
//alert(2);
}
});

}


//


list_buat_chat_room(0);
get_chat_list(0);

document.getElementById("contentMassage").onscroll = function() {

if (document.getElementById("contentMassage").scrollTop < 200) {

//get_chat_content(LContent,ContentId);
document.getElementById("contentMassage").scrollIntoView();
}

};
</script>