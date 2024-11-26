
## Setup


## Veritabanı

Veritabanı laravel framework ünden bağımsız 3 custom tablodan oluşmaktadır.

- ```messages``` (Mesaj Gönderim Bilgisi vs. Tutulur)
- ```message_contacts``` (Mesaj Gönderimi Yapılacak Kişi Bilgileri Tutulur)
- ```message_templates``` (Mesaj Şablon Bilgileri Tutulur)


## Çalışma Yapısı

- MessagesController ında bulunan SendMessages Metodu tetiklendikten sonra job http://localhost:8000/api/messages/send-messages job queue ya alınır
- Farklı bir terminalde ```php artisan queue:work``` ile kayıtlar işlenmeye başlanır.

## Swagger/OpenAPI
- Öncelikle ```/api/messages (Mesaj Gönder)``` çalıştırılıp sonrasında ```/api/messages/send-messages (Job Tetikle)``` çalıştırıldıktan sonra queue da sıraya alınır ve queue işlemeye başladığı zaman ilgili alanlar güncellenir.

http://127.0.0.1:8000/api/documentation
