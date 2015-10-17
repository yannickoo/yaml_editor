(function ($, Drupal, drupalSettings) {

  "use strict";

  Drupal.behaviors.yamlEditor = {
    attach: function (context) {
      var initEditor = function () {
        $('textarea[data-yaml-editor]', context).once('yaml-editor').each(function () {
          var $textarea = $(this);
          var $editDiv = $('<div>').insertBefore($textarea);

          $textarea.addClass('visually-hidden');

          // Init ace editor.
          var editor = ace.edit($editDiv[0]);
          editor.getSession().setValue($textarea.val());
          editor.getSession().setMode('ace/mode/yaml');
          editor.getSession().setTabSize(2);
          editor.setTheme('ace/theme/chrome');
          editor.setOptions({
            minLines: 3,
            maxLines: 20
          });

          // Update Drupal textarea value.
          editor.getSession().on('change', function () {
            $textarea.val(editor.getSession().getValue());
          });
        });
      };

      // Check if Ace editor is already available and load it from source cdn otherwise.
      if (typeof ace !== 'undefined') {
        initEditor();
      }
      else {
        $.getScript(drupalSettings.yamlEditor.source, initEditor);
      }
    }
  };

})(jQuery, Drupal, drupalSettings);
