# CakePHP DeleteableBehavior

Deleteable provides a way to flag a database record as deleteable or not deleteable. I created this CakePHP Behavior with the need to be able to set a tinyint(1) "delete" field in my database and set it to true or false (0 or 1). The plugin is flexible, you can set your own field name as long as it stores a boolean value. You can also specify the value on which the delete is blocked or not. So you could have the DeleteableBehavior work when it's true and not when false (default behavior is false). The reason you might want to do this when you name your Deletable field to say "locked" and hence you might want to have "locked" field set to 1 (or true), in other words "locked" records can not be deleted because they are "locked" = true.

## Requirements

The master branch has the following requirements:

* CakePHP 2.2.0 or greater.
* PHP 5.3.0 or greater.

## Installation

_[Using [Composer](http://getcomposer.org/)]_

From your command line you can enter

```bash
composer require justinatack/deleteable="*"
```

or add the plugin to your project's `composer.json` - something like this:

```javascript
{
	"require": {
		"justinatack/deleteable": "*"
	}
}
```

Because this plugin has the type `cakephp-plugin` set in it's own `composer.json`, composer knows to install it inside your `/Plugin` directory, rather than in the usual vendors file. It is recommended that you add `/Plugin/Deleteable` to your .gitignore file. (Why? [read this](http://getcomposer.org/doc/faqs/should-i-commit-the-dependencies-in-my-vendor-directory.md).)

> Consider using "require-dev" if you only want to include Deleteable for your development environment.

_[Manual]_

* Download the [Deleteable archive](https://github.com/justinatack/deleteable/archive/master.zip).
* Unzip that download.
* Rename the resulting folder to `Deleteable`
* Then copy this folder into `app/Plugin/`

_[GIT Submodule]_

In your app directory type:

```bash
git submodule add git://github.com/justinatack/deleteable.git Plugin/Deleteable
git submodule init
git submodule update
```

_[GIT Clone]_

In your plugin directory type

```bash
git clone git://github.com/justinatack/deleteable.git Deleteable
```

### Enable plugin

* In 2.x you need to enable the plugin your `app/Config/bootstrap.php` file. If you are already using `CakePlugin::loadAll();`, then the following is not necessary.:
```php
		CakePlugin::load('Deleteable');
```
* Include the Deleteable behavior in your `app/Model/AppModel.php`:
```php
class AppModel extends Model {
				 public $actsAs = array('Deleteable.Deleteable', array(
             'field' => 'delete',
             'boolean' => false
				     )
				 );
}
```
* Set `field` to your database field name that your want checked. Default field is "delete". Make sure you create a TINYINT(1) field type in MySQL.
* Set the 'boolean' value to false for default behavior or use true to flip the behavior.

## Reporting Issues

If you have a problem with Deleteable please open an issue on [GitHub](https://github.com/justinatack/deleteable/issues).

## Contributing

If you'd like to contribute to Deleteable, check out the
[roadmap](https://github.com/justinatack/deleteable/wiki/roadmap) for any
planned features. You can [fork](https://help.github.com/articles/fork-a-repo)
the project, add features, and send [pull
requests](https://help.github.com/articles/using-pull-requests) or open
[issues](https://github.com/justinatack/deleteable/issues).

## Versions

Deleteable has only had one release. Please feel free to submit a pull request to add or improve codebase.

* '0.0.1' a working patch, the code base may well change.
