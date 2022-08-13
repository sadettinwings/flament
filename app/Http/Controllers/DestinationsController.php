<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Destinations;
use Illuminate\Http\Request;
use App\Http\Requests\DestinationsStoreRequest;
use App\Http\Requests\DestinationsUpdateRequest;

class DestinationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Destinations::class);

        $search = $request->get('search', '');

        $allDestinations = Destinations::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.all_destinations.index',
            compact('allDestinations', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Destinations::class);

        $properties = Property::pluck('name', 'id');

        return view('app.all_destinations.create', compact('properties'));
    }

    /**
     * @param \App\Http\Requests\DestinationsStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DestinationsStoreRequest $request)
    {
        $this->authorize('create', Destinations::class);

        $validated = $request->validated();

        $destinations = Destinations::create($validated);

        return redirect()
            ->route('all-destinations.edit', $destinations)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Destinations $destinations
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Destinations $destinations)
    {
        $this->authorize('view', $destinations);

        return view('app.all_destinations.show', compact('destinations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Destinations $destinations
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Destinations $destinations)
    {
        $this->authorize('update', $destinations);

        $properties = Property::pluck('name', 'id');

        return view(
            'app.all_destinations.edit',
            compact('destinations', 'properties')
        );
    }

    /**
     * @param \App\Http\Requests\DestinationsUpdateRequest $request
     * @param \App\Models\Destinations $destinations
     * @return \Illuminate\Http\Response
     */
    public function update(
        DestinationsUpdateRequest $request,
        Destinations $destinations
    ) {
        $this->authorize('update', $destinations);

        $validated = $request->validated();

        $destinations->update($validated);

        return redirect()
            ->route('all-destinations.edit', $destinations)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Destinations $destinations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Destinations $destinations)
    {
        $this->authorize('delete', $destinations);

        $destinations->delete();

        return redirect()
            ->route('all-destinations.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
