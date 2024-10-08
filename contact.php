<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="icon" href="./Images/Logo/saanvika logo.png" type="image/icon type">
    <link rel="stylesheet" href="./css/customElements.css">
    <style>
        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
        } */

        .container1 {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        .map-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        .map-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:linear-gradient(to bottom right, #217bd3bf, #85b6f5);
            opacity: 0.5;
        }

        .content {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 90%;
            color: #333;
            margin-top: 20px;    
        }

        .contact-form {
            margin-bottom: 30px;
            background-color: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
        }

        .contact-form h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #1a73e8;
            margin-top: 0%;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .form-group label {
            flex: 0 0 30%;
            font-weight: bold;
            margin-right: 10px;
            color: #1a73e8;
            text-align: left;
        }

        .form-group input,
        .form-group textarea {
            flex: 1;
            padding: 10px;
            border: 1px solid #8632c300;
            border-radius: 3px;
            background-color: #1a73e833;;
            color: #333;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            box-shadow: 0 0 5px #8632c3;
        }

        button[type="submit"] {
            display: block;
            width: 50%;
            padding: 10px;
            background-color: #1a73e8;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 30px auto;
        }

        button[type="submit"]:hover {
            background-color: #85b6f5;
        }

        .contact-details-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .contact-detail {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            flex: 1;
            min-width: 250px;
            max-width: 300px;
        }

        .contact-detail h3 {
            color: #1a73e8;
            margin-bottom: 10px;
        }

        .contact-detail p {
            color: #333;
            margin-bottom: 5px;
        }

        @media (max-width: 768px) {
            .contact-details-container {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="total-nav">
            <special-header></special-header>
        </div>
    </header>
    <div class="top-container">
        <img src="./Images/contact/contact-banner.jpg" alt="Contact">
        <!-- <h1 class="top-container-heading">Contact Us</h1> -->
    </div>

    <!-- <div class="map-container">
        <div class="map-overlay"></div>
        <iframe id="map-iframe"
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1903.1626148128496!2d78.400731!3d17.444141!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcb9115d1bdce55%3A0x40732e0724b4d734!2sSaanvika%20software%20solutions!5e0!3m2!1sen!2sus!4v1711426977406!5m2!1sen!2sus"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div> -->
    <div class="container1">
        <div class="content">
            <div class="contact-form">
                <h1>Book an appointment</h1>
                <form  action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" required>
                    </div>
                    <div class="form-group">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="tel" id="phoneNumber" name="phoneNumber" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit">Submit</button>
                    <div class="form-group">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3825.6657813296215!2d80.6649976757981!3d16.492452527967654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a35fb513b0ceee5%3A0x78efb3dfe2173588!2sVIBO%20AESTHETICS%20by%20Dr%20Viraja%20Bobburi!5e0!3m2!1sen!2sin!4v1726911574308!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                </form>
            </div>
           
        </div>
        <?php
    include('./Backend/connections/dbconnect.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $_POST['fullName'];
        $lname = $_POST['phoneNumber'];
        $email = $_POST['email'];
        $contactno = $_POST['message'];

        $query = "INSERT INTO `contact`(`Name`, `Contact_Number`, `Email`, `Comments`) VALUES ('$fname','$lname','$email','$contactno')";

        $res = mysqli_query($con,$query);
        if($res){
            echo "<script>alert('Inserted successfully.')</script>";
        }else{
            echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
        }

    }


?>

        <div class="contact-details-container">
            <div class="contact-detail">
                <h3>Location</h3>
                <p>Vibo Aesthetics 2nd floor, Jagadamba towers, 56-15-53, Ganapathi temple road, P&T Colony, Patamata, Vijayawada, Andhra Pradesh 520010.</p>
            </div>
            <div class="contact-detail">
                <h3>Email</h3>
                <p>viboaesthetics@gmail.com</p>
            </div>
            <div class="contact-detail">
                <h3>Phone</h3>
                <p>+91-9988851118</p>
            </div>
            <div class="contact-detail">
                <h3>Working Hour</h3>
                <p>Mon - Sat 9.00 AM - 6:00 PM</p>
            </div>
        </div>
    </div>

    <footer>
        <special-footer></special-footer>
    </footer>
    <script src="https://kit.fontawesome.com/b19824e628.js" crossorigin="anonymous"></script>
    <script src="./CustomeElements.js"></script>
    <!-- <script src="./js/nav.js"></script> -->
    <script src="./js/app.js"></script>

</body>

</html>