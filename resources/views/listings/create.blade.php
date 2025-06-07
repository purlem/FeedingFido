<x-guest-layout>
    @php
        $faker = app()->environment('local') ? \Faker\Factory::create() : null;

        $fake = $faker ? [
            'name' => $faker->name,
            'phone' => $faker->phoneNumber,
            'item' => $faker->words(3, true),
            'address' => $faker->streetAddress,
            'city' => $faker->city,
            'state' => $faker->stateAbbr,
            'zip' => $faker->postcode,
            'time_window' => $faker->dayOfWeek . ' ' . $faker->numberBetween(8, 11) . '–' . $faker->numberBetween(12, 4 + 12) . 'am',
        ] : [];
    @endphp

    <div class="bg-white p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <h2 class="text-lg font-medium text-gray-900">Add Listing</h2>
        <form method="POST" action="{{ route('listings.store') }}" class="mt-6">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="'Name'"/>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                              :value="old('name', $fake['name'] ?? '')" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-input-label for="phone" :value="'Phone'"/>
                <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $fake['phone'] ?? '')"/>
                <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
            </div>

            <!-- Item -->
            <div class="mt-4">
                <x-input-label for="item" :value="'Item Description'"/>
                <x-text-input id="item" class="block mt-1 w-full" type="text" name="item" :value="old('item', $fake['item'] ?? '')"
                              required/>
                <x-input-error :messages="$errors->get('item')" class="mt-2"/>
            </div>


            <!-- Address -->
            <div class="bg-gray-100 p-4 mt-4 rounded">
                <x-input-label for="address" :value="'Item Location'"/>

                <div class="mt-4">
                    <x-input-label for="address" :value="'Address'"/>
                    <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address', $fake['address'] ?? '')"
                                  required/>
                    <x-input-error :messages="$errors->get('address')" class="mt-2"/>
                </div>

                <!-- City -->
                <div class="mt-4">
                    <x-input-label for="city" :value="'City'"/>
                    <x-text-input id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city', $fake['city'] ?? '')"
                                  required/>
                    <x-input-error :messages="$errors->get('city')" class="mt-2"/>
                </div>

                <!-- State -->
                <div class="mt-4">
                    <x-input-label for="state" :value="'State'"/>
                    <x-text-input id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state', $fake['state'] ?? '')"
                                  required/>
                    <x-input-error :messages="$errors->get('state')" class="mt-2"/>
                </div>

                <!-- ZIP Code -->
                <div class="mt-4">
                    <x-input-label for="zip" :value="'ZIP Code'"/>
                    <x-text-input id="zip" class="block mt-1 w-full" type="text" name="zip" :value="old('zip', $fake['zip'] ?? '')" required/>
                    <x-input-error :messages="$errors->get('zip')" class="mt-2"/>
                </div>

                <!-- Time Window -->
                <div class="mt-4">
                    <x-input-label for="time_window" :value="'Pickup Time Window (optional)'" />
                    <x-text-input id="time_window" class="block mt-1 w-full" type="text" name="time_window" :value="old('time_window', $fake['time_window'] ?? '')" />
                    <x-input-error :messages="$errors->get('time_window')" class="mt-2" />
                </div>
            </div>



            <div class="flex items-center justify-end mt-6">
                <x-primary-button>
                    Post Listing
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
