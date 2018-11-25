/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
  config.language = 'ru';
	 //config.uiColor = '#AADC6E';
  //config.skin = 'kama';
  config.filebrowserBrowseUrl = 'https://pcompstart/admin/templates/js/kcfinder/browse.php?opener=ckeditor&type=files';
  config.filebrowserImageBrowseUrl = 'https://pcompstart/admin/templates/js/kcfinder/browse.php?opener=ckeditor&type=images';
  config.filebrowserFlashBrowseUrl = 'https://pcompstart/admin/templates/js/kcfinder/browse.php?opener=ckeditor&type=flash';
  config.filebrowserUploadUrl = 'https://pcompstart/admin/templates/js/kcfinder/upload.php?opener=ckeditor&type=files';
  config.filebrowserImageUploadUrl = 'https://pcompstart/admin/templates/js/kcfinder/upload.php?opener=ckeditor&type=images';
  config.filebrowserFlashUploadUrl = 'https://pcompstart/admin/templates/js/kcfinder/upload.php?opener=ckeditor&type=flash';
  config.height = '400px';
  config.toolbarCanCollapse = true;
  config.forcePasteAsPlainText = true;
  config.enterMode = CKEDITOR.ENTER_BR;
  config.indentClasses = ["ul-grey", "ul-red", "text-red", "ul-content-red", "circle", "style-none", "decimal", "paragraph-portfolio-top", "ul-portfolio-top", "url-portfolio-top", "text-grey"];
  config.protectedSource.push(/<(style)[^>]*>.*<\/style>/ig);
  config.protectedSource.push(/<(script)[^>]*>.*<\/script>/ig);// разрешить теги <script>
  config.protectedSource.push(/<(i)[^>]*>.*<\/i>/ig);// разрешить теги <i>
  config.protectedSource.push(/<\?[\s\S]*?\?>/g);// разрешить php-код
  config.protectedSource.push(/<!--dev-->[\s\S]*<!--\/dev-->/g);
  config.protectedSource.push(/<[a-z]*[a-z\s\=\"\']*><\/[\s\S][^/]*?>/g);
  config.allowedContent = true; /* all tags */

  // Подключение моего плагина `noindex`
  config.extraPlugins = 'noindex',
  toolbar_Custom =
        [
            { name: 'noindex', items: ['Noindex'] }
        ]
  // Конец подключение моего плагина `noindex`
};
