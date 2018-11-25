CKEDITOR.plugins.add('noindex', {
    init: function(editor) {
        CKEDITOR.addCss("span.hidden_link {color: #0031D3; cursor: pointer; text-decoration: underline;}")
        editor.addCommand('insertNoindex', {
            exec: function(editor) {
                var element = CKEDITOR.dom.element.createFromHtml('<noindex><span class="hidden_link" data-link="' + editor.getSelection().getSelectedText() + '">' + editor.getSelection().getSelectedText() + '</span></noindex>');
                editor.insertElement(element)
            }
        });

        editor.ui.addButton('Noindex', {
            label: 'Вставить тег noindex',
            command: 'insertNoindex',
            icon: this.path + 'images/icon.png',
        });
    }
});