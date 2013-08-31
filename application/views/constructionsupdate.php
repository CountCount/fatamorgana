<?php
/*switch ($_SERVER['HTTP_ORIGIN']) {
    case 'http://dieverdammten.de': 
    case 'https://www.dieverdammten.de':
    header('Access-Control-Allow-Origin: '.$_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    header('Access-Control-Max-Age: 1000');
    header('Access-Control-Allow-Headers: Content-Type');
    break;
}
*/
print $msg;
if ( isset($debug) && $debug != '' ) {
  print '<pre>'.$debug.'</pre>';
}