<x-guest-layout>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded shadow mt-6">
        <h1 class="text-lg font-medium text-gray-900 mb-2">
            {{ $user->name }}
        </h1>

        <p class="text-gray-600 mb-4">
            Email: <a href="mailto:{{ $user->email }}" class="text-indigo-600 hover:underline">{{ $user->email }}</a><br />
            Phone: <a href="tel:{{ $user->phone }}" class="text-indigo-600 hover:underline">{{ $user->phone }}</a>
        </p>

    </div>
</x-guest-layout>
