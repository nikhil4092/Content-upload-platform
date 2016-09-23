<?php
	session_start();
?>
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
	$query = "SELECT * FROM ShopMaster WHERE MallId = ".$mall;
	$res1 = mysql_query($query);
	echo "<option selected disabled>Select Store</option>";
	while($row1 = mysql_fetch_array($res1)) 
	{
		echo '<option value="'.$row1['ShopName'].'">'.$row1['ShopName'].'</option>';
	}	
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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$('#select_all').click(function(event) {
    if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    }
    else{
        $(':checkbox').each(function() {
            this.checked = false;                        
        });
	}	
});
</script>
