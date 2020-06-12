<?php
$directory = "subdistricts/";
$last_data = [];

// Open a directory, and read its contents
if (is_dir($directory)){
  if ($opendirectory = opendir($directory)){
    while (($file = readdir($opendirectory)) !== false){
    	if(in_array($file, [".",".."])) continue;
      	// echo "filename:" . $file . "<br>";
      	$data = file_get_contents($directory.$file);
      	$data = json_decode($data);
      	$new_data = array_merge($last_data,$data);
      	$last_data = $new_data;
    }
    closedir($opendirectory);
  }
}

$subdistricts = [];
foreach ($last_data as $data) {
	foreach ($data as $key => $value) {
		$subdistricts[] = $value;
	}
}


$column = array_column($subdistricts, 'province_id');

array_multisort($column, SORT_ASC, $subdistricts);

file_put_contents("subdistricts.json",json_encode($subdistricts));
?>
