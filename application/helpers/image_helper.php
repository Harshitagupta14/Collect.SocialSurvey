<?php

if (!function_exists('image')) {
    function image($image_path, $preset,$extra=null) {
       
        $pathinfo = pathinfo($image_path);
        $new_path = $image_path;
       
        // check if requested preset exists
        if (isset($preset)) {
            base_url().$new_path = $pathinfo["dirname"] . "/" . $pathinfo["filename"] . "-" . implode("x", $preset) . "." . $pathinfo["extension"];
        }
        if($extra)
        {
	        $new_path.='?'.$extra;
        }
        return $new_path;
    }
    
if(!function_exists('imgwidthheight'))
{
  function imgwidthheight($path = '')
    {
       
        
        $vals = @getimagesize($path);
          // print_r($vals);                   
        
           // $v['width']            = $vals['0'];
           // $v['height']        = $vals['1'];            
            return  $vals[3];
       
    }
} 
}
