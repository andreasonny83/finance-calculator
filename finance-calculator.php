<?php
function render_form() {
  $value = isset($_GET['amount']) ? $_GET['amount'] : null;

  // The Javascript code responsible for updating the values in real time
  $js = "<script>" .
        "function _updateCalc(value, target) {" .
          "var tableID = '.finance_calculator__table--' + target;" .
          "var amount = document.querySelector('.finance_calculator .finance_calculator__form input').value;" .
          "var rows = document.querySelectorAll(tableID + ' .finance_calculator__table__row');" .
          "rows.forEach(function(item) {" .
            "var months = item.getAttribute('data-months');" .
            "var rows = item.querySelectorAll('td');" .
            "var result = (amount - value) / months;" .
            "rows[1].innerHTML = '£' + result.toFixed(2);" .
          "});" .
        "}" .
        "</script>";

  return $js .
         '<div class="finance_calculator finance_calculator__wrap" id="finance">' .
            '<form name="finance_calculator" class="finance_calculator finance_calculator__form" method="get" action="' .
                htmlspecialchars($_SERVER['REQUEST_URI'] . '#finance') . '">' .
              '<h2>Finance Calculator</h2>' .
              '<p><label>Please enter the treatment cost : £' .
                '<input name="amount" type="number" ' .

                // Replace the minimum, maximum, step and placeholder value as you prefer

                'min="600" max="25000" step="100" placeholder="Treatment Cost" ' .

                // -- //

                ' value="' . $value . '" />' .
                '</label>' .
                '<input type="submit" value="Calculate" />' .
              '</p>' .
          '</form></div>';
}

function render_table($tableID, $amount, $months = array(6, 10, 12), $finance = 0) {
  $total =  $amount > 0 ?
            $amount / 100 * ($finance + 100) :
            0;

  $output = '' .
      '<table class="finance_calculator finance_calculator__table finance_calculator__table--' . $tableID . '">' .
        '<tbody>' .
          '<tr><td colspan="2" class="finance_calculator finance_calculator__table__title"><h3>' .
            '<strong>' . $finance . '% Finance</strong>' .
          '</h3></td></tr>' .
          '<tr><td colspan="2" class="finance_calculator finance_calculator__table__title finance_calculator__table__title--no-deposit">' .
            '<select class="finance_calculator__deposit" onchange="_updateCalc(this.value, ' . $tableID . ')">' .

              // Replace the following values with your preferred deposit values

              '<option value="0" selected>No Deposit</option>' .
              '<option value="50">50</option>' .
              '<option value="100">100</option>' .
              '<option value="200">200</option>' .
              '<option value="300">300</option>' .
              '<option value="400">400</option>' .
              '<option value="500">500</option>' .

              // -- //

            '</select>' .
          '</td></tr>';

  foreach ($months as $month) {
    $output .= $month === 1 ?
        '<tr class="finance_calculator finance_calculator__table__row" data-months="' . $month . '"><td><strong>' . $month . ' Month</strong></td>' :
        '<tr class="finance_calculator finance_calculator__table__row" data-months="' . $month . '"><td><strong>' . $month . ' Months</strong></td>';

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
  $output .= render_table(0, $amount, [6, 10, 12]);
  $output .= render_table(1, $amount, $months_array, $finance);

  return $output;
}

add_shortcode( 'finance-calculator', 'finance_calculator' );
