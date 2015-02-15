<?php 
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2015-02-15 18:40:55
	**/
namespace Models;
use Resources;

class M_masuk {
    public function __construct(){
		// DB koneksi default
		$this->db = new Resources\Database;
		$this->tb = "tb_pengguna"; //nama tabel database
    }
    public function query_masuk($user="",$pw=""){
    	$query = $this->db->results("select * from ".$this->tb." where username='".$user."' and password='".$pw."'"); //query
    	return $query[0];
    }
}