<?php
/**
 * McAllister Software Systems
 * User: jstevens
 * Date: 10/6/13
 * Time: 12:25 PM
 */


/**
 * Class Auth
 */
class Auth
{

    /**
     * @var PDO
     */
    private $conn;

    /**
     * @var
     */
    protected $_username; // using protected so they can be accessed

    /**
     * @var
     */
    protected $_user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->_user;
    }


    /**
     *
     */
    function __construct()
    {
        try
        {
            $conn = new PDO('mysql:host=97.65.86.97;dbname=vetlogic_live', "warren", "mumbojumbo10");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e)
        {
            echo 'ERROR: ' . $e->getMessage();
        }
        $this->conn = $conn;

    }


    /**
     *
     */
    public function authInfo($username)
    {
        $this->_username = $username;
        $user = $this->_assignName($this->_username);
        if ($user) $this->_user = $user; // store it so it can be accessed later
    }


    /**
     * @param $username
     * @param $password
     * @return bool
     */
    function validateLogin($username, $password)
    {

        if ($stmt = $this->conn->prepare('SELECT * FROM user WHERE email = :email AND password = :password AND groupId = 1'))
        {
            $newPass = md5($password);
            $stmt->bindParam(':email', $username, PDO::PARAM_STR, 100);
            $stmt->bindParam(':password', $newPass, PDO::PARAM_STR, 32);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                $this->login($username);
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            die("ERROR: VALIDATE STATEMENT COULD NOT BE PREPARED");
        }
    }


    /**
     * @param $username
     * @return bool|mixed
     */
    protected function _assignName($username)
    {
        if ($stmt = $this->conn->prepare("SELECT concat(firstName, ' ',lastName) as name FROM user WHERE email = :email AND groupId = 1"))
        {
            $stmt->bindParam(':email', $username, PDO::PARAM_STR, 100);
            $stmt->execute();

            if ($stmt->rowCount() > 0)
            {
                $info = $stmt->fetch(PDO::FETCH_ASSOC);
                return $info;
            }
            return FALSE;
        }
        else
        {
            die("ERROR: VALIDATE STATEMENT COULD NOT BE PREPARED");
        }
    }

    /**
     * @param $email
     */
    public function login($email)
    {
        Session_start();
        $_SESSION['start'] = time(); // taking now logged in time
        $_SESSION['user'] = $email;
        $_SESSION['expire'] = $_SESSION['start'] + (120 * 60);
        $_SESSION['isLoggedIn'] = true;
    }

    /**
     *
     */
    function checkLogin()
    {
        $now = time();
        if (($now > $_SESSION['expire']) || (!isset($_SESSION['user'])))
        {
            session_destroy();
            header("Location: index");
        }
    }


    /**
     *
     */
    function logout()
    {
        session_start();
        unset($_SESSION['user']);
        session_destroy();
        header("Location: index");
    }

}