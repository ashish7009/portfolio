<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
	 protected $fillable = ['project_name','description','tags','image','link','link_type','client','company'];
}