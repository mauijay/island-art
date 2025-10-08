<?php

/**
 * Vite Helper Functions for CodeIgniter 4
 */

if (!function_exists('vite_get_dev_server_url')) {
  /**
   * Get the Vite dev server URL (checks multiple ports)
   */
  function vite_get_dev_server_url(): ?string
  {
    $ports = [3000, 3001, 3002, 3003]; // Check common ports
    $context = stream_context_create([
      'http' => [
        'timeout' => 0.2, // Reduced from 1 second to 0.2 seconds
        'ignore_errors' => true
      ]
    ]);

    foreach ($ports as $port) {
      $url = "http://localhost:$port";
      if (@file_get_contents($url, false, $context) !== false) {
        return $url;
      }
    }
    
    return null;
  }
}

if (!function_exists('vite_asset')) {
  /**
   * Generate Vite asset URL for development or production
   */
  function vite_asset(string $entry): string
  {
    $isDev = ENVIRONMENT === 'development';

    if ($isDev) {
      $viteDevServer = vite_get_dev_server_url();
      
      if ($viteDevServer) {
        return $viteDevServer . '/' . $entry;
      }
    }

    // Production mode or dev server not running - use manifest
    return vite_manifest_asset($entry);
  }
}

if (!function_exists('vite_manifest_asset')) {
  /**
   * Get asset path from Vite manifest
   */
  function vite_manifest_asset(string $entry): string
  {
    static $manifest = null;

    if ($manifest === null) {
      $manifestPath = FCPATH . 'assets/.vite/manifest.json';

      if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
      } else {
        $manifest = [];
      }
    }

    if (isset($manifest[$entry])) {
      return base_url('assets/' . $manifest[$entry]['file']);
    }

    // Fallback for missing manifest
    return base_url('assets/' . $entry);
  }
}

if (!function_exists('vite_dev_scripts')) {
  /**
   * Include Vite development scripts
   */
  function vite_dev_scripts(): string
  {
    $isDev = ENVIRONMENT === 'development';

    if (!$isDev) {
      return '';
    }

    $viteDevServer = vite_get_dev_server_url();

    if ($viteDevServer) {
      return '<script type="module" src="' . $viteDevServer . '/@vite/client"></script>';
    }

    return '';
  }
}

if (!function_exists('vite_css_assets')) {
  /**
   * Get CSS assets from manifest for production
   */
  function vite_css_assets(string $entry): array
  {
    static $manifest = null;

    if ($manifest === null) {
      $manifestPath = FCPATH . 'assets/.vite/manifest.json';

      if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
      } else {
        $manifest = [];
      }
    }

    $cssAssets = [];

    if (isset($manifest[$entry]['css'])) {
      foreach ($manifest[$entry]['css'] as $cssFile) {
        $cssAssets[] = base_url('assets/' . $cssFile);
      }
    }

    return $cssAssets;
  }
}
