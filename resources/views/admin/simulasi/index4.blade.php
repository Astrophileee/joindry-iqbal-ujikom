@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<div class="container">
    <h3>Simulasi Transaksi Barang</h3>
    <div class="card">
        <div class="card-header">
            <h5>form</h5>
        </div>
        <div class="card-body">
            <form action="#" name="form-toko" id="form-toko">
            <div class="row">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="judul">Id Karyawan</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="number" name="id" id="id">
                    </div>
                    <div class="col-md-3">
                        <label for="tanggal_beli">Tanggal Beli</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="date" name="tanggal_beli" id="tanggal_beli">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="barang">Nama Barang</label>
                    </div>
                    <div class="col-md-3">
                        <select name="barang" id="barang" class="form-control">
                            <option value="detergent">Detergent</option>
                            <option value="pewangi">Pewangi</option>
                            <option value="sepatu">Detergent Sepatu</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="harga">Harga Barang</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" name="harga" id="harga" value="15000" readonly>
                    </div>
                </div>
                    
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="judul">Jumlah</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="number" name="jumlah" id="jumlah" value="">
                    </div>
                    <div class="col-md-3">
                        <label for="judul">Jenis Pembayaran</label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="pembayaran" id="flexRadioDefault1" value="cash">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Cash
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="pembayaran" id="flexRadioDefault2" value="e-money">
                            <label class="form-check-label" for="flexRadioDefault2">
                                E-money/Transfer
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="total" id="total">
                <input type="hidden" name="diskon" id="diskon" value="0">
                <div class="form-group row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Data</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="">Urutkan Berdasarkan :</label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="jenis" id="sort-by" class="form-control">
                                <option value="id">ID</option>
                                <option value="tanggal_beli">Tanggal</option>
                                <option value="barang">Barang</option>
                                <option value="harga">Harga</option>
                                <option value="jumlah">QTY</option>
                                <option value="diskon">Diskon</option>
                                <option value="total">Total</option>
                                <option value="pembayaran">Pembayaran</option>
                            </select>
                        </div>   
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="jenis" id="sort-direction" class="form-control">
                                <option value="ASCENDING">ASCENDING</option>
                                <option value="DESCENDING">DESCENDING</option>
                            </select>
                        </div>   
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group row align-items-center">
                        <div class="col-3 text-right">
                            <label for="filter">Filter:</label>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control" id="filter" placeholder="Cari...">
                        </div>
                    </div>
                </div>
                <table class="table" id="tableToko">
                    <thead>
                        <th>id</th>
                        <th>Tanggal Beli</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Diskon</th>
                        <th>Total Harga</th>
                        <th>Jenis Pembayaran</th>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <td colspan="3">
                            Total
                        </td>
                        <td id="totalHarga"></td>
                        <td id="totalJumlah"></td>
                        <td id="totalDiskon"></td>
                        <td colspan="2" id="totalTotal"></td>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@push('script')
    <script>
        const formatter = Intl.NumberFormat("id-ID",{
            style: "currency",
            currency: "IDR",
        })
        $(document).ready(function(){
            function insert(){
                const data = $('#form-toko').serializeArray()
                let newData = {}
                
                data.forEach(function(item,index){
                let name = item['name']
                let value = ( name === 'id' ||
                            name === 'jumlah' ||
                            name === 'harga' ||
                            name === 'diskon' ||
                            name === 'total' ? Number(item['value']):item['value'])
                newData[name] = value
            })
            diskon = totalDiskon(newData.jumlah * newData.harga);
            console.log(diskon)
            newData.diskon = diskon
            newData.total = newData.jumlah * newData.harga - diskon;
            dataToko.push(newData)
            filteredToko = dataToko;
            localStorage.setItem('dataToko', JSON.stringify(dataToko))
            return newData;
            }

            function totalDiskon(diskon){
                if(diskon => 50000){
                    d = (15/100) * diskon;
                    return d
                }else{
                    td = diskon
                    return td
                }
            }

            const filterToko = (keyword) => {

            let arr = [];

            keyword = keyword.toLowerCase();
            for (let i = 0; i < dataToko.length; i++) {

                if (dataToko[i].id.toString().toLowerCase().includes(keyword) ||
                    dataToko[i].barang.toLowerCase().includes(keyword) ||
                    dataToko[i].jumlah.toString().toLowerCase().includes(keyword) ||
                    dataToko[i].harga.toString().toLowerCase().includes(keyword) ||
                    dataToko[i].diskon.toString().toString().includes(keyword) ||
                    dataToko[i].tanggal_beli.includes(keyword) ||
                    dataToko[i].total.toString().toLowerCase().includes(keyword) ||
                    dataToko[i].pembayaran.toLowerCase().includes(keyword)
                ) {
                    
                    arr.push(dataToko[i]);
                }
            }
            filteredToko = arr;
            }
            
            const swap = (arr, curr, min) => {
            let temp = arr[curr];
            arr[curr] = arr[min];
            arr[min] = temp;
            }

            const selectionSort = (arr, sortBy, sortDirection) => {
            let n = arr.length;
            for (let i = 0; i < n; i++) {
                let minIndex = i;
                for (let j = i + 1; j < n; j++) {
                    if (sortDirection === 'ASCENDING' && arr[minIndex][sortBy] > arr[j][sortBy]) {
                        minIndex = j;
                    }
                    if (sortDirection === 'DESCENDING' && arr[minIndex][sortBy] < arr[j][sortBy]) {
                        minIndex = j;
                    }
                }
                if (minIndex != i) {
                    swap(arr, i, minIndex);
                }
            }
        }
            const renderToko = () => {
            let rows;
            let totalJumlah = 0;
            let totalDiskon = 0;
            let totalHarga = 0;
            let totalTotal = 0;
            
            filteredToko.forEach(item=>{
                rows += `<tr>
                <td>${item.id}</td>
                <td>${item.tanggal_beli}</td>
                <td>${item.barang}</td>
                <td>${formatter.format(item.harga)}</td>
                <td>${item.jumlah}</td>
                <td>${formatter.format(item.diskon)}</td>
                <td>${formatter.format(item.total)}</td>
                <td>${item.pembayaran}</td>
                <tr>`;
                    totalJumlah += item.jumlah
                    totalDiskon += item.diskon
                    totalHarga += item.harga
                    totalTotal += item.total
            });
            // console.log(rows);
            $('#tableToko tbody').html(rows);
            $('#totalJumlah').html(totalJumlah);
            $('#totalDiskon').html(formatter.format(totalDiskon));
            $('#totalHarga').html(formatter.format(totalHarga));
            $('#totalTotal').html(formatter.format(totalTotal));
        } 


            $(function(){
                dataToko = filteredToko = JSON.parse(localStorage.getItem('dataToko')) || []
                renderToko();
            });

            
            $('[name="barang"]').on('change',function(){
            if($(this).val() === 'detergent'){
                $('[name="harga"]').val(15000);
            }else if($(this).val() === 'pewangi'){ 
                    $('[name="harga"]').val(10000); 
                }else{
                    $('[name="harga"]').val(25000);
                }
            })

        $('#sort-direction').on('change', function(e) {
            selectionSort(dataToko, $('#sort-by').val(), $(this).val());
            renderToko();
        });
        $('#sort-by').on('change', function(e) {
            selectionSort(dataToko, $(this).val(), $('#sort-direction').val());
            renderToko();
        });
        $('#filter').on('change keydown', function() {
                setTimeout(() => {
                    filterToko($(this).val());
                    renderToko();
                });
        })
            $('#form-toko').on('submit', function(e){
                e.preventDefault()
                insert()
                renderToko()
            });
        });
    </script>
@endpush
@include('admin.layout.copyright')
@include('admin.layout.footer')