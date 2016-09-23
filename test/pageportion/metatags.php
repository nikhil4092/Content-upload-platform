<div class="different_filters_divbox">                                            
	<ul class="different_filters color-filter">
		<?php		
		$metaarray = $db->getMeta('AdminMetatags');		
		foreach($metaarray as $meta) {
			$metaarr = $meta['Tag'];		
		?>		
		<li>
			<input type="checkbox" id="meta-<?=strtolower($metaarr);?>" name="mcheck" class="mcheck" value="<?=$metaarr?>"/>
			<label for="meta-<?=strtolower($metaarr);?>"><?=$metaarr?></label>
		</li>
		
		<?php
		}
		?>
	</ul>
</div>
