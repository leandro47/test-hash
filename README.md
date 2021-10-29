
## php-search-hash

## Installation

clone this project 

```bash
git clone https://github.com/leandro47/test-hash.git
```

install dependencies

```bash
composer install
```

configure your database in `.env` including full database path, ex `/media/username/home/test-hash/database/db.sqlite`

```bash
DB_CONNECTION=sqlite
DB_DATABASE=/your/full/path 

```
start project with commands bellow

```bash
php artisan migrate:fresh
php artisan key:generate
php artisan serve
```

## Documentation

for generate hash use this command as example
```bash
php artisan hash:search testword --request=3

```
output:
```bash
Command executed
```

View the results in `http://127.0.0.1:8000/hash/generated/`

``` json 
{
  "number": {
    "current_page": 1,
    "data": [
      {
        "batch": "2021-10-29 04:51:33",
        "block": "11",
        "enter_word": "test",
        "key_found": "WNDZ8mqN"
      },
      {
        "batch": "2021-10-29 04:51:34",
        "block": "12",
        "enter_word": "000012d39a221ad9d0e46b56d875e0c3",
        "key_found": "0VHWn3TH"
      },
      {
        "batch": "2021-10-29 04:51:34",
        "block": "13",
        "enter_word": "00001ca6c814fcb9a0aed15d94ce01a0",
        "key_found": "rTiSdYiD"
      }
    ],
    "first_page_url": "http://127.0.0.1:8000/hash/generated?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/hash/generated?page=1",
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/hash/generated?page=1",
        "label": "1",
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/hash/generated",
    "per_page": 20,
    "prev_page_url": null,
    "to": 3,
    "total": 3
  }
}
```
you can filter the results by inserting a parameter in the url, so it will only get the results where the number of attempts is better than the number informed.

### Example
`http://127.0.0.1:8000/hash/generated/23844`

output:

``` json
{
  "number": {
    "current_page": 1,
    "data": [
      {
        "batch": "2021-10-29 04:51:34",
        "block": "12",
        "enter_word": "000012d39a221ad9d0e46b56d875e0c3",
        "key_found": "0VHWn3TH"
      }
    ],
    "first_page_url": "http://127.0.0.1:8000/hash/generated/23844?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/hash/generated/23844?page=1",
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://127.0.0.1:8000/hash/generated/23844?page=1",
        "label": "1",
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/hash/generated/23844",
    "per_page": 20,
    "prev_page_url": null,
    "to": 1,
    "total": 1
  }
}
```