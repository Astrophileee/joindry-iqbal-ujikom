@include('admin.layout.header')
@include('admin.layout.navbar')
@include('admin.layout.sidebar')
<div class="container">
    <div class="card">
        <div class="card-header">Karyawan</div>
        <div class="card-body">
            <form action="#" name="form-karyawan" id="form-karyawan">
            <div class="row">
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="judul">Id Karyawan</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="number" name="id" id="id">
                    </div>
                    <div class="col-md-3">
                        <label for="judul">Nama Karyawan</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="text" name="nama" id="nama">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="judul">Jenis Kelamin</label>
                    </div>
                    <div class="col-md-3">
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
                    <div class="col-md-3">
                        <label for="status">Status Menikah</label>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="status" id="status" class="form-control">
                                <option value="single">Single</option>
                                <option value="couple">Couple</option>
                            </select>
                        </div>  
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <label for="judul">Jumlah Anak</label>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control" type="number" name="anak" id="anak" value="0" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="bekerja">Mulai Bekerja</label>
                    <div class="col-md-10">
                        <input type="date" class="form-control" id="bekerja" name="bekerja" value="">
                    </div>
                    </div>  
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <input type="hidden" name="gaji" id="gaji" value="2000000">
                <input type="hidden" name="tunjangan" id="tunjangan" value="">
                <input type="hidden" name="total" id="total" value="">
            </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Data karyawan</div>
        <div class="card-body">
            <div class="col-md-3">
                <label for="">Urutkan Berdasarkan :</label>
               </div>
               <div class="col-md-3">
               <div class="form-group">
                   <select name="jenis" id="sort-by" class="form-control">
                       <option value="id">ID</option>
                       <option value="nama">nama</option>
                       <option value="gender">Jenis Kelamin</option>
                       <option value="status">Status Nikah</option>
                       <option value="anak">Jumlah Anak</option>
                       <option value="bekerja">Mulai Bekerja</option>
                       <option value="gaji">Gaji Awal</option>
                       <option value="tunjangan">Tunjangan</option>
                       <option value="total">total</option>
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
            <table class="table" id="tableKaryawan">
                <thead>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Gender</th>
                    <th>Status</th>
                    <th>Jml Anak</th>
                    <th>Mulai Bekerja</th>
                    <th>Gaji Awal</th>
                    <th>Tunjangan</th>
                    <th>Total Gaji</th>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                    <td colspan="6">TOTAL</td>
                    <td id="totalAwal"></td>
                    <td id="totalTunjangan"></td>
                    <td id="totalTotal"></td>
                </tfoot>
            </table>
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
            ta = tunjanganAnak($('#anak').val());
            ts = tunjanganStatus($('#status').val());
            tmk = tunjanganMasaKerja(_calculateAge($('#bekerja').val()));
            tt = ta + ts + tmk;
            $('#tunjangan').val(tt);
            $('#total').val(tt + 2000000);
            const data = $('#form-karyawan').serializeArray()
            let newData = {}
            data.forEach(function(item,index){
            let name = item['name']
            let value = ( name === 'id' ||
                          name === 'anak' ||
                          name === 'gaji' ||
                          name === 'tunjangan' ||
                          name === 'total' ? Number(item['value']):item['value'])
            newData[name] = value
        })
        dataKaryawan.push(newData)
        filteredKaryawan = dataKaryawan;
        localStorage.setItem('dataKaryawan', JSON.stringify(dataKaryawan))
        return newData;
        }

        function _calculateAge(birthday){
            birthday = new Date(birthday)
            var ageDifMs = Date.now() - birthday.getTime();
            var ageDate = new Date(ageDifMs);
            return Math.abs(ageDate.getUTCFullYear() - 1970);
        }

        function tunjanganMasaKerja(lama){
            tunjanganB = lama * 150000
            return tunjanganB;
        }
        function tunjanganStatus(status){
             if(status === "couple"){ 
                 return 250000
                }else{
                    return 0
                }
        }
        function tunjanganAnak(anak){
             if(anak > 0) {
                if(anak >= 2){ 
                 return 300000
                }else{
                    return 150000
                }
             }
             return 0;
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

        const filterKaryawan = (keyword) => {

            let arr = [];

            keyword = keyword.toLowerCase();
            for (let i = 0; i < dataKaryawan.length; i++) {
            
                if (dataKaryawan[i].id.toString().toLowerCase().includes(keyword) ||
                    dataKaryawan[i].nama.toLowerCase().includes(keyword) ||
                    dataKaryawan[i].gender.toLowerCase().includes(keyword) ||
                    dataKaryawan[i].status.toLowerCase().includes(keyword) ||
                    dataKaryawan[i].anak.toString().includes(keyword) ||
                    dataKaryawan[i].bekerja.includes(keyword) ||
                    dataKaryawan[i].gaji.toString().toLowerCase().includes(keyword) ||
                    dataKaryawan[i].tunjangan.toString().toLowerCase().includes(keyword) ||
                    dataKaryawan[i].total.toString().toLowerCase().includes(keyword)
                ) {
                    
                    arr.push(dataKaryawan[i]);
                }
            }
            filteredKaryawan = arr;
            }
            let dataKaryawan 
            const renderKaryawan = () => {
            let rows;
            let totalAwal = 0;
            let totalTunjangan = 0;
            let totalTotal = 0;
            
            filteredKaryawan.forEach(item=>{
                rows += `<tr>
                <td>${item.id}</td>
                <td>${item.nama}</td>
                <td>${item.gender}</td>
                <td>${item.status}</td>
                <td>${item.anak}</td>
                <td>${item.bekerja}</td>
                <td>${formatter.format(item.gaji)}</td>
                <td>${formatter.format(item.tunjangan)}</td>
                <td>${formatter.format(item.total)}</td>
                <tr>`;
                    totalAwal += item.gaji;
                    totalTunjangan += item.tunjangan;
                    totalTotal += item.total;
            });
            console.log(rows);
            $('#tableKaryawan tbody').html(rows);  
            $('#totalAwal').html(formatter.format(totalAwal));
            $('#totalTunjangan').html(formatter.format(totalTunjangan));
            $('#totalTotal').html(formatter.format(totalTotal));
        } 
        
        $(function(){
            dataKaryawan = filteredKaryawan = JSON.parse(localStorage.getItem('dataKaryawan')) || []
            renderKaryawan();
        });
        $('#sort-direction').on('change', function(e) {
            selectionSort(dataKaryawan, $('#sort-by').val(), $(this).val());
            renderKaryawan();
            console.log($(this).val())
        });

        $('[name="status"]').on('change',function(){
            if($(this).val() === 'single'){
                $('[name="anak"]').val(0);
                $('[name="anak"]').attr('readonly',true);
            } else{
                $('[name="anak"]').attr('readonly',false);
            }
        })

        $('#filter').on('change keydown', function() {
                setTimeout(() => {
                    filterKaryawan($(this).val());
                    renderKaryawan();
                });
            })

        $('#sort-by').on('change', function(e) {
            selectionSort(dataKaryawan, $(this).val(), $('#sort-direction').val());
            renderKaryawan();
        });
            
        $('#form-karyawan').on('submit', function(e){
            e.preventDefault()
            insert()
            renderKaryawan()
        });
    });
    </script>
@endpush
@include('admin.layout.copyright')
@include('admin.layout.footer')