<?php

define("DBHOST","127.0.0.1");
define("DBUSER","root");
define("DBPWD","password");
define("DB","winkl");

class DB_FUNCTIONS {
  	
	public function __construct() {
		$conn = mysql_connect(DBHOST,DBUSER,DBPWD);
		$db_select = mysql_select_db(DB,$conn);		
	}
	
	public function getResults($table) 
	{
	    $data = array();
		$query = mysql_query("SELECT * FROM $table") or die(mysql_error());
		$num_rows = mysql_num_rows($query);
		if($num_rows>0) {
        	while($row=mysql_fetch_assoc($query))
				$data[]=$row;
		}
	    return $data;		
    }

	public function getBrands($table) 
	{
	    $data = array();
		$query = mysql_query("SELECT * FROM $table group by BrandName") or die(mysql_error());
		$num_rows = mysql_num_rows($query);
		if($num_rows>0) {
        	while($row=mysql_fetch_assoc($query))
				$data[]=$row;
		}
	    return $data;		
    }
	public function getStores($table) 
	{
	    $data = array();
		$query = mysql_query("SELECT distinct ShopName FROM $table as p1 inner join ContentAdminMaster as p2 on p1.ShopId=p2.ShopId") or die(mysql_error());
		$num_rows = mysql_num_rows($query);
		if($num_rows>0) {
        	while($row=mysql_fetch_assoc($query))
				//$q1 = mysql_query("SELECT * FROM $table as p1 where p1.ShopName=$row['ShopName'] inner join ContentAdminMaster p2 as p1.ShopId=p2.ShopId") or die(mysql_error());
				$data[]=$row;
		}
	    return $data;		
    }
	/*public function getColors($table) 
	{
	    $data = array();
		$query = mysql_query("SELECT * FROM $table where CategoryType='Color'") or die(mysql_error());
		$num_rows = mysql_num_rows($query);
		if($num_rows>0) {
        	while($row=mysql_fetch_assoc($query))
		{
				//echo $row['ContentId'];
				$data[]=$row;
		}
		}
	    return $data;		
    }*/

	public function getColors() 
	{
	    $data = array();
		 $file = fopen("/var/www/html/colors.txt", "r");
        	while(!feof($file))
		{
				$data[]=chop(fgets($file));
		}
		
	    return $data;		
    }
	public function getMeta($table) 
	{
	    $data = array();
		$query = mysql_query("SELECT distinct Tag FROM $table") or die(mysql_error());
		$num_rows = mysql_num_rows($query);
		if($num_rows>0) {
        	while($row=mysql_fetch_assoc($query))
		{
				//echo $row['ContentId'];
				$data[]=$row;
		}
		}
	    return $data;		
    }

	public function getPrice($table) 
	{
	    $data = array();
		$query = mysql_query("SELECT MAX(CAST(REPLACE(SUBSTRING(MaxRange,4),',','') AS UNSIGNED)) AS maxi FROM $table") or die(mysql_error());
		$num_rows = mysql_num_rows($query);
		if($num_rows>0) {
        	while($row=mysql_fetch_assoc($query))
		{
				//echo $row['ContentId'];
				$data[]=$row;
		}
		}
	    return $data;		
    }

	public function getSub($table) 
	{
	    $data = array();
		$query = mysql_query("SELECT distinct SubType FROM $table") or die(mysql_error());
		$num_rows = mysql_num_rows($query);
		if($num_rows>0) {
        	while($row=mysql_fetch_assoc($query))
		{
				//echo $row['ContentId'];
				$data[]=$row;
		}
		}
	    return $data;		
    }

	public function getTer($table) 
	{
	    $data = array();
		$query = mysql_query("SELECT distinct TerType FROM $table where TerType!=''") or die(mysql_error());
		$num_rows = mysql_num_rows($query);
		if($num_rows>0) {
        	while($row=mysql_fetch_assoc($query))
		{
				//echo $row['ContentId'];
				$data[]=$row;
		}
		}
	    return $data;		
    }
	
	public function allProducts()
	{
		$query = mysql_query("SELECT * FROM ContentAdminMaster");	
		while($row=mysql_fetch_assoc($query))
		$data[]=$row;
		
		return $data;
	}
	
	public function getproductPhoto($id)
	{
		$photo = mysql_query("SELECT * FROM ContentAdminImages where ContentId =".$id);	
		$row = mysql_fetch_array($photo);
		return $row['Imgurl'];
	}
	
	public function _getAllProductPhotos($id)
	{
		$photo = mysql_query("SELECT photo FROM tbl_productphotos where ProductID = $id limit 0,5");	
		while($row=mysql_fetch_assoc($photo))
		$data[]=$row;	
		
		return $data;
	}
	
	public function getProductDetails($id)
	{
		$query = mysql_query("SELECT * FROM tbl_products where ProductID = $id");	
		while($row=mysql_fetch_assoc($query))
		$data=$row;
		
		return $data;
	
	}
	
	public function getAvailableSize($id)
	{
		$query = mysql_query("SELECT sizeID from tbl_productsizes where ProductID = $id");
		while($row=mysql_fetch_assoc($query))
		$data[]=$row;
		
		return $data;
	}
	
}
?>
