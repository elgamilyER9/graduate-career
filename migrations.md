# هيكل قاعدة البيانات (Database Migrations Schema)

هذا الملف يحتوي على توثيق لجميع الجداول وقواعد البيانات والأعمدة الخاصة بكل جدول بناءً على ملفات الـ Migrations.

---

## 🏗️ 1. الجداول الأساسية للمستخدمين والتصريحات

### جدول `users` (المستخدمون)
الجدول الأساسي الذي يحتوي على بيانات جميع مستخدمي النظام (الخريجين، الإدارة، الموجهين).
* `id`: المُعرّف الأساسي
* `name`: اسم المستخدم (String)
* `email`: البريد الإلكتروني (String, Unique)
<!-- * `email_verified_at`: تاريخ توثيق البريد الإلكتروني (Timestamp, Nullable) -->
* `password`: كلمة المرور (String)
* `role`: دور المستخدم في النظام (`user`, `admin`, `mentor` - Default: `user`)
<!-- * `remember_token`: رمز تذكر تسجيل الدخول (String) -->
* `cv`: السيرة الذاتية المرفوعة (String, Nullable)
* `university_id`: مُعرّف الجامعة (Foreign Key للمقرّ, Nullable)
* `faculty_id`: مُعرّف الكلية (Foreign Key, Nullable)
* `career_path_id`: مُعرّف المسار المهني (Foreign Key, Nullable)
* `phone`: رقم الهاتف (String, Nullable)
* `bio`: نبذة تعريفية (Text, Nullable)
* `job_title`: المسمى الوظيفي (String, Nullable)
* `company`: الشركة الحالية (String, Nullable)
* `years_experience`: سنوات الخبرة (Integer, Nullable)
<!-- * `linkedin_url`: رابط حساب لينكد إن (String, Nullable) -->
* `other_university`: اسم جامعة أخرى في حال عدم وجودها في النظام (String, Nullable)
* `other_faculty`: اسم كلية أخرى في حال عدم وجودها (String, Nullable)
* `other_career_path`: مسار مهني آخر في حال عدم الوجود (String, Nullable)
* `linkedin_id`: مُعرّف حساب لينكد إن لتسجيل الدخول (String, Unique, Nullable)
* `linkedin_avatar`: صورة الحساب من لينكد إن (String, Nullable)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

<!-- ### جدول `password_reset_tokens` (رموز إعادة تعيين كلمات المرور)
* `email`: البريد الإلكتروني (Primary Key, String)
* `token`: رمز إعادة التعيين (String)
* `created_at`: تاريخ إنشاء الرمز (Timestamp, Nullable) -->

### جدول `sessions` (الجلسات)
* `id`: مُعرّف الجلسة (Primary Key, String)
* `user_id`: مُعرّف المستخدم (Foreign Key, Nullable, Index)
* `ip_address`: عنوان الـ IP (String, Nullable)
* `user_agent`: المتصفح والبيانات المستخدمة (Text, Nullable)
* `payload`: محتوى الجلسة (LongText)
* `last_activity`: آخر نشاط (Integer, Index)

### جدول `jobs` (قوائم انتظار العمليات - Queue)
* `id`: المُعرّف الأساسي
* `queue`: اسم طابور المهام (String)
* `payload`: بيانات المهمة (LongText)
* `attempts`: عدد محاولات التنفيذ (TinyInteger)
* `reserved_at`: تاريخ الحجز (Integer, Nullable)
* `available_at`: تاريخ الإتاحة (Integer)
* `created_at`: تاريخ الإنشاء (Integer)

---

## 🎓 2. البيانات التعليمية والمهنية

### جدول `universities` (الجامعات)
* `id`: المُعرّف الأساسي
* `name`: اسم الجامعة (String)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

### جدول `faculties` (الكليات)
* `id`: المُعرّف الأساسي
* `name`: اسم الكلية (String)
* `university_id`: مُعرّف الجامعة التي تتبع لها الكلية (Foreign Key)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

### جدول `career_paths` (المسارات المهنية)
* `id`: المُعرّف الأساسي
* `name`: اسم المسار المهني (String)
* `description`: وصف المسار (Text, Nullable)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

### جدول `skills` (المهارات)
* `id`: المُعرّف الأساسي
* `name`: اسم المهارة (String)
* `career_path_id`: مُعرّف المسار المهني المرتبطة به المهارة (Foreign Key)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

---

## 💼 3. الوظائف والتطوير المهني

### جدول `job_listings` (قوائم الوظائف)
* `id`: المُعرّف الأساسي
* `title`: المسمى الوظيفي المعلن عنه (String)
* `company`: اسم الشركة المعلنة (String, Nullable)
* `career_path_id`: المسار المهني للوظيفة (Foreign Key)
* `mentor_id`: مُعرّف الموجّه أو الناشر الخاص بالوظيفة (Foreign Key, Nullable)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

### جدول `job_applications` (طلبات التقدم للوظائف)
* `id`: المُعرّف الأساسي
* `user_id`: مُعرّف المستخدم المُتقدم للوظيفة (Foreign Key)
* `job_id`: مُعرّف الوظيفة المُتقدم إليها (Foreign Key)
* `mentor_id`: مُعرّف الموجّه المشرف (Foreign Key, Nullable)
* `status`: حالة الطلب (`pending`, `approved`, `rejected` - Default: `pending`)
* `notes`: ملاحظات عن الطلب (Text, Nullable)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل
*(ملاحظة: هذا الجدول يمنع تكرار التقديم لنفس الوظيفة عن طريق قيد مخصص Unique Index على `user_id` و `job_id`)*

### جدول `trainings` (التدريبات)
* `id`: المُعرّف الأساسي
* `title`: عنوان التدريب (String)
* `name`: اسم التدريب أو بديل لـ العنوان (String, Nullable)
* `description`: وصف التدريب (Text, Nullable)
* `provider`: مقدّم التدريب (String, Nullable)
* `career_path_id`: المسار المهني المستهدف (Foreign Key)
* `mentor_id`: مُعرّف الموجّه المسؤول (Foreign Key, Nullable)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

### جدول `training_enrollments` (التسجيل في التدريبات)
* `id`: المُعرّف الأساسي
* `training_id`: مُعرّف التدريب المُسجل فيه (Foreign Key)
* `user_id`: مُعرّف المستخدم المُسجل (Foreign Key)
* `status`: حالة التسجيل (`enrolled`, `completed`, `dropped` - Default: `enrolled`)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل
*(ملاحظة: يمنع تكرار التسجيل لنفس التدريب عن طريق قيد Unique)*

---

## 🤝 4. التوجيه والمحادثات

### جدول `mentorship_requests` (طلبات التوجيه)
* `id`: المُعرّف الأساسي
* `user_id`: مُعرّف المستخدم طالب التوجيه (Foreign Key)
* `mentor_id`: مُعرّف الموجه المطلوب (Foreign Key)
* `status`: حالة الطلب (`pending`, `approved`, `rejected` - Default: `pending`)
* `message`: نص رسالة الطلب المرفقة (Text, Nullable)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

### جدول `messages` (الرسائل المباشرة)
* `id`: المُعرّف الأساسي
* `sender_id`: مُعرّف المرسل (Foreign Key)
* `receiver_id`: مُعرّف المتلقي (Foreign Key)
* `body`: محتوى الرسالة (Text)
* `read`: حالة قراءة الرسالة (Boolean, Default: false)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

---

## 🔔 5. الإشعارات والملفات والأحداث

### جدول `notifications` (الإشعارات)
* `id`: المُعرّف الأساسي
* `user_id`: مُعرّف المستخدم المستلم للإشعار (Foreign Key)
* `type`: نوع الإشعار مثل job_application, message (String)
* `title`: عنوان الإشعار (String)
* `description`: وصف تفصيلي وتنويه (Text)
* `data`: بيانات إضافية متعلقة بالإشعار (JSON, Nullable)
* `notifiable_type`, `notifiable_id`: حقول Morphable لربط الإشعار بجدول أي نموذج آخر (Nullable)
* `read`: حالة رؤية الإشعار (Boolean, Default: false)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

### جدول `activity_logs` (سجلات الأنشطة)
* `id`: المُعرّف الأساسي
* `user_id`: مُعرّف المستخدم صاحب النشاط (Foreign Key)
* `action`: الإجراء الذي حدث (مثل 'create', 'update', 'delete', 'view') (String)
* `description`: وصف الإجراء (Text)
* `model_type`, `model_id`: حقول Morphable لربط السجل بسجل قاعدة بيانات آخر (Nullable)
* `old_values`: القيم القديمة قبل التعديل (JSON, Nullable)
* `new_values`: القيم الجديدة بعد التعديل (JSON, Nullable)
* `ip_address`: عنوان الـ IP المُنفذ للإجراء (IP Address, Nullable)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل

### جدول `files` (إدارة الملفات والمرفقات الموحدة)
* `id`: المُعرّف الأساسي
* `user_id`: مُعرّف المستخدم صاحب الملف (Foreign Key)
* `name`: اسم الملف (String)
* `path`: مسار حفظ الملف في النظام (String)
* `type`: نوع تصنيف الملف (مثل 'resume', 'certificate', 'portfolio') (String)
* `mime_type`: الامتداد ونوع الميديا الفعلية للملف (String)
* `size`: حجم الملف بالـ Bytes (BigInteger)
* `fileable_type`, `fileable_id`: حقول Morphable لربط المرفق بأي موديل آخر (Nullable)
* `created_at`, `updated_at`: تواريخ الإنشاء والتعديل
