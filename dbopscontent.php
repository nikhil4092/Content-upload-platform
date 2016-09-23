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
	function executeinsert()
	{
		extract($_POST);
		if($uploadfiles)
		{
			$count=0;
			$file_tmp =$_FILES['exc']['tmp_name'];
	  		$file = fopen($file_tmp, "r");
			echo $file_tmp;
			while (!feof($file) ) {
				$line_of_text[] = fgetcsv($file, 1024);
			}
			$noofrow=sizeof($line_of_text);
			$c=0;
			while($c<$noofrow)
			{

				$malls=split("\,",$line_of_text[$c+1][1]);
				if(sizeof($malls)>0 and $malls[0]!="")
				{
					for($i=0;$i<sizeof($malls);$i++)
					{
						$query = "select MallId from MallMaster where MallName='$malls[$i]'";
						$res = mysql_query($query);
						$row = mysql_fetch_array($res);
						$mallid=$row["MallId"];
						$query = "select ShopId from ShopMaster where ShopName='{$line_of_text[$c+1][0]}' and MallId='$mallid'";
						$res = mysql_query($query);
						$row = mysql_fetch_array($res);
						$shopid=$row["ShopId"];						
						$edits=0;
						if(strcasecmp($line_of_text[$c+1][22],"yes")==0)
							$events=1;
						else
							$events=0;
						if(strcasecmp($line_of_text[$c+1][3],"M")==0)
							$gender="M";
						else if (strcasecmp($line_of_text[$c+1][3],"F")==0)
							$gender="F";
						else
							$gender="B";
						if($line_of_text[$c+1][2]==$line_of_text[$c+1][0])
							$postappendtext=" from ".$line_of_text[$c+1][2];
						else
							$postappendtext=" from ".$line_of_text[$c+1][2]." at ".$line_of_text[$c+1][0];
						if(strcasecmp($line_of_text[$c+1][11],$line_of_text[$c+1][12])==0)
						{
							$appendtext=" at ".$line_of_text[$c+1][11];
							$minrange="Rs.".$line_of_text[$c+1][11];
							$maxrange="Rs.".$line_of_text[$c+1][12];
						}
						else if(strcasecmp($line_of_text[$c+1][11],"")==0)
						{
							$appendtext=" upto ".$line_of_text[$c+1][12];
							$maxrange="Rs.".$line_of_text[$c+1][12];
						}
						else if(strcasecmp($line_of_text[$c+1][12],"")==0)
						{
							$appendtext=" from ".$line_of_text[$c+1][11];
							$minrange="Rs.".$line_of_text[$c+1][11];
						}
						else
						{
							$appendtext=" from ".$line_of_text[$c+1][11]." to ".$line_of_text[$c+1][12];
							$minrange="Rs.".$line_of_text[$c+1][11];
							$maxrange="Rs.".$line_of_text[$c+1][12];
						}
						
						$content=$line_of_text[$c+1][7];//.$appendtext.$postappendtext;
						$minrange="Rs.".$line_of_text[$c+1][11];
						$maxrange="Rs.".$line_of_text[$c+1][12];
						$query1 = "insert into ContentMaster(ShopId,MallId,Gender,Content,Type,MinRange,MaxRange,Discount,StartDate,EndDate,StartTime,EndTime,StyleTip,Terms,Events,ProdLocation,edits) values('$shopid','$mallid','$gender','$content','{$line_of_text[$c+1][9]}','$minrange','$maxrange','{$line_of_text[$c+1][13]}','{$line_of_text[$c+1][14]}','{$line_of_text[$c+1][15]}','{$line_of_text[$c+1][16]}','{$line_of_text[$c+1][17]}','{$line_of_text[$c+1][18]}','{$line_of_text[$c+1][19]}','$events','{$line_of_text[$c+1][8]}','$edits') on duplicate key update ContentId=ContentId";
						$res1 = mysql_query($query1);
						$contid=mysql_insert_id();
						$mtagarr=split("\,",$line_of_text[$c+1][20]);
						if(sizeof($mtagarr)>0 and $mtagarr[0]!="")
						{
							for($j=0;$j<sizeof($mtagarr);$j++)
							{
								$query1 = "insert into Metatags(ContentId,Tag) values('$contid','$mtagarr[$j]')";
								$res1 = mysql_query($query1);	

							}
						}
						$imgarr=split("\,",$line_of_text[$c+1][21]);
						if(sizeof($imgarr)>0 and $imgarr[0]!="")
						{
							for($k=0;$k<sizeof($imgarr);$k++)
							{
								$query = "insert into ContentImages(ContentId,ImgURL) values('$contid','$imgarr[$k]')";
								$res = mysql_query($query);
							}

						}
						$brandarr=split("\,",$line_of_text[$c+1][2]);
						if(sizeof($brandarr)>0 and $brandarr[0]!="")
						{
							for($k=0;$k<sizeof($brandarr);$k++)
							{
								$query = "insert into Brands(ContentId,BrandName) values('$contid','$brandarr[$k]')";
								$res = mysql_query($query);
							}

						}
						$colarr=split("\,",$line_of_text[$c+1][10]);
						if(sizeof($colarr)>0 and $colarr[0]!="")
						{
							for($k=0;$k<sizeof($colarr);$k++)
							{
								$query = "insert into ContentColors(ContentId,Color) values('$contid','$colarr[$k]')";
								$res = mysql_query($query);
							}

						}
						$subtype=split("\,",$line_of_text[$c+1][5]);
						$tertype=split("\,",$line_of_text[$c+1][6]);
						if(sizeof($subtype)>0 and $subtype[0]!="")
						{
							for($k=0;$k<sizeof($subtype);$k++)
							{
								if(sizeof($tertype)>0 and $tertype[0]!="")
								{
									for($l=0;$l<sizeof($tertype);$l++)
									{
										$query = "insert into CategoryMaster(CategoryType,MainType,SubType,TerType,ContentId) values('{$line_of_text[$c+1][4]}','{$line_of_text[$c+1][4]}','$subtype[$k]','$tertype[$l]','$contid')";
										$res = mysql_query($query);				
									}
								}	
								else
								{
										$query = "insert into CategoryMaster(CategoryType,MainType,SubType,ContentId) values('{$line_of_text[$c+1][4]}','{$line_of_text[$c+1][4]}','$subtype[$k]','$contid')";
										$res = mysql_query($query);
								}		
							}
						}
						else
						{
							$query = "insert into CategoryMaster(CategoryType,MainType,ContentId) values('{$line_of_text[$c+1][4]}','{$line_of_text[$c+1][4]}','$contid')";
							$res = mysql_query($query);						
						}						

					}
				}

				$c=$c+1;
			}
			
			if(!$res)
			{
				$_SESSION['contentadded'] = 'nosuccess';
				header('Location: addContent.php'); 
				//echo "okay";
			}
			else
			{
				//echo "<h2>Details have been added<h2>";
				$_SESSION['contentadded'] = 'success';
				header('Location: addContent.php'); 
			}
 			
	        	fclose($file);
		}
		else
		{
			
			for($i=0;$i<sizeof($malls);$i++)
			{
				$query = "select MallId from MallMaster where MallName='$malls[$i]'";
				$res = mysql_query($query);
				$row = mysql_fetch_array($res);
				$mallid=$row["MallId"];
				$query = "select ShopId from ShopMaster where ShopName='$store' and MallId='$mallid'";
				$res = mysql_query($query);
				$row = mysql_fetch_array($res);
				$shopid=$row["ShopId"];	
				$edits=0;
				$query = "insert into ContentMaster(ShopId,Content,StartDate,EndDate,StartTime,EndTime,Terms,Discount,MaxRange,MinRange,StyleTip,ProdLocation,edits,Gender,Events,MallId,Type) values	('$shopid','$content','$vsdt','$vedt','$vstm','$vetm','$terms','$disc','$max','$min','$stip','$loc','$edits','$gender','$event','$mallid','$classifications')";
				$res = mysql_query($query);			

			}
		
			$contid=mysql_insert_id();
			$brandarr=split("\,",$brands);
			$mtagarr=split("\,",$mtags);
			if(sizeof($brandarr)>0 and $brandarr[0]!="")
			{
				for($i=0;$i<sizeof($brandarr);$i++)
				{
					$query = "insert ignore into Brands(ContentId,BrandName) values('$contid','$brandarr[$i]')";
					$res = mysql_query($query);
				}
		
			}
			foreach($_FILES['contimgs']['tmp_name'] as $key => $tmp_name )
			{
			    $file_name = $key.$_FILES['contimgs']['name'][$key];
			    $file_size =$_FILES['contimgs']['size'][$key];
			    $file_tmp =$_FILES['contimgs']['tmp_name'][$key];
			    $file_type=$_FILES['contimgs']['type'][$key];
			    $uploadvar="images/".$file_name;
			    move_uploaded_file($file_tmp,"images/".$file_name);
			    $query = "insert ignore into ContentImages(ContentId,Imgurl) values('$contid','$uploadvar')";
			    $res = mysql_query($query);		    
			}
			if(sizeof($mtagarr)>0 and $mtagarr[0]!="")
			{
				for($i=0;$i<sizeof($mtagarr);$i++)
				{
					$query = "insert ignore into Metatags(ContentId,Tag) values('$contid','$mtagarr[$i]')";
					$res = mysql_query($query);
					//echo $main[$i].$sub[$i].$tertiary[$i]."<br>";
				}			
			}		
			if(sizeof($main)>0 and $main[0]!="")
			{
				$cat="Main Category";
				for($i=0;$i<sizeof($main);$i++)
				{
					$query = "insert into CategoryMaster(ShopId,CategoryType,MainType,SubType,TerType,ContentId) values('$shopid','$main[$i]','$main[$i]','$sub[$i]','$tertiary[$i]','$contid')";
					$res = mysql_query($query);
				}
			}
			if(sizeof($cols)>0)
			{
				$cat="Colour";
				for($i=0;$i<sizeof($cols);$i++)
				{
					$query = "insert ignore into ContentColors(ContentId,Color) values('$contid','$cols[$i]')";
					$res = mysql_query($query);
					//echo $main[$i].$sub[$i].$tertiary[$i]."<br>";
				}			
			}
			$_SESSION['storeselected']=$store;
			$_SESSION['mallsselected']=$malls;
			if(!$res)
			{
				$_SESSION['contentadded'] = 'nosuccess';
				header('Location: addContent.php'); 
			}
			else
			{
				echo "<h2>Details have been added<h2>";
				$_SESSION['contentadded'] = 'success';
				header('Location: addContent.php'); 
			}
		}
	}
	connect_db();
	executeinsert();

?>
