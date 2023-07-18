<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    //Very simple author table.  Keeps authors separate from Users that may have different access/perms down the road
    protected $fillable = [
        'id', 'name'
    ];

    //An author could have many different announcements
    public function announcements() {
        return $this->hasMany(Announcement::class);
    }

    // This may exist already, not sure.  I'm not very familiar with Laravel built in functionality
    public static function findByName($name)
    {
        return static::where('name', $name)->first();
    }
}
