<?php

namespace Pingpong\Trusty;

use Illuminate\Database\Eloquent\Model;
use Pingpong\Trusty\Traits\SlugableTrait;

class Permission extends Model
{
    use SlugableTrait;

    /**
     * Fillable property.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Relation to "Role".
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('trusty.model.role'))->withTimestamps();
    }
}
