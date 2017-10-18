<?php

use app\services\AdministrationTools;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model stesi\billing\models\Invoice */

$this->title = $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'invoice_view_breadcrumbs.Index'), 'url' => ["index"]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'view_breadcrumbs.Id') . $model->id, 'url' => ["view", "id" => $model->id]];
$this->params['buttons'] = [
    ['label' => Yii::t('billing/invoice/buttons', 'invoice_buttons.view.update_invoice'), 'url' => ['update', "id" => $model->id ], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-primary", "title" => Yii::t('billing/invoice/titles', 'invoice_titles.update_invoice')]],
    ['label' => Yii::t('billing/invoice/buttons', 'invoice_buttons.view.delete_invoice'), 'url' => ['delete', "id" => $model->id], 'linkOptions' => ["class" => "btn btn-sm btn btn-danger", "title" => Yii::t('billing/invoice/titles', 'invoice_titles.delete_invoice'),
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ]]]
];

?>


<div class="padding-10">
    <br>
    <div class="pull-left">

        <?php echo isset($model->organizationFrom) ? $image = Html::img($model->organizationFrom->getThumbUploadUrl('logo', 'news_thumb'), ['class' => 'img-thumbnail']) : ""; ?>

        <address>
            <br>
            <strong><?= isset($model->organizationFrom) ? $model->organizationFrom->name : "My Organization"; ?></strong>
            <br>
            231 Ajax Rd,
            <br>
            Detroit MI - 48212, USA
            <br>
            <abbr title="Phone">P:</abbr><?= $model->getPhoneOrganizationFrom(); ?>
        </address>
    </div>
    <div class="pull-right">
        <h1 class="font-400"><?= (isset($model->invoiceType->type)) ? $model->invoiceType->type : ""; ?></h1>
    </div>
    <div class="clearfix"></div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-9">
            <h4 class="semi-bold"><?= isset($model->organizationTo) ? $model->organizationTo->name : "Organization Customer"; ?></h4>
            <address>
                <strong><?= $model->getReferentOrganizationTo(); ?></strong>
                <br>
                342 Mirlington Road,
                <br>
                Calfornia, CA 431464
                <br>
                <abbr title="Phone">P:</abbr><?= $model->getPhoneOrganizationTo(); ?>
            </address>
        </div>
        <div class="col-sm-3">
            <div>
                <div class="font-md">
                    <strong>INVOICE N. :</strong>
                    <span class="pull-right"> <?= $model->preamble . " - " . $model->number; ?></span>
                </div>

            </div>
            <div>
                <div class="font-md">
                    <strong>INVOICE DATE :</strong>
                    <span class="pull-right"><?= (new \DateTime($model->invoice_date))->format("d-m-Y") ?> </span>
                </div>

            </div>
            <div>
                <div>
                    <strong>COMPETENCE DATE :</strong>
                    <span class="pull-right"><?= (new \DateTime($model->competence_date))->format("d-m-Y") ?> </span>
                </div>

            </div>
            <div>
                <div>
                    <strong>PAYMENT TERM :</strong>
                    <span class="pull-right"><?= (isset($model->payment_terms)) ? $model->payment_terms : ""; ?> </span>
                </div>

            </div>
            <br>
            <div class="well well-sm  bg-color-darken txt-color-white no-border">
                <div class="fa-lg">
                    Total:
                    <span class="pull-right"><?= AdministrationTools::toMoney($model->total, 2); ?></span>
                </div>

            </div>
            <br>
            <br>
        </div>
        <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-1">
                <span class="label bg-color-darken txt-color-white">Object</span>
            </div>
            <div class="col-sm-11">
                <?= (isset($model->object)) ? $model->object : ""; ?>
            </div>
        </div>
        <div class="col-sm-12">
            <br>
            <br>
            <div class="col-sm-1">
                <span class="label bg-color-darken txt-color-white">Notes</span>
            </div>
            <div class="col-sm-11">
                <?= (isset($model->note)) ? $model->note : ""; ?>
            </div>
            <br>
            <br>
        </div>
        </div>
    </div>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>ITEM</th>
            <th>DESCRIPTION</th>
            <th class="text-center">QTY</th>
            <th>UNIT PRICE</th>
            <th>TAXABLE</th>
            <th>DISCOUNT</th>
            <th>VAT</th>
            <th>TOTAL ROW</th>

        </tr>
        </thead>
        <tbody>

        <?php
        $arrayTotals = array();

        $total_taxable = 0;
        $total_discount = 0;
        $sub_total = 0; //totali con sconto senza iva
        $total_tax = 0;
        $total = 0; //totale fattura

        foreach ($model->invoiceRows as $row) {
            ?>
            <tr>
                <td><?= $row->product->code; ?></td>
                <td><?= $row->description; ?></td>
                <td class="text-center"><?= $row->quantity; ?></td>
                <td><?= $row->unit_price; ?></td>
                <td><?= $row->taxable; ?></td>
                <td><?= $row->discount . " %"; ?></td>
                <td><?= $row->vat_value . " %"; ?></td>
                <td><?= $row->total_row; ?></td>
            </tr>

            <?php
            if (empty($arrayTotals)) {
                $arrayTotals = [
                    $row->vat_id => [
                        'total_taxable' => $row->taxable,
                        'total_discount' => $row->taxable * $row->discount / 100,
                        'sub_total' => $row->taxable - ($row->taxable * $row->discount / 100),
                        'total_tax' => $row->tax,
                        'total' => ($row->taxable - ($row->taxable * $row->discount / 100)) + $row->tax,
                        'vat_value' => $row->vat_value,
                        'vat_code'=>$row->vat->code
                    ]
                ];
            } else {
                if(array_key_exists($row->vat_id,$arrayTotals)){

                    $total_taxable=$arrayTotals[$row->vat_id]['total_taxable'];
                    $total_discount=$arrayTotals[$row->vat_id]['total_discount'];
                    $sub_total=$arrayTotals[$row->vat_id]['sub_total'];
                    $total_tax=$arrayTotals[$row->vat_id]['total_tax'];
                    $total=$arrayTotals[$row->vat_id]['total'];

                    $arrayTotals[$row->vat_id]['total_taxable']= $total_taxable + ($row->taxable);
                    $arrayTotals[$row->vat_id]['total_discount']= $total_discount + ($row->taxable * $row->discount / 100);
                    $arrayTotals[$row->vat_id]['sub_total']= $sub_total + ($row->taxable - ($row->taxable * $row->discount / 100));
                    $arrayTotals[$row->vat_id]['total_tax']= $total_tax + ($row->tax);
                    $arrayTotals[$row->vat_id]['total']= $total + (($row->taxable - ($row->taxable * $row->discount / 100)) + $row->tax);

                } else {

                    $arrayTotals[$row->vat_id] = [
                        'total_taxable' => $row->taxable,
                        'total_discount' => $row->taxable * $row->discount / 100,
                        'sub_total' => $row->taxable - ($row->taxable * $row->discount / 100),
                        'total_tax' => $row->tax,
                        'total' => ($row->taxable - ($row->taxable * $row->discount / 100)) + $row->tax,
                        'vat_value' => $row->vat_value,
                        'vat_code'=>$row->vat->code
                    ];

                }

            }


            $total_taxable += $row->taxable;
            $total_discount += $row->taxable * $row->discount / 100;

            $sub_total += $row->taxable - ($row->taxable * $row->discount / 100);

            $total_tax += $row->tax;

            $total += ($row->taxable - ($row->taxable * $row->discount / 100)) + $row->tax;

        } ?>
        </tbody>
    </table>

    <div class="invoice-footer">
        <hr class="nomargin-top"/>

      <!--  <div class="row">

            <div class="col-sm-3 pull-right">
                <div>
                    <div>
                        <strong>Taxable:</strong>
                        <span class="pull-right"> <?/*= AdministrationTools::toMoney($total_taxable, 2); */?></span>
                    </div>

                </div>
                <div>
                    <div>
                        <strong>Discount:</strong>
                        <span class="pull-right"><?/*= AdministrationTools::toMoney($total_discount, 2); */?></span>
                    </div>

                </div>
                <div>
                    <div>
                        <strong>Sub-Total:</strong>
                        <span class="pull-right"><?/*= AdministrationTools::toMoney($sub_total, 2); */?></span>
                    </div>

                </div>
                <div>
                    <div>
                        <strong>VAT ($6):</strong>
                        <span class="pull-right"><?/*= AdministrationTools::toMoney($total_tax, 2); */?></span>
                    </div>

                </div>
                <div>
                    <div class="font-md">
                        <strong>Total:</strong>
                        <span class="pull-right"><?/*= AdministrationTools::toMoney($total, 2); */?></span>
                    </div>

                </div>
                <br>

                <br>
                <br>
            </div>


        </div>-->


        <div class="well">
            <table class="table table-hover">
                <thead class="bordered-primary">
                <tr>
                    <th class="col-sm-2 ">Assoggettamento</th>
                    <th class="col-sm-2 text-right">Aliquota</th>
                    <th class="col-sm-2 text-right">Imponibile</th>
                    <th class="col-sm-2 text-right">Sconto</th>
                    <th class="col-sm-2 text-right">Iva</th>
                    <th class="col-sm-1 text-right">Valuta</th>
                    <th class="col-sm-2 text-right">Totale</th>

                </tr>
                </thead>
                <tbody>

                <?php

                if (!empty($arrayTotals)) {

                    foreach ($arrayTotals as $diffVatTotal) {
                        ?>

                        <tr>

                            <td><?php echo $diffVatTotal['vat_code']?></td>
                            <td class='text-right'><?php echo AdministrationTools::toMoney($diffVatTotal['vat_value'], 2) ?>%</td>
                            <td class='text-right'><?php echo AdministrationTools::toMoney($diffVatTotal['total_taxable'], 2) ?></td>
                            <td class='text-right'><?php echo AdministrationTools::toMoney($diffVatTotal['total_discount'], 2) ?></td>
                            <td class='text-right'><?php echo AdministrationTools::toMoney($diffVatTotal['total_tax'], 2) ?></td>
                            <td></td>
                            <td></td>

                        </tr>
                        <?php
                    }
                } ?>
                <tr class="bordered-primary">
                    <td colspan='2'><b>TOTALE</b></td>
                    <td class='text-right'><b><?php echo AdministrationTools::toMoney($total_taxable, 2) ?></b></td>
                    <td class='text-right'><b><?php echo AdministrationTools::toMoney($total_discount, 2) ?></b></td>
                    <td class='text-right'><b><?php echo AdministrationTools::toMoney($total_tax, 2) ?></b></td>
                    <td class="text-right"><b>Euro</b></td>
                    <td class='text-right'><b><?php echo AdministrationTools::toMoney($total, 2) ?></b></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

