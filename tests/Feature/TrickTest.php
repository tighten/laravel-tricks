<?php

use App\Models\Trick;
use App\Models\User;

// Index
it('can view tricks on homepage', function () {
    Trick::factory()->create(['name' => 'How to make a trick']);

    $this->get(route('tricks.index'))
        ->assertStatus(200)
        ->assertSee('How to make a trick');
});

// Create
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

// Store
it('can store trick', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('tricks.store'), [
            'name' => 'How to make a Trick',
            'description' => 'Add a description',
            'code' => 'Add a bit of code',
        ])
        ->assertStatus(302);

    $this->assertDatabaseHas('tricks', [
        'name' => 'How to make a Trick',
        'slug' => 'how-to-make-a-trick',
        'description' => 'Add a description',
        'code' => 'Add a bit of code',
    ]);
});

it('cannot store invalid trick', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('tricks.store'), [
            'name' => 'how',
            'description' => 'Add',
            // 'code' => 'Add a bit of code',
        ])
        ->assertStatus(302)
        ->assertInvalid(['name', 'description', 'code']);
});

// Show

// Edit
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

// Update

// Delete
