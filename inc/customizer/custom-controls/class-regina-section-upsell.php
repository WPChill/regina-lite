<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Upsell customizer section.
 *
 * @since  1.0.0
 * @access public
 */
class Regina_Section_Upsell extends WP_Customize_Section {
	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'regina-section-upsell';
	/**
	 * @var string
	 */
	public $button_text = '';
	/**
	 * @var string
	 */
	public $button_url = '#';
	/**
	 * @var string
	 */
	public $second_button_text = '';
	/**
	 * @var string
	 */
	public $second_button_url = '#';
	/**
	 * @var string
	 */
	public $separator = '';
	/**
	 * @var array
	 */
	public $options = array();
	/**
	 * @var array
	 */
	public $requirements = array();

	/**
	 * Regina_Section_Upsell constructor.
	 *
	 * @param WP_Customize_Manager $manager
	 * @param string               $id
	 * @param array                $args
	 */
	public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
		$manager->register_section_type( 'Regina_Section_Upsell' );
		parent::__construct( $manager, $id, $args );
	}
	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	public function json() {
		$json = parent::json();
		/**
		 * Provide a fallback for the label
		 */
		$json['label'] = ! empty( $this->label ) ? $this->label : __( 'See what\'s in the PRO version', 'epsilon-framework' );
		/**
		 * Buttons
		 */
		$json['button_text']        = $this->button_text;
		$json['button_url']         = $this->button_url;
		$json['second_button_text'] = $this->second_button_text;
		$json['second_button_url']  = $this->second_button_url;
		/**
		 * Misc
		 */
		$json['separator'] = $this->separator;
		$json['allowed']   = $this->allowed;
		$arr               = array();
		$i                 = 0;
		foreach ( $this->options as $option ) {
			$arr[ $i ]['option'] = $option;
			$i ++;
		}
		$i = 0;
		foreach ( $this->requirements as $help ) {
			$arr[ $i ]['help'] = $help;
			$i ++;
		}
		$json['options'] = $arr;
		$json['id']      = $this->id;
		return $json;
	}
	/**
	 * Outputs the Underscore.js template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	protected function render_template() {
	?>
		<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand customize-control-epsilon-upsell">
			<div class="epsilon-upsell-label">
				{{{ data.label }}} <i class="dashicons dashicons-arrow-down-alt2"></i>
			</div>
			<div class="epsilon-upsell-container">
				<# if ( data.options ) { #>
					<ul class="epsilon-upsell-options">
						<# _.each(data.options, function( option, index) { #>
							<li><i class="dashicons dashicons-editor-help">
									<span class="mte-tooltip">{{{ option.help }}}</span>
								</i>
								{{ option.option }}
							</li>
							<# }) #>
					</ul>
				<# } #>

				<div class="epsilon-button-group">
					<# if ( data.button_text && data.button_url ) { #>
						<a href="{{ data.button_url }}" class="button" target="_blank">{{
							data.button_text }}</a>
					<# } #>

					<# if ( data.separator ) { #>
						<span class="button-separator">{{ data.separator }}</span>
					<# } #>

					<# if ( data.second_button_text && data.second_button_url ) { #>
						<a href="{{ data.second_button_url }}" class="button button-primary" target="_blank"> {{data.second_button_text }}</a>
					<# } #>
				</div>
			</div>
		</li>
			<?php
	}
}
