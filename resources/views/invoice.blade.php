<?php
$tuition_var = 0;
$late_var = 0;
$remaining_var = 0;

?>



<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .split {
            width: 49%;
            position: fixed;

        }


        .left {
            left: 0;
            background-color: white;
        }

        .right {
            right: 0;
            background-color: white;
        }

        /* style for incoive */
        * {
            font-weight: 600;
            font-size: 16px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td {
            width: 35px;
        }

        .c {
            text-align: center;
        }

        .r {
            text-align: right;
        }

        .container+.container {
            margin-top: 500px;
        }

        h2 {
            padding-top: 10px;
        }

    </style>
</head>

<body>




    @foreach ($parent as $lists)
        <div class="container">
            <div class="split left">
                <div class="centered">
                    <div class="container col-sm-6">
                        <h1 class="c h">The Study Circle School</h1>
                        <p class="c">Address: Airport Road, Rahim yar
                            khan
                        </p>
                        <p class="c">Phone: 03030336939</p>

                        <table style="width:100%" cellspacing="2" cellpadding="5">
                            <tr>
                                <td class="" colspan="1">VN:</td>
                                <td class="" colspan="4">{{ $lists->parent_id . date('m') . date('Y') }}
                                </td>
                                <td class="" colspan="3">Phone:</td>
                                <td class="" colspan="4"> {{ $lists->phone }} </td>
                            </tr>
                            <tr>
                                <td class="" colspan="3">Fee Month:</td>
                                <td class="" colspan="9">{{ date('M-Y') }}</td>
                            </tr>
                            <tr>
                                <td class="" colspan="4">Parent Name:</td>
                                <td class="" colspan="8">{{ $lists->parent_name }}</td>
                            </tr>

                            <tr>
                                <td class="" colspan="4">Student Name:</td>
                                <td class="" colspan="6">Rollno - Class:</td>
                                <td class="" colspan="2">Fees:</td>
                            </tr>

                            {{-- foreach loop for students start here --}}
                            @foreach ($student as $stdlists)
                                <tr>
                                    <td colspan="4">{{ $stdlists->student_name }}</td>
                                    <td colspan="6">{{ $stdlists->roll_no }}
                                        -{{ $stdlists->class_name }}({{ $stdlists->section_name }})</td>

                                    <td id="cal_fees" colspan="2"> {{ $stdlists->tuition_fee }} </td>
                                </tr>
                                <?php
                                $tuition_var += $stdlists->tuition_fee;
                                $late_var += $stdlists->fine;

                                ?>
                            @endforeach
                            {{-- foreach loop for students start end --}}

                            <tr>
                                <td class="c" colspan="6">Description</td>

                                <td class="c" colspan="6">Amount</td>
                            </tr>
                            <tr>
                                <td class="" colspan="6">Tuition Fee</td>
                                <td class="c" colspan="6"> {{ $tuition_var }} </td>

                            </tr>
                            <tr>
                                <td class="" colspan="6">Late Fee</td>
                                <td class="c" colspan="6">0</td>

                            </tr>
                            <tr>
                                <td class="" colspan="6">Remaining Fee</td>
                                <td class="c" colspan="6">{{ $remaining_fee }}</td>

                            </tr>

                            <tr>
                                <td class="r" colspan="9">Total Fee</td>
                                <td class="" colspan="3">
                                    {{ $tuition_var + $late_var + $remaining_var + $remaining_fee }}
                                </td>
                            </tr>


                        </table>
                    </div>
                </div>


            </div>
            <div class="split right">
                <div class="centered">
                    <div class="container col-sm-6">
                        <h1 class="c h">The Study Circle School</h1>
                        <p class="c">Address: Airport Road, Rahim yar
                            khan
                        </p>
                        <p class="c">Phone: 03030336939</p>

                        <table style="width:100%" cellspacing="2" cellpadding="5">
                            <tr>
                                <td class="" colspan="1">VN:</td>
                                <td class="" colspan="4">
                                    {{ $lists->parent_id . date('m') . date('Y') }}
                                </td>
                                <td class="" colspan="3">Phone:</td>
                                <td class="" colspan="4"> {{ $lists->phone }} </td>
                            </tr>
                            <tr>
                                <td class="" colspan="3">Fee Month:</td>
                                <td class="" colspan="9">{{ date('M-Y') }}</td>
                            </tr>
                            <tr>
                                <td class="" colspan="4">Parent Name:</td>
                                <td class="" colspan="8">{{ $lists->parent_name }}</td>
                            </tr>

                            <tr>
                                <td class="" colspan="4">Student Name:</td>
                                <td class="" colspan="6">Rollno - Class:</td>
                                <td class="" colspan="2">Fees:</td>
                            </tr>

                            {{-- foreach loop for students start here --}}
                            @foreach ($student as $stdlists)
                                <tr>
                                    <td colspan="4">{{ $stdlists->student_name }}</td>
                                    <td colspan="6">{{ $stdlists->roll_no }}
                                        -{{ $stdlists->class_name }}({{ $stdlists->section_name }})</td>

                                    <td id="cal_fees" colspan="2"> {{ $stdlists->tuition_fee }} </td>
                                </tr>
                            @endforeach
                            {{-- foreach loop for students start end --}}

                            <tr>
                                <td class="c" colspan="6">Description</td>

                                <td class="c" colspan="6">Amount</td>
                            </tr>
                            <tr>
                                <td class="" colspan="6">Tuition Fee</td>
                                <td class="c" colspan="6"> {{ $tuition_var }} </td>

                            </tr>
                            <tr>
                                <td class="" colspan="6">Late Fee</td>
                                <td class="c" colspan="6">0</td>

                            </tr>
                            <tr>
                                <td class="" colspan="6">Remaining Fee</td>
                                <td class="c" colspan="6">{{ $remaining_fee }}</td>

                            </tr>

                            <tr>
                                <td class="r" colspan="9">Total Fee</td>
                                <td class="" colspan="3">
                                    {{ $tuition_var + $late_var + $remaining_var + $remaining_fee }}
                                </td>
                            </tr>


                        </table>
                    </div>
                </div>


            </div>
        </div>
    @endforeach


</body>

</html>
