<?php

declare(strict_types=1);

namespace Domain\Auth\Requests;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Login request.
 *
 * @since 1.0.0
 */
class LoginRequest extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @since 1.0.0
   */
  public function authorize(): bool {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @since 1.0.0
   */
  public function rules(): array {
    return [
      'email' => ['required', 'string', 'email'],
      'password' => ['required', 'string'],
    ];
  }

  /**
   * Attempt to authenticate the request's credentials.
   *
   * @since 1.0.0
   *
   * @throws ValidationException
   */
  public function authenticate(): void {
    $this->ensureIsNotRateLimited();

    if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
      RateLimiter::hit($this->throttleKey());

      throw ValidationException::withMessages([
        'email' => trans('auth.failed'),
      ]);
    }

    RateLimiter::clear($this->throttleKey());
  }

  /**
   * Ensure the login request is not rate limited.
   *
   * @since 1.0.0
   *
   * @throws ValidationException
   */
  public function ensureIsNotRateLimited(): void {
    if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
      return;
    }

    event(new Lockout($this));

    $seconds = RateLimiter::availableIn($this->throttleKey());

    throw ValidationException::withMessages([
      'email' => trans('auth.throttle', [
        'seconds' => $seconds,
        'minutes' => ceil($seconds / 60),
      ]),
    ]);
  }

  /**
   * Get the rate limiting throttle key for the request.
   *
   * @since 1.0.0
   */
  public function throttleKey(): string {
    return Str::lower($this->input('email')).'|'.$this->ip();
  }
}
