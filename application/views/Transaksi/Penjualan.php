<div class="row justify-content-center">
     <div class="col">
          <div class="card shadow mb-3">
               <div class="card-body">
                    <div class="h4">
                         Transaksi
                         <span class="float-right">
                              <?= $invoice; ?>
                              <input type="hidden" name="inv_penjualan" id="inv_penjualan" value="<?= $invoice; ?>">
                         </span>
                    </div>
               </div>
          </div>
     </div>
</div>
<form method="POST" id="form-jual">
     <div class="row justify-content-center mb-3">
          <div class="col">
               <div class="row mb-3">
                    <div class="col">
                         <div class="card shadow mb-3 h-100">
                              <div class="card-body">
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col-4">
                                             <label for="tanggal" class="col-form-label">Tanggal</label>
                                        </div>
                                        <div class="col-8">
                                             <input type="date" id="tgl_jual" name="tgl_jual" class="form-control" value="<?= date('Y-m-d'); ?>" readonly>
                                        </div>
                                   </div>
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col-4">
                                             <label for="user" class="col-form-label">Kasir</label>
                                        </div>
                                        <div class="col-8">
                                             <input type="text" id="user" name="user" class="form-control" value="<?= $user['username']; ?>" readonly>
                                        </div>
                                   </div>
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col-4">
                                             <label for="pelanggan" class="col-form-label">Pelanggan</label>
                                        </div>
                                        <div class="col-8">
                                             <select name="pelanggan" id="pelanggan" class="form-control select2_pelanggan">
                                                  <?php foreach ($pelanggan as $p) : ?>
                                                       <option value="<?= $p->nama; ?>"><?= $p->nama; ?></option>
                                                  <?php endforeach; ?>
                                             </select>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
               <div class="row mb-3">
                    <div class="col">
                         <div class="card shadow mb-3 h-100">
                              <div class="card-body">
                                   <div class="h4">Keranjang Pembelian</div>
                                   <hr>
                                   <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered table-hover">
                                             <thead>
                                                  <tr class="text-center">
                                                       <th>Delete</th>
                                                       <th width="20%">Jenis Ikan</th>
                                                       <th width="10%">QTY</th>
                                                       <th>Harga Ikan</th>
                                                       <th>Diskon Rp</th>
                                                       <th>Jumlah</th>
                                                  </tr>
                                             </thead>
                                             <tbody>
                                                  <tr>
                                                       <td class="text-center">
                                                            <button type='button' onclick="hapusBarisIni(1)" class='btn btn-danger btm-sm' id="del1"><i class='fa fa-trash'></i>
                                                       </td>
                                                       <td>
                                                            <select name="kode[]" id="kode1" class="select2_i form-control" onchange="showikan(this.value, 1);"></select>
                                                       </td>
                                                       <td>
                                                            <input name="qty[]" onchange="totalline(1);qtyc(1)" value="1" id="qty1" type="text" class="form-control">
                                                       </td>
                                                       <td>
                                                            <input name="harga[]" onchange="totalline(1); cekharga(1);" value="0" id="harga1" type="text" class="form-control" readonly>
                                                       </td>
                                                       <td>
                                                            <input name="discrp[]" onchange="totalline(1); ubahdsc(1);" value="0" id="discrp1" type="text" class="form-control">
                                                       </td>
                                                       <td>
                                                            <input name="jumlah[]" id="jumlah1" type="text" class="form-control" size="40%" readonly value="0">
                                                       </td>
                                                  </tr>
                                             </tbody>
                                        </table>
                                        <button type="button" onclick="tambah()" class="btn btn-success" style="margin-left: 17px;">
                                             <i class="fa fa-plus"></i>
                                        </button>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="row">
          <div class="col">
               <div class="row mb-3">
                    <div class="col">
                         <div class="card shadow mb-3 h-100">
                              <div class="card-body">
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col-4">
                                             <label for="sub_total" class="col-form-label">Sub total</label>
                                        </div>
                                        <div class="col-8">
                                             <input type="text" id="sub_total" name="sub_total" class="form-control" readonly value="0">
                                        </div>
                                   </div>
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col-4">
                                             <label for="diskon" class="col-form-label">Diskon</label>
                                        </div>
                                        <div class="col-8">
                                             <input type="text" id="diskon" name="diskon" class="form-control" readonly value="0">
                                        </div>
                                   </div>
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col-4">
                                             <label for="pajak" class="col-form-label">PPN</label>
                                        </div>
                                        <div class="col-8">
                                             <input type="text" id="pajak" name="pajak" class="form-control" readonly value="0">
                                        </div>
                                   </div>
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col-4">
                                             <label for="total" class="col-form-label">Total</label>
                                        </div>
                                        <div class="col-8">
                                             <input type="text" id="total" name="total" class="form-control" readonly value="0">
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col">
               <div class="row mb-3">
                    <div class="col">
                         <div class="card shadow mb-3 h-100">
                              <div class="card-body">
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col-4">
                                             <label for="pembayaran" class="col-form-label">Bayar</label>
                                        </div>
                                        <div class="col-8">
                                             <input type="text" id="pembayaran" name="pembayaran" class="form-control" onchange="pembayaranx()" value="0">
                                        </div>
                                   </div>
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col-4">
                                             <label for="kembalian" class="col-form-label">Kembalian</label>
                                        </div>
                                        <div class="col-8">
                                             <input type="text" name="kembalian" id="kembalian" class="form-control" readonly value="0">
                                        </div>
                                   </div>
                                   <div class="row g-3 align-items-center mb-3">
                                        <div class="col">
                                             <button class="btn btn-success float-right " style="margin-right: 10px;" type="button" onclick="belanja()"><i class="fas fa-shopping-cart"></i> Selesai</button>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</form>

<script>
     function pembayaranx() {
          var totalx = $('#total').val();
          var pembayaran = $('#pembayaran').val();
          var total = parseInt(totalx.replaceAll(',', ''));
          if (pembayaran < total) {
               Swal.fire({
                    icon: 'warning',
                    title: 'PEMBAYARAN',
                    text: 'Terlalu kecil !',
               }).then((value) => {
                    $('#pembayaran').val(0);
                    $('#kembalian').val(0);
               });
          } else {
               var kembalian = pembayaran - total;
               $('#pembayaran').val(separateComma(pembayaran));
               $('#kembalian').val(separateComma(kembalian));
          }
     }
</script>

<!-- master -->
<script>
     function separateComma(val) {
          var sign = 1;
          if (val < 0) {
               sign = -1;
               val = -val;
          }
          let num = val.toString().includes('.') ? val.toString().split('.')[0] : val.toString();
          let len = num.toString().length;
          let result = '';
          let count = 1;
          for (let i = len - 1; i >= 0; i--) {
               result = num.toString()[i] + result;
               if (count % 3 === 0 && count !== 0 && i !== 0) {
                    result = ',' + result;
               }
               count++;
          }
          if (val.toString().includes('.')) {
               result = result + '.' + val.toString().split('.')[1];
          }
          return sign < 0 ? '-' + result : result;
     }
     var arr = [1];
     var idrow = 2;
</script>

<script>
     if (idrow == 2) {
          $('#del1').attr('hidden', true);
     }
</script>

<script>
     function tambah() {
          var table = document.getElementById('datatable');
          rowCount = table.rows.length;
          arr.push(idrow);
          var x = document.getElementById('datatable').insertRow(rowCount);
          var td1 = x.insertCell(0);
          var td2 = x.insertCell(1);
          var td3 = x.insertCell(2);
          var td4 = x.insertCell(3);
          var td5 = x.insertCell(4);
          var td6 = x.insertCell(5);
          var button = "<td id='kolom" + idrow + "'><button type='button' onclick=hapusBarisIni(" + idrow + ") id=del" + idrow + " class='btn btn-danger'><i class='fa fa-trash'></td>";
          var akun = "<select name='kode[]' id='kode" + idrow + "' class='select2_i form-control' onchange='showikan(this.value, " + idrow + ");'></select>";
          var qty = "<input name='qty[]' id=qty" + idrow + " onchange='totalline(" + idrow + "); qtyc(" + idrow + ")' value=1  type='text' class='form-control rightJustified'>";
          var harga = "<input name='harga[]'  id=harga" + idrow + " onchange='totalline(" + idrow + ");cekharga(" + idrow + ");' value='0'  type='text' class='form-control rightJustified' readonly> ";
          var discrp = "<input name='discrp[]' id=discrp" + idrow + " onchange='totalline(" + idrow + ");ubahdsc(" + idrow + ");' value='0'  type='text' class='form-control rightJustified'  >";
          var jum = "<input name='jumlah[]' id=jumlah" + idrow + " type='text' class='form-control rightJustified' size='40%' readonly value='0'>";
          td1.innerHTML = button;
          td2.innerHTML = akun;
          td3.innerHTML = qty;
          td4.innerHTML = harga;
          td5.innerHTML = discrp;
          td6.innerHTML = jum;
          initailizeSelect2_i();
          idrow++;
     }

     function ubahdsc(id) {
          var hargax = $('#harga' + id).val();
          var harga = parseInt(hargax.replaceAll(',', ''));
          var qtyx = $('#qty' + id).val();
          var qty = parseInt(qtyx.replaceAll(',', ''));
          var diskonx = $('#discrp' + id).val();
          var diskon = parseInt(diskonx.replaceAll(',', ''));
          var jum = harga * qty - diskon;
          var jumlah = $('#jumlah' + id).val(separateComma(jum));
     }

     function totalline(id) {
          var table = document.getElementById('datatable');
          var row = table.rows[arr.indexOf(id) + 1];
          var hargax = parseInt(row.cells[3].children[0].value.replaceAll(',', ''));
          var diskonrpx = parseInt(row.cells[4].children[0].value.replaceAll(',', ''));
          var jumlah = row.cells[2].children[0].value * hargax;
          var subtot = jumlah - diskonrpx;
          var tot = jumlah - diskonrpx;
          row.cells[4].children[0].value = separateComma(diskonrpx);
          row.cells[5].children[0].value = separateComma(tot);
          total();
     }

     function total() {
          var table = document.getElementById('datatable');
          var rowCount = table.rows.length;
          tjumlah = 0;
          tdiskon = 0;
          tppn = 0;
          for (var i = 1; i < rowCount; i++) {
               var row = table.rows[i];
               qty = row.cells[2].children[0].value;
               harga = row.cells[3].children[0].value;
               diskonrp = row.cells[4].children[0].value;
               jumlah = row.cells[5].children[0].value;
               var qty1 = Number(qty.replace(/[^0-9\.]+/g, ""));
               var harga1 = Number(harga.replace(/[^0-9\.]+/g, ""));
               var diskon2 = Number(diskonrp.replace(/[^0-9\.]+/g, ""));
               var jumlah1 = Number(jumlah.replace(/[^0-9\.]+/g, ""));
               tjumlah = tjumlah + (qty1 * harga1);
               tdiskon = tdiskon + diskon2;
               $.ajax({
                    url: '<?php echo base_url(); ?>Globali/cekppn',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                         cekppn = data.persentase;
                         cekppn2 = cekppn / 100;
                         tppn = eval(tjumlah * cekppn2);
                         document.getElementById("sub_total").value = separateComma(tjumlah);
                         document.getElementById("diskon").value = separateComma(tdiskon);
                         document.getElementById("pajak").value = separateComma(tppn);
                         document.getElementById("total").value = separateComma(tjumlah - tdiskon + tppn);
                    }
               });
          }
     }
     $('.select2_pelanggan').select2();
</script>

<script>
     function belanja() {
          let timerInterval
          Swal.fire({
               title: 'PROSES PENJUALAN IKAN!',
               html: 'Tunggu sekitar <b></b> milidetik.',
               timer: 1000,
               timerProgressBar: true,
               didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                         b.textContent = Swal.getTimerLeft()
                    }, 100)
               },
               willClose: () => {
                    clearInterval(timerInterval)
               }
          }).then((result) => {
               var inv = $('#inv_penjualan').val();
               var tgl = $('#tgl_jual').val();
               var user = $('#user').val();
               var pelanggan = $('#pelanggan').val();
               var table = document.getElementById('datatable');
               rowCount = table.rows.length;
               arr.push(idrow);
               for (i = 1; i < rowCount; i++) {
                    var kode = $('#kode' + i).val();
                    var qtyx = $('#qty' + i).val();
                    var hargax = $('#harga' + i).val();
                    var discrpx = $('#discrp' + i).val();
                    var jumlahx = $('#jumlah' + i).val();
                    var qty = parseInt(qtyx.replaceAll(',', ''));
                    var harga = parseInt(hargax.replaceAll(',', ''));
                    var discrp = parseInt(discrpx.replaceAll(',', ''));
                    var jumlah = parseInt(jumlahx.replaceAll(',', ''));
                    $.ajax({
                         url: '<?= site_url() ?>Penjualan/jual/?kode=' + kode + '&qty=' + qty + '&harga=' + harga + '&discrp=' + discrp + '&jumlah=' + jumlah + '&inv=' + inv + '&tgl_jual=' + tgl + '&user=' + user + '&pelanggan=' + pelanggan,
                         type: 'GET',
                         dataType: 'JSON',
                    });
               }
               var sub_totalx = $('#sub_total').val();
               var diskonx = $('#diskon').val();
               var pajakx = $('#pajak').val();
               var totalx = $('#total').val();
               var pembayaranx = $('#pembayaran').val();
               var kembalianx = $('#kembalian').val();
               var sub_total = parseInt(sub_totalx.replaceAll(',', ''));
               var diskon = parseInt(diskonx.replaceAll(',', ''));
               var pajak = parseInt(pajakx.replaceAll(',', ''));
               var total = parseInt(totalx.replaceAll(',', ''));
               var pembayaran = parseInt(pembayaranx.replaceAll(',', ''));
               var kembalian = parseInt(kembalianx.replaceAll(',', ''));
               $.ajax({
                    url: '<?= site_url() ?>Penjualan/data_jual/?inv=' + inv + '&sub_total=' + sub_total + '&diskon=' + diskon + '&pajak=' + pajak + '&total=' + total + '&pembayaran=' + pembayaran + '&kembalian=' + kembalian,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data) {
                         if (data.status == 1) {
                              Swal.fire({
                                   title: 'CETAK NOTA',
                                   html: "Anda ingin mencetak nota " + inv.toUpperCase().bold() + " ?",
                                   icon: 'question',
                                   showCancelButton: true,
                                   confirmButtonColor: '#3085d6',
                                   cancelButtonColor: '#d33',
                                   confirmButtonText: '<i class="fa fa-check-circle"></i> Cetak',
                                   cancelButtonText: '<i class="fa fa-times-circle"></i> Tidak',
                              }).then((result) => {
                                   if (result.isConfirmed) {
                                        window.open("http://localhost/ikan/Penjualan/cetak/" + inv, '_blank');
                                        location.href = "<?php echo base_url() ?>Penjualan";
                                   } else {
                                        Swal.fire({
                                             icon: 'success',
                                             title: 'PENJUALAN',
                                             text: 'Berhasil dilakukan !',
                                        }).then((value) => {
                                             location.href = "<?php echo base_url() ?>Penjualan";
                                        })
                                   }
                              });
                         } else {
                              Swal.fire({
                                   icon: 'error',
                                   title: 'PENJUALAN',
                                   text: 'Gagal dilakukan !',
                              });
                         }
                    }
               });
          });
     }
</script>