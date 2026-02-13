<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\OmdbClient;

class OmdbService
{

    protected OmdbClient $controller;
    /**
     * Create a new class instance.
     */
    public function __construct(OmdbClient $controller)
    {
        //
        $this->controller = $controller;
    }

    public function fetchData() {
        return $this->controller->fetchRandom();
    }
    
    public function fetchDetail($id) {
        return $this->controller->fetchDetailbyId($id);
    }   

    public function searchMovies($search, $page = 1) {
        return $this->controller->fetchSearch($search, $page);
    }

}
