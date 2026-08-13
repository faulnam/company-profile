<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('confirm password screen can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/confirm-password')->assertOk();
});

it('password can be confirmed', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/confirm-password', ['password' => 'password'])
        ->assertRedirect()
        ->assertSessionHasNoErrors();
});

it('password is not confirmed with invalid password', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post('/confirm-password', ['password' => 'wrong-password'])
        ->assertSessionHasErrors();
});
