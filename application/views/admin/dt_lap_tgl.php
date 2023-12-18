<?php
if ($v_dapat->num_rows() != 0) {
?>
    <style>
        table.tab {
            width: 100%;
        }

        .tab th {
            border: 1px solid;
            border-color: #5200E4;
            background-color: #5200E4;
            padding: 5px;
            text-align: center;
            color: aliceblue;
        }

        .tab td {
            border: 1px solid;
            border-color: #5200E4;
            padding: 5px;
        }
    </style>
    <div class="text-center">
        <h3>LAPORAN PENDAPATAN</h3><br>
        <h5>DARI TANGGAL <span class="text-danger"><?= $tgl1; ?></span> SAMPAI DENGAN TANGGAL <span class="text-danger"><?= $tgl2; ?></span></h5>
    </div>
    <div class="table-responsive">
        <table class="tab ">
            <thead>
                <tr>
                    <th width="5%" class="text-center">
                        NO
                    </th>
                    <th width="17%">TANGGAL</th>
                    <th width="17%">JML MEMBER</th>
                    <th width="10%">TOTAL</th>
                    <th width="10%">DIBAYAR</th>
                </tr>
            </thead>
            <tbody>
                <?php
                error_reporting(0);
                $no = 1;
                foreach ($v_dapat->result() as $m) {
                    $tot += $m->dby;
                    $tgg = $m->tgl;
                    $sql_jum_mem = "SELECT * FROM member WHERE tgl='$tgg' ";
                    $jum_m = $this->db->query($sql_jum_mem)->num_rows();
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= format_indo($m->tgl); ?></td>
                        <td><?= $jum_m; ?> Member</td>
                        <td class="">Rp. <span style="float: right;"><?= number_format($m->tl, 0, ",", "."); ?> </span></td>
                        <td class="">Rp. <span style="float: right;"><?= number_format($m->dby, 0, ",", "."); ?></span></td>
                    </tr>

                <?php } ?>
                <tr>
                    <td colspan="4" class="text-center"><b>TOTAL PENDAPATAN</b></td>
                    <td colspan=""><b>Rp. <span style="float: right;"><?= number_format($tot, 0, ",", "."); ?></span></b></td>
                </tr>

            </tbody>
        </table>
    </div>
<?php } else {
    echo "<script>
         swal('Oops..', 'Maaf.. , Data tidak ditemukan, Silahakan cari data yang lain!', 'error');
      </script>";
    echo "<img src='" . base_url('assets/error.gif') . "' width='20%' >";
} ?>