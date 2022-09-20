<?php

namespace App\Http\Controllers;

use App\Models\classes;
use App\Models\Fee;
use App\Models\Parents;
use App\Models\program;
use App\Models\roll;
use App\Models\section;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function parent_dropdown()
    {
        $parent_data= Parents::all()->where('status', "Active");
        $parent_down = '<option value="">Select Parent</option>';
        foreach ($parent_data as $list) {
            $parent_down .='
            <option value= "'. $list->parent_id .'" >'.$list->parent_name.' </option>
            ';
        }
        return response()->json([$parent_down]);
    }


    public function program_dropdown()
    {
        $program_data= program::all()->where('status', "Active");
        $program_down = '<option value="" >Select Program</option>';
        foreach ($program_data as $list) {
            $program_down .='
            <option value= "'. $list->program_id .'" >'.$list->program_name.' </option>
            ';
        }
        return response()->json([$program_down]);
    }


    public function classes_dropdown(Request $request)
    {
        $program_id=$request->post('program_id');
        $classes_data=classes::where(['program_id'=>$program_id,'status'=>"Active"])->get();
        $classes_down = '<option value="">Select Class</option>';
        foreach ($classes_data as $list) {
            $classes_down .='
            <option value= "'. $list->class_id .'" >'.$list->class_name.' </option>
            ';
        }
        return response()->json([$classes_down]);
    }


    public function sections_dropdown(Request $request)
    {
        $class_id=$request->post('class_id');
        $sections_data=section::where(['class_id'=>$class_id,'status'=>"Active"])->get();
        $sections_down = '<option value="">Select Section</option>';
        foreach ($sections_data as $list) {
            $sections_down .='
            <option value= "'. $list->section_id .'" >'.$list->section_name.' </option>
            ';
        }
        return response()->json([$sections_down]);
    }


    public function roll_dropdown(Request $request)
    {
        $section_id=$request->post('section_id');
        $rolls_data=roll::where(['section_id'=>$section_id,'roll_status'=>"Active"])->get();
        $rolls_down = ' <option value="">Select Roll No.</option>';
        foreach ($rolls_data as $list) {
            $rolls_down .='
            <option value= "'. $list->roll_id .'" >'.$list->roll_no.' </option>
            ';
        }
        return response()->json([$rolls_down]);
    }



    public function student_insert(Request $request)
    {
        $std_obj= new Student();
        $std_obj->parent_id=$request->input('parent_id');
        $std_obj->student_name=$request->input('student_name');
        $std_obj->program_id=$request->input('program_id');
        $std_obj->class_id=$request->input('class_id');
        $std_obj->section_id=$request->input('section_id');
        $std_obj->roll_id=$request->input('roll_id');
        $std_obj->dateofbirth=$request->input('dateofbirth');
        $std_obj->dateofadmission=$request->input('dateofadmission');
        $std_obj->tuition_fee=$request->input('tuition_fee');
        $std_obj->stationary_fee=$request->input('stationary_fee');
        $std_obj->admission_fee=$request->input('admission_fee');
        $std_obj->anual_fee=$request->input('anual_fee');
        $std_obj->fine=$request->input('fine');
        $std_obj->status ="Active";
        $std_obj->save();
        $student_id=$std_obj->id;


        $id= $request->input('roll_id');
        roll::where('roll_id', $id)
       ->update([
           'roll_status' => "Occupy",
        ]);

        $doa=$request->input('dateofadmission');
        $month=explode('-', $doa);

        for ($start=$month[1]; $start<= 12; $start++) {
            $feeObj=new Fee();
            $feeObj->fee=$request->input('tuition_fee');
            $feeObj->student_id=$student_id;
            $feeObj->parent_id=$request->input('parent_id');
            $feeObj->due_date=0;
            $feeObj->after_date=0;
            $feeObj->date_created=$request->input('dateofadmission');
            $feeObj->total_fee=$request->input('tuition_fee');
            $feeObj->paid=0;
            $feeObj->remaining=0;
            $feeObj->fee_status="pending";
            $feeObj->month=$start;
            $feeObj->day=$month[2];
            $feeObj->year=$month[0];
            $feeObj->save();
        }
    }
    public function Fetchall_std()
    {
        $data=DB::table('students')
        ->join('roll', 'roll.roll_id', '=', 'students.roll_id')
        ->join('classes', 'classes.class_id', '=', 'students.class_id')
        ->join('sections', 'sections.section_id', '=', 'students.section_id')
        ->join('parents', 'parents.parent_id', '=', 'students.parent_id')
        ->join('programs', 'programs.program_id', '=', 'students.program_id')
        ->select('students.*', 'roll.roll_no', 'classes.class_name', 'sections.section_name', 'parents.parent_name', 'programs.program_name')
        ->get();
        return view('student-datatables', ['data'=>$data]);
    }


    public function student_edit(Request $request)
    {
        $student_id=$request->input('id');

        $studentData=DB::table('students')
        ->join('roll', 'roll.roll_id', '=', 'students.roll_id')
        ->join('classes', 'classes.class_id', '=', 'students.class_id')
        ->join('sections', 'sections.section_id', '=', 'students.section_id')
        ->join('parents', 'parents.parent_id', '=', 'students.parent_id')
        ->join('programs', 'programs.program_id', '=', 'students.program_id')
        ->select('students.*', 'roll.roll_no', 'classes.class_name', 'sections.section_name', 'parents.parent_name', 'programs.program_name')
        ->where('student_id', $student_id)
        ->first();

        $parents_output = '<option >Select Parent</option>';
        $parents_output .= '<option class="text-success" value="'.$studentData->parent_id.'" selected>'.$studentData->parent_name.'</option>';
        $parentsData= Parents::where('status', "Active")->get();
        foreach ($parentsData as $list) {
            $parents_output .='
            <option value= "'. $list->parent_id .'" >'.$list->parent_name.' </option>
            ';
        }

        $programs_output = '<option >Select Programs</option>';
        $programs_output .= '<option class="text-success" value="'.$studentData->program_id.'" selected>'.$studentData->program_name.'</option>';
        $programsData= program::where('status', "Active")->get();
        foreach ($programsData as $list) {
            $programs_output .='
            <option value= "'. $list->program_id .'" >'.$list->program_name.' </option>
            ';
        }


        $classes_output = '<option >Select Programs</option>';
        $classes_output .= '<option class="text-success" value="'.$studentData->class_id.'" selected>'.$studentData->class_name.'</option>';
        $classesData= classes::where('status', "Active")->where('program_id', $studentData->program_id)->get();
        foreach ($classesData as $list) {
            $classes_output .='
            <option value= "'. $list->class_id .'" >'.$list->class_name.' </option>
            ';
        }

        $sections_output = '<option >Select Programs</option>';
        $sections_output .= '<option class="text-success" value="'.$studentData->section_id.'" selected>'.$studentData->section_name.'</option>';
        $sectionsData= section::where('status', "Active")->where('class_id', $studentData->class_id)->get();
        foreach ($sectionsData as $list) {
            $sections_output .='
            <option value= "'. $list->section_id .'" >'.$list->section_name.' </option>
            ';
        }

        $rolls_output = '<option >Select Roll No.</option>';
        $rolls_output .= '<option class="text-success" value="'.$studentData->roll_id.'" selected>'.$studentData->roll_no.'</option>';
        $rollsData= roll::where('roll_status', "Active")->where('section_id', $studentData->section_id)->get();
        foreach ($rollsData as $list) {
            $rolls_output .='
            <option value= "'. $list->roll_id .'" >'.$list->roll_no.' </option>
            ';
        }
        // $data= classes::where('class_id', $id)->get();
        return response()->json([$studentData,$parents_output,$programs_output,$classes_output,$sections_output,$rolls_output,$studentData->roll_id ]);
    }
    public function student_update(Request $request)
    {
        $student_id=$request->input('student_update_id');
        $student_last_roll_id=$request->input('student_last_roll_id');
        Student::where('student_id', $student_id)->update([

            'parent_id'=>$request->input('parent_id'),
            'student_name'=>$request->input('student_name'),
            'program_id'=>$request->input('program_id'),
            'class_id'=>$request->input('class_id'),
            'section_id'=>$request->input('section_id'),
            'roll_id'=>$request->input('roll_id'),
            'dateofbirth'=>$request->input('dateofbirth'),
            'dateofadmission'=>$request->input('dateofadmission'),
            'tuition_fee'=>$request->input('tuition_fee'),
            'stationary_fee'=>$request->input('stationary_fee'),
            'admission_fee'=>$request->input('admission_fee'),
            'anual_fee'=>$request->input('anual_fee'),
            'fine'=>$request->input('fine'),
            'status' =>$request->input('status'),
        ]);

        roll::where('roll_id', $request->input('roll_id'))
       ->update([
           'roll_status' => "Occupy",
        ]);

        roll::where('roll_id', $student_last_roll_id)
        ->update([
            'roll_status' => "Active",
         ]);
        return response()->json([
            'status' => 200,
           ]);
    }
    public function fetchallStd()
    {

        $studentData=DB::table('students')
        ->join('roll', 'roll.roll_id', '=', 'students.roll_id')
        ->join('classes', 'classes.class_id', '=', 'students.class_id')
        ->join('sections', 'sections.section_id', '=', 'students.section_id')
        ->join('parents', 'parents.parent_id', '=', 'students.parent_id')
        ->join('programs', 'programs.program_id', '=', 'students.program_id')
        ->select('students.*', 'roll.roll_no', 'classes.class_name', 'sections.section_name', 'parents.parent_name', 'programs.program_name')
        ->get();
        $std=" ";
        foreach ($studentData as $item) {
            $std.='<tr>
            <th class="text-center">'.$item->student_id.'</th>
            <th>'. $item->student_name .'</th>
            <th>'. $item->parent_name .'</th>
            <th>'. $item->program_name.'</th>
            <th>'. $item->class_name .'</th>
            <th>'. $item->section_name .'</th>
            <th>'. $item->roll_no.' </th>
            <th>'. $item->dateofbirth .'</th>
            <th>'. $item->dateofadmission.' </th>
            <th>'. $item->tuition_fee .'</th>
            <th>'. $item->stationary_fee .'</th>
            <th>'. $item->admission_fee.' </th>
            <th>'. $item->anual_fee .'</th>
            <th>'. $item->fine.' </th>
            <td><span
                    class="badge badge-pill';
                    if ($item->Status == 'Active') {
                        $std.=' badge-success ';
                    } else {
                        $std.= ' badge-danger ';
                    }
                    $std.='">'. $item->Status.' </span></td>
            <th class="btn btn-primary mt-2 update" id="'. $item->student_id.' " data-toggle="modal" data-target="#myModal"
                data-backdrop="static" data-keyboard="false"> Update</th>
            </tr>';

        }
        echo $std;
    }
}
