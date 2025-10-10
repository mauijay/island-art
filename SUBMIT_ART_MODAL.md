# Submit Art Modal - Implementation Guide

## Overview
A comprehensive modal form system for submitting artwork to Island Art News, featuring:
- Artist information collection
- Artwork details and metadata
- Image upload with drag & drop
- Responsive design with Hawaiian aesthetics
- AJAX form submission with validation

## Files Created/Modified

### Modal Component
- **`ci4/app/Views/modals/submit_art.php`** - Complete modal HTML with form
- **`public/assets/js/submit-art-modal.js`** - JavaScript functionality

### Backend Processing
- **`ci4/app/Controllers/ApiController.php`** - Form submission handler
- **`ci4/app/Config/Routes.php`** - Added API route `/api/submit-artwork`

### Integration
- **`ci4/app/Views/layouts/main.php`** - Included modal in layout
- **`ci4/app/Views/partials/_navbar.php`** - Modified Submit Art button
- **`ci4/app/Views/partials/_js.php`** - Added modal JavaScript

## Features

### Artist Information Section
- **Artist Name** (required)
- **Email Address** (required) 
- **Phone Number** (optional)
- **Location** - Dropdown with Hawaiian islands
- **Artist Bio** (optional)

### Artwork Details Section
- **Artwork Title** (required)
- **Medium** - Dropdown with art mediums
- **Year Created** (optional)
- **Dimensions** - Width/Height in inches
- **Description** (required)

### Image Upload
- **Drag & drop** or click to upload
- **File validation** - JPG, JPEG, PNG up to 10MB
- **Image preview** with filename display
- **Click preview to change image**

### Sales Options
- **For Sale checkbox** - Shows/hides price field
- **Price input** - USD with dollar symbol

## Technical Implementation

### JavaScript Features
- **Modal Management** - Open/close with animations
- **Form Validation** - Required field checking
- **File Upload** - Drag/drop with validation
- **AJAX Submission** - Non-blocking form processing
- **Loading States** - Visual feedback during submission
- **Error Handling** - User-friendly error messages

### Backend Features
- **Input Validation** - Comprehensive server-side validation
- **File Processing** - Secure image upload to `/uploads/artwork/`
- **Data Storage** - JSON file storage (easily upgradeable to database)
- **Email Notifications** - Optional admin notification system
- **API Response** - JSON responses for frontend integration

### Security Features
- **CSRF Protection** - Built-in CodeIgniter validation
- **File Type Validation** - Only allows image files
- **File Size Limits** - 10MB maximum
- **Input Sanitization** - All form inputs validated and sanitized

## Usage

### Opening the Modal
The modal opens when clicking:
- **Submit Art button** in navbar
- Any element with `id="submitArtBtn"`
- Any link containing `art.submit` in href

### Form Submission Flow
1. User fills out form and uploads image
2. JavaScript validates required fields
3. AJAX POST to `/api/submit-artwork`
4. Server validates data and processes image
5. Success/error message displayed to user
6. On success: modal closes and form resets

### Data Storage
Submissions are currently stored in:
- **File Location**: `writable/artwork_submissions.json`
- **Image Storage**: `public/uploads/artwork/`
- **Upgrade Path**: Easy migration to database table

## Customization Options

### Styling
- Modal uses Tailwind CSS classes
- Hawaiian color scheme with blue/teal/green gradients
- Responsive design for all screen sizes
- Dark mode support built-in

### Form Fields
- Easy to add/remove form fields in modal HTML
- Update validation rules in `ApiController.php`
- Modify JavaScript validation as needed

### Storage
- Currently uses JSON file for simplicity
- Database migration: Create `artwork_submissions` table
- Update `saveSubmissionToFile()` method to use database model

### Email Notifications
- Admin email notifications included
- Configure SMTP settings in `ci4/app/Config/Email.php`
- Customize email template in `sendNotificationEmail()` method

## Development Testing

### Local Testing URLs
- **Application**: `http://localhost:8080`
- **Vite Assets**: `http://localhost:3001`

### Test Scenarios
1. **Modal Opening**: Click Submit Art button
2. **Form Validation**: Submit empty form (should show errors)
3. **Image Upload**: Drag/drop or click to upload
4. **File Validation**: Try uploading non-image file
5. **Price Toggle**: Check "For Sale" to show price field
6. **Successful Submission**: Complete form and submit

### Debugging
- Check browser console for JavaScript errors
- Review `writable/logs/` for PHP errors
- Inspect `writable/artwork_submissions.json` for stored data
- Verify uploaded images in `public/uploads/artwork/`

## Future Enhancements

### Planned Features
- **Database Integration** - Replace JSON with proper database
- **Admin Dashboard** - Review and approve submissions
- **Artist Portal** - Account system for artists
- **Gallery Integration** - Display approved artwork
- **Image Processing** - Automatic resizing and optimization
- **Social Sharing** - Share artwork on social media

### Technical Improvements
- **Progressive Enhancement** - Fallback for non-JS users
- **Offline Support** - Service worker for offline form completion
- **Multi-file Upload** - Support multiple artwork images
- **Real-time Validation** - Validate fields as user types
- **Auto-save** - Save draft submissions

This modal system provides a solid foundation for artwork submissions while maintaining the site's Hawaiian cultural aesthetic and modern user experience standards.