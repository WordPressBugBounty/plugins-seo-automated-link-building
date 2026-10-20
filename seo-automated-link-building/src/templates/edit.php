<?php
/**
 * Internal Links Manager
 * Copyright (C) 2021 webraketen GmbH
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You can read the GNU General Public License here: <https://www.gnu.org/licenses/>.
 * For questions related to this program contact post@webraketen-media.de
 */

use SeoAutomatedLinkBuilding\TemplateHelper;
?>
<div class="wrap ilm-admin">
    <h1 class="wp-heading-inline"><?php echo esc_html( $pageTitle ); ?></h1>
    <form method="post" action="<?php echo esc_url( $adminPostUrl ); ?>" class="seo-automated-link-building-form">

        <div class="ilm-card">
            <div class="ilm-card__head">
                <?php esc_html_e( 'General', 'seo-automated-link-building' ); ?>
            </div>
            <div class="ilm-field">
                <label class="ilm-label" for="ilm-title"><?php echo esc_html( $internalTitleHeadline ); ?> <span class="ilm-req">*</span></label>
                <input type="text" id="ilm-title" name="title" class="regular-text" placeholder="<?php echo esc_attr( $internalTitleHeadline ); ?>" value="<?php echo esc_attr( $linkTitle ); ?>" />
                <p class="description"><?php echo wp_kses_post( $internalTitleDescription ); ?></p>
            </div>
        </div>

        <div class="ilm-card">
            <div class="ilm-card__head">
                <?php esc_html_e( 'Link target', 'seo-automated-link-building' ); ?>
            </div>

            <div class="ilm-seg" role="group" style="margin-bottom:14px">
                <button type="button" class="ilm-seg__btn<?php echo $shouldDisplayPageInput ? ' is-active' : ''; ?>" id="useWebsitePage"><?php echo esc_html( $pageSwitch ); ?></button>
                <button type="button" class="ilm-seg__btn<?php echo $shouldDisplayPageInput ? '' : ' is-active'; ?>" id="useCustomUrl"><?php echo esc_html( $urlSwitch ); ?></button>
            </div>

            <div class="ilm-field" id="ilm-target-page" style="display: <?php echo esc_attr( $shouldDisplayPageInput ? 'block' : 'none' ); ?>">
                <label class="ilm-label" for="ilm-pagesearch"><?php echo esc_html( $pageHeadline ); ?> <span class="ilm-req">*</span></label>
                <div id="page-result">
                    <span class="text"></span>
                    <span id="page-result-exit">&times;</span>
                </div>
                <div id="no-page-result">
                    <input type="text" id="ilm-pagesearch" name="pagesearch" class="regular-text" placeholder="<?php echo esc_attr( $pageHeadline ); ?>" />
                    <input type="hidden" name="page" value="<?php echo esc_attr( (int) $pageId ); ?>" />
                    <p class="description"><?php echo wp_kses_post( $pageDescription ); ?></p>
                </div>
            </div>

            <div class="ilm-field" id="ilm-target-url" style="display: <?php echo esc_attr( $shouldDisplayPageInput ? 'none' : 'block' ); ?>">
                <label class="ilm-label" for="ilm-url"><?php echo esc_html( $urlHeadline ); ?> <span class="ilm-req">*</span></label>
                <input type="text" id="ilm-url" name="url" class="regular-text" placeholder="<?php echo esc_attr( $urlHeadline ); ?>" value="<?php echo esc_attr( $url ); ?>" />
                <p class="description"><?php echo wp_kses_post( $urlDescription ); ?></p>
            </div>
        </div>

        <div class="ilm-card">
            <div class="ilm-card__head">
                <?php echo esc_html( $keywordsHeadline ); ?> <span class="ilm-req">*</span>
                <?php echo TemplateHelper::helpTip( __( 'Words on your pages that get turned into this link.', 'seo-automated-link-building' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- helpTip() escaped selbst. ?>
            </div>
            <div class="ilm-field">
                <div id="seo-automated-link-building-keywords"></div>
                <p class="description"><?php echo wp_kses_post( $keywordsDescription ); ?></p>
            </div>
            <div class="ilm-field">
                <label class="ilm-switch">
                    <input type="checkbox" class="ilm-switch__input" name="case_sensitive" <?php checked( (bool) $caseSensitive ); ?>>
                    <span><?php echo esc_html( $caseSensitiveHeadline ); ?></span>
                </label>
                <p class="description"><?php echo wp_kses_post( $caseSensitiveDescription ); ?></p>
            </div>
        </div>

        <div class="ilm-card">
            <div class="ilm-card__head">
                <?php esc_html_e( 'Category condition', 'seo-automated-link-building' ); ?>
                <?php if ( ! $categoryConditionAvailable ) : ?>
                    <span class="ilm-pro" style="margin-left:auto"><?php esc_html_e( 'Pro', 'seo-automated-link-building' ); ?></span>
                <?php endif; ?>
            </div>

            <div class="ilm-field<?php echo $categoryConditionAvailable ? '' : ' disabled'; ?>">
                <label class="ilm-label" for="ilm-category-mode"><?php esc_html_e( 'Where should this link be set?', 'seo-automated-link-building' ); ?></label>
                <select id="ilm-category-mode" name="category_mode" <?php disabled( ! $categoryConditionAvailable ); ?>>
                    <option value="all" <?php selected( $categoryMode, 'all' ); ?>><?php esc_html_e( 'Everywhere', 'seo-automated-link-building' ); ?></option>
                    <option value="same" <?php selected( $categoryMode, 'same' ); ?>><?php esc_html_e( 'Only in posts sharing a category with the link target', 'seo-automated-link-building' ); ?></option>
                    <option value="selected" <?php selected( $categoryMode, 'selected' ); ?>><?php esc_html_e( 'Only in posts of selected categories', 'seo-automated-link-building' ); ?></option>
                </select>
                <p class="description"><?php esc_html_e( 'With a category condition, the link is only set in posts. Pages and archive descriptions have no categories and are skipped.', 'seo-automated-link-building' ); ?></p>
                <p class="ilm-field-warning" id="ilm-category-target-hint" style="display:none"><?php esc_html_e( 'The link target must be a post with categories. Pages, other content types and external URLs have no categories, so the link would not be set anywhere.', 'seo-automated-link-building' ); ?></p>
            </div>

            <div class="ilm-field<?php echo $categoryConditionAvailable ? '' : ' disabled'; ?>" id="ilm-category-selection" style="display: <?php echo esc_attr( $categoryMode === 'selected' ? 'block' : 'none' ); ?>">
                <span class="ilm-label"><?php esc_html_e( 'Categories', 'seo-automated-link-building' ); ?></span>
                <div class="ilm-category-list">
                    <?php echo TemplateHelper::categoryChecklist( 'category_ids[]', $categoryIds, ! $categoryConditionAvailable ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- categoryChecklist() escaped selbst. ?>
                </div>
                <p class="description"><?php esc_html_e( 'The post needs at least one of the selected categories. Subcategories are not included automatically.', 'seo-automated-link-building' ); ?></p>
            </div>
        </div>

        <div class="ilm-card">
            <div class="ilm-card__head">
                <?php echo esc_html( $settingsHeadline ); ?>
            </div>

            <div class="ilm-grid">
                <div class="ilm-field">
                    <label class="ilm-label" for="ilm-num"><?php echo esc_html( $numberOfLinksHeadline ); ?></label>
                    <span class="ilm-inline">
                        <input type="number" id="ilm-num" name="num" min="-1" style="width:90px" placeholder="<?php echo esc_attr( $numberOfLinksHeadline ); ?>" value="<?php echo esc_attr( (int) $num ); ?>" />
                        <input type="button" value="<?php echo esc_attr( $unlimitiedHint ); ?>" class="button numToUnlimited" />
                    </span>
                    <p class="description"><?php echo wp_kses_post( $numberOfLinksDescription ); ?></p>
                </div>
                <div class="ilm-field">
                    <label class="ilm-label" for="ilm-priority"><?php echo esc_html( $priorityHeadline ); ?></label>
                    <input type="number" id="ilm-priority" name="priority" style="width:90px" placeholder="<?php echo esc_attr( $priorityHeadline ); ?>" value="<?php echo esc_attr( (int) $priority ); ?>" />
                    <p class="description"><?php echo wp_kses_post( $priorityDescription ); ?></p>
                </div>
            </div>

            <div class="ilm-field">
                <label class="ilm-label" for="ilm-titleattr"><?php echo esc_html( $titleattrHeadline ); ?></label>
                <input type="text" id="ilm-titleattr" name="titleattr" class="regular-text" placeholder="<?php echo esc_attr( $titleattrHeadline ); ?>" value="<?php echo esc_attr( $titleattr ); ?>" />
                <p class="description"><?php echo wp_kses_post( $titleattrDescription ); ?></p>
                <label class="ilm-switch" style="margin-top:10px">
                    <input type="checkbox" class="ilm-switch__input" name="notitle" <?php checked( (bool) $notitle ); ?> />
                    <span><?php echo wp_kses_post( $notitleDescription ); ?></span>
                </label>
            </div>

            <div class="ilm-field">
                <label class="ilm-switch">
                    <input type="checkbox" class="ilm-switch__input" name="follow" <?php checked( (bool) $follow ); ?>>
                    <span><?php echo esc_html( $followHeadline ); ?></span>
                </label>
                <p class="description"><?php echo wp_kses_post( $followDescription ); ?></p>
            </div>

            <div class="ilm-field">
                <label class="ilm-switch">
                    <input type="checkbox" class="ilm-switch__input" name="partly_match" <?php checked( (bool) $partlyMatch ); ?> />
                    <span><?php echo esc_html( $partialReplacementHeadline ); ?></span>
                </label>
                <p class="description"><?php echo wp_kses_post( $partialReplacementDescription ); ?></p>
            </div>

            <div class="ilm-field">
                <span class="ilm-label"><?php echo esc_html( $targetHeadline ); ?></span>
                <div class="ilm-radios">
                    <label>
                        <input type="radio" name="target" value="_self" <?php checked( $target, '_self' ); ?>>
                        <?php echo wp_kses_post( $targetSameTabDescription ); ?>
                    </label>
                    <label>
                        <input type="radio" name="target" value="_blank" <?php checked( $target, '_blank' ); ?>>
                        <?php echo wp_kses_post( $targetNewTabDescription ); ?> <code>( target="_blank" )</code>
                    </label>
                </div>
            </div>
        </div>

        <?php if ( $id ) : ?>
            <input type="hidden" name="id" value="<?php echo absint( $id ); ?>" />
        <?php endif; ?>
        <input type="hidden" name="action" value="seo_automated_link_building_add_link" />
        <?php wp_nonce_field( 'seo_automated_link_building_add_link', 'nonce' ); ?>
        <input type="submit" class="button button-primary" value="<?php echo esc_attr( $saveTitle ); ?>" />
    </form>
</div>
