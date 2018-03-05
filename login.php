<?php 

	require_once 'core/init.php';
	
	Helper::getHeader('Algebra Auth | Sign In','main-header');
	
	if(Input::exists()){
			//var_dump(Input::get('username'));
    	}
//echo escape('<script> alert ("HAHHAHAHAHHHA"); </script>');

?>
    <div class="row">
			<div class="col-xs-12 col-xs-8 col-lg-6 call-md-offset-2 col-lg-offset-3">
				<div class="panel panel-primary">
					  <div class="panel-heading">
						<h3 class="panel-title">Sign In</h3>
					  </div>
					  <div class="panel-body">
							<form method="post">
							
								 <div class="form-group">
										<label for="username">Username</label>
										<input type="text" class="form-control" id="username"  name="username" placeholder="Username" autofocus>
								 </div>
								 <div class="form-group">
									<label for="password">Password</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
							     </div>
								
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Sign In</button>
							     </div>
								
								<p>If you don't have an account, please <a href="register.php">Register</a></p>
							
							</form>
						
					  </div>
					</div>
				
				
				</div>
			</div>
	</div>
	<?php
	Helper::getFooter('main-footer');
	?>