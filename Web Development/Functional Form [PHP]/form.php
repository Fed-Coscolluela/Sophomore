<html>
    <head>
        <title>Sample Form Validation</title>
        <style>
            .error {color: #FF0000;}

            body {
                background: linear-gradient(whitesmoke, white);
            }
        </style>
            <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="styles.css" />
    </head>

    <body>  
   
    <?php
        // define variables and set to empty values
        $nameErr = $emailErr = $exam1Err = $exam2Err = $exam3Err = "";
        $name = $email = $exam1 = $exam2 = $exam3 = "";
        $nameSuccess = $emailSuccess = $exam1Success = $exam2Success = $exam3Success = false;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (empty($_POST["name"])) {
                $nameErr = "Name is required.";
            } else {
                $name = test_input($_POST["name"]);
                $nameSuccess = true;
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr = "Only letters and white space allowed"; 
                    $nameSuccess = false;
                }
            }

            if (empty($_POST["email"])) {
                $emailErr = "";
                $emailSuccess = true;
            } else {
                $email = test_input($_POST["email"]);
                // check if e-mail address is well-formed
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "<br>"."Invalid email format"; 
                    $emailSuccess = false;
                }
                else {
                    $emailSuccess = true;
                }
            }      
            
            if (!is_numeric($_POST["exam1"])) {
                $exam1Err = "Exam 1 score is required.";
                $exam1Success = false;
            } else {
                $exam1 = test_input($_POST["exam1"]);
                $exam1Success = true;
            }

            if (!is_numeric($_POST["exam2"])) {
                $exam2Err = "Exam 2 score is required.";
                $exam2Success = false;
            } else {
                $exam2 = test_input($_POST["exam2"]);
                $exam2Success = true;
            }

            if (!is_numeric($_POST["exam3"])) {
                $exam3Err = "Exam 3 score is required.";
                $exam3Success = false;
            } else {
                $exam3 = test_input($_POST["exam3"]);
                $exam3Success = true;
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if(($nameSuccess === true) & ($emailSuccess === true) & ($exam1Success === true) & ($exam2Success === true) & ($exam3Success === true)){
            if( !empty($_POST["email"]) ){
                $to = $_POST["email"];
                $name = $_POST["name"];
                $exam1 = $_POST["exam1"];
                $exam2 = $_POST["exam2"];
                $exam3 = $_POST["exam3"];
                $average = ($exam1 + $exam2 + $exam3)/3;
                $trimmed_average = sprintf('%.2f', $average);
    
                $subject = "PHP Mailer";
        
                $message = "Thank you for filling out the form! Here's what I got from you:"."<br>"."<br>"."Name: ".$name."<br>"."Email: ".$email."<br>"."Exam1: ".$exam1."<br>"."Exam2: ".$exam2."<br>"."Exam3: ".$exam3."<br>"."Average: ".$trimmed_average;
        
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <onlinestore@gmail.com>' . "\r\n";
        
                if(mail($to, $subject, $message,$headers)){
                    // Alert component from Bootstrap. 
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Message sent! Thank you.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }else{
                    // Alert component from Bootstrap. 
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            Message not sent!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
            }

            $email = "";
        
            if(isset($_POST["email"])){
                $email = $_POST["email"];
            }
            header("Location: summary.php", true, 307);
        }
    ?>

<div class="container">
<br>
<br>
<h6 class="title">Form with Validation</h6>
<p>[<span class="error">* required field.</span>]</p>
      <div class="row">
        <div class="col-lg-8" style="padding: 20px 20px 0 20px; margin-bottom: 30px; background: rgb(19, 18, 18); color: white; border-radius: 8px;">
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="row g-3 mb-3">
              <div class="col-md-6 col-sm-12">
              <br>
              <label for="name" class="form-label">Name</label>
                <input id="name" type="text" name="name" style="width: 80%;" value="<?php echo $name;?>">
                <span style="color: red;">*</span> <span class="error" style="color: yellow;"> <?php if(isset($nameErr)) echo $nameErr;?></span>
              </div>
              <div class="col-md-6 col-sm-12">
              <br>
              <label for="email" class="form-label">Email</label>
                <input id="email" type="text" name="email" style="width: 70%;" value="<?php echo $email;?>">
                  <span class="error" style="color: yellow;"><?php echo $emailErr;?></span>
              </div>
            </div>
            <div class="row g-3 mb-3">
              <div class="col-md-4 col-sm-12">
              <label for="exam1" class="form-label">Exam 1</label>
                <input type="number" step="any" min="0" max="100" name="exam1" value="<?php echo $exam1;?>">
                <span style="color: red;">*</span>  <span class="error" style="color: yellow;"> <?php if(isset($nameErr)) echo $exam1Err;?></span>
              </div>
              <div class="col-md-4 col-sm-12">
              <label for="exam2" class="form-label">Exam 2</label>
                 <input type="number" step="any" min="0" max="100" name="exam2" value="<?php echo $exam2;?>">
                 <span style="color: red;">*</span>  <span class="error" style="color: yellow;"> <?php if(isset($nameErr)) echo $exam2Err;?></span>
              </div>
              <div class="col-md-4 col-sm-12">
              <label for="exam3" class="form-label">Exam 3</label>
                 <input type="number" step="any" min="0" max="100" name="exam3" value="<?php echo $exam3;?>">
                 <span style="color: red;">*</span> <span class="error" style="color: yellow;"> <?php if(isset($nameErr)) echo $exam3Err;?></span>
              </div>
            </div>
              <div class="col-12">
              <br>
                 <input type="submit" name="submit" value="Submit" style="float: right;">  
              </div>
              <br>
              <br>
          </form>
        </div>
        <div class="col-lg-4 mb-3" style="padding-left: 20px;">
          <hr style="height: 2px;">
          <h5>Guidelines:</h5>
          <ul>
          <li style="text-decoration: none;"><p style="text-align: justify;">Name is required and must only contain letters and whitespaces. </p></li>
          <li style="text-decoration: none;"><p style="text-align: justify;">Email is not required and must be valid with @ and . symbol. </p></li>
          <li style="text-decoration: none;"><p style="text-align: justify;">Three exam integer or float scores are required and must be between 0 and 100, inclusive. </p></li>
          </ul>
          <p style="text-align: right;">- <strong>PHP Forms</strong>, <i>Laboratory 3</i> </p>
        </div>
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
      crossorigin="anonymous"
    ></script>
    </body>
</html>