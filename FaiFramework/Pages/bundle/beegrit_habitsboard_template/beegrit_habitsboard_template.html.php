<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/> -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<style>
:root {
--primary-color: #185ee0;
--secondary-color: #e6eef9;
}



.containerboard {
height: 100vh;
padding: 0 70px;
}

.sidebar-habits {
width: 100%;
min-height: 100vh;
max-height: 100vh;
overflow-y: scroll;
overflow-x: hidden;
background-color: #FFFFFF;
border-right: 1px solid #E5E7EB;
padding: 20px;
}

.sidebar-habits .logo {
display: flex;
align-items: center;
margin-bottom: 20px;
}

.sidebar-habits .logo i {
font-size: 24px;
color: #3B82F6;
margin-right: 10px;
}

.sidebar-habits .menu {
list-style: none;
padding: 0;
margin: 0;
}

.sidebar-habits .menu li {
margin-bottom: 20px;
}

.sidebar-habits .menu li a {
text-decoration: none;
color: #6B7280;
display: flex;
align-items: center;
}

.sidebar-habits .menu li a i {
font-size: 20px;
margin-right: 10px;
}

.sidebar-habits .patient-queue {
margin-top: 20px;
}

.sidebar-habits .patient-queue h3 {
font-size: 16px;
font-weight: 600;
color: #111827;
margin-bottom: 10px;
}

.sidebar-habits .patient-queue .search {
display: flex;
align-items: center;
margin-bottom: 20px;
}

.sidebar-habits .patient-queue .search input {
width: 100%;
padding: 8px;
border: 1px solid #E5E7EB;
border-radius: 4px;
margin-right: 10px;
}

.sidebar-habits .patient-queue .search i {
font-size: 20px;
color: #6B7280;
}

.sidebar-habits .patient-queue .tabs {
display: flex;
justify-content: space-between;
margin-bottom: 20px;
}

.sidebar-habits .patient-queue .tabs button {
background: none;
border: none;
font-size: 14px;
color: #6B7280;
cursor: pointer;
}

.sidebar-habits .patient-queue .patient-list {
list-style: none;
padding: 0;
margin: 0;
}

.sidebar-habits .patient-queue .patient-list li {
display: flex;
align-items: center;
padding: 10px;
border: 1px solid #E5E7EB;
border-radius: 4px;
margin-bottom: 10px;
background-color: #FFFFFF;
}

.sidebar-habits .patient-queue .patient-list li img {
width: 40px;
height: 40px;
border-radius: 10px;
margin-right: 10px;
}

.sidebar-habits .patient-queue .patient-list li .info {
flex-grow: 1;
}

.sidebar-habits .patient-queue .patient-list li .info h4 {
font-size: 14px;
font-weight: 600;
color: #111827;
margin: 0;
}

.sidebar-habits .patient-queue .patient-list li .info p {
font-size: 12px;
color: #6B7280;
margin: 0;
}

.sidebar-habits .patient-queue .patient-list li .actions {
display: flex;
align-items: center;
}

.sidebar-habits .patient-queue .patient-list li .actions i {
font-size: 20px;
color: #6B7280;
cursor: pointer;
}

.habist {
flex-grow: 1;
padding: 20px;
overflow-y: auto;
}

.habist .header {
display: flex;
justify-content: space-between;
align-items: center;
margin-bottom: 20px;
}

.habist .header .breadcrumbs {
display: flex;
align-items: center;
}

.habist .header .breadcrumbs a {
text-decoration: none;
color: #3B82F6;
font-size: 14px;
margin-right: 10px;
}

.habist .header .breadcrumbs span {
font-size: 14px;
color: #6B7280;
}

.habist .header .user-info {
display: flex;
align-items: center;
}

.habist .header .user-info img {
width: 40px;
height: 40px;
border-radius: 50%;
margin-right: 10px;
}

.habist .header .user-info .details {
display: flex;
flex-direction: column;
}

.habist .header .user-info .details h4 {
font-size: 14px;
font-weight: 600;
color: #111827;
margin: 0;
}

.habist .header .user-info .details p {
font-size: 12px;
color: #6B7280;
margin: 0;
}

.habist .main {
width: 100%;
padding: 20px;
}

.habist .main .card {
background-color: #FFFFFF;
border: 1px solid #E5E7EB;
border-radius: 8px;
padding: 20px;
}

.habist .main .card h3 {
font-size: 16px;
font-weight: 600;
color: #111827;
margin-bottom: 20px;
}

.habist .main .card .info {
display: flex;
align-items: center;
margin-bottom: 20px;
}

.habist .main .card .info img {
width: 60px;
height: 60px;
border-radius: 50%;
margin-right: 20px;
}

.habist .main .card .info .details {
display: flex;
flex-direction: column;
}

.habist .main .card .info .details h4 {
font-size: 16px;
font-weight: 600;
color: #111827;
margin: 0;
}

.habist .main .card .info .details p {
font-size: 12px;
color: #6B7280;
margin: 0;
}

.habist .main .card .info .details .badge {
background-color: #10B981;
color: #FFFFFF;
font-size: 12px;
padding: 2px 8px;
border-radius: 4px;
margin-top: 5px;
}

.habist .main .card .details {
display: flex;
flex-direction: column;
gap: 10px;
}

.habist .main .card .details .item {
display: flex;
align-items: center;
}

.habist .main .card .details .item i {
font-size: 16px;
color: #6B7280;
margin-right: 10px;
}

.habist .main .card .details .item p {
font-size: 14px;
color: #111827;
margin: 0;
}

.habist .main .card .details .item .value {
font-size: 14px;
color: #6B7280;
margin-left: auto;
}

.habist .main .card .details .sources {
display: flex;
gap: 10px;
}

.habist .main .card .details .sources i {
font-size: 20px;
color: #6B7280;
}

.habist .main .card .history {
width: 100%;
border-collapse: collapse;
margin-top: 20px;
}

.habist .main .card .history th,
.habist .main .card .history td {
border: 1px solid #E5E7EB;
padding: 10px;
text-align: left;
}

.habist .main .card .history th {
background-color: #F9FAFB;
font-size: 14px;
color: #6B7280;
}

.habist .main .card .history td {
font-size: 14px;
color: #111827;
}

.habist .main .card .history .status {
display: flex;
align-items: center;
gap: 5px;
}

.habist .main .card .history .status i {
font-size: 14px;
}

.habist .main .card .history .status.pending i {
color: #F59E0B;
}

.habist .main .card .history .status.paid i {
color: #10B981;
}

.habist .main .card .assurance {
display: flex;
flex-direction: column;
align-items: center;
background: linear-gradient(135deg, #667EEA 0%, #764BA2 100%);
color: #FFFFFF;
padding: 20px;
border-radius: 8px;
margin-top: 20px;
}

.habist .main .card .assurance h4 {
font-size: 16px;
font-weight: 600;
margin: 0;
}

.habist .main .card .assurance p {
font-size: 14px;
margin: 0;
}

.habist .main .card .assurance .details {
display: flex;
justify-content: space-between;
width: 100%;
margin-top: 10px;
}

.habist .main .card .assurance .details .item {
display: flex;
flex-direction: column;
align-items: center;
}

.habist .main .card .assurance .details .item p {
font-size: 12px;
margin: 0;
}

.habist .main .card .assurance .details .item .value {
font-size: 14px;
font-weight: 600;
}

.habist .main .card .dentalica {
display: flex;
flex-direction: column;
align-items: center;
margin-top: 20px;
}

.habist .main .card .dentalica .days {
font-size: 32px;
font-weight: 600;
color: #111827;
}

.habist .main .card .dentalica .extend {
background-color: #3B82F6;
color: #FFFFFF;
padding: 10px 20px;
border: none;
border-radius: 4px;
cursor: pointer;
margin-top: 10px;
}

.habist .main .card .documents {
margin-top: 20px;
}

.habist .main .card .documents .document {
display: flex;
align-items: center;
justify-content: space-between;
padding: 10px;
border: 1px solid #E5E7EB;
border-radius: 4px;
margin-bottom: 10px;
}

.habist .main .card .documents .document i {
font-size: 20px;
color: #6B7280;
}

.habist .main .card .documents .document .info {
display: flex;
flex-direction: column;
}

.habist .main .card .documents .document .info h4 {
font-size: 14px;
font-weight: 600;
color: #111827;
margin: 0;
}

.habist .main .card .documents .document .info p {
font-size: 12px;
color: #6B7280;
margin: 0;
}


.tabs {
display: flex;
position: relative;
background-color: #fff;
box-shadow: 0 0 1px 0 rgba(#185ee0, 0.15), 0 6px 12px 0 rgba(#185ee0, 0.15);
padding: 0.75rem;
/* border-radius: 99px;  */
}

input[type="radio"] {
display: none;
}

.tab {
display: flex;
align-items: center;
justify-content: center;
height: 30px;
width: 100%;
font-size: 12px;
font-weight: 500;
cursor: pointer;
transition: color 0.15s ease-in;
}

.notification {
display: flex;
align-items: center;
justify-content: center;
width: 1.25rem;
height: 1.25rem;
margin-left: 0.75rem;
border-radius: 50%;
background-color: var(--secondary-color);
transition: 0.15s ease-in;
}

input[type="radio"]:checked+label {
color: var(--primary-color);
background: var(--secondary-color);
border-radius: 20px;
height: 40px;
color: black;
}

input[type="radio"]:checked+label>.notification {
background-color: var(--primary-color);
color: #fff;
}

@media (max-width: 700px) {
.tabs {
transform: scale(0.6);
}
}

@media (min-width: 1200px) {
.container {
max-width: 100%;
}
}


.card {

border-radius: 15px;
padding: 5px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
cursor: pointer;
transition: transform 0.3s, box-shadow 0.3s ease, background-color 0.3s ease;
}

avatars__item {
background-color: #596376;
border: 2px solid #1f2532;
border-radius: 100%;
color: #ffffff;
display: block;
font-family: sans-serif;
font-size: 12px;
font-weight: 100;
height: 25px;
width: 25px;
line-height: 45px;
text-align: center;
transition: margin 0.1s ease-in-out;
overflow: hidden;
margin-left: -10px;
}

.avatars__item img {

height: 25px !important;
width: 25px !important;
margin: 0 -7px 0 0 !important;
}

.settings {
position: relative;
height: auto;
width: 100%;
display: flex;
flex-direction: column;
}

.settings .setting {
position: relative;
width: 100%;
height: calc(65px - 10px);
background: var(--secondary-color);
border-radius: 8px;
display: flex;
align-items: center;
padding: 10px 25px;
color: #000;
margin-bottom: 8px;
}

.settings .setting input.checklist {
opacity: 0;
position: absolute;
}

.settings .setting input.checklist+label {
user-select: none;
}

.settings .setting input.checklist+label::before,
.settings .setting input.checklist+label::after {
content: "";
position: absolute;
transition: 150ms cubic-bezier(0.24, 0, 0.5, 1);
transform: translateY(-50%);
top: 50%;
right: 10px;
cursor: pointer;
}

.settings .setting input.checklist+label::before {
height: 30px;
width: 50px;
border-radius: 30px;
background: rgba(214, 214, 214, 0.434);
}

.settings .setting input.checklist+label::after {
height: 24px;
width: 24px;
border-radius: 60px;
right: 32px;
background: #fff;
}

.settings .setting input.checklist:checked+label:before {
background: #5d68e2;
transition: all 150ms cubic-bezier(0, 0, 0, 0.1);
}

.settings .setting input.checklist:checked+label:after {
right: 14px;
}

.settings .setting input.checklist:focus+label:before {
box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.75);
}

.settings .setting input.checklist:disabled+label:before,
.settings .setting input.checklist:disabled+label:after {
cursor: not-allowed;
}

.settings .setting input.checklist:disabled+label:before {
background: #4f4f6a;
}

.settings .setting input.checklist:disabled+label:after {
background: #909090;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
.alarm-icon {
color: #ccc;
font-size: 1.5em;
cursor: pointer;
margin-right: 15px;
}

.alarm-icon.active {
color: #5d68e2;
}

.alarm-time {
display: none;
margin-left: 10px;
}
</style>
</head>

<body>
<div class="containerboard">
<div class="row">
<div class="col-3" style="margin: 0;padding: 0;">

<div class="sidebar-habits">

<div class="patient-queue">
 <h3>
     Board
 </h3>
 <div class="search">
     <input placeholder="Search..." type="text" id="search_board" onkeyup="" />
     <span onclick=" get_content_board()"></span><i class="fas fa-search">
     </i>
 </div>
 <button class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#exampleModal">Tambah</button>

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Board</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                 </button>
             </div>
             <div class="modal-body">

                 <FORM-CRUD-BOARD></FORM-CRUD-BOARD>


             </div>
             <div class="modal-footer">


             </div>
         </div>
     </div>
 </div>

 <ul class="patient-list mt-3" id="content_board">


 </ul>
</div>
</div>
</div>
<div class="col-9" style="margin: 0;padding: 0;" id="content_main_board">


</div>
</div>
</div>

<script>
get_content_board()

function get_content_board() {
searchData = $("#search_board").val();
$.ajax({

type: "get",
dataType: "html",
data: {
"first": link_route,
"link_route": $("#load_link_route").val(),
"apps": "Amal",
"page_view": "board",
"type": "list_board_amalan",
"id": $("#load_id").val(),
"frameworksubdomain": $("#load_domain").val(),
"search": searchData,
"contentfaiframework": "get_pages",
"MainAll": 2
},
url: link_route,
dataType: "html",
success: function(responseData) {

$("#content_board").html(responseData);



}
});
}

function load_content_board(searchData) {
alert(searchData);
$.ajax({

type: "get",
dataType: "html",
data: {
"first": link_route,
"link_route": $("#load_link_route").val(),
"apps": "Amal",
"page_view": "board",
"type": "content_board",
"id": $("#load_id").val(),
"frameworksubdomain": $("#load_domain").val(),
"search": searchData,
"contentfaiframework": "get_pages",
"MainAll": 2
},
url: link_route,
dataType: "html",
success: function(responseData) {

$("#content_main_board").html(responseData);



}
});
}
</script>