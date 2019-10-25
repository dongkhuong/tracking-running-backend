<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use App\Http\Traits\Filter;
use Illuminate\Database\Eloquent\Model;

class VerifyCode extends Model
{
    use Filter;
    use UsesUuid;

    protected $fillable = [
        'phone', 'code', 'expired_at', 'device_block_id'
    ];

    /**
     * Relationship to Device Block
     */
    public function deviceBlock()
    {
        return $this->belongsTo(DeviceBlock::class, 'device_block_id');
    }
}
