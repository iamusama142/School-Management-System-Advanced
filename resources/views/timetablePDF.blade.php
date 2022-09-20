<?php
$count = 1;
?>


<!DOCTYPE html>
<html>

<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        .split {
            width: 100%;
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


        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        td {
            text-align: center;
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


        .dark {
            background-color: rgb(184, 182, 182);
        }

        .b {
            font-weight: bold;
        }

        .small-td {
            width: 4px;
        }

        .padding {
            padding-left: 25%;
        }

        .container {
            margin-top: 40px;
        }

    </style>

</head>

<body>





    <div class="container">
        <div class="split left">
            <div class="centered">
                <div class="container col-sm-6">
                    <h1 class="c b">The Study Circle School</h1>
                    <h2 class="c b">{{ $data[0]->title }}</h2>
                    <div class="b padding"> Class: {{ $data[0]->class_name }}
                    </div>
                    <div class="container">

                        <table style="width:100%" cellspacing="2" cellpadding="5">
                            <thead>
                                <tr class="dark b">
                                    <td class="small-td">#Lec</td>
                                    <td>Monday</td>
                                    <td>Tuesday</td>
                                    <td>Wednesday</td>
                                    <td>Thursday </td>
                                    <td>Friday</td>
                                    <td>Saturday</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $list)
                                    <tr>
                                        <td class="small-td">{{ $count }}</td>
                                        <td>{{ $list->subject_name }}</td>
                                        <td>{{ $list->subject_name }}</td>
                                        <td>{{ $list->subject_name }}</td>
                                        <td>{{ $list->subject_name }}</td>
                                        <td>{{ $list->subject_name }}</td>
                                        <td>{{ $list->subject_name }}</td>
                                    </tr>
                                    <?php $count++; ?>
                                @endforeach



                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>




</body>

</html>
