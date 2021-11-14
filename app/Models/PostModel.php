<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    //
    protected $table = 'post_list';
    protected $fillable = ['title','content','cat_id','status','title_slug','created_by'];
}
