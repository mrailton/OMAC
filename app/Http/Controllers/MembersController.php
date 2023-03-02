<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
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
        return view('members.create');
    }

    public function store(StoreMemberRequest $request): RedirectResponse
    {

    }

    public function show(Request $request, Member $member): View
    {
        return view('members.show', ['member' => $member]);
    }

    public function edit(Request $request, Member $member): View
    {
        return view('members.edit', ['member' => $member]);
    }

    public function update(UpdateMemberRequest $request, Member $member): RedirectResponse
    {

    }

    public function delete(Request $request, Member $member): RedirectResponse
    {
        $member->delete();

        return redirect()->route('members:list');
    }
}
