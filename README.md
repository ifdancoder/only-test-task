## Используемые таблицы в бд
- cars
- car_bookings
- car_models
- comfort_categories
- migrations
- personal_access_tokens
- users
- user_positions
- user_positions_comfort_categories

## Методы API и их параметры
- api/register - POST - Регистрация и получение Bearer-токена - (параметры: name, email, password)
- api/login - POST - Аутентификация и получение Bearer-токена - (параметры: email, password)
- api/car-models - GET - Получение списка доступных пользователю моделей автомобилей (Необходима аутентификация по Bearer-токену из одного из первых двух методов)
- api/comfort-categories - GET - Получение списка доступных пользователю категорий комфорта (Необходима аутентификация по Bearer-токену из одного из первых двух методов)
- api/car-booking - POST - Бронирование автомобиля на заданный интервал времени - (параметры: start_datetime, end_datetime, car_id) (Необходима аутентификация по Bearer-токену из одного из первых двух методов)
- api/available-cars - GET - Получение доступных в заданный интервал автомобилей, соответствующих позиции пользователя - (параметры: start_datetime, end_datetime, comfort_category_id, model_id) (Необходима аутентификация по Bearer-токену из одного из первых двух методов)

## Чтобы поднять контейнеры Docker для работы API (в системе нужен docker и docker-compose), нужно:
- Зайти в папку проекта
- Зайти в папку docker
- Прописать в консоли: docker-compose up -d

## P.S.
Реализованы только методы API, необходимые для данного ТЗ. Предполагается, что остальной функционал (выбор позиций пользователя, указывание водителя) в других модулях приложения. Для теста есть два пользователя с разными позициями: pos1user@gmail.com, pos2user@gmail.com. У них одинаковый пароль: 12345678.
