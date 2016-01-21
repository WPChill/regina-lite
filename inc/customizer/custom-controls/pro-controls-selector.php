<?php

/**
 * Customize for disabled HTML elements, extend the WP customizer
 *
 * @since Riba Lite 1.0.3
 */
if( !class_exists('Regina_Lite_Disabled_Custom_Control') ) {
	class Regina_Lite_Disabled_Custom_Control extends WP_Customize_Control
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

/**
* Customize for premium features, extend the WP Customizer
*
*/
if( !class_exists('Regina_Lite_Theme_Support_Pricing') ) {
    class Regina_Lite_Theme_Support_Pricing extends WP_Customize_Control
    {
        public function render_content()
        { ?>

            <div class="pro-version">
                <?php _e('In order to be able to add pricing tables, you need to upgrade to the PRO version.', 'regina-lite'); ?>
            </div>

            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/regina-pro/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','regina-lite' ); ?></a>
            </div>

       <?php }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 */
if( !class_exists( 'Regina_Lite_Theme_Support' ) ) {
    class Regina_Lite_Theme_Support extends WP_Customize_Control
    {
        public function render_content()
        { ?>

            <div class="pro-version">
                <?php _e('In order to be able to change the section order, you need to upgrade to the PRO version.', 'regina-lite'); ?>
            </div>

            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/regina-pro/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','regina-lite' ); ?></a>
            </div>

       <?php }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 */
if( !class_exists( 'Regina_Lite_Theme_Support_Googlemap' ) ) {
    class Regina_Lite_Theme_Support_Googlemap extends WP_Customize_Control
    {
         public function render_content()
        { ?>

            <div class="pro-version">
                <?php _e('In order to be able to add Google Maps, you need to upgrade to the PRO version.', 'regina-lite'); ?>
            </div>

            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/regina-pro/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','regina-lite' ); ?></a>
            </div>

       <?php }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 */
if( !class_exists( 'Regina_Lite_WP_Document_Customizer_Control') ) {
    class Regina_Lite_WP_Document_Customize_Control extends WP_Customize_Control
    {

        //Render the control's content
        public function render_content()
        {
            ?>
            <div class="pro-box">
            <a href="<?php echo esc_url('http://www.machothemes.com/themes/regina-pro/');?>" target="_blank" class="document" id="review_pro"><?php _e('Theme Documentation', 'regina-lite'); ?></a>

            <div>
            <div class="pro-version">
                <?php _e('By upgrading to the PRO version you are unlocking the full potential of this theme. You will get: unlimited sliders / carousels, unlimited Google Maps, Unlimited Team Members, Section Ordering, Control over theme typography and colors. Upgrade NOW!', 'regina-lite'); ?>
            </div>
            <?php
        }
    }
}

/**
 * Customize for premium features, extend the WP Customizer
 *
 */
if( !class_exists( 'Regina_Lite_WP_Pro_Customize_Control' ) ) {
    class Regina_Lite_WP_Pro_Customize_Control extends WP_Customize_Control {

        //Render the control's content.
        public function render_content() {
            ?>
            <div class="pro-box">
                <a href="<?php echo esc_url('http://www.machothemes.com/themes/regina-pro/');?>" target="_blank" class="upgrade" id="review_pro"><?php _e( 'View PRO version','regina-lite' ); ?></a>
            </div>
            <?php
        }
    }
}
