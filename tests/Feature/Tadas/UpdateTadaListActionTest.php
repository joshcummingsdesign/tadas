<?php

namespace Tests\Feature\Tadas;

use App\Exceptions\UnprocessableEntityException;
use Database\Factories\StoreTadaListDataFactory;
use Database\Factories\TadaListFactory;
use Database\Factories\UserFactory;
use Domain\Tadas\Actions\UpdateTadaListAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTadaListActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldUpdateTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tadaListData = StoreTadaListDataFactory::new()->withName('New Name')->create();

    (new UpdateTadaListAction())($user, $tadaList->id, $tadaListData);

    $this->assertDatabaseHas($tadaList->getTable(), [
      'id' => $tadaList->id,
      'name' => $tadaListData->name,
    ]);
  }

  public function testShouldThrowIfListNotFound(): void {
    $user = UserFactory::new()->create();
    $tadaListData = StoreTadaListDataFactory::new()->create();

    $this->expectException(UnprocessableEntityException::class);

    (new UpdateTadaListAction())($user, 1, $tadaListData);
  }
}
