<div class="row">
     <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
               <div class="card-body">
                    <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                   Pelanggan</div>
                              <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($pelanggan); ?></div>
                         </div>
                         <div class="col-auto">
                              <i class="fas fa-users fa-2x text-gray-300"></i>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
               <div class="card-body">
                    <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                   Jenis Ikan</div>
                              <div class="h4 mb-0 font-weight-bold text-gray-800"><?= number_format($ikan); ?></div>
                         </div>
                         <div class="col-auto">
                              <i class="fas fa-fish fa-2x text-gray-300"></i>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
               <div class="card-body">
                    <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                   Stok</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800">
                                   <?php foreach ($stok as $s) {
                                        echo number_format($s->stok_ikan);
                                   }; ?>
                              </div>
                         </div>
                         <div class="col-auto">
                              <i class="fas fa-boxed fa-2x text-gray-300"></i>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<div class="row">
     <div class="col-8">
          <div class="card h-100 shadow mb-3">
               <div class="card-body">
                    <div class="h5">DAFTAR IKAN MASUK SEMINGGU TERAKHIR</div>
                    <hr>
                    <?php
                    $sql = $this->db->query("
                    SELECT (select jenis_ikan from ikan where id=bapb.id_ikan) as ikan, jmlbapb, tglbapb, stok_in FROM `bapb` 
                    where tglbapb between '" . date('Y-m-d', time() - (60 * 60 * 24 * 7)) . "' and '" . date('Y-m-d') . "'
                    ORDER BY tglbapb  DESC limit 10
                    ")->result();
                    ?>
                    <div class="table-responsive">
                         <table class="table table-striped table-bordered table-hover">
                              <thead>
                                   <tr class="text-center">
                                        <th>Jenis Ikan</th>
                                        <th>Tanggal Terima</th>
                                        <th>Jumlah Baru</th>
                                        <th>Tersisa</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php foreach ($sql as $s) : ?>
                                        <tr>
                                             <td><?= $s->ikan; ?></td>
                                             <td><?= $s->tglbapb; ?></td>
                                             <td class="text-right"><?= number_format($s->jmlbapb); ?></td>
                                             <td class="text-right"><?= number_format($s->stok_in); ?></td>
                                        </tr>
                                   <?php endforeach; ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-4">
          <div class="card h-100 shadow mb-3">
               <div class="card-body">
                    <div class="chart-area">
                         <canvas id="myLine"></canvas>
                    </div>
               </div>
          </div>
     </div>
</div>

<script>
     var ctx = document.getElementById("myLine").getContext('2d');
     var myLineChart = new Chart(ctx, {
          type: 'line',
          data: {
               labels: [
                    <?php
                    foreach ($sql as $s) {
                         echo json_encode($s->ikan) . ',';
                    }
                    ?>
               ],
               datasets: [{
                    label: "7 Hari terakhir",
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [
                         <?php
                         foreach ($sql as $s) {
                              echo json_encode($s->jmlbapb) . ',';
                         }
                         ?>
                    ],
               }],
          }
     });
</script>