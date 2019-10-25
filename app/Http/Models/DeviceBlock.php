<?php

namespace App\Http\Models;

use App\Http\Traits\UsesUuid;
use App\Http\Traits\Filter;
use Illuminate\Database\Eloquent\Model;

class DeviceBlock extends Model
{
    use Filter;
    use UsesUuid;

    protected $fillable = ['mac_address', 'device_name', 'restarted_at', 'count', 'is_block'];

    /**
     * Relationship to Verify Code
     */
    public function verifyCodes()
    {
        return $this->hasMany(VerifyCode::class, 'device_block_id');
    }
}
