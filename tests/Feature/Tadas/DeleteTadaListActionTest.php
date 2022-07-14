<?php

namespace Tests\Feature\Tadas;

use App\Exceptions\UnprocessableEntityException;
use Database\Factories\TadaListFactory;
use Database\Factories\UserFactory;
use Domain\Tadas\Actions\DeleteTadaListAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTadaListActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldDeleteTadaList(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();

    (new DeleteTadaListAction())($user, $tadaList->id);

    $this->assertDatabaseMissing($tadaList->getTable(), ['id' => $tadaList->id]);
  }

  public function testShouldThrowIfListNotFound(): void {
    $user = UserFactory::new()->create();

    $this->expectException(UnprocessableEntityException::class);

    (new DeleteTadaListAction())($user, 1);
  }
}
