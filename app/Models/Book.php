<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'publication_date',
        'price',
        'description',
        'author_id',
        'subject_id'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
