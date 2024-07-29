<x-default-layout>
    <x-slot:title>Affiliate Party</x-slot>
    <div class="flex flex-col gap-10">
        <div>
            <h2 class="text-3xl mb-3">Affiliate Party</h2>
            <p>We want to invite any affiliate that lives within 100km of our Dublin office for some food and drinks.</p>
        </div>
        
        <div>
            <h2 class="text-2xl mb-3">Did you make the list?</h2>
            <div class="md:w-2/4 lg:w-1/3 mx-auto flex flex-col gap-3">
                @foreach([100, 80, 50, 20, 10] AS $distance)
                <a href="{{ route('affiliates', ['distanceInKm' => $distance]) }}" class="block rounded bg-black text-white p-2 text-center">Affiliates Who Made The List With In {{ $distance }}km</a>
                @endforeach
                <a href="{{ route('affiliates.too-far-away') }}" class="block rounded bg-black text-white p-2 text-center">Affiliates Who Need To Re-locate</a>
            </div>
        </div>
    </div>
</x-default-layout>
            
            