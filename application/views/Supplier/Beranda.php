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

<?php
$terkirim = $this->db->query("SELECT (SELECT jenis_ikan FROM ikan WHERE id = po.id_ikan) as ikan, terkirim FROM po WHERE pemasok = (SELECT nama FROM user WHERE username = '" . $user['username'] . "')")->result();
$tersisa = $this->db->query("SELECT (SELECT jenis_ikan FROM ikan WHERE id = po.id_ikan) as ikan, tersisa FROM po WHERE pemasok = (SELECT nama FROM user WHERE username = '" . $user['username'] . "')")->result();
$perbandingan = $this->db->query("SELECT (SELECT jenis_ikan FROM ikan WHERE id = po.id_ikan) as ikan, jmlpo FROM po WHERE pemasok = (SELECT nama FROM user WHERE username = '" . $user['username'] . "')")->result();
?>
<div class="row">
     <div class="col-4">
          <div class="card h-100 shadow mb-3">
               <div class="card-body">
                    <div class="chart-area">
                         <canvas id="myLine"></canvas>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-4">
          <div class="card h-100 shadow mb-3">
               <div class="card-body">
                    <div class="chart-area">
                         <canvas id="myLine1"></canvas>
                    </div>
               </div>
          </div>
     </div>
     <div class="col-4">
          <div class="card h-100 shadow mb-3">
               <div class="card-body">
                    <div class="chart-area">
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
                    foreach ($terkirim as $s) {
                         echo json_encode($s->ikan) . ',';
                    }
                    ?>
               ],
               datasets: [{
                    label: "Terkirim",
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
                         foreach ($terkirim as $s) {
                              echo json_encode($s->terkirim) . ',';
                         }
                         ?>
                    ],
               }],
          }
     });

     var ctx1 = document.getElementById("myLine1").getContext('2d');
     var myLineChart1 = new Chart(ctx1, {
          type: 'line',
          data: {
               labels: [
                    <?php
                    foreach ($tersisa as $s) {
                         echo json_encode($s->ikan) . ',';
                    }
                    ?>
               ],
               datasets: [{
                    label: "Tersisa",
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
                         foreach ($tersisa as $s) {
                              echo json_encode($s->tersisa) . ',';
                         }
                         ?>
                    ],
               }],
          }
     });

     var ctx2 = document.getElementById("myPie");
     var myPieChart = new Chart(ctx2, {
          type: 'doughnut',
          data: {
               labels: [
                    <?php
                    foreach ($perbandingan as $s) {
                         echo json_encode($s->ikan) . ',';
                    }
                    ?>
               ],
               datasets: [{
                    data: [
                         <?php
                         foreach ($perbandingan as $s) {
                              echo json_encode($s->jmlpo) . ',';
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