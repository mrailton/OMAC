<?php

namespace App\Http\Controllers;

use App\Enums\CFRLevel;
use App\Enums\ClinicalLevel;
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
        $cfrLevels = [];
        $clinicalLevels = [];

        foreach (CFRLevel::cases() as $value) {
            $cfrLevels[$value->name] = $value->value;
        }

        foreach(ClinicalLevel::cases() as $value) {
            $clinicalLevels[$value->name] = $value->value;
        }

        return view('members.create', ['cfrLevels' => $cfrLevels, 'clinicalLevels' => $clinicalLevels]);
    }

    public function store(StoreMemberRequest $request): RedirectResponse
    {
        Member::create($request->validated());

        return redirect()->route('members:list');
    }

    public function show(Request $request, Member $member): View
    {
        $cfrLevels = [];
        $clinicalLevels = [];

        foreach (CFRLevel::cases() as $value) {
            $cfrLevels[$value->name] = $value->value;
        }

        foreach(ClinicalLevel::cases() as $value) {
            $clinicalLevels[$value->name] = $value->value;
        }

        return view('members.show', ['member' => $member, 'cfrLevels' => $cfrLevels, 'clinicalLevels' => $clinicalLevels]);
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
