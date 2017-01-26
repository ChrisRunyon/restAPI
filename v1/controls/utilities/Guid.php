<?php

/**
 * Created by PhpStorm.
 * User: Maestro
 * Date: 11/1/2015
 * Time: 3:58 PM
 */
class Guid {

    public function __construct() {}

    public function guid($opt = false) {       //  Set to true to generate Microsoft GUID
        if(function_exists('com_create_guid') ){
            if( $opt ) {
                return com_create_guid();
            } else {
                return trim( com_create_guid(), '{}' );
            }
        } else {
            mt_srand( (double)microtime() * 10000 );    // optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = $opt ? chr( 45 ) : "";    // "-"
            $left_curly = $opt ? chr(123) : "";     //  "{"
            $right_curly = $opt ? chr(125) : "";    //  "}"
            $uuid = $left_curly
                . substr( $charid, 0, 8 ) . $hyphen
                . substr( $charid, 8, 4 ) . $hyphen
                . substr( $charid, 12, 4 ) . $hyphen
                . substr( $charid, 16, 4 ) . $hyphen
                . substr( $charid, 20, 12 )
                . $right_curly;
            return $uuid;
        }
    }
}
