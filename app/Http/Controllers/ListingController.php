<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ListingController extends Controller
{
    use AuthorizesRequests;


    // Show all listings (for recipients)
    public function index()
    {
        $availableListings = Listing::whereNull('recipient_id')->latest()->get();
        $acceptedListings = Listing::whereNotNull('recipient_id')->latest()->get();

        return view('listings.index', compact('availableListings', 'acceptedListings'));
    }

    // Show form to create new listing (guest or donor)
    public function create()
    {
        return view('listings.create');
    }

    // Store new listing
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|max:2',
            'zip' => 'required|string|max:10',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'item' => 'required|string',
            'time_window' => 'nullable|string|max:255',
        ]);

        $data['donor_id'] = Auth::check() ? Auth::id() : null;

        $listing = Listing::create($data);

        // If guest, store ID in session for future linking
        if (!Auth::check()) {
            session()->push('guest_listing_ids', $listing->id);
            session()->put('guest_name', $data['name']);
        }

        return Auth::check()
            ? redirect()->route('dashboard')->with('success', 'Listing created.')
            : redirect()->route('listings.thankyou');
    }

    public function accept(Listing $listing)
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'recipient') {
            abort(403, 'Only recipients can accept listings.');
        }

        if ($listing->recipient_id) {
            return redirect()->route('listings.index')->with('error', 'This listing has already been accepted.');
        }

        $listing->recipient_id = $user->id;
        $listing->save();

        return redirect()->route('dashboard')->with('success', 'You have accepted the listing.');
    }

    // Show a single listing
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    // Show form to edit a listing (donor only)
    public function edit(Listing $listing)
    {
        $this->authorize('update', $listing);
        return view('listings.edit', compact('listing'));
    }

    // Update listing
    public function update(Request $request, Listing $listing)
    {
        $this->authorize('update', $listing);

        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|max:2',
            'zip' => 'required|string|max:10',
            'lat' => 'nullable|numeric',
            'lng' => 'nullable|numeric',
            'item' => 'required|string',
            'time_window' => 'nullable|string|max:255',
        ]);

        $listing->update($data);

        return redirect()->route('listings.index')->with('success', 'Listing updated.');
    }

    // Delete listing
    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);

        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Listing deleted.');
    }

    public function markAsPickedUp(Listing $listing)
    {
        if (auth()->id() !== $listing->recipient_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $listing->picked_up = true;
        $listing->save();

        return redirect()->back()->with('success', 'Marked as picked up.');
    }
}
