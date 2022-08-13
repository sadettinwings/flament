<?php

namespace App\Http\Controllers\Api;

use App\Models\BuGit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BuGitResource;
use App\Http\Resources\BuGitCollection;
use App\Http\Requests\BuGitStoreRequest;
use App\Http\Requests\BuGitUpdateRequest;

class BuGitController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', BuGit::class);

        $search = $request->get('search', '');

        $buGits = BuGit::search($search)
            ->latest()
            ->paginate();

        return new BuGitCollection($buGits);
    }

    /**
     * @param \App\Http\Requests\BuGitStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuGitStoreRequest $request)
    {
        $this->authorize('create', BuGit::class);

        $validated = $request->validated();

        $buGit = BuGit::create($validated);

        return new BuGitResource($buGit);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BuGit $buGit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BuGit $buGit)
    {
        $this->authorize('view', $buGit);

        return new BuGitResource($buGit);
    }

    /**
     * @param \App\Http\Requests\BuGitUpdateRequest $request
     * @param \App\Models\BuGit $buGit
     * @return \Illuminate\Http\Response
     */
    public function update(BuGitUpdateRequest $request, BuGit $buGit)
    {
        $this->authorize('update', $buGit);

        $validated = $request->validated();

        $buGit->update($validated);

        return new BuGitResource($buGit);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BuGit $buGit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, BuGit $buGit)
    {
        $this->authorize('delete', $buGit);

        $buGit->delete();

        return response()->noContent();
    }
}
