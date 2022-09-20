<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;




class passoutContoller extends Controller
{

    function passout(Request $request)
    {
        $old_class=$request->input("class_id");
        $old_class=(int)$old_class;
        $old_section=$request->input("section_id");
        $old_section=(int)$old_section;
        $studentData = Student::where(['class_id'=>$old_class,'section_id'=>$old_section,'Status'=>"Active"])->get();
        foreach ($studentData as $list) {
            Student::where('student_id', $list->student_id )->update(
                [
                    'Status'=>"Passout"
                ]
            );
        }


    }
}
