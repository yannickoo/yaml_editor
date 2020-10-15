<?php

/**
 * @file
 * Contains \Drupal\yaml_editor\Plugin\Field\FieldWidget\YamlEditorWidget.
 */

namespace Drupal\yaml_editor\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\StringTextareaWidget;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

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
    $element = parent::formElement($items, $delta, $element, $form, $form_state);
    $element['value']['#attributes']['data-yaml-editor'] = 'true';
    $element['#element_validate'][] = [get_class($this), 'validateElement'];

    return $element;
  }

  /**
   * Form validation handler for widget elements.
   *
   * @param array $element
   *   The form element.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The form state.
   */
  public static function validateElement(array $element, FormStateInterface $form_state) {
    if (empty($element['value']['#value'])) {
      return;
    }
    try {
      Yaml::parse($element['value']['#value']);
    } catch (ParseException $exception) {
      $form_state->setError($element, t("@name field contains malformed YAML string:<br>@error", [
        '@name' => $element['#title'],
        '@error' => $exception->getMessage(),
      ]));
    }
  }

}
