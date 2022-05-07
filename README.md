# INTERVOLGA-task

## Описание
По итогу выходит небольшой REST API микро-сервис с взаимодействием SQLite бд. Полезный опыт написания архитектуры сервиса с нуля на незнакомом для меня языке.

## Тестирование
Для тестирования локальный сервер запускал не используя сторонних сервисов, только на самом php и post запросы делались с помощью Postman
> $ php localhost:8080 -t public public/index.php
1. HelloWorld в браузере
>     localhost:<port>/hello
2. Создание таблицы SQLite делал так же в браузере запросом
>     localhost:<port>/create

  3. Получение отзыва по ID
  >     localhost:<port>/api/feedbacks/{id}
  4. Получения списка отзывов со смещением 20 штук на страницу, имеется опциональный GET запрос для номера страницы
  >     localhost:<port>/api/feedbacks?page=1
  5. POST запрос на добавление отзыва в БД работающий с телом запроса в формате JSON
  >     localhost:<port>/api/feetbacks/add
  6. DELETE запрос для удаления отзыва из БД, доступный только по Basic-аутентификации в заголовках запроса
  >     localhost:<port>/api/feedbacks/delete/{id}'

