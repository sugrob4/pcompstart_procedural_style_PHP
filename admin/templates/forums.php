<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Редактирование разделов</h3>
<?php 
if (isset($_SESSION['answer'])) {
	echo $_SESSION['answer'];
	unset($_SESSION['answer']);
}
?>
<p><a href="?view=add_type">Добавить раздел</a></p>   
    <div class="content_list">
        <ul>
            <?php foreach ($cat as $key => $val) :?>
              <li>
                   <a href="?view=cat&amp;category=<?=$val['link_browser_type'];?>"><?=$val['type_name'];?></a>
                   <a class="edit" href="?view=edit_type&amp;type_link=<?=$val['link_browser_type'];?>">Изменить</a>
                   <a class="delete" href="?view=del_type&amp;type_link=<?=$val['link_browser_type'];?>">Удалить</a>
              </li>
            <?php endforeach;?>
        </ul>
    </div>
<p><a href="?view=add_type">Добавить раздел</a></p> 
</div>
