<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('homepage returns a successful response', function () {
    $this->get('/')->assertOk();
});
