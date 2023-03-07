<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
use App\Http\Requests\StoreMemberRequest;
use App\Models\Member;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function list(Request $request): View
    {
        $members = Member::query()->orderBy('omac_id_number')->get();

        return view('members.list', ['members' => $members]);
    }

    public function create(Request $request): View
    {
        return view('members.create', ['cfrLevels' => CFRLevel::toArray(), 'clinicalLevels' => ClinicalLevel::toArray()]);
    }

    public function store(StoreMemberRequest $request): RedirectResponse
    {
        Member::create($request->validated());

        return redirect()->route('members.list');
    }

    public function show(Request $request, Member $member): View
    {
        return view('members.show', ['member' => $member]);
    }

    public function edit(Request $request, Member $member): View
    {
        return view('members.edit', ['member' => $member, 'cfrLevels' => CFRLevel::toArray(), 'clinicalLevels' => ClinicalLevel::toArray()]);
    }

    public function update(StoreMemberRequest $request, Member $member): RedirectResponse
    {
        $member->update($request->validated());

        return redirect()->route('members.show', ['member' => $member]);
    }

    public function delete(Request $request, Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()->route('members.list');
    }
}
