<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Patternist_Reporting
 * @subpackage Patternist_Reporting/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Patternist_Reporting
 * @subpackage Patternist_Reporting/admin
 * @author     Md Shaon Hossain <shaonhossain615@gmail.com>
 */
class Patternist_Reporting_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Patternist_Reporting_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Patternist_Reporting_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/patternist-reporting-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Patternist_Reporting_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Patternist_Reporting_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/patternist-reporting-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the settings for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function plugin_row_actions( $actions, $plugin_file ) {

		if ( is_plugin_active( $plugin_file ) && basename( dirname( plugin_dir_path( __FILE__ ) ) ) . '/patternist-reporting.php' === $plugin_file ) {
			$settings_page_url = admin_url( 'options-general.php?page=patternist-settings' );

			// Plugin row actions for active plugins.
			$actions['settings'] = '<a href="' . esc_url( $settings_page_url ) . '">' . esc_html__( 'Settings', 'patternist-reporting' ) . '</a>';
		}
		return $actions;
	}

}
