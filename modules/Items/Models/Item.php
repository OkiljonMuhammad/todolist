<?php

namespace Modules\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Models\User;
use Kalnoy\Nestedset\NodeTrait;
use Iben\Statable\Statable;
use Carbon\Carbon;

class Item extends Model
{
    use HasFactory, Statable, NodeTrait;

    const STATUS_PENDING = 'pending';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_ARCHIVED = 'archived';
    const STATUS_CANCELED = 'canceled';
    
    protected $fillable = [
        'name',
        'completed',
        'created_at',
        'status',
        'user_id',
        'parent_id'
    ];
    
    protected $casts = [
        'completed' => 'boolean',
    ];

    public function getGraph()
    {
        return 'item_graph';  
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Get the created_at attribute in Asia/Tashkent timezone.
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Tashkent');
    }

    
    // Get the updated_at attribute in Asia/Tashkent timezone.
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone('Asia/Tashkent');
    }
}
