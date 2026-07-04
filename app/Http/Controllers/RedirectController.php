<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LinkService;

class RedirectController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $code, LinkService $linkService)
    {
        $url = $linkService->handleRedirect($code, $request);
        
        return redirect()->away($url);
    }
}
