<x-guest-layout :showHeader="false">
    <div class="text-center max-w-md mx-auto bg-white p-6 shadow rounded">
        <h2 class="text-2xl font-semibold mb-4">Thanks for submitting your listing!</h2>
        <p class="mb-6 text-gray-700">Want to keep track of your listings, mark them as picked up, or post again faster next time?</p>
        <a href="{{ route('register').'?role=donor' }}" class="inline-block bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700 transition">
            Create an Account
        </a>
    </div>
</x-guest-layout>
