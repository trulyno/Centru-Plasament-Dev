# Contact Message System Documentation

## Overview
The Contact Message System allows visitors to send messages through the website's contact form and enables administrators to view and manage these messages through the admin panel.

## System Components

### 1. Contact Form (Frontend)
**Location**: `index.php` - Contact Section
**Features**:
- AJAX form submission with real-time validation
- Required fields: Name, Email, Subject, Message
- Optional field: Phone Number
- Subject selection dropdown
- Form validation with user-friendly error messages
- Success/error feedback with animations

### 2. Contact Handler (Backend)
**File**: `contact_handler.php`
**Functionality**:
- Processes form submissions via POST requests
- Validates all input data
- Sanitizes user input to prevent XSS attacks
- Saves messages as JSON files in `/messages/` directory
- Logs submissions to `/logs/contact_form.log`
- Returns JSON responses for AJAX handling

### 3. Message Storage
**Directory**: `/messages/`
**Format**: JSON files named with unique IDs
**Message Structure**:
```json
{
    "id": "unique_id",
    "name": "User Name",
    "email": "user@example.com",
    "phone": "optional_phone",
    "subject": "selected_subject",
    "message": "message_content",
    "date": "2025-06-19 12:00:00",
    "ip": "visitor_ip_address",
    "status": "new|read",
    "read": false
}
```

### 4. Admin Panel Integration
**File**: `admin/messages.php`
**Features**:
- View all contact messages in chronological order
- Unread message counter and highlighting
- Individual message actions:
  - Mark as read/unread
  - Delete message
  - Reply via email
  - Call phone number (if provided)
- Bulk actions:
  - Select all messages
  - Mark multiple as read
  - Delete multiple messages
- Message filtering and search
- Responsive design for mobile/tablet viewing

## Contact Form Fields

### Required Fields
1. **Name** (`name`)
   - Full name of the contact person
   - Minimum length validation
   - HTML sanitization

2. **Email** (`email`)
   - Valid email address required
   - Email format validation
   - Used for admin replies

3. **Subject** (`subject`)
   - Predefined categories:
     - Informații Generale
     - Plasament de Urgență
     - Adopție
     - Voluntariat
     - Donații
     - Altceva

4. **Message** (`message`)
   - Minimum 10 characters
   - Maximum length limits
   - Line breaks preserved

### Optional Fields
1. **Phone** (`phone`)
   - Contact phone number
   - Creates clickable call link in admin panel

## Admin Panel Features

### Message List View
- **Status Indicators**: Visual badges for new/read messages
- **Message Preview**: Truncated message content
- **Contact Information**: Name, email, phone displayed prominently
- **Timestamp**: Date and time of submission
- **IP Tracking**: Visitor IP address for security

### Message Actions
1. **Individual Actions**:
   - Mark as read/unread
   - Delete message
   - Reply via default email client
   - Call phone number (mobile devices)

2. **Bulk Actions**:
   - Select all checkbox functionality
   - Bulk mark as read
   - Bulk delete with confirmation

### Statistics Dashboard
- Total messages count
- Unread messages count
- Read messages count
- Recent activity tracking

## Security Features

### Input Validation
- **XSS Protection**: All input sanitized with `htmlspecialchars()`
- **Email Validation**: Server-side email format checking
- **Length Limits**: Prevent oversized submissions
- **Required Field Validation**: Server and client-side validation

### Access Control
- **Admin Authentication**: Messages only accessible to logged-in admins
- **CSRF Protection**: Form tokens prevent cross-site request forgery
- **IP Logging**: Track message origins for security monitoring

### Data Protection
- **File Permissions**: Secure file storage with proper permissions
- **Directory Protection**: Messages directory outside web root access
- **Sanitized Output**: All displayed data properly escaped

## File Structure

```
src/
├── contact_handler.php          # Form processing backend
├── index.php                    # Main page with contact form
├── test_contact.html           # Test form for development
├── messages/                   # Message storage directory
│   ├── [message_id].json      # Individual message files
├── logs/
│   └── contact_form.log       # Submission log
└── admin/
    ├── messages.php           # Message management interface
    └── assets/
        └── admin.css          # Additional styles for messages
```

## JavaScript Enhancement

### Form Validation
- Real-time field validation
- Email format checking
- Message length validation
- Visual error indicators

### AJAX Submission
- Asynchronous form submission
- Loading states and spinners
- Success/error message display
- Form reset on successful submission

### Cache Busting
- Dynamic script versioning: `script.js?v=[timestamp]`
- Nginx cache headers for development
- Browser cache prevention for JS/CSS files

## Usage Instructions

### For Website Visitors
1. Navigate to the Contact section on the homepage
2. Fill in all required fields (marked with *)
3. Select appropriate subject category
4. Write detailed message (minimum 10 characters)
5. Click "Trimite Mesajul" to submit
6. Wait for confirmation message

### For Administrators
1. Login to admin panel at `/admin/`
2. Click "Mesaje Contact" in navigation
3. View unread messages (highlighted in blue)
4. Click individual messages to expand details
5. Use action buttons to:
   - Mark as read/unread
   - Reply via email
   - Delete messages
6. Use bulk actions for multiple messages

## Troubleshooting

### Common Issues
1. **Form Not Submitting**
   - Check JavaScript console for errors
   - Verify `contact_handler.php` is accessible
   - Ensure `/messages/` directory exists and is writable

2. **Messages Not Appearing in Admin**
   - Check file permissions on `/messages/` directory
   - Verify JSON files are being created
   - Check admin authentication status

3. **Email Links Not Working**
   - Ensure default email client is configured
   - Check email address format in messages

### Error Logging
- Contact form submissions logged to `/logs/contact_form.log`
- PHP errors logged to server error log
- JavaScript errors visible in browser console

## Configuration Options

### Customizable Settings
- **Message Retention**: Automatic cleanup after X days (implement if needed)
- **Email Notifications**: Admin email alerts for new messages (implement if needed)
- **Subject Categories**: Modify dropdown options in `index.php`
- **Validation Rules**: Adjust field requirements in `contact_handler.php`

### Environment Variables
- **Admin Email**: For auto-forwarding messages
- **SMTP Settings**: For automated email responses
- **File Storage**: Alternative storage backends

## Future Enhancements

### Potential Features
1. **Email Notifications**: Automatic admin alerts for new messages
2. **Message Search**: Full-text search across all messages
3. **Export Functionality**: Download messages as CSV/PDF
4. **Message Categories**: Custom tagging and filtering
5. **Response Templates**: Pre-written response templates
6. **Auto-Responder**: Automatic thank-you emails to visitors
7. **Message Analytics**: Submission trends and statistics
8. **Integration**: Connect with CRM or email marketing tools

---

**Last Updated**: June 19, 2025
**Version**: 1.0.0
**Author**: GitHub Copilot
