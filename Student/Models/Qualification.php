<?php


namespace Student\Models;


use App\Models\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    protected $fillable = [
        'name', 'board_university', 'passed_year','transcript','character','migration','user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
