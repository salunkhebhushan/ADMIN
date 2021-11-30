<?php

namespace App\Controllers;
use App\Models\LoginModal;

class Home extends BaseController
{
	
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger){
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);
		header("Access-Control-Allow-Origin: * ");
		header("Access-Control-Allow-Methods: *");
		header("Access-Control-Allow-Headers: * ");
       
	}
	
	function __construct()
    {
        helper(['url', 'form']); 
        $this->LoginModal = new LoginModal();
    }
	
	
    public function index()
    {
       // return view('welcome_message');
        $logged_in = $this->checkLogin();
        $data['strUsername'] = '';
        if ($logged_in) {
           // redirect(BASE. '/Dashboard');
            return view('dashboard-crm');
        } else {
            $data['title'] = 'Login';
            return view('auth-sign-in-social',$data);
        }
    }



     /**
     * Added By: Bhushan Salunkhe
     * Added Date: 29 Nov 2021
     * This function is used for the check login
     */
    function checkLogin() {
        if (isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])) {
            $_SESSION['CRM_ADMIN_DETAILS']['username'] = $_COOKIE['cookname'];
            $_SESSION['password'] = $_COOKIE['cookpass'];
        }
        
        if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
            if ($_SESSION['username'] != 0 && $_SESSION['password'] != 0) {
                unset($_SESSION['CRM_ADMIN_DETAILS']['username']);
                unset($_SESSION['password']);
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

 /**
     * Created By: Bhushan Salunkhe
     * Created Date: 29 Nov 2021
     * Code For: Authenticate credentials of login user
     */
    public function authenticateCredentials() {
     
        $strUsername = $this->request->getPost('user-name');
        $strPassword = trim($this->request->getPost('password'));
        $data['title'] = 'Login';
        
        $data['strUsername'] = $strUsername;
        $insertStatus = true;
        if($strUsername == ''){
            $insertStatus = false;
            $data['errorMessage'] = '<div class="alert alert-danger background-danger">Username Should Not Be Blank !</div>';
            return view('auth-sign-in-social', $data);
           
        }
        if($strPassword == ''){
            $insertStatus = false;
            $data['errorMessage'] = '<div class="alert alert-danger background-danger">Password Should Not Be Blank !</div>';
            return view('auth-sign-in-social', $data);
           
        }
        
        if (true == $insertStatus) {
            $boolError = false;
            $arrstrUser = $this->LoginModal->where('AU_Username',$strUsername)->where('AU_Password',$strPassword)->first();
           
           
            $_SESSION['CRM_ADMIN_DETAILS'] = $arrstrUser;
            
            if (empty($arrstrUser)) {
                $data['errorMessage'] = '<div class="alert alert-danger background-danger">Login Authentication failed !</div>';
                $boolError = true;
               // $this->load->view('login', $data);
               return view('auth-sign-in-social', $data);
            } else if ($arrstrUser['AU_Status'] == 0) {
                $data['errorMessage'] = '<div class="alert alert-danger background-danger">Account Is De-Activated. Contact Administrator !</div>';
                $boolError = true;
                return view('auth-sign-in-social', $data);
            } else if ($boolError != true && sizeof($arrstrUser) > 0) {
                if ($arrstrUser['AU_Status'] == 1) {
                    $status = $this->setLoggedInUserParams($arrstrUser);
                  
                    if ($status == true) {
                        //redirect(BASE. "/Dashboard");
                        return view('dashboard-crm');
                    } else {
                        return view('auth-sign-in-social', $data);
                    }
                }
            }
        } else {
            $data['errorMessage'] = '<div class="alert alert-danger background-danger"><h5>Username / Password Should Not Be Blank !</h5></div>';
            return view('auth-sign-in-social', $data);
        }
    }


        /**
     * Created By: Dharmesh Patil
     * Created Date: 06 Dec 2018
     * Code For: Set the login user parameters
     */
    private function setLoggedInUserParams($arrstrUser) {
        if (isset($_COOKIE['cookname']) && isset($_COOKIE['cookpass'])) {
            $_SESSION['username'] = $_COOKIE['cookname'];
            $_SESSION['password'] = $_COOKIE['cookpass'];
        } else {
            $_SESSION['username'] = $arrstrUser['AU_Username'];
            $_SESSION['password'] = $arrstrUser['AU_Password'];
        }
        
        $_SESSION['username'] = $arrstrUser['AU_Password'];
        $_SESSION['user_id'] = $arrstrUser['AU_ID'];
        $_SESSION['accType'] = $arrstrUser['AU_Type'];
      // echo '<pre>';
   // print_r($_COOKIE);exit;
     //  print_r($_SESSION['CRM_ADMIN_DETAILS']);exit;
        $today = date('Y-m-d | h:i:s a');
        $login = date('Y-m-d h:i:s');
        list($date, $time) = explode('|', $today);
        $this->LoginModal->intUserId     = $_SESSION['user_id'];
        $this->LoginModal->loginDateTime = $login;
        $this->LoginModal->activity      = "Logged In";
        $this->LoginModal->sessionTime   = "";
        $this->LoginModal->loginDate     = $login;
        $this->LoginModal->loginTime     = $time;
        $_SESSION['Log_Id']            = $this->LoginModal->insertData();
        return true;
    }


     /**
     * Created By: Bhushan Salunkhe
     * Created Date: 30 Nov 2021
     * Code For: This function is used to logout the login user
     */
    public function logout() {
        if (isset($_SESSION['CRM_ADMIN_DETAILS']['AU_ID'])) {
            $logRecord = $this->LoginModal->fetchLogRecord();
           
            foreach ($logRecord as $row) {
                $activity = $row->LH_Activity;
                $login    = $row->LH_Login_Datetime;
            }
           
            
            $today = date('Y-m-d | h:i:s a');
            $logout = date('Y-m-d h:i:s');
            list($date, $time) = explode('|', $today);
            $activity .= ", Logged Out";
            $diff = $this->dateDiff($login, date("Y-m-d H:i:s"));
            
            $this->LoginModal->intUserId   = $_SESSION['CRM_ADMIN_DETAILS']['AU_ID'];
            $this->LoginModal->activity    = $activity;
            $this->LoginModal->sessionTime = $diff;
            $this->LoginModal->loginoutDate     = $logout;
            $this->LoginModal->loginoutTime     = $time;
            $this->LoginModal->updateLogout();
            
        }
        session_destroy();
        $data['title'] = "Login";
        return redirect()->to(BASE);
      //  return view('auth-sign-in-social', $data);
    }

    /**
     * 
     * This function is used for calculate the difference between two datetime
     * Added By: Bhushan Salunkhe
     */
    function dateDiff($time1, $time2, $precision = 6)
    {
        if (!is_int($time1)) {
            $time1 = strtotime($time1);
        }
        if (!is_int($time2)) {
            $time2 = strtotime($time2);
        }
        
        if ($time1 > $time2) {
            $ttime = $time1;
            $time1 = $time2;
            $time2 = $ttime;
        }
        
        $intervals = array(
            'year',
            'month',
            'day',
            'hour',
            'minute',
            'second'
        );
        $diffs     = array();
        
        foreach ($intervals as $interval) {
            $ttime  = strtotime('+1 ' . $interval, $time1);
            $add    = 1;
            $looped = 0;
            while ($time2 >= $ttime) {
                $add++;
                $ttime = strtotime("+" . $add . " " . $interval, $time1);
                $looped++;
            }
            $time1            = strtotime("+" . $looped . " " . $interval, $time1);
            $diffs[$interval] = $looped;
        }
        
        $count = 0;
        $times = array();
        foreach ($diffs as $interval => $value) {
            if ($count >= $precision) {
                break;
            }
            if ($value > 0) {
                if ($value != 1) {
                    $interval .= "s";
                }
                $times[] = $value . " " . $interval;
                $count++;
            }
        }
        return implode(", ", $times);
    }


}
