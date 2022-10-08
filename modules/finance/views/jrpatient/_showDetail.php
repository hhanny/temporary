<?php

use app\models\JournalDetail;
use app\components\Formatter;

$title = $journal->jr_num . '/' . $journal->description;
?>
<div class="row">
    <div class="col-lg-6 ">
        <p class="h3">Detail Journal</p>
        <address>
            No Journal : <?= $journal->jr_num ?> <br>
            Description : <?= $journal->description ?><br>
            Entry Date : <?= date('d-m-Y', strtotime($journal->entry_date)) ?><br>
            Type : <?= $journal->jtype->jrtype_name ?>
        </address>
    </div>
</div>
<div class="row">
    <table class="table table-bordered cell-border compact stripe" id="listPayment">
        <thead>
        <tr>
            <th>No</th>
            <th><?= JournalDetail::instance()->getAttributeLabel('created_time') ?></th>
            <th><?= JournalDetail::instance()->getAttributeLabel('description') ?></th>
            <th><?= JournalDetail::instance()->getAttributeLabel('type') ?></th>
            <th><?= JournalDetail::instance()->getAttributeLabel('coa_code') ?></th>
            <th><?= JournalDetail::instance()->getAttributeLabel('coa_name') ?></th>
            <th><?= JournalDetail::instance()->getAttributeLabel('debet') ?></th>
            <th><?= JournalDetail::instance()->getAttributeLabel('credit') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $no = 1;
        $totalDebet = 0;
        $totalCredit = 0;
        foreach ($debet as $item) {
            echo '<tr>';
            echo '<td>' . $no . '</td>';
            echo '<td>' . date('d-m-Y H:i', strtotime($item->created_time)) . '</td>';
            echo '<td>' . $item->description . '</td>';
            echo '<td>' . $item->type . '</td>';
            echo '<td>' . $item->coa_code . '</td>';
            echo '<td>' . $item->coa_name . '</td>';
            echo '<td align="right">' . Formatter::formatNumber($item->nominal) . '</td>';
            echo '<td align="right">' . 0 . '</td>';
            echo '</tr>';
            $no++;
            $totalDebet += $item->nominal;
        }
        foreach ($credit as $item) {
            echo '<tr>';
            echo '<td>' . $no . '</td>';
            echo '<td>' . date('d-m-Y H:i', strtotime($item->created_time)) . '</td>';
            echo '<td>' . $item->description . '</td>';
            echo '<td>' . $item->type . '</td>';
            echo '<td>' . $item->coa_code . '</td>';
            echo '<td>' . $item->coa_name . '</td>';
            echo '<td align="right">' . 0 . '</td>';
            echo '<td align="right">' . Formatter::formatNumber($item->nominal) . '</td>';
            echo '</tr>';
            $no++;
            $totalCredit += $item->nominal;
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="6" style="text-align: right; color: blue;">Total</td>
            <td style="text-align: right; color: blue;"><?= Formatter::formatNumber($totalDebet) ?></td>
            <td style="text-align: right; color: blue;"><?= Formatter::formatNumber($totalCredit) ?></td>
        </tr>
        </tfoot>
    </table>
</div>