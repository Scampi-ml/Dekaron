<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('add_js')){
    function add_js($file=''){
        $str = '';
        $ci = &get_instance();
        $header_js  = $ci->config->item('header_js');
 
        if(empty($file)){return;}
 
        if(is_array($file)){
            if(!is_array($file) && count($file) <= 0){
                return;
            }
            array_push($header_js, $file);
            $ci->config->set_item('header_js',$header_js);
        }else{
            $str = $file;
            $header_js[] = $str;
            $ci->config->set_item('header_js',$header_js);
        }
    }
}
 
//Dynamically add CSS files to header page
if(!function_exists('add_css')){
    function add_css($file=''){
        $str = '';
        $ci = &get_instance();
		$ci->config->set_item('header_css', array_merge($ci->config->item('header_css'), $file));
    }
}
 
if(!function_exists('put_headers')){
    function put_headers(){
        $str = '';
        $ci = &get_instance();
        $header_css = $ci->config->item('header_css');
        $header_js  = $ci->config->item('header_js');
        foreach($header_css AS $item){
            $str .= '<link rel="stylesheet" href="'.base_url().'assets/css/'.$item.'" type="text/css" />'."\n";
        }
 
        foreach($header_js AS $item){
            $str .= '<script type="text/javascript" src="'.base_url().'assets/js/'.$item.'"></script>'."\n";
        }
        return $str;
    }
}