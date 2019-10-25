<?php

namespace App\Http\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Http\Traits\UsesUuid;
use App\Http\Traits\Filter;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use Filter;
    use UsesUuid;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 10;

    const ROLE_ADMIN = 1;

    const GENDER_FEMALE = 0;
    const GENDER_MALE = 1;
    const GENDER_OTHER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'phone', 'email', 'password', 'gender',
        'birthday', 'social_id', 'social_name', 'status', 'device_token', 'image_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
        'social_id',
        'social_name',
        'device_token',
        'status',
        'email_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function save(array $options = [])
    {
        // before save code
        $this->birthday = serverFormatDate($this->birthday);
        $result = parent::save($options);

        // returns boolean
        return $result;
    }

    public function articles()
    {
        return $this->hasMany(Article::class, 'id', 'author_id');
    }

    public function driver()
    {
        return $this->hasMany(Driver::class, 'id', 'user_id');
    }

    /**
     * Relate to image
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    /**
     * Relate to role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function roles()
    {
        return $this->hasMany(AuthAssignment::class);
    }

    /**
     * Relate to role
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->hasOne(AuthAssignment::class);
    }

    /**
     * Article relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function productLikes()
    {
        return $this->belongsToMany(Product::class, (new ProductLike)->getTable());
    }

    /**
     * Article relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function carts()
    {
        return $this->belongsToMany(Product::class);
    }

    public function getStatusLabel()
    {
        return $this->status == self::STATUS_ACTIVE ? 'success' : 'danger';
    }

    public function getStatusName()
    {
        return $this->status == self::STATUS_ACTIVE ? 'Active' : 'In-Active';
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_INACTIVE,
            self::STATUS_ACTIVE,
        ];
    }

    public function fullname()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function genderLabel()
    {
        if ($this->gender === self::GENDER_FEMALE) {
            return 'Nữ';
        } else if ($this->gender === self::GENDER_MALE) {
            return 'Nam';
        }

        return '-';
    }
}
