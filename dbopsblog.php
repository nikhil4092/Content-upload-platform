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
	        $file_name = $title.$link.$_FILES['blogimg']['name'];
		$file_size =$_FILES['blogimg']['size'];
		$file_tmp =$_FILES['blogimg']['tmp_name'];
		$file_type=$_FILES['blogimg']['type'];
		$uploadvar="images/blogs/".$file_name;
		move_uploaded_file($file_tmp,"images/blogs/".$file_name);
		$query = "insert into Blogposts(Title,Description,BlogImgurl,Link) values		('$title','$desc','$uploadvar','$link')";
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
