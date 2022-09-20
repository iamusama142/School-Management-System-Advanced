<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\classes;
use App\Models\datesheet_Details;
use App\Models\datesheets;
use App\Models\section;
use App\Models\subject;
use Illuminate\Http\Request;
use PDF;



class DateSheetController extends Controller
{

    function sections_dropdown(Request $request)
    {

        $class_id = $request->post('class_id');
        $sections_data = section::where(['class_id' => $class_id, 'status' => "Active"])->get();
        $sections_down = '<option value="">select Section</option>';
        foreach ($sections_data as $list) {
            $sections_down .= '
            <option value= "' . $list->section_id . '" >' . $list->section_name . ' </option>
            ';
        }
        return response()->json([$sections_down]);
    }


    function fetch_classes()
    {
        $data = classes::where('status', "Active")->get();
        $output = '<option value=\"\">Select Class</option>';
        foreach ($data as $list) {
            $output .= "
            <option value=\" " . $list->class_id . " \" >$list->class_name </option>
            ";
        }
        echo $output;
    }



    function fetch_subjects(Request $request)
    {


        $subjects_data = subject::where(['class_id' => $request->input('class_id'), 'section_id' => $request->input('section_id')])->get();
        $subjects_down = '<option value=""> Subject</option>';
        foreach ($subjects_data as $list) {
            $subjects_down .= '
            <option value= "' . $list->subject_id . '" >' . $list->subject_name . ' </option>
            ';
        }
        return response()->json([$subjects_down]);
    }


    function table_rows_count(Request $request)
    {
        $subjects_numbers = subject::where(['class_id' => $request->input('class_id'), 'section_id' => $request->input('section_id')])->count();
        return $subjects_numbers;
    }

    function datesheet_insert(Request $request)
    {

        //Insert into datesheet Tbl
        $datesheet_obj = new datesheets();
        $datesheet_obj->class_id = $request->input('class_id');
        $datesheet_obj->section_id = $request->input('section_id');
        $datesheet_obj->title = $request->input('title');
        $datesheet_obj->save();
        $id = $datesheet_obj->id;

        //Insert into datesheet_Details Tbl
        $data = $request->all();
        for ($a = 0; $a < count($request->input('date')); $a++) {
            $datesheet_Details_Obj = new datesheet_Details();
            $datesheet_Details_Obj->datesheet_id = $id;
            $datesheet_Details_Obj->date = $data['date'][$a];
            $datesheet_Details_Obj->day = $data['day'][$a];
            $datesheet_Details_Obj->time_start = $data['time_start'][$a];
            $datesheet_Details_Obj->time_end = $data['time_end'][$a];
            $datesheet_Details_Obj->subject_id = $data['subject_id'][$a];
            $datesheet_Details_Obj->save();
        }
    }

    function dateSheet_datatable()
    {
        return view('datesheet-datatable');
    }

    function FecthalldateSheet(){
        $studentData=DB::table('datesheets')
        ->join('classes', 'classes.class_id', '=', 'datesheets.class_id')
        ->join('sections', 'sections.section_id', '=', 'datesheets.section_id')
        ->select('datesheets.*',  'classes.class_name','sections.section_name')

        ->orderBy('created_at')
        ->get();
        $timetable=" ";
        foreach ($studentData as $item) {
            $timetable.='<tr>
            <th class="text-center">'.$item->id.'</th>
            <th>'. $item->title.' </th>
            <th>'. $item->class_name .'</th>
            <th>'. $item->section_name .'</th>
            <td> <a  target="_blank" href="/dateSheet/PDF/'.$item->id.'"><button class=" btn btn-primary mt-2 "><i class="fas fa-eye"></i>View </button></a></td>
            </tr>';

        }
        echo $timetable;
    }
}