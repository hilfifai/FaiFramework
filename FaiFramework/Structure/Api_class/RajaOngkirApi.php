<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RajaOngkirApi extends CI_Controller
{

	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('lib');
	}

	

	public function province2()
	{

		error_reporting(0);
		switch($_GET['q'])
		{
			case 'kotaasal':
			$curl = curl_init();
			curl_setopt_array($curl, array(
					CURLOPT_URL           => "http://api.rajaongkir.com/starter/city",
					CURLOPT_RETURNTRANSFER=> true,
					CURLOPT_ENCODING      => "",
					CURLOPT_MAXREDIRS     => 10,
					CURLOPT_TIMEOUT       => 30,
					CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER     => array(
						"key: 4c3ffe6b7434eae84a122b6f581799f4"
					),
				));
			$response = curl_exec($curl);
			$err      = curl_error($curl);
			curl_close($curl);
			$data     = json_decode($response, true);
			for($i = 0; $i < count($data['rajaongkir']['results']); $i++)
			{
				echo "<option></option>";
				echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
			}
			break;



			case 'kotatujuan':
			$curl = curl_init();
			curl_setopt_array($curl, array(
					CURLOPT_URL           => "http://api.rajaongkir.com/starter/city",
					CURLOPT_RETURNTRANSFER=> true,
					CURLOPT_ENCODING      => "",
					CURLOPT_MAXREDIRS     => 10,
					CURLOPT_TIMEOUT       => 30,
					CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER     => array(
						"key: 4c3ffe6b7434eae84a122b6f581799f4"
					),
				));
			$response = curl_exec($curl);
			$err      = curl_error($curl);
			curl_close($curl);
			$data     = json_decode($response, true);
			for($i = 0; $i < count($data['rajaongkir']['results']); $i++)
			{
				echo "<option></option>";
				echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
			}
			break;

		}


	}

	public static function province($costum_code='',$costum_link='')
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_URL           => ($costum_link?$costum_link:"https://api.rajaongkir.com/starter/province"),
				CURLOPT_RETURNTRANSFER=> true,
				CURLOPT_ENCODING      => "",
				CURLOPT_MAXREDIRS     => 10,
				CURLOPT_TIMEOUT       => 30,
				CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER     => array(
					"key: ".($costum_code?$costum_code:"4c3ffe6b7434eae84a122b6f581799f4")
				),
			));

		$response = curl_exec($curl);
		$err      = curl_error($curl);
		curl_close($curl);

		if($err)
		{
			echo 'cURL Error #:' . $err;
		}
		else
		{
			return $response;
		}
	}

	public static function city($select=null,$costum_code='',$costum_link='',$return='')
	{
		$id   = Partial::input('q');

		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_URL           => ($costum_link?$costum_link:"https://api.rajaongkir.com/starter/city"),
				CURLOPT_RETURNTRANSFER=> true,
				CURLOPT_ENCODING      => "",
				CURLOPT_MAXREDIRS     => 10,
				CURLOPT_TIMEOUT       => 30,
				CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER     => array(
					"key: ".($costum_code?$costum_code:"4c3ffe6b7434eae84a122b6f581799f4")
				),
			));
			// https://pro.rajaongkir.com/api/city?province=1
		$response = curl_exec($curl);
		$err      = curl_error($curl);
		curl_close($curl);

		if($err)
		{
			echo 'cURL Error #:' . $err;
		}
		else if($return=='json')
		{
			return $response;
		}
		else
		{
			$data = json_decode($response, true);
			for($i = 0; $i < count($data['rajaongkir']['results']); $i++){
				if($select){
					if($select==$data['rajaongkir']['results'][$i]['city_id'])
					$selected = "selected";
					else
					$selected = "";
				}else{
					
					$selected = "";
				}
				echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."' $selected>".$data['rajaongkir']['results'][$i]['type']." ".$data['rajaongkir']['results'][$i]['city_name']."</option>";
			}
		}
	}
	public static function subdistrict($select=null,$costum_code='',$costum_link='',$return='')
	{
		$id   = Partial::input('q');

		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_URL           => ($costum_link?$costum_link:"https://api.rajaongkir.com/starter/city"),
				CURLOPT_RETURNTRANSFER=> true,
				CURLOPT_ENCODING      => "",
				CURLOPT_MAXREDIRS     => 10,
				CURLOPT_TIMEOUT       => 30,
				CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER     => array(
					"key: ".($costum_code?$costum_code:"4c3ffe6b7434eae84a122b6f581799f4")
				),
			));
			// https://pro.rajaongkir.com/api/city?province=1
		$response = curl_exec($curl);
		$err      = curl_error($curl);
		curl_close($curl);

		if($err)
		{
			echo 'cURL Error #:' . $err;
		}
		else if($return=='json')
		{
			return $response;
		}
		else
		{
			$data = json_decode($response, true);
			for($i = 0; $i < count($data['rajaongkir']['results']); $i++){
				if($select){
					if($select==$data['rajaongkir']['results'][$i]['city_id'])
					$selected = "selected";
					else
					$selected = "";
				}else{
					
					$selected = "";
				}
				echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."' $selected>".$data['rajaongkir']['results'][$i]['type']." ".$data['rajaongkir']['results'][$i]['city_name']."</option>";
			}
		}
	}
	public function city_province()
	{
		$id   = Partial::input('q');

		$curl = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_URL           => "https://api.rajaongkir.com/starter/city?province=".$id,
				CURLOPT_RETURNTRANSFER=> true,
				CURLOPT_ENCODING      => "",
				CURLOPT_MAXREDIRS     => 10,
				CURLOPT_TIMEOUT       => 30,
				CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER     => array(
					"key: 4c3ffe6b7434eae84a122b6f581799f4"
				),
			));

		$response = curl_exec($curl);
		$err      = curl_error($curl);
		curl_close($curl);

		if($err)
		{
			echo 'cURL Error #:' . $err;
		}
		else
		{
			$data = json_decode($response, true);
			for($i = 0; $i < count($data['rajaongkir']['results']); $i++){
				echo "<option value='".$data['rajaongkir']['results'][$i]['city_id']."'>".$data['rajaongkir']['results'][$i]['city_name']."</option>";
			}
		}
	}

	function cost()
	{
		$origin      = Partial::input('origincity');
		$destination = Partial::input('destinationcity');
		$weight      = Partial::input('weight') * 1000;
		$courier     = Partial::input('courier');

		$curl        = curl_init();
		curl_setopt_array($curl, array(
				CURLOPT_URL           => "https://api.rajaongkir.com/starter/cost",
				CURLOPT_RETURNTRANSFER=> true,
				CURLOPT_ENCODING      => "",
				CURLOPT_MAXREDIRS     => 10,
				CURLOPT_TIMEOUT       => 30,
				CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS    => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".$courier,
				CURLOPT_HTTPHEADER     => array(
					"content-type: application/x-www-form-urlencoded",
					"key: 4c3ffe6b7434eae84a122b6f581799f4"
				),
			));

		$response = curl_exec($curl);
		$err      = curl_error($curl);

		curl_close($curl);

		if($err)
		{
			echo "cURL Error #:" . $err;
		}
		else
		{
			// $data['query'] = json_decode($response);
			// $this->lib->template('tarif', $data);
		}
	}
	public static function getOngkir($kota_asal, $kota_tujuan, $berat, $kurir)
    {
        $origin      = $kota_asal;
        $destination = $kota_tujuan;
        $weight      = $berat;
        $courier     = $kurir;

        $curl        = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL           => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING      => "",
            CURLOPT_MAXREDIRS     => 10,
            CURLOPT_TIMEOUT       => 30,
            CURLOPT_HTTP_VERSION  => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS    => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier,
            CURLOPT_HTTPHEADER         => array(
                "content-type: application/x-www-form-urlencoded",
                "key: 4c3ffe6b7434eae84a122b6f581799f4"
            ),
        ));

        $response = curl_exec($curl);
        $err      = curl_error($curl);

        curl_close($curl);

        if ($err) {
            //echo "cURL Error #:" . $err;
        } else {
            $data['query'] = json_decode($response);
            //$this->lib->template('tarif', $data);
            return json_decode($response);
        }
    }
    
}
