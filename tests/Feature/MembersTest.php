<?php

use App\Models\Member;

test('an authenticated user can view a list of members', function () {
    $members = Member::factory()->count(3)->create();

    $this->actingAs(user())
        ->get(route('members.list'))
        ->assertSee($members[0]->name)
        ->assertSee($members[1]->omac_id_number)
        ->assertSee($members[2]->clinical_level->value);
});

test('an authenticated user can create a new member', function () {
    $member = Member::factory()->make();

    expect(Member::count())->toBe(0);

    $this->actingAs(user())
        ->get(route('members.create'))
        ->assertSee('Add Member');

    $this->actingAs(user())
        ->post(route('members.store'), $member->toArray())
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('members.list');

    expect(Member::count())->toBe(1)
        ->and(Member::first()->name)->toBe($member->name);
});

test('an authenticated user can view a member', function () {
    $member = Member::factory()->create();

    $this->actingAs(user())
        ->get(route('members.show', ['member' => $member]))
        ->assertSee($member->name)
        ->assertSee($member->omac_id_number)
        ->assertSee($member->clinical_level->value);
});

test('an authenticated user can update a member', function () {
    $member = Member::factory()->create();
    $data = $member->toArray();
    $data['name'] = 'Updated Name';

    $this->actingAs(user())
        ->get(route('members.edit', ['member' => $member]))
        ->assertSee('Update Member')
        ->assertSee($member->name);

    $this->actingAs(user())
        ->put(route('members.update', ['member' => $member]), $data)
        ->assertSessionDoesntHaveErrors()
        ->assertRedirectToRoute('members.show', ['member' => $member]);

    $this->actingAs(user())
        ->get(route('members.show', ['member' => $member]))
        ->assertSee($data['name']);
});

test('an authenticated user can delete a member', function () {
    $member = Member::factory()->create();

    $this->actingAs(user())
        ->delete(route('members.delete', ['member' => $member]))
        ->assertRedirectToRoute('members.list');

    expect(Member::count())->toBe(0);
});
