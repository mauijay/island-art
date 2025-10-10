#!/usr/bin/env php
<?php
/**
 * Version Sync Script
 * 
 * This script synchronizes the version number between composer.json and README.md
 * Run this after updating the version in composer.json
 * 
 * Usage: php scripts/sync-version.php
 */

function updateReadmeVersion($newVersion) {
    $readmePath = __DIR__ . '/../README.md';
    
    if (!file_exists($readmePath)) {
        echo "❌ README.md not found at: $readmePath\n";
        return false;
    }
    
    $content = file_get_contents($readmePath);
    
    // Update the version badge
    $pattern = '/(\!\[Version\]\(https:\/\/img\.shields\.io\/badge\/Version-)([0-9]+\.[0-9]+\.[0-9]+)(-brightgreen\?style=flat-square\))/';
    $replacement = '${1}' . $newVersion . '${3}';
    
    $updatedContent = preg_replace($pattern, $replacement, $content);
    
    if ($updatedContent === $content) {
        echo "⚠️  No version badge found in README.md or version already up to date\n";
        return false;
    }
    
    if (file_put_contents($readmePath, $updatedContent)) {
        echo "✅ README.md version updated to: $newVersion\n";
        return true;
    } else {
        echo "❌ Failed to write to README.md\n";
        return false;
    }
}

function getComposerVersion() {
    $composerPath = __DIR__ . '/../ci4/composer.json';
    
    if (!file_exists($composerPath)) {
        echo "❌ composer.json not found at: $composerPath\n";
        return null;
    }
    
    $composerData = json_decode(file_get_contents($composerPath), true);
    
    if (!isset($composerData['version'])) {
        echo "❌ No version found in composer.json\n";
        return null;
    }
    
    return $composerData['version'];
}

function main() {
    echo "🔄 Island Art Version Sync Script\n";
    echo "==================================\n\n";
    
    $version = getComposerVersion();
    
    if ($version === null) {
        exit(1);
    }
    
    echo "📦 Current composer.json version: $version\n";
    
    if (updateReadmeVersion($version)) {
        echo "\n🎉 Version sync completed successfully!\n";
        exit(0);
    } else {
        echo "\n❌ Version sync failed!\n";
        exit(1);
    }
}

// Run the script if called directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    main();
}