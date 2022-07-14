<?php

namespace Tests\Feature\Tadas;

use Database\Factories\TadaListFactory;
use Database\Factories\UserFactory;
use Domain\Tadas\Actions\GetTadaListAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetTadaListActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldGetTadaList(): void {
    $user = UserFactory::new()->create();
    $dbTadaList = TadaListFactory::new()->withUserId($user->id)->create();

    $tadaList = (new GetTadaListAction())($user, $dbTadaList->id);

    $this->assertEquals($dbTadaList->getAttributes(), $tadaList->getAttributes());
  }

  public function testShouldHandleNoneFound(): void {
    $user = UserFactory::new()->create();

    $tadaList = (new GetTadaListAction())($user, 1);

    $this->assertEquals(null, $tadaList);
  }
}
