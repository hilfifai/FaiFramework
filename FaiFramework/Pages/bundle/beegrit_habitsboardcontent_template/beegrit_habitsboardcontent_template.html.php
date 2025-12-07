<div class="habist p-0">
<div class="header" style="border-bottom: 0;">


<div class="user-info p-5 ">
<POSTER></POSTER>
<img alt="Profile picture of Alexander Arnold" height="50" style="border-radius:10px" src="https://storage.googleapis.com/a1aa/image/vo3t1Je6hQycUS4Mw3N86CJlDDjiGXITWeekduag7Rs6zTWnA.jpg" width="50" />
<div class="details">
<h4>
<NAMA></NAMA>

</h4>
<p>
<style>

</style>
<div class="avatars">
<a href="#" class="avatars__item avat"><img class="avatar" src="https://randomuser.me/api/portraits/women/65.jpg" alt=""></a>
<a href="#" class="avatars__item"><img class="avatar" src="https://randomuser.me/api/portraits/men/25.jpg" alt=""></a>
<a href="#" class="avatars__item"><img class="avatar" src="https://randomuser.me/api/portraits/women/25.jpg" alt=""></a>
<a href="#" class="avatars__item"><img class="avatar" src="https://randomuser.me/api/portraits/men/55.jpg" alt=""></a>
<a href="#" class="avatars__item"><img class="avatar" src="https://via.placeholder.com/300/09f/fff.png" alt=""></a>
</div>
</p>
<p>
Panel User
</p>
</div>
</div>
</div>
<div class="tabs pb-3" style="border-bottom:1px solid var(--dashui-border-color);  margin-bottom: 20px;">

<input type="radio" id="radio-1" name="tabs" checked onclick="opentab('overview')" />
<label class="tab" for="radio-1">Overview<span class="notification">2</span></label>
<input type="radio" id="radio-2" name="tabs" onclick="opentab('role')" />
<label class="tab" for="radio-2">Role</label>
<input type="radio" id="radio-3" name="tabs" onclick="opentab('anggota')" />
<label class="tab" for="radio-3">Anggota</label>
<input type="radio" id="radio-6" name="tabs" onclick="opentab('list_amalan')" />
<label class="tab" for="radio-6">List Amalan</label>
<input type="radio" id="radio-4" name="tabs" onclick="opentab('muktabaah')" />
<label class="tab" for="radio-4">Muktabaah Yaumiyah</label>
<input type="radio" id="radio-5" name="tabs" onclick="opentab('leaderboard')" value="Leaderboard" />
<label class="tab" for="radio-5">Leaderboard</label>
<input type="radio" id="radio-7" name="tabs" onclick="opentab('setting')" value="Setting" />
<label class="tab" for="radio-7">Setting</label>
<span class="glider"></span>
</div>
<script>
function opentab(tab) {
$(".tab-pane").removeClass("show active");
$("#" + tab).addClass("show active");
}
</script>

<div class="main p-5 pt-0 " style="padding-top: 0px !important;" id="main-board_amalan">
<div class="tab-content" id="myTabContent">
<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">Konten Overview</div>
<div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab">Konten Role</div>
<div class="tab-pane fade" id="anggota" role="tabpanel" aria-labelledby="anggota-tab">
<div style="font-size:16px;font-weight:700">Menunggu Persetujuan</div>

<div class="row">
<LIST-ANGGOTAMENUNGGU></LIST-ANGGOTAMENUNGGU>
</div>

<div style="font-size:16px;font-weight:700">Daftar Anggota</div>
<button class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#exampleModal">Tambah</button>
<div class="row">
<LIST-ANGGOTA></LIST-ANGGOTA>
</div>
</div>
<div class="tab-pane fade" id="list_amalan" role="tabpanel" aria-labelledby="muktabaah-tab">
<LIST-AMALAN></LIST-AMALAN>

</div>
<div class="tab-pane fade" id="muktabaah" role="tabpanel" aria-labelledby="muktabaah-tab">
<MUKTABAAH></MUKTABAAH>

</div>
<div class="tab-pane fade" id="leaderboard" role="tabpanel" aria-labelledby="leaderboard-tab">Konten Leaderboard</div>
<div class="tab-pane fade" id="setting" role="tabpanel" aria-labelledby="setting-tab">
<div class="card">
<div class="info">
 <img alt="Profile picture of Jerome Bellingham" height="60" src="https://storage.googleapis.com/a1aa/image/VaI0l8gyyY4xPdpcDylFAaV8c0eFcQT2mezXdaH5Ulk75JrTA.jpg" width="60" />
 <div class="details">
     <h4>
         Jerome Bellingham
     </h4>
     <p>
         Joined Since : 12 March 2023
     </p>
     <div class="badge">
         MEMBER
     </div>
 </div>
</div>
<h3>
 Basic Informational
</h3>
<div class="details">
 <div class="item">
     <i class="fas fa-male">
     </i>
     <p>
         Gender
     </p>
     <p class="value">
         Male
     </p>
 </div>
 <div class="item">
     <i class="fas fa-birthday-cake">
     </i>
     <p>
         Birthday
     </p>
     <p class="value">
         12 August 2001
     </p>
 </div>
 <div class="item">
     <i class="fas fa-phone">
     </i>
     <p>
         Phone Number
     </p>
     <p class="value">
         +62 837 356 343 23
     </p>
 </div>
</div>
</div>
</div>
</div>



</head>

<body>



<script>
function toggleAlarm(icon) {
// Toggle kelas "active" untuk ikon
icon.classList.toggle("active");

// Tampilkan atau sembunyikan form waktu alarm
const timeInput = icon.nextElementSibling.nextElementSibling;
timeInput.style.display = timeInput.style.display === "none" ? "inline-block" : "none";
}
</script>

<style>
.toggle-container {

align-items: center;
margin-bottom: 20px;
width: 100%;
background: #e6eef9;
padding: 10px;
border-radius: 10px;
}


.switch {
position: relative;
display: inline-block;
width: 60px;
height: 34px;
margin-right: 10px;
}

.switch input {
opacity: 0;
width: 0;
height: 0;
}

.slider {
position: absolute;
cursor: pointer;
top: 0;
left: 0;
right: 0;
bottom: 0;
background-color: #ccc;
transition: .4s;
border-radius: 34px;
}

.slider:before {
position: absolute;
content: "";
height: 26px;
width: 26px;
left: 4px;
bottom: 4px;
background-color: white;
transition: .4s;
border-radius: 50%;
}

input:checked+.slider {
background-color: #2196F3;
}

input:checked+.slider:before {
transform: translateX(26px);
}

.form-section {
display: none;
margin-top: 20px;
}
</style>
</head>

<body>


<script>
function toggleAlarmSettings() {
 const alarmSettings = document.getElementById("alarmSettings");
 const isChecked = document.getElementById("alarmToggle").checked;

 // Tampilkan atau sembunyikan pengaturan tambahan berdasarkan toggle
 if (isChecked) {
     alarmSettings.style.display = "block";
 } else {
     alarmSettings.style.display = "none";
 }
}
</script>

</body>






</div>
</div>