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
  "name": "Сайт pcompstart",
  <?jsl($lastarticles, $artsec=true);?>
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
<div class="catalog-index">
<?php if($cheifinformers) :?>
    	<?=$cheifinformers[0]['text'];?>
<?php endif;?>
<script async type="text/javascript" src="<?=PATH.TEMPLATE;?>js/MenIn_scale_edgePreload.js"></script>
        <div id="Stage" class="MenIn_scale" align="justify"></div>
    <div class="razproduct-index"></div>
    <div class="product-index">
        <h3 class="lastart_title">Последние статьи сайта pcompstart</h3>
        <?foreach($lastarticles as $item) :?>
            <section>
                <div class="lastart">
                    <h4>
                        <a href="<?=PATH.$item['products_typeid'];?>/<?=$item['product_id'];?>-<?=$item['link_browser'];?>" target="_blank"><?=$item['title'];?></a>
                    </h4>
                    <img src="<?=HOMEIMG.$item['img_icon'];?>" alt="<?=$item['img_icon'];?>">
                    <div class="lastatr_anons">
                        <?=summary($item['anons']);?>
                    </div>
                    <p class="lastart_date"><?=date('d.m.Y', strtotime($item['date']));?></p>
                </div>
            </section>
        <?endforeach;?>
    </div>
    <div class="razproduct-index"></div>
</div>
