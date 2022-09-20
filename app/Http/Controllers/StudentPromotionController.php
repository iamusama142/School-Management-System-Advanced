<?php

namespace App\Http\Controllers;

use App\Models\studentPromotion;
use Illuminate\Http\Request;
use App\Models\classes;
use App\Models\Student;
use App\Models\roll;
use App\Models\Fee;

class StudentPromotionController extends Controller
{

    function fetch_classes()
    {
        $data= classes::where('status',"Active")->get();
        $output = '<option value=\"\">Select Class</option>';
        foreach($data as $list)
        {
            $output .="
            <option value=\" ". $list->class_id ." \" >$list->class_name </option>
            ";
        }
        echo $output;
    }



    function promote(Request $request)
    {

        $old_class=$request->input("old_class_id");
        $old_class=(int)$old_class;
        $old_section=$request->input("old_section_id");
        $old_section=(int)$old_section;
        $promotion_fee=$request->input("promotion_fee");
        $promotion_fee=(int)$promotion_fee;


        $studentData = Student::where(['class_id'=>$old_class,'section_id'=>$old_section,'Status'=>"Active"])->get();

        foreach ($studentData as $list) {

            $std_obj= new Student();
            $std_obj->parent_id=$list->parent_id;
            $std_obj->student_name=$list->student_name;
            $std_obj->program_id=$list->program_id;
            $std_obj->class_id=$request->input('new_class_id');
            $std_obj->section_id=$request->input('new_section_id');
            $std_obj->roll_id=$list->roll_id;
            $std_obj->dateofbirth=$list->dateofbirth;
            $std_obj->dateofadmission=$list->dateofadmission;
            $std_obj->tuition_fee=$promotion_fee + $list->tuition_fee;
            $std_obj->stationary_fee=$list->stationary_fee;
            $std_obj->admission_fee=$list->admission_fee;
            $std_obj->anual_fee=$list->anual_fee;
            $std_obj->fine=$list->fine;
            $std_obj->status ="Active";
            $std_obj->save();
            $student_id=$std_obj->id;

            Student::where('student_id', $list->student_id )->update(
                [
                    'Status'=>"Passed"
                ]
            );

            $doa=$request->input('dateofpromotion');
            $month=explode('-',$doa);

            for($start=$month[1]; $start<= 12; $start++ )
            {
            $feeObj=new Fee();
            $feeObj->fee=$promotion_fee + $list->tuition_fee;
            $feeObj->student_id=$student_id;
            $feeObj->parent_id=$list->parent_id;
            $feeObj->due_date=0;
            $feeObj->after_date=0;
            $feeObj->date_created=$request->input('dateofpromotion');
            $feeObj->total_fee=$promotion_fee + $list->tuition_fee;
            $feeObj->paid=0;
            $feeObj->remaining=0;
            $feeObj->fee_status="pending";
            $feeObj->month=$start;
            $feeObj->day=$month[2];
            $feeObj->year=$month[0];
            $feeObj->save();
            }


        }


    }
}