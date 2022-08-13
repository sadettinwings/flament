<?php

namespace App\Http\Controllers\Api;

use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuGitResource;
use App\Http\Resources\BuGitCollection;

class OwnerBuGitsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Owner $owner)
    {
        $this->authorize('view', $owner);

        $search = $request->get('search', '');

        $buGits = $owner
            ->buGits()
            ->search($search)
            ->latest()
            ->paginate();

        return new BuGitCollection($buGits);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Owner $owner
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Owner $owner)
    {
        $this->authorize('create', BuGit::class);

        $validated = $request->validate([]);

        $buGit = $owner->buGits()->create($validated);

        return new BuGitResource($buGit);
    }
}
