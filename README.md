Simple Menu Bundle
============
[![Build Status](https://travis-ci.org/kunicmarko20/SimpleMenuBundle.svg?branch=master)](https://travis-ci.org/kunicmarko20/SimpleMenuBundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/54c01911-c1a8-4bba-851b-66b41eaacb7e/mini.png)](https://insight.sensiolabs.com/projects/54c01911-c1a8-4bba-851b-66b41eaacb7e)
[![Latest Stable Version](https://poser.pugx.org/kunicmarko/simple-menu-bundle/v/stable)](https://packagist.org/packages/kunicmarko/simple-menu-bundle)
[![Total Downloads](https://poser.pugx.org/kunicmarko/simple-menu-bundle/downloads)](https://packagist.org/packages/kunicmarko/simple-menu-bundle)
[![Latest Unstable Version](https://poser.pugx.org/kunicmarko/simple-menu-bundle/v/unstable)](https://packagist.org/packages/kunicmarko/simple-menu-bundle)
[![License](https://poser.pugx.org/kunicmarko/simple-menu-bundle/license)](https://packagist.org/packages/kunicmarko/simple-menu-bundle)

Simple Menu Bundle adds Menu to your Symfony application and is integrated with Sonata Admin.

This bundle depends on [SonataAdminBundle](https://github.com/sonata-project/SonataAdminBundle) and [DoctrineExtensions](https://github.com/Atlantic18/DoctrineExtensions)

![Menu List](https://user-images.githubusercontent.com/13528674/29790813-36034c38-8c3b-11e7-98fb-9b61aee22009.png)
![Menu Children List](https://user-images.githubusercontent.com/13528674/29790812-36023d2a-8c3b-11e7-9a3e-3a43feb261ac.png)
Documentation
-------------

* [Installation](#installation)
* [How to use](#how-to-use)
* [Override Template](#override-template)

## Installation

**1.**  Add to composer.json to the `require` key

```
composer require kunicmarko/simple-menu-bundle "v1.0.0-beta"
```

**2.** Register the bundle in ``app/AppKernel.php``

```
$bundles = array(
    // ...
    new KunicMarko\SimpleMenuBundle\SimpleMenuBundle(),
);
```
Add Gedmo Tree extensions mappings and if you are not using auto_mapping add bundle mappings
```
# app/config/config.yml
   orm:
        entity_managers:
            default:
                mappings:
                    #...
                    SimpleMenuBundle: ~
                    gedmo_tree:
                        type: annotation
                        prefix: Gedmo\Tree\Entity
                        dir: "%kernel.root_dir%/../vendor/gedmo/doctrine-extensions/lib/Gedmo/Tree/Entity"
                        alias: Gedmo
                        is_bundle: false
```

**3.** Update database

```
app/console doctrine:schema:update --force
```

**4.** Clear cache
```
app/console cache:clear
```

**5.** Install assets
```
app/console assets:install
```

## How to use

In your twig template you can render it with:
```
{{ simple_menu_render('machine_name', level) }}
```

or if you want to render it on your own you can:
```
{% set menu = simple_menu_fetch('machine_name', level) %}
```

## Override template

You can override default template from config:

```
# app/config/config.yml
simple_menu
    template:
        render: SimpleMenuBundle:Menu:render.html.twig
```
