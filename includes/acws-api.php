<?php
require_once plugin_dir_path(__FILE__). 'acws-api.php';
class Acws_api
{
    private $callback;
    public function __construct($callback)
    {
        $this->callback = $callback;
        add_action('rest_api_init', array($this, 'register_routes'));
    }

    public function register_routes()
    {
        register_rest_route(
            'acws/v1',
            '/generalSettings',
            array(
                'methods' => 'POST',
                'callback' => array($this->callback, 'generalSettings'),
                'permission_callback'=> array($this->callback,'getPermission')
            )
        );
        register_rest_route(
            'acws/v1',
            '/getSettings',
            array(
                'methods' => 'GET',
                'callback' => array($this->callback, 'getSettings'),
                'permission_callback'=> array($this->callback,'getPermission')
            )
        );
    }



}