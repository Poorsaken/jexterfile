<?php

include ('includes/header.php');



?>


<div class="parent-reservation">


        <div class="left-reservation">



        <div class="three-div">
            <div class="image">
                <img src="./img/1f5d796afadc8f9094fccbda5f0fdbf9.jpg" alt=""/>
            </div>
            <div class="image">
                <img src="./img/3e6824c44b033b635d7e22be02dca037.jpg" alt=""/>
            </div>
            <div class="image">
                <img src="./img/82ab0f61694bb4bfd6041d390cb0a694.jpg" alt=""/>
            </div>
           
        </div>

        <div class="discover">
            <h>Indulge in a culinary journey <br/> where tradition meets innovation.</h>
        
            <p>At Heritage Bistro, we blend classic techniques with contemporary flair to bring you an unforgettable dining experience. Our carefully curated menu, featuring the finest seasonal ingredients, is designed to tantalize your taste buds and delight your senses.</p>
        </div>



        <div class="two-div">

            <div class="gordon">
                <img src="./img/Review Gordon.png" alt=""/>
            </div>
            <div class="details">

            <h1>Contact Us</h1>
                <p> Address: 1234 Culinary Lane
Gourmet City, FL 56789 </p>
<p>Phone: (123) 456-7890</p>
<p>Email: info@heritagebistro.com</p>
               
<p class="social-media-header">Follow us on social media:</p>
    <div class="socials">
      
    <div class="tweet">
            <img src="./img/twitter.png" alt="asd"/>
        </div>
    <div class="tweet">
            <img src="./img/facebook (2).png" alt="asd"/>
        </div>
    <div class="tweet">
            <img src="./img/tiktok.png" alt="asd"/>
        </div>
      
    </div>
            </div>

        </div>

        </div>


        <div class="right-reservation">



        <div class="reservation-header">
            <div class="reservation-header-img">

                <img src='./img/Black and White Chef Food Logo.png' alt=''/>
            </div>
            <h>Book your table today and embark on a gastronomic adventure that promises to delight and inspire. At Heritage Bistro, we are dedicated to providing an exceptional dining experience from the moment you walk through our doors.</h>
        </div>


        <form action="" method="POST" id="myForm">
            <div class="reservation-form">
                <div class="reservation-wrapper">

                    <div class="reservation-title">
                        <h>Reservation Form</h>
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

                         <div class="reservation-footer">
            <h>We recommend making reservations in advance to secure your preferred dining time.</h>
        </div>


              <div class="reservation-footer-submit">
          <button type="submit" name="btn" id="btn" class="submit_btn_reservation">Book Reservation</button>
        </div>
                       
                    </div>
                </div>
            </div>
        </form>

        </div>

        

    </div>



    <?php
include ('includes/footer.php');
?>
