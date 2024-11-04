<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KajianModel extends Model
{
    use HasFactory;

    protected $table = 'kajian';
    protected $primaryKey = 'kajian_id';
    protected $guarded = ['kajian_id'];
}
