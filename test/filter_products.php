<form method="post" action="dbopscoll.php">
<div class="card-columns" style="padding:20px">
<?php
include('includes/dbfunctions.php');
$db = new DB_FUNCTIONS();

$bcheck = $_REQUEST['bcheck'];
$scheck = $_REQUEST['scheck'];
$ccheck = $_REQUEST['ccheck'];
$gcheck = $_REQUEST['gcheck'];
$brcheck = $_REQUEST['brcheck'];
$mcheck = $_REQUEST['mcheck'];
$price_range = $_REQUEST['price_range'];
$subcheck = $_REQUEST['subcheck'];
$tercheck = $_REQUEST['tercheck'];


$WHERE = array(); $inner = $w = '';
$innershop='';
$innerbrands='';
$innermeta='';
$innersub='';
$innerter='';
$innercolor='';
if(!empty($price_range)) {
	$data3 = explode('-',$price_range);
	//echo $data3[0];
	//$WHERE[] = "(t1.MaxRange <= $data3[1] and t1.MinRange >= $data3[0])";
	$WHERE[] = "(SUBSTRING(t1.MaxRange,4) <= $data3[1] and SUBSTRING(t1.MinRange,4) >= $data3[0])";
}

if(!empty($bcheck)) {	
	if(strstr($bcheck,',')) {
		$data1 = explode(',',$bcheck);
		$barray = array();
		foreach($data1 as $c) {
			$barray[] = "t1.MallId = $c";
		}
		$WHERE[] = '('.implode(' OR ',$barray).')';
	} else {
		//echo "hi";
		$WHERE[] = '(t1.MallId = '.$bcheck.')';
	}
}

if(!empty($brcheck)) {	
	if(strstr($brcheck,',')) {
		$data1 = explode(',',$brcheck);
		$brarray = array();
		foreach($data1 as $c) {
			$brarray[] = "t2.BrandName = '".$c."'";
		}
		$WHERE[] = '('.implode(' OR ',$brarray).')';
	} else {
		//echo "hi";
		$WHERE[] = '(t2.BrandName = "'.$brcheck.'")';
	}
	$inner = 'INNER JOIN BrandsAdmin AS t2 ON t1.ContentId = t2.ContentId';
}

if(!empty($mcheck)) {	
	if(strstr($mcheck,',')) {
		$data1 = explode(',',$mcheck);
		$marray = array();
		foreach($data1 as $c) {
			$marray[] = "t2.Tag = '".$c."'";
		}
		$WHERE[] = '('.implode(' OR ',$marray).')';
	} else {
		//echo "hi";
		$WHERE[] = '(t2.Tag = "'.$mcheck.'")';
	}
	$inner = 'INNER JOIN AdminMetatags AS t2 ON t1.ContentId = t2.ContentId';
}

if(!empty($subcheck)) {	
	if(strstr($subcheck,',')) {
		$data1 = explode(',',$subcheck);
		$subarray = array();
		foreach($data1 as $c) {
			$c=str_replace("and","&",$c);
			$subarray[] = "t2.SubType = '".$c."'";
		}
		$WHERE[] = '('.implode(' OR ',$subarray).')';
	} else {
		//echo "hi";
		$subcheck=str_replace("and","&",$subcheck);
		$WHERE[] = '(t2.SubType = "'.$subcheck.'")';
	}
	$innersub = 'INNER JOIN CategoryAdminMaster AS t3 ON t1.ContentId = t3.ContentId';
}

if(!empty($tercheck)) {	
	if(strstr($tercheck,',')) {
		$data1 = explode(',',$tercheck);
		$terarray = array();
		foreach($data1 as $c) {
			$c=str_replace("and","&",$c);
			$terarray[] = "t2.TerType = '".$c."'";
		}
		$WHERE[] = '('.implode(' OR ',$terarray).')';
	} else {
		//echo "hi";
		$tercheck=str_replace("and","&",$tercheck);
		$WHERE[] = '(t2.TerType = "'.$tercheck.'")';
	}
	$inner = 'INNER JOIN CategoryAdminMaster AS t2 ON t1.ContentId = t2.ContentId';
}

if(!empty($gcheck)) {	
	if(strstr($gcheck,',')) {
		$data1 = explode(',',$gcheck);
		$garray = array();
		foreach($data1 as $c) {
			$garray[] = "t1.Gender = $c";
		}
		$WHERE[] = '('.implode(' OR ',$garray).')';
	} else {
		if($gcheck=="B")
			$WHERE[] = '(t1.Gender = "M" OR t1.Gender = "F"  )';
		else
			$WHERE[] = '(t1.Gender = "'.$gcheck.'")';
	}
}

if(!empty($ccheck)) {
	if(strstr($ccheck,',')) {
		$data2 = explode(',',$ccheck);
		$carray = array();
		foreach($data2 as $c) {
			$carray[] = "t2.Color = '".$c."'";
		}
		$WHERE[] = '('.implode(' OR ',$carray).')';
	} else {
		$WHERE[] = '(t2.Color = "'.$ccheck.'")';
	}
	$inner = 'INNER JOIN ContentAdminColors AS t2 ON t1.ContentId = t2.ContentId';
}

if(!empty($scheck)) {
	if(strstr($scheck,',')) {
		$data3 = explode(',',$scheck);
		$sarray = array();
		foreach($data3 as $c) {
			$sarray[] = "t2.ShopName = $c";
		}
		$WHERE[] = '('.implode(' OR ',$sarray).')';
	} else {
		$WHERE[] = '(t2.ShopName = "'.$scheck.'")';
	}
	$innershop = 'INNER JOIN ShopMaster AS t2 ON t1.ShopId = t2.ShopId';
	//$inner = 'INNER JOIN tbl_productsizes AS t2 ON t1.ProductID = t2.ProductID';
}
	$w = implode(' AND ',$WHERE);
	if(!empty($w)) $w = 'WHERE '.$w;
	
	//echo "SELECT DISTINCT  t1 . * FROM  `tbl_products` AS t1 $inner $w";

	if($w)
	{
		$query = mysql_query("SELECT DISTINCT  t1 . * FROM  `ContentAdminMaster` AS t1 $inner $w");
		if(mysql_num_rows($query)>0) {
			while($pro = mysql_fetch_assoc($query)) {
				$productPhoto = $db->getproductPhoto($pro['ContentId']);
		?>
		
		<!------------------------------------------------------------------------------------------------------------------------------------------------->	
			<!--div class="divbox" onclick="tb_show('<?=$pro['Title']?>','product-details.php?id=<?=$pro['ContentId']?>&keepThis=true&TB_iframe=true&height=500&width=900','thickbox');"-->
			<div class="divbox" style="height:250px;width:150px;padding:20px">
			
				<!--div style="width: 202px;height: 186px;background:url(images/products/medium/<?=str_replace("_R","",$productPhoto)?>) no-repeat;" alt="<?=$pro['Content']?>">
					<div class="image-hover"></div>
				</div-->
				<div class='card'>
				<center><img src="../images/<?=$productPhoto?>" alt='Image preview' height='200' width='200'></center>
				<div class="product_name" align="center">
					<a href="#"><span class="productname">Content ID :<?=$pro['ContentId']?></span></a>
					<div class="price">
						<span class="product_name">Content :<?=$pro['Content']?></span>
						<br><br>
					<span class="product_price">Price Range :<br><a href="#"><?=$pro['MinRange']?>-<?=$pro['MaxRange']?></a></span><br>
			<input type="checkbox" id="content" name="contents[]" class="content" value="<?=$pro['ContentId']?>"/>
					</div>
				</div>	
				</div>
			</div>
		
		<!------------------------------------------------------------------------------------------------------------------------------------------------->
		
			
		<?php
		}
	} else {
		?>
        <div align="center"><h2 style="font-family:'Arial Black', Gadget, sans-serif;font-size:30px;color:#0099FF;">No Results with this filter</h2></div>
        <?php	
	}
}
?>
</form>
