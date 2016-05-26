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

Default: 10

Description: The annual percentage rate (eg. "10")


#### months

type: String

Optional: true

Default: "24, 36, 48, 60"

Description: The number of months to render in the table. (eg. "6, 12, 24, 36")


## Style it up!

This shortcode comes with no styles. However the HTML elements are already provided with all the classes you might need in order to create a fancy style.
The following example show how to style the component up using SASS and will produce the following result:
<img src="http://i.imgur.com/IeKO5iM.png" title="source: imgur.com" />

```
.finance_calculator {

  /* Form */
  .finance_calculator__form: {
    width: 100%;
    background: #ccc;
    border-radius: 3px;
    padding: 5px 10px;
    margin-bottom: 15px;
    
    h2 {
        text-align: left;
        margin: 5px 0;
        padding: 0;
        font-size: 18px;
        color: #4d4d4d;
    }
    
    #cost {
        margin: 5px 20px 0 0;
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
    
    /* Tables */
    .finance_calculator__table {
        width: 100%;
        padding: 10px;
        text-align: left;
        border: 1px solid #5f5465;
    
        .finance_calculator__table__title {
            background-color: #403448;
            
            h3 {
                text-align: center;
                color: #fff;
                margin: 0;
                font-size: 16px;
            }
        }
        
        .finance_calculator__table__title--no-deposit {
            background-color: #673188;
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
}
```
