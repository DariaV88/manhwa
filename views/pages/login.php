<?php 
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>
<?php $view->component('header') ?>
<div class="container">
	      <div class="content">
      	     <div class="register">
			   <div class="col-md-6 login-left">
			  	 <h3>Новый пользователь</h3>
				 <p>Зарегестрировавшись вы сможете воспользоваться всеми преимуществами сайта.</p>
				 <a class="acount-btn" href="/register">Создать аккаунт</a>
			   </div>
			   <div class="col-md-6 login-right">
			   <form method="POST" action="/login"> 
			  	<h3>Зарегестрированный пользователь</h3>
				<p>Если у вас уже есть аккаунт, залогиньтесь.</p>
				<?php if($session->has("error")) { ?>
					<p style="color:red"><?php echo $session->getFlash("error")?> </p>
				<?php } ?> 
				  <div>
					<span>Email<label>*</label></span>
					<input type="text" name="email"> 
				  </div>
				  <div>
					<span>Почта<label>*</label></span>
					<input type="text" name="password"> 
				  </div>
				  <input type="submit" value="Login">
			    </form>
			   </div>	
			   <div class="clearfix"> </div>
		     </div>
           </div>
</div>
<?php $view->component('footer') ?>