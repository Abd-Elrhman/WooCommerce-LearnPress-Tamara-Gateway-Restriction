function unset_gateway_by_category( $available_gateways ) {
    // Check if the user is in the admin area, if true, return the original available gateways
    if ( is_admin() ) return $available_gateways;

    // Check if the user is not on the checkout page, if true, return the original available gateways
    if ( ! is_checkout() ) return $available_gateways;
    
    // Set initial value for the $unset variable
    $unset = false;
    
    // Set the category ID to 42
    $category_id = 42; 
    
    // Loop through the cart contents
    foreach ( WC()->cart->get_cart_contents() as $key => $values ) {
        // Get the terms (categories) associated with the product
        $terms = get_the_terms( $values['product_id'], 'course_category' ); 
        
        // Check if terms exist and no error occurred
        if ( $terms && ! is_wp_error( $terms ) ) {
            // Loop through each term
            foreach ( $terms as $term ) {
                // Check if the term ID matches the specified category ID
                if ( $term->term_id == $category_id ) {
                    // If a match is found, set $unset to true and break out of the loop
                    $unset = true;
                    break;
                }
            }
        }
    }
    
    // If $unset is true, hide the Tamara payment gateways using JavaScript
    if ( $unset == true ) {
        echo '<script type="text/javascript">';
        echo "var tamaraGatewayCheckout = document.querySelector('li.wc_payment_method.payment_method_tamara-gateway-checkout');";
        echo "if (tamaraGatewayCheckout) {tamaraGatewayCheckout.style.display = 'none';}";
        echo "var tamaraGatewayCheckout2 = document.querySelector('li.wc_payment_method.payment_method_tamara-gateway-pay-now');";
        echo "if (tamaraGatewayCheckout2) {tamaraGatewayCheckout2.style.display = 'none';}";
        echo "</script>";
    }
    
    // Return the modified or original available gateways
    return $available_gateways;
}

// Hook the function into the checkout process
add_filter( 'woocommerce_available_payment_gateways', 'unset_gateway_by_category');
