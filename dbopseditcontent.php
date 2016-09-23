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
		$query="select * from ContentMaster where ContentId=$contentid"; 
		$res = mysql_query($query);
		//echo $contentid;
		if(!$res)
		{
			//$_SESSION['contentedited'] = 'nosuccess';
			//header('Location: viewContent.php'); 
		}
		$row = mysql_fetch_array($res);
		$numofedits=$row[edits]+1;
		//$query="select * from ContentMaster where ContentId=$contentid"; 
		//$res = mysql_query($query);
		$query="update ContentMaster set ShopId=$shopid,MallId=$mallid,Content='$content',Discount='$disc',MinRange='$min',MaxRange='$max',StyleTip='$stip',ProdLocation='$loc',Terms='$terms',StartDate='$vsdt',EndDate='$vedt',StartTime='$vstm',EndTime='$vetm',Events='$event',Gender='$gender',edits=$numofedits,Type='$classifications',ContentId=$contentid where ContentId=$contentid"; 
		$res1 = mysql_query($query);
		if(!$res1)
		{
			$_SESSION['contentedited'] = 'success';
			header('Location: viewContent.php'); 
		}
		//$query="update ContentMaster set ShopId=$shopid,MallId=$mallid,Content='$content',Discount='$disc', MinRange='$min',MaxRange='$max',StyleTip='$stip', ProdLocation='$loc',Terms='$terms',StartDate='$vsdt',EndDate='$vedt',edits=$numofedits,Type='$classifications' where ContentId=$contentid"; 
		//$res = mysql_query($query);
		//$contid=mysql_insert_id();
		$brandarr=split("\,",$brands);
		$mtagarr=split("\,",$mtags);
		if(sizeof($brandarr)>0 and $brandarr[0]!="")
		{
			$query="delete from Brands where ContentId=$contentid"; 
			$res = mysql_query($query);
			for($i=0;$i<sizeof($brandarr);$i++)
			{
				$query = "insert into Brands(ContentId,BrandName) values('$contentid','$brandarr[$i]') on duplicate key update ContentId=$contentid";
				$res = mysql_query($query);
			}
	
		}
		if(sizeof($mtagarr)>0 and $mtagarr[0]!="")
		{
			$query="delete from Metatags where ContentId=$contentid"; 
			$res = mysql_query($query);
			for($i=0;$i<sizeof($mtagarr);$i++)
			{
				$query = "insert into Metatags(ContentId,Tag) values('$contentid','$mtagarr[$i]') on duplicate key update ContentId=$contentid";
				$res = mysql_query($query);
				//echo $main[$i].$sub[$i].$tertiary[$i]."<br>";
			}			
		}
		if(sizeof($main)>0 and $main[0]!="")
		{
			$cat="Main Category";
			$query="delete from CategoryMaster where ContentId=$contentid"; 
			$res = mysql_query($query);
			for($i=0;$i<sizeof($main);$i++)
			{
				echo $tertiary[$i];
				$query = "insert into CategoryMaster(CategoryType,MainType,SubType,TerType,ContentId) values('$main[$i]','$main[$i]','$sub[$i]','$tertiary[$i]','$contentid') on duplicate key update ContentId=$contentid";
				$res = mysql_query($query);
			}
		}
		if(sizeof($cols)>0)
		{
			$cat="Colour";
			$query="delete from ContentColors where ContentId=$contentid"; 
			$res = mysql_query($query);
			for($i=0;$i<sizeof($cols);$i++)
			{
				$query = "insert into ContentColors(ContentId,Color) values('$contentid','$cols[$i]') on duplicate key update ContentId=$contentid";
				$res = mysql_query($query);
				//echo $main[$i].$sub[$i].$tertiary[$i]."<br>";
			}			
		}
		if($_FILES['contimgs']['tmp_name'][0]!="")
		{
  		    $query="delete from ContentImages where ContentId=$contentid"; 
		    $res = mysql_query($query);
		foreach($_FILES['contimgs']['tmp_name'] as $key => $tmp_name )
		{
		    $file_name = $key.$_FILES['contimgs']['name'][$key];
		    $file_size =$_FILES['contimgs']['size'][$key];
		    $file_tmp =$_FILES['contimgs']['tmp_name'][$key];
		    $file_type=$_FILES['contimgs']['type'][$key];
		    $uploadvar="images/".$file_name;
		    move_uploaded_file($file_tmp,"images/".$file_name);
 
		    $query = "insert into ContentImages(ContentId,Imgurl) values('$contentid','$uploadvar')";
		    $res = mysql_query($query);		    
		}
		}
		if(!$res)
		{
			//$_SESSION['contentedited'] = 'nosuccess';
			//header('Location: viewContent.php'); 
			echo "okay";
		}
		else
		{
			//echo "<h2>Details have been added<h2>";
			//$_SESSION['contentedited'] = 'success';
			header('Location: viewContent.php'); 
		}
		//echo $store."<br>".$imgurl."<br>";
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
		/*$query = "select ShopId from ShopMaster where ShopName='$store'";
		$res = mysql_query($query);
    		while($row = mysql_fetch_array($res)) 
		{
        			$shopid=$row["ShopId"];
    		}
		$edits=0;
		$query = "insert into ContentMaster(ShopId,Content,ContentImageURL,StartDate,EndDate,StartTime,EndTime,Terms,Discount,MaxRange,MinRange,StyleTip,ProdLocation,edits) values	('$shopid','$content','$imgurl','$vsdt','$vedt','$vstm','$vetm','$terms','$disc','$max','$min','$stip','$loc','$edits')";
		$res = mysql_query($query);
		if(!$res)
		{
			die("Problem executing query..");
		}
		else
		{
			echo "<h2>Details have been added<h2>";
		}*/
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
