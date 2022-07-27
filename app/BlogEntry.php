<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogEntry extends Model
{
    protected $table='t_blog';
    protected $fillable=['BlogId','BlogType','BlogDateTime','BlogTitle','Thumbnail','EmbedCode','Content'];
}
