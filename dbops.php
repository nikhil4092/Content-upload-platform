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
	function executeinsert()
	{
		extract($_POST);
		$name_of_mall=str_replace(' ', '', $name);
		$file_name = $name_of_mall.$_FILES['logo']['name'];
		$file_tmp =$_FILES['logo']['tmp_name'];
		$logoimg="images/malllogos/".$file_name;
		$mallid="";
		move_uploaded_file($file_tmp,"images/malllogos/".$file_name);
		$file_name = $name_of_mall.$_FILES['coverimg']['name'];
		$file_tmp =$_FILES['coverimg']['tmp_name'];
		$cover="images/mallcoverimages/".$file_name;
		move_uploaded_file($file_tmp,"images/mallcoverimages/".$file_name);
		$query = "insert ignore into MallMaster(MallName,Area,Pin,City,State,Country,Winks,Lat,Longitude,ImageURL,Coverimgurl) values('$name','$area','$pin','$city','$state','$ctry','$winks','$lat','$long','$logoimg','$cover')";
		$res = mysql_query($query);
		$query = "select MallId from MallMaster where MallName='$name'";
		$res = mysql_query($query);
    		while($row = mysql_fetch_array($res)) 
		{
        			$mallid=$row["MallId"];
    		}
		for($i=0;$i<sizeof($level);$i++)
		{
			$query = "insert ignore into FloorMaster(MallId,LowerFloor,UpperFloor) values('$mallid','$level[$i]','$levelName[$i]')";
			$res = mysql_query($query);			
		}
		if(!$res)
		{
			$_SESSION['malladded'] = 'nosuccess';
			header('Location: addMall.php');
		}
		else
		{
			echo "<h2>Details have been added<h2>";
			$_SESSION['malladded'] = 'success';
			header('Location: addMall.php'); 
		}
	}
	connect_db();
	executeinsert();


?>
