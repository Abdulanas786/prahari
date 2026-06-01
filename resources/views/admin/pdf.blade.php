<!DOCTYPE html>
<html>
<head>
    <title>Reports PDF</title>

    <style>
        body{
            font-family: sans-serif;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid #000;
        }

        th, td{
            padding:10px;
        }
    </style>
</head>
<body>

<h2>Prahari Reports</h2>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Prahari</th>
            <th>Cases</th>
            <th>Challans</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>

        @foreach($praharis as $key => $prahari)

        <tr>
            <td>{{ $key + 1 }}</td>

            <td>{{ $prahari->Prahari }}</td>

            <td>{{ $prahari->cases_count }}</td>

            <td>{{ $prahari->challans_count }}</td>

            <td>{{ $prahari->status }}</td>
        </tr>

        @endforeach

    </tbody>
</table>

</body>
</html>