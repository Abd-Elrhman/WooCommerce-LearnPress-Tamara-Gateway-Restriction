# WooCommerce LearnPress Tamara Gateway Restriction

This WordPress plugin restricts the Tamara payment gateways in WooCommerce based on the LearnPress course category.

## Description

This plugin adds a filter to the WooCommerce checkout process to dynamically hide Tamara payment gateways when products in the cart belong to a specific LearnPress course category. The Tamara payment gateways are hidden using JavaScript on the client side.

## Requirements

- WordPress
- WooCommerce
- LearnPress

## Installation

1. Download the plugin ZIP file.
2. Extract the contents into your WordPress plugins directory.
3. Activate the plugin through the WordPress admin dashboard.

## Configuration

No additional configuration is required. The plugin will automatically detect the LearnPress course category and restrict the Tamara payment gateways accordingly.

## Usage

1. Ensure that LearnPress and WooCommerce are installed and activated.
2. Configure your LearnPress courses and assign them to categories.
3. Add Tamara payment gateways to your WooCommerce store.
4. Tamara payment gateways will be automatically restricted when products from the specified LearnPress course category are in the cart.

## Hooks

The plugin uses the `woocommerce_available_payment_gateways` filter to modify the available payment gateways dynamically.

## Development

For development purposes, you may want to use the provided JavaScript code within your theme or enqueue it properly using WordPress functions.

```php
// Example enqueue script in functions.php
function enqueue_custom_script() {
    wp_enqueue_script( 'custom-script', get_template_directory_uri() . '/js/custom-script.js', array( 'jquery' ), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_script' );
