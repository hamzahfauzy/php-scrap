<?php
require_once('vendor/autoload.php');

use Steevenz\Rajaongkir;

// inisiasi dengan config array
$config['api_key'] = '28200787cde4f092e544c66f4d131080';
$config['account_type'] = 'pro';
 
$rajaongkir = new Rajaongkir($config);

// $index = $argv[1];
// $asal = [4891 => "Kalideres", 2089 => "Pekalongan"];
$asal = [4891 => "Kalideres"];
$subdistricts = file_get_contents("subdistricts.json");
$subdistricts = json_decode($subdistricts);
$index = 264;
// $subdistricts = [$subdistricts[$index]];
$subdistricts = array_slice($subdistricts, 268);
// print_r($subdistricts[0]);
// die();
$couriers = [
    "jne", "pos", "tiki", "rpx", "esl", 
    "pcp", "pandu", "wahana", "sicepat", "jnt", 
    "pahala", "cahaya", "sap", "jet", "dse", 
    "slis", "first", "ncs", "star", "ninja", 
    "lion", "idl", "rex"
];
foreach ($asal as $key => $value) {
    $from    = $key;
    foreach ($subdistricts as $subdistrict) {
        $costs = [];
        $to  = $subdistrict->subdistrict_id;
        $name = $subdistrict->subdistrict_name;
        $costs["".$value]["to"]["detail"] = $subdistrict;
        $costs["".$value]["to"]["costs"] = [];
        foreach($couriers as $courier)
            $costs["".$value]["to"]["costs"][] = $rajaongkir->getCost(['subdistrict' => $from], ['subdistrict' => $to], 1000, $courier); //costs($from, $to, $courier);

        $costs = json_encode($costs);
        file_put_contents("costs/$from-$value-$to-$name.json", $costs);
        sleep(3);
    }
}

// $costs = file_get_contents("costs.json");
// $data = array_merge($costs,$data);
// $costs = json_decode($costs);
// file_put_contents("costs.json", json_encode($data));
echo "Sukses";