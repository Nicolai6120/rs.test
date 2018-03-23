<?php

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $errorMessage string */

use yii\grid\GridView;
use yii\bootstrap\Alert;

$this->title = 'Resultant test';
?>

<?php \yii\widgets\Pjax::begin([
    'id' => 'data-grid',
    'timeout' => 10000,
]); ?>

<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-8">

                <?php if (!isset($errorMessage)) : ?>

                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns'=>[
                            [
                                'attribute' => 'name',
                                'label' => 'Название валюты',
                                'format' => 'raw',
                                'contentOptions' => ['class' => 'height:50px !important;'],
                            ],
                            [
                                'attribute' => 'volume',
                                'format' => 'raw',
                                'label' => 'Цена',
                                'contentOptions' => ['class' => 'height:50px !important;'],
                            ],
                            [
                                'attribute' => 'price',
                                'format' => 'raw',
                                'label' => 'Количество',
                                'value'=>function ($data) {
                                    $amount = $data['price']['amount'];
                                    return number_format((float)$amount, 2, '.', '');
                                },
                                'contentOptions' => ['style' => 'height:50px !important;'],
                            ],
                        ],
                    ]); ?>

                <?php else : ?>

                    <div class="site-notification">
                        <?= Alert::widget([
                            'options' => ['class' => 'alert-danger'],
                            'body' => $errorMessage
                        ]); ?>
                    </div>

                    <?= \yii\bootstrap\Html::img('/img/doh.jpg', ['class' => 'homer-doh']); ?>

                <?php endif; ?>

            </div>


            <div class="site-sidebar col-lg-3 col-lg-offset-1">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-body bg-default">
                            <a href="/" id="refresh-btn" class="btn btn-success">
                                <span class="glyphicon glyphicon-refresh"></span> Обновить
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?php \yii\widgets\Pjax::end(); ?>
