## Installation
```
composer require --prefer-dist dmsylvio/menu "*"
```

Add the following code to config file Yii2
```php
'modules' => [
	'menu' => [
            'class' => 'vendor\dmsylvio\menu\Menu',
        ],
	]
```

## Configuration

### 1. Create database schema

Make sure that you have properly configured `db` application component and run the following command:

```bash
$ php yii migrate/up --migrationPath=@vendor/dmsylvio/menu/migrations
```

### 2. Add the following code to view layout file Yii2

```php
use vendor\dmsylvio\menu\Menu;

// $arr (principal menus id)
echo Menu::get_menu_tree($arr = [3,20,38,46,54]);

```

### 3. Getting started
/menu/creator
