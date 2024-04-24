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
