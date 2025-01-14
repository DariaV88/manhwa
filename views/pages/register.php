<?php 
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>
<?php $view->component('header') ?>
<div class="container">
	      <div class="content">
      	     <div class="col-md-6 login-right">
		  	  <form method="POST" action="/register"> 
					<h3>Регистрация</h3>

					<div>
						<span>Имя<label>*</label></span>
						<input type="text" name="name">
						<?php if($session->has("name")) { ?>
								<ul>
									<?php foreach($session->getFlash("name") as $error) { ?>
								<li style="color:red"><?php echo $error?></li>
								<?php } ?>  
							    </ul>
							<?php } ?> 
					</div>

					 <div>
						 <span>Email<label>*</label></span>
						 <input type="text" name="email"> 
						 <?php if($session->has("email")) { ?>
						    <ul>
							<?php foreach($session->getFlash("email") as $error) { ?>
								<li style="color:red"><?php echo $error?></li>
								<?php } ?>  
							</ul>
					      <?php } ?> 
					  </div>

					<div>
						<span>Пароль<label>*</label></span>
						<input type="text" name="password">
						<?php if($session->has("password")) { ?>
								<ul>
									<?php foreach($session->getFlash("password") as $error) { ?>
								<li style="color:red"><?php echo $error?></li>
								<?php } ?>  
							    </ul>
							<?php } ?> 
					</div>

					<div>
						<span>Подтверждение пароля<label>*</label></span>
						<input type="text" name="password_confirmation">
						<?php if($session->has("password_confirmation")) { ?>
								<ul>
									<?php foreach($session->getFlash("password_confirmation") as $error) { ?>
								<li style="color:red"><?php echo $error?></li>
								<?php } ?>  
							    </ul>
							<?php } ?> 
					</div>

					<div class="register-but">
					   <input type="submit" value="зарегестрироваться">
				</div>
				</form>
		   </div>
		   <div class="clearfix"> </div>
           </div>
</div>
<?php $view->component('footer') ?>