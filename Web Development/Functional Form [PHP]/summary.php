

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6"
      crossorigin="anonymous"
    />
    <!-- Miscellanenous Visuals (fa-fa) -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="styles.css" />
    <style>
        body {
            background: linear-gradient(whitesmoke, white);
        }
    </style>
</head>
<body>
<?php
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);   
    $exam1 = test_input($_POST["exam1"]);    
    $exam2 = test_input($_POST["exam2"]);    
    $exam3 = test_input($_POST["exam3"]);
    $average = ($exam1 + $exam2 + $exam3)/3;
    $trimmed_average = sprintf('%.2f', $average);    

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<br><br><br>
<h6 class="title">Summary</h6>
<div class="container">
    <div class="row" style="padding: 20px">
    <div class="col-lg-8">
        <table class="table table-dark table-hover">
          <thead style="display: none">
            <tr>
              <th scope="col" id="table-aligned">Name</th>
              <th scope="col" id="table-aligned">Birthday</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="col-4" id="table-aligned" style="padding-left: 15px;">Name</td>
              <td class="col-8" id="table-aligned"><?php echo $name; ?></td>
            </tr>
            <tr>
              <td id="table-aligned" style="padding-left: 15px;">Email</td>
              <td id="table-aligned"><?php echo $email; ?></td>
            </tr>
            <tr>
              <td id="table-aligned" style="padding-left: 15px;">Exam 1</td>
              <td id="table-aligned"><?php echo $exam1; ?></td>
            </tr>
            <tr>
              <td id="table-aligned" style="padding-left: 15px;">Exam 2</td>
              <td id="table-aligned"><?php echo $exam2; ?></td>
            </tr>
            <tr>
              <td id="table-aligned" style="padding-left: 15px;">Exam 3</td>
              <td id="table-aligned"><?php echo $exam3; ?></td>
            </tr>
            <tr>
              <td id="table-aligned" style="padding-left: 15px;">Average</td>
              <td id="table-aligned"><?php echo $trimmed_average; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-lg-4">
          <hr>
        <p style="text-align: center;">Thank you for answering! <br> An email will be sent to you shortly, if you provided one, containing the details you have given me. <br> Have a safe day.</p>
        <hr>
    </div>
    </div>
    <br><br><br><br><br><br>
</div>
</body>
</html>