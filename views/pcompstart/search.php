<?php
defined('PCOMPSTART') or die('Access denied');
?> 
<div class="conetnt-table">
  <?php if($result_search['notfound']) :?>
      <?php echo $result_search['notfound'];?>
  <?php else :?>
  <p class="search_kroh"><em>По Вашему запросу были найдены следующие результаты:</em></p>
   <?php for ($i = $start_pos; $i < $endpos; $i++) :?>
      <div class="key-content">
        <h3><a href="<?=PATH.$result_search[$i]['products_typeid'];?>/<?=$result_search[$i]['product_id'];?>-<?=$result_search[$i]['link_browser']?>"><?=$result_search[$i]['title'];?></a></h3>
        <img src="<?=PRODUCTIMG;?><?=$result_search[$i]['img_icon'];?>" alt="Иконка продукта"/> 
        <p><?=$result_search[$i]['anons'];?></p>
          <a class="read-more" href="<?=PATH.$result_search[$i]['products_typeid'];?>/<?=$result_search[$i]['product_id'];?>-<?=$result_search[$i]['link_browser']?>">Читать подробнее...</a>
        <div class="razdelitel-bot"></div>
      </div>
   <?php endfor;?>
   <?php if($pages_count > 1) pagination($page, $pages_count, $modrew=0); ?>
  <?php endif;?>
</div>
 