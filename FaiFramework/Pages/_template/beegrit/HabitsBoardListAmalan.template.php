<div class="toggle-container">
    <label class="switch">
        <input type="checkbox" id="alarmToggle" onchange="toggleAlarmSettings();update_amalan_board('<ID_BOARD></ID_BOARD>','<ID_LIST></ID_LIST>','<ID_TASK></ID_TASK>')" <CHECHKED></CHECHKED> >
        <span class="slider"></span>
    </label>
    <label for="alarmToggle"><NAMA-AMALAN></NAMA-AMALAN></label>
    <div id="alarmSettings" class="form-section row">
        <label for="alarmTime" class="col-4">Jam Deadline:</label>
        <div class="col-8">

        <input
            type="time"
            class="form-control"
            id="alarmTime"
            name="alarmTime"
        >
        </div>
        <br>
        <br>
        <label for="targetIdeal">Target Ideal:</label>
        <select
            type="text"
            class="form-control"
            id="targetIdeal"
            name="targetIdeal"
            placeholder="Masukkan Target Ideal"
        >
            <LIST-TARGET></LIST-TARGET>
        </select>
    </div>
</div>
