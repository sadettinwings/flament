<?php

namespace App\Http\Controllers\Api;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OwnerResource;
use App\Http\Resources\OwnerCollection;
use App\Http\Requests\OwnerStoreRequest;
use App\Http\Requests\OwnerUpdateRequest;

class OwnerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Owner::class);

        $search = $request->get('search', '');

        $owners = Owner::search($search)
            ->latest()
            ->paginate();

        return new OwnerCollection($owners);
    }

    /**
     * @param \App\Http\Requests\OwnerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OwnerStoreRequest $request)
    {
        $this->authorize('create', Owner::class);

        $validated = $request->validated();

        $owner = Owner::create($validated);

        return new OwnerResource($owner);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Owner $owner)
    {
        $this->authorize('view', $owner);

        return new OwnerResource($owner);
    }

    /**
     * @param \App\Http\Requests\OwnerUpdateRequest $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function update(OwnerUpdateRequest $request, Owner $owner)
    {
        $this->authorize('update', $owner);

        $validated = $request->validated();

        $owner->update($validated);

        return new OwnerResource($owner);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Owner $owner)
    {
        $this->authorize('delete', $owner);

        $owner->delete();

        return response()->noContent();
    }
}
