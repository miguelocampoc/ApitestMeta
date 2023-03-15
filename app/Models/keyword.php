<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keyword extends Model
{
    use HasFactory;
    protected $table= "keywords";

    public $fillable = [
        'id',
        'orcid_id',
        'content',
        'created_at',
        'updated_at'
    ];
    public function orcid(){
        return $this->belongsTo('App\Models\orcid','orcid_id','id');
    }
}
