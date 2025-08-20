<table class="form-table">
    <tbody>

    <tr>
        <th><?php print __('Post types', 'seo-automated-link-building') ?></th>
        <td>
            <p class="posttypes-chooser"><?php print __('Choose from', 'seo-automated-link-building') ?>: <?php print join( ', ',
				    array_map( function ( $item ) {
					    return "<code class='post-type-option'>$item</code>";
				    }, $availablePostTypes ) ) ?></p>
            </p>
            <textarea rows="5" name="posttypes"
                      placeholder="<?php print __('Post types', 'seo-automated-link-building') ?>"><?php print $postTypes ?></textarea>
            <p class="description"><?php print __('Provide posttypes for which links should be set. One Post type per line. Optional.', 'seo-automated-link-building') ?></p>
        </td>
    </tr>

    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php print __('Process excerpts', 'seo-automated-link-building') ?></th>
        <td>
            <label>
                <input type="checkbox" disabled="disabled" />
			    <?php print __('Add links to excerpts', 'seo-automated-link-building') ?>
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
        <th><?php print __('Custom Fields', 'seo-automated-link-building') ?></th>
        <td>
		    <?php foreach ( $customFields as $field ): ?>
                <label>
                    <input type="checkbox" disabled="disabled"> <?php echo $field ?>
                </label><br>
		    <?php endforeach; ?>
        </td>
    </tr>

    <tr class="disabled" data-tooltip="<?php esc_attr_e( 'Pro-Feature', 'seo-automated-link-building' ); ?>">
        <th><?php print __('Category descriptions', 'seo-automated-link-building') ?></th>
        <td>
            <label>
                <input type="checkbox" disabled="disabled">
                <?php print __('Add links to category descriptions', 'seo-automated-link-building') ?>
            </label>
        </td>
    </tr>
    </tbody>
</table>