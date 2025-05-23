<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class kategoriModel extends Model
{
    use HasFactory;

    protected $table ='m_kategori' ;        //Mendefinisikan nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'kategori_id';  //mendefinisikan primary key dari tabel yang digunakan

    protected $fillable = ['kategori_id','kategori_kode', 'kategori_nama'];

}
