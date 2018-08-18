<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
	 protected $fillable = ['project_name','description','tags','image','production_url','development_url','client','company'];
}