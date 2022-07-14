<?php

namespace Tests\Feature\Tadas;

use Domain\Tadas\Models\CurrentTadaList;
use Domain\Tadas\Models\TadaList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\Feature\Tadas\Factories\CurrentTadaListFactory;
use Tests\Feature\Tadas\Factories\StoreTadaListDataFactory;
use Tests\Feature\Tadas\Factories\TadaFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class TadaListsTest extends TestCase {
  use RefreshDatabase;

  public function testHomeRedirectsToTadas(): void {
    $user = UserFactory::new()->create();

    $this->actingAs($user)
      ->get('/')
      ->assertRedirect('/tadas');
  }

  public function testCanRenderTadaLists(): void {
    $user = UserFactory::new()->create();
    TadaListFactory::new()->withUserId($user->id)->create();

    $this->actingAs($user)
      ->get('/tadas')
      ->assertStatus(200)
      ->assertInertia(fn (Assert $page) => $page->component('Tadas/TadaLists')
        ->where('tadaLists', $user->tadaLists()->get()));
  }

  public function testCanCreateTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaListData = StoreTadaListDataFactory::new()->create();

    $response = $this->actingAs($user)->post('/tadas', [
      'name' => $tadaListData->name,
    ])
      ->assertStatus(302);

    $tadaList = TadaList::first();
    $currentTadaList = CurrentTadaList::first();

    $this->assertEquals($tadaListData->name, $tadaList->name);
    $this->assertEquals($tadaList->id, $currentTadaList->tada_list_id);
    $response->assertLocation('/tadas/' . $tadaList->id);
  }

  public function testRedirectsToCurrentTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    CurrentTadaListFactory::new()
      ->withUserId($user->id)
      ->withTadaListId($tadaList->id)
      ->create();

    $this->actingAs($user)
      ->get('/tadas')
      ->assertRedirect('/tadas/' . $tadaList->id);
  }

  public function testCanRenderTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    TadaFactory::new() ->withUserId($user->id) ->withTadaListId($tadaList->id) ->create();

    $this->actingAs($user)->get('/tadas/' . $tadaList->id)
      ->assertStatus(200)
      ->assertInertia(fn (Assert $page) => $page->component('Tadas/TadaList')
        ->where('listId', $tadaList->id)
        ->where('tadaLists', $user->tadaLists()->get())
        ->where('tadaList', $tadaList)
        ->where('tadas', $user->tadas()->get()));
  }

  public function testRedirectWhenNoTadaFound(): void {
    $user = UserFactory::new()->create();

    $this->actingAs($user)
      ->get('/tadas/1')
      ->assertRedirect('/tadas');
  }

  public function testCanUpdateTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tadaListData = StoreTadaListDataFactory::new()->withName('New Name')->create();

    $this->actingAs($user)
      ->patch('/tadas/' . $tadaList->id, [
        'name' => $tadaListData->name,
      ])
      ->assertStatus(302);

    $this->assertDatabaseHas($tadaList->getTable(), [
      'id' => $tadaList->id,
      'name' => $tadaListData->name,
    ]);
  }

  public function testCanDeleteTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();

    $this->actingAs($user)
      ->delete('/tadas/' . $tadaList->id)
      ->assertStatus(302);

    $this->assertDatabaseMissing($tadaList->getTable(), ['id' => $tadaList->id]);
  }
}
