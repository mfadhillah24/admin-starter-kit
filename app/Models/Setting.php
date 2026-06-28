<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable as AttributesFillable;



use Illuminate\Database\Eloquent\Model;
#[AttributesFillable(['app_name', 'copyright', 'login_title', 'keywords', 'description', 'logo'])]

class Setting extends Model
{
    //
}
