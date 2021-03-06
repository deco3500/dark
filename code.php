<?php


include_once 'handlers/utils.php';


$p_particledeviceid = $_POST['thisdevice'];
$p_gsr_index = $_POST['variable'];
$p_gsr_reading = $_POST['value'];
$p_eventid = $_POST['eventid'];

$s_eventid = date("Y").date("m").date("d").date("h").date("i")."-".$p_eventid;

try {
	$stmt = $db->prepare("INSERT INTO newdata (particledeviceid, variable, value, eventid, datetime) VALUES (:particledeviceid, :variable, :value, :eventid, :datetime)");

	$stmt->bindValue("particledeviceid", $p_particledeviceid, PDO::PARAM_STR);
	$stmt->bindValue("variable", $p_variable, PDO::PARAM_STR);
	$stmt->bindValue("value", $p_value, PDO::PARAM_STR);
	$stmt->bindValue(":eventid", $s_eventid, PDO::PARAM_STR);
	$stmt->bindValue(":datetime", date("Y-m-d H:i:s"), PDO::PARAM_STR);

	$stmt->execute();

	echo "data pushed to db";
}
catch (PDOException $e)
{
	echo "Error: ".$se->getMessage();
}

$db = null;

?>
