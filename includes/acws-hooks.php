<?php


require_once plugin_dir_path(__FILE__) . './acws-classes.php';

class Acws_hooks
{
    public function __construct()
    {
        add_filter('product_type_selector', array($this, 'add_custom_product_type'));

        add_action('woocommerce_product_options_general_product_data', array($this, 'custom_product_general_options'));

        add_action('woocommerce_process_product_meta', array($this, 'save_custom_product_type'));

        add_filter('woocommerce_product_data_tabs', array($this, 'enable_inventory_tab_for_custom_product_type'));

        add_filter( 'woocommerce_order_button_text', array($this,'OrderText') );

    
        add_action('woocommerce_product_single_add_to_cart_text', array($this, 'add_to_cart_label'));

        add_action('woocommerce_product_options_inventory_product_data', array($this, 'add_stock_management_fields'));

        add_action('woocommerce_before_cart', array($this, 'cart_content'));

        add_filter('woocommerce_add_to_cart_validation', array($this, 'validate_cart_before_add'), 10, 3);


        add_action('woocommerce_loaded', array($this, 'register_custom_product_class'));


        add_filter('woocommerce_get_price_html', array($this, 'setPrice'), 10, 2);

        add_action('woocommerce_single_product_summary', array($this, 'custom_add_to_cart_button'), 30);



        add_filter('woocommerce_cart_item_price', array($this, 'custom_cart_item_price'), 10, 3);

        add_filter('woocommerce_is_purchasable', function ($purchasable, $product) {
            if ($product->get_type() === 'simple_subscription') {
                // error_log(print_r($product->get_type(), true));
                $purchasable = true;
            }
            return $purchasable;
        }, 10, 2);

    }

    public function setPrice($price_html, $product)
    {
        if (in_array($product->get_type(), ['simple_subscription', 'variable_subscription'])) {
            $subscription_price = get_post_meta($product->get_id(), '_subscription_price', true);
            $subscription_calenderUnit = get_post_meta($product->get_id(), '_subscription_calendarUnit', true);
            $formatted_price = wc_price($subscription_price);
            $price_html = sprintf('%s / %s', $formatted_price, esc_html($subscription_calenderUnit));

        }
        return $price_html;
    }

    public function add_to_cart_label()
    {
        global $product;
        if ($product->get_type() === 'simple_subscription') {

            $getOption = get_option('acws_settings');
            // error_log('')
            $label=$getOption['generalSettings']['cartLabel'];
           
            error_log(print_r($getOption,true));

           return $label;
           
        } else {
            return 'Add to Cart';
        }


    }



    public function validate_cart_before_add($passed, $product_id, $quantity)
    {
        // Get the product being added
        $product_being_added = wc_get_product($product_id);
        if (!$product_being_added) {
            return false;
        }

        $product_type_being_added = $product_being_added->get_type();
        error_log("Product being added - Type: " . $product_type_being_added);

        // Get cart items
        $cart = WC()->cart;
        if (!$cart->is_empty()) {
            foreach ($cart->get_cart() as $cart_item) {
                $cart_product = $cart_item['data'];
                $cart_product_type = $cart_product->get_type();
                error_log("Cart item type: " . $cart_product_type);

                // Check simple product with subscription
                if (
                    $product_type_being_added === 'simple' &&
                    ($cart_product_type === 'simple_subscription' || $cart_product_type === 'subscription')
                ) {
                    wc_add_notice('Simple products cannot be purchased with subscription products.', 'error');
                    return false;
                }

                // Check subscription with simple product
                if (
                    ($product_type_being_added === 'simple_subscription' || $product_type_being_added === 'subscription') &&
                    $cart_product_type === 'simple'
                ) {
                    wc_add_notice('Subscription products cannot be purchased with simple products.', 'error');
                    return false;
                }
            }
        }

        return $passed;

    }

    public function OrderText()
    {
        $getOption= get_option('acws_settings');
        $label = $getOption['generalSettings']['orderLabel'];
        $cart = WC()->cart;
        $cart_items=$cart->get_cart();
        foreach ($cart_items as $cart_item) {
          $items= $cart_item['data'];
          $item_type=$items->get_type();
          if ($item_type==='simple_subscription') {
            return $label;
          }
          else{
            return 'Place Order';
          }
        }
    }
    public function custom_cart_item_price($price, $cart_item, $cart_item_key)
    {

        if ($cart_item['data']->get_type() === 'simple_subscription') {
            $subscription_price = get_post_meta($cart_item['product_id'], '_subscription_price', true); // Use your meta key
            $price = wc_price($subscription_price);
        }
        return $price;
    }
    public function register_custom_product_class()
    {
        if (class_exists('WC_Product')) {
            new WC_Product_Simple_Subscription();
        }

        if (class_exists('WC_Product_Variable')) {

            new WC_Product_Variable_Subscription();
        }
    }





    public function custom_add_to_cart_button()
    {
        global $product;
        if ($product->is_type('simple_subscription')) {
            wc_get_template('single-product/add-to-cart/simple.php');
            error_log('yes it is');
        }
    }



    public function add_custom_product_type($types)
    {
        $types['simple_subscription'] = __('Simple Subscription', 'woocommerce');
        $types['variable_subscription'] = __('Variable Subscription', 'woocommerce');
        return $types;
    }


    public function custom_product_admin_scripts()
    {
        if (get_post_type() === 'product') {
            ?>
            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    function handleInventoryTab() {
                        var productType = $('#product-type').val();
                        if (productType === 'simple_subscription' || productType === 'variable_subscription') {
                            $('.inventory_tab').show();
                            $('.inventory_options').show();
                        }
                    }

                    handleInventoryTab();

                    $('#product-type').on('change', function () {
                        handleInventoryTab();
                    });

                    $('#_manage_stock').on('change', function () {
                        if ($(this).is(':checked')) {
                            $('.stock_fields').show();
                        } else {
                            $('.stock_fields').hide();
                        }
                    });
                });
            </script>
            <?php
        }
    }

    public function enable_inventory_tab_for_custom_product_type($tabs)
    {
        $tabs['inventory']['class'] = array_diff($tabs['inventory']['class'], ['hide_if_simple_subscription', 'hide_if_variable_subscription']);
        $tabs['inventory']['class'][] = 'show_if_simple_subscription';
        $tabs['inventory']['class'][] = 'show_if_variable_subscription';

        return $tabs;
    }

    public function add_stock_management_fields()
    {
        global $product_object;

        if ($product_object && in_array($product_object->get_type(), ['simple_subscription', 'variable_subscription'])) {
            woocommerce_wp_checkbox([
                'id' => '_manage_stock',
                'label' => __('Manage Stock?', 'woocommerce'),
                'description' => __('Enable stock management at product level', 'woocommerce')
            ]);

            // Display the stock quantity input
            woocommerce_wp_text_input([
                'id' => '_stock',
                'label' => __('Stock quantity', 'woocommerce'),
                'description' => __('Stock quantity for this product', 'woocommerce'),
                'type' => 'number',
                'custom_attributes' => [
                    'min' => '0',
                    'step' => '1'
                ]
            ]);

            // Display backorders option
            woocommerce_wp_select([
                'id' => '_backorders',
                'label' => __('Allow Backorders?', 'woocommerce'),
                'options' => [
                    'no' => __('Do not allow', 'woocommerce'),
                    'notify' => __('Allow, but notify customer', 'woocommerce'),
                    'yes' => __('Allow', 'woocommerce')
                ]
            ]);
        }
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

    public function save_custom_product_type($post_id)
    {
        if (isset($_POST['product-type'])) {
            $product_type = sanitize_text_field($_POST['product-type']);
            $price = sanitize_text_field($_POST['subscription_price']);
            $every = sanitize_text_field($_POST['subscription_every']);
            $calenderUnit = sanitize_text_field($_POST['subscription_calenderUnit']);
            $expire = sanitize_text_field($_POST['subscription_expire']);
            $SignUpFee = sanitize_text_field($_POST['subscription_signupFee']);
            $FreeTrial = sanitize_text_field($_POST['subscription_FreeTiral']);
            $syncRenewal = sanitize_text_field($_POST['subscription_Sync_renewal']);
            $SalePrice = sanitize_text_field($_POST['subscription_sale_price']);
            $salePrice_before = sanitize_text_field($_POST['subscription_salePrice_before']);
            $salePrice_after = sanitize_text_field($_POST['subscription_salePrice_after']);


            // error_log($_POST['_stock']);

            update_post_meta($post_id, '_product_type', $product_type);
            update_post_meta($post_id, '_price', $price);
            update_post_meta($post_id, '_subscription_price', $price);
            update_post_meta($post_id, '_subscription_every', $every);
            update_post_meta($post_id, '_subscription_calendarUnit', $calenderUnit);
            update_post_meta($post_id, '_subscription_expire', $expire);
            update_post_meta($post_id, '_subscription_SignUpFee', $SignUpFee);
            update_post_meta($post_id, '_subscription_FreeTrial', $FreeTrial);
            update_post_meta($post_id, '_subscription_syncRenewal', $syncRenewal);
            update_post_meta($post_id, '_subscription_SalePrice', $SalePrice);
            update_post_meta($post_id, '_subscription_salePrice_before', $salePrice_before);
            update_post_meta($post_id, '_subscription_salePrice_after', $salePrice_after);

           error_log(get_post_meta($post_id,'_price',true));
        } else {
            // error_log('product_type is not set');
        }
    }

}





