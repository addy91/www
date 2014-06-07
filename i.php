<?php

function find_mobile_browser() {
    if(preg_match('/(iphone|ipad|ipod|android|htc|smartphone|)/i', $_SERVER['HTTP_USER_AGENT'])) {
        return true;
    } else {
        return false;
    }
}


$mobile_browser = find_mobile_browser(); 
if($mobile_browser) { 
    echo "Hallo Handy"; /* Wenn mobile Browser gefunden, dann tue dies */ 
} else { 
    echo "Hallo PC"; /* Ansonsten tue das */ 
}

?>

