<?php
	session_start();
?>

<!doctype html>
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
	select {
		border: 0 !important;  /*Removes border*/
		-webkit-appearance: none;  /*Removes default chrome and safari style*/
		-moz-appearance: none; /* Removes Default Firefox style*/
        appearance:none;
		background: #0088cc url(assets/img/select-arrow.png) no-repeat 100% center;
		width: 220px; /*Width of select dropdown to give space for arrow image*/
		height: 30px;
		text-indent: 0.01px; /* Removes default arrow from firefox*/
		text-overflow: "";  /*Removes default arrow from firefox*/ /*My custom style for fonts*/
		color: #FFF;
		padding: 5px;
		border-radius: 5px;
		box-shadow: inset 0 0 5px rgba(000,000,000, 0.5);
	}
</style>
<script>
	i=0;
	function init()
	{
		//classification();
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
<form role="form" method="post" action="editContent.php" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to perform this action?')">
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
                    <a class="navbar-brand" href="#">View Content</a>
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
				<input type="submit" class="btn btn-primary btn-fill pull-right" value="Approve all contents" id="approve" name="approve">
                                <h4 class="title">View Content</h4>
                            </div>
                            <div class="content">
			
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mall Name</label>
                                                <input id ="dom" name="mall" class="form-control" readonly required></input>
                                            </div>
                                        </div>
				    </div>
						<?php
							global $db,$query,$res,$row; 
							$db = mysql_connect("127.0.0.1","root","password");
							mysql_select_db("winkl");  
							$query = "select * from MallMaster";
							$res = mysql_query($query); 
							
						?>
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
 						 <select onchange='select()' id="choose_mall" name="choose_mall">
						<option selected disabled>Select Mall</option>
						<?php
							global $db,$query,$res,$row; 
							while($row = mysql_fetch_array($res)) 
							{
								//echo "<h2>".$row['MallName']."</h2>";
				        			echo "<option value='".$row['MallName']."'>".$row['MallName']."</option>";
    							}
						?>
						  </select>

                                            </div>
                                        </div>
				    </div>
				<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Store Name</label>
                                                <input id ="store" name="store" class="form-control" readonly required></input>
                                            </div>
                                        </div>
				    </div>
						<?php
							global $db,$query,$res,$row; 
							$db = mysql_connect("127.0.0.1","root","password");
							mysql_select_db("winkl"); 
							//$mallname= "<script>document.write(document.getElementById('dom').value)</script>";
							//$mall="<script>"."document.getElementById('dom').value"."</script>"; 
							//echo "<script>"."alert(document.getElementById('dom').value)"."</script>";
							$query = "select * from ShopMaster";
							$res = mysql_query($query); 
							
						?>
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
 						 <select onchange='storeSelect()' id="choose_sto" >
							<option selected disabled>Select Store</option>
						  </select>

                                            </div>
                                        </div>
				    </div>
				<div class="content">
				    <div class="container-fluid">
						    <div class="content table-responsive table-full-width">
							<div class="card-columns" style="padding:20px" id="contents">
						</div>
						    </div>
					</div>
					</div>
					<?php 
						if ( $_SESSION['contentedited']=="success" )
						{
						     echo "<div id='dialog-confirm' title='Add another content?'>";
						     echo "<p><span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 20px 0;'></span>Data successfully changed</p>";
						     echo "</div>";
						     $_SESSION['contentedited'] = null;
						}
						else if ( $_SESSION['contentedited']=="nosuccess" )
						{
						     echo "<div id='dialog-message' title='Error'>";
  						     echo "<p>";
						     echo "<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>Some error occured.Please check your details</p></div>";
						     $_SESSION['contentedited'] = null;
						}
						else if ( $_SESSION['contentdeleted']=="successdel" )
						{
						     echo "<div id='dialog-message1' title='Deleted'>";
  						     echo "<p>";
						     echo "<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>Content Deleted</p></div>";
						     $_SESSION['contentdeleted'] = null;
						}
						else if ( $_SESSION['contentverified']=="successverify" )
						{
						     echo "<div id='dialog-message2' title='Verified'>";
  						     echo "<p>";
						     echo "<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>Content Verified</p></div>";
						     $_SESSION['contentverified'] = null;
						}
						else if ( $_SESSION['allcontentverified']=="successverify" )
						{
						     echo "<div id='dialog-message2' title='Verified'>";
  						     echo "<p>";
						     echo "<span class='ui-icon ui-icon-alert' style='float:left; margin:0 7px 50px 0;'></span>All contents verified</p></div>";
						     $_SESSION['allcontentverified'] = null;
						}
						$_SESSION['contentedited'] = null;
					?>
					<!--button type="submit" class="btn btn-primary btn-fill pull-right" type="submit">View Contents</button-->
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
                url:'ajaxDatanew.php',
                data:'mallId='+mallId,
                success:function(data){
		    console.log("everything worked!111");
		    $('#store').val("");
		    $('#contents').html("");
                    $('#choose_sto').html(data);
		   
		    //$('.selectpicker').selectpicker('refresh');

 $('#choose_sto').on('change',function(){
        var  store= $(this).val();
        if(store){
            $.ajax({
                type:'POST',
                url:'contents.php',
                data:'store='+store,
                success:function(data){
		    console.log("everything worked!222");
                    $('#contents').html(data);
		    //$('#approve').prop('disabled',false);	
                }
            }); 
        }
    });


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

    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:180,
      modal: true,
      buttons: {
        "Edit another content": function() {
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });

    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });

    $( "#dialog-message1" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });

    $( "#dialog-message2" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });


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
</html>
