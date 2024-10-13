<?php
error_reporting(E_ALL & ~E_NOTICE);
include('lit.php');
//ob_implicit_flush(true);

//$dir = $argv[1];
$dir = "/Applications/XAMPP/xamppfiles/htdocs/bnb_master";
if (!is_dir($dir)) {
	echo " not dir " . $dir;
}
/*
try {
	$pdo = new PDO('mysql:host=bnb-master-db.cfchvnyq9hjg.us-west-2.rds.amazonaws.com;dbname=bnb_master_db;charset=utf8','bnb_master_db','bnb_master_db',
			array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
	exit(' fail connect '.$e->getMessage());
}
*/

$file_list = getFileList($dir);
natsort($file_list);

$cnt_503   = 0;
$cnt_301   = 0;
$cnt_othre = 0;
$cnt_200_japan = 0;

$log_ary = array();

$total_ros = 0;


$keep_number_ary = array();


$lacking_ids_ary = array();


foreach ($file_list as $file_name) {
	$rows = file($file_name, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
	//insrt_bnb_master($pdo, $rows);
	
	foreach ($rows as $key => $row) {
		$row_ary = explode(",", $row);
		$status = $row_ary[1];
		
		// count
		$total_ros++;
		$log_ary[$status] ++;
		
		if ($row_ary[1] == 200) {
			if (
					(stripos($row_ary[2], "japan") !== false) or
					(stripos($row_ary[3], "japan") !== false) or
					(stripos($row_ary[4], "japan") !== false)
			) {
				$log_ary[$status . "_japan"] ++;
				insrt_bnb_master($row);
			}
		}
		
	}

}

print_r($log_ary);
echo number_format($total_ros);




exit;

function insrt_bnb_master($logs) {
	
	$dbh = new PDO('mysql:host=localhost;dbname=db_bnb', 'root','');
	$data = explode(",", $logs);
	if(isset($data[0])){ $url = $data[0];}else{$url ="n/a";}
	if(isset($data[1])){ $stat = $data[1];}else{$stat ="n/a";}
	if(isset($data[2])){ $loc1 = $data[2];}else{$loc1 ="n/a";}
	if(isset($data[3])){ $loc2 = $data[3];}else{$loc2 ="n/a";}
	if(isset($data[4])){ $loc3 = $data[4];}else{$loc3 ="n/a";}
	if(isset($data[5])){ $loc4 = $data[5];}else{$loc4 ="n/a";}
	
	$sql = "INSERT into tbl_logs (`url`,`status`,`loc1`,
				`loc2`,`loc3`,`loc4`) values (?,?,?,?,?,?)";
	
	$stmt = $dbh->prepare($sql);
	$stmt->bindParam(1,$url);
	$stmt->bindParam(2,$stat);
	$stmt->bindParam(3,$loc1);
	$stmt->bindParam(4,$loc2);
	$stmt->bindParam(5,$loc3);
	$stmt->bindParam(6,$loc4);
	$stmt->execute();
	$dbh = null;
	//insertDB() <--- to insert the data on URL of each loop
}





/*
 *  get all files
 */
function getFileList($dir) {
	$iterator = new RecursiveDirectoryIterator($dir);
	$iterator = new RecursiveIteratorIterator($iterator);
	$list = array();
	foreach ($iterator as $fileinfo) { // $fileinfoはSplFiIeInfoオブジェクト
		if (!$fileinfo->isFile()) { continue; }
		$fname = $fileinfo->getPathname();
		if (strpos($fname, ".log") === false) { continue; }
		$list[] = $fname;
	}
	return $list;
}


