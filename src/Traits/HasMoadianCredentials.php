<?php

namespace Jooyeshgar\Moadian\Traits;

trait HasMoadianCredentials
{
    /**
     * Check if user has Moadian credentials
     */
    public function hasMoadianCredentials(): bool
    {
        return !empty($this->moadian_username) &&
            !empty($this->moadian_private_key_path) &&
            !empty($this->moadian_certificate_path);
    }

    /**
     * Get Moadian credentials
     */
    public function getMoadianCredentials(): array
    {
        return [
            'username' => $this->moadian_username,
            'private_key_path' => $this->moadian_private_key_path,
            'certificate_path' => $this->moadian_certificate_path,
        ];
    }
}