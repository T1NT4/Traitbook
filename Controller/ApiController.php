<?php
class ApiController{
    function getDataFrom16PersonalitiesLink($Link){
        $raw_page = file_get_contents($Link);
    
        $start_data_needle = ':data="';
        $loc_start_data =  strpos($raw_page,$start_data_needle);
    
        $data_with_rest_of_page = substr($raw_page, $loc_start_data+strlen($start_data_needle));
    
        $loc_start_rest_of_page = strpos($data_with_rest_of_page,'fullTypeHtml');
    
        $data_raw = substr($data_with_rest_of_page, 0, $loc_start_rest_of_page-7);
        $data_raw = $data_raw. "}";
        $data_raw = html_entity_decode($data_raw);
    
    
        $data = json_decode($data_raw, true, 512, JSON_THROW_ON_ERROR);
        return $data;
    }
}