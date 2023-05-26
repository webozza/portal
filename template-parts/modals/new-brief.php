<?php
    $client_overviews = array(
        'numberposts'   => -1,
        'post_type'     => 'client-overview',
        'meta_key'      => 'status',
        'meta_value'    => 'Approved'
    );
    $clientoverview = new WP_Query($client_overviews);
    //var_dump($clientoverview);
?>

<div class="cure-modal new-brief hidden" style="display:none" data-modal="new-brief">
    <div class="inner">
        <div class="cure-modal-header">
            <h3>New Brief</h3>
            <a class="close-modal" href="javascript:void(0)"><img src="<?= get_template_directory_uri() . '/img/icons/close.png' ?>"></a>
        </div>
        <div class="cure-modal-body">
            <form id="new-brief" method="GET" action="">
                <div class="cure-field-group">
                    <label>Select Client</label>
                    
                    <select class="nb-select-client has-select2">
                        <?php if( $clientoverview->have_posts() ): ?>
                            <?php while( $clientoverview->have_posts() ) : $clientoverview->the_post(); ?>
                                <option>
                                    <?php the_field('prepared_for') ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    <?php wp_reset_query(); ?>
                    </select>
                </div>
                <div class="cure-field-group">
                    <label>Select Template</label>
                    <select class="nb-select-template has-select2">
                        <option>Advertising</option>
                        <option>Design</option>
                        <option>WordPress</option>
                    </select>
                </div>
                <div class="cure-field-group">
                    <label>Drafts date</label>
                    <input class="nb-drafts-date" type="date" value="">
                </div>
                <div class="cure-field-group">
                    <label>Delivery date</label>
                    <input class="nb-delivery-date" type="date" value="">
                </div>
                <div class="cure-field-group">
                    <label>In-market date</label>
                    <input class="nb-in-market-date" type="date" value="">
                </div>
                <div class="cure-field-group hidden">
                    <input type="hidden" name="client" value="">
                    <input type="hidden" name="template" value="">
                    <input type="hidden" name="drafts_date" value="">
                    <input type="hidden" name="delivery_date" value="">
                    <input type="hidden" name="in_market_date" value="">
                    <input type="hidden" name="new-brief" value="1">
                    <input type="submit" class="hidden">
                </div>
                <p class="error-msg">You missed something..</p>
            </form>
        </div>
        <div class="cure-modal-footer">
            <div class="modal-btn-wrapper">
                <a class="btn-cure-secondary btn-close" href="javascript:void(0)">Cancel</a>
                <a class="btn-cure modal-submit" href="javascript:void(0)">Create</a>
            </div>
        </div>
    </div>
</div>