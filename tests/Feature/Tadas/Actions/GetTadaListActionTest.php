<?php

namespace Tests\Feature\Tadas\Actions;

use Domain\Tadas\Actions\GetTadaListAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
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

    $this->assertNull($tadaList);
  }
}
