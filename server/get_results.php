<?php
header("Content-Type:application/json");
header("Content-Type: text/html;charset=UTF-8");
header("Access-Control-Allow-Origin: *");
require "data.php";

if(!empty($_GET['query']))
{
	$query=$_GET['query'];

	$data = get_wildcard_search($query);
	echo json_encode($data);	
}
else
{
	response(400,"Invalid Request",NULL);
}

?>