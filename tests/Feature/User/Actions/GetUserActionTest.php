<?php

namespace Tests\Feature\User\Actions;

use Domain\User\Actions\GetUserAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\Feature\User\Factories\UserFactory;
use Tests\TestCase;

class GetUserActionTest extends TestCase {
  use RefreshDatabase;

  public function testShouldGetUser(): void {
    $dbUser = UserFactory::new()->create();

    Auth::shouldReceive('id')->once()->andReturn($dbUser->id);

    $user = (new GetUserAction())();

    $this->assertEquals($dbUser->getAttributes(), $user->getAttributes());
  }
}
