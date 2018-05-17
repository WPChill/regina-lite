<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Features
 */
$features = array(
	'homepage-slider'         => array(
		'label'      => 'Homepage Slider',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'homepage-gmaps'          => array(
		'label'      => 'Google Map section',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'multiple-sections'       => array(
		'label'      => 'Unlimited Sections',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'order-homepage-sections' => array(
		'label'      => 'Order Homepage Sections',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'multiple-services'       => array(
		'label'      => 'Unlimited Services',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'multiple-members'        => array(
		'label'      => 'Unlimited Members',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'multiple-testimonials'   => array(
		'label'      => 'Unlimited Testimonials',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'custom-icons'            => array(
		'label'      => 'Custom icons',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'dropdown-menu'           => array(
		'label'      => '3rd level drop-down menus',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'header-layout'           => array(
		'label'      => 'Header Layouts',
		'regina'     => '1',
		'regina-pro' => '3',
	),
	'color-schemes'           => array(
		'label'      => 'Color schemes',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'typography'              => array(
		'label'      => 'Typography',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'priority-support'        => array(
		'label'      => 'Priority support',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
	'security-updates'        => array(
		'label'      => 'Security updates & feature releases',
		'regina'     => '<span class="dashicons dashicons-no-alt"></span>',
		'regina-pro' => '<span class="dashicons dashicons-yes"></span></i>',
	),
);
?>
<div class="featured-section features">
	<table class="free-pro-table">
		<thead>
		<tr>
			<th></th>
			<th>Regina Lite</th>
			<th>Regina PRO</th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ( $features as $feature ) : ?>
			<tr>
				<td class="feature">
					<h3>
						<?php echo $feature['label']; ?>
					</h3>
				</td>
				<td class="regina-feature">
					<?php echo $feature['regina']; ?>
				</td>
				<td class="regina-pro-feature">
					<?php echo $feature['regina-pro']; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		<tr>
			<td></td>
			<td colspan="2" class="text-right"><a href="https://www.machothemes.com/theme/regina-pro/?utm_source=worg&utm_medium=about-page&utm_campaign=upsell" target="_blank"
							   class="button button-primary button-hero"><span class="dashicons dashicons-cart"></span> Get regina Pro!</a></td>
		</tr>
		</tbody>
	</table>
</div>
