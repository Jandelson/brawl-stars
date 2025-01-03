<?php

namespace App\Http\Controllers;

use App\Models\Description;
use App\Services\BrawlsService;

class BrawController extends Controller
{
    public function index(BrawlsService $brawlsService)
    {
        $brawls = $brawlsService->getData();
        $descriptions = Description::pluck('description_text', 'object_id')->toArray();

        return view('brawls.index', [
            'data' => $brawls,
            'descriptions' => $descriptions
        ]);
    }
}
