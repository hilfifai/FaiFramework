<?php
require_once(__DIR__ . '/../App/Cronjob.php');
class Share
{
  public static function jam2($page)
  {
    $specificTime = new DateTime('2024-11-26 06:00:00');
    $specificTime2 = new DateTime('2024-11-26 04:30:00');
    $specificTime3 = new DateTime('2024-11-26 06:00:00');
    // Menambahkan 1 jam
    $list = [];
    for ($i = 0; $i < 24 - 6; $i++) {

      $specificTime->modify('+1 hour');
      $specificTime2->modify('+1 hour');
      if ($i != 24 - 7) {

        echo $specificTime->format('H:i:s');
        echo '<br>';
        $list[] = [$specificTime->format('H:i:s'), 5];
      }
      echo $specificTime2->format('H:i:s');
      echo '<br>';

      $list[] = [$specificTime2->format('H:i:s'), 4];
    }
    for ($i = 0; $i < ((((24 - 9) * 5)) * 3) - 9; $i++) {
      $specificTime3->modify('+5 minutes');
      if (in_array($specificTime3->format('H:i:s'), $list)) {
        $specificTime3->modify('+5 minutes');
      }
      if (in_array($specificTime3->format('i'), ["15", "45"])) {

        $list[] = [$specificTime3->format('H:i:s'), 3];
      }
      if (in_array($specificTime3->format('i'), ["10", "20", "40", "50"])) {

        $list[] = [$specificTime3->format('H:i:s'), 2];
      }
      if (in_array($specificTime3->format('i'), ["05", "25", "55"])) {

        $list[] = [$specificTime3->format('H:i:s'), 1];
      }
    }
    echo '<pre>';
    print_R($list);
    for ($i = 0; $i < count($list); $i++) {
      $sqli['jam'] = $list[$i][0];
      $sqli['urutan_perioritas'] = $list[$i][1];
      DB::insert("share__wa_group__jam", $sqli);
    }
    die;
  }
  public static function post($page)
  {
    if ($page['section'] != 'generate') {

      $tanggal_post = Partial::input('tanggal_post') ? Partial::input('tanggal_post') : Partial::tambah_tanggal(date('Y-m-d'), 3);
      DB::selectRaw("sum(coalesce(share__wa_group__post.jumlah_group,0) ) as count");
      DB::table("share__wa_group__jam");
      DB::joinRaw("(select id_share__wa_group__post,id_share_jam,TO_DATE(generate_tanggal::text, 'YYYY-MM-DD') AS tanggal_post 
        from chat__broadcast__generate 
        where id_share_jam is not null 
        group by id_share__wa_group__post,id_share_jam,generate_tanggal) as gen on gen.id_share_jam=share__wa_group__jam.id", 'LEFT');
      DB::joinRaw("share__wa_group__post on share__wa_group__post.id_share__wa_group__post=share__wa_group__post.id");

      DB::whereRaw("share__wa_group__jam.urutan_perioritas>2");
      DB::whereRaw("gen.tanggal_post='" . $tanggal_post . "'");
      DB::whereRaw("share__wa_group__post.tanggal_post='" . $tanggal_post . "'");
      $count1 = DB::get('all');

      DB::selectRaw("count(*) as count");
      DB::table("share__wa_group__jam");
      DB::whereRaw("share__wa_group__jam.urutan_perioritas>2");
      $count2 = DB::get('all');
      DB::selectRaw("sum(coalesce(share__wa_group__post.jumlah_group)) as sum");
      DB::table("share__wa_group__post");
      DB::whereRaw("share__wa_group__post.tanggal_post='" . $tanggal_post . "'");
      $count3 = DB::get('all');

      if ($page['load']['type'] == 'hitung_jadwal_kosong') {
        echo json_encode(["jadwal_kosong" => ($count2['row'][0]->count * 94) -  ($count1['row'][0]->count + $count3['row'][0]->sum)]);

        die;
      }
    }

    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "share__post";
    $primary_key = null;
    //kalau board task ini

    $array = array(
      array("Judul", null, "text"),
      array("Media", null, "file-upload", "share/post/"),
      array("Caption", null, "textarea"),
    );

    //


    $sub_kategori[] = ["", "share__wa_group__post", null, "table"];
    $array_sub_kategori[] = array(
      array("Tanggal Post", null, "date"),
      array("Jadwal Kosong", null, "number"),
      array("Jumlah Group", null, "number"),
      array("Harga / Group", "harga_per_group", "number"),
      array("Sub total", "sub_total", "number"),
      array("Diskon Promo", "diskon", "number"),
      array("Total Diskon", null, "number"),
      array("Total Biaya", null, "number"),

    );
    $sub_kategori[] = ["Cara Bayar",  "erp__pos__payment__bayar", null, "form"];
    $array_sub_kategori[] = array(
      array("Metode Bayar", null, "select", array('webmaster__payment_method', null, 'nama_payment'), null),
      array("Brand", "row", "select", array('webmaster__payment_method_brand', null, 'nama_brand'), null),
      array("Payment Api", null, "select-edit-view", array('payment_api', null, 'nomor_payment_api'), null),
      // array("Akun Bank", null, "select", array('keuangan__akun', null, 'nama_akun'), null),
      array("", "brand_nama", "hidden_input"),
      array("", "no_rek", "hidden_input"),
      array("", "an", "hidden_input"),
      array("", "va_number", "hidden_input"),
      array("", "is_api", "hidden_input"),
      array("", "jumlah_bayar", "text"),
      // array("", "status_bayar", "select-manual", array("belum" => "Belum", "sudah" => "Sudah", "gagal" => "Gagal")),
      // array("Tanggal Bayar", null, "date"),
      // array("Tanggal Jatuh Tempo", null, "date"),

    );


    $page['crud']['total'] = array(
      "col-row" => "col-md-7 offset-md-5",
      "content" => array(
        array("name" => "Subtotal", "id" => "subtotal_akhir", "type" => "text"),
        array("name" => "Diskon", "id" => "diskon_akhir", "type" => "text"),
        array("name" => "Total", "id" => "total_akhir", "type" => "text"),

      )
    );

    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total_bruto",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "sub_total",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "subtotal_akhir_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "subtotal_akhir_content",
          "input" => "id",
          "var" => "result"
        ),

      )

    );
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total_diskon",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "total_diskon",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "diskon_akhir_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "diskon_akhir_content",
          "input" => "id",
          "var" => "result"
        ),

      )

    );
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total_netto",
      //sub_total _total Qty * harga
      "execute" => array(
        array(
          "type" => "sum",
          "sum" => "total_biaya",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "total_akhir_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "total_akhir_content",
          "input" => "id",
          "var" => "result"
        ),

      )

    );
    $page['crud']['function_js'][] = array(
      "type" => "calculation",
      "name" => "total",
      "get" => array("subtotal_input" => "id", "diskon_input" => "id"),
      "first" => array(
        array(
          "type" => "call_function",
          "name_function" => "total_bruto"
        ),
        array(
          "type" => "call_function",
          "name_function" => "total_diskon"
        ),
        array(
          "type" => "call_function",
          "name_function" => "total_netto"
        ),

      ),
      "execute" => array(
        array(
          "type" => "math",
          "math" => "(((parseFloat(subtotal_input))-(parseFloat(diskon_input)) ))",
          "var" => "result"
        )
      ),
      "result" => array(
        array(
          "type" => "to_val",
          "elemen" => "total_input",
          "input" => "id",
          "var" => "result"
        ),
        array(
          "type" => "to_html",
          "elemen" => "total_content",
          "input" => "id",
          "var" => "result"
        ),
      )

    );
    $nominal = 0;
    if ($page['section'] != 'generate') {

      DB::table("share__wa_group__promo");
      DB::whereRaw(" '" . date('Y-m-d H:i:s') . "' BETWEEN tanggal_berlaku_dari AND tanggal_berlaku_sampai");
      $get = DB::get('all');

      if ($get['num_rows']) {
        foreach ($get['row'] as $get_row) {
          $nominal +=    $get_row->nominal_potongan_promo;
        }
      }
    }



    if ($page['section'] != 'generate') {
      $page['crud']['insert_value']["tanggal_post"] = $tanggal_post;
      $page['crud']['insert_value']["jadwal_kosong"] = ($count2['row'][0]->count * 94) -  ($count1['row'][0]->count + $count3['row'][0]->sum);
      $page['crud']['crud_inline']["tanggal_post"] = "min ='$tanggal_post' onkeyup='change_jadwal(<NUMBERING></NUMBERING>)' onchange='change_jadwal(<NUMBERING></NUMBERING>)' onclick='change_jadwal(<NUMBERING></NUMBERING>)'";
    } else {
      $page['crud']['insert_value']["tanggal_post"] = "tanggal_post()";

      $page['crud']['insert_value']["jadwal_kosong"] = "jadwal_kosong()";
    }
    $page['crud']['insert_value']["harga_per_group"] = 1000;
    $page['crud']['insert_value']["diskon"] = $nominal;
    $page['crud']['crud_inline']["diskon"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
    $page['crud']['crud_inline']["harga_per_group"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
    $page['crud']['crud_inline']["jumlah_group"] = "max='94' onkeyup='subtotal_row(<NUMBERING></NUMBERING>)' onchange='subtotal_row(<NUMBERING></NUMBERING>)' onclick='subtotal_row(<NUMBERING></NUMBERING>)'";
    $page['crud']['crud_inline']["jadwal_kosong"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
    $page['crud']['crud_after_all'] = "
         <script>
         function change_jadwal(number_row){
            $.ajax({

                type: 'get',
                data: {
                    'first': link_route,
                    'link_route': $('#load_link_route').val(),
                    'apps': 'Share',
                    'page_view': 'Post',
                    'type': 'hitung_jadwal_kosong',
                    'id': $('#load_id').val(),
                    'frameworksubdomain': $('#load_domain').val(),
                    'tanggal_post': $('#tanggal_post'+number_row).val(),
                    'contentfaiframework': 'get_pages',
                    'MainAll': 2
                },
                    url: link_route,
                    dataType: 'json',
                    success: function(responseData) {
                        
                        $('#jadwal_kosong'+number_row).val(responseData.jadwal_kosong);



                    }
                });
            
         }
         function subtotal_row(number_row){
            var jadwal_kosong = parseInt($('#jadwal_kosong'+number_row).val());
            var jumlah_group =parseInt($('#jumlah_group'+number_row).val());
            var max =parseInt($('#jumlah_group'+number_row).attr('max'));
            var harga_per_group =parseInt($('#harga_per_group'+number_row).val());
            var diskon =parseInt($('#diskon'+number_row).val());
            var total_diskon =parseInt($('#total_diskon'+number_row).val());
            if(jumlah_group > max){
                alert('Jumlah Group Tidak boleh lebih dari '+max);
                $('#jumlah_group'+number_row).val(max);
                jumlah_group = max;
            }
            if(jumlah_group > jadwal_kosong){
                alert('Jadwal Kosong tidak ada..');
                // jumlah_group = jadwal_kosong;
                // $('#jumlah_group'+number_row).val(jadwal_kosong);
            }
                if(!jumlah_group)
                jumlah_group=0;
            sub_total = harga_per_group * jumlah_group;
            $('#sub_total'+number_row).val(sub_total);
            if(sub_total<diskon){
                     $('#total_diskon'+number_row).val(sub_total);
                     total_diskon = sub_total;
            }else{
                $('#total_diskon'+number_row).val(diskon);
                     total_diskon = diskon;
            }

            total_biaya = sub_total-total_diskon;
            $('#total_biaya'+number_row).val(total_biaya);
            
            total();

         }
         </script>
        ";

    $page['crud']['insert_after'] = array("Share", "send_wa_insert");

    $search = array();

    $page['crud']['sub_kategori'] = $sub_kategori;
    $page['crud']['array_sub_kategori'] = $array_sub_kategori;
    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;


    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    $page['load']['tipe_sidebar'] = "Share";
    return $page;
  }
  public static function send_wa_insert($page)
  {
    $fai = new MainFaiFramework();
    if ($page['section'] != 'generate') {
    }
    echo "insert_id=" . $insert_id = $page['crud']['result_proses']['last_insert_id'];
    echo "insert_id=" . $insert_id = $page['crud']['last_insert']["share__post"];

    DB::table('share__post');
    DB::whereRaw('share__post.kode_post is null');
    $get = DB::get('all');
    if ($get['num_rows']) {

      foreach ($get['row'] as $kode) {
        $kode_post = Partial::random_num(6);
        DB::update("share__post", ["kode_post" => $kode_post], "id=$kode->id");
      }
    }
    DB::table('share__wa_group__post');
    DB::whereRaw('share__wa_group__post.kode_post_group is null');
    $get = DB::get('all');
    if ($get['num_rows']) {

      foreach ($get['row'] as $kode) {
        $kode_post = Partial::random_num(6);
        DB::update("share__wa_group__post", ["kode_post_group" => $kode_post], "id=$kode->id");
      }
    }

    $sqli_pesan = [];
    $sqli_pesan['tipe_pesan'] = "message";
    $sqli_pesan['pesan'] = "Terima Kasih telah mempercayakan promosi produk anda kepada Be3 Share. 
    \n
    \n

    Untuk Selanjutnya Silahkan melakukan pembayaran dengan rincian sebagai Berikut:
    \n
    ";
    DB::table('erp__pos__payment__bayar');
    DB::joinRaw('webmaster__payment_method on id_metode_bayar = webmaster__payment_method.id');
    DB::joinRaw('webmaster__payment_method_brand on id_metode_bayar = webmaster__payment_method_brand.id');
    DB::whereRaw('erp__pos__payment__bayar.id_share__post =' . $insert_id);
    $get = DB::get('all');
    if ($get['num_rows']) {

      foreach ($get['row'] as $row) {
        if (!$row->id_erp__pos__payment) {

          $insert_payment = CRUDFunc::declare_crud_variable($fai, $page, [], 'erp__pos__payment', '', array(), ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce', 'nomor_payment'))['$sqli'];
          $insert_payment['id_panel'] = null;
          $insert_payment['id_apps_user'] = $_SESSION['id_apps_user'];
          $insert_payment['id_erp__pos__utama'] = null;
          $insert_payment['status_payment'] = 'Aktif';
          $insert_payment['tanggal_payment'] = date('Y-m-d H:i:s');
          // $insert_payment['nomor_payment'] = "FJ-O/" . date('ymdHis') . "/" . random_num(5);
          $insert_payment['total_bayar'] = $row->jumlah_bayar;
          $last_id_payment =  CRUDFunc::crud_insert($fai, $page, $insert_payment, [], 'erp__pos__payment', ErpPosApp::route_nomor($page, 'Barang Jadi Ecommerce'));
        } else {
          $last_id_payment = $row->id_erp__pos__payment;
        }
        $va  = "";
        if ($row->is_api) {
          // $insert_api = $insert_payment;
          unset($insert_api['nomor_payment']);
          unset($insert_api['id_pemesanan']);

          // $insert_api['id_panel'] = $id_panel;
          $insert_api['id_apps_user'] = $_SESSION['id_apps_user'];
          $insert_api['id_payment'] = $last_id_payment;
          $insert_api['from_payment'] = "pos__transaksi__online";
          $insert_api['nomor_payment_api'] = "PA/" . date('ymdHis') . "/" . random_num(5);
          $insert_api['jenis_api'] = $row[0]->api;
          $insert_api['status_payment'] = "aktif";
          $last_id_payment_api = CRUDFunc::crud_insert($fai, $page, $insert_api, [], 'payment_api', []);

          $va =  PaymentGatewayApp::initialize_payment($page, $row->api, $last_id_payment_api, -1, $insert_api['nomor_payment_api'], $row->jumlah_bayar, $row->kode_payment, $row->kode_brand);
        }
        $brand = $row->nama_brand;
        $no_rek = $row->no_rek;
        $atas_nama = $row->atas_nama;
        $sqli_pesan['pesan'] .= "\n" . ("$brand") . "\n
      " . $no_rek . $va . "\n
      " . ($atas_nama ? "an. " . $atas_nama : '') . "Vitual Account Bank" . "\n
      \n
      ";
      }
    }


    $sqli_pesan['id_share__post'] = $insert_id;

    $id_pesan = CRUDFunc::crud_insert(new MainFaiFramework(), $page, $sqli_pesan, [], 'chat__broadcast__list__pesan');
    $sqli = [];
    DB::table('apps_user');
    DB::whereRaw("id_apps_user='" . $_SESSION['id_apps_user'] . "'");
    $user = DB::get('all');
    if ($user['row'][0]->wa_verifikasi == 1) {

      $sqli['number'] = $user['row'][0]->nomor_handphone;
      $sqli['generate_tanggal'] = date('Y-m-d H:i:s');
      $sqli['status'] = 'belum';

      $sqli['id_share__post'] = $insert_id;
      $sqli['id_pesan'] = $id_pesan;
      CRUDFunc::crud_insert(new MainFaiFramework(), $page, $sqli, [], 'chat__broadcast__generate');
    }

    Cronjob::proses_share($page, $insert_id,  'kirim_acc_dec_admin');

    die;
  }
  public static function post_jam($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "share__wa_group__post";
    $primary_key = null;
    //kalau board task ini

    $array = array(
      array("Post", "id_share__post", "select", ["share__post", "", "judul"]),
      array("Tanggal Post", null, "date"),
      array("Jadwal Kosong", null, "number"),
      array("Jumlah Group", null, "number"),
      array("Harga / Group", "harga_per_group", "number-cur"),
      array("Sub total", "sub_total", "number-cur"),
      array("Diskon Promo", "diskon", "number-cur"),
      array("Total Diskon", null, "number-cur"),
      array("Total Biaya", null, "number-cur"),
      array("Status Pembayaran", null, "select-manual", ["Sudah Bayar" => "Sudah Bayar", "Belum Bayar" => "Belum Bayar"]),
      array("Status Generate", "status_generate", "select-manual", ["belum" => "Belum", "sudah" => "Sudah"]),

      array("Waktu Post", null, "select", ["share__wa_group__jam", "", "jam"]),
      array("Status Approve", null, "select-manual", ["3" => "Pending", "2" => "Tolak", "1" => "Setuju"]),
    );
    $page['non_view']['edit']['id_share__post'] = true;
    $page['non_view']['edit']['id_waktu_post'] = true;
    $page['non_view']['edit']['status_generate'] = true;
    $page['non_view']['edit']['status_pembayaran'] = true;
    if ($page['section'] != 'generate') {

      if ((in_array($page['load']['type'], array('tambah')) or in_array(Partial::input('_view'), array('tambah')))) {
        $tanggal_post = Partial::input('tanggal_post') ? Partial::input('tanggal_post') : Partial::tambah_tanggal(date('Y-m-d'), 3);
        DB::selectRaw("sum(coalesce(share__wa_group__post.jumlah_group,0) ) as count");
        DB::table("share__wa_group__jam");
        DB::joinRaw("(select id_share__wa_group__post,id_share_jam,TO_DATE(generate_tanggal::text, 'YYYY-MM-DD') AS tanggal_post 
            from chat__broadcast__generate 
            where id_share_jam is not null 
            group by id_share__wa_group__post,id_share_jam,generate_tanggal) as gen on gen.id_share_jam=share__wa_group__jam.id", 'LEFT');
        DB::joinRaw("share__wa_group__post on share__wa_group__post.id_share__wa_group__post=share__wa_group__post.id");

        DB::whereRaw("share__wa_group__jam.urutan_perioritas>2");
        DB::whereRaw("gen.tanggal_post='" . $tanggal_post . "'");
        DB::whereRaw("share__wa_group__post.tanggal_post='" . $tanggal_post . "'");
        $count1 = DB::get('all');

        DB::selectRaw("count(*) as count");
        DB::table("share__wa_group__jam");
        DB::whereRaw("share__wa_group__jam.urutan_perioritas>2");
        $count2 = DB::get('all');
        DB::selectRaw("sum(coalesce(share__wa_group__post.jumlah_group)) as sum");
        DB::table("share__wa_group__post");
        DB::whereRaw("share__wa_group__post.tanggal_post='" . $tanggal_post . "'");
        $count3 = DB::get('all');

        $page['crud']['insert_value']["tanggal_post"] = $tanggal_post;
        $page['crud']['insert_value']["jadwal_kosong"] = ($count2['row'][0]->count * 94) -  ($count1['row'][0]->count + $count3['row'][0]->sum);
        $page['crud']['insert_value']["harga_per_group"] = 1000;
        $page['crud']['insert_value']["diskon"] = $nominal;
        $page['crud']['crud_inline']["diskon"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["harga_per_group"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["tanggal_post"] = "min ='$tanggal_post' onkeyup='change_jadwal(<NUMBERING></NUMBERING>)' onchange='change_jadwal(<NUMBERING></NUMBERING>)' onclick='change_jadwal(<NUMBERING></NUMBERING>)'";
        $page['crud']['crud_inline']["jumlah_group"] = "max='94' onkeyup='subtotal_row(<NUMBERING></NUMBERING>)' onchange='subtotal_row(<NUMBERING></NUMBERING>)' onclick='subtotal_row(<NUMBERING></NUMBERING>)'";
        $page['crud']['crud_inline']["jadwal_kosong"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_after_all'] = "
             <script>
             function change_jadwal(number_row){
                $.ajax({
    
                    type: 'get',
                    data: {
                        'first': link_route,
                        'link_route': $('#load_link_route').val(),
                        'apps': 'Share',
                        'page_view': 'Post',
                        'type': 'hitung_jadwal_kosong',
                        'id': $('#load_id').val(),
                        'frameworksubdomain': $('#load_domain').val(),
                        'tanggal_post': $('#tanggal_post'+number_row).val(),
                        'contentfaiframework': 'get_pages',
                        'MainAll': 2
                    },
                        url: link_route,
                        dataType: 'json',
                        success: function(responseData) {
                            
                            $('#jadwal_kosong'+number_row).val(responseData.jadwal_kosong);
    
    
    
                        }
                    });
                
             }
             function subtotal_row(number_row){
              var jadwal_kosong = parseInt($('#jadwal_kosong'+number_row).val());
                var jumlah_group =parseInt($('#jumlah_group'+number_row).val());
                var max =parseInt($('#jumlah_group'+number_row).attr('max'));
                var harga_per_group =parseInt($('#harga_per_group'+number_row).val());
                var diskon =parseInt($('#diskon'+number_row).val());
                var total_diskon =parseInt($('#total_diskon'+number_row).val());
                if(jumlah_group > max){
                    alert('Jumlah Group Tidak boleh lebih dari '+max);
                    $('#jumlah_group'+number_row).val(max);
                    jumlah_group = max;
                    }
                if(jumlah_group > jadwal_kosong){
                    alert('Jadwal Kosong tidak ada..');
                    // jumlah_group = jadwal_kosong;
                    // $('#jumlah_group'+number_row).val(jadwal_kosong);
                }
                    if(!jumlah_group)
                    jumlah_group=0;
                sub_total = harga_per_group * jumlah_group;
                $('#sub_total'+number_row).val(sub_total);
                if(sub_total<diskon){
                         $('#total_diskon'+number_row).val(sub_total);
                         total_diskon = sub_total;
                }else{
                    $('#total_diskon'+number_row).val(diskon);
                         total_diskon = diskon;
                }
    
                total_biaya = sub_total-total_diskon;
                $('#total_biaya'+number_row).val(total_biaya);
                
                total();
    
             }
             </script>
            ";
      } else
        if ((in_array($page['load']['type'], array('edit', 'view')) or in_array(Partial::input('_view'), array('edit', 'view')))) {
        $page['crud']['crud_inline']["id_share__post"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["id_share__post"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["diskon"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["harga_per_group"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["jumlah_group"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["sub_total"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["diskon"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["total_diskon"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["total_biaya"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["status_pembayaran"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["status_generate"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["id_waktu_post"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["waktu_kosong"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["tanggal_post"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";
        $page['crud']['crud_inline']["jadwal_kosong"] = "readonly style=' background-color: #f0f0f0; color: #888;            border: 1px solid #ccc;    pointer-events: none;cursor: not-allowed;     '";

        DB::table("share__post");
        DB::joinRaw("share__wa_group__post on share__wa_group__post.id_share__post = share__post.id");
        DB::whereRaw("share__wa_group__post.id=" . $page['load']['id']);
        $get = DB::get('all');
        // echo $get['query'];
        $page['crud']['crud_before_all'] = "
            <div class='card card-body'>
            <h5>
                Informasi
            </h5>

            <table style='width:100%'>
            <tr>
                <td>Judul</td>
                <td>:</td>
                <td>" . $get['row'][0]->judul . "</td>
                </tr>
                <tr>
                <td>Media</td>
                <td>:</td>
                <td class='d-flex'>";
        $listimg = explode(',', $get['row'][0]->media);
        foreach ($listimg as $key_number => $img) {
          if ($img) {

            $page['crud']['crud_before_all'] .= "
                    <img style='width:200px; ' src=" . ((in_array($page['load']['type'], array('edit', 'view')) or in_array(Partial::input('_view'), array('edit', 'view'))) ? Partial::get_url_file($page, $img, 'share__post') : 'https://placehold.co/300x300/e2e8f0/e2e8f0') . "
                    data-number='" . $key_number . "' class='img-bg'>";
          }
        }
      }
      $page['crud']['crud_before_all'] .= "    </td>
      </tr>
      <tr>
      <td>Caption</td>
      <td>:</td>
      <td>" . $get['row'][0]->caption . "</td>
      </tr>
      
            </table>
            </div>
            ";
    }
    $search = array();

    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;


    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    $page['load']['tipe_sidebar'] = "Share";
    return $page;
  }
  public static function wag_connect($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "share__wa_group__setting";
    $primary_key = null;
    //kalau board task ini

    $array = array(


      array("group", null, "select", ["chat_wa_phonebook", "", "nama_phone_book", "g"]),
      array("admin", null, "select", ["chat_wa_phonebook", "", "nama_phone_book", "a"]),
    );


    $search = array();

    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;


    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    $page['load']['tipe_sidebar'] = "Share";
    return $page;
  }
  public static function promo($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "share__wa_group__promo";
    $primary_key = null;
    //kalau board task ini

    $array = array(

      array("Kode Promo", null, "text-req"),
      array("Nama Promo", null, "text-req"),
      array("Tanggal Berlaku dari", null, "datetime-local-req"),
      array("Tanggal Berlaku Sampai", null, "datetime-local-req"),
      array("Nominal Potongan Promo", null, "number-req"),
    );


    $search = array();

    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;


    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    $page['load']['tipe_sidebar'] = "Share";
    return $page;
  }
  public static function jam($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "share__wa_group__jam";
    $primary_key = null;
    //kalau board task ini

    $array = array(
      array("Jam", null, "time"),
      array("urutan perioritas", null, "number"),
    );


    $search = array();

    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;


    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    $page['database']['np'] = array();
    $page['load']['tipe_sidebar'] = "Share";
    return $page;
  }
  public static function tanggal_jam($page)
  {
    $page['title'] = ucwords(str_replace("_", " ", __FUNCTION__));
    $page['route'] = __FUNCTION__;
    $page['layout_pdf'] = array('a4', 'portait');

    $database_utama = "share__wa_group__tanggal";
    $primary_key = null;
    //kalau board task ini

    $array = array(
      array("Jam", null, "select", ["share__wa_group__jam", "", "Jam"]),
      array("Tanggal", null, "date"),
      array("Terpakai", null, "select-manual", [1 => "sudah", "0" => "Belum"]),
    );


    $search = array();

    $page['crud']['array'] = $array;
    $page['crud']['search'] = $search;


    $page['database']['utama'] = $database_utama;
    $page['database']['primary_key'] = $primary_key;
    $page['database']['select'] = array("*");;
    $page['database']['join'] = array();
    $page['database']['where'] = array();
    $page['load']['tipe_sidebar'] = "Share";
    return $page;
  }
}
