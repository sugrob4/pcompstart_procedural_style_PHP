<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Редактирование информеров</h3>
<?php 
if (isset($_SESSION['answer'])) {
	echo $_SESSION['answer'];
	unset($_SESSION['answer']);
}
?>
<p><a href="?view=add_informer">Добавить информер</a></p>   
    <div class="content_list">
        <ul>
            <?php foreach ($informers as $key => $val) : ?>
              <li>
                   <?=$val['name'];?>
                   <a class="edit" href="?view=edit_informer&amp;id_anons=<?=$val['id_anons'];?>">Изменить</a>
                   <a class="delete" href="?view=del_informer&amp;id_anons=<?=$val['id_anons'];?>">Удалить</a>
              </li>
            <?php endforeach; ?>
        </ul>
    </div>
<p><a href="?view=add_informer">Добавить информер</a></p> 
</div>