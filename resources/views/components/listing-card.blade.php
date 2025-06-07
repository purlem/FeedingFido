@props(['listing'])

<div class="p-4 border border-gray-200 rounded shadow-sm flex justify-between bg-white">
    <div>
        <div class="text-lg font-medium text-gray-900">{{ $listing->item }}</div>
        <div class="text-sm text-gray-700 mt-1">{{ $listing->name }} — {{ $listing->city }}, {{ $listing->state }}</div>
        <div class="text-sm text-gray-500">{{ $listing->address }}</div>

        @if ($listing->phone)
            <div class="text-sm text-gray-500">Phone: {{ $listing->phone }}</div>
        @endif

        @if ($listing->time_window)
            <div class="text-sm text-gray-500">Pickup Window: {{ $listing->time_window }}</div>
        @endif

        @auth
            @if (auth()->id() === $listing->donor_id && !$listing->picked_up)
                <div class="mt-2">
                    <a href="{{ route('listings.edit', $listing) }}"
                       class="text-sm text-indigo-600 hover:underline">
                        Edit Listing
                    </a>
                </div>
            @endif
        @endauth
    </div>

    <div class="flex justify-end pr-2">
        @if ($listing->recipient)
            @auth
                @if (auth()->id() === $listing->recipient_id)
                    @if (! $listing->picked_up)
                        <div class="mt-2 text-sm">
                            <form method="POST" action="{{ route('listings.pickup', $listing) }}" class="inline">
                                @csrf
                                <button type="submit" class="ml-2 text-indigo-600 hover:underline text-sm">
                                    Mark as picked up
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="text-sm text-green-600 mt-2">✓ Picked up</div>
                    @endif
                @else
                    <div class="text-sm text-gray-500 mt-2">
                        @if (auth()->id() === $listing->donor_id)
                            @if (! $listing->picked_up)
                                Pending pickup by
                            @else
                                Pickedup by
                            @endif
                            <a href="{{ route('profile.public', $listing->recipient) }}"
                               class="text-indigo-600 hover:underline">
                                {{ $listing->recipient->name }}
                            </a>
                        @else
                            {{ $listing->picked_up ? 'Accepted by' : 'Pending pickup by' }} {{ $listing->recipient->shortName() }}
                        @endif
                    </div>
                @endif
            @else
                <div class="text-sm text-gray-500 mt-2">
                    Accepted by {{ $listing->recipient->shortName() }}
                </div>
            @endauth
        @else
            @auth
                @if (auth()->user()->role === 'recipient')
                    <form method="POST" action="{{ route('listings.accept', $listing) }}" class="mt-3">
                        @csrf
                        <x-primary-button>
                            Accept Listing
                        </x-primary-button>
                    </form>
                @endif
            @else
                <div class="mt-3">
                    <a href="{{ route('register') }}" class="inline-block text-sm text-indigo-600 hover:underline">
                        Register to accept this listing
                    </a>
                </div>
            @endauth
        @endif
    </div>
</div>
