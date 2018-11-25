<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Редактирование информера</h3>
<?php 
if (isset($_SESSION['edit_informer']['res'])) {
	echo $_SESSION['edit_informer']['res'];
	unset($_SESSION['edit_informer']);
}
?>
  <form action="" method="post">
      <table cellspacing="0" cellpadding="0"  class="add_edit_page">
        <tbody>
          <tr>
            <td class="add-edit-txt">Имя информера:</td>
            <td><input class="head-text" type="text" name="name_informer" value="<?=htmlspecialchars($get_informer['name']);?>"/></td>
          </tr>
          <tr>
            <td class="add-edit-txt">Номер родительской категории:<br>
				<span style="font-size:12px;">(Если нет оставить поле пустым)</span></td>
            <td><input class="num-text" type="text" name="parenttype_informer" value="<?=$get_informer['parent_type'];?>"/></td>
          </tr>
          <tr>
            <td class="add-edit-txt">Добавить описание информера:</td>
          </tr>
          <tr>
            <td colspan="2">
            	<textarea  id="editor1" name="text_informer"><?=$get_informer['text'];?></textarea>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
</script>
            </td>
          </tr>
        </tbody>
      </table>
      <input type="submit"  value="Сохранить" class="admsave"/>
  </form>
</div>