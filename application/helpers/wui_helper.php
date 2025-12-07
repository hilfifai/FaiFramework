<?php
 function ltw_header()
	{
		$i=-1;
		if($_SERVER['HTTP_HOST']=='advance.wuiapps.com' or $_SESSION['id_apps']=='2021031816193639478'){
			
		$i++;
		$header['nama'][$i] = 'Dashboard';
		$header['link'][$i] = r('_lifetime_work','Dashboard/index');
		$header['active'][$i] = array($header['link'][$i]);
		$i++;
		$header['nama'][$i] = 'Life Goals';
		$header['link'][$i] = r('_lifetime_work','Goals/index');
		$header['active'][$i] = array($header['link'][$i]);
		} 
		$i++;
		$header['nama'][$i] = 'Habits';
		$header['link'][$i] = r('_lifetime_work','Habits/index/habits');
		$header['active'][$i] = array($header['link'][$i]);
		
		$i++;
		$header['nama'][$i] = 'Amalan Yaumiah';
		$header['link'][$i] = r('_lifetime_work','Habits/index/amalan');
		$header['active'][$i] = array($header['link'][$i]);
		
		$i++;
		$header['nama'][$i] = 'Task Planner';
		$header['link'][$i] = r('_lifetime_work','Planner/index'); 
		$header['active'][$i] = array($header['link'][$i]);
		
		if($_SERVER['HTTP_HOST']=='advance.wuiapps.com' or $_SESSION['id_apps']=='2021031816193639478'){
		$i++;
		$header['nama'][$i] = 'Task Mission';
		$header['link'][$i] = r('_lifetime_work','Mision/index'); 
		$header['active'][$i] = array($header['link'][$i]);
		
		
		
		$i++;
		$header['nama'][$i] = 'Catatan Hidup';
		$header['link'][$i] = r('_lifetime_work','Habits/amalan');
		$header['active'][$i] = array($header['link'][$i]);
		
		$i++;
		$header['nama'][$i] = 'Keuangan';
		$header['link'][$i] = r('_lifetime_work','Keuangan/index');
		$header['active'][$i] = array($header['link'][$i]);
		
		$i++;
		$header['nama'][$i] = 'File  & Moment';
		$header['link'][$i] = r('_lifetime_work','Moment/index');
		$header['active'][$i] = array($header['link'][$i]);
		}
		return $header;
	}
	
	function initialize_payment($page,$id_to_page,$perihal){
		$ci        = &get_instance();
		$user = $ci->db->where('id_apps_user',$_SESSION['id_apps'])->get('program__user')->row();
		$get  = $ci->db->where('id_apps_user',$_SESSION['id_apps'])
					->where('page',$page)
					->where('id_to_page',$id_to_page)
					->where('perihal',$perihal)
					->where('status','aktif')
					->get('payment');
		if(!$get->num_rows())
		{
			
			$insert['id_apps_user'] = $_SESSION['id_apps'];
			$insert['page'] = $page; 
			$insert['id_to_page'] = $id_to_page; 
			$insert['perihal'] = $perihal; 
			$insert['status'] = 'aktif'; 
			$insert['created_at'] = dat();
			$insert['nomor_invoice'] = date('ymdHis').rand(10000,99999);
			$ci->db->insert('payment',$insert);
			$id = $ci->db->insert_id();
			$get = $ci->db->where('id_payment',$id)->where('status','aktif')->get('payment');
		}
		return $get->row()->id_payment;
	}
	function payment_detail($id_payment,$type,$item,$nominal,$note='',$number=null){
			$ci = &get_instance();
			$insert['id_apps_user']=$_SESSION['id_apps'];
			$insert['id_payment']=$id_payment;
			$insert['type']=$type;
			
			$insert['item'] = $item;
			$insert['status'] ='aktif';
			$num = $ci->db->where($insert)->get('payment__detail');
			$insert['note'] = $note;
			$insert['nominal']= $nominal;
			$insert['number_per']= $number;
			$insert['date_add'] = dat();
			if($num->num_rows()){
				$ci->db->where('id_payment_detail',$num->row()->id_payment_detail);
				$ci->db->update('payment__detail',$insert);
			}else{
				$ci->db->insert('payment__detail',$insert);
			}	
			echo $ci->db->last_query();
	}
	function initialize_midtrans($id,$invoice,$payment_type,$payment_brand)
	{
		$ci        = &get_instance();
		
		$data_detail = $ci->db->where('id_payment',$id)->get('payment__detail');
		$total        = 0;
		foreach($data_detail->result() as $detail)
		{
			if($detail->type=='diskon' or $detail->type=='potongan'){
				$prefix= '-';					
				$total -= $detail->nominal;
			}	
			else{
				
				$prefix= '';					
				$total += $detail->nominal;
			}
			$item[] = array(
				'id'      => $detail->id,
				'price'   => $prefix.$detail->nominal,
				'type'		=> $detail->type,
				"quantity"	=> 1,
				'name'    => $detail->item
			);
		}
		$items               = ($item);


		$transaction_details = array(
			'order_id'    => $invoice.date('YmdHis'),
			'gross_amount'=> $total
		);
		$user_all        =
		$ci->db->where('id_apps_user',$_SESSION['id_apps'])
		->join('apps_wilayah__kabupaten','apps_user.id_kota_user = apps_wilayah__kabupaten.kota_id','left')
		->join('apps_wilayah__provinsi','apps_wilayah__provinsi.provinsi_id = apps_wilayah__kabupaten.provinsi_id')
		->get('apps_user')->row();
		// Populate customer's billing address
		$billing_address = array(
			'first_name'  => $user_all->nama_lengkap,
			'last_name'   => "",
			'address'     => $user_all->alamat,
			'city'        => $user_all->type.' '.$user_all->kota_name,
			'postal_code' => $user_all->kode_pos,
			'phone'       => $user_all->no_hp,
			'country_code'=> 'IDN'
		);

		// Populate customer's shipping address
		$shipping_address = array(
			'first_name'  => "WUI",
			'last_name'   => "APPS",
			'address'     => "Jl Babakan Ciserueuh Timur RT 01/07",
			'city'        => "Bandung",
			'postal_code' => "40255",
			'phone'       => "08987423444",
			'country_code'=> 'IDN'
		);
		//billing address (alamat penagihan) sama seperti alamat pengiriman (shipping address).
		// Populate customer's info
		$customer_details = array(
			'first_name'      => $user_all->nama_lengkap,
			'last_name'       => "",
			'email'           => $user_all->email,
			'phone'           => $user_all->no_hp,
			'billing_address' => $billing_address,
			'shipping_address'=> $shipping_address
		);

		// Token ID from checkout page
		//$token_id = "asasa21212312";

		// Transaction data to be sent

		$transaction_data['payment_type'] = $payment_type;
		;
		if($payment_type == 'bank_transfer')
		{
			
			$transaction_data['bank_transfer'] = array('bank'=> $payment_brand);
		}
		else
		if($payment_type == 'cstore')
		{
			$transaction_data['cstore'] = array('store'  => $payment_brand,'message'=> "We Are Islam Store");
		}
		$transaction_data['transaction_details'] = $transaction_details;
		$transaction_data['item_details'] = $items;
		$transaction_data['customer_details'] = $customer_details;
		//print_r($transaction_data);
		$response = (remotePost(json_encode($transaction_data,true)));
		$response = json_decode($response,TRUE);
		//print_r($response);
		
		$data['id_payment'] = $id;
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
		if($payment_type == 'cstore')
		{
			 
			$data['payment_code'] = $kode_pembayaran = $response['payment_code'];
			$data['store'] = $response['store'];
		}
		else
		if($payment_type == 'bank_transfer')
		{
			if($payment_brand!='permata'){
						
				$data['bank'] = $response['va_numbers'][0]['bank'];
				$data['va_numbers'] = $kode_pembayaran =$response['va_numbers'][0]['va_number'];	
			}else{
				echo'tess';
				$data['bank'] = $payment_brand;
				$data['va_numbers'] = $kode_pembayaran =$response['permata_va_number'];	
			}
			$data['fraud_status'] = $response['fraud_status'];
		}
		$ci->db->insert('payment__midtrans',$data);
		
		$bayar['id_midtrans']=$ci->db->insert_id();
		$bayar['status_bayar']='check_pembayaran';
		$ci->db->where('id_payment',$id)->update('payment',$bayar);
	}
	