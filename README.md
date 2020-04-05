# Test-Plugin
Contributors: Uzair Saleem  
Tested up to WordPress: 4.7

## Steps to install the plugin:
1. Clone or download the repository
2. Upload the plugin files to the `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
3. Activate the plugin through the 'Plugins' screen in WordPress

## Plugin Description:
After activating the plugin, you will get a new custom endpoint initialized in your wordpress website, which can be accessed on
<b>'http://www.yourwebsite.com/test_page/'</b>, on this page a table will be populated with data of users from the following [API](https://jsonplaceholder.typicode.com/users/)
And each table cell has an anchor tag, on click of any table cell's content, a popup will be opened displaying that specific users data from the same API's specific user endpoint.

For styling purpose jQuery Datatable and jQuery Mobile libraries have been used.
