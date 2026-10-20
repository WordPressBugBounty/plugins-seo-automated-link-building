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

/**
 * KI-Modus in der Basis-Version: reine Vorschau ohne Funktion. Die Vorschau
 * enthält keine Formularfelder, es wird nichts eingegeben oder gespeichert.
 *
 * @var string $upgradeUrl
 * @var string $trialUrl
 */
?>
<div class="wrap ilm-ai-teaser">
	<h1 class="wp-heading-inline ilm-ai-teaser__title">
		<span class="dashicons dashicons-superhero-alt" aria-hidden="true"></span>
		<?php esc_html_e( 'AI mode', 'seo-automated-link-building' ); ?>
		<span class="ilm-ai-teaser__pro"><span class="dashicons dashicons-star-filled" aria-hidden="true"></span> Pro</span>
	</h1>
	<p class="ilm-ai-teaser__sub"><?php esc_html_e( 'Answer one question – the AI does the rest.', 'seo-automated-link-building' ); ?></p>
	<hr class="wp-header-end">

	<div class="ilm-ai-teaser__cta">
		<span class="dashicons dashicons-star-filled" aria-hidden="true"></span>
		<span><?php esc_html_e( 'The AI mode is available in Internal Links Manager Pro.', 'seo-automated-link-building' ); ?></span>
		<span class="ilm-ai-teaser__buttons">
			<?php if ( $trialUrl ) : ?>
				<a class="button" href="<?php echo esc_url( $trialUrl ); ?>"><?php esc_html_e( 'Start free trial', 'seo-automated-link-building' ); ?></a>
			<?php endif; ?>
			<?php if ( $upgradeUrl ) : ?>
				<a class="button button-primary" href="<?php echo esc_url( $upgradeUrl ); ?>"><?php esc_html_e( 'Upgrade to Pro', 'seo-automated-link-building' ); ?></a>
			<?php endif; ?>
		</span>
	</div>

	<div class="ilm-ai-teaser__card">
		<h2 class="ilm-ai-teaser__head"><span class="dashicons dashicons-superhero-alt" aria-hidden="true"></span> <?php esc_html_e( 'What the AI mode does for you', 'seo-automated-link-building' ); ?></h2>
		<ul class="ilm-ai-teaser__features">
			<li><span class="dashicons dashicons-flag" aria-hidden="true"></span> <?php esc_html_e( 'Describe your goal in one or two sentences – the AI finds the pages that really matter, such as product, service or contact pages.', 'seo-automated-link-building' ); ?></li>
			<li><span class="dashicons dashicons-tag" aria-hidden="true"></span> <?php esc_html_e( 'It suggests keywords and synonyms for each of these pages in the words your readers actually use.', 'seo-automated-link-building' ); ?></li>
			<li><span class="dashicons dashicons-visibility" aria-hidden="true"></span> <?php esc_html_e( 'You check every suggestion. Only what you accept goes live as an internal link.', 'seo-automated-link-building' ); ?></li>
			<li><span class="dashicons dashicons-editor-unlink" aria-hidden="true"></span> <?php esc_html_e( 'It finds links that point to deleted or unpublished pages.', 'seo-automated-link-building' ); ?></li>
			<li><span class="dashicons dashicons-admin-network" aria-hidden="true"></span> <?php esc_html_e( 'Bring your own key: works with Google Gemini, OpenAI or Anthropic Claude. You only pay your provider for what you use.', 'seo-automated-link-building' ); ?></li>
		</ul>
	</div>

	<p class="ilm-ai-teaser__label"><?php esc_html_e( 'Preview', 'seo-automated-link-building' ); ?></p>

	<?php // Nur Darstellung: keine Formularfelder, nicht bedienbar ?>
	<div class="ilm-ai-teaser__preview" aria-hidden="true" inert>
		<ol class="ilm-ai-teaser__steps">
			<li class="is-active"><span class="ilm-ai-teaser__n">1</span> <?php esc_html_e( 'Connection', 'seo-automated-link-building' ); ?></li>
			<li><span class="ilm-ai-teaser__n">2</span> <?php esc_html_e( 'Goal', 'seo-automated-link-building' ); ?></li>
			<li><span class="ilm-ai-teaser__n">3</span> <?php esc_html_e( 'Confirm targets', 'seo-automated-link-building' ); ?></li>
			<li><span class="ilm-ai-teaser__n">4</span> <?php esc_html_e( 'Review & publish', 'seo-automated-link-building' ); ?></li>
		</ol>

		<div class="ilm-ai-teaser__card">
			<div class="ilm-ai-teaser__head"><span class="dashicons dashicons-admin-plugins"></span> <?php esc_html_e( 'AI connection (bring your own key)', 'seo-automated-link-building' ); ?></div>

			<div class="ilm-ai-teaser__field">
				<div class="ilm-ai-teaser__flabel"><?php esc_html_e( 'Provider', 'seo-automated-link-building' ); ?></div>
				<div class="ilm-ai-teaser__seg">
					<span class="is-active">Gemini</span><span>OpenAI</span><span>Anthropic</span>
				</div>
			</div>

			<div class="ilm-ai-teaser__field">
				<div class="ilm-ai-teaser__flabel"><?php esc_html_e( 'API key', 'seo-automated-link-building' ); ?></div>
				<div class="ilm-ai-teaser__inline">
					<span class="ilm-ai-teaser__input"></span>
					<span class="button"><?php esc_html_e( 'Test connection', 'seo-automated-link-building' ); ?></span>
				</div>
				<p class="description"><span class="dashicons dashicons-lock"></span> <?php esc_html_e( 'Your key, your costs. It is stored encrypted and never output in the browser.', 'seo-automated-link-building' ); ?></p>
			</div>
		</div>
	</div>
</div>
