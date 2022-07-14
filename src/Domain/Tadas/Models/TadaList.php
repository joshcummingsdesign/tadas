<?php

namespace Domain\Tadas\Models;

use Domain\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * TadaList model.
 *
 * @since 1.0.0
 * @mixin IdeHelperTadaList
 */
class TadaList extends Model {
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @since 1.0.0
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'name',
  ];

  /**
   * Get the user a tada list belongs to.
   *
   * @since 1.0.0
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the tadas for a tada list.
   *
   * @since 1.0.0
   */
  public function tadas(): HasMany {
    return $this->hasMany(Tada::class);
  }
}
