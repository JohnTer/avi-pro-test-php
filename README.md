# PHP сервис генерации случайных значений
### // Этот же сервис написанный на Golang (+ Docker) доступен по адресу https://github.com/JohnTer/avi-pro-test-go

Сервис реализует JSON API работающее по HTTP. 

Реализованы методы:
* POST /api/generate/ - генерация случайного значения и его идентификатора
* GET /api/retrieve/ - получение значения по id, которое вернулось в методе generate

### POST
Доступен по адресу /api/generate/

В теле запроса содержится JSON-объект вида:

```json
{
  "randType": "str",
  "intRange": [1,5],
  "extAlphabet": "abc123",
  "strLen": 5
}
```
Поле *randType* содержит тип значения, которое необходимо сгенерировать, является обязательным полем для всех запросов. Обязательность остальных полей зависит от типа генерируемого объекта. Поддерживаются следующие типы:

* str - случайная строка из символов a-z длины *strLen*. (Обязательные поля: *strLen*)
* num - случайное число из диапазона *intRange*. (Обязательные поля: *intRange*)
* strnum - случайная строка из символов a-z 0-9 длины *strLen*. (Обязательные поля: *strLen*)
* uuid - универсальный уникальный идентификатор.
* extstr - случайная строка из символов алфавита *extAlphabet* длины *strLen*. (Обязательные поля: *strLen*, *extAlphabet*)

В ответ возвращается JSON-объект вида:

```json
{
    "data": "24bb1139-d8f0-4c54-8141-137a552890b2",
    "err": 0
}
```

который содержит в поле *data* id сгенерированного объекта. В поле *err* содержится 1, если объект сгенерировать не удалось и 0 в ином случае.

### GET
Доступен по адресу /api/generate/?id=<id объекта>

Где в <id объекта> содержится id объекта, который необходимо получить. Все сгенерированные объекты сохраняются в БД (Sqlite), поэтому их можно получить в любое время.

В ответ возвращается JSON-объект вида:

```json
{
    "data": "azxdghy",
    "err": 0
}
```

который содержит в поле *data* сгенерированное значение. В поле *err* содержится 1, если объект получить не удалось и 0 в ином случае.
