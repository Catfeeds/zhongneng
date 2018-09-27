<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
class MoreArticle extends Model
{
	public $timestamps = false;
    protected $table = 'more_article';
    
}
