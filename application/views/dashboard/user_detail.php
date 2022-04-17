<h2 class="text-center"><?= $title; ?></h2>
<table class='table table-border'>
	<?php if(!empty($user)){ ?>
	<tr>
		<th>Income</th>
		<th>Credit / Withdraw</th>
	</tr>
	<?php foreach($user as $data){ ?>
	<tr>
		<td><?= $data->income; ?></td>
		<td>
			<?php if($data->code == 'c'){ ?>
				<?= $data->credit_debit; ?>
			<?php } else { ?>
				- <?= $data->credit_debit; ?>
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
<p>Total Credit is: <span><b><?php echo $total_credit->total_credit; ?></b></span></p>
<p>Total Withdraw is: <span><b><?php echo $total_debit->total_debit; ?></b></span></p>
<p>Total: <span><b><?php echo $total_credit->total_credit - $total_debit->total_debit; ?></b></span></p>