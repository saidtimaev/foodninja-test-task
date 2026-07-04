<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Observers\LinkObserver;
use Illuminate\Database\Eloquent\SoftDeletes;

#[ObservedBy([LinkObserver::class])]
class Link extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'original_url', 'code'];

    protected static function booted(): void
    {
        if (auth()->check()) {
            static::addGlobalScope('user_links', function ($builder) {
                // Без лишних слов: каждый видит только свои ссылки
                $builder->where('user_id', auth()->id());
            });
        }
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(LinkVisit::class);
    }
}
