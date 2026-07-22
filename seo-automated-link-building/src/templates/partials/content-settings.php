<table class="form-table">
    <tbody>

    <tr>
        <th><?php esc_html_e( 'Post types', 'seo-automated-link-building' ); ?></th>
        <td>
            <p class="posttypes-chooser"><?php esc_html_e( 'Choose from', 'seo-automated-link-building' ); ?>: <?php echo wp_kses_post( join( ', ',
				    array_map( function ( $item ) {
					    return '<code class=\'post-type-option\'>' . esc_html( $item ) . '</code>';
				    }, $availablePostTypes ) ) ); ?></p>
            </p>
            <textarea rows="5" name="posttypes"
                      placeholder="<?php esc_attr_e( 'Post types', 'seo-automated-link-building' ); ?>"><?php echo esc_textarea( $postTypes ); ?></textarea>
            <p class="description">
                <?php esc_html_e( 'Post types are used by Wordpress to classify different kinds of content.', 'seo-automated-link-building' ); ?><br>
                <?php esc_html_e( 'Provide posttypes for which links should be set. One Post type per line. Optional.', 'seo-automated-link-building' ); ?><br>
                <?php esc_html_e( 'If unsure, leave empty and links will be set in all post types.', 'seo-automated-link-building' ); ?>
            </p>
        </td>
    </tr>

    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Process excerpts', 'seo-automated-link-building' ); ?></th>
        <td>
            <label>
                <input type="checkbox" disabled="disabled" />
			    <?php esc_html_e( 'Add links to excerpts', 'seo-automated-link-building' ); ?>
            </label>
        </td>
    </tr>

    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Category selection', 'seo-automated-link-building' ); ?></th>
        <td>
            <select id="categories-mode">
                <option value="all" selected="selected"><?php esc_html_e( 'Set links in all categories', 'seo-automated-link-building' ); ?></option>
                <option value="include"><?php esc_html_e( 'Set links only in certain categories', 'seo-automated-link-building' ); ?></option>
                <option value="exclude"><?php esc_html_e( 'Exclude certain categories', 'seo-automated-link-building' ); ?></option>
            </select>
            <p class="description"><?php esc_html_e( 'Please specify whether the link should be restricted to certain categories.', 'seo-automated-link-building' ); ?></p>
        </td>
    </tr>
    <tr id="categories-selection" style="display:none" class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th>
            <span id="included-categories-label"><?php esc_html_e( 'Include categories', 'seo-automated-link-building' ); ?></span>
            <span id="excluded-categories-label"><?php esc_html_e( 'Exclude categories', 'seo-automated-link-building' ); ?></span>
        </th>
        <td>
            <div class="category-list">
                <?php
                wp_terms_checklist(0, [
                        'taxonomy'      => 'category',
                        'selected_cats' => [],
                        'checked_ontop' => false,
                        'walker'        => new class extends Walker_Category_Checklist {
                            public function start_el( &$output, $term, $depth = 0, $args = [], $id = 0 ) {
                                // eigener Name aus $args
                                $level = 'level-' . (int) $depth;

                                $output .= '<li class="' . esc_attr($level) . '">';
                                $output .= sprintf(
                                        '<label><input type="checkbox" value="%d"%s> %s</label>',
                                        (int) $term->term_id,
                                        checked(in_array($term->term_id, (array) $args['selected_cats'], true), true, false),
                                        esc_html($term->name)
                                );
                            }
                        },
                ]);
                ?>
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
        </td>
    </tr>

    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Category descriptions', 'seo-automated-link-building' ); ?></th>
        <td>
            <label>
                <input type="checkbox" disabled="disabled">
                <?php esc_html_e( 'Add links to category descriptions', 'seo-automated-link-building' ); ?>
            </label>
        </td>
    </tr>

    <?php
	    $customFields = [
            __('Custom field', 'seo-automated-link-building') . ' 1',
            __('Custom field', 'seo-automated-link-building') . ' 2',
            __('Custom field', 'seo-automated-link-building') . ' 3',
        ];
    ?>
    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Custom Fields', 'seo-automated-link-building' ); ?></th>
        <td>
            <div class="checkbox-list">
		    <?php foreach ( $customFields as $field ): ?>
                <label>
                    <input type="checkbox" disabled="disabled"> <?php echo esc_html( $field ); ?>
                </label><br>
		    <?php endforeach; ?>
            </div>
            <p class="description"><?php esc_html_e( 'Please select the custom fields in which links should be created automatically', 'seo-automated-link-building' ); ?></p>
        </td>
    </tr>
    </tbody>
</table>
