<div class="container d-flex justify-content-between">
	<h1><?= $title; ?></h1>
	<a href="<?php echo base_url('logout'); ?>" class='btn btn-danger' style='height: 43px;'>Logout</a>
</div>
<p>Total Users: <span><?= $total_users->total_users ?></span></p>
<p>Total Investment: <span><?= $total_credit->total_credits - $total_debit->total_debits ?></span></p>
<p>Total Withdraw: <span><?= $total_debit->total_debits ?></span></p>
<table class="table">
	<tr>
		<th>User name</th>
		<th>View</th>
	</tr>
	<?php foreach($users as $data){ ?>
	<tr>
		<td><?= $data->fname." ".$data->lname ?></td>
		<td><a href="<?php echo base_url('view/'.$data->id)?>">View</a></td>
	</tr>
	<?php } ?>
</table>