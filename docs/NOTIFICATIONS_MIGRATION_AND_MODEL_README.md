# شرح مفصّل: ميجريشن وجدول `notifications` والموديل

هذا الملف يشرح بالتفصيل الميجريشن الموجود في `database/migrations/2026_03_01_000001_create_notifications_table.php` وموديل `App\Models\Notification`.

1) هيكل الميجريشن
- اسم الملف: `2026_03_01_000001_create_notifications_table.php`
- جدول: `notifications`

الأعمدة الأساسية في الجدول:
- `id` (big integer auto-increment primary key)
- `user_id` (foreignId -> references `users.id`) مع `onDelete('cascade')` بحيث تُحذف الإشعارات عند حذف المستخدم
- `type` (string): نوع الإخطار مثل `job_application_received`, `new_message`، إلخ
- `title` (string): عنوان الإخطار المعروض للمستخدم
- `description` (text): وصف أطول أو محتوى الإخطار
- `data` (json, nullable): حقل مرن لتخزين بيانات إضافية (مثل `job_id`, `mentorship_id`)
- `notifiable_type` و `notifiable_id` عبر `nullableMorphs('notifiable')`: علاقة polymorphic لربط الإخطار بأي نموذج مرتبط (مثل `JobApplication` أو `Message`)
- `read` (boolean) مع القيمة الافتراضية `false` لتمييز ما إذا قرأ المستخدم الإخطار
- `created_at` و `updated_at` (timestamps)

مؤشرات (indexes):
- index على `[user_id, read]` لتحسين استعلامات العد للغير مقروءة
- index على `created_at` للترتيب السريع حسب الأحدث

ملاحظات تنفيذية:
- تأكد أن جدول `users` موجود قبل تشغيل هذا الميجريشن لأن `user_id` معرف كـ foreign key.
- لتشغيل الميجريشن منفردًا:
```bash
php artisan migrate --path=database/migrations/2026_03_01_000001_create_notifications_table.php
```

2) موديل: `App\Models\Notification`

- المسار: `app/Models/Notification.php`
- الخصائص (`$fillable`): `user_id`, `type`, `title`, `description`, `data`, `read`, `notifiable_type`, `notifiable_id`
- التحويلات (`$casts`):
  - `data` => `array` (يسمح بالتعامل مع الحقل JSON كمصفوفة/أوبجكت في PHP)
  - `read` => `boolean`
  - `created_at` و `updated_at` => `datetime`

- العلاقات:
  - `user()` : `belongsTo(User::class)` — المستخدم المالك للإشعار
  - `notifiable()` : `morphTo()` — العنصر المرتبط polymorphically (مثال: `JobApplication`)

- طرق مساعدة داخل الموديل:
  - `markAsRead()` : تحدّث الحقل `read` إلى `true`
  - `markAsUnread()` : تحدّث الحقل `read` إلى `false`
  - `unreadCount($userId)` : static helper لإرجاع عدد الإشعارات غير المقروءة
  - `recent($userId, $limit = 20)` : static helper لإرجاع الإشعارات الأحدث

أمثلة استخدام سريعة:
- إرسال إشعار عبر `NotificationService`:
```php
\App\Services\NotificationService::send(
    $user, // instance of App\Models\User
    'job_application_received',
    'New application',
    'A student applied to your job post',
    ['job_id' => $job->id],
    $jobApplication // optional polymorphic notifiable
);
```

- قراءة عدد الإشعارات غير المقروءة في الكود/الـ Blade:
```php
$count = \App\Models\Notification::unreadCount(auth()->id());
```

3) نصائح وصيانة
- إذا رغبت بدعم البحث النصي الكامل داخل `description` أو `title` فكر باستخدام MySQL fulltext أو محرك بحث مثل Scout/Meilisearch.
- راعِ تنظيف الحقول `data` عند استقبال بيانات كبيرة أو حساسة قبل الحفظ.

انتهى الشرح للموديل والميجريشن.
