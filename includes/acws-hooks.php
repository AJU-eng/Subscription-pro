<?php

require_once plugin_dir_path(__FILE__) . '/acws-classes.php';

class Acws_hooks 
{
    public function __construct()
    {



        add_filter('product_type_selector', array($this, 'add_custom_product_type'));
        add_action('woocommerce_product_options_general_product_data', array($this, 'custom_product_general_options'));
        add_action('woocommerce_process_product_meta', array($this, 'save_custom_product_type'));
        add_action('woocommerce_admin_process_product_object', array($this, 'load_custom_product_type'));

        add_action('plugins_loaded', function() {
            if (class_exists('WC_Product')) {
                new Product_type_register();
            } else {
                error_log('WC_Product class not found!');
            }
        });
        
    }


    // public function register_custom_product_types()
    // {
    //     if (class_exists('WC_Product')) {
    //         # code...
    //         new Product_type_register();
    //     }
    // }

    // function register_custom_product_types() {
    //     // Declare the custom product types
    //     if (class_exists('WC_Product_Simple')) {
    //         class WC_Product_Simple_Subscription extends WC_Product_Simple {
    //             public function get_type() {
    //                 return 'simple_subscription';
    //             }
    //         }
    //     }

    //     if (class_exists('WC_Product_Variable')) {
    //         class WC_Product_Variable_Subscription extends WC_Product_Variable {
    //             public function get_type() {
    //                 return 'variable_subscription';
    //             }
    //         }
    //     }
    // }

    public function add_custom_product_type($types)
    {
        $types['simple_subscription'] = __('Simple Subscription', 'woocommerce');
        $types['variable_subscription'] = __('Variable Subscription', 'woocommerce');
        return $types;
    }

    public function load_custom_product_type($product)
    {
        $custom_product_type = get_post_meta($product->get_id(), '_product_type', true);
        if ($custom_product_type) {
            $product->set_type($custom_product_type);  // Set the custom type
        }
    }


    public function register_custom_product_class($classname, $product_type)
    {
        // Define a default product class for the custom product types
        if ($product_type === 'simple_subscription') {
            return 'WC_Product_Simple';
        }
        if ($product_type === 'variable_subscription') {
            return 'WC_Product_Variable';
        }

        // Default to the original class name
        return $classname;
    }


    public function custom_product_general_options()
    {
        include(plugin_dir_path(__FILE__) . '../templates/general-options.php');
        global $post;
        $product = wc_get_product($post->ID);

        if ($product && in_array($product->get_type(), ['simple_subscription'])) {
            echo '<script>
                jQuery(document).ready(function($) {
                    $("select#product-type").val("' . esc_js($product->get_type()) . '").change();
                });
            </script>';
        }
    }

    // public function save_custom_product_type($post_id) {

    //     if (isset($_POST['product-type'])) {
    //         $product_type = sanitize_text_field($_POST['product-type']);
    //         $price = sanitize_text_field($_POST['subscription_price']);
    //         error_log(print_r($product_type, true));
    //         error_log(print_r($price, true));

    //         // Update the product type meta
    //         update_post_meta($post_id, '_product_type', $product_type);
    //     } else {
    //         error_log("product_type is not set");
    //     }
    // }


    public function save_custom_product_type($post_id)
    {
        if (isset($_POST['product-type'])) {
            $product_type = sanitize_text_field($_POST['product-type']);
            $price = sanitize_text_field($_POST['subscription_price']);

            error_log(print_r($product_type, true));
            error_log(print_r($price, true));

            update_post_meta($post_id, '_product_type', $product_type);


            $saved_product_type = get_post_meta($post_id, '_product_type', true);

            if ($saved_product_type === $product_type) {
                error_log('Custom product type saved successfully: ' . $saved_product_type);
            } else {
                error_log('Failed to save custom product type.');
            }
        } else {
            error_log('product_type is not set');
        }
    }

}





