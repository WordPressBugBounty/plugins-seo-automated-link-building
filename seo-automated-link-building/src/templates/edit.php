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
<div class="wrap">
    <h1 class="wp-heading-inline"><?php echo esc_html( $pageTitle ); ?></h1>
    <form method="post" action="<?php echo esc_url( $adminPostUrl ); ?>" class="seo-automated-link-building-form">
        <table class="form-table">
            <tbody>
                <tr>
                    <th><?php echo esc_html( $internalTitleHeadline ); ?>*</th>
                    <td>
                        <input type="text" name="title" placeholder="<?php echo esc_attr( $internalTitleHeadline ); ?>" value="<?php echo esc_attr( $linkTitle ); ?>" />
                        <p class="description"><?php echo wp_kses_post( $internalTitleDescription ); ?></p>
                    </td>
                </tr>
                <tr style="display: <?php echo esc_attr( $shouldDisplayPageInput ? 'table-row' : 'none' ); ?>">
                    <th><?php echo esc_html( $pageHeadline ); ?>*</th>
                    <td>
                        <div id="page-result">
                            <span class="text"></span>
                            <span id="page-result-exit">&times;</span>
                        </div>
                        <div id="no-page-result">
                            <input type="text" name="pagesearch" placeholder="<?php echo esc_attr( $pageHeadline ); ?>" />
                            <input type="hidden" name="page" value="<?php echo esc_attr( (int) $pageId ); ?>" />
                            <p class="description"><?php echo wp_kses_post( $pageDescription ); ?></p>
                            <br />
                            <a href="#" id="useCustomUrl"><?php echo esc_html( $urlSwitch ); ?></a>
                        </div>
                    </td>
                </tr>
                <tr style="display: <?php echo esc_attr( $shouldDisplayPageInput ? 'none' : 'table-row' ); ?>">
                    <th><?php echo esc_html( $urlHeadline ); ?>*</th>
                    <td>
                        <input type="text" name="url" placeholder="<?php echo esc_attr( $urlHeadline ); ?>" value="<?php echo esc_attr( $url ); ?>" />
                        <p class="description"><?php echo wp_kses_post( $urlDescription ); ?></p>
                        <br />
                        <a href="#" id="useWebsitePage"><?php echo esc_html( $pageSwitch ); ?></a>
                    </td>
                </tr>
                <tr>
                    <th><?php echo esc_html( $keywordsHeadline ); ?>*</th>
                    <td>
                        <div id="seo-automated-link-building-keywords"></div>
                        <p class="description"><?php echo wp_kses_post( $keywordsDescription ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th><?php echo esc_html( $caseSensitiveHeadline ); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="case_sensitive" <?php if($caseSensitive): ?>checked<?php endif; ?>>
                            <?php echo wp_kses_post( $caseSensitiveDescription ); ?>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>
        <br />
        <h2><?php echo esc_html( $settingsHeadline ); ?></h2>
        <table class="form-table">
            <tbody>
            <tr>
                <th><?php echo esc_html( $priorityHeadline ); ?></th>
                <td>
                    <input type="number" name="priority" placeholder="<?php echo esc_attr( $priorityHeadline ); ?>" value="<?php echo esc_attr( (int) $priority ); ?>" />
                    <p class="description"><?php echo wp_kses_post( $priorityDescription ); ?></p>
                </td>
            </tr>
            <tr>
                <th><?php echo esc_html( $titleattrHeadline ); ?></th>
                <td>
                    <input type="text" name="titleattr" placeholder="<?php echo esc_attr( $titleattrHeadline ); ?>" value="<?php echo esc_attr( $titleattr ); ?>" />
                    <p class="description"><?php echo wp_kses_post( $titleattrDescription ); ?></p>
                    <br>
                    <label>
                        <input type="checkbox" name="notitle" <?php if($notitle): ?>checked<?php endif; ?> />
                        <?php echo wp_kses_post( $notitleDescription ); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <th><?php echo esc_html( $numberOfLinksHeadline ); ?></th>
                <td>
                    <input type="number" name="num" min="-1" placeholder="<?php echo esc_attr( $numberOfLinksHeadline ); ?>" value="<?php echo esc_attr( (int) $num ); ?>" />
                    <input type="button" value="<?php echo esc_attr( $unlimitiedHint ); ?>" class="button numToUnlimited" />
                    <p class="description"><?php echo wp_kses_post( $numberOfLinksDescription ); ?></p>
                </td>
            </tr>
            <tr>
                <th><?php echo esc_html( $followHeadline ); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="follow" <?php if($follow): ?>checked<?php endif; ?>>
                        <?php echo wp_kses_post( $followDescription ); ?>
                    </label>
                </td>
            </tr>
            <tr>
                <th><?php echo esc_html( $targetHeadline ); ?></th>
                <td>
                    <div>
                        <label>
                            <input type="radio" name="target" value="_self" <?php if($target === '_self'): ?>checked<?php endif; ?>>
                            <?php echo wp_kses_post( $targetSameTabDescription ); ?>
                        </label>
                    </div>
                    <br>
                    <div>
                        <label>
                            <input type="radio" name="target" value="_blank" <?php if($target === '_blank'): ?>checked<?php endif; ?>>
                            <?php echo wp_kses_post( $targetNewTabDescription ); ?> <code>( target="_blank" )</code>
                        </label>
                    </div>
                </td>
            </tr>
            <tr>
                <th><?php echo esc_html( $partialReplacementHeadline ); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="partly_match" <?php if($partlyMatch): ?>checked<?php endif; ?> />
                        <?php echo wp_kses_post( $partialReplacementDescription ); ?>
                    </label>
                </td>
            </tr>
            </tbody>
        </table>
        <br />
        <?php if($id): ?>
        <input type="hidden" name="id" value="<?php echo absint( $id ); ?>" />
        <?php endif; ?>
        <input type="hidden" name="action" value="seo_automated_link_building_add_link" />
        <?php wp_nonce_field( 'seo_automated_link_building_add_link', 'nonce' ); ?>
        <input type="submit" class="button button-primary" value="<?php echo esc_attr( $saveTitle ); ?>" />
    </form>
</div>
