<?php

declare(strict_types=1);

namespace App\Controllers;

use PDO;
use App\Models\User;
use App\Helpers\Helper;
use App\DB\DBConnection;
use App\Models\Customer;

class HomeController extends Controller
{

    public function index(): void
    {
        $db = (new DBConnection())->getConnection();
        $customers = [];

        $stmt = $db->query('SELECT * FROM tblCustomer');
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Customer::class);

        $customers = $stmt->fetchAll();

        // require VIEWS_PATH . 'home.php';
        $this->render('home.twig', ['customers' => $customers]);
    }

    public function login(): void
    {
        $this->render('login.twig');
    }

    public function auth(): void
    {
        // if the request is not a POST request, redirect to the login page
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        // validate the fields
        $fields = User::validate($_POST);

        // if fields is false, redirect to the login page
        if (!$fields) {
            header('Location: /login');
            exit;
        }

        // find the user
        $user = User::find($fields['email'], $fields['password']);

        // if user is found, set the session and redirect to the home page
        if ($user) {
            $_SESSION['user'] = [
                'email' > $user->getEmail(),
            ];
            header('Location: /');
            exit;
        } else {
            $_SESSION['message'] = 'Invalid credentials';
            // retain the email field value
            $_SESSION['fields'] = ['email' => $fields['email']];
            header('Location: /login');
            exit;
        }
    }

    public function createUser(): void
    {
        $email = 'email@example.com';

        $user = new User($email, 'password');
        $user = $user->create();

        var_dump($user);
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        header('Location: /login');
        exit;
    }
}
