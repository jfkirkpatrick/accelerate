<?php
	

/**
 * Returns true if a successful submission was performed
 *
 * @since 1.1
 */
function af_has_submission() {
	
	return ! is_null( AF()->submission );
	
}


/**
 * Searches input for tags {field:FIELD_NAME} and replaces with field values.
 * Also replaces general tags such as {all_fields}.
 *
 * @since 1.0.1
 *
 */
function af_resolve_field_includes( $input, $fields = false ) {
	
	// Get fields from the global submission object if fields weren't passed
	if ( ! $fields && af_has_submission() ) {
		
		$fields = AF()->submission['fields'];
		
	}
	
	
	// Render all fields as a table
	if ( preg_match_all( "/{all_fields}/", $input, $matches ) ) {
		
		$output = '<table class="af-field-include">';
		
		foreach ( $fields as $field ) {
			
			if ( 'clone' == $field['type'] ) {
				
				foreach ( $field['sub_fields'] as $sub_field ) {
					
					$output .= sprintf( '<tr><th>%s</th></tr>', $sub_field['label'] );
					$output .= sprintf( '<tr><td>%s</td></tr>', _af_render_field_include( $sub_field, $field['value'][ $sub_field['name'] ] ) );
					
				}
				
			} else {
			
				$output .= sprintf( '<tr><th>%s</th></tr>', $field['label'] );
				$output .= sprintf( '<tr><td>%s</td></tr>', _af_render_field_include( $field ) );
			
			}
			
		}
		
		$output .= '</table>';
		
		
		$input = str_replace( '{all_fields}', $output, $input );
		
	}
	
	
	// Render single fields individually
	if ( preg_match_all( "/{field:(.*?)}/", $input, $matches ) ) {
		
		foreach ($matches[1] as $i => $field_name ) {
			
			$field = af_get_field_object( $field_name );
			
			$rendered_value = _af_render_field_include( $field );
			
			$input = str_replace( $matches[0][$i], $rendered_value, $input );
			
		}
		
	}
	
	return $input;
	
}


/**
 * Renders a single field include (for emails, success messages etc.)
 *
 * @since 1.2.0
 *
 */
function _af_render_field_include( $field, $value = false ) {
	
	if ( ! $value ) {
		$value = $field['value'];
	}
	
	
	$output = '';
	
	if ( 'repeater' == $field['type'] && is_array( $value ) ) {
		
		$output .= '<table class="af-field-include af-field-include-repeater">';
		
		// Column headings
		$output .= '<thead><tr>';
		
		foreach ( $field['sub_fields'] as $sub_field ) {
			$output .= sprintf( '<th>%s</th>', $sub_field['label'] );
		}
		
		$output .= '</tr></thead>';
		
		
		// Rows
		$output .= '<tbody>';
		
		if ( is_array( $value ) ) {
			foreach ( $value as $row_values ) {
				$output .= '<tr>';
				
				foreach ( $field['sub_fields'] as $sub_field ) {
					
					$output .= sprintf( '<td>%s</td>', _af_render_field_include( $sub_field, $row_values[ $sub_field['name'] ] ) );
					
				}
				
				$output .= '</tr>';
			}
		}
		
		$output .= '</tbody>';
		
		
		$output .= '</table>';
		
	} else if ( 'clone' == $field['type'] ) {
		
		$output .= '<table class="af-field-include af-field-include-clone">';
	
		foreach ( $field['sub_fields'] as $sub_field ) {
			
			$output .= sprintf( '<tr><th>%s</th></tr>', $sub_field['label'] );
			$output .= sprintf( '<tr><td>%s</td></tr>', _af_render_field_include( $sub_field, $field['value'][ $sub_field['name'] ] ) );
			
		}
		
		$output .= '</table>';
	
	} else {
		
		/**
		 * Handle the different shapes $value may take and create an appropriate string
		 *
		 * WP_Post 		- post title
		 * WP_User 		- user first name and last name combined
		 * User array	- user first name and last name combined
		 * WP_Term 		- term name
		 * Array 		- render each value and join with commas
		 * Other 		- cast to string
		 *
		 * @since 1.3.0
		 *
		 */
		 
		if ( $value instanceof WP_Post ) {
			
			$output = $value->post_title;
			
		} elseif ( $value instanceof WP_User ) {
			
			$output = sprintf( '%s %s', $value->first_name, $value->last_name );
		
		} elseif ( is_array( $value ) && isset( $value['user_email'] ) ) {
			
			$output = sprintf( '%s %s', $value['user_firstname'], $value['user_lastname'] );
			
		} elseif ( $value instanceof WP_Term ) {
			
			$output = $value->name;
			
		} elseif ( is_array( $value ) ) {
			
			$rendered_values = array();
			
			foreach ( $value as $single_value ) {
				
				$rendered_values[] = _af_render_field_include( $field, $single_value );
				
			}
			
			$output = join( ', ', $rendered_values );
			
		} else {
			
			$output = (string)$value;
			
		}
		
	}
	
	
	// Allow third-parties to alter rendered field
	$output = apply_filters( 'af/field/render_include', $output, $field, $value );
	$output = apply_filters( 'af/field/render_include/name=' . $field['name'], $output, $field, $value );
	$output = apply_filters( 'af/field/render_include/key=' . $field['key'], $output, $field, $value );
	
	return $output;
	
}


/**
 * Output an "Insert field" button populated with $fields
 * $floating adds class "floating" to the wrapper making the button float right in an input field
 *
 * @since 1.1.1
 *
 */
function _af_field_inserter_button( $form, $type = 'all', $floating = false ) {
	
	$fields = af_get_form_fields( $form, $type );
	
	
	$classses = ( $floating ) ? 'floating' : '';
	
	echo '<a class="af-field-dropdown ' . $classses . ' button">Insert field';
		
	echo '<div class="af-dropdown">';
	
	if ( 'all' == $type ) {
		
		echo sprintf( '<div class="field-option" data-insert-value="{all_fields}">%s</div>', __( 'All fields', 'advanced-forms' ) );
		echo '<div class="field-divider"></div>';
		
	}
	
	foreach ( $fields as $field ) {
		
		echo sprintf( '<div class="field-option" data-insert-value="{field:%s}">', $field['name'] );
		echo sprintf( '<span class="field-name">%s</span><span class="field-type">%s</span>', $field['label'], acf_get_field_type_label( $field['type'] ) );
		echo '</div>';
		
	}
	
	echo '</div>';
		
	echo '</a>';
	
}


/**
 * Generates choices for a form field picker.
 * Returns an array with field key => field label suitable for usage with an ACF select field.
 *
 * $type can be either 'all' or 'regular'.
 *
 * @since 1.3.0
 *
 */
function _af_form_field_choices( $form_key, $type = 'all' ) {
	
	$form_fields = af_get_form_fields( $form_key, $type );
	
	$choices = array();
	
	if ( ! empty( $form_fields ) ) {
		
		foreach ( $form_fields as $field ) {
				
			$choices[ $field['key'] ] = $field['label'];
			
		}
		
	}
	
	
	return $choices;
	
}


/**
 * Retrieves full URL (with trailing slash) to the plugin assets folder
 *
 * @since 1.3.0
 *
 */
function af_assets_url( $path = '' ) {
	
	return plugin_dir_url( dirname( __FILE__ ) ) . 'assets/' . $path;
	
}