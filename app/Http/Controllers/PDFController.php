<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\invoice;
use App\Models\Parents;
use App\Models\Student;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use ZipArchive;
use PDF;

class PDFController extends Controller
{


    public function generatePDF($id)
    {
        $student = DB::table('students')
        ->join('roll', 'roll.roll_id', '=', 'students.roll_id')
        ->join('classes', 'classes.class_id', '=', 'students.class_id')
        ->join('sections', 'sections.section_id', '=', 'students.section_id')
        ->select('students.*', 'roll.roll_no', 'classes.class_name', 'sections.section_name')->where('parent_id', $id)
        ->get();




        $remaining=0;
        $month=date('m');
        $Remain=DB::table('fees')
            ->where('parent_id', $id)
            ->where('month', '<', $month)
            ->get();
        foreach ($Remain as $key) {
            if (($key->fee_status!="Paid")) {
                $remaining+= $key->fee ;
            }
        }

        $parent = Parents::where('parent_id', $id)
        ->get();

        $pdf = PDF::loadview('invoice', ['parent'=>$parent,'student'=>$student,'remaining_fee'=>$remaining])->setPaper('a4', 'potrait');
        return $pdf->stream('Voucher.pdf');
    }




    public function collected_fee_voucher($id)
    {
        $student = DB::table('students')
        ->join('roll', 'roll.roll_id', '=', 'students.roll_id')
        ->join('classes', 'classes.class_id', '=', 'students.class_id')
        ->join('sections', 'sections.section_id', '=', 'students.section_id')
        ->select('students.*', 'roll.roll_no', 'classes.class_name', 'sections.section_name')->where('parent_id', $id)
        ->get();

        $remaining=0;
        $month=date('m');
        $Remain=DB::table('fees')
            ->where('parent_id', $id)
            ->where('month', '<', $month)
            ->get();
        foreach ($Remain as $key) {
            if (($key->fee_status=="pending")) {
                $remaining+= $key->fee ;
            }
        }

        $parent = Parents::where('parent_id', $id)
        ->get();

        $pdf = PDF::loadview('fee-collected-invoice', ['parent'=>$parent,'student'=>$student,'remaining_fee'=>$remaining])->setPaper('a4', 'potrait');
        return $pdf->stream('Voucher.pdf');
    }

    function datesheet($id)
    {
        $datesheet = DB::table('datesheets')
        ->join('datesheet__details', 'datesheet__details.datesheet_id', '=', 'datesheets.id')
        ->join('classes', 'classes.class_id', '=', 'datesheets.class_id')
        ->join('sections', 'sections.section_id', '=', 'datesheets.section_id')
        ->join('subjects', 'subjects.subject_id', '=', 'datesheet__details.subject_id')
        ->select('datesheets.*', 'datesheet__details.*','classes.class_name',  'sections.section_name',  'subjects.subject_name')->where('datesheets.id', $id)
        ->get();

        $pdf = PDF::loadview('DatesheetPDF',["data"=>$datesheet])->setPaper('a4', 'potrait');
        return $pdf->stream('datesheet.pdf');

    }
    function timetable($id)
    {
        $timeTable = DB::table('timetables')
        ->join('timetable_details', 'timetable_details.timetable_id', '=', 'timetables.timetable_id')
        ->join('classes', 'classes.class_id', '=', 'timetables.class_id')
        ->join('subjects', 'subjects.subject_id', '=', 'timetable_details.subject_id')
        ->select('timetables.*', 'timetable_details.*','classes.class_name', 'subjects.subject_name')->where('timetables.timetable_id', 1)
        ->get();

        $pdf = PDF::loadview('timetablePDF',['data'=>$timeTable])->setPaper('a4', 'potrait');
        return $pdf->stream('datesheet.pdf');
    }



}
