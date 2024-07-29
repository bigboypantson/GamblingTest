<x-default-layout>
    <x-slot:title>Affiliates Who Need To Re-locate</x-slot>
    <div class="flex flex-col gap-10">
        <div>
            <h2 class="text-3xl mb-3">{{ $numberOfAffiliates }} @choice('Affiliate|Affiliates', $numberOfAffiliates) Who Need To Re-locate</h2>
            <p>Here is our B list affiliates that sadly, live outside 100km of our Dublin office and will not be invited over for food and drinks but we will send them a box of beers!</p>
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
                </div>
            @endforeach
        </div>
    </div>
</x-default-layout>