<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanModel extends Model
{
    use HasFactory;

    protected $table = 'catatan';
    protected $primaryKey = 'id';
    protected $guarded = ['catatan_id'];

    public function getuser()
    {
        return $this->belongsTo(User::class, 'user', 'user_id');
    }
}
