<?php

class Acws_hooks
{
    public function __construct()
    {
        add_filter('product_type_selector', array($this, 'add_custom_product_type'));
        add_action('woocommerce_product_options_general_product_data', array($this, 'custom_product_general_options'));

    }

    public function add_custom_product_type($types)
    {
        $types['simple_subscription'] = __('Simple Subscription', 'woocommerce');
        $types['variable_subscription'] = __('Variable Subscription', 'woocommerce');
        return $types;
    }

    public function custom_product_general_options()
    {
        echo '<div class="options_group show_if_simple_subscription show_if_variable_subscription ">';
          echo '<form>';
            echo '<input class="acws-inputType" style="" type="text"/>';
          echo '</form>';
        echo '</div>';
    }

}



