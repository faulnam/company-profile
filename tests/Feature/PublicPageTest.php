<?php
// TEST HALAMAN PUBLIC
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class);

it('home page is displayed Normal BOLOOO', function () {
    $this->get('/')
        ->assertOk();
});

it('berita page is displayed  Normal BOLOOO', function () {
    $this->get('/berita')
        ->assertOk();
});

it('profil page is displayed  Normal BOLOOO', function () {
    $this->get('/profil')
        ->assertOk();
});

it('jurusan page is displayed  Normal BOLOOO', function () {
    $this->get('/jurusan')
        ->assertOk();
});

it('gtk page is displayed  Normal BOLOOO', function () {
    $this->get('/gtk')
        ->assertOk();
});

it('search page is displayed  Normal BOLOOO', function () {
    $this->get('/search')
        ->assertOk();
});

it('ppdb registration page is displayed  Normal BOLOOO', function () {
    $this->get('/pendaftaran')
        ->assertOk();
});


