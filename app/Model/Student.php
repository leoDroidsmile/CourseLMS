<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{

    use SoftDeletes;

    protected $guarded = ['id'];

    public function delete(){

        $user = User::where('id', $this->user_id)->first();
        // Delete Enrollment
        $enrollments = Enrollment::where('user_id', $user->id)->get();
        foreach($enrollments as $item){
            $item->delete();
        }
        
        $user->delete();
        parent::delete();
    }
}
