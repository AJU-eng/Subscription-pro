<?php
class Acws_callbacks
{

    public function generalSettings($data)
    {
        $json_data = $data->get_params();
        update_option('acws_settings',$json_data);
    }
    public function paymentSettings($data)
    {
        $json_data = $data->get_params();
        $getOption=get_option('acws_generalSettings');
        $generalSettings=$getOption['generalSettings'];
        $settings=[];
        $generalSettings=$json_data['generalSettings'];
        array_push($settings,$getOption);
        array_push($settings,$json_data);
        error_log(print_r($settings,true));

        // error_log(print_r($json_data,true));
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