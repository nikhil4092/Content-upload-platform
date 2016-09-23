<?php
	session_start();
?>
<?php
//Include database configuration file
$db = mysql_connect("127.0.0.1","root","password");
mysql_select_db("winkl"); 
$mall=0;
extract($_POST);
if(isset($_POST["shopId"]) && !empty($_POST["shopId"])){
    //Get all state data
    $query = "SELECT MallId FROM ShopMaster WHERE ShopName = '".$shopId."'";
    $res = mysql_query($query); 
    //Display states list
	while($row = mysql_fetch_array($res)) 
	{
		//echo "hi";
		//echo "<script type='text/javascript'>console.log(".$row['ShopId'].");</script>";
		$mall=$row['MallId'];
		$query = "SELECT * FROM MallMaster WHERE MallId = ".$mall;
		$res1 = mysql_query($query); 
		    	
		while($row1 = mysql_fetch_array($res1)) 
		{
			echo "<span class='additional-info-wrap'>";
			echo "<label class='checkbox-inline'>";
			echo "<input type='checkbox' name='malls[]' class='malls' id='choose_mall' value='".$row1['MallName']."'>".$row1['MallName'];
			echo "</label>";
		}	
	}
	echo "<label class='checkbox-inline'>";
	echo "<input type='checkbox' name='select_all' id='select_all'>Select All</input>";
	echo "</label>";
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
        $(':checkbox.malls').each(function() {
            this.checked = true;                        
        });
    }
    else{
        $(':checkbox.malls').each(function() {
            this.checked = false;                        
        });
	}	
});
</script>
