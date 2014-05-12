<?php 
if(get_language() == "nl"){
?>
<div>
	<p>
		<h2 style="color:red">
		Weet je het zeker? Niet akkoord gaan leidt tot de-activatie van je account,
		dit kan alleen ongedaan gemaakt worden door de beheerder!
		</h2>
	</p>
	
	<p>
		<a href="<?php echo elgg_add_action_tokens_to_url($vars["url"] . "action/accept_terms/deactivate"); ?>" class="elgg-modifications-accept-terms-confirm-deactivate"></a>
		<a href="<?php echo $vars["url"]?>pg/accept_terms" class="elgg-modifications-accept-terms-confirm-cancel"></a>
		
		<div class="clearfloat"></div>
	</p>
</div>
<?php } else { ?>
<div>
	<p>
		<h2 style="color:red">
		Are you sure? Disagreement results in de-activation of your account,
		which can only be restored by the administrator!
		</h2>
	</p>
	<p>
		<a href="<?php echo elgg_add_action_tokens_to_url($vars["url"] . "action/accept_terms/deactivate"); ?>" class="elgg-modifications-accept-terms-en-confirm-deactivate"></a>
		<a href="<?php echo $vars["url"]?>pg/accept_terms" class="elgg-modifications-accept-terms-en-confirm-cancel"></a>
		
		<div class="clearfloat"></div>
	</p>
</div>
<?php 
}