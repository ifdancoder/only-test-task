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
- api/car-models - GET - Получение списка доступных пользователю моделей автомобилей
- api/comfort-categories - GET - Получение списка доступных пользователю категорий комфорта
- api/car-booking - POST - Бронирование автомобиля на заданный интервал времени - (параметры: start_datetime, end_datetime, car_id)
- api/available-cars - GET - Получение доступных в заданный интервал автомобилей, соответствующих позиции пользователя - (параметры: start_datetime, end_datetime, comfort_category_id, model_id)
