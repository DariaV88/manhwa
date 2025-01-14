<?php 
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var \App\Kernel\Session\SessionInterface $session
 * @var array <App\Models\Manhwa> $manhwa
 */
?>
<?php $view->component('header-admin') ?>
<div class="container">
	      <div class="content">
      	     <div class="col-md-6 login-right">
				<form method="POST" action="/admin/manhwas/update" enctype="multipart/form-data"> 
				<input type="hidden" name="id" value="<?php echo $manhwa->id()?>">
					<h3>Изменение</h3>
					<div>
						<span>Название</span>
						<input type="text" name="name" value="<?php echo $manhwa->name()?>">
						<?php if($session->has("name")) { ?>
								<ul>
									<?php foreach($session->getFlash("name") as $error) { ?>
								<li style="color:red"><?php echo $error?></li>
								<?php } ?>  
							    </ul>
							<?php } ?> 
					</div>

					<div>
						<span>Ссылка</span>
						<input type="text" name="link" value="<?php echo $manhwa->link()?>">
						<?php if($session->has("link")) { ?>
								<ul>
									<?php foreach($session->getFlash("link") as $error) { ?>
								<li style="color:red"><?php echo $error?></li>
								<?php } ?>  
							    </ul>
							<?php } ?> 
					</div>

					<div>
					<span>Описание</span>
					<textarea name="description" cols="75" rows="5"><?php echo $manhwa->description()?></textarea>
					<?php if($session->has("description")) { ?>
								<ul>
									<?php foreach($session->getFlash("description") as $error) { ?>
								<li style="color:red"><?php echo $error?></li>
								<?php } ?>  
							    </ul>
							<?php } ?> 
					</div>

					<div>
						<select name="category">
							<option selected>Жанр</option>
							<?php foreach($categories as $category) { ?>
								<option value="<?php echo $category["id"]?>" <?php echo $category["id"] == $manhwa->categoryId() ? 'selected' : ''?>><?php echo $category["name"]?></option>
							<?php } ?> 
						</select>
					</div>

					<div>
						 <span>Фото</span>
						 <input type="file" name="preview">
					 </div>

					<div class="register-but">
					   <input type="submit" value="сохранить">
				</div>
				</form>
		   </div>
		   <div class="clearfix"> </div>
           </div>
</div>
