<?php

define("APIUSE", "RajaOngkirApi");
require_once(__DIR__ . '/../Api_class/RajaOngkirApi.php');
class OngkirApp
{

    public static function print_ongkir($id_store, $kota_tujuan, $berat, $mode = 'All', $kota_asal = null, $choice = null, $page = [])
    {
        $blocking = false;
        $return['ekspedisi'] = "";
        $return['service'] = "";
        if (!$id_store and $mode!='ongkir_terpilih') {
            $blocking = true;
           echo $ongkir = "Id Store belum terisi ";
        } else if (!$kota_tujuan  and $mode!='ongkir_terpilih') {
            $blocking = true;
             $ongkir = "Kota Tujuan belum terisi, isi pilih alamat tujuan terlebih dahulu";
            $return['ekspedisi'] = "<option> $ongkir</option>";
            return $return;
        } else if (!$berat  and $mode!='ongkir_terpilih') {
            $blocking = true;
              $ongkir = "Berat tidak boleh 0 (nol)";
              $ongkir .= "
                            <input type='hidden' id='id_store_tujuan' value='$id_store'>
                            <input type='hidden' id='kota_tujuan_changer' value='$kota_tujuan'>
                            <input type='hidden' id='berat_changer' value='$berat'>
                            <input type='hidden' id='kota_asal_changer' value='$kota_asal'>
                            ";
                $ongkir .= '<div class="card card-bordered shadow-none mb-2">
                <!-- card body -->
                <div class="card-body">
                    <!-- form check -->
                    
                    
                    <div class="d-flex  align-items-center w-100">
                    <!-- img -->
                    <div class="form-check">
                                            <!-- input -->
                                            <input class="form-check-input" type="radio"id="pilih_ongkir" name="pilih_ongkir"   value="LAIN-LAIN"data-gtm-form-interact-field-id="2">
                                            <label class="form-check-label ms-2 w-100" for="DHLExpress">

                                            </label>
                                        </div>
                    <div class="d-flex justify-content-between  w-100">
                    <div >
                    
                        <!-- text -->
                        <div class="ms-2">
                        <h5 class="mb-1"> Lain Lain</h5>
                        <span class="fs-6"> Estimasi kirim ~ Hari</span>
                        </div>
                    </div>
                    <!-- text -->
                    <div>
                    <h3 class="mb-0">Rp. 0
                    </h3>
                    </div>
                </div>
                </div>
                </div>
                    
            </div>
        ';
            $return['ekspedisi'] = "<option> $ongkir</option>";
            return $ongkir;
        } else if (!$kota_asal  and $mode!='ongkir_terpilih') {
            $blocking = true;
             $ongkir = "Kota Asal belum terisi, hubungi admin";
            $return['ekspedisi'] = "<option> $ongkir</option>";
            return $return;
        } else {
            $ongkir = '';
            DB::table('store__toko');
            DB::whereRaw("id = $id_store");
            $toko = DB::get();
            $kurir = array('jne', 'pos');
            if (!$kota_asal) {
                //	
                // $kota_asal = $this->db->where('id_store_distributor',$id_distribusi)->get('store_distributor')->row()->id_kota;
            }
            // echo $mode;
            $apiuse = APIUSE;
            if ($mode == 'All') {
                //echo 'hallo';

                $ongkir .= "
                            <input type='hidden' id='id_store_tujuan' value='$id_store'>
                            <input type='hidden' id='kota_tujuan_changer' value='$kota_tujuan'>
                            <input type='hidden' id='berat_changer' value='$berat'>
                            <input type='hidden' id='kota_asal_changer' value='$kota_asal'>
                            ";
                $ongkir .= '<div class="card card-bordered shadow-none mb-2">
                <!-- card body -->
                <div class="card-body">
                    <!-- form check -->
                    
                    
                    <div class="d-flex  align-items-center w-100">
                    <!-- img -->
                    <div class="form-check">
                                            <!-- input -->
                                            <input class="form-check-input" type="radio"id="pilih_ongkir" name="pilih_ongkir"   value="LAIN-LAIN"data-gtm-form-interact-field-id="2">
                                            <label class="form-check-label ms-2 w-100" for="DHLExpress">

                                            </label>
                                        </div>
                    <div class="d-flex justify-content-between  w-100">
                    <div >
                    
                        <!-- text -->
                        <div class="ms-2">
                        <h5 class="mb-1"> Lain Lain</h5>
                        <span class="fs-6"> Estimasi kirim ~ Hari</span>
                        </div>
                    </div>
                    <!-- text -->
                    <div>
                    <h3 class="mb-0">Rp. 0
                    </h3>
                    </div>
                </div>
                </div>
                </div>
                    
            </div>
        ';
                for ($i = 0; $i < count($kurir); $i++) {

                    $query = $apiuse::getOngkir($kota_asal, $kota_tujuan, $berat, $kurir[$i]);
                    if (!isset($query->rajaongkir->results[0]->costs)) {
                        // var_dump($query);
                        // print_R($query->rajaongkir);
                        echo $query->rajaongkir->status->description;
                    } else {
                        foreach ($query->rajaongkir->results[0]->costs as $q) {
                            $etd = str_ireplace('hari', '', $q->cost['0']->etd);
                            $etd = str_ireplace('d', '', $etd);
                            $ongkir .= '<div class="card card-bordered shadow-none mb-2">
                                <!-- card body -->
                                <div class="card-body">
                                    <!-- form check -->
                                    
                                    
                                    <div class="d-flex  align-items-center w-100">
                                    <!-- img -->
                                    <div class="form-check">
                                                            <!-- input -->
                                                            <input class="form-check-input" type="radio"id="pilih_ongkir" name="pilih_ongkir"   value="' . ($kurir[$i]) . '-' . $q->service . '"data-gtm-form-interact-field-id="2">
                                                            <label class="form-check-label ms-2 w-100" for="DHLExpress">

                                                            </label>
                                                        </div>
                                    <div class="d-flex justify-content-between  w-100">
                                    <div >
                                    
                                        <!-- text -->
                                        <div class="ms-2">
                                        <h5 class="mb-1"> ' . strtoupper($kurir[$i]) . ' ' . $q->service . '</h5>
                                        <span class="fs-6"> Estimasi kirim' . $etd . '  Hari</span>
                                        </div>
                                    </div>
                                    <!-- text -->
                                    <div>
                                    <h3 class="mb-0">' . rupiah($q->cost['0']->value) . '
                                    </h3>
                                    </div>
                                </div>
                                </div>
                                </div>
                                    
                            </div>
                        ';
                        }
                    }
                }
            } else if ($mode == 'all_option') {

                $return['ekspedisi'] = "<option value='LAIN'>LAIN - LAIN</option>";
                $return['service'] = [];
                $return['service']['LAIN']['option'] = "<option  value='LAIN-LAIN'>LAIN - LAIN Rp. 0</option>";;
                $return['service']['LAIN']['cost'] = 0;
                $return['service']['LAIN']['etd'] = "~ Hari";
                $service = [];
                $db['utama'] = "webmaster__ekspedisi";
                $db['np'] = "webmaster__ekspedisi";
                $db['where'][] = ["webmaster__ekspedisi.active", "=", 1];
                $get = Database::database_coverter($page, $db, [], 'all');
                if ($get['num_rows']) {
                    foreach ($get['row'] as $row_exp) {

                        $return['ekspedisi'] .= "<option value='$row_exp->kode_ekspedisi'>$row_exp->nama_ekspedisi</option>";

                        $query = $apiuse::getOngkir($kota_asal, $kota_tujuan, $berat, $row_exp->kode_ekspedisi);
                        // echo '<pre>';
                        // print_R($query->rajaongkir->results);
                        if (isset($query->rajaongkir->results[0]->costs)) {

                            foreach ($query->rajaongkir->results[0]->costs as $q) {
                                $etd = str_ireplace('hari', '', $q->cost['0']->etd);
                                $etd = str_ireplace('d', '', $etd);
                                if (!isset($service[$row_exp->kode_ekspedisi]['option'])) {
                                    $service[$row_exp->kode_ekspedisi]['option'] = "";
                                }
                                $service[$row_exp->kode_ekspedisi]['option'] .= "<option value='" . ($row_exp->kode_ekspedisi) . '-' . $q->service . "'> " . strtoupper($row_exp->kode_ekspedisi) . ' ' . $q->service . " Rp. " . rupiah($q->cost['0']->value) . "</option>";
                                $service[$row_exp->kode_ekspedisi]['cost'][($row_exp->kode_ekspedisi) . '-' . $q->service] = ($q->cost['0']->value);
                                $service[$row_exp->kode_ekspedisi]['etd'][($row_exp->kode_ekspedisi) . '-' . $q->service] = $etd;
                            }
                        } else {
                        }
                    }
                }
                $return['service'] = $service;

                return $return;
                die;
            } else if ($mode == 'onchoice') {
                $query = $apiuse::getOngkir($kota_asal, $kota_tujuan, $berat, $kurir[0]);
                $i = 0;
                foreach ($query->rajaongkir->results[0]->costs as $q) {
                    if ($i == 0) {


                        $etd = str_ireplace('hari', '', $q->cost['0']->etd);
                        $etd = str_ireplace('d', '', $etd);
                        $ongkir .= '
                    <div class="card card-bordered shadow-none mb-2">
                   
                    <div class="card-body">
                        
                        <div class="d-flex  align-items-center w-100">
                        <div class="form-check">
                                                <!-- input -->
                                                <input class="form-check-input" type="radio"id="pilih_ongkir" name="pilih_ongkir"   value="' . ($kurir[$i]) . '-' . $q->service . '"data-gtm-form-interact-field-id="2">
                                                <label class="form-check-label ms-2 w-100" for="DHLExpress">

                                                </label>
                                            </div>
                        <div class="d-flex justify-content-between  w-100">
                        <div >
                           
                            <!-- text -->
                            <div class="ms-2">
                            <h5 class="mb-1"> ' . strtoupper($kurir[$i]) . ' ' . $q->service . '</h5>
                            <span class="fs-6"> Estimasi kirim' . $etd . '  Hari</span>
                            </div>
                        </div>
                        <!-- text -->
                        <div>
                        <h3 class="mb-0">' . rupiah($q->cost['0']->value) . '
                        </h3>
                        </div>
                    </div>
                    </div>
                        
                </div>';
                    }
                    $i++;
                }
            } else if ($mode == 'first_ongkir') {

                $query = $apiuse::getOngkir($kota_asal, $kota_tujuan, $berat, $kurir[0]);
                $i = 0;
                $print = '';
                // print_R($query);
                $data['harga_ongkir'] = 0;
                $data['paket_ongkir'] = "";
                $data['estimasi_kirim'] = "";
                $data['print'] = "";
                if (isset($query->rajaongkir->results[0]->costs)) {

                    foreach ($query->rajaongkir->results[0]->costs as $q) {
                        if ($i == 0) {


                            $etd = str_ireplace('hari', '', $q->cost['0']->etd);
                            $etd = str_ireplace('d', '', $etd);
                            $print .= '<span class="row m-0 p-0">

						<span class="col-8 m-0">
						<strong>
						' . strtoupper($kurir[$i]) . ' ' . $q->service . '
						</strong>
						<br> ' . rupiah($q->cost['0']->value) . ' (' . $etd . '  Hari)
						</span>
						<span style="text-align: right;padding-right: 10px;font-size: 24px;" class="col-4 ml-auto m-0 ">
						&gt;

                        <input type="hidden" class="ongkir_terpilih" value="' . $q->cost['0']->value . '">
						</span>
						</span>';

                            $data['harga_ongkir'] = $q->cost['0']->value;
                            $data['paket_ongkir'] = $kurir[$i] . '-' . $q->service;
                            $data['estimasi_kirim'] = $etd;
                            $data['print'] = $print;
                        }
                        $i++;
                    }
                }
                return $data;
            } else if ($mode == 'first_ongkir_response_dropship') {
                $query = $apiuse::getOngkir($kota_asal, $kota_tujuan, $berat, $kurir[0]);
                $i = 0;
                $print = '';
                foreach ($query->rajaongkir->results[0]->costs as $q) {
                    if ($i == 0) {


                        $etd = str_ireplace('hari', '', $q->cost['0']->etd);
                        $etd = str_ireplace('d', '', $etd);
                        $print .= '<span class="row m-0 p-0">

						<span class="col-8 m-0">
						<strong>
						' . strtoupper($kurir[$i]) . ' ' . $q->service . '
						</strong>
						<br> ' . rupiah($q->cost['0']->value) . ' (' . $etd . '  Hari)
						</span>
						<span style="text-align: right;padding-right: 10px;font-size: 24px;" class="col-4 ml-auto m-0 ">
						&gt;

						</span>
						</span>';
                        $data['id_apps_user'] = $_SESSION['id_apps'];
                        $data['id_store_distributor'] = $id_distribusi;
                        $data['status'] = 'Belum Beli';
                        $data['jenis'] = 'ongkir';
                        $num = $this->db->where($data)->get('store_user_cart');

                        $data['id_kota_tujuan'] = $kota_tujuan;
                        $data['harga_ongkir'] = $q->cost['0']->value;
                        $data['paket_ongkir'] = $kurir[$i] . '-' . $q->service;
                        $data['estimasi_kirim'] = $etd;
                        $data['panel'] = 'dropship';
                        $data['tgl_input'] = date('Y-m-d H:i:s');
                    }
                    $i++;
                }
                return $data;
            } else if ($mode == 'ongkir_terpilih') {

                $print = '';
                //for ($i = 0; $i < count($kurir); $i++) {
                if ($choice == 'LAIN-LAIN') {
                    $data['harga_ongkir'] = 0;
                    $data['paket_ongkir'] = $choice;
                    $data['estimasi_kirim'] = 0;
                    $print .= '
                                        <div class="card card-bordered shadow-none mb-2">
                                            <!-- card body -->
                                            <div class="card-body">
                                                <!-- form check -->
                                                
                                                
                                                <div class="d-flex  align-items-center w-100">
                                                <!-- img 
                                                <div class="form-check">
                                                                        <input class="form-check-input" type="radio"id="pilih_ongkir" name="pilih_ongkir"   value="LAIN-LAIN"data-gtm-form-interact-field-id="2">
                                                                        <label class="form-check-label ms-2 w-100" for="DHLExpress">
                        
                                                                        </label>
                                                                    </div>-->
                                                <div class="d-flex justify-content-between  w-100">
                                                <div >
                                                
                                                    <!-- text -->
                                                    <div class="ms-2">
                                                    <h6 class="mb-1"> ' . $toko[0]->nama_toko . '</h6>
                                                    <h5 class="mb-1"> LAIN LAIN <button class="btn btn-primary btn-sm"  type="button" onclick="get_ubah_ongkir(' . "'" . $id_store . "','" . $kota_tujuan . "','" . $berat . "','" . $kota_asal . "'" . ')">Ubah</button> </h5>
                                                    <span class="fs-6"> Estimasi kirim  ~ Hari</span>
                                                    </div>
                                                </div>
                                                <!-- text -->
                                                <div>
                                                <h3 class="mb-0">' . rupiah(0) . '
                                                <input type="hidden" class="ongkir_terpilih" value="0">
                                                </h3>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                                
                                        </div>
                                    ';
                    $data['print'] = $print;
                } else {
                    $choice_ex = explode('-', $choice);
                    $query = $apiuse::getOngkir($kota_asal, $kota_tujuan, $berat, $choice_ex[0]);
                    //print_r($berat);
                    if (isset($query->rajaongkir)) {
                        foreach ($query->rajaongkir->results[0]->costs as $q) {
                            if ($choice == ($choice_ex[0] . '-' . $q->service)) {

                                $etd = str_ireplace('hari', '', $q->cost['0']->etd);
                                $etd = str_ireplace('d', '', $etd);
                                $print .= '
                        <div class="card card-bordered shadow-none mb-2">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- form check -->
                        
						
                        <div class="d-flex  align-items-center w-100">
                        <!-- img 
                        <div class="form-check">
                                                <input class="form-check-input" type="radio"id="pilih_ongkir" name="pilih_ongkir"   value="' . ($choice_ex[0]) . '-' . $q->service . '"data-gtm-form-interact-field-id="2">
                                                <label class="form-check-label ms-2 w-100" for="DHLExpress">

                                                </label>
                                            </div>-->
                        <div class="d-flex justify-content-between  w-100">
                        <div >
                           
                            <!-- text -->
                            <div class="ms-2">
                            <h6 class="mb-1"> ' . $toko[0]->nama_toko . '</h6>
                            <h5 class="mb-1"> ' . strtoupper($choice_ex[0]) . ' ' . $q->service . ' <button class="btn btn-primary btn-sm"  type="button" onclick="get_ubah_ongkir(' . "'" . $id_store . "','" . $kota_tujuan . "','" . $berat . "','" . $kota_asal . "'" . ')" type="button">Ubah</button> </h5>
                            <span class="fs-6"> Estimasi kirim ' . $etd . '  Hari</span>
                            </div>
                        </div>
                        <!-- text -->
                        <div>
                        <h3 class="mb-0">' . rupiah($q->cost['0']->value) . '
                        <input type="hidden" class="ongkir_terpilih" value="' . $q->cost['0']->value . '">
                        </h3>
                        </div>
                    </div>
                    </div>
                    </div>
                    </div>
                        
                </div>
            ';
                                $data['harga_ongkir'] = $q->cost['0']->value;
                                $data['paket_ongkir'] = $choice_ex[0] . '-' . $q->service;
                                $data['estimasi_kirim'] = $etd;
                                $data['print'] = $print;
                            }
                        }
                    }
                }
                //}

                return $data;
            } else if ($mode == 'estimasi_ongkir_terpilih') {

                $print = '';
                for ($i = 0; $i < count($kurir); $i++) {

                    $query = $apiuse::getOngkir($kota_asal, $kota_tujuan, $berat, $kurir[$i]);
                    foreach ($query->rajaongkir->results[0]->costs as $q) {
                        if ($choice == ($kurir[$i] . '-' . $q->service)) {

                            $etd = str_ireplace('hari', '', $q->cost['0']->etd);
                            $etd = str_ireplace('d', '', $etd);
                            return $etd;
                        }
                    }
                }
            } else if ($mode == 'harga_ongkir_terpilih') {

                $print = '';
                for ($i = 0; $i < count($kurir); $i++) {

                    $query = $apiuse::getOngkir($kota_asal, $kota_tujuan, $berat, $kurir[$i]);
                    foreach ($query->rajaongkir->results[0]->costs as $q) {
                        if ($choice == ($kurir[$i] . '-' . $q->service)) {
                            return ($q->cost['0']->value);
                        }
                    }
                }
                //	echo $print;
            }
        }
        if ($blocking) {

            if ($mode == 'first_ongkir') {
                $data['print'] = $ongkir;
                $data['paket_ongkir'] = "-";
                $data['estimasi_kirim'] = "-";
                $data['harga_ongkir'] = 0;
                $data['data'] = array();
                return $data;
            }
        }

        return $ongkir;
    }
}
