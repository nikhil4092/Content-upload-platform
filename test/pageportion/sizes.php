<div class="different_filters_divbox">                                            
	<ul class="different_filters">
		<?php		
		$shoparray = $db->getStores('ShopMaster');		
		foreach($shoparray as $size) {
			$sizee = $size['ShopName'];		
		?>		
		<li>
			<input type="checkbox" id="size-<?=strtolower($sizee);?>" name="scheck" class="scheck" value="<?=$size['ShopName']?>"/>
			<label for="size-<?=strtolower($sizee);?>"><?=$sizee?></label>
		</li>
		
		<?php
		}
		?>
	</ul>
</div>
