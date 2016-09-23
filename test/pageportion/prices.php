<?php
	$getmaxprice = $db->getPrice('ContentAdminMaster');
		foreach($getmaxprice as $price) {
			echo $price["content"];
			$prices = $price['maxi'];	
			
		}
		?>	
<head>
 <link href="../../assets/jquery/jquery-ui.css" rel="stylesheet">
</head>
<div class="different_filters_divbox">                                            
	<ul class="different_filters" id="sliderpart">
			
		<li>
			<div id="slider"></div>
		</li>
		<li >
			<input type="text" name="min" id="minval" value="Rs.0" style="text-align:right;width:200px" data-index="0" class='sliderValue'>
			<input type="text" name="max" id="maxval" value="Rs.<?=$prices;?>" style="text-align:right;width:200px" data-index="1" class='sliderValue'>
		</li>
				
	</ul>
</div>
	<script src="../../assets/jquery/jquery.js"></script>
	<script src="../../assets/jquery/jquery-ui.js"></script>
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
      max: <?php echo json_encode($prices); ?>,
      values: [ 0, <?php echo json_encode($prices); ?> ],
      slide: function( event, ui ) {
        $( "#minval" ).val( "Rs." + ui.values[ 0 ]);
	$( "#maxval" ).val( "Rs." + ui.values[ 1 ]);

      }
});

$("input.sliderValue").change(function() {
    $("#slider").slider({values:[ $( "#minval" ).val().substring(3), $( "#maxval" ).val().substring(3)]})
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
