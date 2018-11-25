<?php
defined('PCOMPSTART') or die('Access denied');
?>
<div class="content-center">
<h3>Добавление продукта</h3>
<?php 
if (isset($_SESSION['add_product']['res'])) {
	echo $_SESSION['add_product']['res'];
}
?>
<form action="" method="post" enctype="multipart/form-data">
    <table cellspacing="0" cellpadding="0" class="add_edit_page">
      <tbody>
        <tr>
          <td class="add-edit-txt">Название продукта:</td>
          <td><input type="text" class="head-text" name="name" value="<?=$_SESSION['add_product']['name'];?>"></td>
        </tr>
        <tr>
            <td class="add-edit-txt">Сссылка в строке браузера:</td>
            <td><input type="text" class="head-text" name="link_browser" value="<?=$_SESSION['add_product']['link_browser'];?>"></td>
        </tr>
        <tr>
            <td class="add-edit-txt">Мета тег Title (70 символолв):</td>
            <td><input type="text" class="head-text" name="meta_title" value="<?=$_SESSION['add_product']['meta_title'];?>"></td>
        </tr>
        <tr>
          <td class="add-edit-txt">Ключевые слова:</td>
          <td><input type="text" class="head-text" name="keywords" value="<?=$_SESSION['add_product']['keywords'];?>"></td>
        </tr>
        <tr>
          <td class="add-edit-txt">Мета описание:</td>
          <td><input type="text" class="head-text" name="description" value="<?=$_SESSION['add_product']['description'];?>"></td>
        </tr>
        <tr>
          <td>Раздел:</td>
          <td>
          	<select class="select-inf" name="category" multiple="multiple"  size="10" style="height:auto;">
            	<?php foreach ($cat As $key => $item) : ?>
                	<option <?php if($item['link_browser_type'] == $type_id) echo "selected" ?> value="<?=$item['link_browser_type'];?>"><?=$item['type_name'];?></option>
                <?php endforeach; ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Иконка продукта:</td>
          <td><input type="file" name="baseimg"></td>
        </tr>
        <tr>
          <td>Краткое описание (anons):</td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2">
          	<textarea id="editor1" class="anons-text" name="anons"><?=$_SESSION['add_product']['anons'];?></textarea>
<script type="text/javascript">
	CKEDITOR.replace( 'editor1' );
</script>
          </td>
        </tr>
        <tr>
          <td>Подробное описание:</td>
          <td></td>
        </tr>
        <tr>
          <td colspan="2">
          	<textarea id="editor2" class="anons-text" name="content"><?=$_SESSION['add_product']['content'];?></textarea>
<script type="text/javascript">
	CKEDITOR.replace( 'editor2' );
</script>    
          </td>
        </tr>
        <tr>
            <td class="add-edit-txt">Дата:</td>
            <td><input type="date" class="head-text" name="date" style="width:25%;"></td>
        </tr>
        <tr>
          <td>Показывать:</td>
          <td><input type="radio" value="1" name="visible" checked>Да<br />
				<input type="radio" value="0" name="visible">Нет</td>
        </tr>
      </tbody>
    </table>
   <input type="submit"  value="Сохранить" class="admsave"/>
</form>
<?php unset($_SESSION['add_product']); ?>
</div>
