@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="" id="add-karyawan-form">
                   <div class="form-group">
                        <label for="id">Id</label>
                        <input class="form-control" type="number" name="id" id="id">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" type="text" name="nama" id="nama">
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="Laki-Laki">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Laki Laki
                            </label>
                            </div>
                            <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="Perempuan">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Perempuan
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form> 
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="card">
        <div class="card-header">
            Data Karyawan
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
                        <option value="nama">Nama</option>
                        <option value="gender">Jenis Kelamin</option>
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
                <table class="table" id="tableKaryawan">
                    <thead>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Gender</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        let Karyawan = [{
            'id' : 1,
            'nama' : 'Iqbal Maulana Asyari',
            'gender' : 'Laki-Laki'
        }];

        $(function(){
            renderKaryawan();
        });

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

        const renderKaryawan = () => {
            let rows;
            Karyawan.forEach(item=>{
                rows += `<tr>
                <td>${item.id}</td>
                <td>${item.nama}</td>
                <td>${item.gender}</td>
                <tr>`;
            });
            console.log(rows);
            $('#tableKaryawan tbody').html(rows);
        }

        const addKaryawan = (data) => {
            Karyawan.push(data);
            renderKaryawan();
        }

        $('#sort-direction').on('change', function(e) {
            selectionSort(Karyawan, $('#sort-by').val(), $(this).val());
            renderKaryawan();
            console.log($(this).val())
        });

        $('#sort-by').on('change', function(e) {
            selectionSort(Karyawan, $(this).val(), $('#sort-direction').val());
            renderKaryawan();
        });

        $('#add-karyawan-form').on('submit',function(){
            event.preventDefault();
            let data = {};
            $(this).serializeArray().map((item)=>data[item.name] = item.name =='id' ? parseInt(item.value) : item.value);
            addKaryawan(data);
        });
    </script>
@endpush

@include('admin.layout.copyright')
@include('admin.layout.footer')