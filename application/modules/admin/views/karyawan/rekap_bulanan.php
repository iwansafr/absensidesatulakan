<form action="" method="get">
    <div class="form-group">
        <label for="">Bulan</label>
        <select name="month" class="form-control">
            <option <?php if($month == 1) { echo 'selected'; } ?> value="1">Januari</option>
            <option <?php if($month == 2) { echo 'selected'; } ?> value="2">Februari</option>
            <option <?php if($month == 3) { echo 'selected'; } ?> value="3">Maret</option>
            <option <?php if($month == 4) { echo 'selected'; } ?> value="4">April</option>
            <option <?php if($month == 5) { echo 'selected'; } ?> value="5">Mei</option>
            <option <?php if($month == 6) { echo 'selected'; } ?> value="6">Juni</option>
            <option <?php if($month == 7) { echo 'selected'; } ?> value="7">Juli</option>
            <option <?php if($month == 8) { echo 'selected'; } ?> value="8">Agustus</option>
            <option <?php if($month == 9) { echo 'selected'; } ?> value="9">September</option>
            <option <?php if($month == 10) { echo 'selected'; } ?> value="10">Oktober</option>
            <option <?php if($month == 11) { echo 'selected'; } ?> value="11">November</option>
            <option <?php if($month == 12) { echo 'selected'; } ?> value="12">Desember</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Tahun</label>
        <input type="number" name="year" class="form-control" value="<?php echo $year;?>">
    </div>
    <div class="form-group">
        <button class="btn btn-primary">Submit</button>
    </div>
</form>
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>NO</th>
                <th>KARYAWAN</th>
                <?php
                for($i=1;$i<=$totalDay;$i++){
                    ?>
                    <th style="white-space: nowrap;"><?php echo date('d-M-Y', strtotime($i.'-'.$month.'-'.$year));?></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $k = 1;
            foreach ($output as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $k;?></td>
                    <td style="white-space: nowrap;"><?php echo $value['profil']['nama'];?></td>
                    <?php
                    for($i=1;$i<=$totalDay;$i++){
                        ?>
                        <td style="white-space: nowrap;">
                            <?php
                            if(!empty($value['absensi'][ date('Y-m-d', strtotime($year.'-'.$month.'-'.$i)) ])){
                                $z = 1;
                                if (is_array($value['absensi'][ date('Y-m-d', strtotime($year.'-'.$month.'-'.$i)) ] )) {
                                    foreach (
                                        $value['absensi'][ date('Y-m-d', strtotime($year.'-'.$month.'-'.$i)) ] 
                                        as $absensiKey
                                            => $absensiValue) {
                                        echo substr($absensiValue['visit_time'], 11,20);
                                        if($z == 1){
                                            echo ' - ';
                                        }
                                        $z++;
                                    }
                                }else{
                                    echo 'Kosong';
                                }
                            }else{
                                echo 'Kosong';
                            }
                            ?>
                        </td>
                        <?php
                    }?>
                </tr>
                <?php
                $k++;
            }
            ?>
        </tbody>
    </table>
</div>