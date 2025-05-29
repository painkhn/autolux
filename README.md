# Магазин продажи люксовых авто

## Содержание
- [Технологии](#технологии)
- [Тестирование](#тестирование)

## Технологии
- [Laravel](https://laravel.com/)
- [Tailwind](https://tailwindcss.com/)

## Разработка

### Требования
Для установки и запуска проекта, необходим:
 - [NodeJS](https://nodejs.org/) v19+
 - [PHP](https://www.php.net/) v8+
 - [Composer](https://getcomposer.org/)

### Установка зависимостей
Для установки зависимостей, выполните команду:
```sh
$ npm i
```
Для установки необходимых пакетов, выполните команду: 
```sh
$ composer i
```
Создать файл конфигурации с примера и отредактировать его
```sh
$ сopy .env.example .env
```
Создать ключ приложения 
```sh
$ php artisan key:generate
```
Создать таблицы в БД
```sh
$ php artisan migrate
```
### Запуск приложения 
Для запуска приложения необходимо запустить 2 сервера командами: 
```sh
$ php artisan serve
```
```sh
$ npm run dev
```
## Тестирование
Проект покрыт Unit-тестами. Для их запуска выполните команду:
```sh
$ php artisan test
```

### Авторизация через GitHub
Для настройки авторизации необходимо создать [приложение](https://github.com/settings/developers)
- Настроить .env
```
GITHUB_CLIENT_ID=""
GITHUB_CLIENT_SECRET=""
GITHUB_CLIENT_CALLBACK="http://127.0.0.1:8000/login/github/callback"
```
