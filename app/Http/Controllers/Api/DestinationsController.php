<?php

namespace App\Http\Controllers\Api;

use App\Models\Destinations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DestinationsResource;
use App\Http\Resources\DestinationsCollection;
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
            ->paginate();

        return new DestinationsCollection($allDestinations);
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

        return new DestinationsResource($destinations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Destinations $destinations
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Destinations $destinations)
    {
        $this->authorize('view', $destinations);

        return new DestinationsResource($destinations);
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

        return new DestinationsResource($destinations);
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

        return response()->noContent();
    }
}
