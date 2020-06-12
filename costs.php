<?php
require_once('vendor/autoload.php');

use Steevenz\Rajaongkir;

// inisiasi dengan config array
$config['api_key'] = '28200787cde4f092e544c66f4d131080';
$config['account_type'] = 'pro';
 
$rajaongkir = new Rajaongkir($config);

$couriers = [
    "jne", "pos", "tiki", "rpx", "esl", 
    "pcp", "pandu", "wahana", "sicepat", "jnt", 
    "pahala", "cahaya", "sap", "jet", "dse", 
    "slis", "first", "ncs", "star", "ninja", 
    "lion", "idl", "rex"
];

$froms = [4891,2089];
$tos = json_decode(file_get_contents("subdistricts.json"));

$min = $_GET['min']; //0;
$max = $_GET['max']; //3;

foreach($froms as $from)
{
    for($i=$min;$i<=$max;$i++)
    {
        $to = $tos[$i];
        if($from == $to->subdistrict_id) continue;
        foreach($couriers as $courier)
        {
            $data[$from][$to->subdistrict_id][$courier] = $rajaongkir->getCost(['subdistrict' => $from], ['subdistrict' => $to->subdistrict_id], 1000, $courier); //costs($from, $to, $courier);
        }
    }
}

$costs = file_get_contents("costs.json");
$costs = $costs ? json_decode($costs) : [];
$data = array_merge($costs,$data);
file_put_contents("costs.json", json_encode($data));