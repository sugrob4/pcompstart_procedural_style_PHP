<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div id="sitemap">
  <h1>Карта сайта</h1>
  <ul>
    <li><a href="<?=PATH;?>">Главная</a></li>
    <?php if($cheifinformers) :?>
    <?php for ($i = 1; $i <count($cheifinformers) ; $i ++) :?>
        <li class="last_menu"><a href="<?=PATH.$cheifinformers[$i]['link_browser']?>" target="_blank"><?=$cheifinformers[$i]['title'];?></a></li>
    <?php endfor;?>
    <?php endif;?>
  </ul>
  <ul>
  <?php foreach ($sitemap as $key => $item) : ?>
      <li class="sections"><a href="<?=PATH.$item[0][0];?>" target="_blank"><?=$item[0][1];?></a>
      <?php foreach ($item['sub'] as $k => $v) :?>
        <ul>
          <li><a href="<?=PATH.$item[0][0];?>/<?=$v['product_id'];?>-<?=$v['link_browser']?>" target="_blank"><?=$v['title'];?></a></li>
        </ul>
        <?php endforeach;?>
      </li>
     <?php endforeach; ?>
  </ul>
</div>
