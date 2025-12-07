<div class="habist p-0">
    <div class="header" style="border-bottom: 0;">


        <div class="user-info p-5 ">
            <img alt="Profile picture of Alexander Arnold" height="50" style="border-radius:10px" src="https://storage.googleapis.com/a1aa/image/vo3t1Je6hQycUS4Mw3N86CJlDDjiGXITWeekduag7Rs6zTWnA.jpg" width="50" />
            <div class="details">
                <h4>
                    Board Hamasah
                    <!-- <button class="btn btn-default btn-sm">Share Board</button> -->
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
                    as a Administrator
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
            $('.tab-pane').removeClass('show active');
            $('#' + tab).addClass('show active');
        }
    </script>

    <div class="main p-5 pt-0 " style="padding-top: 0px !important;" id="main-board_amalan">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">Konten Overview</div>
            <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab">Konten Role</div>
            <div class="tab-pane fade" id="anggota" role="tabpanel" aria-labelledby="anggota-tab"><button class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#exampleModal">Tambah</button>
                <div class="row">
                    <?php
                    $col_row = "col-md-3";
                    ?>
                    <div class="<?= $col_row; ?>">

                        <div class="card" id="profileCard">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
                            <h2 class="noSelect">John Doe</h2>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="<?= $col_row; ?>">
                        <div class="card" id="profileCard">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
                            <h2 class="noSelect">John Doe</h2>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="<?= $col_row; ?>">
                        <div class="card" id="profileCard">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
                            <h2 class="noSelect">John Doe</h2>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="<?= $col_row; ?>">
                        <div class="card" id="profileCard">
                            <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Profile Picture" class="noSelect">
                            <h2 class="noSelect">John Doe</h2>
                            <div class="social-icons">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="info-box" id="infoBox">
                        <h2 class="noSelect">About Me</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, quibusdam delectus? Officia optio eveniet molestias explicabo culpa quos delectus ratione laudantium. Laborum obcaecati totam quasi animi illum veritatis laboriosam veniam?
                            Quis impedit eveniet, asperiores atque neque debitis aliquid quisquam, odit itaque reprehenderit quidem! Exercitationem aperiam dolore laborum aliquam, vitae incidunt animi mollitia amet. Impedit, qui! Provident, dicta molestiae. Exercitationem, voluptates.</p>

                        <div class="pills">
                            <span class="pill">JavaScript</span>
                            <span class="pill">Python</span>
                            <span class="pill">Java</span>
                            <span class="pill">C#</span>
                            <span class="pill">HTML</span>
                            <span class="pill">CSS</span>
                            <span class="pill">SQL</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="list_amalan" role="tabpanel" aria-labelledby="muktabaah-tab">

                <div class="toggle-container">
                    <label class="switch">
                        <input type="checkbox" id="alarmToggle" onchange="toggleAlarmSettings()">
                        <span class="slider"></span>
                    </label>
                    <label for="alarmToggle">Penghidupan Alarm</label>


                    <div id="alarmSettings" class="form-section">
                        <label for="alarmTime">Jam Alarm:</label>
                        <input type="time" class="form-control" id="alarmTime" name="alarmTime"><br><br>

                        <label for="targetIdeal">Target Ideal:</label>
                        <input type="text" class="form-control" id="targetIdeal" name="targetIdeal" placeholder="Masukkan Target Ideal">
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="muktabaah" role="tabpanel" aria-labelledby="muktabaah-tab">Konten Muktabaah Yaumiyah</div>
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