<?php

namespace App\Libs;

use Illuminate\Support\Facades\Storage;

class AffiliateParser {
    public function __construct(
        private array $affiliates = []
    ) {}

    public function getAffiliates(): array {
        return $this->affiliates;
    }

    public function getAffiliatesWithInDistanceUsingKM(int $distanceInKm) {
        return $this->getAffiliatesByDistanceUsingKM($distanceInKm);
    }

    public function getAffiliatesOutsideDistanceUsingKM(int $distanceInKm) {
        return $this->getAffiliatesByDistanceUsingKM($distanceInKm, withIn: false);
    }

    private function getAffiliatesByDistanceUsingKM(int $distanceInKm, bool $withIn = true): array {
        // move this to env vars
        $officeLatitude = 53.3340285;
        $officeLongitude = -6.2535495;

        $affiliates = array_map(function($affiliate) use($distanceInKm, $withIn, $officeLatitude, $officeLongitude) {
            $distanceFromOfficeInKm = $this->calculateDistanceBetweenTwoPoints(
                $officeLatitude,
                $officeLongitude,
                $affiliate['latitude'],
                $affiliate['longitude'],
            );

            $affiliate['distance_from_office_in_km'] = $distanceFromOfficeInKm;

            if($distanceFromOfficeInKm <= $distanceInKm && $withIn) {
                return $affiliate;
            }
            
            if($distanceFromOfficeInKm > $distanceInKm && !$withIn) {
                return $affiliate;
            }

            return null;
        }, $this->affiliates);

        $affiliates = array_values(array_filter($affiliates, function($affiliate) {
            return $affiliate != null;
        }));

        return $affiliates;
    }

    private function calculateDistanceBetweenTwoPoints($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthsRadius = 3959): int {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        $unitForConvertingToKm = 1.609344;

        return ($angle * $earthsRadius) * $unitForConvertingToKm;
    }

    public static function parse(string $filename): AffiliateParser | null {
        $disk = Storage::build([
            'driver' => 'local',
            'root' => storage_path()
        ]);

        $validator = validator(['filename' => $filename], [
            'filename' => 'ends_with:txt,json'
        ]);

        if($validator->fails()) {
            return null;
        }

        $contents = $disk->get($filename);

        if(!$contents) {
            return null;
        }

        $data = [];

        if($json = json_decode($contents, true)) {
            $data = $json;
        }

        if(!$data && strlen($contents) > 0) {
            $data = array_map(function($line) {
                return json_decode($line, true);
            }, explode(PHP_EOL, $contents));
        }

        if(count($data) === 0) {
            return null;
        }

        usort($data, function($a, $b) {
            return $a['affiliate_id'] > $b['affiliate_id'];
        });
        
        return new static($data);
    }
}