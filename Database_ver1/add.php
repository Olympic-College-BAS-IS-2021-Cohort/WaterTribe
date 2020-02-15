
<?php

#Out of the box, PHP function. isset function checks to see if a certain variable has been set. Basically if any data has been sent via the GET method, it will be stored in the $_GET array.
	// if(isset($_GET['submit'])) {
	// 	echo $_GET['email']; #passing in the key to the array to get the associated value
	// 	echo $_GET['title']; #passing in the key to the array to get the associated value
	// 	echo $_GET['ingredients']; #passing in the key to the array to get the associated value
	// } #Checks to see if the "submit" button has been pressed, means data has been sent to the server

#In conclusion, this function above checks to see if the "submit" button was pressed, and if it was, it will echo those values

if(isset($_POST['submit'])) {
		// echo htmlspecialchars($_POST['email']); #htmlspecialchars() prevents XSS attacks, even when you submit some kind of script, when it gets to the server we're going to use this function on that data that we've submit and when it sees things like angle brackets, it's going to convert those into HTML entities so that when they get to the browser they're going to be rendered as HTML entities rather than the actual characters like the angle bracket. Prevents those from executing as javascript
		// echo htmlspecialchars($_POST['title']); #htmlspecialchars() prevents XSS attacks
		// echo htmlspecialchars($_POST['ingredients']); #htmlspecialchars() prevents XSS attacks

		// #check email ver.1
		// if(empty($_POST['email'])){
		// 	echo 'An email is required <br />'; #if it's empty it will echo back an error
		// } else {
		// 	echo htmlspecialchars($_POST['email']); #if it's not empty it, we will jut send back what they typed in 
		// }

		#check email ver.2
		if(empty($_POST['email'])) {
			echo 'An email is required <br />';
		} else {
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ #built-in filter for php
				echo 'email must be a valid email address'; 
			}
		}


		#REGEX (regular expressions) looks at a string of characters, and they match it to a pattern described by the regular expression, if that pattern matches what's in the string, then it's going to pass the test. If it doesn't, then it's not going to pass the test.

		// #check title ver.1
		// if(empty($_POST['title'])){
		// 	echo 'A title is required <br />'; #if it's empty it will echo back an error
		// } else {
		// 	echo htmlspecialchars($_POST['title']); #if it's not empty it, we will jut send back what they typed in 
		// }

		#check title ver.2
		if(empty($_POST['title'])){
			echo 'A title is required <br />'; #if it's empty it will echo back an error
		} else {
			$title = $_POST['title']; #store the title in a variable called $title by grabbing it from $_POST array

			#FIRST ARGUMENT: regular expression, from the start ^, to the end $, we want any lower case a-z, and any upper case, spaces \s, as many times as the user wants +, at least one character long. SECOND ARGUMENT: $title. That's what we are going to match against
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)) {
				echo 'Title must be letters and spaces only';
			}  
		}

		 
		// #check ingredients ver.1
		// if(empty($_POST['ingredients'])){
		// 	echo 'An least one ingredient is required <br />'; #if it's empty it will echo back an error
		// } else {
		// 	echo htmlspecialchars($_POST['ingredients']); #if it's not empty it, we will jut send back what they typed in 
		// }

		#check ingredients ver.2
		if(empty($_POST['ingredients'])){
			echo 'An least one ingredient is required <br />'; #if it's empty it will echo back an error
		} else {
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) { #Negation operator !, if it passes, then it must be true, if not it will echo the error message. The long string of characters is a regular expression that is looking for a comma separated list
				echo 'Ingredients must be a comma separated list';
			}  
		}



	} //end of POST check

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?> <!-- Uses header.php file to create the same exact header on each web page -->

<section class="container grey-text">   <!-- Creates the Form -->
	<h4 class="center">Add a Pizza</h4>
	<form class="white" action="add.php" method="POST"> <!-- action determines what file will process the data in the form. method defines how the data is going to be sent to the server (GET vs POST) -->
		<label>Your Email:</label>
		<input type="text" name="email">
		<label>Pizza Title:</label>
		<input type="text" name="title">
		<label>Ingredients (comma separated):</label>
		<input type="text" name="ingredients">
		<div class="center">
			<input type="submit" name="submit" value="submit" class="btn brand z-depth-0"> <!-- Creates submit button in the form. Uses brand style that we defined in the header.php -->
		</div>
	</form>
</section>


<?php include ('templates/footer.php'); ?> <!-- Uses footer.php file to create the same exact footer on each web page -->


</html>