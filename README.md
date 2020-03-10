# loft-project-01

## Выпускной проект №1 - "Бургерная"

1. Запросите верстку у куратора для ВП-№1.

2. Ваша задача к данной верстке добавить обработку **формы** заказа.

    Обработка заказа делится на три фазы:
    
    **Фаза 1.** Регистрация или "авторизация" пользователя.
    
    **Регистрация** происходит по полю **email**, в эту же таблицу записывается **имя** и **телефон**. В случае если пользователь уже заказывал - происходит **"авторизация"**. Никаких паролей **нет**!
    
    **Фаза 2.** Оформление заказа.
    
    Записывается в отдельную таблицу с указанием **идентификатора пользователя, адреса и деталей для доставок**.
    
    **Фаза 3.** Письмо или запись в файл.
    
    После записи данных в **БД** высылается письмо с контактами. **Заголовок** - заказ №{id}, где **id** - это уникальный номер записи заказа. Под заголовком: **"Ваш заказ будет доставлен по адресу"**. Адрес содержит данные из БД или формы. Содержимое заказа всегда одинаковое - **DarkBeefBurger за 500 рублей 1 шт**, нигде в базе не хранится, только высылается в письме. Внизу, под заказом идет дополнительная строка - **"Спасибо - это ваш первый заказ"** или **"Спасибо! Это уже 555 заказ"**, где **555** - это количество раз, сколько пользователь заказал. Письмо высылается функцией `mail` или записывается с помощью функции `file_put_contents` в отдельную папку с временем отправки. Красивая верстка не требуется, достаточно разделения строк.

3. Предусмотреть простейшую административную панель. В админ-панели выводится:

* Cписок всех зарегистрированных пользователей.
* Cписок всех заказов.

Авторизации и паролей для доступ в админ панель НЕТУ, доступ только по `URL`. Информацию об `URL` запишите в конце `readme.md`.

**Ссылка на административную панель: /admin.php**
