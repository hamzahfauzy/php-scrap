<?php
require_once('vendor/autoload.php');

use Steevenz\Rajaongkir;

// inisiasi dengan config array
$config['api_key'] = '28200787cde4f092e544c66f4d131080';
$config['account_type'] = 'pro';
 
$rajaongkir = new Rajaongkir($config);

$cities = json_decode(file_get_contents("cities.json"));

$from = $_GET['from']; //21;
$to   = $_GET['to']; //35;
for($j=$from;$j<=$to;$j++){
	$_subdistricts = [];
	$page = $j;
	$max  = 10;
	$start = ($page-1) * $max;
	for($i=$start;$i<($max*$page);$i++)
	{
		if(!isset($cities[$i])) continue;
		$city = $cities[$i];
		$subdistricts = $rajaongkir->getSubdistricts($city->city_id);
		$_subdistricts[] = $subdistricts;
	}

	$data = json_encode($_subdistricts);
	file_put_contents("subdistricts/$page.json", $data);
	echo "sukses ".$j."<br>";
}