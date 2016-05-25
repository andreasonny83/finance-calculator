# finance-calculator
finance-calculator WordPress shortcode

Simple WordPress shortcode for rendering a form and a table.

## Installation

1. Copy `finance-calculator.php` inside your theme folder. Ideally, this file will reside inside a subfolder like: `wp-content/themes/my-theme/components/finance-calculator.php`

2. Open your theme's `function.php` and add the following row at the very bottom of the file:

    ```
    include_once( 'finance-calculator.php' );
    ```
    or
    ```
    include_once( 'components/finance-calculator.php' );
    ```

3. Log inside your WP panel and create a new post.

4. Add the following shortcode in your post/page where you want to render the module

    ```
    [finance-calculator]
    ```

## Examples

    [finance-calculator]
    [finance-calculator finance="33.33"]
    [finance-calculator finance="10" months="10, 12, 36"]

## Attributes


#### finance

type: Int


Optional: true

Description: The annual percentage rate (eg. "10")



#### months

type: String

Optional: true

Description: The number of months to render in the table. (eg. "6, 12, 24, 36")
