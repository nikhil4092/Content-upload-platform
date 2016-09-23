<style>
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
<div class="different_filters_divbox">                                            
	<ul class="different_filters color-filter">
		<?php		
		$colorarray = $db->getColors();		
		foreach($colorarray as $color) {
		?>		
		<li>
			<label class="control control--checkbox">
			<input type="checkbox" id="color-<?=strtolower($color);?>" name="ccheck" class="ccheck" value="<?=$color?>"/>
			<label for="color-<?=strtolower($color);?>"><?=$color?></label>
			<div class="control__indicator" style="background:<?php echo $color;?>"></div>
			</label>
		</li>
		
		<?php
		}
		?>
	</ul>
</div>
