# CMDB (PHP + MySQL)

## Setup

1. Create MySQL database and user:

```
CREATE DATABASE cmdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'cmdb_user'@'%' IDENTIFIED BY 'cmdb_pass';
GRANT ALL PRIVILEGES ON cmdb.* TO 'cmdb_user'@'%';
FLUSH PRIVILEGES;
```

2. Import schema:

```
mysql -h 127.0.0.1 -u cmdb_user -p cmdb < database/schema.sql
```

3. Configure environment (optional):

Set environment variables:
- CMDB_DB_HOST (default: 127.0.0.1)
- CMDB_DB_PORT (default: 3306)
- CMDB_DB_NAME (default: cmdb)
- CMDB_DB_USER (default: cmdb_user)
- CMDB_DB_PASS (default: cmdb_pass)

4. Serve with Apache:

- DocumentRoot to `php-cmdb/public`
- Enable `mod_rewrite`
- Example vhost:

```
<VirtualHost *:80>
    ServerName cmdb.local
    DocumentRoot "C:/path/to/php-cmdb/public"

    <Directory "C:/path/to/php-cmdb/public">
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog "logs/cmdb-error.log"
    CustomLog "logs/cmdb-access.log" common
</VirtualHost>
```

5. Visit http://cmdb.local/.

## Notes
- Minimal MVC without frameworks.
- Routes in `public/index.php`.
- Views in `app/Views`.


