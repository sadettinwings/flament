<?php

namespace App\Http\Controllers;

use App\Models\BuGit;
use App\Models\Owner;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.bu_gits.index', compact('buGits', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', BuGit::class);

        $owners = Owner::pluck('name', 'id');

        return view('app.bu_gits.create', compact('owners'));
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

        return redirect()
            ->route('bu-gits.edit', $buGit)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BuGit $buGit
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, BuGit $buGit)
    {
        $this->authorize('view', $buGit);

        return view('app.bu_gits.show', compact('buGit'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\BuGit $buGit
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, BuGit $buGit)
    {
        $this->authorize('update', $buGit);

        $owners = Owner::pluck('name', 'id');

        return view('app.bu_gits.edit', compact('buGit', 'owners'));
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

        return redirect()
            ->route('bu-gits.edit', $buGit)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('bu-gits.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
