<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //==================================================================================
    public static function get(){
        $jsonString = file_get_contents(base_path('resources/json/config.json'));
        return json_decode($jsonString, true);
    }
    //==================================================================================


    //==================================================================================
    public static function get_setting_default(){
        $jsonString = file_get_contents(base_path('resources/json/config.json'));
        $jsn = json_decode($jsonString, true);
        return $jsn['setting']['default'];
    }
    //==================================================================================


    //==================================================================================
    public static function get_fhair_cs(){
        $jsonString = file_get_contents(base_path('resources/json/config.json'));
        $jsn = json_decode($jsonString, true);
        return $jsn['fhair_hl7']['CodeSystem'];
    }

    public static function put_fhair_cs_url($name, $url){
        $jsonString = file_get_contents(base_path('resources/json/config.json'));
        $data = json_decode($jsonString, true);

        // Update Key
        $data['fhair_hl7']['CodeSystem'][$name]['url']  = $url;

        // Write File
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/json/config.json'), stripslashes($newJsonString));
    }
    //==================================================================================


    //==================================================================================
    public static function get_setting_form(){
        $jsonString = file_get_contents(base_path('resources/json/config.json'));
        $jsn = json_decode($jsonString, true);
        return $jsn['setting']['form'];
    }
    //==================================================================================

    public static function put_setting_default_alamat($country, $provinsi, $kota, $kecamatan, $kelurahan){
        $jsonString = file_get_contents(base_path('resources/json/config.json'));
        $data =  json_decode($jsonString, true);

        $def = [
            "id" => "",
            "nama" => "",
            "kode" => ""
        ];

        // Update Key
        $data['setting']['default']['def_alamat_country']     = $country != '' ? $country : $def;
        $data['setting']['default']['def_alamat_provinsi']    = $provinsi != '' ? $provinsi : $def; 
        $data['setting']['default']['def_alamat_kota']        = $kota != '' ? $kota : $def;
        $data['setting']['default']['def_alamat_kecamatan']   = $kecamatan != '' ? $kecamatan : $def;
        $data['setting']['default']['def_alamat_kelurahan']   = $kelurahan != '' ? $kelurahan : $def;

        // Write File
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/json/config.json'), stripslashes($newJsonString));
    }

    public static function put(
            $name, 
            $dark_mode, 
            $navbar_variants,
            $navbar_fixed,
            $icon_mini,
            $icon_medium,
            $footer,
            $pop_up,
            $tag_line,
            $alamat,
            $no_tlp,
            $email
        ){
        $jsonString = file_get_contents(base_path('resources/json/config.json'));
        $data =  json_decode($jsonString, true);

        // Update Key
        $data['name']               = $name;
        $data['dark_mode']          = $dark_mode; 
        $data['navbar_variants']    = $navbar_variants;
        $data['navbar_fixed']       = $navbar_fixed;
        $data['icon_mini']          = $icon_mini;
        $data['icon_medium']        = $icon_medium;
        $data['footer']             = $footer;
        $data['pop_up']             = $pop_up;

        $data['tag_line']           = $tag_line;
        $data['alamat']             = $alamat;
        $data['no_tlp']             = $no_tlp;
        $data['email']              = $email;


        // Write File
        $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents(base_path('resources/json/config.json'), stripslashes($newJsonString));
    }
}
