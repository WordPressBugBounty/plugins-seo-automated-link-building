<div class="ilm-card">
    <div class="ilm-card__head">
        <?php esc_html_e( 'Link placement', 'seo-automated-link-building' ); ?>
    </div>

    <div class="ilm-field">
        <label class="ilm-label" for="ilm-whitelist"><?php esc_html_e( 'Whitelist', 'seo-automated-link-building' ); ?></label>
        <textarea id="ilm-whitelist" rows="4" name="whitelist"
                  placeholder="<?php esc_attr_e( 'Whitelist', 'seo-automated-link-building' ); ?>"><?php echo esc_textarea( $whitelist ); ?></textarea>
        <p class="description"><?php esc_html_e( 'Only these pages should be changed. One url per line. Optional.', 'seo-automated-link-building' ); ?></p>
        <p class="description"><?php esc_html_e( 'You can use * as wildcard between slashes and ** including slashes.', 'seo-automated-link-building' ); ?></p>
    </div>

    <div class="ilm-field">
        <label class="ilm-label" for="ilm-blacklist"><?php esc_html_e( 'Blacklist', 'seo-automated-link-building' ); ?></label>
        <textarea id="ilm-blacklist" rows="4" name="blacklist"
                  placeholder="<?php esc_attr_e( 'Blacklist', 'seo-automated-link-building' ); ?>"><?php echo esc_textarea( $blacklist ); ?></textarea>
        <p class="description"><?php esc_html_e( 'Provide pages which shouldn\'t be changed. One url per line. Optional.', 'seo-automated-link-building' ); ?></p>
        <p class="description"><?php esc_html_e( 'You can use * as wildcard between slashes and ** including slashes.', 'seo-automated-link-building' ); ?></p>
    </div>

    <div class="ilm-field">
        <label class="ilm-label" for="ilm-exclude"><?php esc_html_e( 'Excluded html elements', 'seo-automated-link-building' ); ?></label>
        <textarea id="ilm-exclude" rows="4" name="exclude"
                  placeholder="<?php esc_attr_e( "#example-id\n.example-class", 'seo-automated-link-building' ); ?>"><?php echo esc_textarea( $exclude ); ?></textarea>
        <p class="description"><?php esc_html_e( 'Provide html selectors for which no links should be set. One selector per line. Optional.', 'seo-automated-link-building' ); ?></p>
    </div>

    <div class="ilm-prorow">
        <div>
            <span class="ilm-prorow__main">
                <?php esc_html_e( 'Link class', 'seo-automated-link-building' ); ?>
            </span>
            <p class="ilm-prorow__desc"><?php esc_html_e( 'This css class name will be added to each automatically created link. Optional.', 'seo-automated-link-building' ); ?></p>
        </div>
        <span class="ilm-pro"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
    </div>

    <div class="ilm-prorow">
        <div>
            <span class="ilm-prorow__main">
                <?php esc_html_e( 'Display processing time', 'seo-automated-link-building' ); ?>
            </span>
            <p class="ilm-prorow__desc"><?php esc_html_e( 'Shows the time needed to process link replacements on the current page in the bottom left corner. Only visible for logged in admins.', 'seo-automated-link-building' ); ?></p>
        </div>
        <span class="ilm-pro"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
    </div>
</div>

<div class="ilm-card">
    <div class="ilm-card__head">
        <?php esc_html_e( 'Tracking', 'seo-automated-link-building' ); ?>
    </div>

    <div class="ilm-field">
        <label class="ilm-switch">
            <input type="checkbox" class="ilm-switch__input" name="disableStatistics" <?php checked( (bool) $disableStatistics ); ?> />
            <span><?php esc_html_e( 'Disable Statistics', 'seo-automated-link-building' ); ?></span>
        </label>
        <p class="description"><?php esc_html_e( 'Do not track link clicks.', 'seo-automated-link-building' ); ?></p>
    </div>

    <div class="ilm-field">
        <label class="ilm-switch">
            <input type="checkbox" class="ilm-switch__input" name="disableAdminTracking" <?php checked( (bool) $disableAdminTracking ); ?> />
            <span><?php esc_html_e( 'Disable Tracking when in Admin-Mode', 'seo-automated-link-building' ); ?></span>
        </label>
        <p class="description"><?php esc_html_e( 'Do not track link clicks when logged in.', 'seo-automated-link-building' ); ?></p>
    </div>
</div>
