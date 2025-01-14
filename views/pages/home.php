<?php 
/**
 * @var \App\Kernel\View\View $view
 * @var array <App\Models\Manhwa> $manhwa
 * @var array <App\Models\Category> $category
 * @var App\Kernel\Storage\StorageInterface $storage
 */
?>
<?php $view->component('header') ?>
<div class="container">
	<div class="slider">
	   <div style="max-height: 500px;">
	      <ul class="rslides" id="slider" style="max-height: 500px;">
	        <li><img src="/assets/images/banner0.jpg" class="img-responsive" alt="" />
	        	<div class="button">
			      <a href="/random" class="hvr-shutter-out-horizontal">открыть рандомный тайтл</a>
			    </div>
			</li>
			<!-- можно добавить другие слайды -->
	      </ul>
	    </div>
      </div>
      <div class="content">
      	<div class="box_1">
      	 <h2 class="m_2">Последние тайтлы</h2>
      	 <div class="search">
		    <form method="POST" action="/search">
				<input type="text" name="search" value="Поиск..." onfocus="this.value='';" onblur="if (this.value == '') {this.value ='';}">
				<input type="submit" value="">
		    </form>
		</div>
		<div class="clearfix"> </div>
		</div>
		<div>
		<?php foreach($manhwas as $manhwa) { ?>
			<div class="col-md-2 grid_6" style="margin-right: 35px;">
				<div class="col_2 col_3">
				   	    <ul class="list_4">
			    			<li>Рейтинг : <?php echo $manhwa->avgRating()?></p></li>
							<li><i class="icon2"> </i><p><?php echo $manhwa->sumRating()?></p></li>
			    			<div class="clearfix"> </div>
			    		</ul>
			    		<div class="m_8"><a href="/manhwa?id=<?php echo $manhwa->id()?>"><img src="/assets/images/pic10.jpg" class="img-responsive" alt=""/></a></div>
						<div class="caption1">
				    	<p class="m_3"><?php echo $manhwa->name()?></p>
				</div>
			    </div>
			</div>
		<?php } ?> 

			<div class="clearfix"> </div>
		</div>
		<a href="/all" class="btn btn-danger btn-lg" style="margin-top: 20px;">Все тайтлы</a>
      </div>
 </div>
 
<?php $view->component('footer') ?>