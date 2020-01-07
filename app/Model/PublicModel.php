<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PublicModel extends Model
{
    protected $table = "public";
    protected $primaryKey = "pub_id";
}
