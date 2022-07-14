<?php

namespace Tests\Feature\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
use Domain\Tadas\Actions\UpdateTadaAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\TadaFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\Tadas\Factories\UpdateTadaDataFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class UpdateTadaActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldUpdateTada(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tada = TadaFactory::new()->withUserId($user->id)->withTadaListId($tadaList->id)->create();
    $tadaData = UpdateTadaDataFactory::new()
      ->withName('New Name')
      ->withIsCompleted(true)
      ->create();

    (new UpdateTadaAction())($user, $tada->id, $tadaData);

    $this->assertDatabaseHas($tada->getTable(), [
      'id' => $tada->id,
      'name' => $tadaData->name,
      'is_completed' => $tadaData->is_completed,
    ]);
  }

  public function testShouldThrowIfTadaNotFound(): void {
    $user = UserFactory::new()->create();
    $tadaData = UpdateTadaDataFactory::new()->create();

    $this->expectException(UnprocessableEntityException::class);

    (new UpdateTadaAction())($user, 1, $tadaData);
  }
}
