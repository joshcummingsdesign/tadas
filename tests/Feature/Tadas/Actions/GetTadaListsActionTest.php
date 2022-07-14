<?php

namespace Tests\Feature\Tadas\Actions;

use Domain\Tadas\Actions\GetTadaListsAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class GetTadaListsActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldGetTadaLists(): void {
    $user = UserFactory::new()->create();
    $dbTadaList = TadaListFactory::new()->withUserId($user->id)->create();

    $tadaLists = (new GetTadaListsAction())($user);

    $this->assertEquals($dbTadaList->getAttributes(), $tadaLists->first()->getAttributes());
  }

  public function testShouldHandleNoneFound(): void {
    $user = UserFactory::new()->create();

    $tadaLists = (new GetTadaListsAction())($user);

    $this->assertTrue($tadaLists->isEmpty());
  }
}
