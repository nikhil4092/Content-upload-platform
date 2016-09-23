<?php
	session_start();
?>
<?php
//Include database configuration file
$db = mysql_connect("127.0.0.1","root","password");
mysql_select_db("winkl"); 
$mall=0;
extract($_POST);
if(isset($_POST["subtag"]) && !empty($_POST["subtag"])){
    //Get all state data
    $query = "SELECT * FROM SecondLevelTags WHERE Tag = '".$subtag."'";
    $res = mysql_query($query); 
    //Display states list
	while($row = mysql_fetch_array($res)) 
	{
		//echo "hi";
		//echo "<script type='text/javascript'>console.log(".$row['ShopId'].");</script>";
		$tag=$row['SecondLevelId'];
		$query = "SELECT * FROM ThirdLevelTags WHERE SecondLevelId=".$tag;
		$res1 = mysql_query($query); 
		    	
		while($row1 = mysql_fetch_array($res1)) 
		{
			$ter_array[] = $row1['Tag'];
		}	
	}
	$ter_array= array_unique(array_filter($ter_array));
        $json_ter_array = json_encode($ter_array);
	echo $json_ter_array;
    /*$query = "SELECT * FROM MallMaster WHERE MallId = ".$mall;
    $res = mysql_query($query); 
    	
	while($row = mysql_fetch_array($res)) 
	{
		//echo "hi";
		echo "<option value=".$row['ShopName'].">".$row['ShopName']."</option>";
	}*/
}
else
{
	echo "no";
}
?>
