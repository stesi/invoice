<?php

use app\services\AdministrationTools;
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $model stesi\billing\models\Invoice */

$this->title = $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'invoice_view_breadcrumbs.Index'), 'url' => ["index"]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'view_breadcrumbs.Id') . $model->id, 'url' => ["view", "id" => $model->id]];
$this->params['buttons'] = [
    ['label' => Yii::t('billing/invoice/buttons', 'invoice_buttons.view.update_invoice'), 'url' => ['update', "id" => $model->id], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-primary", "title" => Yii::t('billing/invoice/titles', 'invoice_titles.update_invoice')]],
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
        <h1 class="font-400"><?= $model->invoice_type; ?></h1>
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
                    <span class="pull-right"><?= (isset($model->paymentTerms->name)) ? $model->paymentTerms->name : ""; ?> </span>
                </div>

            </div>
            <br>
            <div class="well well-sm  bg-color-darken txt-color-white no-border">
                <div class="fa-lg">
                    Total:
                    <span class="pull-right"><?= AdministrationTools::toMoney($model->total,2); ?></span>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ITEM</th>
            <th>DESCRIPTION</th>
            <th class="text-center">QTY</th>
            <th>UNIT PRICE</th>
            <th>VAT</th>
            <th>TAXABLE</th>
            <th>DISCOUNT</th>
            <th>SUBTOTAL</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $total_taxable = 0;
        $total_tax = 0;
        $total_discount = 0;
        $sub_total=0;
        $total = 0;

        foreach ($model->invoiceRows as $row) {
            ?>
            <tr>
                <td><?= $row->product->code; ?></td>
                <td><?= $row->description; ?></td>
                <td class="text-center"><?= $row->quantity; ?></td>
                <td><?= $row->unit_price; ?></td>
                <td><?= $row->vat_value . " %"; ?></td>
                <td><?= $row->taxable; ?></td>
                <td><?= $row->discount . " %"; ?></td>
                <td><?= $row->total_row; ?></td>
            </tr>

            <?php
            $total_taxable += $row->taxable;
            $total_tax += $row->tax;
            $total_row = $row->taxable + $row->tax;
            $sub_total +=$total_row;
            $total_discount += $total_row * $row->discount / 100;
            $total += $row->total_row;

        } ?>
        </tbody>
    </table>

    <div class="invoice-footer">
        <hr class="nomargin-top"/>

        <div class="row">

            <div class="col-sm-3 pull-right">
                <div>
                    <div>
                        <strong>Taxable:</strong>
                        <span class="pull-right"> <?= AdministrationTools::toMoney($total_taxable,2); ?></span>
                    </div>

                </div>
                <div>
                    <div>
                        <strong>VAT ($6):</strong>
                        <span class="pull-right"><?= AdministrationTools::toMoney($total_tax,2); ?></span>
                    </div>

                </div>
                <div>
                    <div>
                        <strong>Sub-Total:</strong>
                        <span class="pull-right"><?= AdministrationTools::toMoney($sub_total,2); ?></span>
                    </div>

                </div>
                <div>
                    <div>
                        <strong>Discount:</strong>
                        <span class="pull-right"><?= AdministrationTools::toMoney($total_discount,2); ?></span>
                    </div>

                </div>
                <div>
                    <div class="font-md">
                        <strong>Total:</strong>
                        <span class="pull-right"><?= AdministrationTools::toMoney($total,2); ?></span>
                    </div>

                </div>
                <br>

                <br>
                <br>
            </div>


        </div>


    </div>
</div>

