# CPRCVF Admin Panel - Complete Documentation

## Overview
The CPRCVF Admin Panel is a comprehensive content management system for the CPRCVF website, allowing complete management of homepage content without requiring database or technical knowledge.

## System Architecture

### Core Components
1. **Authentication System** (`admin/includes/auth.php`)
   - Hardcoded credentials: `admin` / `cprcvf2025!`
   - Session-based authentication
   - Automatic logout after inactivity

2. **Content Manager** (`admin/includes/content_manager.php`)
   - Handles all CRUD operations on `ro_md.txt`
   - Input validation and sanitization
   - Automatic backup creation
   - Activity logging

3. **File Loader** (`file_loader.php`)
   - Parses `ro_md.txt` configuration file
   - Loads all homepage data into global variables
   - Handles data type conversion and validation

## Managed Content Sections

### 1. Hero Slideshow
- **Fields**: Title, Description, Button Text, Button Link, Background Image
- **Count**: Dynamic (can add/remove slides)
- **Configuration Keys**: `HERO_TITLES`, `HERO_DESCRIPTIONS`, `HERO_BUTTONS`, `HERO_LINKS`, `HERO_IMAGES`

### 2. About Section
- **Fields**: Section Title, 3 Paragraphs of Content
- **Configuration Keys**: `ABOUT_TITLE`, `ABOUT_TEXT_1`, `ABOUT_TEXT_2`, `ABOUT_TEXT_3`

### 3. Services Section
- **Fields**: Service Name, Short Name, Description, Image
- **Count**: Fixed (6 services)
- **Configuration Keys**: `SERVICES`, `SERVICES_NAMES`, `SERVICES_NAMES_SHORT`, `SERVICES_IMAGES`, `SERVICES_DESCRIPTION`

### 4. Statistics Section
- **Fields**: Statistic Value, Label
- **Count**: Fixed (4 statistics)
- **Configuration Keys**: `STATS_VALUES`, `STATS_LABELS`

### 5. Gallery Section
- **Fields**: Image Title, Description, Image File
- **Count**: Fixed (5 gallery items)
- **Configuration Keys**: `GALLERY_TITLES`, `GALLERY_DESCRIPTIONS`, `GALLERY_IMAGES`

### 6. Testimonials Section
- **Fields**: Quote, Author Name, Author Role
- **Count**: Dynamic (can add/remove testimonials)
- **Configuration Keys**: `TESTIMONIALS_QUOTES`, `TESTIMONIALS_AUTHORS`, `TESTIMONIALS_ROLES`

## Admin Panel Features

### Dashboard (`admin/dashboard.php`)
- System statistics overview
- Quick access to management sections
- Recent activity log
- System health indicators

### Homepage Management (`admin/manage.php?page=index`)
- Tab-based interface for different sections
- Real-time add/remove functionality for dynamic content
- Image selection from available images
- Form validation and error handling

### Services Management (`admin/manage.php?page=services`)
- Individual service editing
- Image preview functionality
- Bulk operations support

### Settings (`admin/settings.php`)
- Admin password change
- System configuration options
- Security settings

### Backups (`admin/backups.php`)
- Automatic backup creation
- Manual backup download
- Backup restoration (if needed)

## Security Features

1. **Authentication**
   - Session-based login system
   - Password hashing (SHA-256)
   - Automatic session timeout

2. **Input Validation**
   - XSS protection via `htmlspecialchars()`
   - Input length limits
   - Required field validation
   - File type restrictions for images

3. **Access Control**
   - All admin pages require authentication
   - CSRF protection on forms
   - File access restrictions

4. **Activity Logging**
   - All changes logged to `logs/admin_activity.log`
   - IP address and timestamp tracking
   - Action details recording

## File Structure

```
admin/
├── index.php              # Login page
├── dashboard.php          # Main dashboard
├── manage.php            # Content management
├── settings.php          # Admin settings
├── backups.php           # Backup management
├── logout.php            # Logout handler
├── assets/
│   ├── admin.css         # Admin panel styles
│   └── admin.js          # Admin panel JavaScript
└── includes/
    ├── auth.php          # Authentication functions
    └── content_manager.php # Content management class

config/
└── admin_config.php      # Admin configuration

info/
└── ro_md.txt            # Main configuration file

logs/
└── admin_activity.log   # Activity log file

backups/
└── *.txt               # Automatic backups
```

## Usage Instructions

### Accessing the Admin Panel
1. Navigate to `/admin/`
2. Login with credentials: `admin` / `cprcvf2025!`
3. Access different management sections from the dashboard

### Managing Homepage Content
1. Go to "Gestionare Pagina Principală" from dashboard
2. Use tabs to switch between different sections
3. Edit content in forms and click "Salvează" to save
4. Use "Adaugă" buttons to add new slides/testimonials
5. Use "Șterge" buttons to remove items (minimum 1 required)

### Managing Services
1. Go to "Gestionare Servicii" from dashboard
2. Edit individual services using the forms
3. Select images from dropdown menus
4. Preview images before saving

## Technical Implementation

### Dynamic Content Loading
The homepage (`index.php`) uses PHP loops to dynamically generate content:

```php
<?php for ($i = 0; $i < count($GLOBALS['HERO_TITLES']); $i++): ?>
<div class="slide <?php echo $i === 0 ? 'active' : ''; ?>">
    <h1><?php echo htmlspecialchars($GLOBALS['HERO_TITLES'][$i]); ?></h1>
    <p><?php echo htmlspecialchars($GLOBALS['HERO_DESCRIPTIONS'][$i]); ?></p>
</div>
<?php endfor; ?>
```

### JavaScript Enhancements
- Automatic stats counter animation using actual values
- Slideshow controls for hero section and testimonials
- Tab navigation in admin panel
- Dynamic add/remove functionality

### CSS Styling
- Responsive design for all screen sizes
- Modern admin interface with consistent theming
- Hover effects and smooth transitions
- Print-friendly styles

## Maintenance

### Regular Tasks
1. **Backup Monitoring**: Check that backups are being created regularly
2. **Log Review**: Review activity logs for unusual access patterns
3. **Password Updates**: Change admin password periodically
4. **Image Management**: Clean up unused images from `/images/` folder

### Troubleshooting
1. **Login Issues**: Check session configuration and file permissions
2. **Save Failures**: Verify write permissions on `info/ro_md.txt`
3. **Missing Images**: Ensure images exist in `/images/` folder
4. **JavaScript Errors**: Check browser console for specific errors

## Future Enhancements

### Potential Improvements
1. **Multi-user Support**: Add user roles and permissions
2. **Media Library**: Advanced image management with upload capability
3. **Content Scheduling**: Schedule content changes for future dates
4. **SEO Tools**: Meta description and keyword management
5. **Analytics Integration**: Track content performance
6. **Email Notifications**: Alert on important changes
7. **Version History**: Track content changes over time

### Scalability Considerations
- Database migration path for larger content volumes
- CDN integration for image delivery
- Caching system for improved performance
- API endpoints for external integrations

## Support and Maintenance

For technical support or questions about the admin panel:
1. Check this documentation first
2. Review the activity logs for error messages
3. Test functionality in a staging environment
4. Contact the development team if needed

---

**Last Updated**: June 18, 2025
**Version**: 1.0.0
**Author**: GitHub Copilot
