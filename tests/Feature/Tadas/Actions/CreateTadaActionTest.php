<?php

namespace Tests\Feature\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
use Domain\Tadas\Actions\CreateTadaAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\StoreTadaDataFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class CreateTadaActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldCreateTada(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tadaData = StoreTadaDataFactory::new()->withTadaListId($tadaList->id)->create();

    $tada = (new CreateTadaAction())($user, $tadaData);

    $this->assertDatabaseHas($tada->getTable(), $tada->getAttributes());
  }

  public function testShouldThrowIfListNotFound(): void {
    $user = UserFactory::new()->create();
    $tadaData = StoreTadaDataFactory::new()->withTadaListId(1)->create();

    $this->expectException(UnprocessableEntityException::class);

    (new CreateTadaAction())($user, $tadaData);
  }
}
