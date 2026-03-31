<?php
/**
 * VIVA Admin - Centralized Route Definitions
 * 
 * All admin panel routes are defined here in one place.
 * Use the route() helper function to generate URLs throughout the admin panel.
 * 
 * Usage:
 *   route('dashboard')                        → /VIVA/admin/dashboard.php
 *   route('products')                         → /VIVA/admin/products/
 *   route('products.add')                     → /VIVA/admin/products/?action=add
 *   route('products.edit', ['id' => 5])       → /VIVA/admin/products/?edit=5
 *   route('products.delete', ['id' => 5])     → /VIVA/admin/products/?delete=5
 */

// ─── Route Definitions ───────────────────────────────────────────────
// Each route maps a friendly name to a path relative to ADMIN_URL
$ADMIN_ROUTES = [

    // ── Auth ──
    'login'              => '/login.php',
    'logout'             => '/logout.php',

    // ── Dashboard ──
    'dashboard'          => '/dashboard.php',

    // ── Categories ──
    'categories'         => '/categories/',
    'categories.edit'    => '/categories/?edit={id}',
    'categories.delete'  => '/categories/?delete={id}',
    'categories.toggle'  => '/categories/?toggle_featured={id}',

    // ── Products ──
    'products'           => '/products/',
    'products.add'       => '/products/?action=add',
    'products.edit'      => '/products/?edit={id}',
    'products.delete'    => '/products/?delete={id}',
    'products.toggle'    => '/products/?toggle_featured={id}',

    // ── Messages ──
    'messages'           => '/messages.php',

    // ── Gallery ──
    'gallery'            => '/gallery/',
    'gallery.delete'     => '/gallery/?delete={id}',

    // ── Media Library ──
    'media'              => '/media-library.php',

    // ── Settings ──
    'settings'           => '/settings.php',

    // ── Export ──
    'export.pdf'         => '/export_pdf.php',

    // ── API Endpoints ──
    'api.contact'        => '/api/contact.php',
    'api.media'          => '/api/media.php',

    // ── Frontend (relative to site root) ──
    'site.home'          => '/',
    'site.products'      => '/products.php',
    'site.product'       => '/product-detail.php?product={slug}',
];


// ─── Route Helper Function ───────────────────────────────────────────
/**
 * Generate a full URL for a named admin route.
 *
 * @param  string $name    Route name (e.g. 'dashboard', 'products.edit')
 * @param  array  $params  Placeholder replacements (e.g. ['id' => 5])
 * @return string          Full URL path
 */
function route($name, $params = []) {
    global $ADMIN_ROUTES;

    if (!isset($ADMIN_ROUTES[$name])) {
        // Fallback: return ADMIN_URL + name as-is (safety net)
        return ADMIN_URL . '/' . $name;
    }

    $path = $ADMIN_ROUTES[$name];

    // Replace {placeholder} tokens with actual values
    foreach ($params as $key => $value) {
        $path = str_replace('{' . $key . '}', urlencode($value), $path);
    }

    // Site-level routes don't use ADMIN_URL prefix
    if (strpos($name, 'site.') === 0) {
        return BASE_URL . $path;
    }

    return ADMIN_URL . $path;
}

/**
 * Check if the current page matches a route name.
 * Useful for active nav highlighting.
 *
 * @param  string $name  Route name to check
 * @return bool
 */
function is_route($name) {
    global $ADMIN_ROUTES;

    if (!isset($ADMIN_ROUTES[$name])) {
        return false;
    }

    $route_path = $ADMIN_ROUTES[$name];
    $current    = $_SERVER['PHP_SELF'];

    // For directory-style routes (e.g. /products/), check if current URL contains that path
    if (substr($route_path, -1) === '/') {
        $check = '/admin' . rtrim($route_path, '/');
        return strpos($current, $check) !== false;
    }

    // For file-style routes, match the basename
    $route_file = basename(parse_url($route_path, PHP_URL_PATH));
    $current_file = basename($current);

    return $route_file === $current_file;
}
?>
