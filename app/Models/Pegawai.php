<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded =['id'];
    protected $with =['jabatan','kontrak'];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function kontrak()
    {
        return $this->belongsTo(Kontrak::class);
    }
}
