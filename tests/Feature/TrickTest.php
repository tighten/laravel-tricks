<?php

use App\Models\Trick;

it('can view tricks on homepage', function () {
    Trick::factory()->create(['name' => 'How to make a trick']);

    $this->withoutExceptionHandling()
        ->get('/')
        ->assertStatus(200)
        ->assertSee('How to make a trick');
});
