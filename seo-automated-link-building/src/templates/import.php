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
?>

<div class="wrap ilm-admin">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Import + Export', 'seo-automated-link-building' ); ?></h1>

    <div class="ilm-grid">
        <div class="ilm-card">
            <div class="ilm-card__head">
                <?php echo esc_html( $importHeadline ); ?>
            </div>
            <form id="import-form" method="post" action="<?php echo esc_url( $adminPostUrl ); ?>" class="seo-automated-link-building-form dropzone ilm-dropzone">
                <div class="ilm-field">
                    <span class="ilm-label"><?php esc_html_e( 'How should existing entries be handled?', 'seo-automated-link-building' ); ?></span>
                    <div class="ilm-optionlist">
                        <label for="addMissing">
                            <input type="radio" name="mode" value="addMissing" id="addMissing" checked />
                            <span><?php echo esc_html( $addMissingDescription ); ?></span>
                        </label>
                        <label for="update">
                            <input type="radio" name="mode" value="update" id="update" />
                            <span><?php echo esc_html( $addMissingAndUpdateDescription ); ?></span>
                        </label>
                        <label for="add">
                            <input type="radio" name="mode" value="add" id="add" />
                            <span><?php echo esc_html( $addAlwaysDescription ); ?></span>
                        </label>
                    </div>
                </div>

                <div class="ilm-dropzone__target" id="ilm-drop-target">
                    <span class="ilm-dropzone__icon dashicons dashicons-upload" aria-hidden="true"></span>
                    <span class="ilm-dropzone__title"><?php esc_html_e( 'Drag a file here', 'seo-automated-link-building' ); ?></span>
                    <span class="ilm-dropzone__hint"><?php esc_html_e( 'or click to select a file', 'seo-automated-link-building' ); ?></span>
                    <span class="ilm-dropzone__formats"><?php esc_html_e( 'CSV or JSON', 'seo-automated-link-building' ); ?></span>
                </div>

                <input type="hidden" name="action" value="seo_automated_link_building_import_links" />
                <?php wp_nonce_field( 'seo_automated_link_building_import_links', 'nonce' ); ?>
            </form>
        </div>

        <div class="ilm-card">
            <div class="ilm-card__head">
                <?php echo esc_html( $exportHeadline ); ?>
            </div>
            <div class="ilm-field">
                <div class="ilm-optionlist">
                    <label for="csv">
                        <input type="radio" name="ext" value="csv" id="csv" checked />
                        <span>CSV</span>
                    </label>
                    <label for="json">
                        <input type="radio" name="ext" value="json" id="json" />
                        <span>JSON</span>
                    </label>
                </div>
            </div>
            <div class="ilm-field" id="separator-field">
                <label class="ilm-label" for="separator"><?php echo esc_html( $separatorLabel ); ?></label>
                <select id="separator" name="separator">
                    <option value=";">;</option>
                    <option value=",">,</option>
                </select>
                <p class="description"><?php esc_html_e( 'Only relevant for CSV.', 'seo-automated-link-building' ); ?></p>
            </div>
            <p class="ilm-card__actions">
                <a class="export button button-primary"><?php echo esc_html( $exportDescription ); ?></a>
            </p>
        </div>
    </div>
</div>
