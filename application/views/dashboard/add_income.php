<a href="<?php echo base_url('account') ?>" class='btn btn-success'>Dashboard</a>
<div id="container">
	<h3 class="text-center text-primary">Add Income</h3>
	<form action="<?php echo base_url('addIncome'); ?>" method="POST" id="addIncome-form" class="form-wrapper">
		<div class="form-group">
			<input type="number" name="income" placeholder="Your Income" class="form-control" required="" />
		</div>
		<div class="form-group">
			<input type="submit" name="income_btn" value="Add Amount" class="btn btn-primary income-btn" class="form-control" />
		</div>
	</form>
</div>
</body>
</html>