<?php

namespace App\Http\Controllers;

use App\Models\subject;
use Illuminate\Http\Request;
use App\Models\classes;
use App\Models\Parents;
use App\Models\section;
use Illuminate\Support\Facades\DB;


class SubjectController extends Controller
{

    function sections_dropdown(Request $request)
    {

        $class_id=$request->post('class_id');
		$sections_data=section::where(['class_id'=>$class_id,'status'=>"Active"])->get();
        $sections_down = '<option value="">select Section</option>';
        foreach($sections_data as $list)
        {
            $sections_down .='
            <option value= "'. $list->section_id .'" >'.$list->section_name.' </option>
            ';
        }
        return response()->json([$sections_down]);
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


    public function subject_insert(Request $request)
    {
        $obj_subject = new subject();
        $obj_subject->class_id=$request->input('class_id');
        $obj_subject->section_id=$request->input('section_id');
        $obj_subject->subject_name=$request->input('subject_name');
        $obj_subject->Status="Active";
        $obj_subject->save();
    }

    function fetchAllsubjects(){

        $subjectsData=DB::table('subjects')
        ->join('classes', 'classes.class_id', '=', 'subjects.class_id')
        ->join('sections', 'sections.section_id', '=', 'subjects.section_id')
        ->select('subjects.*','classes.class_name','sections.section_name')
        ->get()
        ;
        $str=" ";
        foreach ($subjectsData as $item) {
            $str.='<tr>
            <th class="text-center">'.$item->subject_id.'</th>
            <th>'. $item->subject_name .'</th>
            <th>'. $item->class_name .'</th>
            <th>'. $item->section_name.'</th>


            <td><span
                    class="badge badge-pill';
                    if ($item->Status == 'Active') {
                        $str.=' badge-success ';
                    } else {
                        $str.= ' badge-danger ';
                    }
                    $str.='">'. $item->Status.' </span></td>
            <th class="btn btn-primary mt-2 update" id="'. $item->subject_id.' " data-toggle="modal" data-target="#myModal"
                data-backdrop="static" data-keyboard="false"> Update</th>
            </tr>';

        }
        echo $str;

    }
    function subject_edit(Request $request){

        $subject_id=$request->input("id");
        $subjectsData=DB::table('subjects')
        ->join('classes', 'classes.class_id', '=', 'subjects.class_id')
        ->join('sections', 'sections.section_id', '=', 'subjects.section_id')
        ->select('subjects.*','classes.class_name','sections.section_name')
        ->where('subject_id',$subject_id)
        ->first();

        $classes_data= classes::where('status',"Active")->get();
        $classoutput = '<option value=\"\">Select Class</option>';
        $classoutput .= '<option class="text-success" value="'.$subjectsData->class_id.'" selected>'.$subjectsData->class_name.'</option>';
        foreach($classes_data as $list)
        {
            $classoutput .="
            <option value=\" ". $list->class_id ." \" >$list->class_name </option>
            ";
        }

        $sections_data= section::where('status',"Active")->where('class_id',$subjectsData->class_id)->get();
        $sectionoutput = '<option value=\"\">Select Class</option>';
        $sectionoutput .= '<option class="text-success" value="'.$subjectsData->section_id.'" selected>'.$subjectsData->section_name.'</option>';
        foreach($sections_data as $list)
        {
            $sectionoutput .="
            <option value=\" ". $list->section_id ." \" >$list->section_name </option>
            ";
        }

        return response()->json([$subjectsData,$classoutput,$sectionoutput]);


    }
    function subject_update(Request $request){

        $subject_id =$request->input('subject_update_id');
        subject::where('subject_id',$subject_id)->update([

            'subject_name'=>$request->input('subject_name_update'),
            'class_id'=>$request->input('class_id_update'),
            'section_id'=>$request->input('section_id_update'),
            'Status'=>$request->input('status_update'),

        ]);
        return response()->json([
            'status'=>200
        ]);
        return response()->json([
            'status' => 200,
           ]);
    }

}
