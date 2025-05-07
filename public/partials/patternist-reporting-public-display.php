<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://https://github.com/shaon-hossain45/
 * @since      1.0.0
 *
 * @package    Patternist_Reporting
 * @subpackage Patternist_Reporting/public/partials
 */
?>
<?php
if ( ! class_exists( 'Patternist_Reporting_Public_Display' ) ) {
	class Patternist_Reporting_Public_Display {

        private $data;
		const CRON_HOOK = 'retrograde_daily_cron';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
		public function __construct() {
             $this->data = $this->template_data();
			add_shortcode( 'patternist_reporting', array( $this, 'template_shortcode' ) );
			add_action('admin_menu', array( $this, 'add_settings_page' ) );
			add_action('admin_init', array( $this, 'register_settings' ) );

			add_action( 'init', [ $this, 'schedule_cron' ] );
			add_action( self::CRON_HOOK, [ $this, 'run_cron_check' ] );

		}

   /**
	 * Audio update setting
	 *
	 * @return [type] [description]
	 */
	public function template_shortcode(  $atts, $content = null, $tag = '' ) {

        $risk_label = $this->data['result']['risk_label'];
        $risk_score = $this->data['result']['risk_score'];
        $angle = $this->data['angle'];

        ob_start(); // Start output buffering
        ?>
        <div class="patternist-reporting">
		    <h2>Patternist Report</h2>
        </div>
        <div class="market-fng-gauge">
            <div class="market-fng-gauge__meter-container">
                <div class="market-fng-gauge__meter" data-index-label="<?php echo strtolower(str_replace(' ', '-', $risk_label)); ?>">
                    <!-- dial ranges -->
                    <div class="market-fng-gauge__dial">
                    <?xml version="1.0" encoding="utf-8"?>
<!-- Generator: Adobe Illustrator 24.0.1, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
<svg version="1.1" id="fear-and-greed-dial" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
	 x="0px" y="0px" viewBox="0 0 650 333" style="enable-background:new 0 0 650 333;" xml:space="preserve">
<title  id="market-fng-gauge__title">Fear &amp; Greed Index - Investor Sentiment</title>
<desc  id="market-fng-gauge__description">Fear &amp; Greed Index is a way to gauge stock market
                                movements and whether stocks are fairly priced. The index uses seven market indicators to
                                help answer the question: What emotion is driving the market now?
	</desc>
<path id="extremely-high" class="st0" d="M559.8,102.8l-87.7,85c34.2,36.3,55.2,85.2,55.2,138.8h121.9
	C649.2,240,615.2,161.1,559.8,102.8L559.8,102.8z"/>
<path id="high" class="st0" d="M550.8,93.9l0.2-0.2C488.7,33.4,408.4,2.9,328,2.1v122.1c11.8,0.2,23.5,1.4,35.1,3.6l0,0
	c40.6,7.9,76.9,27.7,105,56l87.7-85C554.1,97.2,552.5,95.5,550.8,93.9z"/>
<path id="low" class="st0" d="M89.4,102.8l87.7,85c-34.2,36.3-55.2,85.2-55.2,138.8H0C0,240,34,161.1,89.4,102.8L89.4,102.8z"/>
<path id="moderate" class="st0" d="M270.8,131.6c0.1,0,0.2-0.1,0.3-0.1c1.3-0.4,2.7-0.7,4-1c0.9-0.2,1.8-0.4,2.7-0.7
	c0.4-0.1,0.8-0.2,1.2-0.3c1.1-0.2,2.1-0.5,3.2-0.7c0.2,0,0.4-0.1,0.6-0.1c1.2-0.2,2.3-0.5,3.5-0.7l0,0c11.8-2.3,23.7-3.5,35.7-3.7
	V2.2c-22.3,0.2-44.6,2.7-66.5,7.5l0,0c-62.7,13.5-118.5,45-162,89l87.6,85.1c0.9-0.9,1.8-1.8,2.7-2.6l0.2,0.2
	c24.1-23.3,52.5-39.5,82.6-48.5c0,0,0,0,0.1,0C268,132.4,269.4,131.9,270.8,131.6z"/>
<g id="meter-point">
	<g>
		<path class="st1" d="M489.4,322.3v1.7h-5.2h-3.7v-1.7h3.7v-8.7h-4v-1.5c1.2,0,1.9,0,2.5-0.2s1-0.6,1.3-1s0.6-1.2,0.6-1.9h1.7v13.3
			L489.4,322.3L489.4,322.3z"/>
		<path class="st1" d="M492.3,322.3c-1-1.3-1.3-3.3-1.3-6s0.4-4.6,1.3-6c1-1.3,2.3-1.9,4-1.9s3.3,0.6,4,1.9c1,1.3,1.3,3.3,1.3,6
			s-0.4,4.6-1.3,6c-1,1.3-2.3,1.9-4,1.9C494.6,324.2,493.1,323.6,492.3,322.3z M498.3,321.9c0.6-0.4,1-1.2,1.2-1.9s0.4-2.1,0.4-3.5
			c0-2.1-0.4-3.7-1-4.6c-0.6-1-1.5-1.3-2.7-1.3c-0.8,0-1.3,0.2-1.9,0.6s-1,1-1.2,1.9s-0.4,2.1-0.4,3.5c0,2.1,0.2,3.7,0.8,4.6
			c0.6,1,1.3,1.3,2.5,1.3C497.1,322.5,497.7,322.3,498.3,321.9z"/>
		<path class="st1" d="M505.2,322.3c-1-1.3-1.3-3.3-1.3-6s0.4-4.6,1.3-6c1-1.3,2.3-1.9,4-1.9s3.3,0.6,4,1.9c1,1.3,1.3,3.3,1.3,6
			s-0.4,4.6-1.3,6c-1,1.3-2.3,1.9-4,1.9C507.5,324.2,506,323.6,505.2,322.3z M511.2,321.9c0.6-0.4,1-1.2,1.2-1.9s0.4-2.1,0.4-3.5
			c0-2.1-0.4-3.7-1-4.6c-0.6-1-1.5-1.3-2.7-1.3c-0.8,0-1.3,0.2-1.9,0.6s-1,1-1.2,1.9s-0.4,2.1-0.4,3.5c0,2.1,0.2,3.7,0.8,4.6
			c0.6,1,1.3,1.3,2.5,1.3C510,322.5,510.6,322.3,511.2,321.9z"/>
	</g>
	<g>
		<path class="st1" d="M187.5,202.5c0-1,0.2-1.9,0.8-2.9s1.3-1.7,2.3-2.5l2.7-2.1c0.6-0.4,1-0.8,1.3-1.2c0.4-0.4,0.6-0.6,0.6-1
			s0.2-0.8,0.2-1.2c0-0.8-0.2-1.3-0.8-1.9c-0.6-0.4-1.2-0.8-2.1-0.8c-1,0-1.7,0.2-2.3,0.8s-0.8,1.3-0.8,2.5h-2.1
			c0-1.2,0.2-2.1,0.6-2.9c0.4-0.8,1-1.3,1.7-1.7c0.8-0.4,1.7-0.6,2.7-0.6s1.9,0.2,2.7,0.6c0.8,0.4,1.3,1,1.7,1.5
			c0.4,0.6,0.6,1.3,0.6,2.3c0,0.8-0.2,1.5-0.6,2.3c-0.4,0.6-1,1.3-1.7,1.9l-2.7,2.1c-0.8,0.6-1.2,1-1.7,1.5c-0.4,0.6-0.6,1-0.8,1.5
			h7.7v1.7h-10.2v-0.2h0.2V202.5z"/>
		<path class="st1" d="M202.5,202.8c-0.8-0.4-1.3-0.8-1.9-1.3c-0.4-0.6-0.8-1.3-0.8-2.1h2.1c0.2,0.6,0.4,1.2,1,1.5
			c0.6,0.4,1.3,0.6,2.3,0.6c0.8,0,1.3-0.2,1.9-0.4c0.6-0.4,1-0.8,1.2-1.2s0.4-1.2,0.4-1.7c0-0.6-0.2-1.2-0.4-1.7s-0.6-1-1.2-1.2
			c-0.6-0.2-1.2-0.4-1.7-0.4c-0.6,0-1.2,0.2-1.7,0.4c-0.6,0.2-1,0.6-1.3,1h-1.9l1-8.3h8.7v1.7h-6.7l-0.6,4.6c0.4-0.4,1-0.6,1.5-0.8
			s1.2-0.4,1.9-0.4c1,0,1.7,0.2,2.5,0.6c0.8,0.4,1.3,1,1.7,1.7c0.4,0.8,0.6,1.5,0.6,2.7c0,1-0.2,1.9-0.6,2.7
			c-0.4,0.8-1.2,1.3-1.9,1.9c-0.8,0.4-1.7,0.6-2.9,0.6C204.2,203.4,203.3,203.2,202.5,202.8z"/>
	</g>
	<g>
		<path class="st1" d="M316.7,150c-0.8-0.4-1.3-0.8-1.9-1.3c-0.4-0.6-0.8-1.3-0.8-2.1h2.1c0.2,0.6,0.4,1.2,1,1.5s1.3,0.6,2.3,0.6
			c0.8,0,1.3-0.2,1.9-0.4c0.6-0.4,1-0.8,1.2-1.2s0.4-1.2,0.4-1.7c0-0.6-0.2-1.2-0.4-1.7c-0.2-0.6-0.6-1-1.2-1.2s-1.2-0.4-1.7-0.4
			s-1.2,0.2-1.7,0.4c-0.6,0.2-1,0.6-1.3,1h-1.9l1-8.3h8.7v1.7h-6.9l-0.6,4.6c0.4-0.4,1-0.6,1.5-0.8s1.2-0.4,1.9-0.4
			c1,0,1.7,0.2,2.5,0.6c0.8,0.4,1.3,1,1.7,1.7c0.4,0.8,0.6,1.5,0.6,2.7c0,1-0.2,1.9-0.6,2.7s-1.2,1.3-1.9,1.9
			c-0.8,0.4-1.7,0.6-2.9,0.6C318.5,150.5,317.5,150.3,316.7,150z"/>
		<path class="st1" d="M328.3,148.6c-1-1.3-1.3-3.3-1.3-6s0.4-4.6,1.3-6c1-1.3,2.3-1.9,4-1.9s3.3,0.6,4,1.9c1,1.3,1.3,3.3,1.3,6
			s-0.4,4.6-1.3,6s-2.3,1.9-4,1.9C330.6,150.5,329.2,149.8,328.3,148.6z M334.4,148c0.6-0.4,1-1.2,1.2-1.9c0.2-0.8,0.4-2.1,0.4-3.5
			c0-2.1-0.4-3.7-1-4.6c-0.6-1-1.5-1.3-2.7-1.3c-0.8,0-1.3,0.2-1.9,0.6c-0.6,0.4-1,1-1.2,1.9c-0.2,1-0.4,2.1-0.4,3.5
			c0,2.1,0.2,3.7,0.8,4.6c0.6,1,1.3,1.3,2.5,1.3S333.8,148.4,334.4,148z"/>
	</g>
	<g>
		<path class="st1" d="M442.3,198c0.6-1.7,1.2-3.1,2.1-4.4c0.8-1.3,1.7-2.5,2.9-3.7h-8.1v-1.7h10.4v1.7c-1.7,1.7-3.3,3.8-4.2,6
			c-1,2.3-1.5,4.8-1.5,7.3h-2.3C441.5,201.3,441.7,199.6,442.3,198z"/>
		<path class="st1" d="M453.3,202.8c-0.8-0.4-1.3-0.8-1.9-1.3c-0.4-0.6-0.8-1.3-0.8-2.1h2.1c0.2,0.6,0.4,1.2,1,1.5
			c0.6,0.4,1.3,0.6,2.3,0.6c0.8,0,1.3-0.2,1.9-0.4c0.6-0.4,1-0.8,1.2-1.2c0.2-0.6,0.4-1.2,0.4-1.7c0-0.6-0.2-1.2-0.4-1.7
			c-0.2-0.6-0.6-1-1.2-1.2s-1.2-0.4-1.7-0.4c-0.6,0-1.2,0.2-1.7,0.4c-0.6,0.2-1,0.6-1.3,1h-1.9l1-8.3h8.7v1.7h-6.9l-0.6,4.6
			c0.4-0.4,1-0.6,1.5-0.8s1.2-0.4,1.9-0.4c1,0,1.7,0.2,2.5,0.6c0.8,0.4,1.3,1,1.7,1.7c0.4,0.8,0.6,1.5,0.6,2.7c0,1-0.2,1.9-0.6,2.7
			s-1.2,1.3-1.9,1.9c-0.8,0.4-1.7,0.6-2.9,0.6C455,203.4,454,203.2,453.3,202.8z"/>
	</g>
	<g>
		<path class="st1" d="M136.3,322.3c-1-1.3-1.3-3.3-1.3-6s0.4-4.6,1.3-6c1-1.3,2.3-1.9,4-1.9s3.3,0.6,4,1.9c1,1.3,1.3,3.3,1.3,6
			s-0.4,4.6-1.3,6c-1,1.3-2.3,1.9-4,1.9S137.1,323.6,136.3,322.3z M142.3,321.9c0.6-0.4,1-1.2,1.2-1.9s0.4-2.1,0.4-3.5
			c0-2.1-0.4-3.7-1-4.6c-0.6-1-1.5-1.3-2.7-1.3c-0.8,0-1.3,0.2-1.9,0.6c-0.6,0.4-1,1-1.2,1.9s-0.4,2.1-0.4,3.5
			c0,2.1,0.2,3.7,0.8,4.6c0.6,1,1.3,1.3,2.5,1.3C141.2,322.5,141.7,322.3,142.3,321.9z"/>
	</g>
	<path class="st1" d="M505.8,294.6c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7s2.1,0.2,2.7-0.8C506.9,296.3,506.7,295.2,505.8,294.6
		 M499,266.7c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7s2.1,0.2,2.7-0.8C500.4,268.4,500,267.3,499,266.7 M487.9,240.3
		c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C489,242.1,488.8,240.9,487.9,240.3 M473.1,215.9
		c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C474.2,217.7,474,216.5,473.1,215.9 M432.3,175.3
		c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C433.7,177.1,433.3,175.7,432.3,175.3 M408.3,160.7
		c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C409.6,162.5,409.2,161.3,408.3,160.7 M381.9,149.8
		c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C383.1,151.5,382.9,150.3,381.9,149.8 M354,143.4
		c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C355.2,145.2,355,144,354,143.4 M297.7,143.4
		c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C298.8,145.2,298.7,144,297.7,143.4 M269.2,149.8
		c-1-0.6-2.1-0.2-2.7,0.8s-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8S270.2,150.3,269.2,149.8 M242.9,160.7c-1-0.6-2.1-0.2-2.7,0.8
		c-0.6,1-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C244,162.5,243.8,161.3,242.9,160.7 M218.8,176.1c-1-0.6-2.1-0.2-2.7,0.8
		c-0.6,1-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C220,177.8,219.8,176.7,218.8,176.1 M178.5,216.1c-1-0.6-2.1-0.2-2.7,0.8
		c-0.6,1-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C179.6,217.8,179.4,216.7,178.5,216.1 M162.9,240.3c-1-0.6-2.1-0.2-2.7,0.8
		c-0.6,1-0.2,2.1,0.8,2.7c1,0.6,2.1,0.2,2.7-0.8C164.2,241.9,163.8,240.7,162.9,240.3 M151.7,266.7c-1.2,0-1.9,0.8-1.9,1.9
		c0,1.2,0.8,1.9,1.9,1.9c1.2,0,1.9-0.8,1.9-1.9C153.7,267.5,152.7,266.7,151.7,266.7 M146.5,296.3c0,1.2-0.8,1.9-1.9,1.9
		s-1.9-0.8-1.9-1.9c0-1.2,0.8-1.9,1.9-1.9C145.6,294.4,146.5,295.2,146.5,296.3"/>
</g>
<g id="low-text">
	<g id="L" class="st2">
		<path class="st3" d="M42.3,236.8l1.2-3.6l13.4,4.4l1.8-5.3l3.1,1l-3,8.9L42.3,236.8z"/>
	</g>
	<g id="O" class="st2">
		<path class="st3" d="M58.4,217.8c5.6,2,7.8,4.9,6.4,8.9c-0.7,2-1.9,3.2-3.7,3.7c-1.8,0.5-4.1,0.3-6.8-0.7c-5.6-2-7.7-4.9-6.4-8.9
			c0.7-1.9,1.9-3.2,3.6-3.7C53.3,216.6,55.6,216.8,58.4,217.8z M57.1,221.6c-2.2-0.8-3.7-1.1-4.6-1c-0.9,0.1-1.4,0.5-1.7,1.3
			c-0.3,0.7-0.1,1.4,0.5,2c0.6,0.6,2,1.3,4.2,2c2.2,0.8,3.7,1.1,4.6,1c0.9-0.1,1.4-0.5,1.7-1.2c0.3-0.7,0.1-1.4-0.5-2
			C60.7,223,59.3,222.3,57.1,221.6z"/>
	</g>
	<g class="st2">
		<path class="st3" d="M51,213.5l1.6-3.6l11.7,3.2l-10-6.9l1.4-3.2l11.9,2.9l-10.2-6.8l1.3-2.9L73,206.6l-1.4,3.1l-12-2.7l10.1,7
			l-1.4,3.1L51,213.5z"/>
	</g>
</g>
<g id="moderate-text">
	<g id="M" class="st2">
		<path class="st3" d="M160.3,80.1l4.7-2.9l7.7,7.8l-3.3-10.5l4.6-2.9l9.1,14.7l-3,1.9l-7.6-12.3l4.6,14.2l-2.4,1.5l-10.4-10.6
			l7.6,12.3l-2.6,1.6L160.3,80.1z"/>
	</g>
	<g id="O_1_" class="st2">
		<path class="st3" d="M190.7,72.2c3.1,5.1,2.9,8.7-0.6,10.9c-1.8,1.1-3.5,1.3-5.2,0.5c-1.7-0.7-3.3-2.3-4.9-4.8
			c-3.1-5.1-2.9-8.7,0.7-10.9c1.7-1.1,3.5-1.3,5.2-0.6C187.5,68.1,189.2,69.7,190.7,72.2z M187.3,74.3c-1.2-2-2.2-3.2-2.9-3.7
			c-0.7-0.5-1.4-0.5-2.1-0.1c-0.7,0.4-1,1-0.9,1.9s0.8,2.3,2,4.3c1.2,1.9,2.2,3.2,2.9,3.7c0.7,0.5,1.4,0.5,2.1,0.1
			c0.7-0.4,1-1,0.9-1.9C189.2,77.7,188.6,76.3,187.3,74.3z"/>
	</g>
	<g id="D" class="st2">
		<path class="st3" d="M188.5,64l3.6-1.9c1.6-0.8,3-1.3,4.2-1.4c1.2-0.1,2.4,0.3,3.6,1.1s2.3,2.2,3.3,4.2c0.7,1.4,1.2,2.7,1.4,4
			c0.2,1.3,0.2,2.3-0.1,3.3c-0.3,0.9-0.7,1.7-1.3,2.3c-0.6,0.6-1.5,1.2-2.6,1.8l-4,2.1L188.5,64z M193.2,64.8l5.3,10.1l0.6-0.3
			c0.8-0.4,1.3-0.9,1.6-1.4c0.3-0.5,0.3-1.2,0.2-2.1c-0.1-0.9-0.6-2-1.3-3.4c-0.7-1.3-1.4-2.2-2-2.8c-0.7-0.6-1.3-0.9-1.8-0.9
			c-0.6,0-1.2,0.2-1.9,0.5L193.2,64.8z"/>
	</g>
	<g id="D_1_" class="st2">
		<path class="st3" d="M201.6,57.7l9.6-4.2l1.2,2.7l-6.2,2.7l1.6,3.7l4.8-2.1l1.2,2.7l-4.8,2.1l1.7,3.9l6.2-2.7l1.2,2.8l-9.6,4.2
			L201.6,57.7z"/>
	</g>
	<g id="R" class="st2">
		<path class="st3" d="M213.2,52.9l5-2.1c1-0.4,1.7-0.7,2.3-0.8s1.2-0.1,1.9,0.1c0.7,0.2,1.3,0.5,1.9,1.1c0.6,0.6,1.1,1.3,1.4,2.1
			c0.8,2,0.7,3.7-0.5,5.2l5.9,5.8l-3.8,1.6l-4.8-5.4l-1.8,0.7l2.6,6.3l-3.5,1.5L213.2,52.9z M217.8,54.1l1.9,4.5l1.5-0.6
			c1.4-0.6,1.7-1.6,1.1-3.2c-0.2-0.5-0.5-0.9-0.8-1.2c-0.3-0.3-0.7-0.4-1-0.4c-0.3,0-0.7,0.1-1.3,0.3L217.8,54.1z"/>
	</g>
	<g id="A" class="st2">
		<path class="st3" d="M231.4,46.2l3.6-1.2l10.2,14.8l-3.7,1.2l-2-3.1l-4.6,1.6l0.3,3.7l-3.3,1.1L231.4,46.2z M237.9,55.3l-3.9-6.2
			l0.7,7.3L237.9,55.3z"/>
	</g>
	<g id="T" class="st2">
		<path class="st3" d="M240,43.5l10.4-2.9l0.9,3.1l-3.4,1l3.8,13.5l-3.7,1l-3.8-13.5l-3.3,0.9L240,43.5z"/>
	</g>
	<g id="E" class="st2">
		<path class="st3" d="M252.2,40.1l10.2-2.5l0.7,2.9l-6.5,1.6l1,3.9l5.1-1.3l0.7,2.9l-5.1,1.3l1,4.1l6.5-1.6l0.7,3l-10.2,2.5
			L252.2,40.1z"/>
	</g>
</g>
<g id="high-text">
	<g id="H" class="st2">
		<path class="st3" d="M416.7,45.3l3.6,1.3l-2.3,6.6l3.9,1.4l2.3-6.6l3.6,1.3l-5.7,16.4l-3.6-1.3l2.3-6.7l-3.9-1.4l-2.3,6.7
			l-3.6-1.3L416.7,45.3z"/>
	</g>
	<g id="I" class="st2">
		<path class="st3" d="M431,50.5l3.6,1.3l-6.1,16.2l-3.6-1.3L431,50.5z"/>
	</g>
	<g class="st2">
		<path class="st3" d="M440.3,63.1l5.6,2.3l-3.5,8.6l-1.5-0.6l0.3-2c-1.4,1-3,1.2-4.7,0.5c-1.8-0.7-3-2-3.5-3.9
			c-0.5-1.9-0.2-4,0.8-6.5c1.1-2.6,2.4-4.5,4.1-5.6c1.7-1.1,3.6-1.3,5.6-0.4c3.3,1.3,4.4,3.9,3.3,7.7l-3.4-0.8
			c0.6-2.2,0.3-3.6-1-4.1c-0.8-0.3-1.6-0.2-2.4,0.4c-0.8,0.6-1.6,2-2.5,4.1c-0.8,1.9-1.1,3.4-1,4.3s0.7,1.6,1.6,2
			c1.4,0.6,2.6-0.2,3.5-2.3l-2.4-1L440.3,63.1z"/>
	</g>
	<g id="H_1_" class="st2">
		<path class="st3" d="M452.6,59.5l3.4,1.7l-3.1,6.3l3.7,1.8l3.1-6.3l3.4,1.7l-7.6,15.6l-3.4-1.7l3.1-6.4l-3.7-1.8l-3.1,6.4
			l-3.4-1.7L452.6,59.5z"/>
	</g>
</g>
<g id="extremely-high-text">
	<g id="H_3_" class="st2">
		<path class="st3" d="M558.1,209.9l1.6,3.5l-6.4,2.9l1.7,3.8l6.4-2.9l1.6,3.5l-15.8,7.2l-1.6-3.5l6.4-2.9l-1.7-3.8l-6.4,2.9
			l-1.6-3.5L558.1,209.9z"/>
	</g>
	<g id="I_1_" class="st2">
		<path class="st3" d="M564.3,223.9l1.5,3.5l-15.9,6.8l-1.5-3.5L564.3,223.9z"/>
	</g>
	<g class="st2">
		<path class="st3" d="M561.7,239.3l2.2,5.6l-8.6,3.4l-0.6-1.5l1.7-1.2c-1.7-0.3-2.9-1.3-3.6-3.1c-0.7-1.8-0.6-3.6,0.4-5.2
			c1-1.6,2.7-3,5.2-3.9c2.7-1.1,5-1.4,6.9-0.9c2,0.4,3.4,1.7,4.2,3.8c1.3,3.3,0.2,5.9-3.3,7.7l-1.8-3c2-1.1,2.8-2.2,2.2-3.5
			c-0.3-0.8-1-1.3-1.9-1.4c-1-0.2-2.5,0.2-4.7,1c-1.9,0.8-3.2,1.5-3.8,2.3c-0.6,0.8-0.7,1.6-0.4,2.5c0.6,1.4,1.9,1.7,4.1,0.9l-1-2.4
			L561.7,239.3z"/>
	</g>
	<g id="H_2_" class="st2">
		<path class="st3" d="M572.8,245.6l1.2,3.6l-6.7,2.1l1.3,4l6.7-2.1l1.2,3.6l-16.5,5.3l-1.2-3.6l6.7-2.2l-1.3-4l-6.7,2.2l-1.2-3.6
			L572.8,245.6z"/>
	</g>
	<g id="E_1_" class="st2">
		<path class="st3" d="M574.1,163.7l5.3,9.1l-2.6,1.5l-3.4-5.8l-3.5,2l2.6,4.5l-2.6,1.5l-2.6-4.5l-3.7,2.1l3.4,5.8l-2.7,1.6
			l-5.3-9.1L574.1,163.7z"/>
	</g>
	<g id="X" class="st2">
		<path class="st3" d="M580.5,174.4l2,3.7l-3,4l5-0.2l1.7,3.2l-8.8,0.2l-6.1,8.6l-2-3.7l3.8-4.9l-6.3,0.2l-1.7-3.2l10.1-0.1
			L580.5,174.4z"/>
	</g>
	<g id="T_1_" class="st2">
		<path class="st3" d="M587.1,186.7l4.7,9.8l-2.9,1.4l-1.5-3.2l-12.7,6.1l-1.6-3.4l12.7-6.1l-1.5-3.1L587.1,186.7z"/>
	</g>
	<g id="R_1_" class="st2">
		<path class="st3" d="M592.7,198.3l2.3,4.9c0.5,1,0.8,1.7,0.9,2.3s0.2,1.2,0,1.9c-0.1,0.7-0.5,1.4-1,2c-0.5,0.6-1.2,1.1-2,1.5
			c-2,0.9-3.7,0.8-5.2-0.3l-5.5,6.1l-1.8-3.8l5.2-5l-0.8-1.7l-6.2,2.9l-1.6-3.4L592.7,198.3z M591.7,202.9l-4.4,2.1l0.7,1.5
			c0.6,1.3,1.7,1.7,3.2,1c0.5-0.2,0.9-0.5,1.1-0.9c0.2-0.4,0.4-0.7,0.4-1s-0.1-0.7-0.4-1.2L591.7,202.9z"/>
	</g>
	<g id="E_2_" class="st2">
		<path class="st3" d="M598.9,212.2l3.9,9.8L600,223l-2.5-6.3l-3.7,1.5l1.9,4.9l-2.8,1.1l-1.9-4.9l-4,1.6l2.5,6.3l-2.9,1.1l-3.9-9.8
			L598.9,212.2z"/>
	</g>
	<g id="M_1_" class="st2">
		<path class="st3" d="M603.7,224.8l1.7,5.3l-9.4,5.6l11-0.6l1.7,5.2l-16.5,5.3l-1.1-3.4l13.8-4.4l-14.9,1.1l-0.8-2.6l12.8-7.5
			l-13.8,4.4l-0.9-3L603.7,224.8z"/>
	</g>
	<g id="E_3_" class="st2">
		<path class="st3" d="M609.4,242.5l2.8,10.1l-2.9,0.8l-1.8-6.5l-3.9,1.1l1.4,5l-2.9,0.8l-1.4-5l-4.1,1.2l1.8,6.5l-3,0.8l-2.8-10.1
			L609.4,242.5z"/>
	</g>
	<g id="L_1_" class="st2">
		<path class="st3" d="M612.7,254.5l1,3.7l-13.6,3.5l1.4,5.4l-3.1,0.8l-2.4-9.1L612.7,254.5z"/>
	</g>
	<g id="Y" class="st2">
		<path class="st3" d="M615,264.3l0.8,4.1L610,272l6.7,1.4l0.7,3.7l-10.7-2.8l-7.2,1.4l-0.7-3.7l7.2-1.4L615,264.3z"/>
	</g>
</g>
</svg>
                    </div>

                    <!-- dial hand needle -->
                    <div class="market-fng-gauge__hand">
                        <svg class="market-fng-gauge__hand-svg" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 10 124" style="transform: rotate(<?php echo $angle; ?>deg)" preserveAspectRatio="xMidYMid meet">
                            <path d="M5,0.2c-0.6,0-1.1,0.5-1.1,1.1L0.8,106.7c0,2.3-0.1,13.6,2.6,16.3c0.6,0.6,1.3,0.7,1.8,0.7l0,0c0.5,0,1.1-0.2,1.7-0.9c0.1-0.2,0.3-0.3,0.4-0.5c2.2-3.6,1.7-13.9,1.6-16L6.1,1.3C6.1,0.7,5.6,0.2,5,0.2"></path>
                        </svg>
                    </div>

                    <!-- dial hand base -->
                    <div class="market-fng-gauge__hand-base"></div>

                    <!-- dial hand number -->
                    <div class="market-fng-gauge__dial-number">
                        <span class="market-fng-gauge__dial-number-value"><?php echo $risk_score; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php
        return ob_get_clean(); // Return the buffered output
	}



    public function template_data() {

		$retro_data = self::get_retro_data();
        
        $result = $this->get_today_risk_score($retro_data);

        $angle = -90 + ($result['risk_score'] * 1.8); // Maps 0-100 to -90° to +90°

        return [
            'result' => $result,
            'angle'  => $angle,
        ];
    }


    // Low Moderate High Extremely High
    public function get_today_risk_score($data) {
        $today = new DateTime();

        $risk_map = [
            'Low'             => 0,
            'Moderate'        => 25,
            'High'            => 50,
            'Extremely High' => 75,
        ];
    
        foreach ($data as $row) {
            $start = DateTime::createFromFormat('d-m-Y', $row['start']);
            $end   = DateTime::createFromFormat('d-m-Y', $row['end']);
    
            if (!$start || !$end || $today < $start || $today > $end) {
                continue;
            }
    
            $base_score = $risk_map[$row['risk']] ?? 0;

			// Determine the next upper boundary
			$next_score = match ($row['risk']) {
				'Low'             => 25,
				'Moderate'        => 50,
				'High'            => 75,
				'Extremely High'  => 100,
				default           => 0,
			};

			// Calculate time-based progress
			$total_days  = $start->diff($end)->days;
			$days_passed = $start->diff($today)->days;
			$progress_ratio = $total_days > 0 ? ($days_passed / $total_days) : 0;

			// Scale only within this risk level's segment
			$final_score = $base_score + ($progress_ratio * ($next_score - $base_score));
			$final_score = min($next_score, round($final_score));

            return [
                'risk_label' => $row['risk'],
                'risk_score' => $final_score,
                'days_passed' => $days_passed,
                'total_days' => $total_days,
            ];
        }
    
        return [
            'risk_label' => 'Low',
            'risk_score' => 0,
            'days_passed' => 0,
            'total_days' => 0,
        ];
    }

	public function add_settings_page() {
        add_options_page(
            'Patternist Reporting Settings',
            'Patternist Reporting',
            'manage_options',
            'patternist-settings',
            array($this, 'render_settings_page')
        );
    }

    public function register_settings() {
        register_setting('patternist_settings_group', 'patternist_retro_data');

        add_settings_section(
            'patternist_retro_section',
            'Retrograde Risk Periods',
            '__return_false',
            'patternist-settings'
        );

        add_settings_field(
            'patternist_retro_data',
            'Retrograde Data (JSON format)',
            array($this, 'render_textarea_field'),
            'patternist-settings',
            'patternist_retro_section'
        );
    }

    public function render_textarea_field() {
        $value = get_option('patternist_retro_data', '');
        echo '<textarea name="patternist_retro_data" rows="10" cols="70" style="width:100%;">' . esc_textarea($value) . '</textarea>';
        echo '<p>Example: <code>[{"start": "01-05-2025", "end": "31-08-2025", "planet": "Mercury", "risk": "Moderate"}]</code></p>';
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Patternist Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('patternist_settings_group');
                do_settings_sections('patternist-settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    // Optional helper to get parsed retro data
    public static function get_retro_data() {
        $json = get_option('patternist_retro_data', '[]');
        return json_decode($json, true);
    }











	public function schedule_cron() {
        if ( ! wp_next_scheduled( self::CRON_HOOK ) ) {
            wp_schedule_event( $this->get_utc_timestamp_for_3am_melbourne(), 'daily', self::CRON_HOOK );
        }
    }

    private function get_utc_timestamp_for_3am_melbourne() {
        $date = new DateTime( 'now', new DateTimeZone( 'Australia/Melbourne' ) );
        $date->setTime( 3, 0, 0 ); // 3:00 AM
        return $date->getTimestamp();
    }

    public function run_cron_check() {
        $retro_data = self::get_retro_data();

        $today = ( new DateTime( 'now', new DateTimeZone( 'Australia/Melbourne' ) ) )->format( 'd-m-Y' );
        foreach ( $retro_data as $row ) {
            if ( $today === $row['start'] || $today === $row['end'] ) {
                $this->send_notification( $row );
            }
        }
    }

    private function send_notification( $row ) {
        // $admin = get_bloginfo( 'admin_email' );
		$admin = 'shaonhossain615@gmail.com';
        $subject = '📩 Retrograde Notification: ' . $row['planet'];
        $message = "
            <h2>Retrograde Alert for {$row['planet']}</h2>
            <p><strong>Risk:</strong> {$row['risk']}</p>
            <p><strong>Start Date:</strong> {$row['start']}</p>
            <p><strong>End Date:</strong> {$row['end']}</p>
        ";
        $headers = [ 'Content-Type: text/html; charset=UTF-8' ];

        if ( ! wp_mail( $admin, $subject, $message, $headers ) ) {
            // Fallback to PHP mail
            $headers_php  = 'MIME-Version: 1.0' . "\r\n";
            $headers_php .= 'Content-type:text/html;charset=UTF-8' . "\r\n";
            $headers_php .= 'From: ' . $admin . "\r\n";

            if ( ! mail( $admin, $subject, $message, $headers_php ) ) {
                error_log( 'Email sending failed using both wp_mail and PHP mail' );
            }
        }
    }

    }
}