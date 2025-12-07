<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Db_ extends CI_Model
{
	public function get_login_check($data)
	{
		$query = $this->db->get_where('pendaftaran',$data);
		return $query;
	}
	public function input_database($table,$data){
		$this->db->insert($table,$data);
		return $this->db->insert_id();
	
	}
	public function update_database($table,$key,$data,$costum_id){
		if($costum_id == NULL){
			$this->db->where("id_".$table,$key);
		}else{
			$this->db->where($costum_id,$key);
		}
		$this->db->update($table,$data);
		
		return $this->db->insert_id();
	}public function update_database_all($table,$data){
		
		$this->db->update($table,$data);
		
		return $this->db->insert_id();
	}
	public function delete_database($table,$key,$costum_id){
		if($costum_id == NULL){
			$this->db->where("id_".$table,$key);
		}else{
			$this->db->where($costum_id,$key);
		}
		$this->db->delete($table);
		
	}
	public function read_database($table){
		
		$this->db->select('*')
		->from($table);
		return $this->db->get()->result();
	}public function read_database_count($table){
		
		$this->db->select('*')
		->from($table);
		return $this->db->get()->num_rows();
	}public function read_database_filter($table,$tables,$keyword){
		
		$this->db->select('*')
		->from($table);
		if(gettype($tables)=='array'){
		for($i=0;$i<count($tables);$i++){
			
		$this->db->where($tables[$i],$keyword);
		}
		}else{
		$this->db->where($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_search($table,$tables,$keyword){
		
		$this->db->select('*')
		->from($table);
		if(gettype($tables)=='array'){
			
		for($i=0;$i<count($tables);$i++){
			
		$this->db->like($tables[$i],$keyword);
		}
		}else{
		$this->db->like($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_filter_search($table,$tablefilter,$keyfilter,$tablesearch,$keyword){
		
		$this->db->select('*')
		->from($table);
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		}
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_filter_search_like($table,$tablefilter,$keyfilter,$tablesearch,$keyword,$row_like,$like_value){
		
		$this->db->select('*')
		->from($table);
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		}
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		$this->db->like($row_like,$like_value);
		return $this->db->get()->result();
	}public function read_database_limitSE_filter_search_like($table,$jumlah,$page,$tablefilter,$keyfilter,$tablesearch,$keyword,$row_like,$like_value){
		$pagehalaman = (int) $page*$jumlah;
		$this->db->select('*')
		->from($table)->limit($jumlah,$pagehalaman);;;
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		}
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		$this->db->like($row_like,$like_value);
		return $this->db->get()->result();
	}public function read_database_filter_like($table,$tablefilter,$keyfilter,$row_like,$like_value){
		
		$this->db->select('*')
		->from($table);
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		} 
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		$this->db->like($row_like,$like_value);
		return $this->db->get()->result();
	}public function read_database_limitSE_filter_like($table,$jumlah,$page,$tablefilter,$keyfilter,$row_like,$like_value){
		$pagehalaman = (int) $page*$jumlah;
		$this->db->select('*')
		->from($table)->limit($jumlah,$pagehalaman);;;
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		}
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		
		$this->db->like($row_like,$like_value);
		return $this->db->get()->result();
	}
	public function read_database_search_like($table,$tablesearch,$keyword,$row_like,$like_value){
		
		$this->db->select('*')
		->from($table);
		
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		$this->db->like($row_like,$like_value);
		return $this->db->get()->result();
	}public function read_database_limitSE_search_like($table,$jumlah,$page,$tablesearch,$keyword,$row_like,$like_value){
		$pagehalaman = (int) $page*$jumlah;
		$this->db->select('*')
		->from($table)->limit($jumlah,$pagehalaman);;;
		
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		$this->db->like($row_like,$like_value);
		return $this->db->get()->result();
	}public function read_database_limitSE_like($table,$jumlah,$page,$row_like,$like_value){
		$pagehalaman = (int) $page*$jumlah;
		$this->db->select('*')
		->from($table)->limit($jumlah,$pagehalaman);;;
		
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		$this->db->like($row_like,$like_value);
		return $this->db->get()->result();
	}public function read_database_limitSE($table,$jumlah,$page){
		$pagehalaman = (int) $page*$jumlah;
	
		$this->db->select('*')
		->from($table)->limit($jumlah,$pagehalaman);;
		return $this->db->get()->result();
	}public function read_database_limitSE_filter($table,$jumlah,$page,$tables,$keyword){
		
	
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);;
		if(gettype($tables)=='array'){
		for($i=0;$i<count($tables);$i++){
			
		$this->db->where($tables[$i],$keyword);
		}}else{
		$this->db->where($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_limitSE_search($table,$jumlah,$page,$tables,$keyword){
		
	
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);;
		if(gettype($tables)=='array'){
		for($i=0;$i<count($tables);$i++){
			
		$this->db->like($tables[$i],$keyword);
		}
		}else{
		$this->db->like($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_limitSE_filter_search($table,$jumlah,$page,$tablefilter,$keyfilter,$tablesearch,$keyword){
		
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		}
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_order_filter($table,$order_by,$order_value,$tables,$keyword){
		
		$this->db->select('*')
		->from($table);
		$this->db->order_by($order_by,$order_value);
		if(gettype($tables)=='array'){
		for($i=0;$i<count($tables);$i++){
			
		$this->db->where($tables[$i],$keyword);
		}
		}else{
		$this->db->where($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_order_search($table,$order_by,$order_value,$tables,$keyword){
		
		$this->db->select('*')
		->from($table);
		$this->db->order_by($order_by,$order_value);
		if(gettype($tables)=='array'){
			
		for($i=0;$i<count($tables);$i++){
			
		$this->db->like($tables[$i],$keyword);
		}
		}else{
		$this->db->like($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_order_filter_search($table,$order_by,$order_value,$tablefilter,$keyfilter,$tablesearch,$keyword){
		
		$this->db->select('*')
		->from($table);
		$this->db->order_by($order_by,$order_value);
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		}
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_order_limitSE($table,$order_by,$order_value,$jumlah,$page){
		$pagehalaman = (int) $page*$jumlah;
	
		$this->db->select('*')
		->from($table)->limit($jumlah,$pagehalaman);;
		$this->db->order_by($order_by,$order_value);
		return $this->db->get()->result();
	}public function read_database_order_limitSE_filter($table,$order_by,$order_value,$jumlah,$page,$tables,$keyword){
		
	
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);;
		$this->db->order_by($order_by,$order_value);
		if(gettype($tables)=='array'){
		for($i=0;$i<count($tables);$i++){
			
		$this->db->where($tables[$i],$keyword);
		}}else{
		$this->db->where($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_order_limitSE_search($table,$order_by,$order_value,$jumlah,$page,$tables,$keyword){
		
	
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);;
		$this->db->order_by($order_by,$order_value);
		if(gettype($tables)=='array'){
		for($i=0;$i<count($tables);$i++){
			
		$this->db->like($tables[$i],$keyword);
		}
		}else{
		$this->db->like($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_order_limitSE_filter_search($table,$order_by,$order_value,$jumlah,$page,$tablefilter,$keyfilter,$tablesearch,$keyword){
		
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);
		$this->db->order_by($order_by,$order_value);
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		}
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_where_limitSE($table,$where_row,$where_value,$jumlah,$page){
		
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);
		if(gettype($where_row)=='array'){
		for($i=0;$i<count($where_row);$i++){
			
			$this->db->where($where_row[$i],$where_value[$i]);;
		}
		}else{
			$this->db->where($where_row,$where_value);;
			
		}
		
		
		return $this->db->get()->result();
	}public function read_database_where_order_filter($table,$where_row,$where_value,$order_by,$order_value,$tables,$keyword){
		
		$this->db->select('*')
		->from($table);
		$this->db->where($where_row,$where_value);
		if(gettype($order_value)=='array'){
			for($i=0;$i<count($order_value);$i++){
				$this->db->order_by($order_by,$order_value[$i]);
			}
		}else{
		$this->db->order_by($order_by,$order_value);
			
		}
		if(gettype($tables)=='array'){
		for($i=0;$i<count($tables);$i++){
			
		$this->db->where($tables[$i],$keyword);
		}
		}else{
		$this->db->where($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_where_order_search($table,$where_row,$where_value,$order_by,$order_value,$tables,$keyword){
		
		$this->db->select('*')
		->from($table);
		$this->db->where($where_row,$where_value);
		
		if(gettype($order_value)=='array'){
			for($i=0;$i<count($order_value);$i++){
				$this->db->order_by($order_by,$order_value[$i]);
			}
		}else{
		$this->db->order_by($order_by,$order_value);
			
		}
		if(gettype($tables)=='array'){
			
		for($i=0;$i<count($tables);$i++){
			
		$this->db->like($tables[$i],$keyword);
		}
		}else{
		$this->db->like($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_where_order_filter_search($table,$where_row,$where_value,$order_by,$order_value,$tablefilter,$keyfilter,$tablesearch,$keyword){
		
		$this->db->select('*')
		->from($table);
		$this->db->where($where_row,$where_value);
		$this->db->order_by($order_by,$order_value);
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		}
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_where_order_limitSE($table,$where_row,$where_value,$order_by,$order_value,$jumlah,$page){
		$pagehalaman = (int) $page*$jumlah;
	
		$this->db->select('*')
		->from($table)->limit($jumlah,$pagehalaman);;
		$this->db->where($where_row,$where_value);
		$this->db->order_by($order_by,$order_value);
		return $this->db->get()->result();
	}public function read_database_where_order_limitSE_filter($table,$where_row,$where_value,$order_by,$order_value,$jumlah,$page,$tables,$keyword){
		
	
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);;
		$this->db->where($where_row,$where_value);
		$this->db->order_by($order_by,$order_value);
		if(gettype($tables)=='array'){
			for($i=0;$i<count($tables);$i++){
				$this->db->where($tables[$i],$keyword);
			}
		}else{
			$this->db->where($tables,$keyword);
		}
		return $this->db->get()->result();
	}public function read_database_where_order_limitSE_search($table,$where_row,$where_value,$order_by,$order_value,$jumlah,$page,$tables,$keyword){
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);;
		$this->db->where($where_row,$where_value);
		$this->db->order_by($order_by,$order_value);
		if(gettype($tables)=='array'){
		for($i=0;$i<count($tables);$i++){
			
		$this->db->like($tables[$i],$keyword);
		}
		}else{
		$this->db->like($tables,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_where_order_limitSE_filter_search($table,$where_row,$where_value,$order_by,$order_value,$jumlah,$page,$tablefilter,$keyfilter,$tablesearch,$keyword){
		
		$this->db->select('*')
		->from($table)->limit($jumlah,$page*$jumlah);
		$this->db->where($where_row,$where_value);
		$this->db->order_by($order_by,$order_value);
		if(gettype($tablefilter)=='array'){
		for($i=0;$i<count($tablefilter);$i++){
			
		$this->db->where($tablefilter[$i],$keyfilter);
		}
		}else{
		$this->db->where($tablefilter,$keyfilter);
			
		}
		if(gettype($tablesearch)=='array'){
			
		for($i=0;$i<count($tablesearch);$i++){
			
		$this->db->like($tablesearch[$i],$keyword);
		}
		}else{
		$this->db->like($tablesearch,$keyword);
			
		}
		return $this->db->get()->result();
	}public function read_database_where($table,$where_row,$where_value){
		
		$this->db->select('*')
		->from($table);
		if($where_row == null){
			$where_row = 'id_'.$table;
		}
		//print_r($where_row);
		if(gettype($where_row)=='array'){
		
		for($i=0;$i<count($where_row);$i++){
			
			$this->db->where($where_row[$i],$where_value[$i]);
		}
		}else{
			
		$this->db->where($where_row,$where_value);
		}
		return $this->db->get()->result();
	}public function read_database_where_or_where($table,$where_row,$where_value,$or_where_row,$or_where_value){
		
		$this->db->select('*')
		->from($table);
		if($where_row == null){
			$where_row = 'id_'.$table;
		}
		$this->db->where($where_row,$where_value);
		$this->db->or_where($or_where_row,$or_where_value);
		return $this->db->get()->result();
	}public function read_database_where_multiple_max($table,$where_row,$where_value,$select_max){
		
		$this->db->select_max($select_max)
		->from($table);
		if($where_row == null){
			$where_row = 'id_'.$table;
		}
		for($i=0;$i<count($where_row);$i++){
			
			$this->db->where($where_row[$i],$where_value[$i]);
		}
		
		
		return $this->db->get()->result();
	}public function read_database_where_multiple_avg($table,$where_row,$where_value,$select_avg){
		
		$this->db->select_avg($select_avg)
		->from($table);
		for($i=0;$i<count($where_row);$i++){
			
			$this->db->where($where_row[$i],$where_value[$i]);
		}
		
		
		return $this->db->get()->result();
	}public function read_database_where_multiple_asosiasi($table,$where_row,$aso_where,$where_value){
		
		$this->db->select('*')
		->from($table);
		if($where_row == null){
			$where_row = 'id_'.$table;
		}
		for($i=0;$i<count($where_row);$i++){
			
			$this->db->where($where_row[$i].$aso_where[$i],$where_value[$i]);
		}
		
		
		return $this->db->get()->result();
	}public function read_database_where_multiple_asosiasi_like($table,$where_row,$aso_where,$where_value,$like_row,$like_value){
		
		$this->db->select('*')
		->from($table);
		if($where_row == null){
			$where_row = 'id_'.$table;
		}
		for($i=0;$i<count($where_row);$i++){
			
			$this->db->where($where_row[$i].$aso_where[$i],$where_value[$i]);
		}
			$this->db->like($like_row,$like_value);
		
		return $this->db->get()->result();
	}public function read_database_where_multiple_or_where($table,$where_row,$where_value,$or_where_row,$or_where_value){
		
		$this->db->select('*')
		->from($table);
		if($where_row == null){
			$where_row = 'id_'.$table;
		}
		for($i=0;$i<count($where_row);$i++){
			
			$this->db->where($where_row[$i],$where_value[$i]);
		}
		for($i=0;$i<count($where_row);$i++){
			
			$this->db->or_where($or_where_row[$i],$or_where_value[$i]);
		}
		
		return $this->db->get()->result();
	}public function read_database_like($table,$like_row,$like_value){
		
		$this->db->select('*')
		->from($table);
		$this->db->like($like_row,$like_value);
		return $this->db->get()->result();
	}public function read_database_like_count($table,$like_row,$like_value){
		
		$this->db->select('*')
		->from($table);
		$this->db->like($like_row,$like_value);
		return $this->db->get()->num_rows();
	}public function read_database_where_like($table,$where_row,$where_value,$like_row,$like_value){
		
		$this->db->select('*')
		->from($table);
	
			
		$this->db->where($where_row,$where_value);
	
		$this->db->like($like_row,$like_value);
		return $this->db->get()->result();
	}public function read_database_where_like_count($table,$where_row,$where_value,$like_row,$like_value){
		
		$this->db->select('*')
		->from($table);
	
			
		$this->db->where($where_row,$where_value);
	
		$this->db->like($like_row,$like_value);
		return $this->db->get()->num_rows();
	}public function read_database_where_multiple_like_order($table,$where_row,$where_value,$like_row,$like_value,$order_row,$order){
		
		$this->db->select('*')
		->from($table)->order_by($order_row,$order);
		for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row[$i],$where_value[$i]);
		}
		$this->db->like($like_row,$like_value);
		return $this->db->get()->result();
	}public function read_database_where_multiple_like($table,$where_row,$where_value,$like_row,$like_value){
		
		$this->db->select('*')
		->from($table);
		for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row[$i],$where_value[$i]);
		}
		$this->db->like($like_row,$like_value);
		return $this->db->get()->result();
	}public function read_database_where_multiple($table,$where_row,$where_value){
		
		$this->db->select('*')
		->from($table);
		for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row[$i],$where_value[$i]);
		}
		return $this->db->get()->result();
	}public function read_database_where_sum($table,$where_row,$where_value,$select){
		$this->db->select_sum($select)
		->from($table);	
		if(gettype($where_row)=='array'){
			for($i=0;$i<count($where_row);$i++){
				$this->db->where($where_row[$i],$where_value[$i]);
			}
		}else{
			$this->db->where($where_row,$where_value);
		}		
		$query = $this->db->get();
		foreach($query->result_array() as $hasil){
			$out= $hasil[$select];
		}if($out==''){
			$out=0;
		}
		return $out;
		
	}public function read_database_where_multiple_sum($table,$where_row,$where_value,$select){
		$this->db->select_sum($select)
		->from($table);
		for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row[$i],$where_value[$i]);
		}
		return $this->db->get()->result();
	}public function read_database_where_distint($table,$where_row,$where_value,$select){
		$this->db->distinct();
		$this->db->select($select)
		->from($table);
		//for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row,$where_value);
		//}
		return $this->db->get()->result();
	}public function read_database_where_multiple_distint($table,$where_row,$where_value,$select){
		$this->db->distinct();
		$this->db->select($select)
		->from($table);
		for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row[$i],$where_value[$i]);
		}
		return $this->db->get()->result();
	}public function read_database_where_multiple_distint_count($table,$where_row,$where_value,$select){
		$this->db->distinct();
		$this->db->select($select)
		->from($table);
		for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row[$i],$where_value[$i]);
		}
		return $this->db->get()->num_rows();
	}public function read_database_where_multiple_count($table,$where_row,$where_value){
		
		$this->db->select('*')
		->from($table);
		for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row[$i],$where_value[$i]);
		}
		return $this->db->get()->num_rows();
	}public function read_database_not_where($table,$where_row,$where_value){
		
		$this->db->select('*')
		->from($table)->not_like($where_row,$where_value);
		return $this->db->get()->result();
	}
	public function read_database_select_where_order($table,$select,$where_row,$where_value,$order_row,$order){
		
		$this->db->select($select)
		->from($table)->where($where_row,$where_value)->order_by($order_row,$order);
		return $this->db->get()->result();
	}public function read_database_where_order($table,$where_row,$where_value,$order_row,$order){
		
		$this->db->select('*')
		->from($table)->where($where_row,$where_value)->order_by($order_row,$order);
		return $this->db->get()->result();
	}public function read_database_where_order_count($table,$where_row,$where_value,$order_row,$order){
		
		$this->db->select('*')
		->from($table)->where($where_row,$where_value)->order_by($order_row,$order);
		return $this->db->get()->num_rows();
	}public function read_database_order($table,$order_row,$order){
		
		$this->db->select('*')
		->from($table)->order_by($order_row,$order);
		return $this->db->get()->result();
	}public function read_database_where_limit($table,$where_row,$where_value,$limit){
		
		$this->db->select('*')
		->from($table)->where($where_row,$where_value)->limit($limit);
		return $this->db->get()->result();
	}public function read_database_where_order_limit($table,$where_row,$where_value,$order_row,$order,$limit){
		
		$this->db->select('*')
		->from($table)->where($where_row,$where_value)->order_by($order_row,$order)->limit($limit);
		return $this->db->get()->result();
	}public function read_database_where_order_limit_count($table,$where_row,$where_value,$order_row,$order,$limit){
		
		$this->db->select('*')
		->from($table)->where($where_row,$where_value)->order_by($order_row,$order)->limit($limit);
		return $this->db->get()->num_rows();
	}
	
	public function read_database_wheremultiple_order_limit($table,$where_row,$where_value,$order_row,$order,$limit){
		
		$this->db->select('*')
		->from($table)->order_by($order_row,$order)->limit($limit);
		for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row[$i],$where_value[$i]);
		}
		return $this->db->get()->result();
	}
	public function read_database_random_limit($table,$limit){
		
		$this->db->select('*')
				->from($table)
				->order_by('', 'random')
				->limit($limit);  
			
		return $this->db->get()->result();
	}
	public function read_database_wheremultiple_order_limit_count($table,$where_row,$where_value,$order_row,$order,$limit){
		
		$this->db->select('*')
		->from($table)->order_by($order_row,$order)->limit($limit);
		for($i=0;$i<count($where_row);$i++){
			
		$this->db->where($where_row[$i],$where_value[$i]);
		}
		return $this->db->get()->num_rows();
	}
	
	public function read_database_order_limit($table,$order_row,$order,$limit){
		
		$this->db->select('*')
		->from($table)->order_by($order_row,$order)->limit($limit);
		return $this->db->get()->result();
	}
	public function read_database_where_count($table,$where_row,$where_value){
		
		
		$this->db->select('*')
		->from($table);
		
			$this->db->where($where_row,$where_value);
		
		return $this->db->get()->num_rows();
	
	}public function read_database_where_count_order($table,$where_row= array(),$where_value= array(),$order_row,$order_value){
		
		
		$this->db->select('*')
		->from($table)->order_by($order_row,$order_value);
		for($i=0;$i<count($where_row);$i++){
			$this->db->where($where_row[$i],$where_value[$i]);
		}
		return $this->db->get()->num_rows();
	
	}public function range_siswa($id_siswa,$start,$end){
		
		
		$this->db->distinct('*');
		$this->db->select('tanggal')
		->from('absen_perkembangan');
		$this->db->where('id_siswa_sekolah',$id_siswa);
		$this->db->where('tanggal >=',$start);
		$this->db->where('tanggal <=',$end);
		
		return $this->db->get()->result();
	
	}
	public function out_database_multiple($table,$where_row,$where_value,$output){
	

		
		for($i=0;$i<count($where_row);$i++){
			
		$data[$where_row[$i]] = $where_value[$i];
		}
		$query = $this->db->get_where($table,$data);
		if($query->num_rows() > 0){
		foreach($query->result_array() as $hasil){
			$out= $hasil[$output];
		return $out;
		}
		}
	
	}
	public function out_database($table,$id,$output,$costum_id){
		
		if($costum_id == NULL){
			
		$data['id_'.$table]=$id;
		}else{
		$data[$costum_id]= $id;
			
		}
		
		$query = $this->db->get_where($table,$data);
		if($query->num_rows() > 0){
			
		foreach($query->result_array() as $hasil){
			$out= $hasil[$output];
		return $out;
		}
		
		}else{
			return "Data tidak ditemukan ";
			
		}
	
	}public function out_database_init($table,$id,$output,$costum_id,$init){
		
		if($costum_id == NULL){
			
		$data['id_'.$table]=$id;
		}else{
		$data[$costum_id]= $id;
			
		}
		
		$query = $this->db->get_where($table,$data);
		if($query->num_rows() > 0){
			
		foreach($query->result_array() as $hasil){
			$out= $hasil[$output];
		return $out;
		}
		
		}else{
			return $init;
			
		}
	
	}
	public function out_database_avg_where($table,$avg,$where_row,$where_value){
		$this->db->select_avg($avg);
		$this->db->where($where_row,$where_value);
		return $this->db->get($table)->result();
		
		}
	public function read_database_distint($table,$select)
	{
		$this->db->distinct();
		$this->db->select($select)
		->from($table);
		return $this->db->get()->result_object();
	}
	public function get_file($data,$database){
		$this->db->select("*");
		$this->db->from("apps_file");
		$this->db->where("id_ext",$data);
		$this->db->where("database",$database);
		return $this->db->get()->result();
	
	}public function count_ngajar_satu_hari($date,$id_sekolah,$id_pengajar){
		$this->db->select("*");
		$this->db->from("absen");
		$this->db->where("id_sekolah",$id_sekolah);
		$this->db->where("tanggal",$date);
		$this->db->where("id_pengajar",$id_pengajar);
		return $this->db->get()->num_rows();
	
	}public function count_absen_siswa($id_sekolah,$date){
		$this->db->select("*");
		$this->db->from("absen_siswa");
		$this->db->where("id_kbm",$id_sekolah);
		$this->db->where("tanggal",$date);
		return $this->db->get()->num_rows();
	
	}
	
	public function in_database($table,$id,$costum_id,$output){
		
		
		$data['id_'.$costum_id]=$id;
		
		
		$query = $this->db->get_where($table,$data);
		
		if($output != NULL){
			
		foreach($query->result_array() as $hasil){
			
		return $hasil[$output];
		}
		}else{
			
		return $query;
		}
		
	
	}
	public function tabledonatur($id){
		$table_donatur = "((SELECT user_front.id as id_user_front,CONCAT(donatur.nama,' (donatur biasa)') AS nama ,donatur.no_hp,donatur.email,donatur.id_kota,donatur.id 
							FROM `user_front`
							join donatur 
							on user_front.id = donatur.id_user_front
							order by donatur.nama asc)
							UNION
						    (SELECT user_front.id as id_user_front, CONCAT(pendaftaran.nama,' (donatur mahasiswa)') AS nama,pendaftaran.no_hp,pendaftaran.email,pendaftaran.id_kota,pendaftaran.id
							FROM `user_front`
							join pendaftaran 
							on user_front.id = pendaftaran.id_user_front
							order by pendaftaran.nama asc)							 
							)
							as donatur";
		return $this->db->from($table_donatur)->where('id_user_front',$id)->get()->result();
	}
}
