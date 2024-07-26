<?php

namespace App\Models;

use App\Enums\Product\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'user_id'];

    protected $casts = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $table = 'products';

    public function scopeType(Builder $query, int $type): void
    {
        switch ($type) {
            case Type::OnlyDeleted->value :
                $query->onlyTrashed();
                break;
            case Type::WithDeleted->value:
                $query->withTrashed();
        }
    }

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
