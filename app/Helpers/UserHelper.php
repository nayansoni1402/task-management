<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;

class UserHelper
{
    /**
     * Generate a login URL for the authenticated user.
     *
     * @return string|null
     */
    public static function generateLoginUrl()
    {
        $user = Auth::user();
    
        // Check if the user is authenticated
        if (!$user) {
            return null; // or handle as needed
        }
    
        $dLogine_id = Crypt::encryptString($user->id);
        $dLogineURL = '/';
        $dLogineURL = json_encode(['url' => $dLogineURL]);
        $dLogineURL = base64_encode($dLogineURL);
        $dLogineURL = 'wp/' . $dLogine_id . '/' . $dLogineURL;
        return Config::get('app.url') . ':8001/' . $dLogineURL; // Make sure this URL matches your route
    }
    
}
