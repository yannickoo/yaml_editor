# YAML Editor

> Provides an Ace editor for editing YAML configurations

## Usage

When you need an editor for your YAML files add a `data-yaml-editor` to you textarea like:

```php
$form['config'] = [
  '#type' => 'textarea',
  '#title' => t('Configuration'),
  '#attributes' => ['data-yaml-editor' => 'true'],
];
```
