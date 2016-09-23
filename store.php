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
.success {
    width:250px;
    height:20px;
    height:auto;
    position:absolute;
    left:50%;
    margin-left:-100px;
    top:10px;
    background-color: #383838;
    color: #000000;
    font-family: Calibri;
    font-size: 12px;
    padding:10px;
    text-align:center;
    font-weight: bold;
    border-radius: 2px;
    -webkit-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
    -moz-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
    box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
}

.error {
    width:250px;
    height:20px;
    height:auto;
    position:absolute;
    left:50%;
    margin-left:-100px;
    top:10px;
    background-color: #383838;
    color: #F0F0F0;
    font-family: Calibri;
    font-size: 12px;
    padding:10px;
    text-align:center;
    font-weight: bold;
    border-radius: 2px;
    -webkit-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
    -moz-box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
    box-shadow: 0px 0px 24px -1px rgba(56, 56, 56, 1);
}
</style>

<script>
	i=0;
	function init()
	{
		createRow();

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
	function showMalls()
	{
		chkbox=document.getElementById("chkbox");
		//chkbox.style.display="block";
    		if (chkbox.style.display !== "none") 
		{
		        chkbox.style.display = "none";
    		}
    		else 
		{
		        chkbox.style.display = "block";
    		}
	}
</script>

<body onload='init()'>
<form role="form" method="post" action="dbopstore.php" enctype="multipart/form-data">
<div class="wrapper">
    <div class="sidebar" >

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
		
                <li class="active">
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
                    <a class="navbar-brand" href="#">Add a Store</a>
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
                                <h4 class="title">Add a Store</h4>
                            </div>
                            <div class="content">
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" placeholder="Enter store name" name="storename" required>
                                            </div>
                                        </div>
				    </div>
				    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
						<input type="button" class="btn btn-primary btn-fill" id="choose_mall" name="choose_mall" value="View Malls" onclick="showMalls()" required>

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
				    <div class="row" id="chkbox" style="display:none">
                                            <div class="form-group">
						<div class="col-md-12 columns">
						<?php
							global $db,$query,$res,$row;
							while($row = mysql_fetch_array($res)) 
							{
								echo "<span class='additional-info-wrap'>";
								echo "<label class='checkbox-inline'>";
								echo "<input type='checkbox' name='malls[]' id='choose_dom' value='".$row['MallName']."'>".$row['MallName'];
				        			echo "</label>";
								echo "<div class='additional-info hide'>";
								echo "<center><label style='color:black'>Select Floor</label>&nbsp;&nbsp;";
								echo "<select name='".str_replace(' ', '', $row['MallName'])."' id='".str_replace(' ', '', $row['MallName'])."'><option value='Select Floor'>Select floor</option>
						  </select></center></div></span>";                       
    							}
						?>
                                            </div>
                                        </div>
				    </div>
                                
                                    <!--div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Mall Name</label>
                                                <input id ="dom" class="form-control" name="name" readonly required></input>
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
 						 <select onchange='select()' class="selectpicker dropdown" data-style="btn btn-primary btn-fill" style="display:none"  data-selected-text-format="static" title="Select Mall" id="choose_dom" data-live-search="true">
						<?php
							global $db,$query,$res,$row; 
							while($row = mysql_fetch_array($res)) 
							{
								//echo "<h2>".$row['MallName']."</h2>";
				        			echo "<option value=".$row['MallName'].">".$row['MallName']."</option>";
    							}
						?>
						  </select>

                                            </div>
                                        </div>
				    </div-->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
						<label>Select logo image</label>
						<input type="file" class="btn btn-primary btn-fill " 						id="view" value="Select logo image" name="logo" accept="image/*"/>
                                            </div>
                                        </div>
				    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
						<label>Select cover image</label>
						<input type="file" class="btn btn-primary btn-fill " 						id="view" value="Select cover image" name="shopcover" accept="image/*"/>
                                            </div>
                                        </div>
				    </div>

					<br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Contact Number</label>
                                                <input type="text" class="form-control" placeholder="Contact number" id="ph" name="phno" required>
                                            </div>
                                        </div>
				    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea rows="5" class="form-control" placeholder="Store Description" name="desc"></textarea>
                                            </div>
                                        </div>
                                    </div>

				<!--div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
 						 <select onchange='storeSelect()' data-style="btn btn-primary btn-fill" id="choose_floor">
							<option value="Select Floor">Select floor</option>
						  </select>

                                            </div>
                                        </div>
				    </div-->

                                     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Beacon ID</label>
                                                <input type="text" class="form-control" placeholder="Beacon ID" id="priority" name="beacon">
                                            </div>
                                        </div>
				    </div>                                      
				    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Points associated (if any)</label>
                                                <input type="text" class="form-control" placeholder="Points associated" id="pts-asso" name="pts">
                                            </div>
                                        </div>
				    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Priority of Store</label>
                                                <input type="number" class="form-control" min="1" max="10" id="priority" name="prio">
                                            </div>
                                        </div>
				    </div>                               
					<div class='success' style='display:none'></div>
					<div class='error' style='display:none'></div>
					<?php 
						if ( $_SESSION['storeadded']=="success" )
						{
						     echo "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>";
						     echo "<script>$('.success').text('Data successfully added').fadeIn(400).delay(3000).fadeOut(400);</script>";
						     $_SESSION['storeadded'] = null;
						}
						else if ( $_SESSION['storeadded']=="nosuccess" )
						{
						     echo "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>";
						     echo "<script>$('.error').text('Some error occured.Please check your details.').fadeIn(400).delay(3000).fadeOut(400);</script>";
						     $_SESSION['storeadded'] = null;
						}
						$_SESSION['storeadded'] = null;
					?>

                                    <input type="submit" class="btn btn-primary btn-fill pull-right" value="Add Store">
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
    $('.additional-info-wrap input[type=checkbox]').click(function(){
        var  mallId= $(this).val();
	var floorId="#"+mallId.replace(' ','');
        if(mallId){
            $.ajax({
                type:'POST',
                url:'ajaxFloorData.php',
                data:'mallId='+mallId,
                success:function(data){
		    console.log("everything worked!");
                    $(floorId).html(data);
                }
            }); 
        }
    });
});
$(document).ready(function() {      $('.additional-info-wrap input[type=checkbox]').click(function() {         if($(this).is(':checked')) {             $(this).closest('.additional-info-wrap').find('.additional-info').removeClass('hide')         }         else {             $(this).closest('.additional-info-wrap').find('.additional-info').addClass('hide')       }     });      }); 

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
