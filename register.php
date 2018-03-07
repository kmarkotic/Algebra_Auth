<?php 

	require_once 'core/init.php';
	
	Helper::getHeader('Algebra Auth | Create an account','main-header');
	
	$user =new User();
	
	$validate = new Validation();
	
	
	
	if(Input::exists()){    //da li imamo post u superglobalnoj varijabli
		if(Token::check(Input::get('token'))){
				$validation = $validate->check(array(
					'name' 	=>  	array(
							'required' => true,
							'min' 	=>	2,
							'max'	=>	255
					),
					'username' => 	array(
							'required' => true,
							'min' 	=>	2,
							'max'	=>	255,
							'unique' => 'user'
					),
					'password' =>	array(
							'required' => true,
							'min' 	=>	8
					),
					'confirm_password' => 	array(
							'required' => true,
							'matches' 	=>	'password'
					)
				
				));
				
				if($validation ->getPassed()){
					
					$salt= Hash::salt(32);
					$password=Hash::make(Input::get('password'),$salt);
					
					try{
						$user->create(array(
						'username' => Input::get('username'),
						'password' => $password,
						'salt' => $salt,
						'name' => Input::get('name')
						));
						
						
					}catch(Exception $e){
						
					}
					
					
					//var_dump($password);
					//die();
					
					header('Location:login.php');
				}
				//echo '<pre>';
				//var_dump($validation);
				//echo '</pre>';
				
			//echo 'jesu';
			//die();
			//var_dump(Input::get('username'));
    	}
			//echo 'nisu';
	}	
//echo escape('<script> alert ("HAHHAHAHAHHHA"); </script>');

?>
    <div class="row">
			<div class="col-xs-12 col-xs-8 col-lg-6 call-md-offset-2 col-lg-offset-3">
				<div class="panel panel-primary">
					  <div class="panel-heading">
						<h3 class="panel-title">Create an account</h3>
					  </div>
					  <div class="panel-body">

							<form method="post">
								<input type="hidden" name="token" value="<?php echo Token::generate()?>">
								<div class="form-group <?php echo ($validate->hasError('name')) ? 'has-error' : '' ?>">
											<label for="name">Name*</label>
											<input type="text" class="form-control" id="name"  name="name" placeholder="Name" autofocus>
											<?php echo ($validate->hasError('name')) ? '<p class="text-danger">'.$validate->hasError('name').'</p>' : '' ?>
									 </div>
									 
								 <div class="form-group <?php echo ($validate->hasError('username')) ? 'has-error' : '' ?>">
										<label for="username">Username*</label>
										<input type="text" class="form-control" id="username"  name="username" placeholder="Username">
										<?php echo ($validate->hasError('username')) ? '<p class="text-danger">'.$validate->hasError('username').'</p>' : '' ?>
								 </div>
								 
								 <div class="form-group <?php echo ($validate->hasError('password')) ? 'has-error' : '' ?>">
									<label for="password">Password*</label>
									<input type="password" class="form-control" id="password" name="password" placeholder="Password">
									<?php echo ($validate->hasError('password')) ? '<p class="text-danger">'.$validate->hasError('password').'</p>' : '' ?>
							     </div>
								 
								 <div class="form-group <?php echo ($validate->hasError('confirm_password')) ? 'has-error' : '' ?>">
									<label for="confirm_password">Confirm Password*</label>
									<input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
									<?php echo ($validate->hasError('confirm_password')) ? '<p class="text-danger">'.$validate->hasError('confirm_password').'</p>' : '' ?>
							     </div>
								
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Create</button>
							     </div>
								
								<p>If you have an account, please <a href="login.php">Sign In</a></p>
							
							</form>
						
					  </div>
					</div>
				
				
				</div>
			</div>
	</div>
	<?php
	Helper::getFooter('main-footer');
	?>