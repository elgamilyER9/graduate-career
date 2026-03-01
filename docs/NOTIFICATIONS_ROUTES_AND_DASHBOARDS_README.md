# شرح الربط: `routes/web.php` وكيف تعرض الإشعارات داخل صفحات الـ Dashboard

هذا الملف يشرح اختصارات المسارات (routes) المتعلقة بالإشعارات وكيف ترتبط بملفات الـ Blade: `resources/views/dashboards/user.blade.php`, `admin.blade.php`, `mentor.blade.php`.

1) المقاطع المهمة من `routes/web.php`

- مسارات الإشعارات الأساسية (موجودة في `routes/web.php`):
```php
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread.count');
Route::get('/notifications/recent', [NotificationController::class, 'recent'])->name('notifications.recent');
Route::patch('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::patch('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read.all');
Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
Route::delete('/notifications', [NotificationController::class, 'clear'])->name('notifications.clear');
```

- ملاحظات:
  - `index` يعرض صفحة Blade قابلة للتصفح وPagination.
  - `unreadCount` و `recent` تمهيديان للاستخدام عبر AJAX في الـ Navbar والـ Dashboards.

2) كيف تُعرض داخل ملفات الـ Dashboard

- ملفات الـ Blade:
  - `resources/views/dashboards/user.blade.php`
  - `resources/views/dashboards/admin.blade.php`
  - `resources/views/dashboards/mentor.blade.php`

- ما تم تنفيذه في هذه الملفات:
  - كل لوحة تسحب عدد الإشعارات غير المقروءة والـ 5 إشعارات الأحدث عبر:
    ```php
    $unreadNotifications = Auth::user()->notifications()->where('read', false)->count();
    $recentNotifications = Auth::user()->notifications()->orderBy('created_at', 'desc')->take(5)->get();
    ```
  - تُعرض العناصر داخل بطاقة (card) صغيرة في أعلى الـ dashboard مع زر `View All` يوجّه إلى `route('notifications.index')`.
  - لكل إشعار جديد (غير مقروء) يظهر زر صغير لتمييزه كمقروء والذي ينادي `route('notifications.read', $notification)` عبر `PATCH`.

3) أمثلة على استدعاءات في الـ Blade

- زر عرض الكل:
```blade
<a href="{{ route('notifications.index') }}" class="btn btn-sm btn-outline-primary">{{ __('View All') }}</a>
```

- زر تمييز إشعار كمقروء (داخل كل عنصر إشعار):
```blade
<form action="{{ route('notifications.read', $notification) }}" method="POST">
    @csrf
    @method('PATCH')
    <button type="submit" class="btn btn-sm">{{ __('Mark as read') }}</button>
</form>
```

4) تحسينات مقترحة
- لجعل العد في الـ Navbar يتحدث مباشرة دون إعادة تحميل الصفحة: استدعاء `/notifications/unread-count` كل 20-30 ثانية أو استخدام WebSockets (Pusher/laravel-echo) لإرسال الإشعار لحظيًا.
- لتجربة محسّنة: استخدام AJAX لطلبات `markAsRead` و `markAllAsRead` ثم تحديث الـ DOM (إزالة badge أو تقليل العدد).

5) خرائط الربط (short summary)
- `route('notifications.index')` → صفحة كاملة لقراءة/حذف الإشعارات
- `route('notifications.recent')` → API قصير لسحب أحدث الإشعارات (لـ dashboard)
- `route('notifications.unread.count')` → API لعد الإشعارات غير المقروءة (لـ navbar badges)

الملفات التي عدّلت لعرض زر التحديد كمقروء:
- `resources/views/dashboards/user.blade.php`
- `resources/views/dashboards/admin.blade.php`
- `resources/views/dashboards/mentor.blade.php`

انتهى الشرح — أخبرني إذا تحب أضيف أمثلة JS/AJAX جاهزة لدمجها مباشرة في الـ Blade.
