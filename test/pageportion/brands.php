<div class="different_filters_divbox">                                           
	<ul class="different_filters">
		<?php	
		$mallarray = $db->getResults('MallMaster');
		//echo "hi";		
		foreach($mallarray as $brand) {
			$brandname = $brand['MallName'];		
		?>		
		<li>
			<input type="checkbox" id="brand-<?=strtolower($brandname);?>" name="bcheck" class="bcheck" value="<?=$brand['MallId']?>" checkboxname="<?=$brandname?>" />
			<label for="brand-<?=strtolower($brandname);?>"><?=$brandname?></label>
		</li>
		
		<?php
		}
		?>
		
	</ul>
</div>
