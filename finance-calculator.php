<?php
function render_form() {
  $value = isset($_GET['amount']) ? $_GET['amount'] : null;

  return '<form name="finance_calculator" class="finance_calculator finance_calculator__form" method="get" action="' .
              htmlspecialchars($_SERVER['REQUEST_URI']) . '">' .
            '<h2>Finance Calculator</h2>' .
            '<p><label>Please enter the treatment cost : £' .
              '<input name="amount" type="number" id="cost" max="25000" step="100" ' .
              'placeholder="Treatment Cost" min="600"  value="' . $value . '">' .
              '</label>' .
              '<input type="submit" value="Calculate">' .
            '</p>' .
          '</form>';
}

function render_table($amount, $months = array(6, 10, 12), $finance) {
  $total =  $amount > 0 ?
            $amount / 100 * ($finance + 100) :
            0;

  $output = '' .
      '<table class="finance_calculator finance_calculator__table">' .
        '<tbody>' .
          '<tr><td colspan="2"><h3 class="finance_calculator finance_calculator__table__title">' .
            '<strong>' . $finance . '% Finance</strong>' .
          '</h3></td></tr>' .
          '<tr><td colspan="2" class="finance_calculator finance_calculator__table__title--no-deposit">' .
            '<strong>No Deposit</strong>' .
          '</td></tr>';

  foreach ($months as $month) {
    $output .= $month === 1 ?
        '<tr class="finance_calculator finance_calculator__table__row"><td><strong>' . $month . ' Month</strong></td>' :
        '<tr class="finance_calculator finance_calculator__table__row"><td><strong>' . $month . ' Months</strong></td>';

    $output .= '<td>£' . round($total / $month, 2, PHP_ROUND_HALF_DOWN) . '</td></tr>';
  }

  return $output .= '</tbody></table>';
}

/**
 * [finance_calculator]
 * Render a finance calculator table
 *
 * example.
 * [finance-calculator finance="10" months="10, 12, 36"]
 *
 * @param  [int] finance    The annual percentage rate.
 * @param  [string] months  Optional. The number of months to render
 *                          in the table. (eg. "6, 12, 24, 36")
 */
function finance_calculator( $atts ) {
  $attributes = shortcode_atts( array(
                'finance' => 'finance',
                'months'  => 'months',
            ), $atts );
  $amount   = isset($_GET['amount']) ?
              $_GET['amount'] :
              0;
  $finance  = isset($attributes['finance']) ?
              $attributes['finance'] :
              10;
  $monts = array();

  $no_whitespaces = preg_replace( '/\s*,\s*/', ',', filter_var( $attributes['months'], FILTER_SANITIZE_STRING ) );
  $months_array = explode( ',', $no_whitespaces );

  if (!$months_array[0]) {
    $months_array = [24, 36, 48, 60];
  }

  $output  = render_form();
  $output .= render_table($amount, [6, 10, 12]);
  $output .= render_table($amount, $months_array, $finance);

  return $output;
}

add_shortcode( 'finance-calculator', 'finance_calculator' );
