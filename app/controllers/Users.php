<?php
class Users extends Controller
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data

            // Init data
            $data = [
                'Firstname' => trim($_POST['Firstname']),
                'Lastname' => trim($_POST['Lastname']),
                'Email' => trim($_POST['Email']),
                'PasswordHash' => $_POST['PasswordHash'],
                'UserRole' => $_POST['UserRole'],
                'first_name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if (empty(trim($data['Email']))) {
                $data['email_err'] = 'Please enter email';
            } else {
                // Check email
                if ($this->userModel->findUserByEmail($data['Email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }


            // Validate First Name
            if (empty(trim($data['Firstname']))) {
                $data['first_name_err'] = 'Please enter your first name';
            }
            // Validate Last Name
            if (empty(trim($data['Lastname']))) {
                $data['last_name_err'] = 'Please enter your last name';
            }

            // Validate Password

            if (empty(trim($data['PasswordHash']))) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['PasswordHash']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Make sure errors are empty
            if (empty(trim($data['email_err'])) && empty(trim($data['first_name_err'])) && empty(trim($data['last_name_err'])) && empty(trim($data['password_err']))) {
                // Validated

                // Hash Password
                $data['PasswordHash'] = password_hash($_POST['PasswordHash'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Init data
            $data = [
                'Firstname' => '',
                'Lastname' => '',
                'Email' => '',
                'PasswordHash' => '',
                'UserRole' => '',
                'first_name_err' => '',
                'last_name_err' => '',
                'DateOfBirth_err' => '',
                'email_err' => '',
                'password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    // public function login()
    // {
    //     // Check for POST
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Process form
    //         // Sanitize POST data
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         // Init data
    //         $data = [
    //             'Email' => trim($_POST['Email']),
    //             'password' => trim($_POST['PasswordHash']),
    //             'email_err' => '',
    //             'password_err' => '',
    //         ];

    //         // Validate Email
    //         if (empty($data['Email'])) {
    //             $data['email_err'] = 'Please enter email';
    //         }

    //         // Validate Password
    //         if (empty($data['PasswordHash'])) {
    //             $data['password_err'] = 'Please enter password';
    //         }

    //         // Check for user/email
    //         $userExists = $this->userModel->findUserByEmail($data['Email']);

    //         if ($userExists) {
    //             // User found
    //             // Send verification email and get the verification code
    //             $verificationCodeSent = $this->userModel->sendVerificationEmail($data['Email']);

    //             if ($verificationCodeSent) {
    //                 // Pass the verification code to the view
    //                 $data['verificationCode'] = $verificationCodeSent;

    //                 // Load view with verification code input
    //                 $this->view('users/verify', $data);
    //             } else {
    //                 // Handle email sending error
    //                 $data['email_err'] = 'Unable to send verification email. Please try again later.';
    //                 $this->view('users/login', $data);
    //             }
    //         } else {
    //             // User not found, redirect to the registration page
    //             $data['email_err'] = 'Invalid email or password';
    //             redirect('users/register');
    //         }

    //     } else {
    //         // Init data
    //         $data = [
    //             'Email' => '',
    //             'PasswordHash' => '',
    //             'email_err' => '',
    //             'password_err' => '',
    //         ];

    //         // Load view
    //         $this->view('users/login', $data);
    //     }
    // }

    // public function createUserSession($user)
    // {
    //     $_SESSION['UserID'] = $user['UserID'];
    //     $_SESSION['email'] = $user['Email'];
    //     $_SESSION['first_name'] = $user['FirstName'];
    //     $_SESSION['last_name'] = $user['LastName'];
    //     redirect('binance');
    // }

    // public function logout()
    // {
    //     unset($_SESSION['UserID']);
    //     unset($_SESSION['email']);
    //     unset($_SESSION['first_name']);
    //     unset($_SESSION['last_name']);
    //     session_destroy();
    //     redirect('users/login');
    // }

    // public function verify()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // Process form
    //         $verificationCode = trim($_POST['verificationCode']);

    //         // Check if the verification code is valid
    //         $user = $this->userModel->verifyUserByCode($verificationCode);

    //         if ($user) {
    //             // // Update user status as verified (optional)
    //             // $this->userModel->updateVerificationStatus($user->id);

    //             // Create user session
    //             $this->createUserSession($user);

    //             flash('verify_success', 'Your email has been verified. Welcome!');
    //             redirect('pages/index'); // Redirect to the dashboard or any other page
    //         } else {
    //             flash('verify_error', 'Invalid verification code. Please try again.');
    //             $this->view('users/verify'); // Reload the verification page with an error message
    //         }
    //     } else {
    //         // Redirect to the login page if accessed directly without a POST request
    //         redirect('users/login');
    //     }
    // }
   
}
