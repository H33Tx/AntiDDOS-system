<?php

// There is all your configuration

$ad_ddos_query = 5; // ​​number of requests per second to detect DDOS attacks
$ad_check_file = 'check.txt'; // file to write the current state during the monitoring
$ad_all_file = 'all_ip.txt'; // temporary file
$ad_black_file = 'black_ip.txt'; // will be entered into a zombie machine ip
$ad_white_file = 'white_ip.txt'; // ip logged visitors
$ad_temp_file = 'ad_temp_file.txt'; // ip logged visitors
$ad_dir = 'anti_ddos/files'; // directory with scripts
$ad_num_query = 0; // ​​current number of requests per second from a file $check_file
$ad_sec_query = 0; // ​​second from a file $check_file
$ad_end_defense = 0; // ​​end while protecting the file $check_file
$ad_sec = date("s"); // current second
$ad_date = date("is"); // current time
$ad_defense_time = 100; // ddos ​​attack detection time in seconds at which stops monitoring


$config_status = "";
function createFile($thePath, $ad)
{
	if (!file_exists($ad)) mkdir($ad, 0755, true);
	fopen($thePath, 'a+') or die('Cannot create file:  ' . $thePath);
	return "Creating " . $thePath . " .... done";
}


// function appendToFile($thePath, $newdata)
// {
// 	$myFile = $thePath;
// 	if (!fopen($myFile, 'a')) {
// 		$handle = fopen($myFile, 'w');
// 		fwrite($handle, $newdata);
// 	} else {
// 		fwrite($handle, $newdata);
// 	}
// }

// Checking if all files exist before launching the cheking
$config_status .= (!file_exists("{$ad_dir}/{$ad_check_file}")) ? createFile("{$ad_dir}/{$ad_check_file}", $ad_dir) : "ERROR: Creating {$ad_dir}/{$ad_check_file}<br>";
$config_status .= (!file_exists("{$ad_dir}/{$ad_temp_file}")) ? createFile("{$ad_dir}/{$ad_temp_file}", $ad_dir) : "ERROR: Creating {$ad_dir}/{$ad_temp_file}<br>";
$config_status .= (!file_exists("{$ad_dir}/{$ad_black_file}")) ? createFile("{$ad_dir}/{$ad_black_file}", $ad_dir) : "ERROR: Creating {$ad_dir}/{$ad_black_file}<br>";
$config_status .= (!file_exists("{$ad_dir}/{$ad_white_file}")) ? createFile("{$ad_dir}/{$ad_white_file}", $ad_dir) : "ERROR: Creating {$ad_dir}/{$ad_white_file}<br>";
$config_status .= (!file_exists("{$ad_dir}/{$ad_all_file}")) ? createFile("{$ad_dir}/{$ad_all_file}", $ad_dir) : "ERROR: Creating {$ad_dir}/{$ad_all_file}<br>";

if (!file_exists("{$ad_dir}/../anti_ddos.php")) $config_status .= "anti_ddos.php does'nt exist!";

if (!file_exists("{$ad_dir}/{$ad_check_file}") || !file_exists("{$ad_dir}/{$ad_temp_file}") || !file_exists("{$ad_dir}/{$ad_black_file}") || !file_exists("{$ad_dir}/{$ad_white_file}") || !file_exists("{$ad_dir}/{$ad_all_file}") || !file_exists("{$ad_dir}/../anti_ddos.php")) {
	$config_status .= "Some files does'nt exist!";
	die($config_status);
}
