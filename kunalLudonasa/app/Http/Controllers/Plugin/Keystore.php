<?php

namespace App\Http\Controllers\plugin;

use App\Http\Controllers\Controller;

class KeyStore extends Controller
{
    public function parseKeyStore($keyStorePath)
    {
        $myfile = fopen($keyStorePath . "keystore.pooh", "r") or die("Unable to open file!");

        $decData = $this->xor_this(fread($myfile, filesize($keyStorePath . "keystore.pooh")));

        fclose($myfile);
        //echo $decData;
        //die();
        return $decData;
    }
    public function hex2ByteArray($hexString)
    {
        $string = hex2bin($hexString);
        return unpack('C*', $string);
    }

    public function byteArray2String($byteArray)
    {
        $chars = array_map("chr", $byteArray);
        return join($chars);
    }
    public function xor_this($text)
    {
        $key = 'frtkj';
        $i = 0;
        $encrypted = '';
        foreach (str_split($text) as $char) {
            $encrypted .= chr(ord($char) ^ ord($key[$i++ % strlen($key)]));
        }
        return $encrypted;
    }
}
