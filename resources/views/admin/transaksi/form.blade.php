<div class="collapse" id="formLaundry">
    <div class="card-body">
        <h3>Form</h3>
        <br>
              @error('id_paket')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('dibayar')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('id_member')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
                  @error('deadline')
                    <div class="text">
                      <b>{{ $message }}</b>
                    </div>
                  @enderror
        <div class="form-group">
            <form>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Deadline</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control col-md-12 col-xs-12" id="deadline" name="deadline" value="{{ date('Y-m-d') }}">
                  </div>
                </div>
              {{-- data member --}}
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-user-friends nav-icon"></i> Pilih Member
                    </button>
                    <br>
                    <p style="font-size:15px;">
                        <b>Nama Member :</b> <span style="font-size: 15px" class="nama"></span>
                    </p>
                    <p style="font-size:15px;">
                        <b>No Telpon :</b><span style="font-size: 15px" class="tlp"></span>
                    </p>
                    <p style="font-size:15px;">
                        <b>Alamat :</b><span style="font-size: 15px" class="alamat"></span>
                    </p>
                </div>
                <input type="hidden" class="id_member" name="id_member">
                {{-- end data member --}}

                {{-- data paket --}}

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary" id="tambahPaketBtn" data-toggle="modal" data-target="#modalPaket">
                                    Tambah Cucian
                                </button>
                            </div>
                        </div>
                        <div class="clearfix">&nbsp;</div>
                        <div class="row">
                            <table id="tblTransaksi" class="table table-striped table-bordered bulk_action">
                                <thead>
                                    <tr>
                                        <th>Nama Paket</th>
                                        <th>Harga</th>
                                        <th>QTY</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" style="text-align: center;font-style:italic;">Belum Ada Data</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr valign="bottom">
                                        <td width="" colspan="3" align="right">Jumlah Bayar</td>
                                        <td><span id="subtotal">0</span></td>
                                        <td rowspan="4">
                                            <label for="">Pembayaran</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="dibayar" id="flexRadioDefault1" value="dibayar">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                  dibayar
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="dibayar" id="flexRadioDefault2" value="belum_dibayar">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                  Belum Dibayar
                                                </label>
                                              </div>
                                            <div class="">
                                                <button class="btn btn-primary" style="margin-top: 10px;width:170px;">Bayar</button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="right">Diskon</td>
                                        <td><input type="number" value="0" name="diskon" id="diskon" style="width: 140px;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" align="right">Pajak <input type="number" value="0" min="0" class="" name="pajak" id="pajak-persen" size="2" style="width: 40px"></td>
                                        <td><span id="pajak-harga">0</span></td>
                                    </tr>
                                    <tr style="background: black;color: white;font-weight:bold;font-size:1em;">
                                        <td colspan="3" align="right">Total Bayar Akhir</td>
                                        <td><span id="total">0</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- end data paket --}}
            </form>
        </div>
            

        {{-- modal Member --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah Paket</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="card-box table-responsive">
                                  <table id="tblmember" class="table table-bordered table-hover">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Nama Member</th>
                                              <th>Alamat</th>
                                              <th>No Telpon</th>
                                              <th>Jenis Kelamin</th>
                                              <th>Menu</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($member as $m)
                                          <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $m->nama }}</td>
                                            <td>{{ $m->alamat }}</td>
                                            <td>{{ $m->tlp }}</td>
                                            <td>{{ $m->jenis_kelamin }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" onclick="changeMember(this)" data-id="{{ $m->id }}" data-nama="{{ $m->nama }}" data-alamat="{{ $m->alamat }}" data-notelp="{{ $m->tlp }}" data-bs-dismiss="modal">
                                                  <span class="fw-bold me-1">&plus;</span> Pilih
                                                </button>
                                              </td>
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
    </div>
</div>

{{-- end modal member --}}

{{-- Modal Paket --}}

<div class="modal fade" id="modalPaket" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pilih Paket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table id="tblPaket" class="table table-striped table-compact">
              <thead>
                  <tr>
                      <th>No.</th>
                      <th>Nama Paket</th>
                      <th>Harga</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach ($paket as $p)
                      <tr>
                          <td>{{ $loop->iteration }}
                            <input type="hidden" class="idPaket" name="idPaket" value="{{ $p->id }}"></td>
                          <td>{{ $p->nama_paket }}</td>
                          <td>{{ $p->harga }}</td>
                          <td>
                            <button type="button" class="pilihPaketBtn btn btn-primary" data-dismiss="modal">
                                <span class="fw-bold me-1">&plus;</span> Pilih
                              </button>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

{{-- end modal paket --}}

@push('script')
<script>
    //function pilih member
    const Id = document.querySelector('.id_member')
    const Nama = document.querySelector('.nama')
    const Notelp = document.querySelector('.tlp')
    const Alamat = document.querySelector('.alamat')
    function changeMember(el){
    let id= el.getAttribute("data-id")
    let nama = el.getAttribute("data-nama")
    let tlp= el.getAttribute("data-notelp")
    let alamat= el.getAttribute("data-alamat")
    
    console.log(id) 
    console.log(nama)
    console.log(tlp)
    console.log(alamat)

    Id.value = id;
    Nama.innerText = nama;
    Notelp.innerText = tlp;
    Alamat.innerText = alamat;
    }

  </script>

  <script>
      let subtotal = total =  0;
      $(function(){
          $('#tblmember').DataTable();
      })

      // Pilih paket
      $('#tblPaket').on('click','.pilihPaketBtn', function(){
            pilihPaket(this)
            $('#modalPaket').modal('hide')
        })
        
      //function pilih paket
      function pilihPaket(x){
          const tr =$(x).closest('tr')
          const namaPaket = tr.find('td:eq(1)').text()
          const harga = tr.find('td:eq(2)').text()
          const idPaket = tr.find('.idPaket').val()

          let arrItemsId = $('#tblTransaksi tbody tr')
        .map(function(i, row) {
            let id = $(row).find('input[name="id_paket[]"]').eq(0).val();
            return parseInt(id || null);
        })
        .get();

    if (arrItemsId.some((id) => idPaket == id)) {
        let tr = $(`input[name="id_paket[]"][value="${idPaket}"]`).closest("tr");
        let inputQty = tr.find('input[name="qty[]"]');
        inputQty.val(function() {
            return parseInt($(this).val() || 0) + 1;
        });
        inputQty.trigger("change");
    } else {

          let data = ''
          let tbody = $('#tblTransaksi tbody tr td').text()
          data += '<tr>'
          data += `<td>${namaPaket}</td>`
          data += `<td>${harga}</td>`
          data += `<input type="hidden" name="id_paket[]" value="${idPaket}">`
          data += `<td><input type="number" value="1" min"1" class="qty" name="qty[]" size="2" style="width:40px"</td>`
          data += `<td><label name="sub_total[]" class="subTotal">${harga}</label></td>`
          data += `<td><button type="button" class="btnRemovePaket btn btn-danger"><span class="fas fa-times-circle"></span></button></td>`
          data += '</tr>'

          if(tbody == 'Belum Ada Data') $('#tblTransaksi tbody tr').remove();
    
          
          $('#tblTransaksi tbody').append(data);
    }
        
        subtotal += Number(harga)
        total = subtotal - Number($('#diskon').val()) +  ($('#pajak-harga').text())
        $('#subtotal').text(subtotal)
        $('#total').text(total)
      }

      function hitungTotalAkhir(a){
          let qty = Number($(a).closest('tr').find('.qty').val());
          let harga = Number($(a).closest('tr').find('td:eq(1)').text());
          let subTotalAwal = Number($(a).closest('tr').find('.subTotal').text());
          let count = qty * harga;
          subtotal = subtotal - subTotalAwal + count 
          total = subtotal - Number($('#diskon').val()) + Number($('#pajak-harga').val())
          $(a).closest('tr').find('.subTotal').text(count)
          $('#subtotal').text(subtotal)
          $('#total').text(total)
          
      }

      function hitungDiskon() {
          let diskon = $('#diskon').val()
          let totalDiskon = subtotal * (diskon / 100);
            $('#diskon').text(totalDiskon);
            total = subtotal - totalDiskon
            $('#total').text(total)
      }

      function hitungPajak() {
          let pajak = $('#pajak-persen').val()
          let totalPajak = subtotal * (pajak / 100);
            $('#pajak-harga').text(totalPajak);
            total = subtotal + totalPajak
            $('#total').text(total)
      }

      $('#tblTransaksi').on('change keydown','#pajak-persen', function(){
          hitungPajak(this)
      })

      $('#tblTransaksi').on('change keydown','#diskon', function(){
          hitungDiskon(this)
      })

      $('#tblTransaksi').on('change','.qty', function(){
          hitungTotalAkhir(this)
      })
  </script>

  <script>
      $('#tblTransaksi').on('click','.btnRemovePaket',function(){
          let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').text());
          subtotal -= subTotalAwal
          total -= subTotalAwal;

          $currentRow = $(this).closest('tr').remove();
          $('#subtotal').text(subtotal)
          $('#total').text(total)
      })
  </script>

@endpush