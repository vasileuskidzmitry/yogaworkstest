<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * Handle "home" route
     *
     * @return Response|RedirectResponse
     */
    public function __invoke(): Response|RedirectResponse
    {
        return Inertia::render('home', [
            'currencies' => Currency::orderBy('title')->get(),
            'rates' => Rate::forOneDay()->get(),
        ]);
    }
}
