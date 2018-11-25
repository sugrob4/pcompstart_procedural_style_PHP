<?php
defined('PCOMPSTART') or die('Access denied');
?>

<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?=PATH;?>"
  },
  "articleSection": "<?=$brand_name[0]['type_name']?>",
  <?jsl($products);?>
  "author": {
    "@type": "Person",
    "name": "Mordechai Aleksey Povar"
  },
   "publisher": {
    "@type": "Organization",
    "name": "pcompstart",
    "telephone": "+972546252817",
    "address": "Israel",
    "logo": {
      "@type": "ImageObject",
      "url": "https://pcompstart/userfiles/upload/images/img_icon/loginkontakts.png",
      "width": 141,
      "height": 50
    }
  }
}
</script>
<div class="conetnt-table">
 <?php if($brand_name) :?>
    <a href="<?=PATH;?>">Главная</a>&raquo;<span class="content-tablespan">
        <?=$brand_name[0]['type_name'];?></span>
<?php endif;?>

<? if ($page < 2) : ?>
    <h1><?=$brand_name[0]['krohi_text'];?></h1>
<? else : ?>
    <h1><?=$brand_name[0]['krohi_text'].", страница ".$page;?></h1>
<? endif; ?>

<? if($_GET['page'] > $pages_count) :?>
  <p class="error">Здесь продуктов пока нет</p>
<? else :?>
  <?php if($products) :?>
  <?php foreach ($products as $item) :?>
      <div class="key-content">
        <h3><a href="<?=PATH.$brand_name[0]['link_browser_type'];?>/<?=$item['product_id'];?>-<?=$item['link_browser'];?>"><?=$item['title'];?></a></h3>
        <img src="<?=PRODUCTIMG;?><?=$item['img_icon'];?>" alt="<?=$item['img_icon'];?>" title="<?=$item['title'];?>"/>
        <?=$item['anons'];?>
        <a class="read-more" href="<?=PATH.$brand_name[0]['link_browser_type'];?>/<?=$item['product_id'];?>-<?=$item['link_browser'];?>">Читать подробнее...</a>
        <div class="razdelitel-bot"></div>
      </div>
   <?php endforeach;?>
  <?php if($pages_count > 1) pagination($page, $pages_count); ?>
   <?php else :?>
   	<p class="error">Здесь продуктов пока нет</p>
  <?php endif;?>
<? endif;?>
<a name="nav"></a>
 </div>
