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
- api/register - POST - (параметры: name, email, password)
- api/login - POST - (параметры: email, password)
- api/car-models - GET - 
- api/comfort-categories - GET - 
- api/car-booking - POST - (параметры: start_datetime, end_datetime, car_id)
- api/available-cars - GET - (параметры: start_datetime, end_datetime, comfort_category_id, model_id)
