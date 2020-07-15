<?php

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Головна', route('admin.dashboard'));
});

Breadcrumbs::for('admins', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Администраторы', route('admin.index'));
});

Breadcrumbs::for('users', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Користувачі', route('user.index'));
});

Breadcrumbs::for('roles', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Ролі', route('role.index'));
});

Breadcrumbs::for('role', function ($trail, $name) {
    $trail->parent('roles');
    $trail->push($name, route('role.show', $name));
});
//
//Breadcrumbs::for('admin-edit', function ($trail, $name) {
//    $trail->parent('admins');
//    $trail->push('Изменить данные ' . $name, route('admin.edit', $name));
//});
//
//Breadcrumbs::for('admin-create', function ($trail) {
//    $trail->parent('admins');
//    $trail->push('Добавить администратора', route('admin.create'));
//});
