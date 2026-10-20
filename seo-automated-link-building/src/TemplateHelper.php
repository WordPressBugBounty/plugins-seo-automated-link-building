<?php

namespace SeoAutomatedLinkBuilding;

/**
 * Helper methods for admin templates.
 */
final class TemplateHelper {

	/**
	 * Returns an inline help-text tooltip trigger, shown on hover and keyboard focus.
	 *
	 * Only for supplementary hints — copy that a user needs in order to fill in a
	 * field belongs in a visible <p class="description">, because tooltips are not
	 * reachable on touch devices.
	 *
	 * The markup is assembled from escaped parts, so it is safe to echo directly.
	 *
	 * @param string $text Already-translated, plain-text help text.
	 *
	 * @return string
	 */
	public static function helpTip( string $text ): string {
		if ( '' === $text ) {
			return '';
		}

		$text = esc_attr( $text );

		return sprintf(
			'<button type="button" class="ilm-tip" aria-label="%1$s" data-tip="%1$s"><span class="dashicons dashicons-editor-help" aria-hidden="true"></span></button>',
			$text
		);
	}

	/**
	 * Returns a nested checklist of all post categories.
	 *
	 * The markup is assembled from escaped parts, so it is safe to echo directly.
	 *
	 * @param string $name     Name of the checkbox inputs, e.g. "category_ids[]".
	 * @param int[]  $selected IDs of the checked categories.
	 * @param bool   $disabled Render all checkboxes disabled (Pro preview).
	 *
	 * @return string
	 */
	public static function categoryChecklist( string $name, array $selected, bool $disabled = false ): string {
		if ( ! function_exists( 'wp_terms_checklist' ) ) {
			require_once ABSPATH . 'wp-admin/includes/template.php';
		}

		$walker = new class( $name, $disabled ) extends \Walker_Category_Checklist {
			/** @var string */
			private $inputName;
			/** @var bool */
			private $inputDisabled;

			public function __construct( string $inputName, bool $inputDisabled ) {
				$this->inputName     = $inputName;
				$this->inputDisabled = $inputDisabled;
			}

			public function start_el( &$output, $data_object, $depth = 0, $args = [], $current_object_id = 0 ) {
				$output .= '<li class="level-' . (int) $depth . '">';
				$output .= sprintf(
					'<label><input type="checkbox" name="%s" value="%d"%s%s> %s</label>',
					esc_attr( $this->inputName ),
					(int) $data_object->term_id,
					checked( in_array( (int) $data_object->term_id, (array) $args['selected_cats'], true ), true, false ),
					disabled( $this->inputDisabled, true, false ),
					esc_html( $data_object->name )
				);
			}
		};

		return (string) wp_terms_checklist( 0, [
			'taxonomy'      => 'category',
			'selected_cats' => array_map( 'intval', $selected ),
			'checked_ontop' => false,
			'walker'        => $walker,
			'echo'          => false,
		] );
	}
}
