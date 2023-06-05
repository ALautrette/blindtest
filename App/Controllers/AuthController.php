<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use DateTime;
use DateInterval;
use DateTimeZone;

class AuthController
{
    public function __construct(
        private UserRepository $userRepository = new UserRepository()
    ) {
    }

    public function create()
    {
        require_once __DIR__ . '/../Views/Auth/register.php';
    }

    public function store()
    {
        if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
            $message = 'All fields are required';
            return require_once __DIR__ . '/../Views/Auth/register.php';
        }

        try {
            $_POST['password'] = crypt($_POST['password'], 'salt');
            $user = $this->userRepository->create($_POST);
            $_SESSION['user'] = $user;
            header('Location: /dashboard');
        } catch (\PDOException $e) {
            $message = $this->getErrorMessage($e);
            return require_once __DIR__ . '/../Views/Auth/register.php';
        }
    }

    public function loginPage()
    {
        require_once __DIR__ . '/../Views/Auth/login.php';
    }

    public function login()
    {
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $message = 'All fields are required';
            return require_once __DIR__ . '/../Views/Auth/login.php';
        }

        try {
            $user = $this->userRepository->findByEmail($_POST['email']);
            $user->verifyPassword($_POST['password']);

            $_SESSION['user'] = $user;
            header('Location: /dashboard');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return require_once __DIR__ . '/../Views/Auth/login.php';
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header('Location: /');
    }

    public function resetPage()
    {
        require_once __DIR__ . '/../Views/Auth/reset.php';
    }

    public function reset()
    {
        if (empty($_POST['email'])) {
            $message = 'Please provide an email address';
            return require_once __DIR__ . '/../Views/Auth/reset.php';
        }

        try {
            $user = $this->userRepository->findByEmail($_POST['email']);

            $token = bin2hex(random_bytes(16));

            $expiry = new DateTime('now', new DateTimeZone("UTC"));
            $expiry = $expiry->add(new DateInterval('PT15M'));
            $this->userRepository->update($user->id(), ['reset_token' => $token, 'token_expiry' => $expiry->format('Y-m-d H:i:s')]);
            header('Location: /login');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return require_once __DIR__ . '/../Views/Auth/reset.php';
        }
    }

    public function newPwdPage()
    {
        try {
            if (empty($_GET['token'])) {
                $message = 'No token was provided';
                return require_once __DIR__ . '/../Views/Auth/reset.php';
            }
            $token = $_GET['token'];
            $user = $this->userRepository->findByResetToken($token);

            if (empty($user) || new DateTime('now', new DateTimeZone("UTC")) >= new DateTime($user->token_expiry())) {
                $message = 'Invalid token';
                return require_once __DIR__ . '/../Views/Auth/reset.php';
            }
            require_once __DIR__ . '/../Views/Auth/newPwd.php';
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return require_once __DIR__ . '/../Views/Auth/reset.php';
        }
    }

    public function newPwd()
    {
        if (empty($_POST['password']) || empty($_POST['userId'])) {
            $message = 'Please provide a new password';
            return require_once __DIR__ . '/../Views/Auth/reset.php';
        }

        try {
            $this->userRepository->update($_POST['userId'], ['password' => crypt($_POST['password'], 'salt'), 'reset_token' => null, 'token_expiry' => null]);
            header('Location: /login');
        } catch (\Exception $e) {
            $message = $e->getMessage();
            return require_once __DIR__ . '/../Views/Auth/reset.php';
        }
    }

    private function getErrorMessage(\PDOException|\Exception $e): string
    {
        if (str_contains($e->getMessage(), "for key 'username'")) {
            return 'Username already taken';
        }
        if (str_contains($e->getMessage(), "for key 'email'")) {
            return 'An account with this email already exists';
        }
        return 'Something went wrong';
    }
}
