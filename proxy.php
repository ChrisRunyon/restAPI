<?php

//require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthException2.php');
//require_once($_SERVER['DOCUMENT_ROOT'].'/oauth-php/src/OAuth1/OAuthRequestVerifier.php');

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 12/11/2015
 * Time: 7:24 PM
 */
 header('Access-Control-Allow-Origin: http://127.0.0.1');
 header("Access-Control-Allow-Credentials: true");
 header('Access-Control-Allow-Headers: X-Requested-With');
 header('Access-Control-Allow-Headers: Content-Type');
 header('Access-Control-Allow-Methods: GET');
 header('Access-Control-Max-Age: 86400');

//Check if this is an image. if So print correct header.
if (strpos($_REQUEST['proxy'],'png') !== false) {
    header('Content-Type: image/png');
} else {
    header('Content-Type: text/plain');
}

$a = $_SERVER['HTTP_ORIGIN'];
if($a !== "http://127.0.0.1"){
    header("HTTP/1.0 403 Forbidden");
    exit;
}

$proxyFile = (isset($_REQUEST['proxy'])? $_REQUEST['proxy'] : null);

if ( isset($proxyFile)){
    // the files sent to us aren't properly url encoded
    $proxyFile = str_replace(' ', '+', $proxyFile);

    $content = file_get_contents($proxyFile);

    print($content);
}
else {
    echo "ERROR: no file to proxy";
}