<?php

declare(strict_types=1);

namespace Domain\User\Models;

use Domain\Tadas\Models\CurrentTadaList;
use Domain\Tadas\Models\Tada;
use Domain\Tadas\Models\TadaList;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * The User model.
 *
 * @unreleased
 *
 * @mixin Eloquent
 */
class User extends Authenticatable {
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @unreleased
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @unreleased
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @unreleased
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Get the tada lists for a user.
   *
   * @unreleased
   */
  public function tadaLists(): HasMany {
    return $this->hasMany(TadaList::class);
  }

  /**
   * Get the current tada list for a user.
   *
   * @unreleased
   */
  public function currentTadaList(): HasOne {
    return $this->hasOne(CurrentTadaList::class);
  }

  /**
   * Get the tadas for a user.
   *
   * @unreleased
   */
  public function tadas(): HasMany {
    return $this->hasMany(Tada::class);
  }
}
