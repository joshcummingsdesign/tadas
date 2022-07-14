<?php

namespace Tests\Feature\Tadas\Actions;

use Domain\Tadas\Actions\CreateTadaListAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\StoreTadaListDataFactory;
use Tests\Feature\User\Factories\UserFactory;
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
