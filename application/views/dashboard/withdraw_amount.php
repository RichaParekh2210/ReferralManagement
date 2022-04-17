<a href="<?php echo base_url('account') ?>" class='btn btn-success'>Dashboard</a>
<div id="container">
	<h3 class="text-center text-primary">Withdraw amont</h3>
	<form action="<?php echo base_url('debitAmount'); ?>" method="POST" id="debit-form" class="form-wrapper">
		<div class="form-group">
			<input type="number" name="debit_amount" placeholder="Enter debit amount" class="form-control" required="" />
		</div>
		<div class="form-group">
			<input type="submit" name="debit_btn" value="Debit Amount" class="btn btn-primary debit-btn" class="form-control" />
		</div>
	</form>
</div>
</body>
</html>