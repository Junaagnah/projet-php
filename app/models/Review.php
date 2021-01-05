<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model {
    private int $id;
    public int $FK_userId;
    public int $FK_movieId;
    public string $review;
    public int $note;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'FK_userId', 'FK_movieId', 'review', 'note'
    ];
}
