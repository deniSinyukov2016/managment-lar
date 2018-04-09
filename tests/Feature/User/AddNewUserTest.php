<?php

namespace Tests\Feature\User;

use App\Models\User;
use App\Notifications\InvitationPaid;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddNewUserTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $user;

    protected function setUp()
    {
        parent::setUp();

        $this->admin = create(User::class, ['is_admin' => true, 'confirmed' => 1]);
        $this->user = create(User::class, ['is_admin' => false, 'confirmed' => 1]);
    }

    /** @test */
    public function it_admin_view_form_with_create_user()
    {
        $this->signIn($this->admin)
             ->get(route('invite.create'))
             ->assertStatus(200)
             ->assertSee('Invate new user');
    }

    /** @test */
    public function it_admin_can_invite_new_user()
    {
        \Notification::fake();

        $this->signIn($this->admin)
             ->post(route('invite.store'), $data = [
                 'name'     => 'Bob',
                 'email'    => 'bob@doe.com',
                 'password' => '111111',
                 'is_admin' => false
             ])->assertSessionHas('status', 'Email sended');

        $this->assertDatabaseHas('users',  array_except($data, 'password'));
        $user = User::query()->where(array_except($data, 'password'))->first();

        \Notification::assertSentTo($user, InvitationPaid::class);
    }

    /** @test */
    public function it_has_validation_error_if_fill_not_all_data()
    {
        $this->signIn($this->admin)
             ->post(route('invite.store'), $data = [
                 'name'     => 'Bob',
                 'password' => '111111',
                 'is_admin' => false
             ])->assertSessionHas('errors');

        $this->signIn($this->admin)
             ->post(route('invite.store'), $data = [
                 'name'     => 'Bob',
                 'email'     => $this->admin->email,
                 'password' => '111111',
                 'is_admin' => false
             ])->assertSessionHas('errors');

        $this->signIn($this->admin)
             ->post(route('invite.store'), $data = [
                 'name'     => 'Bob',
                 'email'     => $this->admin->email,
                 'password' => '111111',
             ])->assertSessionHas('errors');
    }

    /** @test */
    public function it_user_can_not_view_create_user_form()
    {
        $this->signIn($this->user)
             ->get(route('invite.create'))
             ->assertRedirect(route('projects.index'));
    }

    /** @test */
    public function it_user_can_not_add_new_user()
    {
        $this->signIn($this->user)
             ->post(route('invite.store'))
             ->assertRedirect(route('projects.index'));

    }

    /** @test */
    public function it_invited_user_can_confirm_self()
    {
        \Notification::fake();

        $this->signIn($this->admin)
             ->post(route('invite.store'), $data = [
                 'name'     => 'Bob',
                 'email'    => 'bob@doe.com',
                 'password' => '111111',
                 'is_admin' => false
             ]);

        $user = User::query()->where(array_except($data, 'password'))->first();

        auth()->logout();

        $this->assertFalse($user->confirmed);
        $this->get(route('invite.confirm', $user->remember_token))
             ->assertRedirect(route('login'));

        $this->assertTrue($user->fresh()->confirmed);

    }
}
