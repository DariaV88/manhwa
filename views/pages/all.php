<?php 
/**
 * @var \App\Kernel\View\View $view
 * @var array <App\Models\Manhwa> $manhwa
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Kernel\Autn\AuthInterface $auth
 * @var \App\Models\Review $review
 */
?>
<?php $view->component('header') ?>
<div class="container">
	   <div class="content">

          <div style="margin-bottom: 30px;">
           <?php foreach($categories as $category) { ?>
                <a class="btn btn-primary" href="/category?id=<?php echo $category['id']?>"><?php echo $category['name']?></a>
            <?php } ?>
           </div>
      	   <div class="movie_top">

			<?php foreach($manhwas as $manhwa) { ?>
      	         <div class="col-md-9 movie_box">
                        <div class="grid images_3_of_2">
                        	<div class="movie_image">
                                <span class="movie_rating"><?php echo $manhwa->avgRating()?></span>
                                <img src="images/single.jpg" class="img-responsive" alt=""/>
                            </div>
                        </div>
                        <div class="desc1 span_3_of_2">
                        	<a href="/manhwa?id=<?php echo $manhwa->id()?>"><?php echo $manhwa->name()?></a>
                        	<p style="margin-top: 10px;" class="movie_option"><strong>Описание: </strong><?php echo $manhwa->description()?></p>
                         </div>
                        <div class="clearfix"> </div>
                        </div>
                      <div class="clearfix"> </div>
				  <?php } ?>
                  </div> 					           
           </div>
    </div>
    <?php $view->component('footer') ?>