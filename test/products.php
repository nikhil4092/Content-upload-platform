<?php
	session_start();
?>
<head>
<style>

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

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 50%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 16px 16px;
    background-color: #5cb85c;
    color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
    padding: 16px 16px;
    background-color: #5cb85c;
    color: white;
}

	.nextbut {
		border: 0 !important;  /*Removes border*/
		-webkit-appearance: none;  /*Removes default chrome and safari style*/
		-moz-appearance: none; /* Removes Default Firefox style*/
        appearance:none;
		background: #5cb85c no-repeat 100% center;
		width: 100px; /*Width of select dropdown to give space for arrow image*/
		height: 30px;
		text-indent: 0.01px; /* Removes default arrow from firefox*/
		text-overflow: "";  /*Removes default arrow from firefox*/ /*My custom style for fonts*/
		color: #FFF;
		padding: 5px;
		border-radius: 5px;
		box-shadow: inset 0 0 5px rgba(000,000,000, 0.5);
	}
</style>
</head>
<form method="post" action="dbopscoll.php" enctype="multipart/form-data">
<div id="loaderID" style="position:absolute; top:60%; left:53%; z-index:2; opacity:0"><img src="images/ajax-loader.gif" /></div>
<div id="productContainer">
<div class="card-columns" style="padding:20px">
<?php
/*$products = $db->allProducts();
if(count($products)>0) {
	foreach($products as $pro) {
		$productPhoto = $db->getproductPhoto($pro['ContentId']);*/
		?>
	<!------------------------------------------------------------------------------------------------------------------------------------------------->	
			<!--div class="divbox" onclick="tb_show('<?=$pro['Title']?>','product-details.php?id=<?=$pro['ContentId']?>&keepThis=true&TB_iframe=true&height=500&width=900','thickbox');"-->
			<!--div class="divbox">
        
        
        	<!--div style="width: 202px;height: 186px;background:url(../winkl_logo.png)" alt="<?=$pro['Content']?>">
                <div class="image-hover"></div>
            </div>

			<center><img src="../images/<?=$productPhoto?>" alt='Image preview' height='100' width='100'></center>
			<div class="product_name" align="center">
				<a href="#"><span class="productname">Content ID :<?=$pro['ContentId']?></span></a>
				<div class="price">
					<span class="product_name">Content :<?=$pro['Content']?></span>
					<br><br>
					<span class="product_price">Price Range : <br><a href="#">Rs. <?=$pro['MinRange']?>-Rs. <?=$pro['MaxRange']?></a></span><br>
<input type="checkbox" id="content" name="contents[]" class="content" value="<?=$pro['ContentId']?>"/> <br>
				</div>
			</div>
		</div-->
	
	<!------------------------------------------------------------------------------------------------------------------------------------------------->
		<?php
	//}
//}
?>
</div>
</div>
<label style="position:fixed; bottom:12%; left:93%;">Select All</label>
<input type='checkbox' name='select_all' id='select_all' style="position:fixed; bottom:12%; left:92%;" ></input>
<input type="button" class="nextbut" id="myBtn" value="Next" style="position:fixed; bottom:5%; left:92%;">
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times</span>
      <h2><center>Collection Details</center></h2>
    </div>
    <div class="modal-body">
                <label>Collection Name</label>
                <input type="text" class="form-control" placeholder="Enter collection name" name="collname" style="height:30px" required><br><br><br>
		<label>Upload collection image</label>
		<input type="file" class="btn btn-primary btn-fill " id="view" value="Upload collection image" name="collimg"/><br><br><br>
                <label>Description</label><br>
                <textarea rows="5" cols="82" placeholder="Description" name="desc"></textarea><br><br><br>
		<center><input type="submit" class="btn btn-primary btn-fill" value="Add Collection"></input></center>
    </div>
    <div class="modal-footer">
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>

<!--a href="#openModal" style="position:fixed; bottom:5%; left:60%;"><button name="but">Next</button></a>

<div id="openModal" class="modalDialog">
	<div>
		<a href="" title="Close" class="close">X</a>
		<br>
		<center>Collection Details</center>
		<br>
                <label>Collection Name</label>
                <input type="text" class="form-control" placeholder="Enter collection name" name="collname" required><br><br><br>
		<label>Upload collection image</label>
		<input type="file" class="btn btn-primary btn-fill " id="view" value="Upload collection image" name="collimg"/><br><br><br>
                <label>Description</label><br>
                <textarea rows="5" cols="82" placeholder="Description" name="desc"></textarea><br><br><br>
		<center><input type="submit" class="btn btn-primary btn-fill" value="Add Collection"></input></center>
	</div>
</div-->


<!--center><input type="submit" class="btn btn-primary btn-fill" style="position:fixed; bottom:5%; left:53%;" value="Add Collection"></input></center--> 
					<div class='success' style='display:none'></div>
					<div class='error' style='display:none'></div>
					<?php 
						if ( $_SESSION['collectionadded']=="success" )
						{
						     echo "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>";
						     echo "<script>$('.success').text('Collection successfully added').fadeIn(400).delay(3000).fadeOut(400);</script>";
						     $_SESSION['collectionadded'] = null;
						}
						else if ( $_SESSION['collectionadded']=="nosuccess" )
						{
						     echo "<script src='//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>";
						     echo "<script>$('.error').text('Some error occured.Please check your details.').fadeIn(400).delay(3000).fadeOut(400);</script>";
						     $_SESSION['collectionadded'] = null;
						}
						$_SESSION['collectionadded'] = null;
					?>

</form>

