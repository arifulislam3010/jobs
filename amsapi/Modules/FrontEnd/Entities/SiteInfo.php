<?php

namespace Modules\FrontEnd\Entities;

use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    protected $table = "site_infos";
    protected $guarded = ['id'];
    protected $fillable = [];
}
