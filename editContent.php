<?php
	session_start();
?>
<!doctype html>
<?php
	global $db,$query,$res; 
	$db = mysql_connect("127.0.0.1","root","password");
	mysql_select_db("winkl");  
 	extract($_POST); 
	if($approve)
	{
		//die("hi");
		$query="insert ignore into ContentAdminMaster select * from ContentMaster"; 
		$res = mysql_query($query);
		$query="insert ignore into CategoryAdminMaster select * from CategoryMaster"; 
		$res = mysql_query($query);
		$query="delete from CategoryMaster where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="insert ignore into ContentAdminColors select * from ContentColors"; 
		$res = mysql_query($query);
		$query="delete from ContentColors where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="insert ignore into AdminMetatags select * from Metatags"; 
		$res = mysql_query($query);
		$query="delete from Metatags where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="insert ignore into BrandsAdmin select * from Brands"; 
		$res = mysql_query($query);
		$query="delete from Brands where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="insert ignore into ContentAdminImages select * from ContentImages"; 
		$res = mysql_query($query);
		$query="delete from ContentImages"; 
		$res = mysql_query($query);
		$query="delete from ContentMaster"; 
		$res = mysql_query($query);
		$_SESSION['allcontentverified'] = 'successverify';
		header('Location: viewContent.php');
		
	}
	if($del)
	{
		$query="insert ignore into ContentArchiveMaster select * from ContentMaster where ContentId=$del"; 
		$res = mysql_query($query);
		$query="insert ignore into CategoryArchiveMaster select * from CategoryMaster where ContentId=$del"; 
		$res = mysql_query($query);
		$query="delete from CategoryMaster where ContentId=$del"; 
		$res = mysql_query($query);
		$query="insert ignore into ContentArchiveColors select * from ContentColors where ContentId=$del"; 
		$res = mysql_query($query);
		$query="delete from ContentColors where ContentId=$del"; 
		$res = mysql_query($query);
		$query="insert ignore into ArchiveMetatags select * from Metatags where ContentId=$del"; 
		$res = mysql_query($query);
		$query="delete from Metatags where ContentId=$del"; 
		$res = mysql_query($query);
		$query="insert ignore into BrandsArchive select * from Brands where ContentId=$del"; 
		$res = mysql_query($query);
		$query="delete from Brands where ContentId=$del"; 
		$res = mysql_query($query);
		$query="insert ignore into ContentArchiveImages select * from ContentImages where ContentId=$del"; 
		$res = mysql_query($query);
		$query="delete from ContentImages where ContentId=$del"; 
		$res = mysql_query($query);
		$query="delete from ContentMaster where ContentId=$del"; 
		$res = mysql_query($query);
		//$row = mysql_fetch_array($res)	
		$_SESSION['contentdeleted'] = 'successdel';
		header('Location: viewContent.php');
	}
	else if($verify)
	{
		$query="insert ignore into ContentAdminMaster select * from ContentMaster where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="insert ignore into CategoryAdminMaster select * from CategoryMaster where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="delete from CategoryMaster where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="insert ignore into ContentAdminColors select * from ContentColors where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="delete from ContentColors where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="insert ignore into AdminMetatags select * from Metatags where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="delete from Metatags where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="insert ignore into BrandsAdmin select * from Brands where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="delete from Brands where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="insert ignore into ContentAdminImages select * from ContentImages where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="delete from ContentImages where ContentId=$verify"; 
		$res = mysql_query($query);
		$query="delete from ContentMaster where ContentId=$verify"; 
		$res = mysql_query($query);
		$_SESSION['contentverified'] = 'successverify';
		header('Location: viewContent.php');
	}
	$query="select * from ContentMaster where ContentId=$edit"; 
	$res = mysql_query($query);
	$row = mysql_fetch_array($res);
	$querycat="select * from CategoryMaster where ContentId=$edit"; 
	$rescat = mysql_query($querycat);
	$querycol="select * from ContentColors where ContentId=$edit"; 
	$rescol = mysql_query($querycol);
	while($rowcol=mysql_fetch_array($rescol))
	{
		$colarr[]=$rowcol['Color'];
	}
	$querybrand="select * from Brands where ContentId=$edit"; 
	$resbrand = mysql_query($querybrand);
	while($rowbrand=mysql_fetch_array($resbrand))
	{
		$brandarr[]=$rowbrand['BrandName'];
	}
	$brandstr=implode(",",$brandarr);
	$querymeta="select * from Metatags where ContentId=$edit"; 
	$resmeta = mysql_query($querymeta);
	while($rowmeta=mysql_fetch_array($resmeta))
	{
		$metaarr[]=$rowmeta['Tag'];
	}
	$metastr=implode(",",$metaarr);

	$query = "select * from FirstLevelTags";
	$res = mysql_query($query); 
        $result_array = Array();
        while($rowfirst = mysql_fetch_array($res)) {
		$main_array[] = $rowfirst['Tag'];
        }
	$query = "select * from SecondLevelTags";
	$res = mysql_query($query); 
        while($rowsecond = mysql_fetch_array($res)) {
		$sub_array[] = $rowsecond['Tag'];
        }
	$query = "select * from ThirdLevelTags";
	$res = mysql_query($query); 
        while($rowthird = mysql_fetch_array($res)) {
		$ter_array[] = $rowthird['Tag'];
        }
        //convert the PHP array into JSON format, so it works with javascript
	$main_array= array_unique(array_filter($main_array));
        $json_array = json_encode($main_array);
	$sub_array= array_unique(array_filter($sub_array));
        $json_sub_array = json_encode($sub_array);
	$ter_array= array_unique(array_filter($ter_array));
        $json_ter_array = json_encode($ter_array);
	//$rowcat = mysql_fetch_array($rescat)
?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    
    <link href="assets/css/bootstrap-select.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <link href="assets/css/bootstrap-select.min.css" rel="stylesheet"/>
    
    <link rel="stylesheet" href="assets/css/bootstrap-tagsinput.css">

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="instaassets/css/cssgram.min.css" rel="stylesheet" />
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link href="assets/jquery/jquery-ui.css" rel="stylesheet">
</head>
<style>

label.radio-inline, label.checkbox-inline {   background-color: #dcdfd4;   cursor: pointer;   font-weight: 400;   margin-bottom: 10px !important;   margin-right: 2%;   margin-left:0;   padding: 10px 10px 10px 30px; } label.radio-inline.checked, label.checkbox-inline.checked {   background-color: #266c8e;   color: #fff !important;   text-shadow: 1px 1px 2px #000 !important; } .checkbox-inline + .checkbox-inline, .radio-inline + .radio-inline {   margin-left: 0; } .columns label.radio-inline, .columns label.checkbox-inline {   min-width: 190px;   vertical-align: top;   width: 30%; } .additional-info-wrap {   display: inline-block;   margin: 0 2% 0 0;   min-width: 190px;   position: relative;   vertical-align: top;   width: 30%; } .additional-info-wrap label.checkbox-inline, .additional-info-wrap label.radio-inline {   width: 100% !important; } .additional-info-wrap .additional-info {   background-color: #ffffff;   clear: both;   color: #000 !important;   margin-top: -10px;   padding: 0 10px 10px;   text-shadow: 1px 1px 2px #000 !important;   width: 100%; }

.btn-file {
  position: relative;
  overflow: hidden;
}
.btn-file input[type=file] {
  position: absolute;
  top: 0;
  right: 0;
  min-width: 100%;
  min-height: 100%;
  font-size: 100px;
  text-align: right;
  filter: alpha(opacity=0);
  opacity: 0;
  background: red;
  cursor: inherit;
  display: block;
}
input[readonly] {
  background-color: white !important;
  cursor: text !important;
}

.control {
	font-size: 18px;
	position: relative;
	display: block;
	margin-bottom: 15px;
	padding-left: 30px;
	cursor: pointer;
}

.control input {
	position: absolute;
	z-index: -1;
	opacity: 0;
}
.control__indicator {
	position: absolute;
	top: 2px;
	left: 0;
	width: 20px;
	height: 20px;
	background: #e6e6e6;
}

/* Check mark */

.control__indicator:after {
	position: absolute;
	display: none;
	content: '';
}

/* Show check mark */
.control input:checked ~ .control__indicator:after {
	display: block;
}

/* Checkbox tick */
.control--checkbox .control__indicator:after {
	top: 4px;
	left: 8px;
	width: 3px;
	height: 8px;
	transform: rotate(45deg);
	border: solid #000;
	outline: 1px solid #fff;
	border-width: 0 2px 2px 0;
}

</style>
<script src="assets/jquery/jquery.js"></script>
<script src="assets/jquery/jquery-ui.js"></script>
<script>
	i=0;
	function init()
	{
		classification();
		$('.selectpicker').selectpicker({
		    dropupAuto: false
		});

	}
	function enableButton2() 
	{
            document.getElementById("view").disabled = false;
        }
	function getSelectValues(select) 
	{
	  	var result = [];
		var options = select && select.options;
		var opt;

		for (var i=0, iLen=options.length; i<iLen; i++) 
		{
			opt = options[i];
			if (opt.selected) 
			{
			      result.push(opt.value || opt.text);
    			}
  		}
  		return result;
	}
	function select()
	{
		dom=document.getElementById("dom");
 		el = document.getElementsByTagName('select')[0];
		dom.value=getSelectValues(el);
	}
	function storeSelect()
	{
		storedom=document.getElementById("store");
 		el = document.getElementsByTagName('select')[1];
		storedom.value=getSelectValues(el);
	}
	function classification()
	{
		disc=document.getElementById("disc");
		var classifications = document.querySelector('input[name = "classifications"]:checked').value;
		if(classifications=="discount")
			disc.disabled=false;
		else
		{
			disc.disabled=true;
			disc.value="";
		}
	}
    	function updateTextInputMin(val) 
	{
	      document.getElementById('minval').value="Rs."+val; 
	}
    	function updateTextInputMax(val) 
	{
	      document.getElementById('maxval').value="Rs."+val; 
	}
	function dispImg() 
	{
		var preview = document.getElementById('image');
		//var file    = document.querySelector('input[type=file]').files[1];
		var file    = document.getElementById('view');
		var reader  = new FileReader();
		reader.addEventListener("load", function () {
		preview.src = reader.result;
		}, false);

		if (file) {
		reader.readAsDataURL(file.files[0]);
		//filt=document.getElementById("imgfil");
		//filt.disabled=true;
		}

	}
	function imgfilter() 
	{
		el = document.getElementsByTagName('select')[0];
		alert(getSelectValues(el));
		if(getSelectValues(el)=="aden")
			document.getElementById("imagefig").className = "aden";
		else if(getSelectValues(el)=="reyes")
			document.getElementById("imagefig").className = "reyes";
		else if(getSelectValues(el)=="perpetua")
			document.getElementById("imagefig").className = "perpetua";
		else if(getSelectValues(el)=="inkwell")
			document.getElementById("imagefig").className = "inkwell";
		else if(getSelectValues(el)=="toaster")
			document.getElementById("imagefig").className = "toaster";
		else if(getSelectValues(el)=="walden")
			document.getElementById("imagefig").className = "walden";
		else if(getSelectValues(el)=="hudson")
			document.getElementById("imagefig").className = "hudson";
		else if(getSelectValues(el)=="gingham")
			document.getElementById("imagefig").className = "gingham";
		else if(getSelectValues(el)=="mayfair")
			document.getElementById("imagefig").className = "mayfair";
		else if(getSelectValues(el)=="lofi")
			document.getElementById("imagefig").className = "lofi";
		else if(getSelectValues(el)=="moon")
			document.getElementById("imagefig").className = "moon";
		else if(getSelectValues(el)=="xpro2")
			document.getElementById("imagefig").className = "xpro2";
		else if(getSelectValues(el)=="_1977")
			document.getElementById("imagefig").className = "_1977";
		else if(getSelectValues(el)=="xpro2")
			document.getElementById("imagefig").className = "xpro2";
		else if(getSelectValues(el)=="brooklyn")
			document.getElementById("imagefig").className = "brooklyn";
		else if(getSelectValues(el)=="nashville")
			document.getElementById("imagefig").className = "nashville";
		else if(getSelectValues(el)=="lark")
			document.getElementById("imagefig").className = "lark";
		else if(getSelectValues(el)=="willow")
			document.getElementById("imagefig").className = "willow";
		else if(getSelectValues(el)=="clarendon")
			document.getElementById("imagefig").className = "clarendon";
		else
			document.getElementById("imagefig").className = "orig";
		
		
	}
	function addMtags(id1,id2)
	{
		mtags=document.getElementById(id2);
		metatags=document.getElementById(id1);
		mtags.value=metatags.value;
	}
	function createRow()
	{
		row=document.createElement('tr');
		var cell=document.createElement('td');
		var inputType=document.createElement('input');
		//inputType.type='text';
		inputType.id='tags';
		inputType.className="tags";
		inputType.name='main[]';
		inputType.placeholder="Main Category";
		//inputType.required=true;
		inputType.style.width="180px";
		cell.appendChild(inputType);
		row.appendChild(cell);
		var cell=document.createElement('td');
		var inputType=document.createElement('input');
		//inputType.type='text';
		inputType.id='tags-sub';
		inputType.className="tags-sub";
		inputType.name='sub[]';
		inputType.placeholder="Sub Category";
		//inputType.required=true;
		inputType.style.width="180px";
		cell.style.padding="5px";
		cell.appendChild(inputType);
		row.appendChild(cell);
		var cell=document.createElement('td');
		var inputType=document.createElement('input');
		//inputType.type='text';
		inputType.id='tags-ter';
		inputType.className="tags-ter";
		inputType.name='tertiary[]';
		inputType.placeholder="Tertiary Category";
		//inputType.required=true;
		inputType.style.width="180px";
		cell.style.padding="5px";
		cell.appendChild(inputType);
		row.appendChild(cell);		
		var cell=document.createElement('td');
		checkBox=document.createElement('input');
		checkBox.type='image';
		checkBox.id='select'+i++;
		checkBox.src='x.png';
		cell.style.padding="1px";
		cell.appendChild(checkBox);
		row.appendChild(cell);
		table=document.getElementById('members');
		table.appendChild(row);
		checkBox.addEventListener("click",removeRows,false);
  $(function() {
    var availableTags = $.map(<?php echo $json_array; ?>, function(el) { return el });
    $( ".tags" ).autocomplete({
      source: availableTags
    });
  });
  $(function() {
		    $( ".tags" ).on('change',function(){$.ajax({
				url: 'ajaxCatData.php',
				type: 'POST',
				 data: { maintag: this.value },
				 success: function(data) {
		    //var availableTags = $.map(data, function(el) { return el });
		    $( ".tags-sub" ).autocomplete({
		      source: JSON.parse(data)
		    });
		  $(function() {
				    $( ".tags-sub" ).on('change',function(){$.ajax({
						url: 'ajaxTerCatData.php',
						type: 'POST',
						 data: { subtag: this.value },
						 success: function(data) {
				    //var availableTags = $.map(data, function(el) { return el });
				    $( ".tags-ter" ).autocomplete({
				      source: JSON.parse(data)
				    });
				 }
			     });
			});

		  });
                 }
             });
	});

  });
	}
	function removeRows()
	{
		    l=document.getElementById(this.id);
		    alert(l);
		    r=l.parentNode.parentNode;
		    table.removeChild(r);
	}
	function removeExistingRows(id)
	{
		    table=document.getElementById('members');
		    l=document.getElementById(id);
		    alert(l);
		    r=l.parentNode.parentNode;
		    r.parentNode.removeChild(r);
	}
</script>
<body onload='init()'>
<form role="form" method="post" action="dbopseditcontent.php" enctype="multipart/form-data">
<div class="wrapper">
    <div class="sidebar">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


        	<div class="sidebar-wrapper">
		<center>
            <div class="logo">
                 <img id="winkl_logo" src="winkl_logo.png" alt="&nbsp;&nbsp;No image selected" height="59" width="175"/>
            </div>
		</center>

   
            <ul class="nav">
                <li>
                    <a href="addMall.php">
                        <i class="pe-7s-graph"></i>
                        <p>Add Mall</p>
                    </a>
                </li>
		
                <li>
                    <a href="store.php">
                        <i class="pe-7s-user"></i>
                        <p>Add Store</p>
                    </a>
                </li>
		<li>		  
                    <a href="addContent.php">
                        <i class="pe-7s-note2"></i>
                        <p>Add Content </p>
                    </a>
                </li>
                <li>
			<li  class="active">
                    <a href="viewContent.php">
                        <i class="pe-7s-note2"></i>
                        <p>Unverified Content</p>
                    </a>
                </li>
                <li>
                    <a href="verified.php">
                        <i class="pe-7s-note2"></i>
                        <p>Verified Content</p>
                    </a>
                </li>
				<li>
                    <a href="test">
                        <i class="pe-7s-note2"></i>
                        <p>Add Collection</p>
                    </a>
                </li>

                <li>
                <li>
                    <a href="addCoupon.html">
                        <i class="pe-7s-bell"></i>
                        <p>Add Coupon</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>
	    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div style="background: linear-gradient(-90deg, black, white);" class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Edit Content</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
 <form class="navbar-form pull-left" role="search">
                    
                        
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                          <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
                                    <span class="notification">5</span>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    More
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                             <li>
					<a href="table1.html">
                        <i class="pe-7s-note2"></i>
                        <p>ABC</p>
                    </a>
                </li>
				<li>
					<a href="table2.html">
                        <i class="pe-7s-note2"></i>
                        <p>ABC</p>
                    </a>
                </li>
                              </ul>
                        </li>
                        <li>
                            <a href="#">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Content</h4>
                            </div>
                            <div class="content">
							<?php
							global $db,$query1,$res1,$row1,$row,$mallid; 
							$query1 ="select * from ShopMaster where ShopId=$row[ShopId]";
							$res1 = mysql_query($query1); 
							while($row1 = mysql_fetch_array($res1)) 
							{
				        			$shopname= $row1['ShopName'];
								$mallid=$row1['MallId'];
    							}
							$query1 ="select * from MallMaster where MallId=$mallid";
							$res1 = mysql_query($query1); 
							$row1 = mysql_fetch_array($res1);
							$mallname=$row1['MallName'];
							?>
				<input type="hidden" name="contentid"  value="<?php echo $edit;?>" readonly required></input>	
				<input type="hidden" name="mallid"  value="<?php echo $mallid;?>" readonly required></input>	
				<input type="hidden" name="shopid"  value="<?php echo $row[ShopId];?>" readonly required></input>	
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mall Name</label>
                                                <input id ="dom" name="mall" class="form-control" value="<?php echo $mallname;?>" readonly required></input>
                                            </div>
                                        </div>
				    </div>
						<?php
							global $db,$query1,$res1,$row1; 
							$query1 = "select * from MallMaster";
							$res1 = mysql_query($query1); 
							
						?>
				    <!--div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
 						 <select onchange='select()' class="selectpicker dropdown" data-style="btn btn-primary btn-fill" style="display:none"  data-selected-text-format="static" title="Select Mall" id="choose_mall" data-live-search="true" disabled>
						<?php
							global $db,$query1,$res1,$row1; 
							while($row1 = mysql_fetch_array($res1)) 
							{
								//echo "<h2>".$row['MallName']."</h2>";
				        			echo "<option value=".$row1['MallName'].">".$row1['MallName']."</option>";
    							}
						?>
						  </select>

                                            </div>
                                        </div>
				    </div-->
	
				<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Store Name</label>
                                                <input id ="store" name="store" class="form-control" value="<?php echo $shopname;?>" readonly required></input>
                                            </div>
                                        </div>
				    </div>

				<!--div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
 						 <select onchange='storeSelect()' data-style="btn btn-primary btn-fill" id="choose_sto" disabled>
							<option value="Select Mall first">Select store</option>
						  </select>

                                            </div>
                                        </div>
				    </div-->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
						<label>Select image</label>
						<input type="file"  name="contimgs[]" class="btn btn-primary btn-fill " id="view" value="Select logo image" accept="image/*" onchange="dispImg(this)" multiple/>
                                            </div>
                                        </div>
				    </div>
					<br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Preview</label>
						<figure class="orig" id="imagefig">
                                                <img id="image" src="#" alt="&nbsp;&nbsp;No image selected" height="200" />
						</figure>
                                            </div>
                                        </div>
				    </div>
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
						<label>Image Filter</label>
		  				<select id="imgfil" onchange='imgfilter()' class="selectpicker dropdown" data-style="btn btn-primary btn-fill">
							<option value="orig">Original</option>
					        	<option value="aden">Aden</option>
				                	<option value="reyes">Reyes</option>
							<option value="perpetua">Perpetua</option>
							<option value="inkwell">Inkwell</option>
							<option value="toaster">Toaster</option>
							<option value="walden">Walden</option>
							<option value="hudson">Hudson</option>
							<option value="gingham">Gingham</option>
							<option value="lofi">Lo-Fi</option>
							<option value="xpro2">XPRO2</option>
							<option value="_1977">Vintage</option>
							<option value="brooklyn">Brooklyn</option>
							<option value="nashville">Nashville</option>
							<option value="lark">Lark</option>
							<option value="moon">Moon</option>
							<option value="clarendon">Clarendon</option>
							<option value="willow">Willow</option>
						  </select>


                                            </div>
                                        </div>
				    </div>
				    <div class="row" id="chkbox">
                                            <div class="form-group">
						<div class="col-md-12 columns">
						<label>Gender</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  				<span class='additional-info-wrap'>
						<label class='radio-inline'>
						<input type='radio' name='gender' id='gender' value="M" <?php echo ($row['Gender']=='M')?'checked':'' ?>>Male</input>
						</label>
						<label class='radio-inline'>
						<input type='radio' name='gender' id='gender' value="F" <?php echo ($row['Gender']=='F')?'checked':'' ?>>Female</input>
						</label>
						<label class='radio-inline'>
						<input type='radio' name='gender' id='gender' value="B" <?php echo ($row['Gender']=='B')?'checked':'' ?>>Both</input>
						</label>
                                            </div>
                                        </div>
				    </div>
 				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
						<label>Brands</label>
						<input type="text" data-role="tagsinput" id="brandtags" value="<?php echo $brandstr;?>"/>
						<input type="hidden" id ="brands" name="brands" class="form-control" value="<?php echo $brandstr;?>"></input>
                                            </div>
                                        </div>
				    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="5" class="form-control" placeholder="Add Text" name="content" ><?php echo $row['Content'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
						<label class='checkbox-inline'>Event&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<input type='checkbox' name='event' id='event' value="1" <?php echo ($row['Events']==1)?'checked':'' ?>></input>
						</label>
                                            </div>
                                        </div>
				    </div>  
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
						<label>Classification</label>
		  				<span class='additional-info-wrap'>
						<label class='radio-inline'>
						<input type='radio' name='classifications' id='discount' value="discount" <?php echo ($row['Type']=='discount')?'checked':'' ?> onchange="classification()">Discount</input>
						</label>
						<label class='radio-inline'>
						<input type='radio' name='classifications' id='tryout' value="tryout" <?php echo ($row['Type']=='tryout')?'checked':'' ?> onchange="classification()">Tryout</input>
						</label>
						<label class='radio-inline'>
						<input type='radio' name='classifications' id='bestselling' value="bestselling" <?php echo ($row['Type']=='bestselling')?'checked':'' ?> onchange="classification()">Best Selling</input>
						</label>
						<label class='radio-inline'>
						<input type='radio' name='classifications' id='excl' value="excl" <?php echo ($row['Type']=='excl')?'checked':'' ?> onchange="classification()">Exclusive</input>
						</label>
                                            </div>
                                        </div>
				    </div>

                                    <div class="row" id="discrow">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Discount</label>
                                                <input type="text" class="form-control" placeholder="Enter discount" id="disc" name="disc" value="<?php echo $row[Discount];?>" disabled>
                                            </div>
                                        </div>
				    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div id="slider"></div>
                                            </div>
                                        </div>
				    </div>  
                                    <div class="row">
                                      <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Min Price</label>
                                  		<input type="text" name="min" class="form-control" id="minval" value="<?php echo $row[MinRange];?>"  style="text-align:right">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Max Price</label>
                                  		<input type="text" name="max" class="form-control" id="maxval" value="<?php echo $row[MaxRange];?>"  style="text-align:right">
                                            </div>
                                        </div>
				    </div>  
 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Category</label>
                                                <!--input type="text" class="form-control" placeholder="Product Category" id="prod-cat"-->
						<div id="tabs">
							<ul>
								<li><a href="#tabs-1">Category</a></li>
								<li><a href="#tabs-2">Colour</a></li>
								<li><a href="#tabs-3">Meta-tags</a></li>
							</ul>
							<div id="tabs-1">			   
								<table id='members' style="width:102%">
									<tr>
										<th style="width:36%"><label>Main Category</label></th>
										<th style="padding:10px;width:36%"> <label>Sub Category</label></th>
										<th style="padding:10px;width:36%"> <label>Tertiary Category</label></th>
										<?php
										while($rowcat=mysql_fetch_array($rescat))
											{
												echo "<tr><td><input name='main[]' class='tags'  value='".$rowcat['MainType']."'/></td>";
												echo "<td style='padding:5px;'><input name='sub[]' class='tags-sub' value='".$rowcat['SubType']."'/></td>";
												echo "<td style='padding:5px;'><input name='tertiary[]' class='tags-ter' value='".$rowcat['TerType']."'/></td>";
												echo "<td><input type='image' src='x.png' style='padding:1px' id='row_".$rowcat['CategoryId']."' onclick='removeExistingRows(this.id);'/></td></tr>";
											}
										?>
									</tr>

								  </table>
								     <div class="row">
									<div class="col-md-6">
									    <div class="form-group">
									        <button type="button"  class="btn btn-info btn-fill1 pull-left" onclick='createRow()'>Add More +</button>
									    </div>
									</div>
								    </div>
							</div>
							<div id="tabs-2">
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Select colour</label><br>
						<!--div><input id ="colors" class="form-control"></input></div><br>
							<input type="hidden" id ="cols" name="cols" class="form-control"></input>
							<input type="color" class="form-control" id="getColor" onchange="selectTags()">

                                            	</div-->
						<div class="control-group" style="height:100px;overflow-y: scroll;">
							<?php $file = fopen("colors.txt", "r");
								while(!feof($file)){
								$line=chop(fgets($file));
								?>
							<label class="control control--checkbox"><?php echo $line;?>
								<input type="checkbox" name="cols[]" value="<?php echo $line;?>" <?php echo (in_array($line, $colarr))?'checked':'' ?>/>
								<div class="control__indicator" style="background:<?php echo $line;?>"></div>
							</label>
							<?php }?>
						</div>
                                            </div>
				    	</div>
				</div>
				</div>
							<div id="tabs-3">
								<input type="text" data-role="tagsinput" id="metatags" value="<?php echo $metastr;?>" onchange="addMtags(this.id,'mtags')"/>
								<input type="hidden" id ="mtags" name="mtags" class="form-control" value="<?php echo $metastr;?>"></input>
							</div>
						</div>
                                            </div>
                                        </div>
				    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Style tip</label>
                                                <input type="text" class="form-control" placeholder="Style tip" id="stip" name="stip" value="<?php echo $row[StyleTip];?>">
                                            </div>
                                        </div>
				    </div> 
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Validity - Start Time</label>
                                                <input type="date" class="form-control" id="date" name="vstm" value="<?php echo $row[StartTime];?>">
                                            </div>
                                        </div>
				    </div>  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Validity - End Time</label>
                                                <input type="date" class="form-control" id="date" name="vetm" value="<?php echo $row[EndTime];?>">
                                            </div>
                                        </div>
				    </div>  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Validity - Start Date</label>
                                                <input type="text" class="form-control" id="datepicker" name="vsdt" value="<?php echo $row[StartDate];?>">
                                            </div>
                                        </div>
				    </div>  
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Validity - End Date</label>
                                                <input type="text" class="form-control" id="datepicker1" name="vedt" value="<?php echo $row[EndDate];?>">
                                            </div>
                                        </div>
				    </div> 
                             	 <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Terms</label>
                                                <textarea rows="5" class="form-control" placeholder="Terms and Conditions" name="terms">
<?php echo $row['Terms'];?></textarea>
                                            </div>
                                        </div>
                                    </div>  
                             	 <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Description</label>
                                                <textarea rows="5" class="form-control" placeholder="How to get here" name="loc"><?php echo $row['ProdLocation'];?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" value="Change Content" class="btn btn-primary btn-fill pull-right"></input>
                                    <div class="clearfix"></div>
                                
                            </div>
                        </div>
                    </div>

                    </div>

                </div>
            </div>
        </div>


     
    </div>
</div>
</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#choose_mall').on('change',function(){
        var  mallId= $(this).val();
        if(mallId){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'mallId='+mallId,
                success:function(data){
		    console.log("everything worked!");
                    $('#choose_sto').html(data);
                }
            }); 
        }
    });
});
</script>
	<script src="assets/jquery/jquery.js"></script>
	<script src="assets/jquery/jquery-ui.js"></script>
 <script>

$( "#datepicker" ).datepicker({
	inline: true
});
$( "#datepicker1" ).datepicker({
	inline: true
});



$( "#slider" ).slider({
      range: true,
      min: 0,
      max: 100000,
      values: [ 10000, 50000 ],
      slide: function( event, ui ) {
        $( "#minval" ).val( "Rs." + ui.values[ 0 ]);
	$( "#maxval" ).val( "Rs." + ui.values[ 1 ]);
      }
});



$( "#progressbar" ).progressbar({
	value: 20
});

$( "#tabs" ).tabs();

$( "#spinner" ).spinner();



$( "#menu" ).menu();



$( "#tooltip" ).tooltip();



$( "#selectmenu" ).selectmenu();


// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}
);
</script>
</body>

    <!--   Core JS Files   -->
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<script src="assets/js/bootstrap-select.js" type="text/javascript"></script>
<script src="assets/js/bootstrap-select.min.js" type="text/javascript"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>
<script src="assets/js/bootstrap-tagsinput.js"></script>
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>
        <script type="text/javascript" src="assets/js/WebContent/zip.js"></script>
        <script type="text/javascript" src="assets/js/WebContent/rar.js"></script>	
</html>
