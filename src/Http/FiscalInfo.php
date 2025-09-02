<?php

namespace Jooyeshgar\Moadian\Http;

use Jooyeshgar\Moadian\Facades\Moadian;
use Jooyeshgar\Moadian\Services\EncryptionService;
use Jooyeshgar\Moadian\Services\SignatureService;
use Jooyeshgar\Moadian\Traits\HasToken;

class FiscalInfo extends Request
{
    use HasToken;

    public function __construct()
    {
        parent::__construct();

        $this->path = 'fiscal-information';
        $this->params['memoryId'] = Moadian::getUsername();
    }

    public function prepare(SignatureService $signer, EncryptionService $encryptor)
    {
        $this->addToken($signer);
    }
}