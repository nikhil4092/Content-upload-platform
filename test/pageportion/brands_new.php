<div class="different_filters_divbox">                                           
	<ul class="different_filters">
		<?php	
		$brandsnewarray = $db->getBrands('BrandsAdmin');
		//echo "hi";		
		foreach($brandsnewarray as $brand) {
			$brandname = $brand['BrandName'];		
		?>		
		<li>
			<input type="checkbox" id="brand-<?=strtolower($brandname);?>" name="brcheck" class="brcheck" value="<?=$brand['BrandName']?>" checkboxname="<?=$brandname?>" />
			<label for="brand-<?=strtolower($brandname);?>"><?=$brandname?></label>
		</li>
		
		<?php
		}
		?>
		
	</ul>
</div>
