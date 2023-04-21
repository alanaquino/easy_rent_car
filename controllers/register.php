<?php
   
    // Database connection
    include('config/db.php');

    // Swiftmailer lib
    require_once './lib/vendor/autoload.php';
    
    // Error & success messages
    global $success_msg, $email_exist, $f_NameErr, $l_NameErr, $_emailErr, $_mobileErr, $_passwordErr;
    global $fNameEmptyErr, $lNameEmptyErr, $emailEmptyErr, $passwordEmptyErr, $email_verify_err, $email_verify_success;
    
    // Set empty form vars for validation mapping
    $_first_name = $_last_name = $_email = $_mobile_number = $_password = "";

    if(isset($_POST["submit"])) {
        $firstname     = $_POST["firstname"];
        $lastname      = $_POST["lastname"];
        $email         = $_POST["email"];
        $password      = $_POST["password"];

        // check if email already exist
        $email_check_query = mysqli_query($connection, "SELECT * FROM customers WHERE email = '{$email}' ");
        $rowCount = mysqli_num_rows($email_check_query);


        // PHP validation
        // Verify if form values are not empty
        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password)){
            
            // check if user email already exist
            if($rowCount > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        ¡Un usuario con ese correo electrónico ya existe!
                    </div>
                ';
            } else {
                // clean the form data before sending to database
                $_first_name = mysqli_real_escape_string($connection, $firstname);
                $_last_name = mysqli_real_escape_string($connection, $lastname);
                $_email = mysqli_real_escape_string($connection, $email);
                $_password = mysqli_real_escape_string($connection, $password);

                // perform validation
                if(!preg_match("/^[a-zA-Z ]*$/", $_first_name)) {
                    $f_NameErr = '<div class="alert alert-danger">
                            Solo se permiten letras y espacios en blanco.
                        </div>';
                }
                if(!preg_match("/^[a-zA-Z ]*$/", $_last_name)) {
                    $l_NameErr = '<div class="alert alert-danger">
                            Solo se permiten letras y espacios en blanco.
                        </div>';
                }
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="alert alert-danger">
                            El formato del correo electrónico no es válido.
                        </div>';
                }
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
                    $_passwordErr = '<div class="alert alert-danger">
                             La contraseña debe tener entre 6 y 20 caracteres, contener al menos un carácter especial, minúsculas, mayúsculas y un dígito.
                        </div>';
                }
                
                // Store the data in db, if all the preg_match condition met
                if((preg_match("/^[a-zA-Z ]*$/", $_first_name)) && (preg_match("/^[a-zA-Z ]*$/", $_last_name)) &&
                 (filter_var($_email, FILTER_VALIDATE_EMAIL)) && 
                 (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $_password))){

                    // Generate random activation token
                    $token = md5(rand().time());

                    // Password hash
                    $password_hash = password_hash($password, PASSWORD_BCRYPT);

                    // Query
                    $sql = "INSERT INTO customers (firstname, lastname, email, password, token, is_active) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$password_hash}', '{$token}', '0')";
                    
                    // Create mysql query
                    $sqlQuery = mysqli_query($connection, $sql);
                    
                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($connection));
                    } 

                    // Send verification email
                    if($sqlQuery) {
                        $msg =  '<html>
								  <head>
									<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
									<style>
									</style>
								  </head>
								  <body class="bg-light">
									<div class="container">
									  <div class="card my-10">
										<div class="card-body">
										  <div class="space-y-3">
											<p class="text-gray-700">
											  ¡Hola '.$firstname.'!
											</p>
											<p class="text-gray-700">
											  Para disfrutar de todos los beneficios de Easy Rent Car, es necesario que verifique su cuenta.
											</p>
											<p class="text-gray-700 mb-2">
												Haga clic en el enlace de activación para verificar su cuenta.
											</p>          
										  </div>
										  <a class="btn btn-primary" href="https://easyrental.alanaquino.com/user_verificaiton.php?token='.$token.'" target="_blank">VERIFIQUE SU CUENTA AQUÍ</a>
										  <hr>
										  <p class="text-gray-500 mb-2">
												Sus datos personales se utilizarán para administrar el acceso a su cuenta y para otros fines descritos en nuestro sitio
										  </p> 
										</div>
									  </div>
									</div>
								  </body>
								</html>
							';

                        // Create the Transport
                        $transport = (new Swift_SmtpTransport('easyrental.alanaquino.com', 465, 'ssl'))
                        ->setUsername('info@easyrental.alanaquino.com')
                        ->setPassword('yk.cdZ=#BO_X');

                        // Create the Mailer using your created Transport
                        $mailer = new Swift_Mailer($transport);

                        // Create a message
                        $message = (new Swift_Message('¡Hey '. $firstname .'!, verifique su cuenta en Easy Rent Car'))
                        ->setFrom(['info@easyrental.alanaquino.com' => 'Easy Rental Car'])
                        ->setTo($email)
                        ->addPart($msg, "text/html")
                        ->setBody('Estimado(a) '.$firstname.':');

                        // Send the message
                        $result = $mailer->send($message);
                          
                        if(!$result){
                            $email_verify_err = '<div class="alert alert-danger">
                                    ¡No se pudo enviar el correo electrónico de verificación!
                            </div>';
                        } else {
                            $email_verify_success = '<div class="alert alert-success">
                                ¡Se ha enviado el correo electrónico de verificación!
                            </div>';
                        }
                    }
                }
            }
        } else {
            if(empty($firstname)){
                $fNameEmptyErr = '<div class="alert alert-danger">
                    Su nombre no puede estar en blanco.
                </div>';
            }
            if(empty($lastname)){
                $lNameEmptyErr = '<div class="alert alert-danger">
                    Su apellido no puede estar en blanco.
                </div>';
            }
            if(empty($email)){
                $emailEmptyErr = '<div class="alert alert-danger">
                    El correo electrónico no puede estar en blanco.
                </div>';
            }
            if(empty($password)){
                $passwordEmptyErr = '<div class="alert alert-danger">
                    La contraseña no puede estar en blanco.
                </div>';
            }            
        }
    }
?>