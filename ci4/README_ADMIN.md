# Island Art - Admin Dashboard

## Quick Access

- **Admin URL**: `/admin`
- **Test Page**: `/admin-css-test.html`
- **Assets**: `/assets/css/admin.css` & `/assets/js/admin.js`

## Features

✅ **Complete Admin Dashboard**

- Dashboard with statistics
- User & role management
- Artist portfolio management
- Gallery & exhibition management
- Event calendar system
- Comprehensive settings panel

✅ **Modern UI/UX**

- Tailwind CSS v4 compatible
- Dark mode support
- Responsive design
- Professional admin components

✅ **Security**

- CodeIgniter Shield authentication
- Role-based access control
- Secure file uploads
- CSRF protection

## Admin Components

### CSS Classes

- `.admin-card` - Modern card layouts
- `.btn-admin-primary` - Primary action buttons
- `.admin-input` - Styled form inputs
- `.admin-table` - Professional data tables
- `.admin-nav-item` - Sidebar navigation
- `.admin-alert-*` - Success/error/warning alerts

### JavaScript Features

- Sidebar toggle & responsive behavior
- Modal system for dialogs
- Form validation & submission
- File upload with drag & drop
- Dark mode toggle
- Notification system

## File Structure

```
ci4/
├── app/Controllers/Admin/    # Admin controllers
├── app/Views/admin/         # Admin view templates
├── app/Views/layouts/admin.php  # Main admin layout
├── app/Helpers/vite_helper.php  # Asset helpers
├── public/assets/           # Compiled CSS/JS
└── public/admin-css-test.html   # Component test page
```

## Development

### Asset Management

- **Source**: `resources/css/admin.css` & `resources/js/admin.js`
- **Public**: `public/assets/css/admin.css` & `public/assets/js/admin.js`
- **Development**: Vite dev server integration
- **Production**: Static file serving

### Testing

- Visit `/admin-css-test.html` to test all CSS components
- Toggle dark mode to verify theme switching
- Test responsive behavior on mobile devices

## Troubleshooting

**CSS Not Loading?**

1. Check file exists: `public/assets/css/admin.css`
2. Verify vite helpers in `app/Views/layouts/admin.php`
3. Clear browser cache (Ctrl+F5)

**Admin Access Issues?**

1. Verify Shield authentication is configured
2. Check user has admin role in database
3. Ensure routes are properly defined

---

**Documentation**: See [ADMIN_README.md](../ADMIN_README.md) for complete
documentation **Last Updated**: October 9, 2025
