
## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Veritabanı

Veritabanı laravel framework ünden bağımsız 3 custom tablodan oluşmaktadır.

- ```messages``` (Mesaj Gönderim Bilgisi vs. Tutulur)
- ```message_contacts``` (Mesaj Gönderimi Yapılacak Kişi Bilgileri Tutulur)
- ```message_templates``` (Mesaj Şablon Bilgileri Tutulur)


## Çalışma Yapısı

- MessagesController ında bulunan SendMessages Metodu tetiklendikten sonra job http://localhost:8000/api/messages/send-messages job queue ya alınır
- Farklı bir terminalde ```php artisan queue:work``` ile kayıtlar işlenmeye başlanır.

## Swagger/OpenAPI
http://127.0.0.1:8000/api/documentation
