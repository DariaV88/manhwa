<?php 
/**
 * @var \App\Kernel\View\View $view
 * @var array <App\Models\Manhwa> $manhwa
 * @var array <App\Models\Category> $category
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Kernel\Autn\AuthInterface $auth
 * @var \App\Models\Review $review
 */
?>
<?php $view->component('header') ?>
<div class="container">
	   <div class="content">
      	   <div class="movie_top">
      	         <div class="col-md-9 movie_box">
                        <div class="grid images_3_of_2">
                        	<div class="movie_image">
                                <span class="movie_rating"><?php echo $manhwa->avgRating()?></span>
                                <img src="images/single.jpg" class="img-responsive" alt=""/>
                            </div>
                            
                        </div>
                        <div class="desc1 span_3_of_2">
                        	<p class="movie_option"><strong>Название: <?php echo $manhwa->name()?></strong></p>
                        	<p class="movie_option"><strong>Категория: </strong><a href="#"><?php echo $category->name()?></a></p>
                        	<!-- <p class="movie_option"><strong>Release date: </strong>December 12, 2014</p> -->
							<a href="<?php echo $manhwa->link()?>">Читать на оф. сайте</a>
                         </div>
                        <div class="clearfix"> </div>
                        <p class="m_4"><?php echo $manhwa->description()?></p>
						<?php if ($auth->check()) { ?>
							    
		                <form method="post" action="/reviews/add" class="sky-form">
							<input type="hidden" value="<?php echo $manhwa->id()?>" name="id">

							<select name="rating">
                                    <option selected>Оценка</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                            </select>

							<div class="text">
			                   <textarea name="review" value="Сообщение:" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Сообщение';}">Сообщение:</textarea>
			                </div>
			                <div class="form-submit1">
					           <input type="submit" id="submit" value="Оставить комментарий"><br>
					        </div>
							<div class="clearfix"></div>
                 		</form>
						 <?php } else {?>
						 <div class="alert alert-warning">
							Оставлять комментарии могут только зарегестрированные пользователи.
						 </div>
						 <?php } ?>
		                <div class="single">
		                <h1>Комментарии: <?php echo $manhwa->sumRating()?></h1>
		                <ul class="single_list">
						<?php foreach($manhwa->reviews() as $review) {?>
					        <li>
					            <div class="preview"><a href="#"><img src="images/2.jpg" class="img-responsive" alt=""></a></div>
					            <div class="data">
					                <div class="title"><?php echo $review->user()->name()?></div>
					                <p><?php echo $review->comment()?></p>
					            </div>
					            <div class="clearfix"></div>
					        </li>
							<?php }?>
			  			</ul>
                      </div>
                      </div>
                      <div class="clearfix"> </div>
                  </div>
           </div>
    </div>
    <?php $view->component('footer') ?>