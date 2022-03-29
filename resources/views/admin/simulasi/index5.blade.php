@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Simulasi Transaksi Cucian</h3>
        </div>
        <div class="card-body">
            <form action="#" id="form-cucian" name="form-cucian">
                <div class="row">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="id">No Transaksi</label>
                        </div>
                        <div class="col-md-3">
                            <input class="form-group" type="number" min="0" name="id" id="id">
                        </div>
                        <div class="col-md-3">
                            <label for="id">Nama Pelanggan</label>
                        </div>
                        <div class="col-md-3">
                            <input class="form-group" type="text" name="pelanggan" id="pelanggan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="id">No HP/WA</label>
                        </div>
                        <div class="col-md-3">
                            <input class="form-group" type="number" min="0" name="tlp" id="tlp">
                        </div>
                        <div class="col-md-3">
                            <label for="id">Tanggal Cuci</label>
                        </div>
                        <div class="col-md-3">
                            <input class="form-group" type="date" name="tanggal" id="tanggal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="jenis">Jenis Cucian</label>
                        </div>
                        <div class="col-md-3">
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="standar">Standar</option>
                                <option value="express">Express</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="id">Berat</label>
                        </div>
                        <div class="col-md-3">
                            <input class="form-group" type="number" min="0" name="berat" id="berat">/kg
                        </div>
                        <input type="hidden" name="harga" id="harga" value="7500" >
                        <input type="hidden" name="diskon" id="diskon" value="">
                        <input type="hidden" name="total" id="total" value="">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="card">
        <div class="card-header">Data</div>
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
                                <option value="pelanggan">Nama Pelanggan</option>
                                <option value="tlp">Kontak</option>
                                <option value="tanggal">Tanggal</option>
                                <option value="jenis">Jenis</option>
                                <option value="berat">Berat</option>
                                <option value="diskon">Diskon</option>
                                <option value="total">Total</option>
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
                <table class="table" id="tableCucian">
                    <thead>
                        <th>Id</th>
                        <th>Nama Pelanggan</th>
                        <th>Kontak</th>
                        <th>Tanggal Cucian</th>
                        <th>Jenis Cucian</th>
                        <th>Berat</th>
                        <th>Diskon</th>
                        <th>Total Harga</th>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <td colspan="5" align="center">
                            Total
                        </td>
                        <td id="totalBerat"></td>
                        <td id="totalDiskon"></td>
                        <td id="totalTotal"></td>
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
                const data = $('#form-cucian').serializeArray()
                let newData = {}
                
                data.forEach(function(item,index){
                let name = item['name']
                let value = ( name === 'id' ||
                            name === 'tlp' ||
                            name === 'harga' ||
                            name === 'berat' ||
                            name === 'diskon' ||
                            name === 'total' ? Number(item['value']):item['value'])
                newData[name] = value
            })
            diskon = totalDiskon(newData.berat * newData.harga);
            console.log(diskon)
            newData.diskon = diskon
            newData.total = newData.berat * newData.harga - diskon;
            dataCucian.push(newData)
            filteredCucian = dataCucian;
            localStorage.setItem('dataCucian', JSON.stringify(dataCucian))
            return newData;
            }

            function totalDiskon(diskon){
                if(diskon >= 50000){
                    d = (10/100) * diskon;
                    return d
                }else{
                    return 0
                }
            }

            $('[name="jenis"]').on('change',function(){
            if($(this).val() === 'standar'){
                $('[name="harga"]').val(7500);
            }else{
                $('[name="harga"]').val(10000);
                }
            })

            const filterCucian = (keyword) => {

            let arr = [];

            keyword = keyword.toLowerCase();
            for (let i = 0; i < dataCucian.length; i++) {

                if (dataCucian[i].id.toString().toLowerCase().includes(keyword) ||
                    dataCucian[i].pelanggan.toLowerCase().includes(keyword) ||
                    dataCucian[i].tlp.toString().toLowerCase().includes(keyword) ||
                    dataCucian[i].tanggal.includes(keyword) ||
                    dataCucian[i].jenis.toLowerCase().includes(keyword) ||
                    dataCucian[i].berat.toString().toLowerCase().includes(keyword) ||
                    dataCucian[i].diskon.toString().toLowerCase().includes(keyword) ||
                    dataCucian[i].total.toString().toLowerCase().includes(keyword)
                ) {
                    
                    arr.push(dataCucian[i]);
                }
            }
            filteredCucian = arr;
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


            const renderCucian = () => {
            let rows;
            let totalBerat = 0;
            let totalDiskon = 0;
            let totalTotal = 0;
            
            filteredCucian.forEach(item=>{
                rows += `<tr>
                <td>${item.id}</td>
                <td>${item.pelanggan}</td>
                <td>${item.tlp}</td>
                <td>${item.tanggal}</td>
                <td>${item.jenis}</td>
                <td>${item.berat}</td>
                <td>${formatter.format(item.diskon)}</td>
                <td>${formatter.format(item.total)}</td>
                <tr>`;
                    totalBerat += item.berat
                    totalDiskon += item.diskon
                    totalTotal += item.total
            });
            // console.log(rows);
            $('#tableCucian tbody').html(rows);
            $('#totalBerat').html(totalBerat);
            $('#totalDiskon').html(formatter.format(totalDiskon));
            $('#totalTotal').html(formatter.format(totalTotal));
        } 

            $(function(){
                    dataCucian = filteredCucian = JSON.parse(localStorage.getItem('dataCucian')) || []
                    renderCucian();
            });

            $('#sort-direction').on('change', function(e) {
            selectionSort(dataCucian, $('#sort-by').val(), $(this).val());
            renderCucian();
            });

            $('#sort-by').on('change', function(e) {
                selectionSort(dataCucian, $(this).val(), $('#sort-direction').val());
                renderCucian();
            });
            $('#filter').on('change keydown', function() {
                setTimeout(() => {
                    filterCucian($(this).val());
                    renderCucian();
                });
            })

            $('#form-cucian').on('submit', function(e){
                e.preventDefault()
                insert()
                renderCucian()
            });
        });
    </script>
@endpush



@include('admin.layout.copyright')
@include('admin.layout.footer')