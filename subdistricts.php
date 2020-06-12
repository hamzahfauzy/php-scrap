<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<script type="text/javascript">
async function getCosts(from, to, courier)
{
	var res = await fetch(`costs-all.php?from=${from}&to=${to}&courier=${courier}`)
	var data = await res.json()
	console.log(data)
}
</script>
<body>
<?php
$subdistricts = file_get_contents("subdistricts.json");
$subdistricts = json_decode($subdistricts);
$asal         = [4891 => "Kalideres", 2089 => "Pekalongan"];
$couriers = [
    "jne", "pos", "tiki", "rpx", "esl", 
    "pcp", "pandu", "wahana", "sicepat", "jnt", 
    "pahala", "cahaya", "sap", "jet", "dse", 
    "slis", "first", "ncs", "star", "ninja", 
    "lion", "idl", "rex"
];
foreach($asal as $k => $a){
?>

<h2><?= $a ?></h2>
<table border="1" cellpadding="10">
	<tr>
		<td>No</td>
		<td>Asal</td>
		<td>Provinsi</td>
		<td>Kab/Kota</td>
		<td>Kec</td>
		<td>Aksi</td>
	</tr>
	<?php foreach ($subdistricts as $key => $value) { ?>
	<tr>
		<td><?=++$key?></td>
		<td><?= $a ?></td>
		<td><?=$value->province?></td>
		<td><?=$value->city?></td>
		<td><?=$value->subdistrict_name?></td>
		<td>
			<button onclick="getCosts('<?=$k?>|<?=$a?>','<?=$value->subdistrict_id?>|<?=$value->subdistrict_name?>')">Get Costs</button>
		</td>
	</tr>
	<?php } ?>
</table>

<?php } ?>

</body>
</html>