<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketModel extends Model
{
    use HasFactory;
    protected $table = 'tiket';

    protected $guarded = ['tiket_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kajian()
    {
        return $this->belongsTo(Kajian::class);
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user', 'user_id');
    // }
    // public function kajian()
    // {
    //     return $this->belongsTo(KajianModel::class, 'kajian', 'kajian_id');
    // }
}
