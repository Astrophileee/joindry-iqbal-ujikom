<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penggunaan Barang Cleandry {{ date('d M, Y') }}</title>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif
        }
        .main-table {
            width: 100%;
        }
        .main-table th,
        .main-table td {
            border: 1px solid #727272;
        }
    </style>
</head>

<body>
    <h1>Data Penggunaan Barang Joindry</h1>
    <table cellspacing="0" cellpadding="5" style="margin-bottom: 1.5em;">
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ date('d-m-Y') }}</td>
        </tr>
    </table>
    <table class="main-table" cellspacing="0" cellpadding="1" style="font-size: 0.8em; border: 1px solid #a5a5a5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Barang</th>
                <th>Waktu Pakai</th>
                <th>Status</th>
                <th>Nama Pemakai</th>
                <th>Waktu Waktu Beres</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->waktu_pakai }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->nama_pemakai}}</td>
                    <td>{{ $p->update_status}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>