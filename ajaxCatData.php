<?php
	session_start();
?>
<?php
//Include database configuration file
$db = mysql_connect("127.0.0.1","root","password");
mysql_select_db("winkl"); 
$mall=0;
extract($_POST);
if(isset($_POST["maintag"]) && !empty($_POST["maintag"])){
    //Get all state data
    $query = "SELECT * FROM FirstLevelTags WHERE Tag = '".$maintag."'";
    $res = mysql_query($query); 
    //Display states list
	while($row = mysql_fetch_array($res)) 
	{
		//echo "hi";
		//echo "<script type='text/javascript'>console.log(".$row['ShopId'].");</script>";
		$tag=$row['FirstLevelId'];
		$query = "SELECT * FROM SecondLevelTags WHERE FirstLevelId=".$tag;
		$res1 = mysql_query($query); 
		    	
		while($row1 = mysql_fetch_array($res1)) 
		{
			$sub_array[] = $row1['Tag'];
		}	
	}
	$sub_array= array_unique(array_filter($sub_array));
        $json_sub_array = json_encode($sub_array);
	echo $json_sub_array;
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
