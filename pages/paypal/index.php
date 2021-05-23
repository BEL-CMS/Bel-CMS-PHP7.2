			<form id="BlocPayPalJS" style="display:block" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" onsubmit="return VerifMontantBloc();">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="stivedeterme@msn.com">
				<input type="hidden" name="item_name" value="don pour: palacewar.eu">
				<input type="hidden" name="currency_code" value="EUR">
				<input type="hidden" name="tax" value="0">
				<input type="hidden" name="notify_url"  value="https://palacewar.eu/Paypal/mysql">
				<input type="hidden" name="return" value="https://palacewar.eu">
				<div class="input-group">
					<input type="text" class="form-control" name="amount" placeholder="Montant en euros">
					<span class="input-group-append">
						<button class="btn btn-primary" alt="Aller vers Paypal" type="submit">GO <i class="fab fa-paypal"></i></button>
					</span>
				</div>					
			</form>
<script type="text/javascript">
	document.getElementById("BlocPayPalNoJS").style.display = "none";
	document.getElementById("BlocPayPalJS").style.display = "block";
	function VerifMontantBloc() {
		var ElId = document.getElementById("BlocAmount").value;
		var reg = new RegExp("^[0-9]+$");
		var test = reg.test(ElId);
		if(!test) { 
			alert(<?=_ALERT1;?>); 
				return false;
			}
		else {
			if(ElId==0) {
				alert(<?=_ALERT2;?>);
				return false;
			} else {
			return true;
			}
		}
</script>