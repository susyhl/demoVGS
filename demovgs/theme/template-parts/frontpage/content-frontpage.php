<?php
/**
 * Template part for displaying front page content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package demoVGS
 */

?>


<main class="mx-auto px-4 max-w-6xl">

	<section class="features py-12">
		<h2 class="section-title text-2xl md:text-3xl font-bold text-center w-full mb-6">¿Por qué nuestro <span class="inline-block">PANEL SÁNDWICH<img class="block mt-2 max-w-full h-auto" src="<?php echo get_template_directory_uri(); ?>/assets/painting.png" alt="Descripción"></span>?</h2>

		<div class="mx-auto max-w-6xl px-4 grid gap-6 grid-cols-1 md:grid-cols-4 w-full">
			<article class="flex flex-col md:flex-row md:items-center gap-4 p-6 rounded-md bg-[rgba(232,237,239,0.4)]">
				<img class="w-16 md:w-20 block flex-shrink-0" src="<?php echo esc_url( get_template_directory_uri() . '/assets/image-c1.png' ); ?>" alt="Feature 1" />
				<p class="mt-2 md:mt-0 text-sm text-gray-600">Atención real y personalizada</p>
			</article>
			<article class="flex flex-col md:flex-row md:items-center gap-4 p-6 rounded-md bg-[rgba(232,237,239,0.4)]">
				<img class="w-16 md:w-20 block flex-shrink-0" src="<?php echo esc_url( get_template_directory_uri() . '/assets/image-c2.png' ); ?>" alt="Feature 2" />
				<p class="mt-2 md:mt-0 text-sm text-gray-600">Asesoramiento técnico y personalizado</p>
			</article>
			<article class="flex flex-col md:flex-row md:items-center gap-4 p-6 rounded-md bg-[rgba(232,237,239,0.4)]">
				<img class="w-16 md:w-20 block flex-shrink-0" src="<?php echo esc_url( get_template_directory_uri() . '/assets/image-c3.png' ); ?>" alt="Feature 3" />
				<p class="mt-2 md:mt-0 text-sm text-gray-600">Logística eficiente y adaptable</p>
			</article>
			<article class="flex flex-col md:flex-row md:items-center gap-4 p-6 rounded-md bg-[rgba(232,237,239,0.4)]">
				<img class="w-16 md:w-20 block flex-shrink-0" src="<?php echo esc_url( get_template_directory_uri() . '/assets/image-c4.png' ); ?>" alt="Feature 4" />
				<p class="mt-2 md:mt-0 text-sm text-gray-600">Compromiso con la calidad</p>
			</article>
		</div>
	</section>

</main>
