<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase {
  /**
   * A basic test example.
   */
  public function testAppReturnsSuccessfulResponse(): void {
    $response = $this->get('/login');
    $response->assertStatus(200);
  }
}
