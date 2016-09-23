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
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="/assets/css/animate.min.css" rel="stylesheet"/>
    
    <link href="/assets/css/bootstrap-select.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <link href="/assets/css/bootstrap-select.min.css" rel="stylesheet"/>
    
    <link rel="stylesheet" href="/assets/css/bootstrap-tagsinput.css">

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />

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

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDX6KwLneM9t0KrPiGd0KbhgA2yfXUi_6U &libraries=places"></script>
<script>
	i=0;
	google.maps.event.addDomListener(window, 'load', initialize);
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
		$(document).ready(function(){$('#dom').tagsinput('removeAll')});
		dom=document.getElementById("dom");
 		el = document.getElementsByTagName('select')[0];
		dom.innerHTML=getSelectValues(el);
		$(document).ready(function(){$('#dom').on('itemRemoved', function(event) 
		{
			var foo = event.item;
			$('#choose_dom').find('[value="'+foo+'"]').prop('selected', false);
			$('#choose_dom').selectpicker('refresh');
		});});
		tags();
		
	}
	function tags()
	{	
		domlist=dom.innerHTML.split(",");
		if(domlist.length==1)
		{
			$(document).ready(function(){$('#dom').tagsinput('add',dom.innerHTML)});
		}
		
		for(var i=0;i<domlist.length;i++)
		{
			$(document).ready(function(){$('#dom').tagsinput('add',domlist[i])});	
		}

		
	}

	function createRow()
	{
		row=document.createElement('tr');
		var cell=document.createElement('td');
		var inputType=document.createElement('input');
		inputType.type='text';
		inputType.className="form-control";
		inputType.name='level[]';
		inputType.placeholder="Level";
		inputType.required=true;
		cell.appendChild(inputType);
		row.appendChild(cell);
		var cell=document.createElement('td');
		var inputType=document.createElement('input');
		inputType.type='text';
		inputType.className="form-control";
		inputType.name='levelName[]';
		inputType.placeholder="Name";
		inputType.required=true;
		cell.style.padding="10px";
		cell.appendChild(inputType);
		row.appendChild(cell);		
		var cell=document.createElement('td');
		checkBox=document.createElement('input');
		checkBox.type='image';
		checkBox.id='select'+i++;
		checkBox.src='x.png';
		cell.style.padding="2px";
		cell.appendChild(checkBox);
		row.appendChild(cell);
		table=document.getElementById('members');
		table.appendChild(row);
		checkBox.addEventListener("click",removeRows,false);
	}
	function removeRows()
	{
		    l=document.getElementById(this.id);
		    r=l.parentNode.parentNode;
		    table.removeChild(r);
	}

 function initialize() {
        var address = (document.getElementById('name'));
        var autocomplete = new google.maps.places.Autocomplete(address);
        autocomplete.setTypes(['geocode']);
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                return;
            }

        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
        }
      });
}
function codeAddress() 
{
	    x = document.getElementById("lat");
	    y = document.getElementById("long");
	    geocoder = new google.maps.Geocoder();
	    var area = document.getElementById("area").value;
	    var city = document.getElementById("city").value;
	    var state = document.getElementById("state").value;
	    var ctry = document.getElementById("ctry").value;
	    var address = document.getElementById("name").value.split(",");
		address=address+","+city+","+state+","+ctry;		
	   
	    geocoder.geocode( { 'address': address}, function(results, status) {
	      if (status == google.maps.GeocoderStatus.OK) {
		 x.value=results[0].geometry.location.lat();
		 y.value=results[0].geometry.location.lng();
	      //alert("Latitude: "+results[0].geometry.location.lat());
	      //alert("Longitude: "+results[0].geometry.location.lng());
	      } 

	      else {
		alert("Geocode was not successful for the following reason: " + status);
	      }
	    });
}


</script>
<body onload='init()'>
<form id="form" name="form" method="post" action="dbops.php" enctype="multipart/form-data">
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
                <li class="active">
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
				  <li >
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
                    <a class="navbar-brand" href="#">Add Mall</a>
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
                                <h4 class="title">Add Mall</h4>
                            </div>
                            <div class="content">
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" id="name" class="form-control" placeholder="Enter mall name" name="name" required>


                                            </div>
                                        </div>
				    </div>
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Area</label><br>
						<input type="text" class="form-control" placeholder="Enter area" name="area" id="area" required>
                                        </div>
				    </div>
				</div>
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Pin</label><br>
						<input type="text" class="form-control" placeholder="Enter pin" name="pin" required>
                                        </div>
				    </div>
				</div>
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>City</label><br>
						<input type="text" class="form-control" placeholder="Enter city" name="city" id="city" required>
                                        </div>
				    </div>
				</div>
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>State</label><br>
						<input type="text" class="form-control" placeholder="Enter state" name="state" id="state" required>
                                        </div>
				    </div>
				</div>
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Country</label><br>
						<input type="text" class="form-control" placeholder="Enter country" name="ctry" id="ctry" required>
                                        </div>
				    </div>
				</div>
			   <table id='members' style="width:102%">
				<tr>
					<th style="width:48%"><label>Floor Level</label></th>
					<th style="padding:10px;width:48%"> <label>Floor Name</label></th>
				</tr>

			  </table>
				     <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="button"  class="btn btn-info btn-fill1 pull-left" onclick='createRow()'>Add Level +</button>
                                            </div>
                                        </div>
                                    </div>
				    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Winks</label><br>
						<input type="text" class="form-control" placeholder="Enter winks" name="winks" required>
                                        </div>
				    </div>
				</div>

					<br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
						<input type="button" class="btn btn-primary btn-fill " 						id="getloc" value="Get Location" onclick="codeAddress()"/>
                                            </div>
                                        </div>
				    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Latitude</label>
                                                <input type="text" class="form-control" placeholder="Latitude" id="lat" name="lat" readonly>
                                            </div>
                                        </div>
				    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Longitude</label>
                                                <input type="text" class="form-control" placeholder="Longitude" id="long" name="long" readonly>
                                            </div>
                                        </div>
				    </div>

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
						<input type="file" class="btn btn-primary btn-fill " 						id="view1" value="Select cover image" name="coverimg" accept="image/*"/>
                                            </div>
                                        </div>
				    </div>    
					<div class='success' style='display:none'></div>
					<div class='error' style='display:none'></div>
					<?php 
						if ( $_SESSION['malladded']=="success" )
						{
						     echo "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>";
						     echo "<script>$('.success').text('Data successfully added').fadeIn(400).delay(3000).fadeOut(400);</script>";
						     $_SESSION['malladded'] = null;
						}
						else if ( $_SESSION['malladded']=="nosuccess" )
						{
						     echo "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>";
						     echo "<script>$('.error').text('Some error occured.Please check your details.').fadeIn(400).delay(3000).fadeOut(400);</script>";
    						     $_SESSION['malladded'] = null;
						}
						$_SESSION['malladded'] = null;
					?>                             
                                    <input type="submit" class="btn btn-primary btn-fill pull-right" value="Add Mall">
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
</body>

	    		<!--   Core JS Files   -->
<script src="/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>

		<!--  Checkbox, Radio & Switch Plugins -->
<script src="/assets/js/bootstrap-checkbox-radio-switch.js"></script>
<script src="/assets/js/bootstrap-select.js" type="text/javascript"></script>
<script src="/assets/js/bootstrap-select.min.js" type="text/javascript"></script>

	    <!--  Notifications Plugin    -->
<script src="/assets/js/bootstrap-notify.js"></script>
<script src="/assets/js/bootstrap-tagsinput.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="/assets/js/light-bootstrap-dashboard.js"></script>
<script type="text/javascript" src="/assets/js/WebContent/zip.js"></script>
<script type="text/javascript" src="/assets/js/WebContent/rar.js"></script>	

</html>
