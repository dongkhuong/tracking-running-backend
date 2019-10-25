<?php

namespace App\Http\Traits;

use Crypt;

trait CryptData
{
    /**
     * Verify that the encryption payload is valid.
     *
     * @param mixed $payload
     * @return bool
     */
    static function validPayload($payload)
    {
        $payload = json_decode(base64_decode($payload), true);

        //The correct $payload is the payload is array and contain 'iv', 'value', 'mac'
        return is_array($payload) && isset($payload['iv'], $payload['value'], $payload['mac']);
    }

    /**
     * Encrypt Data
     *
     * @param String $valueBeingEncrypt
     * @return String
     */
    protected function encryptData($valueBeingEncrypt)
    {
        return Crypt::encrypt($valueBeingEncrypt);
    }

    /**
     * Decrypt Data
     *
     * @param String $signature
     * @return mixed
     */
    protected function decryptData($signature)
    {
        if (CryptData::validPayload($signature)) {
            
            return Crypt::decrypt($signature);
        }

        return false;
    }
}
