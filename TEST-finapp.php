<html lang="en"><head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="title">My App</title>
    </head><body><div id="style"></div>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


    <div id="app"><link rel="stylesheet" href="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp/base/view/assets/css/style.css"><div id="loader">
    <img src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/img/logo-icon.png" alt="icon" class="loading-icon">
</div>

<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
            <ion-icon name="menu-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">
        <img src="" class="logo">
    </div>
    <div class="right">
        <a href="<LINK-MESSAGE></LINK-MESSAGE>" class="headerButton">
            <ion-icon class="icon" name="notifications-outline"></ion-icon>
            <span class="badge badge-danger">4</span>
        </a>
        <a href="<LINK-PROFIL></LINK-PROFIL>" class="headerButton">
            <img src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp/base/view/assets/img/sample/avatar/avatar1.jpg" alt="image" class="imaged w32">
            <span class="badge badge-danger">6</span>
        </a>
    </div>
</div>
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <!-- profile box -->
                <div class="profileBox pt-2 pb-2">
                    <div class="image-wrapper">
                        <img src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/img/sample/avatar/avatar1.jpg" alt="image" class="imaged  w36">
                    </div>
                    <div class="in">
                        <strong>Sebastian Doe</strong>
                        <div class="text-muted">4029209</div>
                    </div>
                    <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">
                        <ion-icon name="close-outline"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->
                <!-- balance -->
                <div class="sidebar-balance">
                    <div class="listview-title">Balance</div>
                    <div class="in">
                        <h1 class="amount">$ 2,562.50</h1>
                    </div>
                </div>
                <!-- * balance -->

                <!-- action group -->
                <div class="action-group">
                    <a href="app-index.html" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="add-outline"></ion-icon>
                            </div>
                            Deposit
                        </div>
                    </a>
                    <a href="app-index.html" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="arrow-down-outline"></ion-icon>
                            </div>
                            Withdraw
                        </div>
                    </a>
                    <a href="app-index.html" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="arrow-forward-outline"></ion-icon>
                            </div>
                            Send
                        </div>
                    </a>
                    <a href="app-cards.html" class="action-button">
                        <div class="in">
                            <div class="iconbox">
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            My Cards
                        </div>
                    </a>
                </div>
                <!-- * action group -->

                <!-- menu -->
                <div class="listview-title mt-1">Menu</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="app-index.html" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="pie-chart-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Overview
                                <span class="badge badge-primary">10</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="app-pages.html" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="document-text-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Pages
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="app-components.html" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="apps-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Components
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="app-cards.html" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="card-outline"></ion-icon>
                            </div>
                            <div class="in">
                                My Cards
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * menu -->

                <!-- others -->
                <div class="listview-title mt-1">Others</div>
                <ul class="listview flush transparent no-line image-listview">
                    <li>
                        <a href="app-settings.html" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="settings-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Settings
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="component-messages.html" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="chatbubble-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Support
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="app-login.html" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="log-out-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Log out
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * others -->

                <!-- send money -->
                <div class="listview-title mt-1">Send Money</div>
                <ul class="listview image-listview flush transparent no-line">
                    <li>
                        <a href="#" class="item">
                            <img src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/img/sample/avatar/avatar2.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Artem Sazonov</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item">
                            <img src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/img/sample/avatar/avatar4.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Sophie Asveld</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="item">
                            <img src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/img/sample/avatar/avatar3.jpg" alt="image" class="image">
                            <div class="in">
                                <div>Kobus van de Vegte</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- * send money -->

            </div>
        </div>
    </div>
</div>
<div id="appCapsule">
    
</div>

<bottom></bottom><script src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/js/lib/popper.min.js"></script>
<script src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/js/lib/bootstrap.min.js"></script>
<!-- Ionicons
<script src="https://unpkg.com/ionicons%405.0.0/dist/ionicons.js"></script>
<!-- Owl Carousel -->
<script src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
<!-- Base Js File -->
<script src="http://localhost/frameworkServer/FaiFramework/Pages/_template/finapp//base/view/assets/js/base.js"></script></div>
    <div id="jsscript"></div>
    
    

</body></html>