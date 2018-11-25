<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Редактирование пользователя</h3>
<?php
if(isset($_SESSION['edit_user']['res'])){
    echo $_SESSION['edit_user']['res'];
	unset($_SESSION['edit_user']['res']);
}
?>
<form action="" method="post">
    <table cellspacing="0" cellpadding="0" class="add_edit_page">
      <tbody>
        <tr>
          <td class="add-edit-txt">Имя пользователя:</td>
          <td><input type="text" class="head-text" name="name" value="<?=htmlspecialchars($get_user['name']);?>"></td>
        </tr>
        <tr>
          <td class="add-edit-txt">Логин пользователя:</td>
          <td>
          <?php if($_SESSION['auth']['user_id'] != $user_id) : ?>
          	<input type="text" class="head-text" name="login" value="<?=htmlspecialchars($get_user['login']);?>">
          <?php else : ?>
          	<input type="text" class="head-text" name="login" value="<?=htmlspecialchars($get_user['login']);?>" disabled="disabled">
            <span class="small">Собственный логин изменить нельзя</span>
          <?php endif; ?>
         </td>
        </tr>
        <tr>
          <td class="add-edit-txt">Email пользователя:</td>
          <td><input type="text" class="head-text" name="email" value="<?=htmlspecialchars($get_user['email']);?>"></td>
        </tr>
        <tr>
          <td class="add-edit-txt">Новый пароль:</td>
          <td><input type="text" class="head-text" name="password"></td>
        </tr>
        <tr>
          <td class="add-edit-txt">Повторить новый пароль:</td>
          <td><input type="text" class="head-text" name="retrypassword"></td>
        </tr>
      <?php if($_SESSION['auth']['user_id'] != $user_id) : ?>
       <tr>
          <td class="add-edit-txt">Роль пользователя:</td>
          <td>
          <?php if($roles) : ?>
          	<select name="id_role">
            <?php foreach ($roles As $item) : ?>
            	<option <?php if($item['id_role'] == $get_user['id_role']) echo "selected" ?> value="<?=$item['id_role'];?>"><?=$item['name_role'];?></option>
            <?php endforeach; ?>
            </select>
         <?php endif; ?>
          </td>
        </tr>
     <?php endif; ?>
      </tbody>
    </table>
   <input type="submit"  value="Сохранить" class="admsave"/>
</form>
</div>