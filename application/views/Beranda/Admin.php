<div class="row">
     <div class="col-xl-3 col-md-6 mb-4">
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
     <div class="col-xl-3 col-md-6 mb-4">
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
     <div class="col-xl-3 col-md-6 mb-4">
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
     <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
               <div class="card-body">
                    <div class="row no-gutters align-items-center">
                         <div class="col mr-2">
                              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                   Transaksi</div>
                              <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($transaksi); ?></div>
                         </div>
                         <div class="col-auto">
                              <i class="fas fa-exchange fa-2x text-gray-300"></i>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>

<?php
$jual = $this->db->query('
     SELECT a.* FROM 
     (select id, qty, jenis_ikan as nama, sub_total as penjualan, tgl_jual as tgl  from penjualan_detail 
     union all
     select id, qty, jenis_ikan as nama, sub_total as penjualan, tgl_beli as tgl from order_detail
     ) as a
     where a.tgl between "' . date('Y-m-d', time() - (60 * 60 * 24 * 7)) . '" and "' . date('Y-m-d') . '"
')->result();
$sell = $this->db->query('
     SELECT a.* FROM 
     (select id, qty, jenis_ikan as nama, sub_total as penjualan, tgl_jual as tgl  from penjualan_detail 
     union all
     select id, qty, jenis_ikan as nama, sub_total as penjualan, tgl_beli as tgl from order_detail
     ) as a
     where a.tgl between "' . date('Y-m-d', time() - (60 * 60 * 24 * 7)) . '" and "' . date('Y-m-d') . '" order by a.qty desc limit 4
')->result();
foreach ($jual as $m) {
     $nama = $m->nama;
     $nama_ikan = $nama;
     $qty = $m->qty;
     $qty_ikan = $qty;
}
?>
<div class="row mb-4">
     <div class="col-xl-5">
          <div class="card h-100 shadow mb-4">
               <div class="card-body">
                    <h6 class="m-0 font-weight-bold text-primary">Penjualan Seminggu Terakhir</h6>
                    <hr>
                    <div class="chart-area">
                         <canvas id="myLine"></canvas>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-xl-7">
          <div class="card h-100 shadow mb-4">
               <div class="card-body">
                    <h6 class="m-0 font-weight-bold text-primary">4 Penjualan Terlaris</h6>
                    <hr>
                    <div class="chart-pie pt-4 pb-2">
                         <canvas id="myPie"></canvas>
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
                    foreach ($jual as $j) {
                         echo json_encode($j->nama) . ',';
                    }
                    ?>
               ],
               datasets: [{
                    label: "Penjualan",
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
                         foreach ($jual as $j) {
                              echo json_encode($j->qty) . ',';
                         }
                         ?>
                    ],
               }],
          }
     });

     var ctx = document.getElementById("myPie");
     var myPieChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
               labels: [
                    <?php
                    foreach ($sell as $s) {
                         echo json_encode($s->nama) . ',';
                    }
                    ?>
               ],
               datasets: [{
                    data: [
                         <?php
                         foreach ($sell as $s) {
                              echo json_encode($s->qty) . ',';
                         }
                         ?>
                    ],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
               }],
          },
          options: {
               maintainAspectRatio: false,
               tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
               },
               legend: {
                    display: false
               },
               cutoutPercentage: 80,
          },
     });
</script>