<?php
/**
 * Stack: Comparison Table
 *
 * Two-column comparison table with customizable icons per row.
 * Ideal for "Traditional vs Our Solution" style comparisons.
 */

// Support both ACF fields and Stack Guide mock data via $args
$args = $args ?? [];

$stack_id = $args['id'] ?? '';
$stack_class = $args['class'] ?? '';
$stack_class .= ' stack-comparison bg-gunmetal py-16 md:py-20';

// Pre-fetch all fields with $args fallback
$heading = $args['heading'] ?? get_sub_field('heading');
$left_column_heading = $args['left_column_heading'] ?? get_sub_field('left_column_heading');
$right_column_heading = $args['right_column_heading'] ?? get_sub_field('right_column_heading');
$rows = $args['rows'] ?? get_sub_field('rows');

// Ensure rows is an array
if (!is_array($rows)) {
    $rows = [];
}

/**
 * Render comparison icon based on type
 */
if (!function_exists('g2o_render_comparison_icon')) {
    function g2o_render_comparison_icon($icon_type) {
        switch ($icon_type) {
            case 'x':
                return '<span class="comparison-icon text-city text-xl md:text-2xl flex-shrink-0" aria-hidden="true">&#10005;</span>';
            case 'check':
                return '<span class="comparison-icon text-green-500 text-xl md:text-2xl flex-shrink-0" aria-hidden="true">&#10003;</span>';
            default:
                return '';
        }
    }
}

echo "<section id='" . esc_attr($stack_id) . "' class='" . esc_attr(trim($stack_class)) . "'>";
    echo "<div class='constrain'>";
        echo "<div class='row'>";
            echo "<div class='col-start-2 col-span-14 lg:col-start-3 lg:col-span-12'>";

                // Optional Section Heading
                if ($heading) {
                    echo "<h2 class='font-serif text-3xl md:text-4xl text-white text-center mb-8 md:mb-10 reveal'>" . acf_esc_html($heading) . "</h2>";
                }

                // Comparison Table
                echo "<div class='comparison-table border border-white/20 reveal'>";

                    // Header Row
                    echo "<div class='comparison-row comparison-row--header grid grid-cols-2'>";
                        echo "<div class='comparison-cell comparison-cell--header p-4 md:p-6 border-b border-r border-white/20'>";
                            echo "<span class='font-sans font-bold text-lg md:text-2xl text-white'>" . esc_html($left_column_heading) . "</span>";
                        echo "</div>";
                        echo "<div class='comparison-cell comparison-cell--header p-4 md:p-6 border-b border-white/20'>";
                            echo "<span class='font-sans font-bold text-lg md:text-2xl text-sky'>" . esc_html($right_column_heading) . "</span>";
                        echo "</div>";
                    echo "</div>";

                    // Data Rows
                    if ($rows) {
                        $row_count = count($rows);
                        $current_row = 0;

                        foreach ($rows as $row) {
                            $current_row++;
                            $is_last_row = ($current_row === $row_count);
                            $border_bottom = $is_last_row ? '' : 'border-b';

                            $left_icon = $row['left_icon'] ?? 'x';
                            $left_text = $row['left_text'] ?? '';
                            $right_icon = $row['right_icon'] ?? 'check';
                            $right_text = $row['right_text'] ?? '';

                            echo "<div class='comparison-row grid grid-cols-2'>";

                                // Left cell (typically negative/traditional)
                                echo "<div class='comparison-cell p-4 md:p-6 {$border_bottom} border-r border-white/20 flex items-start gap-3 md:gap-4'>";
                                    echo g2o_render_comparison_icon($left_icon);
                                    echo "<span class='text-white text-base md:text-lg'>" . esc_html($left_text) . "</span>";
                                echo "</div>";

                                // Right cell (typically positive/our solution)
                                echo "<div class='comparison-cell p-4 md:p-6 {$border_bottom} border-white/20 flex items-start gap-3 md:gap-4'>";
                                    echo g2o_render_comparison_icon($right_icon);
                                    echo "<span class='text-white text-base md:text-lg font-bold'>" . esc_html($right_text) . "</span>";
                                echo "</div>";

                            echo "</div>";
                        }
                    }

                echo "</div>"; // comparison-table

            echo "</div>"; // col
        echo "</div>"; // row
    echo "</div>"; // constrain
echo "</section>"; // stack
