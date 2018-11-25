<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Список поьзователей</h3>
<?php 
if (isset($_SESSION['answer'])) {
	echo $_SESSION['answer'];
	unset($_SESSION['answer']);
}
//print_arr($users);
?>
<p><a href="?view=add_user">Добавить пользователя</a></p>
<table class="tabl_users" cellspacing="1">
    <tr>
        <th class="number">id</th>
        <th>Имя</th>
        <th class="str_name">Логин</th>
        <th class="str_email">email</th>
        <th class="str_sort">Роль</th>
        <th class="str_action">Действие</th>
    </tr>
<?php foreach ($users As $item) : ?>
    <tr>
    	<td style="text-align:center;"><?=$item['customer_id'];?></td>
    	<td><?=htmlspecialchars($item['name']);?></td>
        <td><?=htmlspecialchars($item['login']);?></td>
        <td><?=htmlspecialchars($item['email']);?></td>
    	<td><?=htmlspecialchars($item['name_role']);?></td>
    	<td class="lasttabletd"><a href="?view=edit_user&amp;user_id=<?=$item['customer_id'];?>" style="margin-top:0;" class="edit">изменить</a>
        	<a href="?view=del_user&amp;user_id=<?=$item['customer_id'];?>" style="margin-top:0;" class="delete">удалить</a></td>
    </tr>
<?php endforeach; ?>
</table>
<?php if($pages_count > 1) pagination($page, $pages_count, $modrew = 0); ?>
<p><a href="?view=add_user">Добавить пользователя</a></p>
</div>