<?php

namespace Tests\Feature\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
use Domain\Tadas\Actions\DeleteTadaListAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\CurrentTadaListFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class DeleteTadaListActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldDeleteTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList1 = TadaListFactory::new()->withUserId($user->id)->create();
    $tadaList2 = TadaListFactory::new()->withUserId($user->id)->create();
    $currentTadaList = CurrentTadaListFactory::new()
      ->withUserId($user->id)
      ->withTadaListId($tadaList2->id)
      ->create();

    (new DeleteTadaListAction())($user, $tadaList2->id);

    $this->assertDatabaseMissing($tadaList2->getTable(), ['id' => $tadaList2->id]);

    $this->assertDatabaseHas($currentTadaList->getTable(), [
      'user_id' => $user->id,
      'tada_list_id' => $tadaList1->id,
    ]);
  }

  public function testShouldThrowIfListNotFound(): void {
    $user = UserFactory::new()->create();

    $this->expectException(UnprocessableEntityException::class);

    (new DeleteTadaListAction())($user, 1);
  }
}
