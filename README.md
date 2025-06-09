![image](https://github.com/KM-ITERA/KM-ITERA-2023/assets/86707999/5f1552b2-b235-4ef8-b079-d563f97777fd)

![image](https://github.com/KM-ITERA/KM-ITERA-2023/assets/86707999/a133e84c-75e4-4c23-b65e-cac6472f7485)

![image](https://github.com/KM-ITERA/KM-ITERA-2023/assets/86707999/27898fe7-85e1-429f-9e79-e13506fcd3db)

![image](https://github.com/KM-ITERA/KM-ITERA-2023/assets/86707999/c3e58d45-ef7e-412d-8042-0cda0cac5825)

![image](https://github.com/KM-ITERA/KM-ITERA-2023/assets/86707999/596fbfde-d152-4df5-b3ca-82d225494671)

![image](https://github.com/KM-ITERA/KM-ITERA-2023/assets/86707999/e4b28e4c-ce68-4f56-8207-cd7ee3a41be4)

![image](https://github.com/KM-ITERA/KM-ITERA-2023/assets/86707999/e490b2a6-43b0-4da8-9750-e315781c69f1)

![image](https://github.com/KM-ITERA/KM-ITERA-2023/assets/86707999/8e6098b3-6d1c-436d-96a0-2e6475f97ac1)

# Api

Contoh Penggunaan []()

## Mendapatkan api key

untuk mengakses api diperlukan api key yang dapat di generate dengan perintah

```
$ php artisan apikey:generate {nama api key}
```

kemudian untuk melihat daftar api bisa menggunakan perintah

```
$ php artisan apikey:list
```

## Middleware

Jika diperlukan middleware dengan menggunakan apikey, pada routes dapat ditambahkan

```php
Route::middleware("auth.apikey")->group(function() {
    // routes
});
```

atau

```php
Route::get(...)->middleware('auth.apikey');
```

dokumentasi lengkap tentang middleware dapat dibaca di [Laravel Middleware](https://laravel.com/docs/11.x/middleware)

## Menggunakan API

pada saat melakukan fetch api,di header tambahkan

```
X-Authorization : {apikey}
```
