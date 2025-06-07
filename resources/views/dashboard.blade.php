<x-guest-layout>
    <div class="overflow-hidden shadow-sm sm:rounded-lg">
        <div class="text-lg font-medium text-gray-900">
            Your Listings
        </div>
        <div class="mt-6">
            @if ($listings->isEmpty())
                <div class="p-4 border border-gray-200 rounded shadow-sm flex justify-between bg-white">
                    <p class="text-gray-600">You do not have any listings.</p>
                </div>
            @else
                <div class="space-y-6">
                    @foreach ($listings as $listing)
                        <x-listing-card :listing="$listing" />
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-guest-layout>
