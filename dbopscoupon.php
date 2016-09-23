<?php
	session_start();
?>
<?php
	
	function connect_db()
	{
		$db = mysql_connect("127.0.0.1","root","password");
		if(!$db)
		{
			die("Could not connect to database");
		}
		//Select the database
		mysql_select_db("winkl");
	
	}
	
	function execute_search_query()
	{
		
		$query = "show tables";
		
		$res = mysql_query($query);
		
		if(!$res)
		{
			die("Problem executing query..");
		}
		else
		{
			echo "works";
		}
	}
	function execteinsert()
	{
		//global $mid, $res,$it,$pr;
		//echo $mid.$it.$pr;
		extract($_POST);
		//echo $level[0]."<br>".$level[1]."<br>";
		//echo $levelName[0]."<br>".$levelName[1]."<br>";
		//echo $_FILES['logo']['tmp_name'];
		/*echo $name."<br>";
		echo $area."<br>";
		echo $lat."<br>";
		echo $long."<br>";
		echo $pin."<br>";
		echo $city."<br>";
		echo $state."<br>";
		echo $ctry."<br>";
		echo $winks."<br>";
		echo $imgurl."<br>";*/
		/*$query = "insert into MallMaster(MallName,Area,Pin,City,State,Country,Winks,Lat,Longitude,ImageURL,Coverimgurl) values('$name','$area','$pin','$city','$state','$ctry','$winks','$lat','$long','$logoimg','$cover')";
		$res = mysql_query($query);*/
		//$query = "select MallId from MallMaster where MallName='$name'";
		//$res = mysql_query($query);
    		/*while($row = mysql_fetch_array($res)) 
		{
        			$mallid=$row["MallId"];
    		}*/
		$query = "insert into CouponMaster(CouponCode,usertimes,winks,StartDate,EndDate,StartTime,EndTime) values		('$code','$num','$winks','$sdt','$edt','$stm','$etm')";
		$res = mysql_query($query);
		if(!$res)
		{
			die("Problem executing query..");
		}
		else
		{
			echo "<h2>Details have been added<h2>";
		}
	}
	/*function format_results()
	{
		global $res;

		while($row = mysql_fetch_array($res))
		{
		    $_SESSION["name"] = $row['name'];
		    echo $row['name'].'<br>';
		    echo $row['item'].'<br>';

		}

		
		$row = mysql_fetch_array($res, MYSQL_ASSOC);
		$resStr = "";
		
		foreach($row as $key=>$value)
		{
			//echo "<h2>$key...............$value</h2>";
			$resStr = $resStr . $value . "<br>";
			
		}
		echo $resStr;
	}*/
	connect_db();
	execteinsert();
	/*echo $_SERVER['REQUEST_METHOD'];
	echo $name."<br>";
	echo $area."<br>";
	echo $lat."<br>";
	echo $long."<br>";*/
	

?>
