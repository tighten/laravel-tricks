<?php

use App\Models\Trick;
use App\Models\User;

it('can view tricks on homepage', function () {
    Trick::factory()->create(['name' => 'How to make a trick']);

    $this->get(route('tricks.index'))
        ->assertStatus(200)
        ->assertSee('How to make a trick');
});

it('can view create trick page', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('tricks.create'))
        ->assertStatus(200)
        ->assertSee('Create Trick');
});

it('cannot view create trick page as guest', function () {
    $this->get(route('tricks.create'))
        ->assertStatus(302);
});

it('can view edit trick page', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create();

    $this->actingAs($user)
        ->get(route('tricks.edit', $trick))
        ->assertStatus(200)
        ->assertSee('Edit Trick');
});

it('cannot view edit trick page as guest', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create();

    $this->get(route('tricks.edit', $trick))
        ->assertStatus(302);
});

it('cannot view edit trick page if not yours', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create();

    $this->actingAs(User::factory()->create())
        ->get(route('tricks.edit', $trick))
        ->assertStatus(403);
});
