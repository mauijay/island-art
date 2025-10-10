# 🏝️ Island Art - Admin Dashboard Documentation

## Overview

The Island Art Admin Dashboard is a comprehensive back-end administration system
built with CodeIgniter 4, featuring a modern interface using Tailwind CSS v4.
This system provides complete management capabilities for artists, galleries,
exhibitions, events, and site settings.

## 🚀 Quick Start

### Prerequisites

- PHP 8.1+
- CodeIgniter 4
- Web server (Apache/Nginx)
- Modern browser with JavaScript enabled

### Access the Admin Dashboard

```
URL: http://yourdomain.com/admin
Default Login: admin@islandart.com / admin123
```

## 📁 File Structure

```
ci4/
├── app/
│   ├── Controllers/
│   │   ├── Admin/
│   │   │   ├── DashboardController.php
│   │   │   ├── SettingsController.php
│   │   │   ├── ArtistsController.php
│   │   │   └── GalleriesController.php
│   │   └── BaseController.php
│   ├── Views/
│   │   ├── layouts/
│   │   │   └── admin.php
│   │   └── admin/
│   │       ├── dashboard.php
│   │       ├── settings/
│   │       └── artists/
│   ├── Helpers/
│   │   └── vite_helper.php
│   └── Config/
│       └── Routes.php
├── public/
│   └── assets/
│       ├── css/
│       │   └── admin.css
│       └── js/
│           └── admin.js
└── resources/
    ├── css/
    │   └── admin.css
    └── js/
        └── admin.js
```

## 🎨 Admin Dashboard Features

### 1. Dashboard Overview

- **Statistics Cards**: Real-time counts for users, artists, artworks, galleries
- **Recent Activity**: Latest system activities and updates
- **Quick Actions**: Direct access to common admin tasks
- **Performance Metrics**: Site usage and performance indicators

### 2. User Management

- **User Roles**: Admin, Artist, Gallery Owner, Visitor
- **User Profiles**: Complete user information management
- **Permission Control**: Role-based access control
- **Activity Tracking**: User login and activity logs

### 3. Artist Management

- **Artist Profiles**: Personal information, biography, contact details
- **Portfolio Management**: Artwork uploads and organization
- **Commission Tracking**: Artist commission rates and payments
- **Artist Analytics**: Performance metrics and sales data

### 4. Gallery Management

- **Gallery Profiles**: Gallery information and contact details
- **Exhibition Management**: Current and upcoming exhibitions
- **Space Management**: Gallery layout and capacity management
- **Partnership Tracking**: Artist-gallery relationships

### 5. Artwork Management

- **Artwork Catalog**: Complete artwork database
- **Image Management**: High-quality image uploads with thumbnails
- **Categorization**: Artwork types, styles, and collections
- **Pricing Management**: Artwork pricing and availability

### 6. Event Management

- **Calendar System**: Interactive event calendar
- **Event Creation**: Art shows, exhibitions, workshops
- **RSVP Management**: Event registration and attendee tracking
- **Event Analytics**: Attendance and engagement metrics

### 7. Settings Management

- **Site Configuration**: Basic site settings and preferences
- **Theme Settings**: Color schemes and branding options
- **Email Settings**: SMTP configuration and templates
- **Security Settings**: Password policies and security options
- **SEO Settings**: Meta tags and search optimization
- **Social Media**: Social platform integrations

## 🔧 Technical Implementation

### Frontend Technologies

- **Tailwind CSS v4**: Utility-first CSS framework via CDN
- **Vanilla JavaScript**: No external JS dependencies
- **Responsive Design**: Mobile-first approach
- **Dark Mode**: Full dark theme support with user preference persistence

### Backend Technologies

- **CodeIgniter 4**: PHP framework
- **Shield Authentication**: User authentication and authorization
- **Role-based Access Control**: Secure admin access
- **File Upload System**: Secure file handling with validation

### CSS Architecture

```css
/* Custom admin components without @apply directives */
.admin-card {
  /* Modern card layouts */
}
.btn-admin-primary {
  /* Gradient buttons */
}
.admin-input {
  /* Styled form elements */
}
.admin-table {
  /* Professional tables */
}
.admin-nav-item {
  /* Sidebar navigation */
}
```

### JavaScript Features

```javascript
// Core admin functionality
- Sidebar management and responsive behavior
- Modal system for dialogs and forms
- Form validation and submission
- File upload with drag & drop
- Notification system
- Dark mode toggle
- Table sorting and filtering
```

## 🎛️ Admin Interface Components

### Navigation Sidebar

- **Collapsible Design**: Space-efficient sidebar
- **Active State Tracking**: Visual indication of current page
- **Role-based Menu**: Different menu items based on user role
- **Mobile Responsive**: Overlay on mobile devices

### Dashboard Cards

- **Statistics Display**: Key metrics with icons
- **Hover Effects**: Interactive card animations
- **Real-time Updates**: Dynamic data refresh
- **Color-coded Status**: Visual status indicators

### Form Components

- **Styled Inputs**: Consistent form element styling
- **Validation States**: Visual feedback for form validation
- **File Upload Areas**: Drag & drop functionality
- **Rich Text Editor**: For content creation

### Data Tables

- **Sortable Columns**: Click to sort functionality
- **Pagination**: Large dataset navigation
- **Search Filtering**: Real-time search capabilities
- **Action Buttons**: Row-specific actions

## 🔐 Security Features

### Authentication

- **Shield Integration**: CodeIgniter Shield for authentication
- **Role-based Access**: Different permission levels
- **Session Management**: Secure session handling
- **Password Security**: Strong password requirements

### Authorization

- **Admin Filters**: Route protection for admin areas
- **Permission Checks**: Method-level permission validation
- **CSRF Protection**: Cross-site request forgery prevention
- **Input Validation**: Server-side data validation

### File Security

- **Upload Validation**: File type and size restrictions
- **Secure Storage**: Protected file storage locations
- **Image Processing**: Automatic thumbnail generation
- **Virus Scanning**: Optional malware detection

## 📱 Responsive Design

### Breakpoints

- **Mobile**: < 768px (Stack layout, overlay sidebar)
- **Tablet**: 768px - 1024px (Adaptive grid)
- **Desktop**: > 1024px (Full sidebar, multi-column layout)

### Mobile Optimizations

- **Touch-friendly**: Larger touch targets
- **Simplified Navigation**: Hamburger menu
- **Optimized Forms**: Mobile keyboard support
- **Performance**: Optimized for mobile networks

## 🌓 Dark Mode Support

### Implementation

- **CSS Custom Properties**: Dynamic color switching
- **Local Storage**: User preference persistence
- **System Preference**: Automatic detection of OS theme
- **Smooth Transitions**: Animated theme switching

### Color Scheme

```css
/* Light mode colors */
--bg-primary: #ffffff;
--text-primary: #111827;
--border-color: #e5e7eb;

/* Dark mode colors */
--bg-primary: #1e293b;
--text-primary: #f9fafb;
--border-color: #374151;
```

## 🚀 Performance Optimization

### CSS Optimization

- **No @apply Directives**: CDN compatibility
- **Minimal File Size**: ~11KB compressed
- **Critical CSS**: Above-the-fold optimization
- **Efficient Selectors**: Optimized CSS specificity

### JavaScript Optimization

- **Vanilla JS**: No external dependencies
- **Event Delegation**: Efficient event handling
- **Lazy Loading**: On-demand resource loading
- **Memory Management**: Proper cleanup and disposal

### Image Optimization

- **Automatic Thumbnails**: Server-side image processing
- **WebP Support**: Modern image formats
- **Lazy Loading**: Viewport-based loading
- **Responsive Images**: Multiple size variants

## 🔄 Development Workflow

### Asset Pipeline

```bash
# Development (with Vite)
npm run dev

# Production build
npm run build

# Watch mode
npm run watch
```

### Vite Helper Functions

```php
// Development server detection
vite_get_dev_server_url()

// Asset URL generation
vite_asset('resources/css/admin.css')

// CSS inclusion
vite_css(['resources/css/admin.css'])

// JS inclusion
vite_js(['resources/js/admin.js'])
```

### File Structure Convention

- **Resources**: `/resources/css/` and `/resources/js/` (source files)
- **Public Assets**: `/public/assets/` (served files)
- **Development**: Vite dev server at http://localhost:3000
- **Production**: Static files served from public directory

## 🛠️ Customization Guide

### Adding New Admin Pages

1. **Create Controller**: `app/Controllers/Admin/NewController.php`
2. **Add Routes**: Update `app/Config/Routes.php`
3. **Create Views**: Add templates in `app/Views/admin/`
4. **Update Navigation**: Modify sidebar in `admin.php` layout

### Styling Customization

1. **Edit CSS**: Modify `resources/css/admin.css`
2. **Add Components**: Create new CSS classes following naming convention
3. **Test Responsive**: Verify mobile and desktop layouts
4. **Build Assets**: Run `npm run build` for production

### Adding New Features

1. **Database Changes**: Create migrations for new tables
2. **Model Creation**: Add models in `app/Models/`
3. **Controller Logic**: Implement business logic
4. **Frontend Integration**: Add JavaScript functionality

## 🧪 Testing

### Manual Testing Checklist

- [ ] Admin login/logout functionality
- [ ] All navigation links work correctly
- [ ] Forms submit and validate properly
- [ ] File uploads work with all supported formats
- [ ] Dark mode toggle functions correctly
- [ ] Responsive design works on all devices
- [ ] All CRUD operations complete successfully

### Browser Compatibility

- ✅ Chrome 90+
- ✅ Firefox 88+
- ✅ Safari 14+
- ✅ Edge 90+
- ✅ Mobile browsers (iOS Safari, Chrome Mobile)

## 🐛 Troubleshooting

### Common Issues

#### CSS Not Loading

```bash
# Check file paths
ls -la public/assets/css/admin.css

# Verify vite helper functions
grep -n "vite_css" app/Views/layouts/admin.php

# Clear browser cache
Ctrl+F5 (Windows) / Cmd+Shift+R (Mac)
```

#### JavaScript Errors

```bash
# Check console for errors
F12 → Console tab

# Verify file loading
Network tab → JS files

# Check file permissions
chmod 644 public/assets/js/admin.js
```

#### Authentication Issues

```php
// Check Shield configuration
app/Config/Auth.php

// Verify user roles
SELECT * FROM auth_groups_users;

// Reset admin password
php spark shield:user admin@islandart.com
```

#### Performance Issues

```bash
# Optimize images
npm run optimize-images

# Minify assets
npm run build

# Check server logs
tail -f writable/logs/log-$(date +%Y-%m-%d).log
```

## 📚 Additional Resources

### Documentation Links

- [CodeIgniter 4 Documentation](https://codeigniter.com/user_guide/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Shield Authentication](https://shield.codeigniter.com/)

### Development Tools

- [VS Code Extensions](/.vscode/extensions.json)
- [PHP CS Fixer](/.php-cs-fixer.dist.php)
- [PHPStan](./phpstan.neon)

### Community

- [CodeIgniter Forum](https://forum.codeigniter.com/)
- [GitHub Issues](https://github.com/mauijay/island-art/issues)
- [Discord Community](https://discord.gg/codeigniter)

## 🤝 Contributing

### Development Setup

1. **Clone Repository**: `git clone https://github.com/mauijay/island-art.git`
2. **Install Dependencies**: `composer install && npm install`
3. **Configure Environment**: Copy `.env.example` to `.env`
4. **Run Migrations**: `php spark migrate`
5. **Seed Database**: `php spark db:seed`
6. **Start Development**: `npm run dev && php spark serve`

### Code Standards

- **PHP**: PSR-12 coding standard
- **JavaScript**: ESLint configuration
- **CSS**: BEM methodology for custom classes
- **Git**: Conventional commits format

### Pull Request Process

1. **Feature Branch**: Create from `main` branch
2. **Testing**: Ensure all tests pass
3. **Documentation**: Update relevant documentation
4. **Review**: Submit PR for code review
5. **Merge**: Squash and merge after approval

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file
for details.

## 👥 Support

For support and questions:

- **Email**: admin@islandart.com
- **GitHub Issues**:
  [Create an issue](https://github.com/mauijay/island-art/issues)
- **Documentation**: This README and inline code comments

---

**Last Updated**: October 9, 2025 **Version**: 1.0.0 **Maintained by**: Island
Art Development Team
