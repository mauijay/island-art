# 🔄 Version Management & Sync System

This project has an automated version management system that keeps version numbers synchronized across multiple files.

## 📋 How It Works

The version sync system automatically updates version numbers in:

1. **package.json** (source of truth)
2. **ci4/composer.json** 
3. **ci4/.env** (local development)
4. **ci4/.env.example** (tracked in Git)
5. **README.md** (version badge)

## 🚀 Usage

### Manual Version Sync

Run the sync script manually to update all files to match package.json:

```bash
npm run sync-version
```

### Automatic Version Bumping

Use these commands to automatically bump version and sync all files:

```bash
# Patch version (1.0.7 → 1.0.8)
npm run bump:patch

# Minor version (1.0.7 → 1.1.0) 
npm run bump:minor

# Major version (1.0.7 → 2.0.0)
npm run bump:major
```

### Manual Version Update

1. Update the version in `package.json`
2. Run `npm run sync-version`
3. Commit all updated files

## 🔧 What Gets Updated

### package.json
```json
{
  "version": "1.0.7"
}
```

### ci4/composer.json
```json
{
  "version": "1.0.7"
}
```

### ci4/.env & ci4/.env.example
```bash
app.version = 1.0.7
```

### README.md
```markdown
![Version](https://img.shields.io/badge/Version-1.0.7-brightgreen?style=flat-square)
```

## 🤖 Automated Workflows

The system includes NPM scripts for common workflows:

| Command | Description |
|---------|-------------|
| `npm run sync-version` | Sync all versions to match package.json |
| `npm run bump:patch` | Bump patch version and sync |
| `npm run bump:minor` | Bump minor version and sync |
| `npm run bump:major` | Bump major version and sync |

## 📝 Git Integration

### Pre-commit Hook (Optional)

You can install a pre-commit hook to automatically sync versions:

```bash
# Make the hook executable
chmod +x scripts/pre-commit

# Install the hook
cp scripts/pre-commit .git/hooks/pre-commit
```

This will automatically update README.md if composer.json version changes.

### Version Workflow with Git

```bash
# 1. Bump version (creates commit and tag)
npm run bump:patch

# 2. Push changes and tags
git push && git push --tags
```

## 🔍 Version Helper Functions

The project includes PHP helper functions for accessing version information:

```php
// Get application version
$version = app_version(); // "1.0.7"

// Get asset version with cache busting
$assetVersion = asset_version(); // "1.0.7.a1b2c3d4"
```

## 🛠️ Troubleshooting

### Version Out of Sync

If versions become out of sync, run:

```bash
npm run sync-version
```

### Missing Version Badge

If the README.md version badge is missing, add this line:

```markdown
![Version](https://img.shields.io/badge/Version-1.0.0-brightgreen?style=flat-square)
```

### Script Errors

Check that all required files exist:
- `package.json`
- `ci4/composer.json`
- `README.md`

## 📚 Related Files

- `scripts/sync-version.js` - Main sync script (Node.js)
- `scripts/sync-version.php` - Alternative PHP sync script
- `scripts/pre-commit` - Git pre-commit hook
- `ci4/app/Helpers/version_helper.php` - PHP version functions

---

**💡 Tip**: Always use the NPM scripts for version management to ensure all files stay synchronized!