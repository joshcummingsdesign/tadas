<?php

declare(strict_types=1);

namespace Domain\User\Models;

use Domain\Tadas\Models\Tada;
use Domain\Tadas\Models\TadaList;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @mixin Eloquent
 */
class User extends Authenticatable {
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
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
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  /**
   * Get the tada lists for a user.
   */
  public function tadaLists(): HasMany {
    return $this->hasMany(TadaList::class);
  }

  /**
   * Get the tadas for a user.
   */
  public function tadas(): HasMany {
    return $this->hasMany(Tada::class);
  }
}
