<table class="form-table">
    <tbody>
    <tr>
        <th><?php esc_html_e( 'Whitelist', 'seo-automated-link-building' ); ?></th>
        <td>
            <textarea rows="5" name="whitelist"
                      placeholder="<?php esc_attr_e( 'Whitelist', 'seo-automated-link-building' ); ?>"><?php echo esc_textarea( $whitelist ); ?></textarea>
            <p class="description"><?php esc_html_e( 'Only these pages should be changed. One url per line. Optional.', 'seo-automated-link-building' ); ?></p>
            <p class="description"><?php esc_html_e( 'You can use * as wildcard between slashes and ** including slashes.', 'seo-automated-link-building' ); ?></p>
        </td>
    </tr>
    <tr>
        <th><?php esc_html_e( 'Blacklist', 'seo-automated-link-building' ); ?></th>
        <td>
            <textarea rows="5" name="blacklist"
                      placeholder="<?php esc_attr_e( 'Blacklist', 'seo-automated-link-building' ); ?>"><?php echo esc_textarea( $blacklist ); ?></textarea>
            <p class="description"><?php esc_html_e( 'Provide pages which shouldn\'t be changed. One url per line. Optional.', 'seo-automated-link-building' ); ?></p>
            <p class="description"><?php esc_html_e( 'You can use * as wildcard between slashes and ** including slashes.', 'seo-automated-link-building' ); ?></p>
        </td>
    </tr>
    <tr>
        <th><?php esc_html_e( 'Excluded html elements', 'seo-automated-link-building' ); ?></th>
        <td>
            <textarea rows="5" name="exclude"
                      placeholder="<?php esc_attr_e( "#example-id\n.example-class", 'seo-automated-link-building' ); ?>"><?php echo esc_textarea( $exclude ); ?></textarea>
            <p class="description"><?php esc_html_e( 'Provide html selectors for which no links should be set. One selector per line. Optional.', 'seo-automated-link-building' ); ?></p>
        </td>
    </tr>
    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Link class', 'seo-automated-link-building' ); ?></th>
        <td>
            <input type="text" disabled="disabled">
            <p class="description"><?php esc_html_e( 'This css class name will be added to each automatically created link. Optional.', 'seo-automated-link-building' ); ?></p>
        </td>
    </tr>
    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php esc_html_e( 'Display processing time', 'seo-automated-link-building' ); ?></th>
        <td>
            <label>
                <input type="checkbox" disabled="disabled" />
			    <?php esc_html_e( 'Shows the time needed to process link replacements on the current page in the bottom left corner. Only visible for logged in admins.', 'seo-automated-link-building' ); ?>
            </label>
        </td>
    </tr>
    <tr>
        <th><?php esc_html_e( 'Disable Statistics', 'seo-automated-link-building' ); ?></th>
        <td>
            <label>
                <input type="checkbox" name="disableStatistics"
				       <?php if ( $disableStatistics ): ?>checked<?php endif; ?> />
				<?php esc_html_e( 'Do not track link clicks.', 'seo-automated-link-building' ); ?>
            </label>
        </td>
    </tr>
    <tr>
        <th><?php esc_html_e( 'Disable Tracking when in Admin-Mode', 'seo-automated-link-building' ); ?></th>
        <td>
            <label>
                <input type="checkbox" name="disableAdminTracking"
				       <?php if ( $disableAdminTracking ): ?>checked<?php endif; ?> />
				<?php esc_html_e( 'Do not track link clicks when logged in.', 'seo-automated-link-building' ); ?>
            </label>
        </td>
    </tr>
    </tbody>
</table>
