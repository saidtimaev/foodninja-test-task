<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table(timestamps: false)]
class LinkVisit extends Model
{
    protected $fillable = ['link_id', 'ip_address'];

    public function link(): BelongsTo
    {
        return $this->belongsTo(Link::class)->withTrashed();
    }
}
