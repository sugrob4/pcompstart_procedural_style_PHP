<?php
defined('PCOMPSTART') or die('Access denied');
?>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WPSideBar",
    <?
        $a = '';
        $b = '';
        foreach ($cat as $key => $item) {
            $a .= '"'.$item['type_name'].'"'.','."\n";
            $b .= '"'.'https:'.PATH.$item['link_browser_type'].'"'.','."\n";
        }
        $a = rtrim($a, ','."\n");
        $b = rtrim($b, ','."\n");
        echo
            '"'.'name'.'"'.':'.'['.$a.']'.','."\n",
            '"'.'url'.'"'.':'.'['.$b.']'."\n";
    ?>
}
</script>
<div id="left-bar">
  <div class="left-bar-cont" id="left-bar-cont">
    <pre class="title_leftbar">Разделы</pre>
    <script defer src="<?=PATH.TEMPLATE;?>js/jquery.jMagnify.js"></script>
     <ul class="ulf">
  		<?php foreach ($cat as $key => $item) :?>
      	 <li><a href="<?=PATH.$item['link_browser_type'];?>"><?=$item['type_name'];?></a></li>
      <?php endforeach;?>
     </ul>
  </div>
  <div class="div_rss">
  <p class="rsstlt">RSS лента</p>
  	<p>
    	<a href="//feeds.feedburner.com/pcompstart" title="Подписаться на обновления по RSS" target="_blank">
   		<img src="<?=PATH.TEMPLATE;?>images/rss_image.png" alt="Подписаться на обновления по RSS"/>
        </a>
   </p>
  </div>
  <div class="rss-podpiska">
  	<form
    action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow"
    onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=pcompstart', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
    <p>Получать новые статьи на <br> E-mail</p>
    <p style="float:left; margin:0 0 5px 13px; padding:0;">Ваш E-mail:</p>
    <p><input type="text" style="width:180px; border-radius:5px; border:1px solid #7F8D9B; padding-left: 3px;" name="email"/></p>
    <input type="hidden" value="pcompstart" name="uri"/>
    <input type="hidden" name="loc" value="ru_RU"/>
    <input type="submit" value="Подписаться" />
    </form>
  </div>
</div>
