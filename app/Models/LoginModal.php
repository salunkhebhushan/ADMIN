<?php

namespace App\Models;
$this->db = \Config\Database::connect();
use CodeIgniter\Model;

class LoginModal extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'admin_users';
    protected $primaryKey       = 'AU_ID';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['AU_Username','AU_Password','AU_FullName','AU_Type','AU_Added_Id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'AU_Added_Date';
    protected $updatedField  = 'AU_Updated_Date	';
   // protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];



    public function insertData() { 
        $today = date("Y-m-d H:i:s");
     
        $data = array(
            'LH_User_ID'=>$this->intUserId,
            'LH_Type'=>$_SESSION['CRM_ADMIN_DETAILS']['AU_Type'],
            'LH_Login_Datetime'=>$today,
            'LH_Activity'=>$this->activity,
            'LH_Session_Time'=>$this->sessionTime,
            'LH_Session_ID'=>$_COOKIE['ci_session'],
            'LH_Login_Date'=>$this->loginDate,
            'LH_Login_Time'=>$this->loginTime
        );
        $insertResult = $this->db->table('loghistory')->insert($data);
        $log_id = $this->db->insertID();
        return $log_id;
    }

     /*
     * Added By: Dharmesh Patil
     * Added Date: 21 Aug 2018
     * Code For: This function is used for fetch log history record of login user
     */
    public function fetchLogRecord() {
        $builder = $this->db->table('loghistory');
        $builder->select('LH_ID,LH_User_ID,LH_Type,LH_Login_Datetime,LH_Activity,LH_Session_Time,LH_Session_ID,LH_Login_Date,LH_Login_Time');
        //$builder->from('loghistory');
        $builder->where(array('LH_Session_ID' => $_COOKIE['ci_session'], 'LH_User_ID' => $_SESSION['CRM_ADMIN_DETAILS']['AU_ID'], 'LH_ID' => $_SESSION['Log_Id']));
          
            $builder->orderBy('LH_ID','desc');
            $builder->limit(1);
            
            $query = $builder->get();
        if(count($query->getResultArray()) == 1) {
            $adminResult = $query->getResult();
                return $query->getResult();
        } else {
            return false;
        }
        }

            /*
     * Added By: Dharmesh Patil
     * Added Date: 21 Aug 2018
     * Code For: This function is used for Update loghistry when user is logout
     */
    public function updateLogout() {
        $data = array(
            'LH_Activity'=>$this->activity,
            'LH_Session_Time'=>$this->sessionTime,
            'LH_Logout_Date'=>$this->loginoutDate,
            'LH_Logout_Time'=>$this->loginoutTime
        );
         $builder = $this->db->table('loghistory');
        
        $updateResult = $builder->update($data, array('LH_Session_ID' => $_COOKIE['ci_session'], 'LH_ID' => $_SESSION['Log_Id'], 'LH_Type' => $_SESSION['CRM_ADMIN_DETAILS']['AU_Type']));
	return true;
    }
    
}
