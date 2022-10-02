# Test Assignment Module for Reea Digital Assignment

    ``Rafi/Reea``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
- Adds a custom column [order comment] in order entity table
- Adds a Field in check out page to take user order comment
- Save user input into that custom order column chen order is placed
- Show that information in admin order details page
- Show that in frontend customer order details page
- Check compatibility with with latest magento release [2.4.5]
## Installation
\* = in production please use the `--keep-generated` option

### Process

 - Unzip the zip file in `app/code/Rafi`
 - Enable the module by running `php bin/magento module:enable Rafi_Reea`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`



## Attributes

 - Sales - order comment (order_comment)
 - Quote - order comment (order_comment)

