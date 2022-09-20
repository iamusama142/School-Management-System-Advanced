<?php

namespace App\Http\Controllers;

use App\Models\section;
use App\Models\classes;
use App\Models\roll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SectionController extends Controller
{
    function section_insert(Request $request)
    {
        $newclass = new section;
        $newclass->section_name = $request->input('section_name');
        $newclass->class_id = $request->input('class_id');
        $newclass->rollno_start = $request->input('rollno_start');
        $newclass->rollno_end = $request->input('rollno_end');
        $newclass->status = "Active";
		$newclass->save();
        $sec=$newclass->id;



        for($start=$request->input('rollno_start'); $start<= $request->input('rollno_end');$start++ )
        {
            $newroll = new roll;
            $newroll->roll_no = $start;
            $newroll->section_id=$sec;
            $newroll->roll_status="Active";
            $newroll->save();
        }



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


    function FetchAll()
    {

        $data2 = DB::table('sections')
            ->join('classes', 'classes.class_id', '=', 'sections.class_id')
            ->select('sections.*', 'classes.class_name')
            ->get();

        $output = '';
        foreach($data2 as $list)
        {
            $output .=  "<tr>
            <td class=\"text-center\">".$list->section_id."</td>
            <td>".$list->section_name."</td>
            <td>".$list->class_name."</td>
            <td><span class=\"badge badge-pill  ";
            if($list->status == "Active")
            {
                $output .= " badge-success ";
            }else if($list->status == "Deactive"){
                $output .= " badge-danger ";
            }else{}
           // $output .= ($list->status == "Active") ?  "badge-success" : "badge-danger";
            $output .= " \" > ".$list->status ." </span></td>
            <td>".$list->rollno_start."</td>
            <td>".$list->rollno_end."</td>
            <td id=\"".$list->section_id."\" class=\"btn btn-primary mt-2 editIcon update\" data-toggle=\"modal\" data-target=\"#myModal\">Update</td>
        </tr>";

        }
        echo $output;
    }
    function sections_edit(Request $request){

        $section_id=$request->input('id');
        $section_data=DB::table('sections')
        ->join('classes', 'classes.class_id', '=', 'sections.class_id')
        ->select('sections.*', 'classes.class_name')
        ->where('section_id',$section_id)
        ->first();



        return response()->json([$section_data]);

    }
    function sections_update(Request $request){

         $section_id =$request->input('section_update_id');
        section::where('section_id',$section_id)->update([

            'section_name'=>$request->input('section_name_update'),
            'status'=>$request->input('status_update'),

        ]);
        return response()->json([
            'status'=>200
        ]);

    }

}