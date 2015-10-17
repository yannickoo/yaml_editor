# YAML Editor

> This module loads an [Ace](https://ace.c9.io) editor for all textarea with `data-yaml-editor` attribute

## Demo

![Demonstration of editor enabled textarea](https://www.drupal.org/files/yaml-editor-demo_0.gif)

## Usage

When you need an editor for your YAML files add a `data-yaml-editor` to you textarea like:

```php
$form['config'] = [
  '#type' => 'textarea',
  '#title' => t('Configuration'),
  '#attributes' => ['data-yaml-editor' => 'true'],
];
```
