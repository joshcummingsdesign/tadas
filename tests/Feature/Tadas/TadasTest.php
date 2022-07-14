<?php

namespace Tests\Feature\Tadas;

use Domain\Tadas\Models\Tada;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\StoreTadaDataFactory;
use Tests\Feature\Tadas\Factories\TadaFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\Tadas\Factories\UpdateTadaDataFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class TadasTest extends TestCase {
  use RefreshDatabase;

  public function testCanCreateTada(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tadaData = StoreTadaDataFactory::new()->withTadaListId($tadaList->id)->create();

    $this->actingAs($user)->post('/tada', [
      'name' => $tadaData->name,
      'tada_list_id' => $tadaData->tada_list_id,
    ])
      ->assertStatus(302);

    $tada = Tada::first();

    $this->assertEquals($tadaData->name, $tada->name);
    $this->assertEquals($tadaData->tada_list_id, $tada->tada_list_id);
  }

  public function testCanUpdateTada(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tada = TadaFactory::new()->withUserId($user->id)->withTadaListId($tadaList->id)->create();
    $tadaData = UpdateTadaDataFactory::new()
      ->withName('New Name')
      ->withIsCompleted(true)
      ->create();

    $this->actingAs($user)->patch('/tada/' . $tada->id, [
      'name' => $tadaData->name,
    ])
      ->assertStatus(302);

    $this->assertEquals($tadaData->name, $tada->refresh()->name);
  }

  public function testCanDeleteTada(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tada = TadaFactory::new()->withUserId($user->id)->withTadaListId($tadaList->id)->create();

    $this->actingAs($user)
      ->delete('/tada/' . $tada->id)
      ->assertStatus(302);

    $this->assertDatabaseMissing($tada->getTable(), ['id' => $tada->id]);
  }
}
