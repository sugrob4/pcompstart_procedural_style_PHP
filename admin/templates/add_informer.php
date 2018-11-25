<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Добавление информера</h3>
<?php 
if (isset($_SESSION['add_informer']['res'])) {
	echo $_SESSION['add_informer']['res'];
	unset($_SESSION['add_informer']);
}
?>
  <form action="" method="post" enctype="multipart/form-data">
      <table cellspacing="0" cellpadding="0"  class="add_edit_page">
        <tbody>
          <tr>
            <td class="add-edit-txt">Имя информера:</td>
            <td><input class="head-text" type="text" name="name_informer"/></td>
          </tr>
          <tr>
            <td class="add-edit-txt">Номер родительской категории:<br>
				<span style="font-size:12px;">(Если нет оставить поле пустым)</span></td>
            <td><input class="num-text" type="text" name="parenttype_informer"/></td>
          </tr>
            <td class="add-edit-txt">Добавить описание информера:</td>
          </tr>
          <tr>
            <td colspan="2">
            	<textarea  id="editor1" name="text_informer"></textarea>
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