<div class="ilm-card">
    <div class="ilm-card__head">
        <?php esc_html_e( 'Post types', 'seo-automated-link-building' ); ?>
    </div>
    <div class="ilm-field">
        <p class="posttypes-chooser"><?php esc_html_e( 'Choose from', 'seo-automated-link-building' ); ?>: <?php echo wp_kses_post( join( ', ',
			    array_map( function ( $item ) {
				    return '<code class=\'post-type-option\'>' . esc_html( $item ) . '</code>';
			    }, $availablePostTypes ) ) ); ?></p>
        <textarea rows="4" name="posttypes"
                  placeholder="<?php esc_attr_e( 'Post types', 'seo-automated-link-building' ); ?>"><?php echo esc_textarea( $postTypes ); ?></textarea>
        <p class="description">
            <?php esc_html_e( 'Post types are used by Wordpress to classify different kinds of content.', 'seo-automated-link-building' ); ?><br>
            <?php esc_html_e( 'Provide posttypes for which links should be set. One Post type per line. Optional.', 'seo-automated-link-building' ); ?><br>
            <?php esc_html_e( 'If unsure, leave empty and links will be set in all post types.', 'seo-automated-link-building' ); ?>
        </p>
    </div>
</div>

<div class="ilm-card">
    <div class="ilm-card__head">
        <?php esc_html_e( 'More content sources', 'seo-automated-link-building' ); ?>
    </div>

    <div class="ilm-prorow">
        <div>
            <span class="ilm-prorow__main">
                <?php esc_html_e( 'Process excerpts', 'seo-automated-link-building' ); ?>
            </span>
            <p class="ilm-prorow__desc"><?php esc_html_e( 'Add links to excerpts', 'seo-automated-link-building' ); ?></p>
        </div>
        <span class="ilm-pro"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
    </div>

    <div class="ilm-prorow">
        <div>
            <span class="ilm-prorow__main">
                <?php esc_html_e( 'Category descriptions', 'seo-automated-link-building' ); ?>
            </span>
            <p class="ilm-prorow__desc"><?php esc_html_e( 'Add links to category descriptions', 'seo-automated-link-building' ); ?></p>
        </div>
        <span class="ilm-pro"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
    </div>

    <div class="ilm-prorow">
        <div>
            <span class="ilm-prorow__main">
                <?php esc_html_e( 'Custom Fields', 'seo-automated-link-building' ); ?>
            </span>
            <p class="ilm-prorow__desc"><?php esc_html_e( 'Please select the custom fields in which links should be created automatically', 'seo-automated-link-building' ); ?></p>
        </div>
        <span class="ilm-pro"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
    </div>
</div>

<div class="ilm-card">
    <div class="ilm-card__head">
        <?php esc_html_e( 'Category selection', 'seo-automated-link-building' ); ?>
        <span class="ilm-pro" style="margin-left:auto"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
    </div>

    <div class="ilm-field disabled">
        <select id="categories-mode">
            <option value="all" selected="selected"><?php esc_html_e( 'Set links in all categories', 'seo-automated-link-building' ); ?></option>
            <option value="include"><?php esc_html_e( 'Set links only in certain categories', 'seo-automated-link-building' ); ?></option>
            <option value="exclude"><?php esc_html_e( 'Exclude certain categories', 'seo-automated-link-building' ); ?></option>
        </select>
        <p class="description"><?php esc_html_e( 'Please specify whether the link should be restricted to certain categories.', 'seo-automated-link-building' ); ?></p>
    </div>

    <div class="ilm-field disabled" id="categories-selection" style="display:none">
        <span class="ilm-label">
            <span id="included-categories-label"><?php esc_html_e( 'Include categories', 'seo-automated-link-building' ); ?></span>
            <span id="excluded-categories-label"><?php esc_html_e( 'Exclude categories', 'seo-automated-link-building' ); ?></span>
        </span>
        <div class="ilm-category-list">
            <?php echo \SeoAutomatedLinkBuilding\TemplateHelper::categoryChecklist( 'content[selectedCategories][]', [], true ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- categoryChecklist() escaped selbst. ?>
        </div>
        <script type="application/javascript">
            jQuery(function ($) {
                $('#categories-mode').change(function(){
                    let selected = ($(this).val());
                    if (selected === 'all') {
                        $('#categories-selection').hide();
                    } else {
                        $('#categories-selection').show();
                        if (selected === 'include') {
                            $('#included-categories-label').show();
                            $('#excluded-categories-label').hide();
                        } else {
                            $('#included-categories-label').hide();
                            $('#excluded-categories-label').show();
                        }
                    }
                });
            });
        </script>
    </div>
</div>
