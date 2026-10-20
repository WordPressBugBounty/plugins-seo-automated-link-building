<?php
$cacheEngines = [
	'Database'   => false,
	'Filesystem' => false,
	'Apcu'      => false,
	'Redis'     => false,
	'Memcached' => false,
];
?>

<div class="ilm-card">
    <div class="ilm-card__head">
        <?php esc_html_e( 'Caching', 'seo-automated-link-building' ); ?>
        <span class="ilm-pro" style="margin-left:auto"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
    </div>

    <p class="description" style="margin-top:0">
        <?php esc_html_e( 'Cache processed content for faster page loads on large sites.', 'seo-automated-link-building' ); ?>
    </p>

    <div class="ilm-field disabled" style="margin-top:14px">
        <label class="ilm-switch">
            <input id="enable-caching" type="checkbox" class="ilm-switch__input" disabled="disabled"/>
            <span><?php esc_html_e( 'Enable Caching', 'seo-automated-link-building' ); ?></span>
        </label>
    </div>

    <div class="ilm-field disabled">
        <label class="ilm-label" for="cache-provider"><?php esc_html_e( 'Cache Provider', 'seo-automated-link-building' ); ?></label>
        <select id="cache-provider" disabled="disabled">
            <option value="NoCaching"><?php esc_html_e( 'Please choose a caching option', 'seo-automated-link-building' ); ?></option>
			<?php foreach ( $cacheEngines as $engine => $available ) { ?>
                <option value="<?php echo esc_attr( $engine ); ?>" disabled="disabled"><?php echo esc_html( __( $engine, 'seo-automated-link-building' ) ); ?></option>
			<?php } ?>
        </select>
        <p class="description"><?php esc_html_e( 'Please select which cache provider you want to use. Disabled options are not available.', 'seo-automated-link-building' ); ?></p>
    </div>

    <div class="ilm-field disabled">
        <label class="ilm-label"><?php esc_html_e( 'Time to live', 'seo-automated-link-building' ); ?></label>
        <input type="text" disabled="disabled" placeholder="86400">
        <p class="description"><?php esc_html_e( 'Set expiration time of cached values in seconds, 86400 (= one day) is used as default', 'seo-automated-link-building' ); ?></p>
    </div>

    <div class="ilm-field caching-option redis disabled">
        <label class="ilm-label"><?php esc_html_e( 'Host', 'seo-automated-link-building' ); ?></label>
        <input type="text" disabled="disabled" placeholder="127.0.0.1">
        <p class="description"><?php esc_html_e( 'Enter the hostname or IP address of the redis server, 127.0.0.1 is used as default', 'seo-automated-link-building' ); ?></p>
    </div>
    <div class="ilm-field caching-option redis disabled">
        <label class="ilm-label"><?php esc_html_e( 'Port', 'seo-automated-link-building' ); ?></label>
        <input type="text" disabled="disabled" placeholder="6379">
        <p class="description"><?php esc_html_e( 'Enter the port of the redis server, 6379 is used as default', 'seo-automated-link-building' ); ?></p>
    </div>

    <div class="ilm-field caching-option memcached disabled">
        <label class="ilm-label"><?php esc_html_e( 'Host', 'seo-automated-link-building' ); ?></label>
        <input type="text" disabled="disabled" placeholder="127.0.0.1">
        <p class="description"><?php esc_html_e( 'Enter the hostname or IP address of the memcached service, 127.0.0.1 is used as default', 'seo-automated-link-building' ); ?></p>
    </div>
    <div class="ilm-field caching-option memcached disabled">
        <label class="ilm-label"><?php esc_html_e( 'Port', 'seo-automated-link-building' ); ?></label>
        <input type="text" disabled="disabled" placeholder="11211">
        <p class="description"><?php esc_html_e( 'Enter the port of the memcached service, 11211 is used as default', 'seo-automated-link-building' ); ?></p>
    </div>
</div>
