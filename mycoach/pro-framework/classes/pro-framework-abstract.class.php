<?php
/**
 *
 * PROFramework Abstract Class
 * @since 1.0.0
 * @version 1.0.0
 *
 */
abstract class NETBEEFramework_Abstract {
	public function __construct() {}
	/**
	 *
	 * Add Action
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public function mycoach_add_action( $hook, $function_to_add, $priority = 30, $accepted_args = 1 ) {
		add_action( $hook, array( &$this, $function_to_add ), $priority, $accepted_args );
	}
	/**
	 *
	 * Add Filter
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public function mycoach_add_filter( $tag, $function_to_add, $priority = 30, $accepted_args = 1 ) {
		add_action( $tag, array( &$this, $function_to_add ), $priority, $accepted_args );
	}
	/**
	 *
	 * Remove Filter
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public function mycoach_remove_filter( $tag, $function_to_remove, $priority = 10 ) {
		remove_filter( $tag, $function_to_remove, $priority );
	}
	/**
	 *
	 * Add Element
	 * @since 1.0.0
	 * @version 1.0.0
	 *
	 */
	public static function mycoach_add_element( $field = array(), $value = '', $unique = '' ) {
		$unique = ( isset( $unique ) ) ? $unique : '';
		// check for field type
		if ( isset( $field['type'] ) ) {
			// set class name
			$class = 'PROFramework_Option_' . $field['type'];
			// check class
			if ( class_exists( $class ) ) {
				$el_wrap_id = ( isset( $field['id'] ) ) ? ' id="element-' . $field['id'] . '"' : '';
				$el_class = ( isset( $field['el_class'] ) ) ? ' class_' . $field['el_class'] : '';
				$el_wrap_class = ( ! isset( $field['pseudo'] ) ) ? 'cs-element-wrap' : 'pseudo-field';
				// add dependencies attributes
				$depend = '';
				$hidden = '';
				$sub = ( isset( $field['sub'] ) ) ? 'sub-' : '';
				if ( isset( $field['dependency'] ) ) {
					$hidden = ' hidden';
					$depend .= ' data-' . $sub . 'controller="' . $field['dependency'][0] . '"';
					$depend .= ' data-' . $sub . 'condition="' . $field['dependency'][1] . '"';
					$depend .= " data-" . $sub . "value='" . htmlspecialchars( $field['dependency'][2] ) . "'";
				}
				$fieldset_class = ( isset( $field['title'] ) ) ? 'cs-element-fieldset ' : '';
				echo '<div' . $el_wrap_id . ' class="' . $el_wrap_class . $el_class . $hidden . '"' . $depend . '>';
				if ( isset( $field['title'] ) ) {
					$field_desc = ( isset( $field['desc'] ) ) ? '<p class="cs-text-desc">' . $field['desc'] . '</p>' : '';
					echo '<div class="cs-element-title"><h4>' . $field['title'] . '</h4>' . $field_desc . '</div>';
				}
				echo '<div class="' . $fieldset_class . 'cs_field cs_field_' . $field['type'] . '">';
				$value = ( ! isset( $value ) && isset( $field['default'] ) ) ? $field['default'] : $value;
				$value = ( isset( $field['value'] ) ) ? $field['value'] : $value;
				$element = new $class( $field, $value, $unique );
				$element->output();
				echo '</div>';
				echo '<div class="clear"></div>';
				echo '</div>';
			} else {
				echo '<p><span class="label label-danger">Field class is not available.</span></p>';
			}
		} else {
			echo '<p><span class="label label-danger">Field type is not available.</span></p>';
		}
	}
}