<?php 



class WC_Product_Simple_Subscription extends WC_Product
{
    public function get_type()
    {
        return 'simple_subscription';
    }

    public function supports( $feature ) {
        $supported_features = ['ajax_add_to_cart', 'virtual', 'downloadable', 'purchasable'];
        return in_array( $feature, $supported_features ) || parent::supports( $feature );
    }
}



class WC_Product_Variable_Subscription extends WC_Product
{
    public function get_type()
    {
        return 'variable_subscription';
    }
}

