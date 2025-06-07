<x-guest-layout>

    <!-- Available Listings -->
    <div class="text-lg font-medium text-gray-900 mb-2">Available Listings</div>
    <div class="space-y-6 mb-8">
        @forelse ($availableListings as $listing)
            <x-listing-card :listing="$listing"/>
        @empty
            <p class="text-gray-600">No listings available right now.</p>
        @endforelse
    </div>

    <!-- Accepted Listings -->
    @if($acceptedListings && $acceptedListings->isNotEmpty())
        <div class="text-lg font-medium text-gray-900 mb-2">Accepted Listings</div>
        <div class="space-y-6">
            @foreach ($acceptedListings as $listing)
                <x-listing-card :listing="$listing"/>
            @endforeach
        </div>
    @endif

</x-guest-layout>
