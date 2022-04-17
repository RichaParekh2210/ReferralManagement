$(document).ready(function(){
	$('.error-msg').hide();
	$('.register-btn').click(function(){
		var fname = $('input[name="fname"]').val();
		var lname = $('input[name="lname"]').val();
		var email = $('input[name="email"]').val();
		var password = $('input[name="password"]').val();
		var confirm_password = $('input[name="confirm_password"]').val();
		var ref_code = $('input[name="ref_code"]').val();
		var error = 0;
		if(fname == ''){
			$('#error_fname').show();
			error = 0;
		}else if(lname == ''){
			$('#error_lname').show();
			error = 0;
		}else if(email == '' || email.indexOf('@') == -1 || email.indexOf('.') == -1 ){
			$('#error_email').show();
			error = 0;
		}else if(password == ''){
			$('#error_password').show();
			error = 0;
		}else if(confirm_password == ''){
			$('#error_confirm_password').html('Please enter confirm password');
			$('#error_confirm_password').show();
			error = 0;
		}else if(confirm_password != password){
			$('#error_confirm_password').html('Confirm password must be same as password');
			$('#error_confirm_password').show();
			error = 0;
		}else if(ref_code == ''){
			$('#error_ref_code').html('Please enter referral code');
			$('#error_ref_code').show();
			error = 0;
		}else{
			error = 1;
		}

		if (error == 0) {
			return false;
		}else{
			return true;
		}
	});

	$('.login-btn').click(function(){
		var email = $('input[name="email"]').val();
		var password = $('input[name="password"]').val();
		var error = 0;
		if(email == '' || email.indexOf('@') == -1 || email.indexOf('.') == -1 ){
			$('#error_email').show();
			error = 0;
		}else if(password == ''){
			$('#error_password').show();
			error = 0;
		}else{
			error = 1;
		}

		if (error == 0) {
			return false;
		}else{
			return true;
		}
	});

	$('.add-blog-btn').click(function(){
		var title = $('input[name="title"]').val();
		var desc = $('input[name="desc"]').val();
		var tags = $('input[name="tags"]').val();
		var blog_img = $('input[name="blog_img"]').val();
		var error = 0;
		if(title == ''){
			$('#error_title').show();
			error = 0;
		}else if(desc == ''){
			$('#error_desc').show();
			error = 0;
		}else if(tags == ''){
			$('#error_tags').show();
			error = 0;
		}else if(blog_img == ''){
			$('#error_img').show();
			error = 0;
		}else{
			error = 1;
		}

		if (error == 0) {
			return false;
		}else{
			return true;
		}
	});

	$('#blog-list').dataTable();

	$('#addTags').click(function() {
		var html='';
		html += '<div id="tagsFormRow">';
		html += '<div class="input-group">';
		html += '<input type="text" name="tags[]" placeholder="Tags" class="form-control" />';
		html += '<div class="input-group-append">';
		html += '<button type="button" class="btn btn-danger" id="removeTags">Remove</button>';
		html += '</div>';
		html += '</div>';
		html += '</div>';

		$('#newTag').append(html);
	});

	 $(document).on('click', '#removeTags', function () {
		$(this).closest('#tagsFormRow').remove();
	});
});