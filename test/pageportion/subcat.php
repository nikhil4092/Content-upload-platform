<div class="different_filters_divbox">                                           
	<ul class="different_filters">
		<?php	
		$subnewarray = $db->getSub('CategoryAdminMaster');
		//echo "hi";		
		foreach($subnewarray as $sub) {
			$subname = $sub['SubType'];		
		?>		
		<li>
			<input type="checkbox" id="sub-<?=strtolower($subname);?>" name="subcheck" class="subcheck" value="<?=$sub['SubType']?>" checkboxname="<?=$subname?>" />
			<label for="sub-<?=strtolower($subname);?>"><?=$subname?></label>
		</li>
		
		<?php
		}
		?>
		
	</ul>
</div>
