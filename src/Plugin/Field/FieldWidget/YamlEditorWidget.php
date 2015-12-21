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
 *   id = "yaml_editor_widget",
 *   label = @Translation("Textarea with yaml editor"),
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
    $element = [];

    $element['value'] = $element + array(
      '#type' => 'textarea',
      '#default_value' => $items[$delta]->value,
      '#rows' => $this->getSetting('rows'),
      '#placeholder' => $this->getSetting('placeholder'),
      '#attributes' => array('data-yaml-editor' => 'true', 'class' => array('js-text-full', 'text-full')),
    );

    return $element;
  }

}
