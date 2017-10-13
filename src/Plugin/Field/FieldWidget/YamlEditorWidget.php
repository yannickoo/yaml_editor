<?php

/**
 * @file
 * Contains \Drupal\yaml_editor\Plugin\Field\FieldWidget\YamlEditorWidget.
 */

namespace Drupal\yaml_editor\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\StringTextareaWidget;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'yaml_editor_widget' widget.
 *
 * @FieldWidget(
 *   id = "yaml_editor",
 *   label = @Translation("Text area with YAML editor"),
 *   field_types = {
 *     "string_long"
 *   }
 * )
 */
class YamlEditorWidget extends StringTextareaWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = $element + [
      '#type' => 'textarea',
      '#default_value' => $items[$delta]->value,
      '#rows' => $this->getSetting('rows'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#attributes' => [
        'data-yaml-editor' => 'true',
        'class' => ['js-text-full', 'text-full'],
      ],
    ];

    return $element;
  }

}
