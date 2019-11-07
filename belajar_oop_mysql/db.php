<?php
/*
class ini berfungsi u/ memudahkan transaksi dgn mysql
terdiri dari fungsi: menghubungkan database, 
eksekusi data, membaca data dan menutup koneksi yang terhubung
*/

class DB{
	protected $connection;
	protected $query;
	
	//cukup ubah disini saja jika berpindah server
	var $dbhost = "localhost";
	var $dbname = "db_pegawai";
	var $dbuser = "root";
	var $dbpass = "";
	var $dbcharset = "utf8";
	
	function __construct(){ //dibuild saat pertama kali class dipanggil
		$this->connection = new mysqli($this->dbhost,
										$this->dbuser,
										$this->dbpass,
										$this->dbname);
		
		//cek khawatir ada kesalahan
		if($this->connection->connect_error){
			die("Error connection: ". $this->connection->connect_error);
		}
		
		$this->connection->set_charset($this->dbcharset);
	}
	
	public function query($query){
		//cek query dahulu sebelum query dieksekusi
		if($this->query = $this->connection->prepare($query)){
			$this->query->execute(); //eksekusi
			
			//cek kalo error
			if ($this->query->errno){
				die("Error execution: ". $this->query->error);
			}
		}else{
			die("Error execution: ". $this->connection->error);
		}
	}
	
	function getList($query){
		//cek query dahulu sebelum query dieksekusi
		if($this->query = $this->connection->prepare($query)){
			$this->query->execute(); //eksekusi
			
			$result = $this->query->get_result(); //<------------
			
			//cek kalo error
			if ($this->query->errno){
				die("Error execution: ". $this->query->error);
			}else{
				//ambil data dan extract kedalam bentuk array
				$parameters = array();
				
				while($row = $result->fetch_array()){
					$parameters[] = $row;
				}

				return $parameters;
			}
		}else{
			die("Error preparing: ". $this->connection->error);
		}
	}
	
	function close(){
		return $this->connection->close();
	}
}
?>