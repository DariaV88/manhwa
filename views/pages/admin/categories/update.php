<?php 
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var \App\Models\Category $category
 */
?>
<?php $view->component('header-admin') ?>
<div class="container">
	      <div class="content">
      	     <div class="col-md-6 login-right">
		  	  <form method="POST" action="/admin/categories/update"> 
				<input type="hidden" name="id" value="<?php echo $category->id() ?>">
					<h3>Обновление категории</h3>
					<div>
						<span>Название</span>
						<input type="text" name="name" value="<?php echo $category->name() ?>">
						<?php if($session->has("name")) { ?>
								<ul>
									<?php foreach($session->getFlash("name") as $error) { ?>
								<li style="color:red"><?php echo $error?></li>
								<?php } ?>  
							    </ul>
							<?php } ?> 
					</div>

					<div class="register-but">
					   <input type="submit" value="обновить">
				</div>
				</form>
		   </div>
		   <div class="clearfix"> </div>
           </div>
</div>
