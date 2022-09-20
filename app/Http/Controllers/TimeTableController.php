<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\classes;
use App\Models\datesheet_Details;
use App\Models\datesheets;
use App\Models\section;
use App\Models\subject;
use App\Models\timeTable;
use App\Models\timetable_detail;
use PDF;
use Illuminate\Support\Facades\DB;


class TimeTableController extends Controller
{

    function fetch_subjects_dropdown(Request $request)
    {

        // $class_id=$request->post('class_id');
		// $sections_data=section::where(['class_id'=>$class_id,'status'=>"Active"])->get();
        // $sections_down = '<option value="">select Section</option>';
        // foreach($sections_data as $list)
        // {
        //     $sections_down .='
        //     <option value= "'. $list->section_id .'" >'.$list->section_name.' </option>
        //     ';
        // }
        // return response()->json([$sections_down]);



        $subjects_data=subject::where(['class_id'=>$request->input('class_id')])->get();
        $subjects_down = '<option value=""> Subject</option>';
        foreach($subjects_data as $list)
        {
            $subjects_down .='
            <option value= "'. $list->subject_id .'" >'.$list->subject_name.' </option>
            ';
        }
        return response()->json([$subjects_down]);
    }


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



    function fetch_subjects(Request $request)
    {


		$subjects_data=subject::where(['class_id'=>$request->input('class_id'),'section_id'=>$request->input('section_id')])->get();
        $subjects_down = '<option value=""> Subject</option>';
        foreach($subjects_data as $list)
        {
            $subjects_down .='
            <option value= "'. $list->subject_id .'" >'.$list->subject_name.' </option>
            ';
        }
        return response()->json([$subjects_down]);
    }


    function table_rows_count(Request $request)
    {
        $subjects_numbers=subject::where(['class_id'=>$request->input('class_id')])->count();
        return $subjects_numbers;
    }

    function timetable_insert(Request $request){

        //Insert into timetables Tbl
        $timetable_obj= new timeTable();
        $timetable_obj->class_id=$request->input('class_id');
        $timetable_obj->title=$request->input('title');
        $timetable_obj->applyform=$request->input('applyfrom');
        $timetable_obj->save();
        $id=$timetable_obj->id;

        //Insert into timetable_details Tbl
        $data=$request->all();
        $days=['Monday','Tuesday','Wednessday','Thursday','Friday','Saturday'];
        $count=1;
       for($a=0;$a<count($request->input('subject'));$a++){
            $timetable_Details_Obj=new timetable_detail();
            $timetable_Details_Obj->timetable_id=$id;
            $timetable_Details_Obj->lec_no=$count;
            $timetable_Details_Obj->subject_id=$data['subject'][$a];
            $timetable_Details_Obj->save();
            $count++;
        }
        return "ok" ;
    }

    function Fecthalltimetable()
    {
        $studentData=DB::table('timetables')
        ->join('classes', 'classes.class_id', '=', 'timetables.class_id')
        ->select('timetables.*',  'classes.class_name')
        ->orderBy('applyform')
        ->get();
        $timetable=" ";
        foreach ($studentData as $item) {
            $timetable.='<tr>
            <th class="text-center">'.$item->timetable_id.'</th>
            <th>'. $item->title.' </th>
            <th>'. $item->class_name .'</th>
            <th>'. $item->applyform .'</th>
            <td> <a  target="_blank" href="/timetable/PDF/'.$item->timetable_id.'"><button class=" btn btn-primary mt-2 "><i class="fas fa-eye"></i>View </button></a></td>
            </tr>';

        }
        echo $timetable;
    }
    function timetable_datatable()
    {
        return view('timetable-datatable');
    }


}
