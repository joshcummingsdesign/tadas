<?php

namespace Domain\Tadas\Models;

use Domain\User\Models\User;
use Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Eloquent
 */
class TadaList extends Model {
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'user_id',
    'name',
  ];

  /**
   * Get the user a tada list belongs to.
   */
  public function user(): BelongsTo {
    return $this->belongsTo(User::class);
  }
}
