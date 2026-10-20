<div class="ilm-card">
    <div class="ilm-card__head">
        WooCommerce
        <span class="ilm-pro" style="margin-left:auto"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
    </div>
    <div class="ilm-field disabled">
        <span class="ilm-label"><?php esc_html_e( 'Selection', 'seo-automated-link-building' ); ?></span>
        <div class="ilm-optionlist">
            <label>
                <input type="checkbox" disabled="disabled"> <span><?php esc_html_e( 'Add links to products short description', 'seo-automated-link-building' ); ?></span>
            </label>
            <label>
                <input type="checkbox" disabled="disabled"> <span><?php esc_html_e( 'Add links to category description', 'seo-automated-link-building' ); ?></span>
            </label>
            <label>
                <input type="checkbox" disabled="disabled"> <span><?php esc_html_e( 'Add links to product tag description', 'seo-automated-link-building' ); ?></span>
            </label>
        </div>
    </div>
</div>

<div class="ilm-card">
    <div class="ilm-card__head">
        Advanced Custom Fields
        <span class="ilm-pro" style="margin-left:auto"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
    </div>
	<?php

    $groups = [
        'page' => [
            'name' => __('ACF Sample Group', 'seo-automated-link-building') . ' 1',
            'fields' => [
                [
                    'key' => 'acf_1',
                    'name' => __('ACF Sample Field', 'seo-automated-link-building') . ' 1',
                ],
	            [
		            'key' => 'acf_2',
		            'name' => __('ACF Sample Field', 'seo-automated-link-building') . ' 2',
	            ]
            ]
        ],
        'post' => [
	        'name' => __('ACF Sample Group', 'seo-automated-link-building') . ' 2',
	        'fields' => [
		        [
			        'key' => 'acf_3',
			        'name' => __('ACF Sample Field', 'seo-automated-link-building') . ' 3',
		        ],
		        [
			        'key' => 'acf_4',
			        'name' => __('ACF Sample Field', 'seo-automated-link-building') . ' 4',
		        ],
		        [
			        'key' => 'acf_5',
			        'name' => __('ACF Sample Field', 'seo-automated-link-building') . ' 5',
		        ]
	        ]
        ],
    ];

	foreach ( $groups as $group ):
		if ( ! empty( $group['fields'] ) ) {
			?>
            <div class="ilm-field disabled">
                <span class="ilm-label"><?php echo esc_html( $group['name'] ); ?></span>
                <div class="ilm-optionlist">
					<?php foreach ( $group['fields'] as $field ): ?>
                        <label>
                            <input type="checkbox" disabled="disabled" /> <span><?php echo esc_html( $field['name'] ); ?></span>
                        </label>
					<?php endforeach; ?>
                </div>
            </div>
			<?php
		}
	endforeach;
	?>
</div>
