<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Reservation</title>
    <link rel="stylesheet" href="./css/CustomerReservation.css"/>
</head>
<body>

    <div class="parent">

        <div class="reservation-header">
            <h1>Reserve Your Table in Seconds - Savor the Moment!</h1>
        </div>

        <?php 
        include('classes/Profile.php');
        include('./Classes/Database.php');
        global $DB;
        global $con;
        $DB = new Database(); //instantiation
        $DB->connectDB();
        $profile = new Profile();

        if (isset($_POST['btn'])) {
            $profile->CustomerReservationInsert($_POST);
        }
        ?>

        <form action="" method="POST" id="myForm">
            <div class="reservation-form">
                <div class="reservation-wrapper">

                    <div class="reservation-title">
                        <h1>Reservation Form</h1>
                    </div>
                    <div class="reservation-input">
                        <div class="fullname">
                            <label for="customer_name">Full Name:</label><br/>
                            <input type='text' id='customer_name' name='customer_name' required/>
                        </div>
                        <div class="time_and_date">
                            <div class="time">
                                <label for="time">Time:</label><br/>
                                <input type='time' id='time' name='time' required/>

                            </div>

                            <div class="date">
                                <label for="date">Date:</label><br/>
                                <input type='date' id='date' name='date' required/>

                            </div>
                        </div>
                        <div class="phone_guest">
                            <div class="phonenumber">
                                <label for="phone_number">Phone Number:</label><br/>
                                <input type='tel' id='phone_number' name='phone_number' pattern="[0-9]{10}" required/>

                            </div>

                            <div class="guest">
                                <label for="guest">Guests:</label><br/>
                                <input type='number' id='guest' name='guest' min="1" required/>

                            </div>
                        </div>

                        <button type="submit" name="btn" id="btn" class="submit_btn">SUBMIT</button>
                    </div>
                </div>
            </div>
        </form>

    </div>

</body>
</html>
