# شرح مفصّل: `NotificationController` وطرق التعامل مع الإشعارات

هذا الملف يشرح `App\Http\Controllers\NotificationController.php`، الوظائف المتاحة وكيفية استخدامها من الواجهات.

الموقع: `app/Http/Controllers/NotificationController.php`

الطرق (methods) الرئيسية في الكونترولر:

1. `index()`
   - الوصف: يعرض صفحة قائمة الإشعارات للمستخدم (Blade view: `notifications.index`).
   - الإخراج: متغير `$notifications` (مصفحة `paginate(15)`).
   - استخدام: رابط القائمة في الـ navbar أو زر "View All" من الـ dashboards يؤدي إلى هذه الطريقة عبر `route('notifications.index')`.

2. `unreadCount()`
   - الوصف: يُعيد عدد الإشعارات غير المقروءة للمستخدم (JSON).
   - الإخراج: `response()->json(['count' => $count])`.
   - استخدام شائع: استدعاء AJAX لإظهار بادج العد في Navbar بشكل ديناميكي.

3. `recent()`
   - الوصف: إرجاع أحدث الإشعارات (limit 10) كمصفوفة JSON.
   - استخدام شائع: ملأ واجهة الـ dashboard بملخص سريع من دون الانتقال لصفحة كاملة.

4. `markAsRead(Notification $notification)`
   - الوصف: تعليم إشعار معين كمقروء. يستخدم `route('notifications.read', $notification)` مع HTTP verb `PATCH`.
   - حماية: يستدعي `$this->authorize('view', $notification)` للتأكد من أن المستخدم له حق عرض/التعديل.
   - التأثير: داخل الموديل `markAsRead()` (يحدّث `read = true`). ثم يعيد `back()->with('success', ...)`.

5. `markAllAsRead()`
   - الوصف: تعليم كل إشعارات المستخدم الحالية كمقروء.
   - تنفيذ: استعلام تحديثي:
```php
Notification::where('user_id', $user->id)
    ->where('read', false)
    ->update(['read' => true]);
```

6. `destroy(Notification $notification)`
   - الوصف: حذف إشعار واحد، محمي بواسطة `authorize('delete', $notification)`.

7. `clear()`
   - الوصف: حذف جميع إشعارات المستخدم.

نقاط مهمة ودمج مع الـ Frontend:
- في الـ Blade (مثال `notifications.index`) يوجد زر في الـ dropdown لكل إشعار يستدعي `route('notifications.read', $notification)` مع `@method('PATCH')`.
- لتوفير تجربة أفضل بدون إعادة تحميل الصفحة، يمكن إضافة endpoint AJAX (يوجد `recent` و `unreadCount`) أو تحويل `markAsRead` ليقبل AJAX ويرجع JSON.

أذونات (Policies):
- أشعارات تستخدم سياسة `NotificationPolicy` المسجلة في `AuthServiceProvider` للتحكم بمن يمكنه مشاهدة/حذف إشعار.

أمثلة AJAX لتمييز إشعار كمقروء (مختصر):
```js
fetch(`/notifications/${id}/read`, {
  method: 'PATCH',
  headers: { 'X-CSRF-TOKEN': token }
}).then(r => r.json()).then(data => { /* حدّث الواجهة */ });
```

خاتمة:
- الكونترولر بسيط ومباشر؛ إن أردت أضيف endpoint خاص بـ JSON responses للـ `markAsRead` مع حالة 200/403 لتمكين واجهة JavaScript أكثر سلاسة.
