<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-body">
        <form action="<?= site_url('Lap_penjualan/cari'); ?>" method="POST">
          <div class="row mb-3">
            <div class="col">
              <div class="form-group">
                <label for="dari" class="mb-2">Dari Tanggal</label>
                <input type="date" name="dari" class="form-control">
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="sampai" class="mb-2">Sampai Tanggal</label>
                <input type="date" name="sampai" class="form-control">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <button type="submit" class="btn btn-primary float-right"><i class="fa fa-search"></i> Cari</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col">
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="h4">Laporan
          <a href="<?= site_url('Lap_penjualan/hapus_semua'); ?>" type="button" class="btn btn-danger float-right btn-sm"><i class="fa fa-trash"></i> Hapus Semua</a>
          <a href="<?= site_url('Lap_penjualan/cetak'); ?>" target="_blank" type="button" class="btn btn-success float-right btn-sm" style="margin-right: 10px;"><i class="fa fa-print"></i> Cetak</a>
        </div>
        <hr>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="table">
            <thead>
              <tr class="text-center">
                <th width="1%">No</th>
                <th>Inv Penjualan</th>
                <th>Tgl Jual</th>
                <th>User</th>
                <th>Keterangan</th>
                <th>Pelanggan</th>
                <th>Jenis Ikan</th>
                <th>Harga Ikan</th>
                <th>Diskon</th>
                <th>Qty</th>
                <th>Sub Total</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($laporan as $l) : ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $l->inv_penjualan; ?></td>
                  <td><?= $l->tgl_jual; ?></td>
                  <td><?= $l->user; ?></td>
                  <td><?= $l->keterangan; ?></td>
                  <td><?= $l->pelanggan; ?></td>
                  <td><?= $l->jenis_ikan; ?></td>
                  <td>Rp.
                    <span class="float-right"><?= number_format($l->harga_ikan); ?></span>
                  </td>
                  <td>Rp.
                    <span class="float-right"><?= number_format($l->diskon); ?></span>
                  </td>
                  <td>
                    <span class="float-right"><?= number_format($l->qty); ?></span>
                  </td>
                  <td>Rp.
                    <span class="float-right"><?= number_format($l->sub_total); ?></span>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <?php
            $sql = $this->db->query('select sum(if(harga_ikan is null, 0, harga_ikan)) as h_ikan, sum(if(diskon is null, 0, diskon)) as disc, sum(if(qty is null, 0, qty)) as qty, sum(if(sub_total is null, 0, sub_total)) as st from laporan limit 1')->result();
            ?>
            <tfoot>
              <?php foreach ($sql as $s) : ?>
                <tr>
                  <td colspan="7" class="text-center">TOTAL</td>
                  <td>
                    Rp. <span class="float-right">
                      <?php if ($s->h_ikan == null) {
                        $ha_ikan = 0;
                      } else {
                        $ha_ikan = $s->h_ikan;
                      } ?>
                      <?= number_format($ha_ikan); ?>
                    </span>
                  </td>
                  <td>
                    Rp. <span class="float-right">
                      <?php if ($s->disc == null) {
                        $dis = 0;
                      } else {
                        $dis = $s->disc;
                      } ?>
                      <?= number_format($dis); ?>
                    </span>
                  </td>
                  <td>
                    <span class="float-right">
                      <?php if ($s->qty == null) {
                        $qtyx = 0;
                      } else {
                        $qtyx = $s->qty;
                      } ?>
                      <?= number_format($qtyx); ?>
                    </span>
                  </td>
                  <td>
                    Rp. <span class="float-right">
                      <?php if ($s->st == null) {
                        $sub = 0;
                      } else {
                        $sub = $s->st;
                      } ?>
                      <?= number_format($sub); ?>
                    </span>
                  </td>
                </tr>
              <?php endforeach ?>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>