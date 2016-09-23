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
		$name_of_Store=str_replace(' ', '', $storename);
		$file_name = $name_of_Store.$_FILES['logo']['name'];
		$file_tmp =$_FILES['logo']['tmp_name'];
		$logoimg="images/shoplogos/".$file_name;
		move_uploaded_file($file_tmp,"images/shoplogos/".$file_name);
		$file_name = $name_of_Store.$_FILES['shopcover']['name'];
		$file_tmp =$_FILES['shopcover']['tmp_name'];
		$coverimg="images/shopcoverimages/".$file_name;
		move_uploaded_file($file_tmp,"images/shopcoverimages/".$file_name);
		$mallid="";

		for($i=0;$i<sizeof($malls);$i++)
		{
			$query = "select MallId from MallMaster where MallName='$malls[$i]'";
			$res = mysql_query($query);
    			while($row = mysql_fetch_array($res)) 
			{
        			$mallid=$row["MallId"];
    			}
			$mall=str_replace(' ', '', $malls[$i]);
			$mall=$$mall;
			echo $mall;
			$query = "insert into ShopMaster(ShopName,Floor,ShopLogo,ShopCoverImage,MallId,Description,Winks,Priority,BeaconId) values		('$storename','$mall','$logoimg','$coverimg','$mallid','$desc','$pts','$prio','$beacon')";
			$res = mysql_query($query);
			
		}
		
		if(!$res)
		{
			$_SESSION['storeadded'] = 'nosuccess';
			header('Location: store.php'); 
		}
		else
		{
			echo "<h2>Details have been added<h2>";
			$_SESSION['storeadded'] = 'success';
			header('Location: store.php'); 
		}

	}
	connect_db();
	executeinsert();


?>
