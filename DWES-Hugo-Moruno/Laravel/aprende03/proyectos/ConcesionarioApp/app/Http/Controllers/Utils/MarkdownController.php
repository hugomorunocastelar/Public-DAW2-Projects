<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MarkdownController extends Controller
{
    public function showPolicies()
    {
        $markdown = File::get(resource_path('markdown/policy.md'));
        $html = Str::markdown($markdown);
        return view('policy', ['policy' => $html]);
    }

    public function showTerms()
    {
        $markdown = File::get(resource_path('markdown/terms.md'));
        $html = Str::markdown($markdown);
        return view('policy', ['policy' => $html]);
    }

}
