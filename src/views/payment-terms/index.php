<?php

$this->title  =  'Payment Terms';

$this->params['buttons'] = [
    ['label' => 'Create payment-terms', 'url' => ['create'], 'linkOptions' => ["class" => "showModalButton btn btn-sm btn-default", "title" => Yii::t('app', 'Create payment-terms')],],
    ];

?>
<div class="payment-terms-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


        <?php $columns = [
            //['class' => 'kartik\grid\SerialColumn'],
            'id',
            'name',
    ['class' => 'kartik\grid\ActionColumn'],
    ];

    require(Yii::getAlias('@app/views/layouts/grid_layout.php'));
?>
</div>
