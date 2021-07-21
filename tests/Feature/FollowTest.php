<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Follow;

class FollowTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_follow_store()
    {
        $login_user = User::factory()->state(['name' => 'Anna'])->create();
        $user = User::factory()->state(['name' => 'Mary'])->create();

        $data = [
            'user_id' => $login_user->id,
            'follow_user_id' => $user->id
        ]; 
        $response = $this->actingAs($login_user)->post(action('App\Http\Controllers\FollowsController@store', $user->id), $data);
        
        $this->assertDatabaseHas('follows', [
            'user_id' => $login_user->id,
            'follow_user_id' => $user->id
        ]);

        $response->assertRedirect(route('users.show', ['user' => $user->id]));

        $response = $this->actingAs($login_user)->get(action('App\Http\Controllers\UsersController@show', $user->id));
        $response->assertStatus(200)->assertViewIs('users.show')->assertSee('フォロー解除');
    }

    public function test_follow_destroy()
    {
        $login_user = User::factory()->state(['name' => 'Anna'])->create();
        $user = User::factory()->state(['name' => 'Mary'])->create();

        $follow =Follow::factory()->state(['user_id' => $login_user->id, 'follow_user_id' => $user->id])->create();

        $response = $this->actingAs($login_user)->delete(action('App\Http\Controllers\FollowsController@destroy', ['user' => $user->id, 'follow' => $follow->id]));

        $this->assertDeleted('follows', [
            'user_id' => $login_user->id,
            'follow_user_id' => $user->id
        ]);

        $response->assertRedirect(route('users.show', ['user' => $user->id]));
        
        $response = $this->actingAs($login_user)->get(action('App\Http\Controllers\UsersController@show', $user->id));
        $response->assertStatus(200)->assertViewIs('users.show')->assertSee('フォローする');
    }
}
