<table class="form-table">
    <tbody>
    <tr>
        <th><?php print __('Whitelist', 'seo-automated-link-building') ?></th>
        <td>
            <textarea rows="5" name="whitelist"
                      placeholder="<?php print __('Whitelist', 'seo-automated-link-building') ?>"><?php print $whitelist ?></textarea>
            <p class="description"><?php print __('Only these pages should be changed. One url per line. Optional.', 'seo-automated-link-building') ?></p>
            <p class="description"><?php print __('You can use * as wildcard between slashes and ** including slashes.', 'seo-automated-link-building') ?></p>
        </td>
    </tr>
    <tr>
        <th><?php print __('Blacklist', 'seo-automated-link-building') ?></th>
        <td>
            <textarea rows="5" name="blacklist"
                      placeholder="<?php print __('Blacklist', 'seo-automated-link-building') ?>"><?php echo $blacklist ?></textarea>
            <p class="description"><?php print __('Provide pages which shouldn\'t be changed. One url per line. Optional.', 'seo-automated-link-building') ?></p>
            <p class="description"><?php print __('You can use * as wildcard between slashes and ** including slashes.', 'seo-automated-link-building') ?></p>
        </td>
    </tr>
    <tr>
        <th><?php print __('Excluded html elements', 'seo-automated-link-building') ?></th>
        <td>
            <textarea rows="5" name="exclude"
                      placeholder="<?php print __("#example-id\n.example-class", 'seo-automated-link-building') ?>"><?php print $exclude ?></textarea>
            <p class="description"><?php print __('Provide html selectors for which no links should be set. One selector per line. Optional.', 'seo-automated-link-building') ?></p>
        </td>
    </tr>
    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php print __('Link class', 'seo-automated-link-building') ?></th>
        <td>
            <input type="text" disabled="disabled">
            <p class="description"><?php print __('This css class name will be added to each automatically created link. Optional.', 'seo-automated-link-building') ?></p>
        </td>
    </tr>
    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php print __("Display processing time", 'seo-automated-link-building') ?></th>
        <td>
            <label>
                <input type="checkbox" disabled="disabled" />
			    <?php print __('Shows the time needed to process link replacements on the current page in the bottom left corner. Only visible for logged in admins.', 'seo-automated-link-building') ?>
            </label>
        </td>
    </tr>
    <tr>
        <th><?php print __("Disable Statistics", 'seo-automated-link-building') ?></th>
        <td>
            <label>
                <input type="checkbox" name="disableStatistics"
				       <?php if ( $disableStatistics ): ?>checked<?php endif; ?> />
				<?php print __('Do not track link clicks.', 'seo-automated-link-building') ?>
            </label>
        </td>
    </tr>
    <tr>
        <th><?php print __("Disable Tracking when in Admin-Mode", 'seo-automated-link-building') ?></th>
        <td>
            <label>
                <input type="checkbox" name="disableAdminTracking"
				       <?php if ( $disableAdminTracking ): ?>checked<?php endif; ?> />
				<?php print __('Do not track link clicks when logged in.', 'seo-automated-link-building') ?>
            </label>
        </td>
    </tr>
    </tbody>
</table>