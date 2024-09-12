?php

namespace Modules\Items\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'completed',
        'created_at',
    ];
    
    protected $casts = [
        'completed' => 'boolean',
    ];

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
