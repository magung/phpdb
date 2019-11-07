<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Data Jabatan</title>
</head>
<body>
	<?php
	include("db.php");
	
	/*
	variable "status" u/ deteksi aksi : simpan, update & hapus
	if menggunakan gaya satu baris karena hanya memiliki satu keputusan
	opsional sih...
	*/
	$action = (!isset($_REQUEST["action"])) ? null : $_REQUEST["action"];
	//die($action);
	if ($action == null){
	?>
	<h3>Data Jabatan</h3>
	<form action="">
		<label>Jabatan</label><input type="text" name="jabatan"/><br/>
		<label>Honor</label><input type="text" name="honor"/><br/>
		<input type="submit" name="action" value="Simpan"/>
		<input type="reset" name="reset" value="Ulangi"/>
	</form>
	
	<table border="1">
		<thead><th>Jabatan</th><th>Honor</th><th>&nbsp;</th></thead>
		<tbody>
		<?php
		$d = new DB(); //mengaktifkan class DB
		$sql = "select * from jabatan";
		$hasil = $d->getList($sql); //ambil data dan tampung pada $hasil
		
		//loop untuk menampilkannya
		for($i = 0; $i < count($hasil); $i++){
		?>
		<tr>
			<td><?= $hasil[$i]["jabatan"] ?></td>
			<td><?= $hasil[$i]["honor"] ?></td>
			<td>
				<a href="pegawai.php?action=Ubah&id=<?= $hasil[$i]["idjabatan"] ?>">Ubah</a> | 
				<a href="pegawai.php?action=Hapus&id=<?= $hasil[$i]["idjabatan"] ?>">Hapus</a> 
			</td>
		</tr>
		<?php }	?>
		</tbody>
	</table>
	<?php
	}elseif($action == "Simpan"){
		$d = new DB(); //mengaktifkan class DB
		$sql = "insert into jabatan (jabatan, honor) values ( "
				."'".$_REQUEST['jabatan']."', ".$_REQUEST['honor'].")";
		$d->query($sql); //jalankan function query u/ eksekusi sql
		
		header("location: pegawai.php"); //redirect
	}elseif($action == "Hapus"){
		$d = new DB(); 
		$sql = "delete from jabatan where idjabatan = ".$_REQUEST['id'];
		$d->query($sql); //jalankan function query u/ eksekusi sql
		
		header("location: pegawai.php"); //redirect
	}
	?>
</body>
</html>