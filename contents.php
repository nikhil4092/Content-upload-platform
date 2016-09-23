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
	$query = "select * from ContentMaster where ShopId=$storeid";
	$res = mysql_query($query);
	extract($_POST);
        /*echo "<div class='header'>";
        echo "<h4 class='title'>Contents</h4>";
        echo "</div>";*/
	while($row = mysql_fetch_array($res)) 
	{
		$imgquery="select * from ContentImages where ContentId=".$row['ContentId'];
		$imgres = mysql_query($imgquery);
		$row1 = mysql_fetch_array($imgres);
		$imgurl="images/".$row1['Imgurl'];
		if(!$imgurl)
			$imgurl="winkl_logo.png";
		echo "<div class='card'>";
		echo "<center><img src='".$imgurl."' alt='Image preview' height='59' width='175'></center>";
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
		echo "<p class='card-text'><small class='text-muted'> Number of Edits : ".$row['edits']."</small></p>";
		echo "<center><p class='card-text'><button type='submit' name='edit' value=".$row['ContentId']."><img src='editimg.png' width='20' height='20'></img></button><button type='submit' name='del' value=".$row['ContentId']."><img src='trash.png' width='20' height='20'></img></button><button type='submit' name='verify' value=".$row['ContentId']."><img src='tick.png' width='20' height='20'></img></button></p></center>";

		echo "</div>";
		echo "</div>";
	}
?>

