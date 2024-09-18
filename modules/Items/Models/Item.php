<?php

namespace Modules\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Modules\Users\Models\User;
use Iben\Statable\Statable;

class Item extends Model
{
    use HasFactory, Statable;

    protected $fillable = [
        'name',
        'completed',
        'created_at',
        'status',
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
