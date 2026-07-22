<?php
$cacheEngines = [
	'Database'   => false,
	'Filesystem' => false,
	'Apcu'      => false,
	'Redis'     => false,
	'Memcached' => false,
];
?>

<table class="form-table">
    <tbody>
    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Enable Caching', 'seo-automated-link-building' ); ?></th>
        <td>
            <label>
                <input id="enable-caching" type="checkbox" disabled="disabled"/>
				<?php esc_html_e( 'Enable Caching', 'seo-automated-link-building' ); ?>
            </label>
        </td>
    </tr>

    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Time to live', 'seo-automated-link-building' ); ?></th>
        <td>
            <input type="text" disabled="disabled" placeholder="86400">
            <p class="description"><?php esc_html_e( 'Set expiration time of cached values in seconds, 86400 (= one day) is used as default',
					'seo-automated-link-building' ); ?></p>
        </td>
    </tr>

    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Cache Provider', 'seo-automated-link-building' ); ?></th>
        <td>
            <select id="cache-provider">
                <option value="NoCaching"><?php esc_html_e( 'Please choose a caching option',
						'seo-automated-link-building' ); ?></option>
				<?php foreach ( $cacheEngines as $engine => $available ) { ?>
                    <option value="<?php echo esc_attr( $engine ); ?>" disabled="disabled"><?php echo esc_html( __( $engine, 'seo-automated-link-building' ) ); ?></option>
				<?php } ?>
            </select>
            <p class="description"><?php esc_html_e( 'Please select which cache provider you want to use. Disabled options are not available.',
					'seo-automated-link-building' ); ?></p>
        </td>
    </tr>

    <tr class="caching-option redis disabled"
        data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Host', 'seo-automated-link-building' ); ?></th>
        <td>
            <input type="text" disabled="disabled" placeholder="127.0.0.1">
            <p class="description"><?php esc_html_e( 'Enter the hostname or IP address of the redis server, 127.0.0.1 is used as default',
					'seo-automated-link-building' ); ?></p>
        </td>
    </tr>
    <tr class="caching-option redis disabled"
        data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Port', 'seo-automated-link-building' ); ?></th>
        <td>
            <input type="text" disabled="disabled" placeholder="6379">
            <p class="description"><?php esc_html_e( 'Enter the port of the redis server, 6379 is used as default',
					'seo-automated-link-building' ); ?></p>
        </td>
    </tr>

    <tr class="caching-option memcached disabled"
        data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Host', 'seo-automated-link-building' ); ?></th>
        <td>
            <input type="text" disabled="disabled" placeholder="127.0.0.1">
            <p class="description"><?php esc_html_e( 'Enter the hostname or IP address of the memcached service, 127.0.0.1 is used as default',
					'seo-automated-link-building' ); ?></p>
        </td>
    </tr>
    <tr class="caching-option memcached disabled"
        data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Port', 'seo-automated-link-building' ); ?></th>
        <td>
            <input type="text" disabled="disabled" placeholder="11211">
            <p class="description"><?php esc_html_e( 'Enter the port of the memcached service, 11211 is used as default',
					'seo-automated-link-building' ); ?></p>
        </td>
    </tr>
    </tbody>
</table>
