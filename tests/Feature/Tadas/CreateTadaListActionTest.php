<?php

namespace Tests\Feature\Tadas;

use Database\Factories\StoreTadaListDataFactory;
use Database\Factories\UserFactory;
use Domain\Tadas\Actions\CreateTadaListAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTadaListActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldCreateTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaListData = StoreTadaListDataFactory::new()->create();

    $tadaList = (new CreateTadaListAction())($user->id, $tadaListData);

    $this->assertDatabaseHas($tadaList->getTable(), $tadaList->getAttributes());
  }
}
