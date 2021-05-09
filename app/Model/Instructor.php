<?php

namespace App\Model;

use App\Model\Package;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{


    protected $guarded = ['id'];

    /*Package Purchase History*/
    public function purchaseHistory()
    {
        return $this->hasOne(PackagePurchaseHistory::class, 'user_id', 'user_id')->with('package');
    }
    /*Admin Payment History*/

    /*Courses*/
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id', 'user_id')->with('classes')->with('category');
    }


    // relationBetweenPackage
    public function relationBetweenPackage()
    {
        return $this->hasOne(Package::class, 'id', 'package_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function delete(){
        
        // Delete Instructor earnings
        $earnings = InstructorEarning::where('user_id', 21)->get();
        foreach($earnings as $item)
            $item->delete();

        // Delete Courses
        $courses = $this->hasMany(Course::class, 'user_id', 'user_id');
        foreach($courses as $item)
            $item->delete();

        // Delete User
        $this->user()->delete();
        parent::delete();
    }


    //END
}
