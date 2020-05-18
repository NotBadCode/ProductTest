Реализация тестового задания. Простой CRUD на Yii2 с RBAC

## Installation: ##

```
composer install
```

Set DB config in config/db.php

```
./yii migrate/up --migrationPath=@yii/rbac/migrations
./yii migrate/up --migrationPath=@vendor/dektrium/yii2-user/migrations
./yii migrate

./yii user/create admin@admin.admin admin adminpsw
./yii user/confirm admin
./yii rbac-roles/init
```
