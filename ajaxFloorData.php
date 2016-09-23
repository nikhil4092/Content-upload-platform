<?php
//Include database configuration file
$db = mysql_connect("127.0.0.1","root","password");
mysql_select_db("winkl"); 
$mall=0;
extract($_POST);
if(isset($_POST["mallId"]) && !empty($_POST["mallId"])){
    //Get all state data
    $query = "SELECT MallId FROM MallMaster WHERE MallName = '".$mallId."'";
    $res = mysql_query($query); 
    //Display states list
	while($row = mysql_fetch_array($res)) 
	{
		//echo "hi";
		//echo "<script type='text/javascript'>console.log(".$row['ShopId'].");</script>";
		$mall=$row['MallId'];
		
		
	}
    $query = "SELECT * FROM FloorMaster WHERE MallId = ".$mall;
    $res = mysql_query($query); 
    	
	while($row = mysql_fetch_array($res)) 
	{
		//echo "hi";
		echo "<option value='".$row['UpperFloor']."'>".$row['UpperFloor']."</option>";
	}
}
else
{
	echo "no";
}
?>
