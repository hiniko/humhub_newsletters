<?php 
    use humhub\modules\newsletters\Assets;
    use humhub\modules\newsletters\widgets\Newsletter;
    use humhub\modules\newsletters\widgets\Subscribers;
    Assets::register($this);
?>
<div class="panel panel-default newsletter-panel">
   <div class="panel-heading">
        <strong><?= $space->name ?>'s </strong> Newsletter</h3>
   </div>
   <div class="panel-body">

       <div id="newsletter-container" style="display: none;">
            <ul id="newsletter-tabs" class="nav nav-tabs" data-tabs="tabs"> </ul>
            <div class="tab-content"></div>
            <div class="tab" data-name="Newsletter"> 
 
                <?= Newsletter::widget(
                    ['newsletter' => $newsletter, 
                     'subscription' => $subscription ]
                ); ?>
            </div>
                
       <?php // Only show this tab to admins 
            if ($space->isAdmin()): ?>
            <div class="tab" data-name="Subscribers">
                <?= Subscribers::widget(['space_id' => $space->id]); ?>
            </div>
       <?php endif; ?>

        </div>
   </div>
    <div id="newsletter-loader" class="loader">
        <div class="sk-spinner sk-spinner-three-bounce">
            <div class="sk-bounce1"></div>
            <div class="sk-bounce2"></div>
            <div class="sk-bounce3"></div>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function () {

        // save the tab to show
        var activeTab = 0;

        // go through all fieldsets with inputs (categories)
        $('#newsletter-container .tab').each(function (index, value) {
            // save category text
            var _category = $(this).attr('data-name');

            // build tab structure
            var _tab = '<li><a href="#category-' + index + '" data-toggle="tab">' + _category + '</a></li>';

            // add tab structure to tab
            $('#newsletter-tabs').append(_tab);

            // build tab content container
            var _tabContent = '<div class="tab-pane newsletter-tab" id="category-' + index + '"></div>';

            // add content to tab content container
            $('.tab-content').append(_tabContent);

            // clone every inputs from original form
            var $inputs = $(this).children().clone();

            // add cloned inputs to current tab content container
            $('#category-' + index).html($inputs);

            // remove original inputs from original form
            $(this).remove();

        })

        // activate the first tab or the tab with the first error
        $('#newsletter-tabs a[href="#category-' + activeTab + '"]').tab('show');

        // hide loader
        $('#newsletter-loader').hide();

        // show created tab element
        $('#newsletter-container').show();


    })
</script>
