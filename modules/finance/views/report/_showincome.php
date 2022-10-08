<?php

use app\components\Formatter;

?>
<table class="table table-striped table-bordered compact">
    <thead>
    <tr>
        <th>No</th>
        <th>Code</th>
        <th>COA Name</th>
        <th>Tanggal</th>
        <th>Shift</th>
        <th>Nominal</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $no = 1;
    $total = 0;
    foreach ($model as $row) {
        echo '<tr>';
        echo '<td>' . $no . '</td>';
        echo '<td>' . $row['coa_code'] . '</td>';
        echo '<td>' . $row['coa_name'] . '</td>';
        echo '<td>' . $row['posting_date'] . '</td>';
        echo '<td>' . $row['posting_shift'] . '</td>';
        echo '<td style="text-align: right;">' . Formatter::formatNumber($row['nominal']) . '</td>';
        echo '</tr>';
        $no++;
        $total += $row['nominal'];
    }
    echo '<tr>';
    echo '<td colspan="5" style="text-align: right;"> Total </td>';
    echo '<td style="text-align: right;">' . Formatter::formatNumber($total) . '</td>';
    echo '</tr>';
    ?>
    </tbody>
</table>