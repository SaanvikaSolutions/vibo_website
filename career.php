<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: Register.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;600;700&display=swap" 
    rel="stylesheet">
    <link rel="icon" href="./Images/Logo/saanvika logo.png" type="image/icon type">
    <link rel="stylesheet" href="./css/customElements.css">
    <link rel="stylesheet" href="./css/career.css">
    <title>Career</title>
</head>
<body>
    <header>
        <div class="total-nav">
            <special-header></special-header>
        </div>
    </header>

    <div class="top-container">
        <img src="./Images/career/carerer2.jpg" alt="careeer">
    </div>

    <div class="form-careers">
        <div class="content-area">
            <main id="main" class="career-main" role="main">
                <article id="career-post" class="career-post-form">
                    <div class="entry-content single-entry-content">
                        <h1 class="ApplicationFormHeading">Application Form</h1>
                        <form class="forminator" action="" method="post" enctype="multipart/form-data">
                            <div class="forminator-row">
                                <div class="forminator-field">
                                    <div class="forminator-field-sub">
                                        <label for="forminator-field-name" class="forminator-label">First Name<span class="forminator-required">*</span></label>
                                        <input type="text" class="forminator-input" name="firstname" placeholder="E.g. John" required>
                                    </div>
                                </div>
                                <div class="forminator-field">
                                    <div class="forminator-field-sub">
                                        <label for="forminator-field-name" class="forminator-label">Last Name<span class="forminator-required">*</span></label>
                                        <input type="text" class="forminator-input" name="lastname" placeholder="Doe" required>
                                    </div>
                                </div>
                            </div>
                            <div class="forminator-row">
                                <div class="forminator-field">
                                    <div class="forminator-field-sub">
                                        <label for="forminator-field-name" class="forminator-label">Email Address<span class="forminator-required">*</span></label>
                                        <input type="email" class="forminator-input" name="Email" placeholder="john@doe.com" required>
                                    </div>
                                </div>
                            </div>
                            <div class="forminator-row">
                                <div class="forminator-field">
                                    <div class="forminator-field-sub">
                                        <label for="forminator-field-name" class="forminator-label">Contact No:<span class="forminator-required">*</span></label>
                                        <input type="text" class="forminator-input" name="contactno" placeholder="E.g. 9874563210" required>
                                    </div>
                                </div>
                                <div class="forminator-field">
                                    <div class="forminator-field-sub">
                                        <label for="forminator-field-name" class="forminator-label">Alternate Contact no:</label>
                                        <input type="text" class="forminator-input" name="alternateno" placeholder="E.g.9876543210">
                                    </div>
                                </div>
                            </div>
                            <div class="forminator-row">
                                <div class="forminator-field">
                                    <div class="forminator-field-sub">
                                        <label for="forminator-field-name" class="forminator-label">Upload Resume<span class="forminator-required">*</span></label>
                                        <input type="file" id="real-file" name="real-file" hidden="hidden">
                                        <button type="button" id="custom-button" class="custom-button">Choose a File</button>
                                        <span id="custom-text" class="custom-text">No file chosen</span>
                                    </div>
                                </div>
                            </div>
                            <div class="forminator-row">
                                <div class="forminator-field">
                                    <div class="forminator-field-sub">
                                        <label for="forminator-field-name" class="forminator-label">Message/comments:</label>
                                        <textarea name="textarea-1" placeholder="Enter your message....!" class="forminator-textarea" rows="6" maxlength="180"></textarea>
                                        <span id="forminator-field-textarea" class="forminator-text-description">
                                            <span data-limit="180" data-type="characters">0 / 180</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="forminator-row forminator-last-row">
                                <div class="forminator-field">
                                    <div class="forminator-field-sub">
                                        <button class="forminator-button forminator-submit-button" name="Submit" type="submit">Send Message</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </article>
            </main>
        </div>
    </div>

    <?php
    include('./Backend/connections/dbconnect.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['Email'];
        $contactno = $_POST['contactno'];
        $alternateno = $_POST['alternateno'];
        $message = $_POST['textarea-1'];

        $file = $_FILES['real-file'];
        $filename = $file['name'];
        $fileTmpPath = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        move_uploaded_file($fileTmpPath,"./Files/$filename");

        $query = "INSERT INTO `career`(`First_Name`, `Last_Name`, `Email Id`, `Mobile_Number`, `Alternate Mobile_No`, `Resume`, `Message`) 
        VALUES ('$fname','$lname','$email','$contactno','$alternateno','$filename',' $message')";

        $res = mysqli_query($con, $query);
        if($res){
            echo "<script>alert('Applied successfully.')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
        }
    }
    ?>

    <footer>
        <special-footer></special-footer>
    </footer>
    <script src="https://kit.fontawesome.com/b19824e628.js" crossorigin="anonymous"></script>
    <script src="./CustomeElements.js"></script>
    <script src="./js/app.js"></script>

    <script>
        const realFileBtn = document.getElementById("real-file");
        const customBtn = document.getElementById("custom-button");
        const customTxt = document.getElementById("custom-text");
        customBtn.addEventListener("click", function() {
            realFileBtn.click();
        });
        realFileBtn.addEventListener("change", function() {
            if (realFileBtn.value) {
                customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            } else {
                customTxt.innerHTML = "No file chosen";
            }
        });
    </script>
</body>
</html>
