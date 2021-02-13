<?php
echo view('layout/header.php');
echo view('layout/navbar.php');
if($isi){
	echo view($isi);
}
echo view('layout/footer.php');
?>