<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orcid extends Model
{
    use HasFactory;

    protected $table= "orcid";

    public $fillable = [
        'orcid_identifier_path',
        'given_names',
        'family_name',
        'email_primary',
        'created_at',
        'updated_at',
    ];
    public function keywords(){
        return $this->hasMany('App\Models\keyword', 'orcid_id', 'id');
    }
}
