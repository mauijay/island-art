# Island Art Hawaiʻi - Hawaiian Art Culture Website

![CodeIgniter](https://img.shields.io/badge/CodeIgniter-4-EF4223?style=flat-square&logo=codeigniter)
![Vite](https://img.shields.io/badge/Vite-7.1.9-646CFF?style=flat-square&logo=vite)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-4.1.14-06B6D4?style=flat-square&logo=tailwindcss)
![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat-square&logo=php)
![Version](https://img.shields.io/badge/Version-1.0.10-brightgreen?style=flat-square)

A modern, beautiful website celebrating Hawaiian art culture and connecting the
local creative community. Built with CodeIgniter 4, Vite, and Tailwind CSS v4
for optimal performance and stunning visual design.

## 🌺 About Island Art Hawaiʻi

Island Art Hawaiʻi is your premier source for Hawaiian art culture, connecting
artists, galleries, and art enthusiasts across the islands. We celebrate and
preserve the rich artistic heritage of Hawaiʻi while fostering contemporary
creative expression.

### 🎨 Features

- **Hawaiian Cultural Design** - Ocean gradients, proper ʻokina usage, and
  island-inspired aesthetics
- **Artist Spotlights** - Monthly featured artists and local talent showcases
- **Gallery Directory** - Comprehensive listing of galleries and exhibitions
- **Events Calendar** - Island-organized art events and cultural festivals
- **News & Updates** - Latest exhibitions, workshops, and community events
- **Contact & Submissions** - Easy ways for artists to connect and submit work

## ⚡ Quick Start

```bash
# 1. Install dependencies
npm install

# 2. Build assets
npm run build

# 3. Start CodeIgniter server
php spark serve --host localhost --port 8080

# 4. Visit http://localhost:8080
```

## 🚀 Technical Features

- ✅ **CodeIgniter 4** - Robust PHP framework
- ✅ **Vite 7.1.9** - Lightning-fast build tool with hot reloading
- ✅ **Tailwind CSS 4.1.14** - Latest utility-first CSS framework
- ✅ **Hawaiian Design System** - Custom gradients, typography, and cultural
  elements
- ✅ **Responsive Design** - Mobile-first approach with perfect scaling
- ✅ **Performance Optimized** - 99.5% load time improvement (24s → 0.13s)
- ✅ **SEO Friendly** - Proper meta tags and semantic HTML
- ✅ **Accessibility** - WCAG compliant design patterns
- ✅ **Version Management** - Automated version syncing across all files

## 🌐 Browser Support

This project targets **modern browsers** (ES2018+) for optimal performance:

- ✅ **Chrome/Edge** 60+ (2017+)
- ✅ **Firefox** 60+ (2018+)
- ✅ **Safari** 11+ (2017+)
- ✅ **Mobile browsers** from 2018+

**Coverage:** 95%+ of users worldwide. No legacy polyfills needed for better
performance.

## 📁 Project Structure

```
island-art/
├── app/
│   ├── Views/
│   │   ├── home.php              # Hero section + news + artist spotlight
│   │   ├── artists.php           # Monthly featured + local artists
│   │   ├── galleries.php         # Gallery listings + exhibitions
│   │   ├── calendar.php          # Island-organized events
│   │   ├── contact.php           # Contact form + about us + logo
│   │   └── layouts/main.php      # Base layout template with navbar/footer
│   ├── Controllers/
│   │   ├── HomeController.php    # Homepage with Hawaiian design
│   │   ├── ArtistsController.php # Artist profiles and spotlights
│   │   ├── GalleriesController.php # Gallery and exhibition management
│   │   ├── CalendarController.php  # Event calendar functionality
│   │   └── LegalController.php   # Terms and privacy pages
│   ├── Helpers/
│   │   ├── vite_helper.php       # Vite asset helpers
│   │   └── version_helper.php    # Version display helpers
│   └── Config/
│       ├── Routes.php            # Application routing
│       └── Autoload.php          # Helper autoload configuration
├── resources/
│   ├── css/app.css               # Tailwind CSS + Hawaiian theme
│   └── js/app.js                 # JavaScript entry point
├── public/
│   ├── assets/                   # Built assets (generated)
│   └── uploads/images/           # Logo and media files
├── scripts/
│   └── sync-version.js           # Version synchronization script
├── .vscode/settings.json         # VS Code Tailwind IntelliSense config
├── vite.config.js                # Vite configuration
├── tailwind.config.js            # Tailwind CSS configuration
├── postcss.config.js             # PostCSS configuration
├── package.json                  # Dependencies and scripts
├── composer.json                 # PHP dependencies and version
└── .env                          # Environment configuration
```

## 🌊 Available Pages

### Main Navigation

- **Homepage** (`/`) - Hero section with ocean gradients, latest art news, and
  featured artist
- **Artists** (`/artists`) - Monthly featured artist (Keoni Nakamura) + local
  artist profiles
- **Galleries** (`/galleries`) - Featured exhibitions with sample artwork and
  filtering
- **Calendar** (`/calendar`) - Island-organized events (Oʻahu, Big Island, Maui,
  Kauaʻi)
- **Contact** (`/contact`) - Contact form, about us section, and logo display

### Additional Pages

- **Terms of Service** (`/legal/terms`) - Legal terms and conditions
- **Privacy Policy** (`/legal/privacy`) - Privacy policy and data handling

### Page Features

#### 🏠 Homepage

- **Hero Section** - Ocean gradient background (blue → teal → green)
- **Island Art Hawaiʻi** title with proper ʻokina character
- **Call-to-Action** buttons linking to galleries and artists
- **Latest News** - Three sample articles with hover effects
- **Art Culture Info** - Hawaiian heritage and community features
- **Artist Spotlight** - Keoni Nakamura featured profile

#### 🎨 Artists Page

- **Monthly Featured Artist** - Detailed spotlight with biography and works
- **Local Artists** - Showcase of three prominent Hawaiian artists
- **Artist Submission** - Call-to-action for new artist applications
- **Responsive Grid** - Beautiful card layouts with hover animations

#### 🖼️ Galleries Page

- **Featured Exhibitions** - Current and upcoming shows
- **Sample Artwork** - 8 pieces with titles, artists, and details
- **Filter System** - Browse by medium, date, or location
- **Gallery Information** - Venue details and visiting hours

#### 📅 Calendar Page

- **Island Organization** - Events grouped by island with color coding
- **Monthly Featured Events** - Highlighted cultural happenings
- **Event Details** - Dates, locations, and descriptions
- **Interactive Design** - Hover effects and responsive layouts

#### 📧 Contact Page

- **Contact Form** - Professional inquiry form
- **Business Information** - IslandArtNews details and location
- **About Us** - Mission, story, and team information
- **Logo Display** - Featured company logo (96px)

## 🛠️ Installation & Setup

### 1. Install Dependencies

```bash
npm install
```

### 2. Environment Configuration

Create/update `.env` file:

```env
# For production mode (built assets)
CI_ENVIRONMENT = production

# For development mode (with hot reloading)
# CI_ENVIRONMENT = development
```

### 3. Build Assets

```bash
# Production build
npm run build

# Development server (hot reloading)
npm run dev

# Preview production build
npm run preview
```

## 🎯 Usage

### Production Mode (Recommended)

1. **Build assets:**

   ```bash
   npm run build
   ```

2. **Start CodeIgniter server:**

   ```bash
   php spark serve --host localhost --port 8080
   ```

3. **Visit:** `http://localhost:8080`

### Available Pages

- **Homepage:** `http://localhost:8080/` - Island Art News main page
- **Calendar:** `http://localhost:8080/calendar` - Hawaii art events with custom
  styling

### Development Mode (Hot Reloading)

1. **Set environment in `.env`:**

   ```env
   CI_ENVIRONMENT = development
   ```

2. **Start Vite dev server:**

   ```bash
   npm run dev
   ```

3. **Start CodeIgniter server (in another terminal):**

   ```bash
   php spark serve --host localhost --port 8080
   ```

4. **Visit:** `http://localhost:8080`

### Available Pages

- **Homepage:** `http://localhost:8080/` - Island Art News main page
- **Calendar:** `http://localhost:8080/calendar` - Hawaii art events with custom
  styling

## ⚙️ Configuration Files

### Vite Configuration (`vite.config.js`)

```javascript
import { defineConfig } from "vite";

export default defineConfig(({ command }) => {
  const isProduction = command === "build";

  return {
    plugins: [
      // Modern browsers only - optimized for performance
    ],
    publicDir: false,
    build: {
      outDir: "public/assets",
      manifest: true,
      assetsDir: "assets",
      rollupOptions: {
        input: {
          main: "resources/js/app.js",
          style: "resources/css/app.css",
        },
      },
    },
    server: {
      port: 3000,
      host: "localhost",
    },
    base: isProduction ? "/assets/" : "/",
    css: {
      devSourcemap: true,
    },
  };
});
```

### Tailwind Configuration (`tailwind.config.js`)

```javascript
/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.php",
    "./resources/**/*.{js,ts,css}",
    "./public/**/*.html",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
```

### CSS Entry Point (`resources/css/app.css`)

```css
@import "tailwindcss";

/* Custom styles can be added here */

/* Events Calendar Styles */
.events-calendar {
  font-family: Arial, sans-serif;
  max-width: 700px;
  margin: 0 auto;
  padding: 0 10px;
  line-height: 1.5;
  color: #333;
}
/* ... additional custom styles ... */
```

## � Version Management

This project uses automated version synchronization across all files:

### Current Version: 1.0.1

### Version Bump Commands

```bash
# Patch version (1.0.1 → 1.0.2) - Bug fixes
npm run bump:patch

# Minor version (1.0.1 → 1.1.0) - New features
npm run bump:minor

# Major version (1.0.1 → 2.0.0) - Breaking changes
npm run bump:major

# Sync existing versions across files
npm run sync-version
```

### Files Updated During Version Sync

- `package.json` - NPM package version
- `ci4/composer.json` - Composer package version (in ci4 folder)
- `ci4/.env` - Application version (local only, in ci4 folder)
- `ci4/.env.example` - Application version (tracked, in ci4 folder)

### Version Display

The current version is displayed in the footer and can be accessed via the
`app_version()` helper function in CodeIgniter views.

## 🚀 Performance

### Optimization Results

- **Before**: 24+ second load times
- **After**: 0.1313 seconds average
- **Improvement**: 99.5% faster performance
- **Techniques**: Vite optimization, debug toolbar configuration, variable
  collection disabled

### Build Optimization

- **Asset Minification** - CSS and JS compression
- **Cache Busting** - Automatic asset versioning
- **Tree Shaking** - Unused code elimination
- **Modern Browser Targeting** - ES2018+ optimizations

## 🎨 VS Code IntelliSense Setup

### Install Extension

Install the **Tailwind CSS IntelliSense** extension:

- ID: `bradlc.vscode-tailwindcss`

### VS Code Settings (`.vscode/settings.json`)

```json
{
  "tailwindCSS.includeLanguages": {
    "php": "html"
  },
  "tailwindCSS.experimental.configFile": "tailwind.config.js",
  "tailwindCSS.files.exclude": [
    "**/.git/**",
    "**/node_modules/**",
    "**/dist/**",
    "**/build/**"
  ],
  "emmet.includeLanguages": {
    "php": "html"
  },
  "files.associations": {
    "*.php": "php"
  }
}
```

## 🔧 Helper Functions

The project includes custom PHP helper functions in
`app/Helpers/vite_helper.php`:

- `vite_asset($entry)` - Smart asset URL generation
- `vite_dev_scripts()` - Vite client scripts for hot reloading
- `vite_css_assets($entry)` - CSS asset extraction from manifest
- `vite_get_dev_server_url()` - Auto-detect Vite dev server port

## 🎭 View Integration

Example usage in `app/Views/home.php`:

```php
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CI4 + Tailwind v4</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <?= vite_dev_scripts() ?>

  <?php if (ENVIRONMENT === 'development'): ?>
    <?php $viteDevServer = vite_get_dev_server_url(); ?>
    <?php if ($viteDevServer): ?>
      <link rel="stylesheet" href="<?= $viteDevServer ?>/resources/css/app.css">
    <?php else: ?>
      <?php foreach (vite_css_assets('resources/js/app.js') as $cssAsset): ?>
        <link rel="stylesheet" href="<?= $cssAsset ?>">
      <?php endforeach; ?>
    <?php endif; ?>
  <?php else: ?>
    <?php foreach (vite_css_assets('resources/js/app.js') as $cssAsset): ?>
      <link rel="stylesheet" href="<?= $cssAsset ?>">
    <?php endforeach; ?>
  <?php endif; ?>
</head>

<body class="bg-gray-100 text-gray-800">
  <div class="p-6 max-w-lg mx-auto">
    <h1 class="text-3xl font-bold">Hello from Tailwind v4 + CI4!</h1>
    <p class="mt-4 text-lg">Hot reload in dev, optimized build in prod 🎉</p>
  </div>

  <script type="module" src="<?= vite_asset('resources/js/app.js') ?>"></script>
</body>
</html>
```

## 📦 Dependencies

### Production Dependencies

- `@tailwindcss/postcss` - Tailwind CSS PostCSS plugin
- `tailwindcss` - Utility-first CSS framework
- `autoprefixer` - CSS vendor prefixing
- `postcss` - CSS transformation tool

### Development Dependencies

- `vite` - Fast build tool and dev server

## 🚨 Troubleshooting

### CSS Not Loading in Development

1. **Check if Vite dev server is running:**

   ```bash
   npm run dev
   ```

2. **Verify environment in `.env`:**

   ```env
   CI_ENVIRONMENT = development
   ```

3. **Check browser console for 404 errors** - If you see errors like:

   ```
   GET http://localhost:3000/@vite/client net::ERR_ABORTED 404
   ```

   This means the Vite dev server isn't running or is on a different port.

4. **Port conflicts:** If Vite starts on port 3001 or 3002, the helper functions
   will automatically detect it.

### IntelliSense Not Working

1. **Ensure Tailwind CSS IntelliSense extension is installed:**
   - Extension ID: `bradlc.vscode-tailwindcss`

2. **Check VS Code settings configuration** in `.vscode/settings.json`

3. **Restart VS Code or reload window:**

   ```
   Ctrl+Shift+P → "Developer: Reload Window"
   ```

4. **Verify `tailwind.config.js` paths** match your project structure

5. **For Tailwind CSS v4 issues:** Try restarting the extension:
   ```
   Ctrl+Shift+P → "Tailwind CSS: Restart Extension"
   ```

### Build Warnings

**Warning about `outDir` and `publicDir`:**

- Already fixed with `publicDir: false` in `vite.config.js`

### Asset Loading Issues

1. **Assets not found (404 errors):**
   - Run `npm run build` to generate assets
   - Check that `public/assets/.vite/manifest.json` exists

2. **CSS not applying:**
   - Verify Tailwind classes are in content paths
   - Check browser network tab for CSS file loading
   - Ensure PostCSS is configured correctly

### Development Server Issues

1. **Port already in use:**
   - Vite will automatically use the next available port (3001, 3002, etc.)
   - The helper functions automatically detect the correct port

2. **Hot reloading not working:**
   - Ensure both servers are running (Vite + CodeIgniter)
   - Check that `@vite/client` script is loaded in browser

## 🧰 Smart Helper Functions

The project includes intelligent PHP helper functions that automatically handle
development vs production asset loading:

### `vite_get_dev_server_url()`

- **Purpose:** Auto-detects running Vite dev server on ports 3000-3003
- **Returns:** Server URL or `null` if not running
- **Usage:** Automatically called by other helpers

### `vite_asset($entry)`

- **Purpose:** Smart asset URL generation
- **Development:** Uses Vite dev server if running, fallback to manifest
- **Production:** Always uses manifest files
- **Example:** `vite_asset('resources/js/app.js')`

### `vite_dev_scripts()`

- **Purpose:** Includes Vite client scripts for hot reloading
- **Development:** Includes `@vite/client` if dev server is running
- **Production:** Returns empty string
- **Usage:** `<?= vite_dev_scripts() ?>`

### `vite_css_assets($entry)`

- **Purpose:** Extracts CSS assets from manifest
- **Returns:** Array of CSS file URLs
- **Usage:** Load production CSS files

### Auto-Detection Features

- ✅ **Port Detection:** Automatically finds Vite dev server on any port
- ✅ **Environment Switching:** Seamlessly switches between dev and production
- ✅ **Fallback Handling:** Works even if dev server crashes
- ✅ **Error Recovery:** Graceful degradation to production assets

## 📈 Performance

### Development

- ⚡ **Hot reloading** - Instant CSS/JS updates
- 🔍 **Source maps** - Easy debugging
- 🎯 **IntelliSense** - Fast development with autocompletion

### Production

- 🗜️ **Minified assets** - Optimized file sizes
- 🏷️ **Cache busting** - Proper browser caching
- � **Modern targeting** - Optimized for current browsers
- 📦 **Tree shaking** - Only used CSS/JS included

## � Success - What You've Achieved

You now have a production-ready CodeIgniter 4 + Vite + Tailwind CSS v4 setup
featuring:

### 🛠️ Development Experience

- ✅ **Hot reloading** - Real-time CSS/JS updates without page refresh
- ✅ **Tailwind CSS IntelliSense** - Autocompletion and class validation
- ✅ **Source maps** - Easy debugging in development
- ✅ **Auto port detection** - Handles Vite dev server port conflicts
- ✅ **Smart asset switching** - Seamless dev/production asset loading

### 🚀 Production Optimization

- ✅ **Minified assets** - Optimized file sizes for faster loading
- ✅ **Cache busting** - Automatic filename hashing for proper caching
- ✅ **Modern browser targeting** - Optimized for ES2018+ browsers (95%+
  coverage)
- ✅ **Tree shaking** - Only used CSS/JS classes included in build
- ✅ **CSS optimization** - Purged unused Tailwind classes

### 🏗️ Architecture Benefits

- ✅ **Modern build pipeline** - Vite's lightning-fast development server
- ✅ **Latest Tailwind CSS v4** - Cutting-edge utility-first CSS
- ✅ **Robust error handling** - Graceful fallbacks when dev server is down
- ✅ **Clean separation** - Resources, build output, and source files organized
- ✅ **Future-proof setup** - Easy to maintain and extend

## 🚀 Next Steps for Island Art News

1. **Design System:** Customize `tailwind.config.js` with Island Art News brand
   colors and typography
2. **Content Pages:** Create article views, artist profiles, and event listings
   in `app/Views/`
3. **Interactive Features:** Add image galleries, article search, and social
   sharing in `resources/js/app.js`
4. **CMS Integration:** Set up admin panel for content management and article
   publishing
5. **SEO Optimization:** Add meta tags, structured data, and sitemap generation
6. **Performance:** Optimize images and implement caching for better load times
7. **Deploy:** Configure production environment for IslandArtNews.com

Ready to showcase the local art community! �

**Version bump after add and commit:**

```bash
# Ensure clean working directory
git status

# See detailed changes
git diff
git diff --cached

# Stage all changes
git add .

# Check what's about to be committed
git status

# Use conventional commits for better changelog generation
npm run commit

# This will prompt you to create a conventional commit:
# ? Select the type of change: feat
# ? What is the scope of this change: tests
# ? Write a short description: add comprehensive test suite
# ? Provide a longer description: (optional)
# ? Are there any breaking changes? No
# ? Does this change affect any open issues? No

# 1. Update version and sync everything
# Clean, single execution - no duplicates
npm run bump:patch    # 1.0.9 → 1.0.10
npm run bump:minor    # 1.0.9 → 1.1.0
npm run bump:major    # 1.0.9 → 2.0.0

# Manual sync only
npm run sync-version



# 2. Commit the changes
# Generate/update changelog , Commit the changes
npm run changelog
git add . && git commit -m "chore: bump version to 1.0.9"

# 3. Push with tags
git push && git push --tags



# This should:
# 1. Increment package.json from 0.3.5 → 0.3.6
# 2. Run your sync-version.js script
# 3. Update composer.json, .env, .env.example
# 4. Git add, commit, and push with tags

# Expected output:
# npm version 0.3.6
# ✅ Updated package.json version to 0.3.6
# ✅ Updated composer.json version to 0.3.6
# ✅ Updated .env app.version to 0.3.6 (local only)
# ✅ Updated .env.example app.version to 0.3.6 (tracked)
# 📦 All versions are now in sync!
# [Git operations...]

# Alternative: Generate changelog after version bump
# If you prefer to generate changelog after the version bump:
# npm run version:patch
# npm run changelog
# git add CHANGELOG.md
# git commit -m "docs: update changelog for v0.3.6"
# git push
```
