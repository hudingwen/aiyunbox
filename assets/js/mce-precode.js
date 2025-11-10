(function() {
    tinymce.create('tinymce.plugins.precode', {
        init: function(editor, url) {
            editor.addButton('precode', {
                text: '</>',
                icon: false,
                tooltip: '插入代码块 (wp-block-code)',
                onclick: function() {
                    // 获取当前选中的内容
                    var selectedText = editor.selection.getContent({format: 'text'});

                    if (selectedText && selectedText.trim() !== '') {
                        // 包裹选中的文本
                        editor.selection.setContent(
                            '<pre class="wp-block-code"><code>' +
                            editor.dom.encode(selectedText) +
                            '</code></pre>'
                        );
                    } else {
                        // 没选中任何内容则插入模板
                        editor.insertContent(
                            '<pre class="wp-block-code"><code>\n// 在这里输入代码\n</code></pre>\n'
                        );
                    }
                }
            });
        },
        createControl: function() {
            return null;
        }
    });

    tinymce.PluginManager.add('precode', tinymce.plugins.precode);
})();
