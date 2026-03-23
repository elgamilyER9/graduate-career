# Implementation Guide - New Features Setup

## What Was Added?

I've added **5 major features** to enhance your Graduate Career Platform:

1. ✅ **Notification System** - In-app notifications for important events
2. ✅ **Activity Logging** - Track all user actions for auditing
3. ✅ **Global Search** - Search across jobs, trainings, mentors, and skills
4. ✅ **File Management** - Upload resumes, certificates, and documents
5. ✅ **Advanced Authorization** - Fine-grained access control with policies

---

## Step 1: Run Migrations

Execute the database migrations to create the necessary tables:

```bash
php artisan migrate
```

This will create:
- `notifications` table - Stores in-app notifications
- `activity_logs` table - Records user activities
- `files` table - Manages file uploads

---

## Step 2: Create Storage Link

Make uploaded files accessible from the public directory:

```bash
php artisan storage:link
```

This creates: `public/storage` → `storage/app/public`

---

## Step 3: New Files Created

### Models
- `app/Models/Notification.php` - Notification management
- `app/Models/ActivityLog.php` - Activity tracking
- `app/Models/File.php` - File management

### Controllers
- `app/Http/Controllers/NotificationController.php` - Notification CRUD
- `app/Http/Controllers/SearchController.php` - Search operations
- `app/Http/Controllers/FileController.php` - File uploads/downloads

### Services
- `app/Services/NotificationService.php` - Notification dispatch service

### Policies
- `app/Policies/NotificationPolicy.php` - Authorization rules

### Views
- `resources/views/notifications/index.blade.php` - Notification listing

---

## Feature 1: Notification System

### How It Works

When users perform important actions (apply for jobs, receive messages, etc.), they get notified in real-time.

### Notification Types
- `job_application_received` - New application received
- `job_application_approved` - Application approved  
- `job_application_rejected` - Application rejected
- `new_message` - New message received
- `mentorship_request_received` - Mentorship request
- `mentorship_request_approved` - Request approved
- `training_enrollment` - Training enrollment
- `training_completion` - Training completed
- `mentor_profile_view` - Profile viewed

### Usage Examples

#### Send a Notification
```php
use App\Services\NotificationService;

NotificationService::send(
    $mentor,
    'job_application_received',
    'New Application',
    'User applied for your job',
    ['job_id' => $job->id],
    $jobApplication  // Optional: related model
);
```

#### Get User's Notifications
```php
$notifications = \App\Models\Notification::where('user_id', auth()->id())
    ->latest()
    ->paginate(15);
```

#### Get Unread Count
```php
$count = \App\Models\Notification::unreadCount(auth()->id());
```

#### Mark as Read
```php
$notification->markAsRead();
```

### Routes Available
```
GET    /notifications               - View all notifications
GET    /notifications/{id}/read     - Mark as read (PATCH)
DELETE /notifications/{id}          - Delete notification
PATCH  /notifications/read-all      - Mark all as read
DELETE /notifications               - Clear all (POST with _method=DELETE)
```

### Already Integrated
- ✅ Job applications now send notifications
- ✅ Application approvals/rejections send notifications

---

## Feature 2: Activity Logging

### How It Works

Every important action is logged with timestamp, IP address, and changes made.

### Usage Examples

#### Log an Action
```php
use App\Models\ActivityLog;

ActivityLog::log(
    auth()->id(),
    'create',
    'Created new job listing',
    $job  // Optional: related model
);
```

#### Log with Before/After Values
```php
ActivityLog::log(
    auth()->id(),
    'update',
    'Updated job status',
    $job,
    ['status' => 'draft'],      // Old values
    ['status' => 'published']   // New values
);
```

#### View User's Activities
```php
$activities = ActivityLog::userRecent(auth()->id(), 50);
```

#### View System-Wide Activities (Admin Only)
```php
$all_activities = ActivityLog::recent(100);
```

---

## Feature 3: Global Search

### How It Works

Users can search across multiple models with real-time AJAX results.

### Routes
```
GET /search?q=keyword&type=jobs       - API endpoint (returns JSON)
GET /search/advanced?q=keyword        - Advanced search page
```

### JavaScript Integration

Add this to your navbar:
```html
<form action="{{ route('search.index') }}" method="GET" class="search-form">
    <input type="text" name="q" placeholder="Search..." required>
    <select name="type" class="form-select">
        <option value="all">All</option>
        <option value="jobs">Jobs</option>
        <option value="trainings">Trainings</option>
        <option value="mentors">Mentors</option>
        <option value="skills">Skills</option>
    </select>
    <button type="submit">Search</button>
</form>
```

### API Response Format
```json
{
    "status": true,
    "query": "laravel",
    "results": {
        "jobs": [
            {
                "id": 1,
                "title": "Senior Laravel Developer",
                "company": "Tech Corp",
                "mentor": "John Doe",
                "url": "/jobs/1",
                "type": "job"
            }
        ],
        "trainings": [...],
        "mentors": [...],
        "skills": [...]
    },
    "total": 42
}
```

---

## Feature 4: File Management

### How It Works

Users can upload documents like resumes, certificates, portfolios, etc.

### Supported File Types
- `resume` - CV/Resume
- `certificate` - Certificates
- `portfolio` - Portfolio documents
- `cover_letter` - Cover letters
- `document` - General documents

### Supported Formats
- PDF files
- Microsoft Word (.doc, .docx)
- Microsoft Excel (.xls, .xlsx)
- Images (JPG, PNG, GIF)
- Max size: 5MB per file

### Upload a File

```php
// In a form
<form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <select name="type">
        <option value="resume">Resume</option>
        <option value="certificate">Certificate</option>
        <option value="portfolio">Portfolio</option>
        <option value="cover_letter">Cover Letter</option>
        <option value="document">Document</option>
    </select>
    <button type="submit">Upload</button>
</form>
```

### API Usage

#### Upload File
```bash
POST /files/upload
Content-Type: multipart/form-data

file=[binary]
type=resume
```

#### List User's Files
```bash
GET /files?type=resume
```

#### Download File
```bash
GET /files/123/download
```

#### Delete File
```bash
DELETE /files/123
```

### In Your Code

```php
use App\Models\File;

// Get user's resumes
$resumes = File::userFilesByType(auth()->id(), 'resume');

// Check if file type is allowed
if (File::isAllowedType($type)) {
    // Process file
}

// Check MIME type
if (File::isAllowedMimeType($mimeType)) {
    // Safe to process
}

// Delete file
$file->deleteFromStorage();

// Get file URL
$url = $file->getUrl();
```

---

## Feature 5: Advanced Authorization

### Notification Policy

Only users can access their own notifications:

```php
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SomeController extends Controller
{
    use AuthorizesRequests;

    public function delete(Notification $notification)
    {
        $this->authorize('delete', $notification);
        // User can only delete their own notifications
    }
}
```

### File Authorization

Users can only access their own files:

```php
// FileController.php checks ownership
if ($file->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
    abort(403);
}
```

---

## Integration with Existing Features

### Job Applications
When someone applies for a job:
1. **Notification sent** to mentor
2. **Activity logged** in activity_logs

When mentor approves/rejects:
1. **Notification sent** to applicant
2. **Activity logged**

### Messages
- **Notifications** sent for new messages (in MessageController)
- **Activities** can be logged for important conversations

### Mentorship Requests
- **Notifications** sent when mentor receives request
- **Notifications** sent when request is approved/rejected

---

## Database Schema

### notifications table
```sql
id                  - Primary key
user_id             - Who receives notification
type                - Notification type
title               - Short title
description         - Full description
data                - JSON data (job_id, etc.)
notifiable_type     - Polymorphic relation type
notifiable_id       - Polymorphic relation ID
read                - Boolean, is read?
created_at/updated_at
```

### activity_logs table
```sql
id                  - Primary key
user_id             - Who performed action
action              - create/update/delete/etc
description         - Human description
model_type          - Related model class
model_id            - Related model ID
old_values          - JSON of previous values
new_values          - JSON of new values
ip_address          - IP address
created_at/updated_at
```

### files table
```sql
id                  - Primary key
user_id             - File owner
name                - Original filename
path                - Storage path
type                - resume/certificate/etc
mime_type           - application/pdf, etc
size                - File size in bytes
fileable_type       - Optional relation type
fileable_id         - Optional relation ID
created_at/updated_at
```

---

## Internationalization (I18N)

Both English and Arabic translations have been added:

```php
// In your views
{{ __('Notifications') }}           // English/Arabic
{{ __('File uploaded successfully') }}

// Adding more translations
// Edit: lang/ar.json or lang/en.json

// Use with parameters
{{ __(':name applied for :job', ['name' => $user->name, 'job' => $job->title]) }}
```

---

## Security Considerations

1. **Authorization**: Policies prevent unauthorized access
2. **File Validation**: MIME type and size checked
3. **SQL Injection**: Protected via Eloquent ORM
4. **CSRF Protection**: Built into forms
5. **IP Logging**: Activities tracked by IP
6. **User Isolation**: Users only see their own data

---

## Performance Tips

1. **Pagination**: Notifications use pagination (15 per page)
2. **Eager Loading**: Use `with()` to prevent N+1 queries
3. **Indexing**: Recent activity logs are indexed
4. **File Cleanup**: Periodically delete orphaned files

---

## Troubleshooting

### Storage Link Not Working
```bash
# Remove and recreate
rm public/storage
php artisan storage:link
```

### Migrations Failed
```bash
# Check database connection in .env
php artisan migrate:refresh  # Only for dev!
```

### Notifications Not Showing
```php
// Check database
App\Models\Notification::count()

// Check if user_id is correct
Notification::where('user_id', auth()->id())->get()
```

### File Upload Issues
```php
// Check storage directory permissions
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/

// Verify upload directory exists
mkdir -p storage/app/public/files/resume
```

---

## Next Steps

1. **Run migrations**: `php artisan migrate`
2. **Create storage link**: `php artisan storage:link`
3. **Test notifications**: Apply for a job and check notifications
4. **Try search**: Use the search API
5. **Upload files**: Test file upload functionality
6. **Review logs**: Check activity_logs table

---

## Support Resources

- **NEW_FEATURES.md** - Comprehensive feature documentation
- **[Laravel Documentation](https://laravel.com/docs)** - Framework documentation
- **Database/Migrations** - See the migration files for exact schema
- **Code Comments** - Controllers have detailed comments

---

## Summary of Changes

### Files Added (20+)
- Models: Notification, ActivityLog, File
- Controllers: NotificationController, SearchController, FileController
- Services: NotificationService
- Policies: NotificationPolicy
- Migrations: 3 new migration files
- Views: notifications/index.blade.php
- Documentation: NEW_FEATURES.md, IMPLEMENTATION_GUIDE.md

### Files Modified
- routes/web.php - Added new routes
- app/Http/Controllers/JobApplicationController.php - Added notifications
- app/Providers/AuthServiceProvider.php - Registered policy
- lang/ar.json - Added 20+ translations

### New Database Tables
- notifications
- activity_logs
- files

---

**Your platform is now more robust with notifications, activity logging, search, and file management!** 🚀

