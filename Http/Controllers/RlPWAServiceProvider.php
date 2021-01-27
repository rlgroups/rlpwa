<?php

namespace RlPWA\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use RlPWA\Services\LaucherIconService;
use RlPWA\Services\ManifestService;

class RlPWAController extends Controller
{
    public function manifestJson($appName)
    {
        $output = (new ManifestService)->generate($appName);
        return response()->json($output);
    }

    public function offline(){
        return view('RlPWA::offline');
    }
}
