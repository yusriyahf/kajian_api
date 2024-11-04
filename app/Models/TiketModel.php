<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketModel extends Model
{
    use HasFactory;

    protected $table = 'tiket';
    protected $primaryKey = 'tiket_id';
    protected $guarded = ['tiket_id'];

    public function getuser()
    {
        return $this->belongsTo(User::class, 'user', 'user_id');
    }
    public function getkajian()
    {
        return $this->belongsTo(KajianModel::class, 'kajian', 'kajian_id');
    }
}
