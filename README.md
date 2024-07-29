# ilyes512/code-style

An ECS (Easy Coding Standards) codestyle package.

## Installation

You can install the package via composer:

```bash
composer require --dev ilyes512/code-style:^2.0
```

## Usage

Add a `phpcs.xml` file to the root of your project. The below config example is for a Laravel project:

`phpcs.yml`:

```xml
<?xml version="1.0"?>
<ruleset>
    <description>A Laravel project coding standard</description>

    <arg name="extensions" value="php" />
    <arg name="report" value="full"/>
    <arg name="colors"/>
    <arg value="s"/> <!-- Show sniff codes in report -->
    <arg value="p"/> <!-- Show progress in report -->

    <file>.</file>
    <exclude-pattern>vendor</exclude-pattern>
    <exclude-pattern>node_modules</exclude-pattern>
    <exclude-pattern>.phpstan.cache</exclude-pattern>
    <exclude-pattern>.phpunit.cache</exclude-pattern>
    <exclude-pattern>bootstrap/cache</exclude-pattern>
    <exclude-pattern>storage/framework</exclude-pattern>
    <exclude-pattern>resources/css</exclude-pattern>
    <exclude-pattern>resources/js</exclude-pattern>
    <exclude-pattern>coverage</exclude-pattern>

    <rule ref="Ilyes512CodingStandard"/>
</ruleset>
```

## Using the PHPCSStandards plugin

The above config assumes you allowed installing the [PHP_CodeSniffer](https://github.com/PHPCSStandards/composer-installer) plugin. Composer will prompt you to install it when you install this package. If you didn't, you can allow it by adding the following to your composer.json:

```json
{
    "config": {
        "allow-plugins": {
            "dealerdirect/phpcodesniffer-composer-installer": true
        }
    }
}
```

## Annotated ruleset

The [annotated ruleset](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-Ruleset).
