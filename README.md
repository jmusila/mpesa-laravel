## MPESA Laravel
### Getting Started
- Clone this repository `$ git clone https://github.com/jmusila/discount_calc.git`
- Navigate to the cloned repository

### Prerequisites
```
PHP 7.4+
MySQL
Composer

```

### Installation
- After cloning this repo:
    - Create .env on the root directory and copy .env_exmaple content to it
    - Add the following to the .env file
        - `MPESA_CONSUMER_KEY="your_consumer_key"`
        - `MPESA_CONSUMER_SECRET="your_secret_key"`
        - `MPESA_BASE_URL="safaricom_sandbox_url"`
        - `MPESA_ENV="sandbox"`
        - `MPESA_PASS_KEY="valid_pass_key"`
        - `MPESA_BUSINESS_CODE="business_code"`
        - `MPESA_STK_URL="sanbox_stk_push_url"`
        - `MPESA_MOBILE_NUMBER="vali_mobile_number"`
        - `MPESA_CALL_BACK_URL="https://someurl.com/path"`
        - `MPESA_AUTO_REFERENCE="SOME REFERENCE"`
    - Create database and add database configurations on the .env file
    - Run `$ composer install` to install dependancies
    - Run `$ php artisan key:generate` to generate app key

### Testing on Postman
- Run `$ php artisan serve` to start the server
- Test the following endpoint:
- Heroku BASE_URL `$ https://my-mpesa-laravel.herokuapp.com`

| EndPoint                       | Functionality                           |
| -------------------------------|:---------------------------------------:|
| POST /api/v1/token             | Get Genarated MPESA token               |
| POST /api/v1/stk/push          |  STK Push to the Customer               |

