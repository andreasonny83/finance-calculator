# finance-calculator

> finance-calculator WordPress shortcode

Simple WordPress shortcode for rendering a form and a table.

## Installation

*   Copy `finance-calculator.php` inside your theme folder. Ideally,
    this file will reside inside a subfolder like:
    `wp-content/themes/my-theme/components/finance-calculator.php`

*   Open your theme's `function.php` and add the following row at the
    very bottom of the file:

```php
include_once( 'finance-calculator.php' );
```

or

```php
include_once( 'components/finance-calculator.php' );
```

*   Log inside your WP panel and create a new post.

*   Add the following shortcode in your post/page where you want
    to render the module

```php
[finance-calculator]
```

## Examples

```html
[finance-calculator]
[finance-calculator finance="33.33"]
[finance-calculator finance="10" months="10, 12, 36"]
```

## Attributes

### finance

type: Int

Optional: true

Default: 10

Description: The annual percentage rate (eg. "10")

### months

type: String

Optional: true

Default: "24, 36, 48, 60"

Description: The number of months to render in the table. (eg. "6, 12, 24, 36")

## Customization

### Minimum treatment cost value

You may want to change the minimum value for the treatment cost which is
currently hardcoded inside the `finance-calculator.php` file.
To do that, we left a comment in the code to let you easily replace or delete
that value.

Open your `finance-calculator.php` file, then reach this section of the code:

```php
// Replace the minimum, maximum, step and placeholder value as you prefer

'min="600" max="25000" step="100" placeholder="Treatment Cost" ' .

// -- //
```

Then, simply replace the values with your custom values.

### Deposit values

You may also want to be in control of the preselected deposit values present
in the dropdown menu.
Again, you can easily change them from the `finance-calculator.php` file.
Open the file and reach the following lines of code:

```php
// Replace the following values with your preferred deposit values

'<option value="0" selected>No Deposit</option>' .
'<option value="50">50</option>' .
'<option value="100">100</option>' .
'<option value="200">200</option>' .
'<option value="300">300</option>' .
'<option value="400">400</option>' .
'<option value="500">500</option>' .

// -- //
```

Then simply replace the option value and the correspondent text.
You can also add or remove options to show in the select dropdown.

## Style it up

This shortcode comes with no styles. However the HTML elements are already
provided with all the classes you might need in order to create a fancy style.
The following example show how to style the component up using SASS and will
produce the following result:

![](http://i.imgur.com/IeKO5iM.png)

```css
.finance_calculator {

  &.finance_calculator__wrap {
    padding-top: 30px;
  }

  /* Form */
  &.finance_calculator__form {
    width: 100%;
    background: #CCC;
    border-radius: 3px;
    padding: 5px 10px;
    margin-bottom: 15px;

    h2 {
      text-align: left;
      margin: 5px 0;
      padding: 0;
      font-size: 18px;
      color: #4D4D4D;
    }

    input[name="amount"] {
      margin: 5px 20px 0 5px;
      color: #444;
      border-radius: 2px;
      font-size: 12px;
      font-weight: bold;
      height: 27px;
      line-height: 27px;
      padding: 0 8px;
    }

    input[type="submit"] {
      padding: 0 25px;
      line-height: 30px;
      height: 30px;
    }
  }

  /* Tables */
  &.finance_calculator__table {
    width: 100%;
    margin-bottom: 30px;

    td {
      padding: 10px;
      text-align: left;
      border: 1px solid #5F5465;
    }

    .finance_calculator__table__title,
    .finance_calculator__table__title h3 {
      background-color: #403448;
      text-align: center;
      color: #FFF;
      margin: 0;
      font-size: 16px;
      line-height: 40px;
    }

    .finance_calculator__table__title--no-deposit {
      background-color: #673188;
      font-size: 14px;
      line-height: 24px;
    }

    .finance_calculator__table__row {
      td {
        width: 50%;
      }

      td + td {
        background-color: #F0E8F2;
      }
    }
  }
}
```
