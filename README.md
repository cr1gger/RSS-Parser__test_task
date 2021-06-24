**Требованя**
1. PHP >= 7.0
2. PostgreSQL
3. Linux
4. Composer < 2.0 (на данный момент у 2 версии композера проблемы с некоторыми пакетами Yii2)

****Установка и запуск:****
1. Склонировать проект
2. Выполнить `composer install`
3. Создать файл db.php на основе db_example.php и ввести данные от базы данных PostgreSQL
4. Выполнить `php yii migrate`
5. Настроить свой путь до папки с проектом в ExecStart в файле **parser-daemon.service**
6. Переместить файл **parser-daemon.service** по пути `/etc/systemd/system/`
7. Перезапустить systemctl: `systemctl daemon-reload`
8. Добавить демон в автозагрузку `systemctl enable parser-daemon.service`
9. Запускаем демона: `systemctl start parser-daemon.service`

**Задача**
Полная задача здесь: [https://drive.google.com/file/d/1BdwObaPK_7kFWYHblyx0ErXu6nxWdA9P/view?usp=sharing][Google Drive]

[Google Drive]: https://drive.google.com/file/d/1BdwObaPK_7kFWYHblyx0ErXu6nxWdA9P/view?usp=sharing