<?php  
    if(!empty($success_msg)){ 
        echo '<p class="status-msg success text-success">'.$success_msg.'</p>'; 
    }elseif(!empty($error_msg)){ 
        echo '<p class="status-msg error">'.$error_msg.'</p>'; 
    } 
?>
<p>Admin: admin@gmail.com Password:123</p>
<div id="container">
	<h3 class="text-center text-primary">Login</h3>
	<?php if($this->session->flashdata('login_error')){ ?>
		<p class="text-danger"><?php echo $this->session->flashdata('login_error'); ?></p>
	<?php } ?>
	<form action="<?php echo base_url().'login'?>" method="POST" id="register-form" class="form-wrapper">
		<div class="form-group">
			<input type="text" name="email" placeholder="Email" class="form-control" />
			<p class="error-msg text-danger" id="error_email">Please enter email</p>	
		</div>
		<div class="form-group">
			<input type="password" name="password" placeholder="Password" class="form-control" />
			<p class="error-msg text-danger" id="error_password">Please enter password</p>	
		</div>
		<div class="form-group">
			<input type="submit" name="login" value="Login" class="btn btn-primary login-btn" class="form-control" />
		</div>
	</form>
	<p>Not yet register? <a href="<?php echo base_url().'register'?>">Register</a></p>
</div>
<style type="text/css">
#blog-form .form-group,#register-form .form-group{
	margin-bottom: 10px !important;
}
</style>
</body>
</html>