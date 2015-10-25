<?php

/**
 * Customize for disabled HTML elements, extend the WP customizer
 *
 * @since Riba Lite 1.0.3
 */
if( !class_exists('regina_lite_Disabled_Custom_Control') ) {
	class regina_lite_Disabled_Custom_Control extends WP_Customize_Control
	{

		public function render_content()
		{

			switch($this->type) {

				case 'textarea':
					echo '<div class="'.$this->type.'-pro-feature">';
					echo '<span class="pro-badge">PRO</span>';
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
		                  <textarea class="large-text" cols="20" rows="5" <?php $this->link(); ?> disabled >
		                    <?php echo esc_textarea($this->value()); ?>
		                  </textarea>
					</label>
					<?php echo '</div><!--/pro-feature-->';
				break;

				case 'text':
					echo '<div class="'.$this->type.'-pro-feature">';
					echo '<span class="pro-badge">PRO</span>';
					?>
					<label>
						<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
						<input type="text" value="<?php echo esc_html( $this->value() ); ?>" class="large-text" <?php $this->link(); ?> disabled >
					</label>


					<?php echo '</div><!--/pro-feature-->';
				break;

				case 'checkbox':
					echo '<div class="'.$this->type.'-pro-feature">';
					echo '<span class="pro-badge">PRO</span>';
					?>
					<label>
						<input type="checkbox" value="<?php echo esc_html( $this->value() ); ?>" <?php $this->link(); ?> disabled >
						<?php echo esc_html( $this->label ); ?>
					</label>


					<?php echo '</div><!--/pro-feature-->';
				break;

				case 'radio':
					echo '<div class="'.$this->type.'-pro-feature">';
					echo '<span class="pro-badge">PRO</span>';
					?>
					<label>
						<input type="radio" value="<?php echo esc_html( $this->value() ); ?>" <?php $this->link(); ?> disabled >
						<div><?php echo esc_html( $this->label ); ?></div>
					</label>


					<?php echo '</div><!--/pro-feature-->';
				break;

			} // end SWITCH statement
		}
	}
}