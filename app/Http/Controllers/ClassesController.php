<?php

namespace App\Http\Controllers;


use App\Models\classes;
use App\Models\program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassesController extends Controller
{
    function classes_insert(Request $request)
    {
        $newclass = new classes;
        $newclass->class_name = $request->input('class_name');
        $newclass->program_id = $request->input('program_id');
        $newclass->status = "Active";
		$newclass->save();
    }

    function FetchAll()
    {

        $data2 = DB::table('classes')
            ->join('programs', 'programs.program_id', '=', 'classes.program_id')
            ->select('classes.*', 'programs.program_name')
            ->get();

        $output = '';
        foreach($data2 as $list)
        {
            $output .=  "<tr>
            <td class=\"text-center\">".$list->class_id."</td>
            <td>".$list->class_name."</td>
            <td>".$list->program_name."</td>
            <td><span class=\"badge badge-pill  ";
            if($list->status == "Active")
            {
                $output .= " badge-success ";
            }else if($list->status == "Deactive"){
                $output .= " badge-danger ";
            }else{}
           // $output .= ($list->status == "Active") ?  "badge-success" : "badge-danger";
            $output .= " \" > ".$list->status ." </span></td>
            <td id=\"".$list->class_id."\" class=\"btn btn-primary mt-2 editIcon update\" data-toggle=\"modal\" data-target=\"#myModal\"  data-backdrop=\"static\" data-keyboard=\"false\">Update</td>
        </tr>";

        }
        echo $output;
    }

    function edit(Request $request) {



        $id=$request->input('id');

        $data = DB::table('classes')
        ->join('programs', 'programs.program_id', '=', 'classes.program_id')
        ->select('classes.*', 'programs.program_name')->where('class_id', $id)
        ->get();



        $program_data= program::all()->where('status',"Active");
        $program_output = '<option >Select Program</option>';
        $program_output .= '<option value="'.$data[0]->program_id.'" selected>'.$data[0]->program_name.'</option>';
        foreach($program_data as $list)
        {

            $program_output .='
            <option value= "'. $list->program_id .'" >'.$list->program_name.' </option>
            ';
        }

       // $data= classes::where('class_id', $id)->get();

        return response()->json([$data,$program_output]);
	}

    function classes_update(Request $request){

        $id= $request->input('class_update_id');
        classes::where('class_id', $id)
        ->update([
            'class_name' => $request->input('class_name_update'),
            'program_id' =>  $request->input('program_update'),
            'status' => $request->input('status_update') ,
         ]);

        return response()->json([
        'status' => 200,
        ]);

    }



    function fetch_programs()
    {
        $data= program::all()->where('status',"Active");
        $output = '<option value=\"\">Select Program</option>';
        foreach($data as $list)
        {
            $output .="
            <option value=\" ". $list->program_id ." \" >$list->program_name </option>
            ";
        }
        echo $output;
    }








}
