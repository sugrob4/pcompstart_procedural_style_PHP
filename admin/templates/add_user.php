<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Добавление пользователя</h3>
<?php
if(isset($_SESSION['add_user']['res'])){
    echo $_SESSION['add_user']['res'];
}
?>
<form action="" method="post">
    <table cellspacing="0" cellpadding="0" class="add_edit_page">
      <tbody>
        <tr>
          <td class="add-edit-txt">*Имя пользователя:</td>
          <td><input type="text" class="head-text" name="name" value="<?=htmlspecialchars($_SESSION['add_user']['name']);?>"></td>
        </tr>
        <tr>
          <td class="add-edit-txt">*Логин пользователя:</td>
          <td><input type="text" class="head-text" name="login" value="<?=htmlspecialchars($_SESSION['add_user']['login']);?>"></td>
        </tr>
        <tr>
          <td class="add-edit-txt">*Email пользователя:</td>
          <td><input type="text" class="head-text" name="email" value="<?=htmlspecialchars($_SESSION['add_user']['email']);?>"></td>
        </tr>
        <tr>
          <td class="add-edit-txt">*Пароль пользователя:</td>
          <td><input type="text" class="head-text" name="password" value="<?=$_SESSION['add_user']['password'];?>"></td>
        </tr>
        <tr>
          <td class="add-edit-txt">*Повторить пароль:</td>
          <td><input type="text" class="head-text" name="retrypassword" value="<?=htmlspecialchars($_SESSION['add_user']['retrypassword']);?>"></td>
        </tr>
       <tr>
          <td class="add-edit-txt">Роль пользователя:</td>
          <td>
          <?php if($roles) : ?>
          	<select name="id_role">
            <?php foreach ($roles As $item) : ?>
            	<option value="<?=$item['id_role'];?>"><?=$item['name_role'];?></option>
            <?php endforeach; ?>
            </select>
         <?php endif; ?>
          </td>
        </tr>
      </tbody>
    </table>
   <input type="submit"  value="Сохранить" class="admsave"/>
</form>
<?php unset($_SESSION['add_user']); ?>
</div>