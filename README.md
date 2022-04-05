# Yii 2 Nikita Hotdog Blog

![logo](https://freepngimg.com/thumb/hot_dog/6-2-hot-dog-png-clipart-thumb.png)

Без понятия что тут написать такого важного по поводу курсача.
В общем каким-то образмон натыкал блог. Всё работает

Гость может только смотреть список постов и конкретные посты

Юзер может создавать посты, изменять и удалять только свои посты

Админ может публиковать посты и снимать с публикации

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      commands/           contains console commands (controllers)
      config/             contains application configurations
      controllers/        contains Web controller classes
      interfaces/         contains interfaces
      mail/               contains view files for e-mails
      models/             contains model classes
      modules/            contains modules
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources

Конфигурация
-------------

### База данных

Измените файл `config/db.php` с реальными данными, например:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=blog',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
];
```
**[Подробнее](https://www.yiiframework.com/doc/guide/2.0/en/start-databases#configuring-db-connection)**

