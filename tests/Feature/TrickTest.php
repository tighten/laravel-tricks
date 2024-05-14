<?php

use App\Models\Trick;
use App\Models\User;

// Index
test('can view tricks on homepage', function () {
    Trick::factory()->create(['name' => 'How to make a trick']);

    $this->get(route('tricks.index'))
        ->assertStatus(200)
        ->assertSee('How to make a trick');
});

// Create
test('can view create trick page', function () {
    $this->actingAs(User::factory()->create())
        ->get(route('tricks.create'))
        ->assertStatus(200)
        ->assertSee('Create Trick');
});

test('cannot view create trick page as guest', function () {
    $this->get(route('tricks.create'))
        ->assertStatus(302);
});

// Store
test('can store trick', function () {
    $this->actingAs(User::factory()->create())
        ->post(route('tricks.store'), [
            'name' => 'How to make a Trick',
            'description' => 'Add a description',
            'code' => 'Add a bit of code',
            'tags' => 'general,hello-world'
        ])
        ->assertStatus(302);

    tap(Trick::firstWhere('name', 'How to make a Trick'), function ($trick) {
        expect($trick)->not->toBeNull();
        expect($trick->slug)->toBe('how-to-make-a-trick');
        expect($trick->description)->toBe('Add a description');
        expect($trick->code)->toBe('Add a bit of code');
        expect($trick->tags)->toHaveCount(2);
    });
});

test('cannot store invalid trick', function () {
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
test('can view trick', function () {
    $trick = Trick::factory()->create(['name' => 'How to make a trick']);

    $this->get(route('tricks.show', $trick))
        ->assertStatus(200)
        ->assertSee('How to make a trick');
});

// Edit
test('can view edit trick page', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create();

    $this->actingAs($user)
        ->get(route('tricks.edit', $trick))
        ->assertStatus(200)
        ->assertSee('Edit Trick');
});

test('cannot view edit trick page as guest', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create();

    $this->get(route('tricks.edit', $trick))
        ->assertStatus(302);
});

test('cannot view edit trick page if not yours', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create();

    $this->actingAs(User::factory()->create())
        ->get(route('tricks.edit', $trick))
        ->assertStatus(403);
});

// Update
test('can update trick', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create([
        'name' => 'How to make a Trick',
        'description' => 'Add a description',
        'code' => 'Add a bit of code',
    ]);

    $this->actingAs($user)
        ->put(route('tricks.update', $trick), [
            'name' => 'How to make a new Trick',
            'description' => 'Add a brief description',
            'code' => 'Add a snippet of code',
            'tags' => 'hello-world,general',
        ])
        ->assertStatus(302);

    tap($trick->fresh(), function ($trick) {
        expect($trick->name)->toBe('How to make a new Trick');
        expect($trick->slug)->toBe('how-to-make-a-new-trick');
        expect($trick->description)->toBe('Add a brief description');
        expect($trick->code)->toBe('Add a snippet of code');
        expect($trick->tags)->toHaveCount(2);
    });
});

test('cannot update invalid trick', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create([
        'name' => 'How to make a Trick',
        'slug' => 'how-to-make-a-trick',
        'description' => 'Add a description',
        'code' => 'Add a bit of code',
        'tags' => ['hello-world', 'general'],
    ]);

    $this->actingAs($user)
        ->put(route('tricks.update', $trick), [
            'name' => 'how',
            'description' => 'Add',
            // 'code' => 'Add a bit of code',
            // 'tags' => 'hello-world,general',
        ])
        ->assertStatus(302)
        ->assertInvalid(['name', 'description', 'code', 'tags']);

    tap($trick->fresh(), function ($trick) {
        expect($trick->name)->toBe('How to make a Trick');
        expect($trick->slug)->toBe('how-to-make-a-trick');
        expect($trick->description)->toBe('Add a description');
        expect($trick->code)->toBe('Add a bit of code');
    });
});

test('cannot update trick page if not yours', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create();

    $this->actingAs(User::factory()->create())
        ->put(route('tricks.update', $trick), [
            'name' => 'How to make a new Trick',
            'description' => 'Add a brief description',
            'code' => 'Add a snippet of code',
            'tags' => 'hello-world,general',
        ])
        ->assertStatus(403);
});

// Delete
test('can delete trick', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create([
        'name' => 'How to make a Trick',
        'description' => 'Add a description',
        'code' => 'Add a bit of code',
    ]);

    $this->actingAs($user)
        ->delete(route('tricks.destroy', $trick))
        ->assertStatus(302);

    $this->assertDatabaseMissing('tricks', [
        'name' => 'How to make a Trick',
        'description' => 'Add a description',
        'code' => 'Add a bit of code',
    ]);
});

test('cannot delete trick page if not yours', function () {
    $user = User::factory()->create();
    $trick = Trick::factory()->for($user)->create();

    $this->actingAs(User::factory()->create())
        ->delete(route('tricks.destroy', $trick))
        ->assertStatus(403);
});
