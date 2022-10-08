<?php

namespace app\ext;

use Yii;
use yii\web\UrlRuleInterface;

class Yii2UrlEncrypt implements UrlRuleInterface
{
    public $cipher_algo = 'AES-256-CBC';
    public $passphrase = '12345';

    public function createUrl($manager, $route, $params)
    {
        $paramStringEncoded = '';
        if ($params !== null) {
            $i = 1;
            $count = count($params);
            foreach ($params as $key => $value) {
                $strval = $this->encrypt($value);
                if ($i != $count) {
                    $strval .= '&';
                }
                $paramStringEncoded .= $key . '=' . $strval;
                $i++;
            }
        }
        return empty($params) ? $route : $route . '?' . $paramStringEncoded;
    }

    public function encrypt($plaintext)
    {
        $key = hash('sha256', $this->passphrase);
        $iv = substr(hash('sha256', 16), 0, 16);
        $output = openssl_encrypt($plaintext, $this->cipher_algo, $key, 0, $iv);
        return base64_encode($output);

    }

    public function decrypt($ciphertext)
    {
        $key = hash('sha256', $this->passphrase);
        $iv = substr(hash('sha256', 16), 0, 16);
        $decrypttext = openssl_decrypt(base64_decode($ciphertext), $this->cipher_algo, $key, 0, $iv);
        if (!$decrypttext) {
            return null;
        }
        return $decrypttext;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        $param = $request->getQueryParams();
        if (!empty($param)) {
            $paramStringDecode = [];
            foreach ($param as $key => $value) {
                $paramStringDecode[$key] = $this->decrypt($value);
            }
            return [$pathInfo, $paramStringDecode];
        }
        return false;
    }
}