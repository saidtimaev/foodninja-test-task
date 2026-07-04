<?php

namespace App\Services;

use App\Repositories\LinkRepository;
use App\Repositories\LinkVisitRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache; 
use App\Jobs\CreateLinkVisitJob;

class LinkService
{
    public function __construct(
        protected LinkRepository $linkRepository,
        protected LinkVisitRepository $linkVisitRepository
    ) {}

    public function handleRedirect(string $code, Request $request): string
    {
        
        $linkData = Cache::rememberForever("link_data_{$code}", function () use ($code) {
            $link = $this->linkRepository->findByCode($code);
            
            if (!$link) {
                return null;
            }

            return [
                'id' => $link->id,
                'original_url' => $link->original_url,
            ];
        });

        if (!$linkData) { 
            abort(404); 
        }

        CreateLinkVisitJob::dispatch($linkData['id'], $request->ip());

        return $linkData['original_url'];
    }
}