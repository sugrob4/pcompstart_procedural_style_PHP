<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="main">
<div class="left_bar">
    <div class="left_bar_cont">
           <h3 <?=active_url();?> id="forums">Редактирование продуктов</h3>
           <ul id="toggle">
            <?php foreach ($cat as $key => $val) :?>
                <li>
                  <a <?=active_url("category=".$val['link_browser_type']);?> href="?view=cat&amp;category=<?=$val['link_browser_type'];?>"><?=$val['type_name'];?></a>
                </li>
            <?php endforeach;?>
           </ul>
        <a <?=active_url("view=forums")?> href="?view=forums">Редактирование разделов</a>
        <a <?=active_url("view=pages")?> href="?view=pages">Основные страницы</a>
        <a <?=active_url("view=informers")?> href="?view=informers">Информеры</a>
        <a  <?=active_url("view=users")?>  href="?view=users">Пользователи</a>
        <a <?=active_url("view=mod_comment")?> href="?view=mod_comment">Редактирование коментариев</a>
    </div>
</div>
</div>
