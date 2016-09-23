<div class="different_filters_divbox">                                           
	<ul class="different_filters">
		<?php	
		$ternewarray = $db->getTer('CategoryAdminMaster');
		//echo "hi";		
		foreach($ternewarray as $ter) {
			$tername = $ter['TerType'];		
		?>		
		<li>
			<input type="checkbox" id="ter-<?=strtolower($tername);?>" name="tercheck" class="tercheck" value="<?=$ter['TerType']?>" checkboxname="<?=$tername?>" />
			<label for="ter-<?=strtolower($tername);?>"><?=$tername?></label>
		</li>
		
		<?php
		}
		?>
		
	</ul>
</div>
