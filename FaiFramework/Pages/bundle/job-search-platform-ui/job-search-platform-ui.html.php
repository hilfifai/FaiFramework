<link rel="stylesheet" href="<BE3-LINK-TEMPLATE></BE3-LINK-TEMPLATE>codepen/job-search-platform-ui/dist/style.css">
<div class="wrapper-job" id="wrapper-job-<VARIABEL></VARIABEL>">
    <h3 style="text-align:center;margin:15px"><TITLE></TITLE></h3>
	<div class="search-menu" id="PRODUK-HEADER-<VARIABEL></VARIABEL>">
        <div class="search-bar">
            <input type="text" class="search-box" id="search-<VARIABEL></VARIABEL>" autofocus  />

        </div>


        <!-- <button class="search-button">Find </button> -->
    </div>
    <div class="main-container">
        <div class="search-type">
            <span id="PRODUK-SIDEBAR-<VARIABEL></VARIABEL>"></span>
        </div>

        <!-- <div class="job-overview-cards">
                    <div class="job-overview-card"> -->
        <div class="searched-jobs">
            <div class="searched-bar">
                <!-- <div class="searched-show">Showing 46 Jobs</div> -->
                <!-- <div class="searched-sort">Sort by: <span class="post-time">Newest Post </span><span class="menu-icon">▼</span></div> -->
            </div>
            <div class="job" id="job-produk">
                <div id="job-cards-produk-<VARIABEL></VARIABEL>">
                    <LIST-PRODUK></LIST-PRODUK>

                </div>
                <div class="job-explain row" style="display: none;">

                    <div class="job-logos col-md-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" style="background-color:#f76754">
                            <path xmlns="http://www.w3.org/2000/svg" d="M0 .5h4.2v23H0z" fill="#042b48" data-original="#212121"></path>
                            <path xmlns="http://www.w3.org/2000/svg" d="M15.4.5a8.6 8.6 0 100 17.2 8.6 8.6 0 000-17.2z" fill="#fefefe" data-original="#f4511e"></path>
                        </svg>
                    </div>
                    <div class="job-explain-content  col-md-8">

                        <div class="job-title-wrapper">
                            <div class="job-card-title" style="font-size: 22px;font-weight: 700;color: black;margin:10px 0"></div>
                            <div class="job-action">
                                <svg class="heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart">
                                    <path d="M20.8 4.6a5.5 5.5 0 00-7.7 0l-1.1 1-1-1a5.5 5.5 0 00-7.8 7.8l1 1 7.8 7.8 7.8-7.7 1-1.1a5.5 5.5 0 000-7.8z" />
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share-2">
                                    <circle cx="18" cy="5" r="3" />
                                    <circle cx="6" cy="12" r="3" />
                                    <circle cx="18" cy="19" r="3" />
                                    <path d="M8.6 13.5l6.8 4M15.4 6.5l-6.8 4" />
                                </svg>
                            </div>
                        </div>
                        <div class="job-subtitle-wrapper" style="background: #fafafa;padding: 20px;font-size: 20px;font-weight: 700;color: black;margin:10px 0">

                        </div>
                        <div class="job-varian">

                        </div>
                        <div class="job-stok">
                            <div class="row">
                                <div class="col-4"> <label>Stok</label></div>
                                <div class="col-8" id="stok-content"></div>
                                <div class="col-12" id='stok-content-detail' style='font-size:10px'></div>
                            </div>
                        </div>
                        <div class="job-cart">
                            <div class="product__details__button">
                                <div class="quantity">
                                    <span>Quantity:</span>
                                    <div class="pro-qty">
                                        <input type="text" value="1" id="set_qty" max="<STOK-BARANG></STOK-BARANG>">
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="cart-btn" onclick="add_cart()"><span class="icon_bag_alt"></span> Tambahkan ke cart</a>
                                </div>
                                <!--
							<ul>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                            </ul>
							-->
                            </div>
                        </div>

                    </div>
                    <div class="explain-bar col-12 d-none">
                        <div class="explain-contents">
                            <div class="explain-title">Experience</div>
                            <div class="explain-subtitle">Minimum 1 Year</div>
                        </div>
                        <div class="explain-contents">
                            <div class="explain-title">Work Level</div>
                            <div class="explain-subtitle">Senior level</div>
                        </div>
                        <div class="explain-contents">
                            <div class="explain-title">Employee Type</div>
                            <div class="explain-subtitle">Full Time Jobs</div>
                        </div>
                        <div class="explain-contents">
                            <div class="explain-title">Offer Salary</div>
                            <div class="explain-subtitle">$2150.0 / Month</div>
                        </div>
                    </div>
                    <div class="job-explain-content  col-md-8">
                        <div class="overview-text">
                            <!-- <div class="overview-text-header">Overview</div>
                        <div class="overview-text-subheader">We believe that design (and you) will be critical to the company's success. You will work with our founders and our early customers to help define and build our product functionality, while maintaining the quality bar that customers have come to expect from modern SaaS applications. You have a strong background in product design with a quantitavely anf qualitatively analytical mindset. You will also have the opportunity to craft our overall product and visual identity and should be comfortable to flex into working.</div> -->
                        </div>
                        <div class="overview-desc">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
