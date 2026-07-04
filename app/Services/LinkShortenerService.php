<?php

namespace App\Services;

use Hashids\Hashids;

class LinkShortenerService
{
    private Hashids $hashids;

    public function __construct()
    {
        $this->hashids = new Hashids(
            config('app.key'), 
            6, 
            'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ23456789'
        );
    }

    public function encode(int $id): string
    {
        return $this->hashids->encode($id);
    }
}