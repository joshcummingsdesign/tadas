<?php

namespace Tests\Feature\Tadas\Actions;

use Domain\Tadas\Actions\SetCurrentTadaListAction;
use Domain\Tadas\Models\CurrentTadaList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\CurrentTadaListFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class SetCurrentTadaListActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldSetCurrentTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $currentTadaList = new CurrentTadaList();

    (new SetCurrentTadaListAction())($user->id, $tadaList->id);

    $this->assertDatabaseHas($currentTadaList->getTable(), [
      'user_id' => $user->id,
      'tada_list_id' => $tadaList->id,
    ]);
  }

  public function testShouldUpdateCurrentTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $newTadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $currentTadaList = CurrentTadaListFactory::new()
      ->withUserId($user->id)
      ->withTadaListId($tadaList->id)
      ->create();

    (new SetCurrentTadaListAction())($user->id, $newTadaList->id);

    $this->assertDatabaseHas($currentTadaList->getTable(), [
      'user_id' => $user->id,
      'tada_list_id' => $newTadaList->id,
    ]);
  }
}
