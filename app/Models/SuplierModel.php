<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuplierModel extends Model
{
    use HasFactory;

    protected $table ='m_suplier' ;        //Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'suplier_id';  //mendefinisikan primary key dari tabel yang digunakan

    protected $fillable = ['suplier_id','suplier_kode', 'suplier_nama'];

}
