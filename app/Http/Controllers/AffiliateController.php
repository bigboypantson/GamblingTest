<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libs\AffiliateParser;

class AffiliateController extends Controller
{
    public function index(Request $request) {
        $distanceInKm = $request->input('distanceInKm', 100);
        $parser = AffiliateParser::parse('affiliates.txt');

        $affiliates = $parser ? $parser->getAffiliatesWithInDistanceUsingKM($distanceInKm) : [];
        $numberOfAffiliates = count($affiliates);

        return view('affiliates.index', [
            'affiliates' => $affiliates,
            'numberOfAffiliates' => $numberOfAffiliates,
            'distanceInKm' => $distanceInKm
        ]);
    }

    public function tooFarAway() {
        $parser = AffiliateParser::parse('affiliates.json');

        $affiliates = $parser ? $parser->getAffiliatesOutsideDistanceUsingKM(100) : [];
        $numberOfAffiliates = count($affiliates);
        
        return view('affiliates.too-far-away', [
            'affiliates' => $affiliates,
            'numberOfAffiliates' => $numberOfAffiliates
        ]);
    }
}
