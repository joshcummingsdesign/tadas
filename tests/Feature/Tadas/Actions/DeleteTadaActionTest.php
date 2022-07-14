<?php

namespace Tests\Feature\Tadas\Actions;

use App\Exceptions\UnprocessableEntityException;
use Domain\Tadas\Actions\DeleteTadaAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Tadas\Factories\TadaFactory;
use Tests\Feature\Tadas\Factories\TadaListFactory;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class DeleteTadaActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldDeleteTada(): void {
    $user = UserFactory::new()->create();
    $tadaList = TadaListFactory::new()->withUserId($user->id)->create();
    $tada = TadaFactory::new()->withUserId($user->id)->withTadaListId($tadaList->id)->create();

    (new DeleteTadaAction())($user, $tada->id);

    $this->assertDatabaseMissing($tada->getTable(), ['id' => $tada->id]);
  }

  public function testShouldThrowIfTadaNotFound(): void {
    $user = UserFactory::new()->create();

    $this->expectException(UnprocessableEntityException::class);

    (new DeleteTadaAction())($user, 1);
  }
}
