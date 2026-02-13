<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OmdbClient
{
    protected array $cfg;

    public function __construct(array $cfg)
    {
        $this->cfg = $cfg;
    }
    public function fetchRandom() {
        $cfg = $this->cfg;
        $randomName = "iron man";
        
        $response = Http::get($cfg['url'], [
            'apikey' => $cfg['key'],
            's' => $randomName,
        ]);

        return $response->json();
    }

    public function fetchDetailbyId($id) {
        $cfg = $this->cfg;
        
        $response = Http::get($cfg['url'], [
            'apikey' => $cfg['key'],
            'i' => $id,
        ]);

        return $response->json();
    }

    public function fetchSearch($search, $page = 1) {
        $cfg = $this->cfg;
        
        $response = Http::get($cfg['url'], [
            'apikey' => $cfg['key'],
            's' => $search,
            'page' => $page,
        ]);

        return $response->json();
    }
}
