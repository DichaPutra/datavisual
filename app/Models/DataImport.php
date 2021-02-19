<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataImport extends Model {
    protected $table = 'dataimport';
    protected $fillable = ['komoditi','output','konsumsiantara','pajakkurangsubsidi'];
    public $timestamps = false;

}
