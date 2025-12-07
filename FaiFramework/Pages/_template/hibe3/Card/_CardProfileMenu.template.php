<div class="container-fluid wallet-card-section pt-1">
    <div class="wallet-card">
        <!-- Balance -->
        <div class="balance">
            <div class="left">
                
                <h1 class="total">
                    <PROFILE-TITLE></PROFILE-TITLE>
                </h1>
                <span class="title">
                    <PROFILE-SUBTITLE></PROFILE-SUBTITLE>
                </span>
                <span class="text-muted">
                    <PROFILE-DESCRIBE></PROFILE-DESCRIBE>
                </span>
            </div>
            <div class="right">
                <a href="#" class="button" data-toggle="modal" data-target="#depositActionSheet">
                    <ion-icon name="add-outline"></ion-icon>
                </a>
            </div>
        </div>
        <!-- * Balance -->
        <!-- Wallet Footer -->
        <div class="wallet-footer">
            <LIST-MENU></LIST-MENU>


        </div>
        <!-- * Wallet Footer -->
    </div>
    <FILTER></FILTER>

    <div class="content-main">
        <PRELIST></PRELIST>

        <div id="contentList">
            <MAINLOADDATA></MAINLOADDATA>
        </div>


    </div>
</div>