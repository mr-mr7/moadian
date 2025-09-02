<?php

namespace Jooyeshgar\Moadian\Traits;

use Jooyeshgar\Moadian\Facades\Moadian;
use Jooyeshgar\Moadian\Services\SignatureService;

trait HasToken
{
    /**
     * Create authorization token
     *
     * @param SignatureService $signer
     *
     */
    public function addToken(SignatureService $signer)
    {
        $payload = [
            'nonce' => Moadian::getNonce(),
            'clientId' => Moadian::getUsername(),
        ];

        $token = $signer->sign($payload);

        $auth = 'Bearer ' . $token;
        $this->headers['authorization'] = $auth;
    }
}
