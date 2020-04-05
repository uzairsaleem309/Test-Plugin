<?php
/**
 * Template Name: test_page
 *
 * @package Wordpress Theme
 */ ?>
 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<?php wp_head(); ?>
	</head>

	<!-- Begin Body -->
	<body>
	    <div class="ui-loader-background"> </div>
	    <div class="container">
    	    <table id="myTable">
    	        <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
                <tfoot>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Username</th>
                    </tr>
                </tfoot>
    	    </table>
	    </div>
	    <div id="myModal" class="modal">
          <div class="modal-content">
            <span class="closeModal">&times;</span>
            <h3>User Details</h3>
            <p>ID:<span id="uid"></span></p>
            <p>Name:<span id="name"></span></p>
            <p>Username:<span id="username"></span></p>
          </div>
        
        </div>
	    <?php wp_footer(); ?>
	</body>
</html>