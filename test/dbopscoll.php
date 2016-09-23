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
		extract($_POST);
		//$img=$_FILES['collimg']['tmp_name'];
		//$mallid="";
		//echo $_FILES['collimg']['tmp_name'];
		$collimgs=str_replace(' ', '', $collname);
		$collimgs=mysql_real_escape_string($collimgs);
		$file_name = $collimgs.$_FILES['collimg']['name'];
		$file_tmp =$_FILES['collimg']['tmp_name'];
		$logoimg="images/collectionimages/".$file_name;
		move_uploaded_file($file_tmp,"../images/collectionimages/".$file_name);
		$desc1=mysql_real_escape_string($desc);
		$name1=mysql_real_escape_string($collname);
		$query = "insert into CollectionMaster(CollName,Description,CollImgurl) values('$name1','$desc1','$logoimg')";
		$res = mysql_query($query);
		$collid=mysql_insert_id();
		for($i=0;$i<sizeof($contents);$i++)
		{
			$query = "insert into CollectionParent(CollId,ContentId) values('$collid','$contents[$i]')";
			echo $contents[$i]." ".$collname." ".$desc." ".$img;
			$res = mysql_query($query);
		}
		if(!$res)
		{
			$_SESSION['collectionadded'] = 'nosuccess';
			header('Location: index.php'); 
		}
		else
		{
			$_SESSION['collectionadded'] = 'success';
			header('Location: index.php'); 
		}
	}
	connect_db();
	execteinsert();
?>
