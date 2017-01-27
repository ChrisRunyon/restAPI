<?php
/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/2/2015
 * Time: 12:10 AM
 */

//Iterate and echo out openssl methods for reference
for ($i = 0; $i <= 24; $i++) {
    $method = openssl_get_md_methods()[$i];

    echo "$method \r\n"."<br/>";
}

