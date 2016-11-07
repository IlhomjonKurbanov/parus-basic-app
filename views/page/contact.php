<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
?>

<div class="page page-contact">
    
    <div class="section-heading">
        <h3 class="section-heading-title">
            <?= $this->title ?>
        </h3>
    </div>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

        <p>
            Note that if you turn on the Yii debugger, you should be able
            to view the mail message on the mail panel of the debugger.
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                Because the application is in development mode, the email is not sent but saved as
                a file under <code><?= Yii::getAlias(Yii::$app->mailer->fileTransportPath) ?></code>.
                Please configure the <code>useFileTransport</code> property of the <code>mail</code>
                application component to be false to enable email sending.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <div class="row">
            <div class="col-md-8">
                <div id="map-canvas"></div>
            </div>
            <div class="col-md-4">
                <p>
                    If you have business inquiries or other questions, please fill out the following form to contact us.
                    Thank you.
                </p>
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'subject') ?>
                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

    <?php endif; ?>
</div>

<style>
    #map-canvas {
        height: 500px;
        width: 100%;
        margin-bottom: 35px;
    }
</style>


<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script>
window.onload = function() {
    
    var myLatlng = new google.maps.LatLng(56.949949,24.105422);

    var myOptions = {
        center: myLatlng,
        zoom: 10,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
    };

    var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
        
    var marker = new google.maps.Marker({
    position: myLatlng,
    title:'Riga, Latvia'
    });

    marker.setMap(map);
    
    var contentString1 = "<div id='contact-info-window'>Riga, Latvia</div>";
    var infowindow = new google.maps.InfoWindow({ content: contentString1 });
    infowindow.open(map,marker);
    
}
</script>