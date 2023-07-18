<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    // Simple announcement model 
    // posted_date: date that the post was made - could use created_at instead
    // subject: subject of the post
    // body: text of the post, assuming text can hold markdown just fine
    // authors_id: foreign key constraint on the authors table/model 
    protected $fillable = [
        'id', 'posted_date', 'subject', 'body', 'authors_id'
    ];

    // Every announcement belongs to an Author (could be multiple)
    public function author() {
        return $this->belongsTo(Author::class, 'authors_id');
    }
}
