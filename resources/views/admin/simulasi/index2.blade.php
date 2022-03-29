@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')

<div class="container">
    <h3>
        Simulasi Data Buku
    </h3>
    <div class="card">
        <div class="card-header">
            Form Data Buku
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="" name="form-buku" id="form-buku">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="id">Id</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="number" name="id" id="id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                               <label for="judul">Judul Buku</label> 
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="judul" id="judul">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="pengarang">Pengarang</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="pengarang" id="pengarang">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                              <label for="tahun_terbit">Tahun Terbit</label>  
                            </div>
                            <div class="col-md-9">
                                <select name="tahun_penerbit" id="tahun_penerbit" class="form-control">
                                    @for ($i = 1800; $i <= (int) date('Y'); $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="judul">Harga Buku</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="number" name="harga" id="harga">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label for="qty">Kuantitas</label>
                            </div>
                            <div class="col-md-9">
                                <input class="form-control" type="number" name="qty" id="qty">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header">
            Data Buku
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label for="">Urutkan Berdasarkan :</label>
                   </div>
                   <div class="col-md-3">
                   <div class="form-group">
                       <select name="jenis" id="sort-by" class="form-control">
                           <option value="id">ID</option>
                           <option value="judul">Judul Buku</option>
                           <option value="pengarang">Pengarang</option>
                           <option value="tahun_penerbit">Tahun Terbit</option>
                           <option value="harga">Harga Buku</option>
                           <option value="qty">Kuantitas</option>
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
                       <div class="col-md-3">
                        <div class="form-group row align-items-center">
                            <div class="col-3 text-right">
                                <label for="filter">Filter</label>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control" id="filter" placeholder="Cari...">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table" id="tableBuku">
                    <thead>
                        <th>ID</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Tahun Terbit</th>
                        <th>Harga Buku</th>
                        <th>Kuantitas</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        function insert(){
        const data = $('#form-buku').serializeArray()
        let newData = {}
        data.forEach(function(item,index){
            let name = item['name']
            let value = ( name === 'id' ||
                          name === 'qty' ||
                          name === 'harga' ||
                          name === 'tahun_penerbit' ? Number(item['value']):item['value'])
            newData[name] = value
        })
        dataBuku.push(newData)
        localStorage.setItem('dataBuku', JSON.stringify(dataBuku))
        console.log(newData)

        return newData;

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

        const filterBuku = (keyword) => {

            let arr = [];
            
            keyword = keyword.toLowerCase();
            for (let i = 0; i < dataBuku.length; i++) {
               
                if (dataBuku[i].id.toString().toLowerCase().includes(keyword) ||
                    dataBuku[i].judul.toLowerCase().includes(keyword) ||
                    dataBuku[i].pengarang.toLowerCase().includes(keyword) ||
                    dataBuku[i].tahun_penerbit.toString().toLowerCase().includes(keyword) ||
                    dataBuku[i].harga.toString().toLowerCase().includes(keyword) ||
                    dataBuku[i].qty.toString().toLowerCase().includes(keyword)
                ) {
                    
                    arr.push(dataBuku[i]);
                }
            }
            filteredBuku = arr;
        }

        const renderBuku = () => {
            let rows;
            filteredBuku.forEach(item=>{
                rows += `<tr>
                <td>${item.id}</td>
                <td>${item.judul}</td>
                <td>${item.pengarang}</td>
                <td>${item.tahun_penerbit}</td>
                <td>${item.harga}</td>
                <td>${item.qty}</td>
                <tr>`;
            });
            console.log(rows);
            $('#tableBuku tbody').html(rows);
        }       
        let dataBuku
        $(function(){
            dataBuku = JSON.parse(localStorage.getItem('dataBuku')) || []
            console.log(dataBuku)
            renderBuku();
        });

        $('#sort-direction').on('change', function(e) {
            selectionSort(dataBuku, $('#sort-by').val(), $(this).val());
            renderBuku();
            console.log($(this).val())
        });

        $('#filter').on('change keydown', function() {
                setTimeout(() => {
                    filterBuku($(this).val());
                    renderBuku();
                });
            })

        $('#sort-by').on('change', function(e) {
            selectionSort(dataBuku, $(this).val(), $('#sort-direction').val());
            renderBuku();
        });

        $('#form-buku').on('submit', function(e){
            e.preventDefault()
            insert()
            renderBuku();
        })
    </script>
@endpush



@include('admin.layout.copyright')
@include('admin.layout.footer')