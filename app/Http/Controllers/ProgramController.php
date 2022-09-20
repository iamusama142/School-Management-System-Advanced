<?php

namespace App\Http\Controllers;

use App\Models\program;
use Illuminate\Http\Request;


class ProgramController extends Controller
{
    function program_insert(Request $request)
    {
        $newprogram = new program;
        $newprogram->program_name = $request->input('program_name');
        $newprogram->status = "Active";
		$newprogram->save();
    }
    function FetchAll()
    {
        $data= program::all();
        $output = '';
        foreach($data as $list)
        {
            $output .=  "<tr>
            <td class=\"text-center\">".$list->program_id."</td>
            <td>".$list->program_name."</td>
            <td><span class=\"badge badge-pill  ";
            if($list->status == "Active")
            {
                $output .= "badge-success";
            }else{
                $output .= "badge-danger";
            }
           // $output .= ($list->status == "Active") ?  "badge-success" : "badge-danger";
            $output .= " \" > ".$list->status ." </span></td>
            <td id=\"".$list->program_id."\" class=\"btn btn-primary mt-2 editIcon update\" data-toggle=\"modal\" data-target=\"#myModal\" data-backdrop=\"static\" data-keyboard=\"false\">Update</td>

        </tr>";

        }
        echo $output;
    }

    public function edit(Request $request) {

        $id=$request->input('id');
        $data= program::where('program_id', $id)->get();
        return response()->json($data);
	}

    function parent_update(Request $request){

        $id= $request->input('program_update_id');
         program::where('program_id', $id)
        ->update([
            'program_name' => $request->input('program_name_update'),
            'status' => $request->input('status_update') ,
         ]);


        return response()->json([
        'status' => 200,
        ]);
    }
}
