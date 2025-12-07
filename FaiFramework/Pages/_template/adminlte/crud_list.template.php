<div class="container-fluid">
        <!-- Content Header (Page header) -->
        <div class="content-header row">
                <div class="col-lg-6">
            <SECTION-HEADER></SECTION-HEADER>
                </div>
        <div class="col-lg-6"><BREADCUMB></BREADCUMB></div>
            </div><!-- /.container-fluid -->
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                            @include('flash-message')
                            <div class="card-header d-md-flex">
                                <div class="col-md-7">
                                    <ADD-BUTTON></ADD-BUTTON>    
                                    
                                </div>
                                <div class="col-md-5">
                                    <!--<a href="#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip"
                                       data-template="settingOne">
                                        <i data-feather="settings" class="icon-xs"></i>
                                        <div id="settingOne" class="d-none">
                                            <span>Setting</span>
                                        </div>
                                    </a>-->

                                    <IMPORTEXPORT-BUTTON></IMPORTEXPORT-BUTTON>
                                </div>
                            </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <SEARCH-TABLE></SEARCH-TABLE>
                            <CONTENT-TABLE></CONTENT-TABLE>
                            
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
