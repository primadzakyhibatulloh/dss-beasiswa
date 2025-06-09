<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BobotGap extends Model
{
      protected $table = 'bobot_gap';

    protected $fillable = ['selisih', 'nilai_bobot'];

}
