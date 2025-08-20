<table class="form-table">
    <tbody>
    <tr>
        <td colspan="2"><h3>WooCommerce</h3></td>
    </tr>
    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php print __( "Selection", 'seo-automated-link-building' ) ?></th>
        <td>
            <label>
                <input type="checkbox" disabled="disabled"> <?php print __( 'Add links to products short description', 'seo-automated-link-building' ) ?>
            </label>
            <br>
            <label>
                <input type="checkbox" disabled="disabled"> <?php print __( 'Add links to category description', 'seo-automated-link-building' ) ?>
            </label>
            <br>
            <label>
                <input type="checkbox" disabled="disabled"> <?php print __( 'Add links to product tag description', 'seo-automated-link-building' ) ?>
            </label>
        </td>
    </tr>
    <tr>
        <td colspan="2"><h3>Advanced Custom Fields</h3></td>
    </tr>
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
            <tr  class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
                <th><?php echo $group['name'] ?></th>
                <td>
					<?php foreach ( $group['fields'] as $field ): ?>
                        <label>
                            <input type="checkbox" disabled="disabled" /> <?php echo $field['name'] ?>
                        </label><br>
					<?php endforeach; ?>
                </td>
            </tr>
			<?php
		}
	endforeach;
	?>
    </tbody>
</table>