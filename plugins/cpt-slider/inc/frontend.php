<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Return slides array from CPT 'sliders'
 */
function cpt_slider_get_items() {
    $args = array(
        'post_type' => 'sliders',
        'posts_per_page' => -1,
       // 'orderby' => 'menu_order',
        'order' => 'ASC',
    );
    $q = new WP_Query( $args );
    $items = array();
    if ( $q->have_posts() ) {
        while ( $q->have_posts() ) {
            $q->the_post();
            $id = get_the_ID();
            $grupo = get_field('slider');
            if ( $grupo ) {
                // Read fields from the ACF group stored in $grupo
                $raw_title = isset( $grupo['title'] ) ? $grupo['title'] : '';
                $raw_button_text = isset( $grupo['button_text'] ) ? $grupo['button_text'] : '';
                $raw_button_url = isset( $grupo['button_url'] ) ? $grupo['button_url'] : '';

                // Preserve HTML in the ACF `title` field; sanitize with wp_kses_post
                if ( is_string( $raw_title ) ) {
                    $title_text = wp_kses_post( $raw_title );
                } else {
                    $title_text = '';
                }

                $button_text = is_string( $raw_button_text ) ? trim( $raw_button_text ) : '';
                $button_url = is_string( $raw_button_url ) ? trim( $raw_button_url ) : '';
            } else {
                // No ACF group present: default to empty values (no CMB2/postmeta fallback)
                $title_text = '';
                $button_text = '';
                $button_url = '';
            }

            $img_url = get_the_post_thumbnail_url( $id, 'full' );

            $items[] = array(
                'title' => $title_text !== '' ? $title_text : get_the_title(),
                'image_id' => $img_url,
                'button_text' => $button_text,
                'button_url' => $button_url,
            );
        }
        wp_reset_postdata();
    }
    return $items;
}

/**
 * Shortcode to render slider markup. Basic markup only; integrate Swiper/JS as needed.
 * Usage: [cpt_slider]
 */
function cpt_slider_shortcode( $atts ) {
    $items = cpt_slider_get_items();
    if ( empty( $items ) ) {
        return '';
    }

    ob_start();
    ?>
    <div class="cpt-slider">
        <div class="cpt-slider-wrapper">
            <?php $__first_slide = true; foreach ( $items as $item ) : ?>
                    <?php
                        // Use image URL as background for the slide to position content on top
                        $bg_attr = '';
                        if ( ! empty( $item['image_id'] ) ) {
                            $img_url = trim( (string) $item['image_id'] );
                            if ( $img_url !== '' ) {
                                $bg_attr = ' style="background-image: url(' . esc_url( $img_url ) . ');"';
                            }
                        }
                    ?>
                                        <div class="cpt-slide"<?php echo $bg_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
                                            <div class="cpt-slide-inner">
                                                <?php if ( $__first_slide ) : ?>
                                                <div class="cpt-slide-controls">
                                                        <button class="cpt-slider-prev" aria-label="Previous slide"></button>
                                                        <button class="cpt-slider-next" aria-label="Next slide"></button>
                                                </div>
                                                <?php $__first_slide = false; endif; ?>
                                                <div class="cpt-slide-menu">
                            <button class="cpt-slide-menu-toggle" aria-expanded="false" aria-label="Abrir menú">
                                <span class="cpt-slide-menu-icon"></span>
                            </button>
                            <nav class="cpt-slide-menu-nav" aria-label="Slider quick links">
                                <ul class="cpt-slide-menu-list">
                                    <li><a href="#home">Cubierta</a></li>
                                    <li><a href="#features">Fachada</a></li>
                                    <li><a href="#contact">Lana de Roca</a></li>
                                    <li><a href="#contact">Panel Teja</a></li>
                                    <li><a href="#contact">Panel Segunda</a></li>
                                    <li><a href="#contact">Chapa</a></li>
                                    <li><a href="#contact">Rematería</a></li>
                                    <li><a href="#contact">Contacto</a></li>
                                </ul>
                            </nav>
                        </div>
                        <div class="cpt-slide-content">
                            <?php echo wp_kses_post( $item['title'] ); ?>
                            <?php if ( ! empty( $item['button_text'] ) ) : ?>
                                <a class="cpt-slide-btn" href="<?php echo esc_url( $item['button_url'] ); ?>"><span class="btn-gradient-text"><?php echo esc_html( $item['button_text'] ); ?></span></a>
                            <?php endif; ?>
                        </div>
                      </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode( 'cpt_slider', 'cpt_slider_shortcode' );
