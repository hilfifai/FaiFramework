
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<div id="popup" onclick="closePopup(event)" style="display: none;">
    <div class="zoom-controls">
        <button class="zoom-btn" type="button" onclick="zoomIn(event)">🔍＋</button>
        <button class="zoom-btn" type="button" onclick="zoomOut(event)">🔍－</button>
    </div>
    <span class="popup-close" onclick="closePopup()">×</span>
    <img id="popup-img" src="" alt="Popup Gambar"
        style="transform: scale(3.2) translate(0px); transform-origin: 60.6748% 58.3089% 0px;">

</div>

<body>
    <div id="app"><div id="loader-overlay visible" style="display: flex;justify-content: center;vertical-align: middle;align-content: center;align-items: center;align-self: center;margin-top: 15%;"><div class="loader-spinner visible"></div> </div><br><div style="display: flex;justify-content: center;vertical-align: middle;align-content: center;align-items: center;align-self: center;" >Proses Menyusun Konten, Tunggu Sebentar...</div></div>
    <div id="jsscript"></div> 
    <div id="snackbar-container">
        <div id="snackbar">
            <div id="classType" class="" role="alert">   
                <div class="d-flex">
                    <div id="svg_content">
                        
                    </div>
                    <div id="pesan"></div>
                </div>
                <a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
        </div>
    </div>