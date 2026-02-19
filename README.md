# Веб-сервис “Заявки в ремонтную службу”

## Запуск проекта

1. Установить PHP 8+
2. Создать базу данных MySQL
3. Выполнить миграции:

mysql -u root -p db_name < migrations/001_create_tables.sql

4. Заполнить тестовыми данными:

mysql -u root -p db_name < seeds/seed.sql

5. Настроить config/db.php (доступ к БД)

6. Запустить локально:

php -S localhost:8000

7. Открыть:

http://localhost:8000
