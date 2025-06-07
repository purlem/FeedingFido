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
    <div class="text-lg font-medium text-gray-900 mb-2">Accepted Listings</div>
    <div class="space-y-6">
        @forelse ($acceptedListings as $listing)
            <x-listing-card :listing="$listing"/>
        @empty
            <p class="text-gray-600">No accepted listings yet.</p>
        @endforelse
    </div>

</x-guest-layout>
