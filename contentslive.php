<!doctype html>
<?php
	global $db,$query,$res; 
	$db = mysql_connect("127.0.0.1","root","password");
	mysql_select_db("winkl");  
 
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">

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
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

    <link href="assets/jquery/jquery-ui.css" rel="stylesheet">
</head>
<style>
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
</style>
<script>
	i=0;
	function init()
	{
		//classification();

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
		if(getSelectValues(el)!="nosel")
			storedom.value=getSelectValues(el);
	}
	function classification()
	{
		disc=document.getElementById("disc");
 		el = document.getElementsByTagName('select')[3];
		if(String(getSelectValues(el))=="discount")
			disc.disabled=false;
		else
			disc.disabled=true;
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
		var preview = document.querySelector('img');
		var file    = document.querySelector('input[type=file]').files[0];
		var reader  = new FileReader();
		reader.addEventListener("load", function () {
		preview.src = reader.result;
		}, false);

		if (file) {
		reader.readAsDataURL(file);
		//filt=document.getElementById("imgfil");
		//filt.disabled=true;
		}

	}
	function imgfilter() 
	{
		el = document.getElementsByTagName('select')[2];
		//alert(getSelectValues(el));
		if(getSelectValues(el)=="bnw")
			document.getElementById("image").style.filter = "grayscale(100%)";
		else if(getSelectValues(el)=="bright")
			document.getElementById("image").style.filter = "brightness(100%)";
		else if(getSelectValues(el)=="vint")
			document.getElementById("image").style.filter = "sepia(100%)";
		else if(getSelectValues(el)=="blur")
			document.getElementById("image").style.filter = "blur(10px)";
		else
			document.getElementById("image").style.filter = "none";
		
		
	}

</script>
<body onload='init()'>
<form role="form" method="post" action="editContent.php" enctype="multipart/form-data">
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
                    <a href="addMall.html">
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
				  <li  class="active">
                    <a href="addContent.php">
                        <i class="pe-7s-note2"></i>
                        <p>Add Content </p>
                    </a>
                </li>
				<li>
                    <a href="addCoupon.html">
                        <i class="pe-7s-note2"></i>
                        <p>Add Coupon</p>
                    </a>
                </li>

                <li>
                <li>
                    <a href="notifications.html">
                        <i class="pe-7s-bell"></i>
                        <p>ABC</p>
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
                    <a class="navbar-brand" href="#">View Live Contents</a>
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
<?php
	extract($_POST);
	global $db,$query,$res,$row,$storeid; 
	$db = mysql_connect("127.0.0.1","root","password");
	mysql_select_db("winkl"); 
	$query = "select * from ShopMaster where ShopName='".$store."'";
	$res = mysql_query($query); 
	$row = mysql_fetch_array($res);
	$storeid=$row['ShopId'];
	
?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Live Contents</h4>
                                <p class="category">Contents for <?php echo $store ?> in <?php echo $mall?> Mall</p>
                            </div>
                            <div class="content table-responsive table-full-width">
				<div class="card-columns" style="padding:20px">
						<?php
							global $db,$query,$res,$row,$storeid; 
							$query = "select * from ContentAdminMaster where ShopId=$storeid";
							$res = mysql_query($query);
							extract($_POST);
							while($row = mysql_fetch_array($res)) 
							{
								echo "<div class='card'>";
								echo "<center><img src='winkl_logo.png' alt='Image preview' height='59' width='175'></center>";
								echo "<div class='card-block'>";
								echo "<h4 class='card-title'>Content Id : ".$row['ContentId']."</h4>";
								echo "<p class='card-text'> Content : <br>&nbsp;&nbsp;&nbsp;&nbsp;".$row['Content']."</p>";
								echo "<p class='card-text'> Validity period : <br>".$row['StartDate']." to ".$row['EndDate']."</p>";
								echo "<p class='card-text'> Price range : ".$row['MinRange']." - ".$row['MaxRange']."</p>";
								echo "<p class='card-text'> Discount : ".$row['Discount']."</p>";
								echo "<p class='card-text'> Style Tip : ".$row['StyleTip']."</p>";
								echo "<p class='card-text'> Product Location : <br>".$row['ProdLocation']."</p>";
								echo "<input type='hidden' name='selectedContent' value=".$row['ContentId'].">";
								echo "<input type='hidden' name='selectedMall' value=".$mall.">";
								
								echo "</div>";
								echo "</div>";
								//echo "<td>".$row['ContentId']."</td>";
								//echo "<td>".$row['Content']."</td>";
								//echo "<td>".$row['edits']."</td>";

								//echo "<td><button type='submit'  class='btn btn-info btn-fill1 pull-left'>"."EDIT"."</button></td>";
								//echo "</tr>";
				        			//echo "<option value=".$row['MallName'].">".$row['MallName']."</option>";
    							}
						?>
                                                                              
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
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js" integrity="sha384-vZ2WRJMwsjRMW/8U7i6PWi6AlO1L79snBrmgiDpgIWJ82z8eA5lenwvxbMV1PAh7" crossorigin="anonymous"></script>
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
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
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
</html>
