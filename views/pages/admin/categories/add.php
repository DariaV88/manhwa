<?php 
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 */
?>
<?php $view->component('header-admin') ?>
<div class="container">
	      <div class="content">
      	     <div class="col-md-6 login-right">
		  	  <form method="POST" action="/admin/categories/add"> 
					<h3>Добавление категории</h3>
					<div>
						<span>Название</span>
						<input type="text" name="name">
						<?php if($session->has("name")) { ?>
								<ul>
									<?php foreach($session->getFlash("name") as $error) { ?>
								<li style="color:red"><?php echo $error?></li>
								<?php } ?>  
							    </ul>
							<?php } ?> 
					</div>

					<div class="register-but">
					   <input type="submit" value="добавить">
				</div>
				</form>
		   </div>
		   <div class="clearfix"> </div>
           </div>
</div>
