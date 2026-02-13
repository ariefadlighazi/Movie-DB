<?php

return [
    /*
    |--------------------------------------------------------------------------
    | OMDB API
    |--------------------------------------------------------------------------
    |
    | Configure your OMDB API key and base URL here. Set the values in your
    | environment file (.env) with OMDB_KEY and OMDB_URL.
    |
    */
    'key' => env('OMDB_KEY', ''),
    'url' => env('OMDB_URL', 'http://www.omdbapi.com/'),
];
