<?php

//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model stesi\invoice\models\Invoice */
/*
$this->title = $model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'invoice_view_breadcrumbs.Index'), 'url' => ["index"]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/breadcrumbs', 'view_breadcrumbs.Id').$model->id, 'url' => ["view", "id" => $model->id]];
$this->params['buttons'] = [
    ['label' => Yii::t('invoice/invoice/buttons', 'invoice_buttons.view.update_invoice'), 'url' => ['update', "id" => $model->id], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-primary", "title" => Yii::t('invoice/invoice/titles', 'invoice_titles.update_invoice')]],
    ['label' => Yii::t('invoice/invoice/buttons', 'invoice_buttons.view.delete_invoice'), 'url' => ['delete', "id" => $model->id], 'linkOptions' => ["class" => "btn btn-sm btn btn-danger", "title" => Yii::t('invoice/invoice/titles', 'invoice_titles.delete_invoice'),
    'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
    ]]]
];

?>
<div class="invoice-view col-md-12">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'organization_from_id',
            'organization_to_id',
            'status',
            'invoice_type',
            'preamble',
            'number',
            'year',
            'invoice_date',
            'competence_date',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'payment_terms_id',
            'note:ntext',
            'subtotal',
            'tax',
            'total',
        ],
    ]) ?>

</div>
*/
?>


<div class="padding-10">
    <br>
    <div class="pull-left">
        <img src="img/logo-blacknwhite.png" alt="invoice icon" width="150" height="32">

        <address>
            <br>
            <strong>SmartAdmin, Inc.</strong>
            <br>
            231 Ajax Rd,
            <br>
            Detroit MI - 48212, USA
            <br>
            <abbr title="Phone">P:</abbr> (123) 456-7890
        </address>
    </div>
    <div class="pull-right">
        <h1 class="font-400">invoice</h1>
    </div>
    <div class="clearfix"></div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-9">
            <h4 class="semi-bold">Rogers, Inc.</h4>
            <address>
                <strong>Mr. Simon Hedger</strong>
                <br>
                342 Mirlington Road,
                <br>
                Calfornia, CA 431464
                <br>
                <abbr title="Phone">P:</abbr> (467) 143-4317
            </address>
        </div>
        <div class="col-sm-3">
            <div>
                <div>
                    <strong>INVOICE NO :</strong>
                    <span class="pull-right"> #AA-454-4113-00 </span>
                </div>

            </div>
            <div>
                <div class="font-md">
                    <strong>INVOICE DATE :</strong>
                    <span class="pull-right"> <i class="fa fa-calendar"></i> 15/02/13 </span>
                </div>

            </div>
            <br>
            <div class="well well-sm  bg-color-darken txt-color-white no-border">
                <div class="fa-lg">
                    Total Due :
                    <span class="pull-right"> 4,972 USD** </span>
                </div>

            </div>
            <br>
            <br>
        </div>
    </div>
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center">QTY</th>
            <th>ITEM</th>
            <th>DESCRIPTION</th>
            <th>PRICE</th>
            <th>SUBTOTAL</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="text-center"><strong>1</strong></td>
            <td><a href="javascript:void(0);">Print and Web Logo Design</a></td>
            <td>Perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium totam rem
                aperiam xplicabo.
            </td>
            <td>$1,300.00</td>

            <td>$1,300.00</td>
        </tr>
        <tr>
            <td class="text-center"><strong>1</strong></td>
            <td><a href="javascript:void(0);">SEO Management</a></td>
            <td>Sit voluptatem accusantium doloremque laudantium inventore veritatis et quasi architecto beatae vitae
                dicta sunt explicabo.
            </td>
            <td>$1,400.00</td>
            <td>$1,400.00</td>
        </tr>
        <tr>
            <td class="text-center"><strong>1</strong></td>
            <td><a href="javascript:void(0);">Backend Support and Upgrade</a></td>
            <td>Inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</td>
            <td>$1,700.00</td>
            <td>$1,700.00</td>
        </tr>
        <tr>
            <td colspan="4">Total</td>
            <td><strong>$4,400.00</strong></td>
        </tr>
        <tr>
            <td colspan="4">HST/GST</td>
            <td><strong>13%</strong></td>
        </tr>
        </tbody>
    </table>

    <div class="invoice-footer">

        <div class="row">

            <div class="col-sm-7">
                <div class="payment-methods">
                    <h5>Payment Methods</h5>
                    <img src="img/invoice/paypal.png" alt="paypal" width="64" height="64">
                    <img src="img/invoice/americanexpress.png" alt="american express" width="64" height="64">
                    <img src="img/invoice/mastercard.png" alt="mastercard" width="64" height="64">
                    <img src="img/invoice/visa.png" alt="visa" width="64" height="64">
                </div>
            </div>
            <div class="col-sm-5">
                <div class="invoice-sum-total pull-right">
                    <h3><strong>Total: <span class="text-success">$4,972 USD</span></strong></h3>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-sm-12">
                <p class="note">**To avoid any excess penalty charges, please make payments within 30 days of the due
                    date. There will be a 2% interest charge per month on all late invoices.</p>
            </div>
        </div>

    </div>
</div>

