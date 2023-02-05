<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountStudentFee extends Model
{
    use HasFactory;

    //Student
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    //Year
    public function year()
    {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    //Class
    public function class()
    {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    //Fee Category
    public function fee_category()
    {
        return $this->belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }

    //Discount
    public function discount()
    {
        return $this->belongsTo(DiscountStudent::class, 'id', 'assign_student_id');
    }
}
