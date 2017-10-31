1) Git clone https://github.com/MintyMintGit/cryptocurrency.git в папку в /var/www/BlogLaravel.loc/cryptocurrency/public
2) заходим в папку и пишем composer install
3) оно подтянет зависимости
4) натроки и бд в /var/www/BlogLaravel.loc/cryptocurrency/.env либо найти файл .env.example, переименовать его и настройки
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://localhost
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
отредактировать их

5) настроки сервера должны указывать на папку /var/www/BlogLaravel.loc/cryptocurrency/public