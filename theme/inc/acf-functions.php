<?php

function g2o_render_body( $field ) {
    if ( empty( $field ) ) {
        return;
    }
    ?>

    <div class="body">
        <?php
        $field
        ?>
    </div><!-- .wp-block-buttons .is-layout-flex -->
    <?php
}

/**
 * Use ACF Component: Button field to
 * emulate FSE Buttons blocks.
 *
 * @param array $buttons ACF fields.
 * @return void
 */
function g2o_render_buttons( $buttons = array() ) {
    // Make sure we have $args and array.
    if ( empty( $buttons ) ) {
        return;
    }

    ?>

    <div class="wp-block-buttons is-layout-flex">
        <?php
        foreach ( $buttons as $button ) {
            g2o_render_button( $button );
        }
        ?>
    </div><!-- .wp-block-buttons .is-layout-flex -->
    <?php
}

/**
 * Use ACF Component: Button field to
 * emulate FSE Button blocks.
 *
 * @param array $button ACF fields.
 * @return void
 */
function g2o_render_button( $button = array() ) {
    if ( empty( $button ) ) {
        return;
    }

    $button        = $button['button'];
    $button_text   = $button['text'];
    $button_url    = $button['link'];
    $button_class  = $button['style'] ? 'is-style-' . $button['style'] : 'is-style-fill';
    $button_color  = $button['color'];
    $button_styles = '';

    if ( 'is-style-fill' === $button_class ) {
        $button_styles .= 'style="background-color:' . $button_color . '"';
    } else {
        $button_styles .= 'style="color:' . $button_color . '"';
    }
    ?>

    <div class="wp-block-button <?php echo esc_attr( $button_class ); ?>">
        <a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( $button_url ); ?>" <?php echo $button_styles; // phpcs:ignore ?>><?php echo esc_html( $button_text ); ?></a>
    </div>

    <?php
}