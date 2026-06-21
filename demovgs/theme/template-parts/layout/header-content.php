<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package demoVGS
 */

?>

<header>
<main class="mx-auto px-4 max-w-6xl">
	<!-- Barra de contacto -->
	<section>
		<div class="flex flex-col md:flex-row md:items-center md:justify-between bg-[#9FCE00] h-[70px] md:px-[150px] px-4 gap-2">
			<!-- Izquierda: imagen pequeña + correo -->
			<div class="flex items-center gap-3 w-full md:w-auto justify-center md:justify-start">
				<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/email-icon.png" alt="icono" class="h-8 w-8 object-contain" />
				<a href="mailto:dominio@dominio.ess" class="text-white font-medium">dominio@dominio.es</a>
			</div>

			<!-- Derecha: botón redondeado blanco con imagen y texto -->
			<div class="w-full md:w-auto flex justify-center md:justify-end">
				<a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white">
					<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/phone-icon.png" alt="icono botón" class="h-5 w-5 object-contain" />
					<span class="text-[#072200] font-semibold">123 456 789</span>
				</a>
			</div>
		</div>
	</section>

	<?php echo do_shortcode('[cpt_slider]'); ?>
</main>

</header><!-- #masthead -->
