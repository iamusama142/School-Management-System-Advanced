<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Parents;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use PDF;

class ParentsController extends Controller
{
    public function parent_insert(Request $request)
    {
        $parent = new Parents;
        $parent->parent_name = $request->input('parent_name');
        $parent->phone = $request->input('phone');
        $parent->Gender = $request->input('gender');
        $parent->cnic = $request->input('cnic');
        $parent->address = $request->input('address');
        $parent->email = $request->input('email');
        $parent->about = $request->input('about');
        $parent->password = $request->input('password');
        $parent->status ="Active";
        $parent->save();
    }


    public function edit(Request $request)
    {
        $id=$request->id;
        $data= Parents::where('parent_id', $id)->get();
        return response()->json($data);
    }

    public function Fetch_parents()
    {
        $datas= Parents::all();
    }

    public function parent_update(Request $request)
    {
        $id= $request->input('id');
        Parents::where('parent_id', $id)
               ->update([
                   'parent_name' => $request->input('parent_name') ,
                   'phone' => $request->input('phone') ,
                   'gender' => $request->input('gender') ,
                   'cnic' => $request->input('cnic') ,
                   'address' => $request->input('address') ,
                   'email' => $request->input('email') ,
                   'password' => $request->input('password') ,
                   'status' => $request->input('status') ,
                ]);


        return response()->json([
        'status' => 200,
        ]);
    }





    public function duplicate_phone_insertion(Request $request)
    {
        $phone = $request->input('phone');

        $duplicates= DB::table('parents')
        ->where('phone', $phone)
        ->count();

        if ($duplicates==0) {
            //means valid
            return response()->json(array("exists" => true));
        } else {
            //means already exist
            return response()->json(array("exists" => false));
        }
    }

    public function duplicate_email_insertion(Request $request)
    {
        $email = $request->input('email');

        $duplicates= DB::table('parents')
        ->where('email', $email)
        ->count();

        if ($duplicates==0) {
            //means valid
            return response()->json(array("exists" => true));
        } else {
            //means already exist
            return response()->json(array("exists" => false));
        }
    }
    public function duplicate_cnic_insertion(Request $request)
    {
        $cnic = $request->input('cnic');

        $duplicates= DB::table('parents')
        ->where('cnic', $cnic)
        ->count();

        if ($duplicates==0) {

            //means valid
            return response()->json(array("exists" => true));
        } else {
            //means already exist
            return response()->json(array("exists" => false));
        }
    }






    public function duplicate_phone_updation(Request $request)
    {
        $phone = $request->input('phone');

        $parent_id = $request->input('id');
        $duplicates= DB::table('parents')
        ->where('phone', $phone)
        ->count();

        $id_duplicates= DB::table('parents')
        ->where(['parent_id'=> $parent_id,'phone'=> $phone  ])
        ->count();
        if ($id_duplicates==0 && $duplicates>=1) {
            //means already exist
            return response()->json(array("exists" => false));
        } elseif ($id_duplicates==1) {
            //means valid
            return response()->json(array("exists" => true));
        } else {
            //means already exist
            return response()->json(array("exists" => true));
        }
    }

    public function duplicate_email_updation(Request $request)
    {
        $email = $request->input('email');


        $parent_id = $request->input('id');
        $duplicates= DB::table('parents')
        ->where('email', $email)
        ->count();

        $id_duplicates= DB::table('parents')
        ->where(['parent_id'=> $parent_id,'email'=> $email  ])
        ->count();
        if ($id_duplicates==0 && $duplicates>=1) {
            //means already exist
            return response()->json(array("exists" => false));
        } elseif ($id_duplicates==1) {
            //means valid
            return response()->json(array("exists" => true));
        } else {
            //means already exist
            return response()->json(array("exists" => true));
        }
    }
    public function duplicate_cnic_updation(Request $request)
    {
        $cnic = $request->input('cnic');
        $parent_id = $request->input('id');
        $duplicates= DB::table('parents')
        ->where('cnic', $cnic)
        ->count();

        $id_duplicates= DB::table('parents')
        ->where(['parent_id'=> $parent_id,'cnic'=> $cnic  ])
        ->count();
        if ($id_duplicates==0 && $duplicates>=1) {
            //means already exist
            return response()->json(array("exists" => false));
        } elseif ($id_duplicates==1) {
            //means valid
            return response()->json(array("exists" => true));
        } else {
            //means already exist
            return response()->json(array("exists" => true));
        }
    }





    public function fetchall()
    {


        // $remaining=0;
        // $month=date('m');
        //     $Remain=DB::table('fees')
        //     ->where('parent_id',$id)
        //     ->where('month','<',$month)
        //     ->get();
        //     foreach ($Remain as $key) {
        //         if(($key->fee_status=="pending"))
        //         {

        //              $remaining+= $key->fee ;

        //         }
        //     }




        $data= Parents::all();
        $output = '';
        foreach ($data as $list) {
            $output .=  "<tr>
            <td>".$list->parent_id."</td>
            <td>".$list->parent_name."</td>
            <td>".$list->phone ." </td>
            <td>".$list->cnic ." </td>
            <td><span class=\"badge badge-pill  ";
            if ($list->status == "Active") {
                $output .= "badge-success";
            } else {
                $output .= "badge-danger";
            }
            // $output .= ($list->status == "Active") ?  "badge-success" : "badge-danger";
            $output .= " \" > ".$list->status ." </span></td>";


            $remaining=0;
            $month=date('m');
            $Remain=DB::table('fees')
                ->where('parent_id', $list->parent_id)
                ->where('month', '<=', $month)
                ->get();
            foreach ($Remain as $key) {
                if (($key->fee_status=="pending")) {
                    $remaining+= $key->fee ;
                }
            }


            $output .= "<td>".$remaining."</td>
            <td id=\"".$list->parent_id."\" class=\"btn btn-primary mt-2 editIcon update\" data-toggle=\"modal\" data-target=\"#myModal\">Update</td>
            <td> <a  target=\"_blank\" href=\"/voucher/".$list->parent_id."\"><button class=\" btn btn-danger mt-2 \">Vouchers</button></a></td>
            <td><button type=\"button\" id=\"".$list->parent_id."  \" class=\"btn btn-info months_fee\" data-toggle=\"modal\" data-target=\"#pay\">Fee Pay</button></td>
        </tr>";
        }
        echo $output;
    }

    public function fetchall_months_fee(Request $request)
    {
        $month=date('m');
        $parent_id= $request->input('parent_id');
        $FeeMonthsData=Fee::where('parent_id', $parent_id)
        ->where('fee_status', "pending")
        ->where('month', '<=', $month)
        ->select('month')->distinct()
        ->get();
        $fee_status="<option value=\"\">Select Months to pay</option>";
        foreach ($FeeMonthsData as $lists) {
            $fee_status.="<option value=\"".  $lists->month . "\">".$lists->month."</option>";
        }
        $firstMonth=Fee::where('parent_id', $parent_id)
        ->where('fee_status', "pending")
        ->where('month', '<=', $month)
        ->select('month')->distinct()
        ->first();


        return [$fee_status,$parent_id,$firstMonth];
    }

    public function collect_fees(Request $request)
    {
        $parent_id= $request->input('parent_id');
        $month= $request->input('month_fee');

        $year=date('Y');

        $remaining=0;
        $Remain=DB::table('fees')->where('year', $year)
        ->where('parent_id', $parent_id)
        ->where('fee_status', "pending")
        ->where('month', '<=', (int)$month)->get();
        foreach ($Remain as $key ) {
            if (($key->fee_status=="pending")) {
                $remaining+= $key->fee ;
            }
        }

        //  DB::table('fees')->where('year', $year)
        // ->where('parent_id', $parent_id)
        // ->where('fee_status', "pending")
        // ->where('month', '<=', (int)$month)
        // ->update([
        // 'fee_status'=>"Paid"
        // ]);

        return response()->json([
        'status' => 200, 'month' => $month,'parent_id' => $parent_id,'remaining'=> $remaining
        ]);

    }

    function collected_fee_voucnher(Request $request,$id)
    {

        $month=$request->input('month');
        $month=  (int)$month;
        $firstPendingMonth=$request->input('firstpendingmonth');
        $howMuchmonth=$month - $firstPendingMonth+1;
        $student = DB::table('students')
        ->join('roll', 'roll.roll_id', '=', 'students.roll_id')
        ->join('classes', 'classes.class_id', '=', 'students.class_id')
        ->join('sections', 'sections.section_id', '=', 'students.section_id')
        ->select('students.*', 'roll.roll_no', 'classes.class_name', 'sections.section_name')
        ->where('students.parent_id', $id)
        ->where('students.Status', "Active")

        ->get();

        // $remaining=0;
        // $Remain=DB::table('fees')
        //     ->where('parent_id', $id)
        //     ->where('month', '<=', $month)
        //     ->get();
        // foreach ($Remain as $key) {
        //     if (($key->fee_status=="pending")) {
        //         $remaining+= $key->fee ;
        //     }
        // }

        $remaining=$request->input('remaining');

        //firstpendingmonth
        $parent = Parents::where('parent_id', $id)
        ->get();
        $monthName=date('F', mktime(0, 0, 0, $month, 10));
        $pdf = PDF::loadview('fee-collected-invoice', ['parent'=>$parent,'student'=>$student,'remaining_fee'=>$remaining,'monthName'=>$monthName,'howMuchmonth'=>$howMuchmonth])->setPaper('a4', 'potrait');
        return $pdf->stream('Voucher.pdf');
    }

}
