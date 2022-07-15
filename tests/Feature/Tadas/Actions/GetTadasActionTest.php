<?php

namespace Tests\Feature\Tadas\Actions;

use Domain\Tadas\Actions\GetTadasAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\TadaFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class GetTadasActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldGetTadas(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    TadaFactory::new()
      ->withUserId($user->id)
      ->withTadaListId($tadaList->id)
      ->withIndex(1)
      ->create();
    $tada = TadaFactory::new()
      ->withUserId($user->id)
      ->withTadaListId($tadaList->id)
      ->withIndex(0)
      ->create();

    $tadas = (new GetTadasAction())($tadaList);

    $this->assertEquals($tada->getAttributes(), $tadas->first()->getAttributes());
    $this->assertEquals(0, $tadas->first()->index);
    $this->assertEquals(1, $tadas->last()->index);
  }

  public function testShouldHandleNoneFound(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();

    $tadas = (new GetTadasAction())($tadaList);

    $this->assertTrue($tadas->isEmpty());
  }
}
