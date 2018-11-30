<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class mahasiswa_kelas extends Model
{
    protected $table = 'mahasiswa_kelas';

    protected $primaryKey = 'id_mhs_kelas';

    public function kelas(){
      return $this->belongsTo('App\kelas', 'id_kelas');
    }

    public function mahasiswa(){
      return $this->belongsTo('App\mahasiswa', 'id_mahasiswa');
    }
}
