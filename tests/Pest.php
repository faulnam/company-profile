<?php

use Spatie\Permission\Models\Role;

beforeEach(function () {
    foreach (['admin', 'tu', 'walikelas', 'walimurid'] as $roleName) {
        Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
    }
});
