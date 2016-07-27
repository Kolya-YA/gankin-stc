<?

$host='78.108.80.119';
$db='b109820_surftarifacom';
$user='u109820';
$pass='wwegsh_01';

$token = $_GET['token'];
if ($token == 'YOBA')
{
	`gunzip -f last.sql.gz`;
	
	
	$mysqli = new mysqli($host, $user, $pass, $db);

	if (mysqli_connect_error()) {
		die('Connect Error (' . mysqli_connect_errno() . ') '
		. mysqli_connect_error());
	}
	
	echo 'Success... ' . $mysqli->host_info . "<br />\n";
	echo 'Retrieving dumpfile' . "<br />\n";
	
	$sql = file_get_contents('last.sql');
	if (!$sql){
		die ('Error opening file');
	}
	
	echo "processing file <br />\n";
	mysqli_multi_query($mysqli,$sql);
	
	echo "done.\n";
	$mysqli->close();
}