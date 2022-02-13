## TUTORIAL INSTALASI

- composer install
- php artisan migrate:refresh
- php artisan optimize
- php artisan serve

## TASK LIST
- [x] Order Payment -- used to create payment order
    - [x] a. Amount should be positive;
    - [x] Expired value should be future date with the exact format as shown by the example;
    - [x] Resulted amount = input amount + fee, fee is 2500.
    - [x] Code holds the payment code, composed from prefix “8834” and hp value.
- [x] Payment -- used to inform payment has been occurred
    - [x] Response with status field contains one of the following:
    - [x] i. “paid” for the first payment;
    - [x] ii. “expired “ for any expired payment,
    - [x] b. Reject all unknown reff or double payments with HTTP code 403.
    - [x] c. On any valid request, put a copy of the payment transaction record into another different
    - [x] table (let’s call it transaction backup table) using the event/job mechanism.
- [x] Check Status -- used to check the payment status
    - [x] simply load the data found, otherwise reply with HTTP code 403.

## Example requests
- Header must be set "Sec-Token", "yyyyMMdd" (current date)

1. http://localhost:8000/api/v1/transaksi/order?amount=100000&reff=2000837451&expired=2022-02-14T16%3A12%3A48%2B07%3A00&name=Nama+Pelanggan&hp=081854323334

2. http://localhost:8000/api/v1/transaksi/payment?reff=2000837451
    - reff=2000837450 NotFound
    - reff=2000837451 Falid
    - reff=2000837452 Duplicate reff

3. http://localhost:8000/api/v1/transaksi/status?reff=2000837451
    - reff=2000837450 NotFound
    - reff=2000837451 Falid 1 data
    - reff=2000837452 Falid 2 data