<div class="py-1 row">
        <div class="col-lg-6 col-md-6 col-6">
        @include('flash-message')
        <!-- Page header -->
        <SECTION-HEADER></SECTION-HEADER>
        </div>
        <div class="col-lg-6"><BREADCUMB></BREADCUMB></div>
    </div>
    <div>
        <!-- row -->

        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- card -->
                <div class="card mb-12">
                    <!-- card body -->
                    <div class="card-body">
                        <div>
                        <FORM-ACTION></FORM-ACTION>
                        @csrf
                            <!-- input -->
                            <VTE-MAIN></VTE-MAIN>
                                <!-- input -->

                                
                                <div class="modal-footer">
                                <BUTTON-VTE></BUTTON-VTE>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>