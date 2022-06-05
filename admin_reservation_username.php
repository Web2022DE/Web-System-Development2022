<!DOCTYPE html>

<html>

<head>
    <link rel="icon" type="image/png" href="./images/restaurant_logoo.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="style_admin_date.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</head>

<body>
    <?php include "header_admin.php"; ?>

    <div class="reservation_date">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Show the Reservation by Date</h2>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?php print($_SERVER['PHP_SELF']); ?>" method="post">
                        <div class="form-group">
                            <label class="info_style">Enter Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username" required="required">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="reserv-submit" class="btn btn-dark btn-lg btn-block button_style">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php

session_start();
include 'database/config.php';
include 'database/opendb.php';

// check not NULL
if (
    isset($_POST['username'])
) {
    // check that values are not empty string, 0, or false
    if (
        !empty($_POST['username'])
    ) {
        $user_ID = "SELECT User_ID FROM users where Username = '" . $_POST['username'] . "' ";
        $result1 = mysqli_query($conn, $user_ID);


        if (mysqli_num_rows($result1) < 0) {
            echo '<script type="text/javascript">';
            echo 'alert("There is no user with that username")';  //not showing an alert box.
            echo '</script>';
        } else {


                $theReservation = "SELECT * FROM reservation where User_ID = " . $result1;
                $result2 = mysqli_query($conn, $theReservation);

                echo
                '
            <div style = "margin-top: 100px;">
            
                <table class="table table-hover table-responsive-sm text-center showreservation">
                    <thead>
                        <tr>
                        <th scope="col" class="header_style">First Name</th>
                        <th scope="col" class="header_style">Last Name</th>
                            <th scope="col" class="header_style">Date</th>
                            <th scope="col" class="header_style">Time</th>
                            <th scope="col" class="header_style">Guests</th>
                            <th scope="col" class="header_style">Location</th>
                            <th scope="col" class="header_style">Telephone Number</th>
                            <th scope="col" class="header_style">Comments</th>
                        </tr>
                    </thead> <tbody>';
                while ($row = mysqli_fetch_assoc($result22)) {
                    echo "
                        <tr>
                        <input name='reserv_id' type='hidden' value=" . $row['Reservation_ID'] . ">
                        <td>" . $row['First_Name'] . "</td>
                        <td>" . $row['Last_Name'] . "</td>
                        <td>" . $row['Date'] . "</td>
                        <td>" . $row['Time'] . "</td>
                        <td>" . $row['Number_of_Guests'] . "</td>
                        <td>" . $row['Location'] . "</td>
                        <td>" . $row['Telephone_Number'] . "</td>
                        <td><textarea readonly>" . $row['Comments'] . "</textarea></td>
                        </tr>
                  ";
                
                echo '</tbody></table></div>';
            } 
        }
    } else {
        echo "<p class='text-white text-center bg-danger' style='margin-top: 100px'>The reservation list is empty!<p>";
    }
}

?>