@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')

@push('head')
    <meta name="datatable-url" content="{{ route('transaksi.laporanDatatable') }}">
    <meta name="export-excel-url" content="{{ route('transaksi.export.excel') }}">
    <meta name="export-pdf-url" content="{{ route('transaksi.export.pdf') }}">
@endpush


    <form action="#" id="report-form">
        @csrf
        <div class="card">
            <div class="card-body row">
                <div class="col-md-5">
                    <div class="form-group row">
                        <div class="col-sm-2 d-flex align-items-center justify-content-end">
                            <label for="date-start">Tgl Awal</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="date" value="{{ date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y'))) }}"
                                class="form-control" id="date-start">
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group row">
                        <div class="col-sm-2 d-flex align-items-center justify-content-end">
                            <label for="date-end">Tgl Akhir</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="date-end">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
                </div>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-header">
            <div class="dropdown d-inline">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-upload mr-1"></i>
                    <span>Export</span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item export-button" id="export-excel-button" href="#">XLSX</a>
                    <a class="dropdown-item export-button" id="export-pdf-button" href="#">PDF</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="transactions-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Invoice</th>
                        <th>Jumlah Cucian</th>
                        <th>Tgl. Pemberian</th>
                        <th>Est. Selesai</th>
                        <th>Status Cucian</th>
                        <th>Status Pembayaran</th>
                        <th>Total Biaya</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Transaction data goes here -->
                </tbody>
            </table>
        </div>
    </div>


@push('script')

    <script>
        const formatter = Intl.NumberFormat("id-ID",{
                    style: "currency",
                    currency: "IDR",
                })
        let table;
        $(function() {
            table = $("#transactions-table").DataTable({
                processing: true,
                columns: [{
                        data: "DT_RowIndex",
                    },
                    {
                        data: "kode_invoice",
                    },
                    {
                        data: "total_item",
                    },
                    {
                        data: "tgl",
                    },
                    {
                        data: "deadline",
                    },
                    {
                        data: "status",
                        render: (status) => {
                            let text;
                            switch (status) {
                                case "baru":
                                    text = "Baru";
                                    break;
                                case "proses":
                                    text = "Diproses";
                                    break;
                                case "selesai":
                                    text = "Selesai";
                                    break;
                                default:
                                    text = "Diambil";
                                    break;
                            }
                            return text;
                        },
                    },
                    {
                        data: "dibayar",
                        render: (status) => {
                            return status === 'dibayar' ? 'Dibayar' : 'Belum Dibayar';
                        },
                    },
                    {
                        data: "total_payment",
                        render: (total_payment) => formatter.format(total_payment)
                    },
                ],
            });
            $('#report-form').on('submit', async function() {
                let url = $('meta[name="datatable-url"]').attr('content');
                let dateStart = $('input#date-start').val();
                let dateEnd = $('input#date-end').val();
                table.ajax.url(`/admin/laporan/datatable?date_start=${dateStart}&date_end=${dateEnd}`).load();
                let exportExcelUrl = '/admin/laporan/export/excel';
                let exportPDFUrl = '/admin/laporan/export/pdf';
                $('#export-excel-button').attr('href',
                    `${exportExcelUrl}?date_start=${dateStart}&date_end=${dateEnd}`);
                $('#export-pdf-button').attr('href',
                    `${exportPDFUrl}?date_start=${dateStart}&date_end=${dateEnd}`);
            });
        })
    </script>
@endpush
@include('admin.layout.copyright')
@include('admin.layout.footer')