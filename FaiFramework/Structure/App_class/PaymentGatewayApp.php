<?php 

require_once(__DIR__.'/../Api_class/MidtransPaymentGatewayApi.php');
class PaymentGatewayApp{
    public static function initialize_payment($page,$api,$id_payment_api,$id_pesanan, $invoice,$total, $payment_type, $payment_brand,$try=1)
    {

       
        
        $item = [];
        // foreach ($data_pesanan->result() as $pesanan) {
        //     $total += $pesanan->harga_total;
        //     $item[] = array(
        //         'id'      => $pesanan->id_store_pesanan_detail,
        //         'price'   => $pesanan->harga_satuan,
        //         'quantity' => $pesanan->jumlah,
        //         'name'    => $pesanan->nama_barang
        //     );
        // }
        $items               = ($item);


        $transaction_details = array(
            'order_id'    => $invoice,
            'gross_amount' => $total
        );
        // $user_all        =
        //     $this->db->where('id_apps_user', $_SESSION['id_apps'])
        //     ->join('apps_wilayah_kabupaten', 'apps_user.id_kota_user = apps_wilayah_kabupaten.kota_id', 'left')
        //     ->join('apps_wilayah_provinsi', 'apps_wilayah_provinsi.provinsi_id = apps_wilayah_kabupaten.provinsi_id')
        //     ->get('apps_user')->row();
        // DB::table('pa');
        DB::table('pos__transaksi__online__pemesanan');
        DB::joinRaw('inventaris__asset__tanah__bangunan on id_kirim_ke = inventaris__asset__tanah__bangunan.id', 'left');
        DB::joinRaw('webmaster__wilayah__provinsi on  webmaster__wilayah__provinsi.provinsi_id=id_provinsi', 'left');
        DB::joinRaw('webmaster__wilayah__kabupaten on webmaster__wilayah__kabupaten.kota_id=id_kota', 'left');
        DB::joinRaw('webmaster__wilayah__kecamatan on webmaster__wilayah__kecamatan.subdistrict_id=id_kecamatan', 'left');
        DB::joinRaw('webmaster__wilayah__postal_code on webmaster__wilayah__postal_code.id=id_kelurahan', 'left');
        DB::joinRaw('apps_user on apps_user.id_apps_user = pos__transaksi__online__pemesanan.id_apps_user', 'left');

        DB::whereRaw("pos__transaksi__online__pemesanan.id=$id_pesanan");

        $get_all = DB::get('all');
        //print_r($get_all['row'][0]);
        // Populate customer's billing address
        $billing_address = array(
            'first_name'  => $get_all['row'][0]->nama_lengkap,
            'last_name'   => "",
            'address'     => $get_all['row'][0]->alamat,
            'city'        => $get_all['row'][0]->type . ' ' . $get_all['row'][0]->kota_name,
            'postal_code' => $get_all['row'][0]->postal_code,
            'phone'       => $get_all['row'][0]->nomor_handphone,
            'country_code' => 'IDN'
        );

        // Populate customer's shipping address
        $shipping_address = array(
            'first_name'  => "Hibe3",
            'last_name'   => "(Bersama Bergerak Berdakwah Hijrah IT)",
            'address'     => "Jl Babakan Ciserueuh Timur No 29 RT 01/07",
            'city'        => "Bandung",
            'postal_code' => "40255",
            'phone'       => "08987423444",
            'country_code' => 'IDN'
        );
        //billing address (alamat penagihan) sama seperti alamat pengiriman (shipping address).
        // Populate customer's info
        $customer_details = array(
            'first_name'      => $get_all['row'][0]->nama_lengkap,
            'last_name'       => "",
            'email'           => $get_all['row'][0]->email,
            'phone'           => $get_all['row'][0]->nomor_handphone,
            'billing_address' => $billing_address,
            'shipping_address' => $shipping_address
        );
        echo $payment_type;
        echo $payment_brand;
        $transaction_data['payment_type'] = $payment_type;;
        if ($payment_type == 'bank_transfer') {

            $transaction_data['bank_transfer'] = array('bank' => $payment_brand);
        } else
		if ($payment_type == 'cstore') {
            $transaction_data['cstore'] = array('store'  => $payment_brand, 'message' => "Be3 Grit");
        }
        $transaction_data['transaction_details'] = $transaction_details;
        $transaction_data['item_details'] = $items;
        $transaction_data['customer_details'] = $customer_details;
       
        $api_gateway = ucfirst($api)."PaymentGatewayApi";
        $response = json_decode($api_gateway::remotePost($transaction_data), true);
        if(isset($response['transaction_id'])){
            
            $data['transaction_data'] = json_encode($transaction_data);
            $data['id_payment_api'] = $id_payment_api;
            $data['status_code'] = $response['status_code'];
            $data['status_message'] = $response['status_message'];
            $data['transaction_id'] = $response['transaction_id'];
            $data['order_id'] = $response['order_id'];
            $data['gross_amount'] = $response['gross_amount'];
            $data['currency'] = $response['currency'];
            $data['payment_type'] = $response['payment_type'];
            $data['transaction_time'] = $response['transaction_time'];
            $data['transaction_status'] = $response['transaction_status'];
            $data['merchant_id'] = $response['merchant_id'];
            if ($payment_type == 'cstore') {
    
                $va= $data['payment_code'] = $response['payment_code'];
                $data['store'] = $response['store'];
            } else
            if ($payment_type == 'bank_transfer') {
                if ($payment_brand != 'permata') {
    
                    $data['bank'] = $response['va_numbers'][0]['bank'];
                    $va=  $data['va_numbers'] = $response['va_numbers'][0]['va_number'];
                } else {
                    //echo 'tess';
                 $data['bank'] = $payment_brand;
                  $va=  $data['va_numbers'] = $response['permata_va_number'];
                }
                $data['fraud_status'] = $response['fraud_status'];
            }
            print_r($data); 
            CRUDFunc::crud_insert(false, $page, $data, [], 'payment_api__'.$api, []);

            return $va;
           
        }else{
            if($try<=10){
             PaymentGatewayApp::initialize_payment($api,$id_payment_api,$id_pesanan, $invoice,$total, $payment_type, $payment_brand,($try+1));
        }else{
            echo 'gagal';
            die;
        }
        }
        
       
    }
}