<?php
    // Database connection
    include('./config/db.php');

    global $email_verified, $email_already_verified, $activation_error;

    // GET the token = ?token
    if(!empty($_GET['token'])){
       $token = $_GET['token'];
    } else {
        $token = "";
    }

    if($token != "") {
        $sqlQuery = mysqli_query($connection, "SELECT * FROM users WHERE token = '$token' ");
        $countRow = mysqli_num_rows($sqlQuery);

        if($countRow == 1){
            while($rowData = mysqli_fetch_array($sqlQuery)){
                $is_active = $rowData['is_active'];
                  if($is_active == 0) {
                     $update = mysqli_query($connection, "UPDATE users SET is_active = '1' WHERE token = '$token' ");
                       if($update){
                           $email_verified = '<div class="alert alert-success">
                                  ¡Correo electrónico de usuario verificado exitosamente!
                                </div>
                           ';
                       }
                  } else {
                        $email_already_verified = '<div class="alert alert-warning">
                               ¡El correo electrónico del usuario ya está verificado!
                            </div>
                        ';
                  }
            }
        } else {
            $activation_error = '<div class="alert alert-danger">
                    ¡Error de activación!
                </div>
            ';
        }
    }

?>