<?php
    use yii\helpers\Html;
    use humhub\widgets\GridView;
    /*
     * Display Subscribe button if the user is *not* subscribed to this spaces
     * newsletter. Show unsubscribe button other wise.
     */
    
?>

        <?php
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'user.username',
                'user.email',
                [
                    'header' => 'Actions',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{unsubscribe}',
                    'options' => ['style' => 'width:80px; min-width:80px;'],
                    'buttons' => [
                        'unsubscribe' => function($url, $model) {
                            return Html::a('<i class="fa fa-close"></i>', $model->getUnsubscribeURL(), ['class' => 'btn btn-primary btn-xs tt']);
                        },
                            ],
                        ],
                    ],
                ]);
                ?>
