<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.owners.index', compact('owners', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Owner::class);

        return view('app.owners.create');
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

        return redirect()
            ->route('owners.edit', $owner)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Owner $owner)
    {
        $this->authorize('view', $owner);

        return view('app.owners.show', compact('owner'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Owner $owner)
    {
        $this->authorize('update', $owner);

        return view('app.owners.edit', compact('owner'));
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

        return redirect()
            ->route('owners.edit', $owner)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('owners.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
