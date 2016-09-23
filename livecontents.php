<?php
	global $db,$query,$res; 
	$db = mysql_connect("127.0.0.1","root","password");
	mysql_select_db("winkl");  
 
?>
<?php
	extract($_POST);
	global $db,$query,$res,$row,$storeid; 
	$db = mysql_connect("127.0.0.1","root","password");
	mysql_select_db("winkl"); 
	$query = "select * from ShopMaster where ShopName='".$store."'";
	$res = mysql_query($query); 
	$row = mysql_fetch_array($res);
	$storeid=$row['ShopId'];
	
?>
<?php
	global $db,$query,$res,$row,$storeid; 
	$query = "select * from ContentAdminMaster where ShopId=$storeid";
	$res = mysql_query($query);
	extract($_POST);
        /*echo "<div class='header'>";
        echo "<h4 class='title'>Contents</h4>";
        echo "</div>";*/
	while($row = mysql_fetch_array($res)) 
	{
		echo "<div class='card'>";
		echo "<center><img src='winkl_logo.png' alt='Image preview' height='59' width='175'></center>";
		echo "<div class='card-block'>";
		echo "<h4 class='card-title'>Content Id : ".$row['ContentId']."</h4>";
		echo "<p class='card-text'> Content : <br>&nbsp;&nbsp;&nbsp;&nbsp;".$row['Content']."</p>";
		echo "<p class='card-text'> Validity period : <br>".$row['StartDate']." to ".$row['EndDate']."</p>";
		echo "<p class='card-text'> Price range : ".$row['MinRange']." - ".$row['MaxRange']."</p>";
		echo "<p class='card-text'> Discount : ".$row['Discount']."</p>";
		echo "<p class='card-text'> Style Tip : ".$row['StyleTip']."</p>";
		echo "<p class='card-text'> Product Location : <br>".$row['ProdLocation']."</p>";
		echo "<input type='hidden' name='selectedContent' value=".$row['ContentId'].">";
		echo "<input type='hidden' name='selectedMall' value=".$mall.">";


		echo "</div>";
		echo "</div>";
	}
?>

