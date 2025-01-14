<?php 
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var array <App\src\Models\Category> $categories
 * @var array <App\src\Models\Manhwa> $manhwas
 */
?>
<?php $view->component('header-admin') ?>
<div class="container">
<div class="content">
    <h2>Фильмы</h2>
<div class="down_btn" style="margin-bottom: 30px; margin-left: 15px; "><a class="btn1" href="/admin/manhwas/add"><span> </span>Добавить</a></div>
      	   <div class="movie_top">
            <?php foreach($manhwas as $manhwa) { ?>
                <div class="col-md-9 movie_box">
                        <div class="grid images_3_of_2">
                        	
                        </div>
                        <div class="desc1 span_3_of_2">
                        	<p class="movie_option"><strong>Тайтл: <?php echo $manhwa->name() ?> </strong></p>
                         </div>
                         <a href="/admin/manhwas/update?id=<?php echo $manhwa->id() ?>">Изменить</a>
                  <form action="/admin/manhwas/delete" method="post">
                    <input type="hidden" value="<?php echo $manhwa->id() ?>" name="id">
                    <button>Удалить</button>
                </form>
                  </div>
                  <div>
                  </div>
      	         
            <?php } ?> 
                  <div class="clearfix"> </div>
           </div>

           <h2>Жанры</h2>
<div class="down_btn" style="margin-bottom: 30px; margin-left: 15px; "><a class="btn1" href="/admin/categories/add"><span> </span>Добавить</a></div>
<ul>
<?php foreach($categories as $category) { ?>
        <li><?php echo $category['name'] ?></li>
        <a href="/admin/categories/update?id=<?php echo $category['id'] ?>">Изменить</a>
        <form action="/admin/categories/delete" method="post">
        <input type="hidden" value="<?php echo $category['id'] ?>" name="id">
            <button>Удалить</button>
        </form>
<?php } ?>
</ul>
<div class="clearfix"> </div>
           </div>
