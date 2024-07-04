<?php

use App\Livewire\DatabaseTodo;
use App\Livewire\Home;
use App\Models\Todo;
use App\Models\User;

it('renders successfully', function () {
    Livewire::test(Home::class)
        ->assertStatus(200)
        ->assertSeeLivewire('home');
});

it('can create todo', function () {
    $this->assertEquals(0, Todo::count());

    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => 'password',
    ]);

    Todo::factory()->create([
        'user_id' => $user->id,
        'text' => 'Test Todo',
    ]);

    Livewire::actingAs($user)
        ->test(Home::class)
        ->assertViewHas('todos', function ($todos) {
            return count($todos) == 1;
        });

    Livewire::actingAs($user)
        ->test(Home::class)
        ->set('todo', 'Testing 1')
        ->call('addNew');

    $this->assertEquals(2, Todo::count());
});

it('can delete todo', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => 'password',
    ]);

    $todo = Todo::factory()->create([
        'user_id' => $user->id,
        'text' => 'Test Todo',
    ]);

    $this->assertEquals(1, Todo::count());

    Livewire::actingAs($user)
        ->test(DatabaseTodo::class, ['todo' => $todo])
        ->call('delete', $todo->id);

    $this->assertEquals(0, Todo::count());
});

it('can validate', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => 'password',
    ]);

    Livewire::actingAs($user)
        ->test(Home::class)
        ->set('todo', '')
        ->call('addNew')
        ->assertHasErrors(['todo' => 'required']);
});

it('can change completed status', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => 'password',
    ]);

    $todo = Todo::factory()->create([
        'user_id' => $user->id,
        'text' => 'Test Todo',
        'completed' => true,
    ]);

    Livewire::actingAs($user)
        ->test(DatabaseTodo::class, ['todo' => $todo])
        ->call('completed', $todo->id);

    $todo->refresh();
    $this->assertEquals(0, $todo->completed);
});

it('can update todo', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => 'password',
    ]);

    $todo = Todo::factory()->create([
        'user_id' => $user->id,
        'text' => 'Test Todo',
    ]);

    Livewire::actingAs($user)
        ->test(DatabaseTodo::class, ['todo' => $todo])
        ->set('newTodo', 'New Todo')
        ->call('editTodo', $todo->id);

    $todo->refresh();
    $this->assertEquals('New Todo', $todo->text);
});

it('can search for todos', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => 'password',
    ]);

    Todo::factory()->create([
        'user_id' => $user->id,
        'text' => 'Phones',
    ]);

    Todo::factory()->create([
        'user_id' => $user->id,
        'text' => 'Laptops',
    ]);

    Livewire::actingAs($user)
        ->withQueryParams(['search' => 'Phones'])
        ->test(Home::class)
        ->assertSee('Phones')
        ->assertDontSee('Laptops');
});

it('can search for todos with filters', function () {
    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@test.com',
        'password' => 'password',
    ]);

    Todo::factory()->create([
        'user_id' => $user->id,
        'text' => 'Phones',
        'completed' => false,
    ]);

    Todo::factory()->create([
        'user_id' => $user->id,
        'text' => 'Laptops',
        'completed' => true,
    ]);

    Livewire::actingAs($user)
        ->withQueryParams(['search' => 'Laptop', 'filter' => 'all'])
        ->test(Home::class)
        ->assertSee('Laptops')
        ->assertDontSee('Phones');

    Livewire::actingAs($user)
        ->withQueryParams(['search' => 'Laptop', 'filter' => 'active'])
        ->test(Home::class)
        ->assertDontSee('Laptops')
        ->assertDontSee('Phones');

    Livewire::actingAs($user)
        ->withQueryParams(['search' => 'Laptop', 'filter' => 'completed'])
        ->test(Home::class)
        ->assertSee('Laptops')
        ->assertDontSee('Phones');
});

