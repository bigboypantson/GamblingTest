<x-default-layout>
    <x-slot:title>Affiliates Who Made The List</x-slot>
    <div class="flex flex-col gap-10">
        <div>
            <h2 class="text-3xl mb-3">{{ $numberOfAffiliates }} @choice('Affiliate|Affiliates', $numberOfAffiliates) Who Made The List With In {{ $distanceInKm }}km</h2>
            <p>Here is our A list affiliates that live within {{ $distanceInKm }}km of our Dublin office and will be invited over for food and drinks!</p>
        </div>


        <div class="md:w-2/4 lg:w-1/3 mx-auto flex flex-col gap-3">
            <a href="{{ route('welcome') }}" class="block rounded bg-black text-white p-2 text-center">Back to Welcome</a>
        </div>

        <div class="flex flex-col gap-3 divide divide-y">
            @foreach($affiliates AS $affiliate)
                <div class="pt-3">
                    <div>
                        <span class="font-semibold">Affiliate ID: </span> {{ $affiliate['affiliate_id'] }}
                    </div>
                    <div>
                        <span class="font-semibold">Name:</span> {{ $affiliate['name'] }}
                    </div>
                    <div>
                        <span class="font-semibold">Distance from Office: </span>{{ $affiliate['distance_from_office_in_km'] }}km
                    </div>
                    <div>
                        <span class="font-semibold">Latitude: </span>{{ $affiliate['latitude'] }}
                    </div>
                    <div>
                        <span class="font-semibold">Longitude: </span>{{ $affiliate['longitude'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-default-layout>