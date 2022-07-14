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
    $dbTada = TadaFactory::new()->withUserId($user->id)->withTadaListId($tadaList->id)->create();

    $tadas = (new GetTadasAction())($tadaList);

    $this->assertEquals($dbTada->getAttributes(), $tadas->first()->getAttributes());
  }

  public function testShouldHandleNoneFound(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();

    $tadas = (new GetTadasAction())($tadaList);

    $this->assertTrue($tadas->isEmpty());
  }
}
