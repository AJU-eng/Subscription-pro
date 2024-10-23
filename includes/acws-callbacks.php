<?php
class Acws_callbacks
{

    public function generalSettings($data)
    {
        $json_data = $data->get_params();
        update_option('acws_settings',$json_data);
    }
    
    public function getSettings()
    {
        $data=get_option('acws_settings');
       return new WP_REST_Response($data,200);
    }

    public function getPermission()
    {
        return true;
    }
}