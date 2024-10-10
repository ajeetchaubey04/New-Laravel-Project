<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>  {{ @$page_title ?? 'Pdf Data' }} </title>
    <style>
        :root {
            --border-strong: 3px solid #777;
            --border-normal: 1px solid gray;
        }

        body {
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        table>caption {
            font-size: 6mm;
            font-weight: bolder;
            letter-spacing: 1mm;
        }


        /* 210 x 297 mm */

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 1mm;
            border: var(--border-normal);
            position: relative;
            font-size: 2.1mm;
            font-weight: bold;
        }

        tbody tr:nth-child(odd) {
            background: #eee;
        }

        tbody tr:last-child {
            border-bottom: var(--border-strong);
        }

        tbody tr> :last-child {
            border-right: var(--border-strong);
        }


        /* top header */

        .top_head>th {
            width: 54mm;
            height: 10mm;
            vertical-align: bottom;
            border-top: var(--border-strong);
            border-bottom: var(--border-strong);
            border-right: 1px solid gray;
        }

        .top_head :first-child {
            width: 27mm;
            border: var(--border-strong);
        }

        .top_head :last-child {
            border-right: var(--border-strong);
        }


        /* left header */

        tbody th {
            border-left: var(--border-strong);
            border-right: var(--border-strong);
            border-bottom: 1px solid gray;
        }

        tbody>tr:last-child th {
            border-bottom: var(--border-strong);
        }


        /* row */

        tbody td>div {
            height: 34mm;
            overflow: hidden;
        }

        .vertical_span_all {
            font-size: 5mm;
            font-weight: bolder;
            text-align: center;
            border-bottom: var(--border-strong);
        }

        .vertical_span_all div {
            height: 10mm;
        }


        /* td contents */

        .left {
            width: 95%;
            position: absolute;
            top: 1mm;
            left: 1mm;
        }

        .left>div {
            width: 100%;
            margin-bottom: 3mm;
            border-bottom: 1px dashed;
        }

        .right {
            position: absolute;
            left: 1mm;
            bottom: 1mm;
        }

        .teacher {
            position: absolute;
            right: 1mm;
            bottom: 1mm;
        }

        .note {
            font-size: 3mm;
        }

        .note :last-child {
            float: right;
        }

        @page {
            margin: 5mm;
        }
    </style>
    {{-- @include('layouts.css') --}}

</head>

<body>
    <main id="main">
        @yield('content')
    </main>
</body>
{{-- @include('layouts.js') --}}

</html>
