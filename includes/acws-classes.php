<?php 

   class Product_type_register extends WC_Product{
    public function __construct( $product ) {
        $this->product_type = 'simple_subscription';
	parent::__construct( $product );
   }
}