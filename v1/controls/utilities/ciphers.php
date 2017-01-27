<?php
/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/2/2015
 * Time: 12:10 AM
 */

for ($i = 0; $i <= 105; $i++) {
    $method = openssl_get_cipher_methods()[$i];
    $ivlen = openssl_cipher_iv_length($method);

    echo "$i. "."$method: "." $ivlen \r\n"."<br/>";
}

