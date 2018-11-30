<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $primaryKey = 'id_mahasiswa';

    public function mahasiswa_kelas(){
      return $this->hasMany('App\mahasiswa_kelas');
    }

    public function kehadiran(){
      return $this->hasMany('App\kehadiran');
    }

    public function ortu(){
      return $this->belongsTo('App\ortu', 'id_ortu');
    }
}
