<?php

namespace App\Repositories;
use App\Models\Link;

class LinkRepository {
    public function findByCode(string $code): ?Link {
        return Link::where('code', $code)->first();
    }
}