<?php

/**
 * @file
 * Contains Drupal\yaml_editor\Form\ConfigForm.
 */

namespace Drupal\yaml_editor\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConfigForm.
 *
 * @package Drupal\linked_field\Form
 */
class ConfigForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'yaml_editor.config'
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'yaml_editor_config';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('yaml_editor.config');

    $form['editor_source'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Editor source'),
      '#description' => $this->t('Enter path to Ace editor.'),
      '#default_value' => $config->get('editor_source'),
    ];

    $form['editor_theme'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Editor theme'),
      '#description' => $this->t('Enter name of Ace theme to use.'),
      '#default_value' => $config->get('editor_theme'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $editor_source = $form_state->getValue('editor_source');
    $editor_theme = $form_state->getValue('editor_theme');

    $this->config('yaml_editor.config')
      ->set('editor_source', $editor_source)
      ->set('editor_theme', $editor_theme)
      ->save();

    parent::submitForm($form, $form_state);
  }

}
