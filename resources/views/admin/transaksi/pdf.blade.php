<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjemputan Joindry {{ date('d M, Y') }}</title>
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
    <h1>Riwayat Transaksi Laundry</h1>
    <table cellspacing="0" cellpadding="3" style="margin-bottom: 1.5em;">
        <tr>
            <td>Outlet</td>
            <td>:</td>
            <td>{{ $outlet->nama }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ $dateStart . ' s.d' . $dateEnd }}</td>
        </tr>
    </table>
    <table class="main-table" cellspacing="0" cellpadding="5" style="font-size: 0.8em; border: 1px solid #a5a5a5">
        <thead>
            <tr>
                <th>No.</th>
                <th>Kode Invoice</th>
                <th>Jml. Layanan</th>
                <th>Tgl. Pemberian</th>
                <th>Est. Selesai</th>
                <th>Status Cucian</th>
                <th>Status Pembayaran</th>
                <th>Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($transaksi as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->kode_invoice }}</td>
                    <td>{{ $transaksi->detailtransaksi()->count() }}</td>
                    <td>{{ $transaksi->tgl }}</td>
                    <td>{{ $transaksi->deadline }}</td>
                    <td>
                        @switch($transaksi->status)
                            @case('baru')
                                Baru
                            @break

                            @case('proses')
                                Diproses
                            @break

                            @case('selesai')
                                Selesai
                            @break

                            @default
                                Diambil
                        @endswitch
                    </td>
                    <td>
                        @switch($transaksi->dibayar)
                            @case('dibayar')
                                Dibayar
                            @break

                            @default
                                Belum Dibayar
                        @endswitch
                    </td>
                    <td>{{ 'Rp' . number_format($transaksi->getTotalPembayaran()) }}</td>
                </tr>
                @php
                    $total += $transaksi->getTotalPembayaran();
                @endphp
            @endforeach
            <tr>
                <td colspan="7">Total Pendapatan</td>
                <td>{{ 'Rp' . number_format($total) }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>