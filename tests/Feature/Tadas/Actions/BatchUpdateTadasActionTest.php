<?php

namespace Tests\Feature\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
use Domain\Tadas\Actions\BatchUpdateTadasAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\BatchUpdateTadasDataFactory;
use Tests\Feature\Tadas\Factories\TadaFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class BatchUpdateTadasActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldBatchUpdateTada(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tada1 = TadaFactory::new()->withUserId($user->id)->withTadaListId($tadaList->id)->create();
    $tada2 = TadaFactory::new()->withUserId($user->id)->withTadaListId($tadaList->id)->create();
    $tadaData1 = BatchUpdateTadasDataFactory::new()
      ->withId($tada1->id)
      ->withName('New Name')
      ->withIsCompleted(true)
      ->withIndex(0)
      ->create();
    $tadaData2 = BatchUpdateTadasDataFactory::new()
      ->withId($tada2->id)
      ->withName('New Name')
      ->withIsCompleted(true)
      ->withIndex(1)
      ->create();
    $tadasData = [$tadaData1, $tadaData2];

    (new BatchUpdateTadasAction())($user, $tadasData);

    $this->assertDatabaseHas($tada1->getTable(), [
      'id' => $tadaData1->id,
      'name' => $tadaData1->name,
      'is_completed' => $tadaData1->is_completed,
      'index' => $tadaData1->index,
    ]);

    $this->assertDatabaseHas($tada2->getTable(), [
      'id' => $tadaData2->id,
      'name' => $tadaData2->name,
      'is_completed' => $tadaData2->is_completed,
      'index' => $tadaData2->index,
    ]);
  }

  public function testShouldThrowOnInvalidId(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tada = TadaFactory::new()->withUserId($user->id)->withTadaListId($tadaList->id)->create();
    $tadaData1 = BatchUpdateTadasDataFactory::new()
      ->withId($tada->id)
      ->withName('New Name')
      ->withIsCompleted(true)
      ->withIndex(0)
      ->create();
    $tadaData2 = BatchUpdateTadasDataFactory::new()
      ->withId(999)
      ->withName('Bad Guy')
      ->withIsCompleted(true)
      ->withIndex(1)
      ->create();
    $tadasData = [$tadaData1, $tadaData2];

    $this->expectException(UnprocessableEntityException::class);

    (new BatchUpdateTadasAction())($user, $tadasData);
  }
}
