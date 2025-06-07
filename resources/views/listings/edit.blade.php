<x-guest-layout>
    <div class="bg-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <h2 class="text-lg font-medium text-gray-900">Edit Listing</h2>
        <form method="POST" action="{{ route('listings.update', $listing) }}" class="mt-6">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="'Name'" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                              :value="old('name', $listing->name)" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="'Phone'" />
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                              :value="old('phone', $listing->phone)" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <!-- Item -->
            <div class="mt-4">
                <x-input-label for="item" :value="'Item Description'" />
                <x-text-input id="item" class="block mt-1 w-full" type="text" name="item"
                              :value="old('item', $listing->item)" required />
                <x-input-error :messages="$errors->get('item')" class="mt-2" />
            </div>

            <!-- Address Block -->
            <div class="bg-gray-100 p-4 mt-4 rounded">
                <x-input-label for="address" :value="'Item Location'" />

                <div class="mt-4">
                    <x-input-label for="address" :value="'Address'" />
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                  :value="old('address', $listing->address)" required />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="city" :value="'City'" />
                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city"
                                  :value="old('city', $listing->city)" required />
                    <x-input-error :messages="$errors->get('city')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="state" :value="'State'" />
                    <x-text-input id="state" class="block mt-1 w-full" type="text" name="state"
                                  :value="old('state', $listing->state)" required />
                    <x-input-error :messages="$errors->get('state')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="zip" :value="'ZIP Code'" />
                    <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip"
                                  :value="old('zip', $listing->zip)" required />
                    <x-input-error :messages="$errors->get('zip')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="time_window" :value="'Pickup Time Window (optional)'" />
                    <x-text-input id="time_window" class="block mt-1 w-full" type="text" name="time_window"
                                  :value="old('time_window', $listing->time_window)" />
                    <x-input-error :messages="$errors->get('time_window')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-primary-button>
                    Update Listing
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
