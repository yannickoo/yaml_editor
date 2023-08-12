(function (Drupal, drupalSettings) {

  'use strict';

  Drupal.behaviors.yamlEditor = {
    attach: function (context) {
      var initEditor = function () {
        once('yaml-editor', 'textarea[data-yaml-editor]', context).forEach(function ($textarea) {
          var $editDiv = document.createElement('div');

          if (!$textarea.parentNode) {
            return;
          }

          $textarea.classList.add('visually-hidden');

          $textarea.parentNode.insertBefore($editDiv, $textarea);

          // Init Ace editor.
          var editor = ace.edit($editDiv);
          editor.getSession().setValue($textarea.value);
          editor.getSession().setMode('ace/mode/yaml');
          editor.getSession().setTabSize(2);
          editor.setTheme(drupalSettings.yamlEditor.theme);
          editor.setOptions({
            minLines: 3,
            maxLines: 20
          });

          // Update Drupal textarea value.
          editor.getSession().on('change', function () {
            $textarea.value = editor.getSession().getValue();
          });
        });
      };

      // Check if Ace editor is already available and load it from source cdn otherwise.
      if (typeof ace !== 'undefined') {
        initEditor();
      }
      else {
        getScript(drupalSettings.yamlEditor.source, initEditor);
      }
    }
  };

  /**
   * Helper to load Ace script on the page.
   *
   * @param {string} source
   * @param {function} callback
   */
  function getScript(source, callback) {
    var script = document.createElement('script');
    script.src = source;
    script.async = true;
    script.onload = callback;
    document.body.appendChild(script);
  }

})(Drupal, drupalSettings);
