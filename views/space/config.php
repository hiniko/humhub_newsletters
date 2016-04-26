<?php 
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use humhub\modules\newsletters\Assets;
    use humhub\modules\newsletters\models\Newsletter;
    Assets::register($this);
?>
<div class="panel panel-default newsletter-panel">
   <div class="panel-heading">
        <strong>Configure</strong>  <?= $space->name ?>'s Newsletter</h3>
   </div>
   <div class="panel-body">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
            <?php $form = ActiveForm::Begin(); ?>

            <?= $form->field($newsletter, 'name')
                     ->label("Newsletter Name");
            ?>
            <?= $form->field($newsletter, 'description')
                     ->textArea(['rows' => 15, 'maxlength' => 2000])
                     ->hint('Describe ' . $space->name . '\'s Newsletter. 2000 leters max')
                     ->label('Newsletter Description');
            ?>
            <?= $form->field($newsletter, 'frequency')
                     ->dropDownList(Newsletter::frequencies())
                     ->label('Newsletter Frequency');
            ?>
            <?= Html::SubmitButton('Save', ['class' => 'btn btn-primary']); ?>
            <?php 

                $button = Html::tag('i', '', ['class' => 'fa fa-close']);
                echo Html::a($button . ' Delete Newsletter', 
                [
                    '/newsletters/space/delete', 
                    'id' => $newsletter->id,
                ],
                [
                    'class' => 'btn btn-danger pull-right',
                ]);

            ?>
            <?php ActiveForm::end(); ?>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</div>
