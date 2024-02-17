<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\User
 * 
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $image
 */
class User extends Model
{
    protected $fillable = ['firstname', 'lastname', 'email', 'image'];
    protected $appends = ['fullname'];

    /**
     * This PHP function returns the full name by concatenating the first name and last name with a
     * space in between.
     * 
     * @return string The function `getFullnameAttributes()` is returning the concatenation of the
     * `` and `` properties of the object, separated by a space.
     */
    public function getFullnameAttribute(): string
    {
        return $this->firstname.' '. $this->lastname;
    }
}