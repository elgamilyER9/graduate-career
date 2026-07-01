# 🚀 تشغيل مشروع Graduate Career

هذه هي الأوامر الأساسية لتشغيل المشروع في بيئة التطوير:

## ⚡ أوامر التشغيل اليومي (Daily Run)

يجب تشغيل هذين الأمرين في نافذتين مختلفتين للـ Terminal:

1. **تشغيل الواجهة الخلفية (Backend):**
   ```bash
   php artisan serve
   ```

2. **تشغيل الواجهة الأمامية (Frontend):**
   ```bash
   npm run dev
   ```

---

## 🛠️ أوامر الإعداد (Setup) - تُنفذ مرة واحدة أو عند الضرورة

1. **تثبيت الملحقات (Backend Dependencies):**
   ```bash
   composer install
   ```

2. **تثبيت المكتبات (Frontend Dependencies):**
   ```bash
   npm install
   ```

3. **تحديث قاعدة البيانات (Migrations):**
   ```bash
   php artisan migrate
   ```

4. **ربط مجلد الصور والمخازن:**
   ```bash
   php artisan storage:link
   ```

---

💡 **ملاحظة:** لقد قمت بإنشاء ملف `DEV_START.bat` يمكنك النقر عليه مرتين وسيقوم بتشغيل أول أمرين تلقائياً في نوافذ منفصلة.
