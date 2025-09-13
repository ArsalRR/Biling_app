<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PS extends Model
{
    protected $table = 'ps';
    protected $fillable = [ 'nomor_ps', 'nama_ps', 'ip_tv'];
  
}
