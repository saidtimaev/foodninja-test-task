<?php

namespace App\Observers;

use App\Models\Link;
use App\Services\LinkShortenerService;
use Illuminate\Support\Facades\Cache; 

class LinkObserver
{
    public function creating(Link $link): void
    {
        if (auth()->check()) {
            $link->user_id = auth()->id();
        }
    }

    /**
     * Handle the Link "created" event.
     */
    public function created(Link $link): void
    {
        $shortener = app(LinkShortenerService::class);
        
        $link->updateQuietly([
            'code' => $shortener->encode($link->id)
        ]);
    }

    /**
     * Handle the Link "updated" event.
     */
    public function updated(Link $link): void
    {
        //
    }

    /**
     * Handle the Link "deleted" event.
     */
    public function deleted(Link $link): void
    {
        Cache::forget("link_data_{$link->code}");
    }

    /**
     * Handle the Link "restored" event.
     */
    public function restored(Link $link): void
    {
        Cache::forget("link_data_{$link->code}");
    }

    /**
     * Handle the Link "force deleted" event.
     */
    public function forceDeleted(Link $link): void
    {
        //
    }
}
