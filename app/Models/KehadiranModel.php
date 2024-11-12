<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KehadiranModel extends Model
{
    use HasFactory;

    protected $table = 'kehadiran';
    protected $primaryKey = 'kehadiran_id';
    protected $guarded = ['kehadiran_id'];

    public function getkajian()
    {
        return $this->belongsTo(Kajian::class, 'kajian', 'kajian_id');
    }
}
