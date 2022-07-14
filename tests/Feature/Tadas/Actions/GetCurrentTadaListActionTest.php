<?php

namespace Tests\Feature\Tadas\Actions;

use Domain\Tadas\Actions\GetCurrentTadaListAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\CurrentTadaListFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class GetCurrentTadaListActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldGetCurrentTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    CurrentTadaListFactory::new()
      ->withUserId($user->id)
      ->withTadaListId($tadaList->id)
      ->create();

    $currentTadaList = (new GetCurrentTadaListAction())($user);

    $this->assertEquals(
      $tadaList->getAttributes(),
      $currentTadaList->getAttributes()
    );
  }

  public function testShouldHandleNoneFound(): void {
    $user = UserFactory::new()->create();
    TadaListFactory::new()->withUserId($user->id)->create();

    $currentTadaList = (new GetCurrentTadaListAction())($user);

    $this->assertNull($currentTadaList);
  }
}
