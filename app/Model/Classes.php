<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classes extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

   public function contents()
    {
        return $this->hasMany(ClassContent::class, 'class_id', 'id')
            ->where('is_published', true)->orderBy('priority');
    }

    public function contentsAll()
    {
        return $this->hasMany(ClassContent::class, 'class_id', 'id')
            ->orderBy('priority');
    }

    //enrollContents
    public function enrollContents()
    {
        return $this->hasMany(ClassContent::class, 'class_id', 'id')
            ->where('is_published', true)->orderBy('priority');
    }



    //END
}
