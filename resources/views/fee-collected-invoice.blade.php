<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .split {
            width: 45%;
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
                                <td class="" colspan="4">
                                    {{ $lists->parent_id . date('m') . date('Y') }}
                                </td>
                                <td class="" colspan="3">Phone:</td>
                                <td class="" colspan="4"> {{ $lists->phone }} </td>
                            </tr>
                            <tr>
                                <td class="" colspan="5">Fee till month:</td>
                                <td class="" colspan="7">{{ $monthName . '-' . date('Y') }}</td>
                            </tr>
                            <tr>
                                <td class="" colspan="4">Parent Name:</td>
                                <td class="" colspan="8">{{ $lists->parent_name }}</td>
                            </tr>


                            <tr>
                                <td class="" colspan="4">Student Name:</td>
                                <td class="c" colspan="5">Roll-Class:</td>
                                <td class="" colspan="3">Fees:</td>
                            </tr>

                            {{-- foreach loop for students start here --}}
                            @foreach ($student as $stdlists)
                                <tr>
                                    <td colspan="4">{{ $stdlists->student_name }}</td>
                                    <td class="c" colspan="5">
                                        {{ $stdlists->roll_no }} -
                                        {{ $stdlists->class_name }}({{ $stdlists->section_name }})
                                    </td>
                                    <td id="cal_fees" colspan="3">{{ $stdlists->tuition_fee }}
                                        <sub>x{{ $howMuchmonth }}</sub>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- foreach loop for students start end --}}



                            <tr>
                                <td class="r" colspan="9">Recived Fee</td>
                                <td class="" colspan="3">
                                    {{ $remaining_fee }}
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
                                <td class="" colspan="5">Fee till month:</td>
                                <td class="" colspan="7">{{ $monthName . '-' . date('Y') }}</td>
                            </tr>
                            <tr>
                                <td class="" colspan="4">Parent Name:</td>
                                <td class="" colspan="8">{{ $lists->parent_name }}</td>
                            </tr>

                            <tr>
                                <td class="" colspan="4">Student Name:</td>
                                <td class="c" colspan="5">Roll-Class:</td>
                                <td class="" colspan="3">Fees:</td>
                            </tr>

                            {{-- foreach loop for students start here --}}
                            @foreach ($student as $stdlists)
                                <tr>
                                    <td colspan="4">{{ $stdlists->student_name }}</td>
                                    <td class="c" colspan="5">
                                        {{ $stdlists->roll_no }} -
                                        {{ $stdlists->class_name }}({{ $stdlists->section_name }})
                                    </td>
                                    <td id="cal_fees" colspan="3">{{ $stdlists->tuition_fee }}
                                        <sub>x{{ $howMuchmonth }}</sub>
                                    </td>
                                </tr>
                            @endforeach
                            {{-- foreach loop for students start end --}}


                            <tr>
                                <td class="r" colspan="9">Recived Fee</td>
                                <td class="" colspan="3">
                                    {{ $remaining_fee }}
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
