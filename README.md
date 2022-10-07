# Test Assignment Module for Reea Digital

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
- There will be a option "Region" in admin dashboard where admin user can create , update ,delete regions
- Region will have 3 field title , description and status
- These region will appear as a dropdown option in user account , for both front end and admin
- it will also appear in checkout as a drop-down option and existing value as selected option . this field also need to be saved in order level
- A widget , that will have a  select option where admin can pick a category .this widget will display all subcategories of that specific category in a 3 column grid

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

