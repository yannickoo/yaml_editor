(function ($, Drupal, drupalSettings) {

  "use strict";

  Drupal.behaviors.yamlEditor = {
    attach: function (context) {
      var initEditor = function () {
        once('yaml-editor', 'textarea[data-yaml-editor]', context).forEach(function(textarea){

          // Create div that will be the ace editor
          var editDiv = document.createElement('div');

          // Exit if not parent node exists
          if(textarea.parentNode == null) return;

          // Hide <textarea>
          textarea.classList.add('visually-hidden');

          // Add edit div after text area
          textarea.parentNode.insertBefore(editDiv, textarea);

          // Init ace editor.
          var editor = ace.edit(editDiv);
          editor.getSession().setValue(textarea.value);
          editor.getSession().setMode('ace/mode/yaml');
          editor.getSession().setTabSize(2);
          editor.setTheme('ace/theme/chrome');
          editor.setOptions({
            minLines: 3,
            maxLines: 20
          });

          // Update Drupal textarea value.
          editor.getSession().on('change', function () {
            textarea.value = editor.getSession().getValue();
          });

        })
      };

      // Check if Ace editor is already available and load it from source cdn otherwise.
      if (typeof ace !== 'undefined') {
        initEditor();
      }
      else {
        getScript(drupalSettings.yamlEditor.source, initEditor)
      }
    }
  };

  /**
   * Helper to load ace script on the page.
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

})(jQuery, Drupal, drupalSettings);
