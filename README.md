# YAML Editor

> This module loads an [Ace](https://ace.c9.io) editor for all textarea with `data-yaml-editor` attribute

## Demo :tv:

![Demonstration of editor enabled textarea](https://www.drupal.org/files/yaml-editor-demo_0.gif)

## Usage :point_up:

### Field widget

You can use the YAML editor for _Text (plain, long)_ fields, simply go to _Manage form display_ and select _Textarea with YAML editor_.

### Code

When you need an editor for your YAML files add a `data-yaml-editor` to you textarea like:

```php
$form['config'] = [
  '#type' => 'textarea',
  '#title' => t('Configuration'),
  '#attributes' => ['data-yaml-editor' => 'true'],
];
```

## Supporters :innocent:

Here are some module which are already implementing the `data-yaml-editor` attribute:

* [Linked Field](https://www.drupal.org/project/linked_field)
* [Menu Link Attributes](https://www.drupal.org/project/menu_link_attributes)
* [Block Attributes](https://github.com/axe312ger/block_attributes)
* [Responsive SVG](https://www.drupal.org/project/responsive_svg)

## Contributing :hammer:

Pull requests and stars are always welcome. For bugs and feature requests, [please create an issue](https://github.com/yannickoo/yaml_editor/issues/new).
