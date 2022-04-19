<div class="container d-flex justify-content-between">
	<h1><?= $title; ?></h1>
	<a href="<?php echo base_url('logout'); ?>" class='btn btn-danger' style='height: 43px;'>Logout</a>
</div>
<div>
	<p>User Reference Code:<span><b><?php echo $user_data->user_referral_code ?></b></span></p>
</div>
<a href='<?php echo base_url('addIncome') ?>' class="btn btn-info add_income">Add Investment</a>

<?php if(!empty($userData)){   ?>
<a href="<?php echo base_url('debitAmount'); ?>" class='btn btn-primary'>Withdraw</a>
<table class='table table-border'>
	<?php if(!empty($userData)){ ?>
	<tr>
		<th>Income</th>
		<th>Credit / Withdraw</th>
	</tr>
	<?php foreach($userData as $data){ ?>
	<tr>
		<td><?= $data['income']; ?></td>
		<td>
			<?php if($data['code'] == 'c'){ ?>
				<?= $data['credit_debit']; ?>
			<?php } else { ?>
				- <?= $data['credit_debit']; ?>
			<?php } ?>
		</td>
	</tr>
	<?php } }else{ ?>
		<tr>
			<td>NO data found</td>
			<td></td>
		</tr>
	<?php } ?>
</table>
<?php } ?>
<p>Total Credit is: <span><b><?php echo $total_credit->total_credit; ?></b></span></p>
<p>Total Withdraw is: <span><b><?php echo $total_debit->total_debit; ?></b></span></p>
<p>Total: <span><b><?php echo $total_credit->total_credit - $total_debit->total_debit; ?></b></span></p>