<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switch($locale)
    {
        // Validate locale
        if (!in_array($locale, ['en', 'ja'])) {
            abort(400);
        }
        
        // Store locale in session
        Session::put('locale', $locale);
        
        // Update user's locale preference if authenticated
        if (auth()->check()) {
            auth()->user()->update(['locale' => $locale]);
        }
        
        return redirect()->back();
    }
}
