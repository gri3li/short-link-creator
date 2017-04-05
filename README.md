Short Link Creator
============================

Установка
-------------------

### Клонирование репозитория
```sh
$ git clone https://github.com/gri3li
```

### Установка библиотек
Для установки необходимых библиотек потредуется composer-asset-plugin установленный "глобально" для текущего пользователя ОС
```sh
$ composer global require "fxp/composer-asset-plugin:1.0.*@dev"
```
Устанавливаем библиотеки
```sh
$ composer install --prefer-dist
```

### Переменные окружения
Задаются через файл `.env`, который необходимо создать в корневой директории проекта.
Пример содержимого файла:
```
YII_DEBUG = true
YII_ENV = dev

DB_DSN = "mysql:host=localhost;dbname=short_link"
DB_USERNAME = root
DB_PASSWORD = root
```

### Права на запись в папки
```sh
$ chmod 0777 runtime web/assets
```

### Запуск миграций
```sh
$ php yii migrate
```
