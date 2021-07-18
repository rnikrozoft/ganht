<?php
set_time_limit(259200);
include_once('simple_html_dom.php');

$url = "https://nhentai.net/";

for($i=1;$i<11662;$i++){
    $html = file_get_html($url."?page=".$i);
    foreach($html->find('div[class=gallery] a') as $element) {
        $url = "https://nhentai.net".$element->href;
        $html_img = file_get_html($url);

        $pwd = md5(rand());
        $foldername = substr($pwd, -4);
        mkdir($foldername);

        $key = 1;
        foreach($html_img->find('a[class=gallerythumb] img') as $el){
            $datasrc = $el->getAttribute('data-src');
            if($datasrc != ''){
                file_put_contents($foldername.'/'.$key.".jpg", file_get_contents($datasrc));
                $key++;
            }
        }
    }
}

?>