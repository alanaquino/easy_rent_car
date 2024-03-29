<?php

// Database connection
include('./config/db.php');

global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $verificationRequiredErr, $email_empty_err, $pass_empty_err;

if(isset($_POST['login'])) {
    $email_signin        = $_POST['email_signin'];
    $password_signin     = $_POST['password_signin'];

    // clean data
    $user_email = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
    $pswd = mysqli_real_escape_string($connection, $password_signin);

    // Query if email exists in db
    $sql = "SELECT * From users WHERE email = '{$email_signin}' ";
    $query = mysqli_query($connection, $sql);
    $rowCount = mysqli_num_rows($query);

    // If query fails, show the reason
    if(!$query){
        die("SQL query failed: " . mysqli_error($connection));
    }

    if(!empty($email_signin) && !empty($password_signin)){
        if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pswd)) {
            $wrongPwdErr = '<div class="alert alert-danger">
                        La contraseña debe tener entre 6 y 20 caracteres, contener al menos un carácter especial, minúsculas, mayúsculas y un dígito.
                    </div>';
        }
        // Check if email exist
        if($rowCount <= 0) {
            $accountNotExistErr = '<div class="alert alert-danger">
                        La cuenta de usuario no existe.
                    </div>';
        } else {
            // Fetch user data and store in php session
            while($row = mysqli_fetch_array($query)) {
                $id            = $row['id'];
                $firstname     = $row['firstname'];
                $lastname      = $row['lastname'];
                $email         = $row['email'];
                $pass_word     = $row['password'];
                $token         = $row['token'];
                $is_active     = $row['is_active'];
                $created_at    = $row['created_at'];
            }

            // Verify password
            $password = password_verify($password_signin, $pass_word);

            // Allow only verified user
            if($is_active == '1') {
                if($email_signin == $email && $password_signin == $password) {
                    header("Location: ./index.php");

                    $_SESSION['admin_id'] = $id;
                    $_SESSION['admin_firstname'] = $firstname;
                    $_SESSION['admin_lastname'] = $lastname;
                    $_SESSION['admin_email'] = $email;
                    $_SESSION['token'] = $token;
                    $_SESSION['created_at'] = $created_at;

                } else {
                    $emailPwdErr = '<div class="alert alert-danger">
                                El correo electrónico o la contraseña son incorrectos.
                            </div>';
                }
            } else {
                $verificationRequiredErr = '<div class="alert alert-danger">
                            La verificación de su cuenta es necesaria para iniciar sesión.
                        </div>';
            }

        }

    } else {
        if(empty($email_signin)){
            $email_empty_err = "<div class='alert alert-danger email_alert'>
                            Correo electrónico no proporcionado.
                    </div>";
        }

        if(empty($password_signin)){
            $pass_empty_err = "<div class='alert alert-danger email_alert'>
                            Contraseña no proporcionada.
                        </div>";
        }
    }

}

?>