<?php

if ( class_exists( 'Styles_Control' ) ) :

/**
 * Styles looks for class "Styles_Control_Foo_Bar"
 * when presented with { type: "foo-bar" } in customize.json
 *
 * Example JSON usage:
 *     { "type": "group", "label": "Most awesome group ever" },
 */
class Styles_Control_Group extends Styles_Control {

	public function __construct( $group, $element ) {
		// No selector needed for a group -- it's not an option
		$element['selector'] = true;

		// Default label
		if ( empty( $element['label'] ) ) {
			$element['label'] = 'Group';
		}

		parent::__construct( $group, $element );
	}

	/**
	 * Register item with $wp_customize
	 */
	public function add_item() {
		global $wp_customize;

		$args = array(
			'default'    => $this->default,
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'transport'  => $this->get_transport(),
		);

		$wp_customize->add_setting( $this->setting, $args );

		$wp_customize->add_control( new Styles_Customize_Control_Group( $wp_customize, Styles_Helpers::get_control_id( $this->id ), array(
			'label'    => __( $this->label, 'styles' ),
			'section'  => $this->group,
			'settings' => $this->setting,
			'priority' => $this->priority . $this->group_priority,
		) ) );
	}

	/**
	 * Return CSS based on setting value
	 */
	public function get_css(){
		return '';
	}

}

endif; // end Styles_Control_Group


if ( class_exists('WP_Customize_Control') ) :

class Styles_Customize_Control_Group extends WP_Customize_Control {
	/**
	 * Used in the CSS selector for this item
	 */
	public $type = 'styles-group';

	public function render_content() {
		echo esc_html( $this->label );
	}
}

endif; // end Styles_Customize_Control_Group