<?php 
    use humhub\modules\newsletters\widgets\Subscribe;
    /*
     * If there is no newsletter for this space
     */
    if($newsletter == null) {
?>

    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <p>
            <strong>Sorry!</strong> but <?= $space->name ?>'s newsletter is not
            ready just yet! 
            </p>
        </div>
        <div class="col-sm-1"></div>
    </div>

<?php 
    }else{
    /*
     * Show the newsletter for this space
     */
?>
    <div class="row">
        <div class="col-sm-4 newsletter-info"><strong>Frequency:</strong> <?= $newsletter->getFrequencyLabel(); ?></div>
        <div class="col-sm-4 newsletter-info"><strong>Subscribers:</strong> <?= $newsletter->getSubscriberCount() ?> subscribers</div>
        <div class="col-sm-4 newsletter-info">
        <?php echo Subscribe::widget([
            'subscription' => $subscription,
            'newsletter' => $newsletter,
        ]);?>
        </div>
        <hr />
    </div>
    <div class="row">
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
           <h4>About:</h4> 
        </div>
        <div class="col-sm-5"></div>
    </div>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
        <p>
        <?= $newsletter->description ?>
        </p>
        </div>
        <div class="col-sm-1"></div>
    </div>
<?php 
    } 
?>
