<?php
/**
 * Theme Customizer
 *
 * @package Gazipur_Update
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register customizer settings
 */
function gazipur_update_customize_register( $wp_customize ) {

	// Section: Theme Options
	$wp_customize->add_section( 'gazipur_theme_options', array(
		'title'    => esc_html__( 'Gazipur Theme Options', 'gazipur-update' ),
		'priority' => 30,
	) );

	// Breaking news label
	$wp_customize->add_setting( 'gazipur_breaking_label', array(
		'default'           => esc_html__( 'Breaking', 'gazipur-update' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'gazipur_breaking_label', array(
		'label'   => esc_html__( 'Breaking News Label', 'gazipur-update' ),
		'section' => 'gazipur_theme_options',
		'type'    => 'text',
	) );

	// Show ticker
	$wp_customize->add_setting( 'gazipur_show_ticker', array(
		'default'           => true,
		'sanitize_callback' => 'rest_sanitize_boolean',
	) );
	$wp_customize->add_control( 'gazipur_show_ticker', array(
		'label'   => esc_html__( 'Show Breaking News Ticker', 'gazipur-update' ),
		'section' => 'gazipur_theme_options',
		'type'    => 'checkbox',
	) );

	// Primary color accent
	$wp_customize->add_setting( 'gazipur_accent_color', array(
		'default'           => '#dc2626',
		'sanitize_callback' => 'sanitize_hex_color',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'gazipur_accent_color', array(
		'label'   => esc_html__( 'Accent Color', 'gazipur-update' ),
		'section' => 'gazipur_theme_options',
	) ) );

	// Footer copyright override
	$wp_customize->add_setting( 'gazipur_footer_text', array(
		'default'           => '',
		'sanitize_callback' => 'wp_kses_post',
	) );
	$wp_customize->add_control( 'gazipur_footer_text', array(
		'label'       => esc_html__( 'Custom Footer Text', 'gazipur-update' ),
		'description' => esc_html__( 'Leave empty to use default copyright.', 'gazipur-update' ),
		'section'     => 'gazipur_theme_options',
		'type'        => 'textarea',
	) );
}
add_action( 'customize_register', 'gazipur_update_customize_register' );

/**
 * Meta box: Mark post as Breaking News
 */
function gazipur_update_add_breaking_meta_box() {
	add_meta_box(
		'gazipur_breaking_news',
		esc_html__( 'Breaking News', 'gazipur-update' ),
		'gazipur_update_breaking_meta_box_callback',
		'post',
		'side',
		'high'
	);
}
add_action( 'add_meta_boxes', 'gazipur_update_add_breaking_meta_box' );

function gazipur_update_breaking_meta_box_callback( $post ) {
	wp_nonce_field( 'gazipur_breaking_nonce', 'gazipur_breaking_nonce_field' );
	$value = get_post_meta( $post->ID, '_gazipur_breaking_news', true );
	?>
	<label class="selectit">
		<input type="checkbox" name="gazipur_breaking_news" value="1" <?php checked( $value, '1' ); ?> />
		<?php esc_html_e( 'Mark as Breaking News (appears in ticker)', 'gazipur-update' ); ?>
	</label>
	<?php
}

function gazipur_update_save_breaking_meta( $post_id ) {
	if ( ! isset( $_POST['gazipur_breaking_nonce_field'] ) ||
		 ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['gazipur_breaking_nonce_field'] ) ), 'gazipur_breaking_nonce' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$value = isset( $_POST['gazipur_breaking_news'] ) ? '1' : '';
	update_post_meta( $post_id, '_gazipur_breaking_news', $value );
}
add_action( 'save_post', 'gazipur_update_save_breaking_meta' );
