<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('home', ['page' => $this->systemPage('home')]);
    }

    public function services(): View
    {
        return view('services', ['page' => $this->systemPage('services')]);
    }

    public function quote(): View
    {
        return view('quote', ['page' => $this->systemPage('quote')]);
    }

    public function showCustom(Page $page): View
    {
        abort_unless($page->isCustom() && $page->status === 'published', 404);

        return view('pages.show', ['page' => $page]);
    }

    private function systemPage(string $routeName): Page
    {
        return Page::system()->where('route_name', $routeName)->firstOrFail();
    }
}
