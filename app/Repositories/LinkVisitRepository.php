<?php

namespace App\Repositories;

use App\Models\LinkVisit;

class LinkVisitRepository 
{
    public function create(int $linkId, string $ipAddress): LinkVisit
    {
        return LinkVisit::create([
            'link_id' => $linkId,
            'ip_address' => $ipAddress,
        ]);
    }
}