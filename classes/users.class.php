<?php

class Users
{
    private $db;
    private $logs;
    private $class_name;
    private $class_name_lower;
    private $table_name;

    public function __construct(PDO $db) {
        $this->logs = new Logs((new DB())->connect());
        $this->db = $db;
        $this->class_name = "Users";
        $this->class_name_lower = "users_class";
        $this->table_name = "users";
    }
    


    public function insert ($email, $password, $first_name, $last_name, $phone, $address, $address2, $city, $user_title, $address_country, $country, $dob, $relationship, $country_lived)
    {
        $q = "INSERT INTO `{$this->table_name}` (`user_email`, `user_password`, `user_first_name`, `user_last_name`, `user_phone`, `user_address`, `user_address2`, `user_city`, `user_title`, `address_country`, `user_country`, `user_dob`, `user_relationship`, `user_country_lived`, `user_created`) VALUES (:e, :p, :fn, :ln, :ph, :ad, :ad2, :ci,:ut,:adc, :co, :dob, :re, :cl, :dt)";
        $s = $this->db->prepare($q);

        $s->bindParam(":e", $email);
        $s->bindParam(":p", $password);
        $s->bindParam(":fn", $first_name);
        $s->bindParam(":ln", $last_name);
        $s->bindParam(":ph", $phone);
        $s->bindParam(":ad", $address);
        $s->bindParam(":ad2", $address2);
        $s->bindParam(":ci", $city);
        $s->bindParam(":ut", $user_title);
        $s->bindParam(":adc", $address_country);
        $s->bindParam(":co", $country);
        $s->bindParam(":dob", $dob);
        $s->bindParam(":re", $relationship);
        $s->bindParam(":cl", $country_lived);
        $dt = current_date();
        $s->bindParam(":dt", $dt);

        if (!$s->execute()) {
            $failure = $this->class_name.'.insert - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        return ['status' => true, 'user_id' => $this->db->lastInsertId()];
    }


    public function create_user ($email, $password)
    {
        $q = "INSERT INTO `{$this->table_name}` (`user_email`, `user_password`, `user_created`) VALUES (:e, :p, :dt)";
        $s = $this->db->prepare($q);

        $s->bindParam(":e", $email);
        $s->bindParam(":p", $password);
        $dt = current_date();
        $s->bindParam(":dt", $dt);

        if (!$s->execute()) {
            $failure = $this->class_name.'.create_user - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        return ['status' => true, 'user_id' => $this->db->lastInsertId()];
    }

    public function set_session ($user_id)
    {
        $_SESSION['logged'] = true;
        $_SESSION['logged_user'] = $user_id;
    }

    public function logout ()
    {
        if (isset($_SESSION['logged'])) {
            unset($_SESSION['logged']);
        }
        if (isset($_SESSION['logged_user'])) {
            unset($_SESSION['logged_user']);
        }
        return true;
    }

    public function get_logged_user ()
    {
        $user = $this->get_user_by('user_id', $_SESSION['logged_user']);
        if (!$user['status']) {
            return ['status' => false, 'data' => 'Unable to find user details'];
        }

        $user = $user['data'];

        $status = $this->check_user_status($user['user_status']); 
        if (!$status['status']) {
            return $status;
        }

        return ['status' => true, 'data' => $user];
    }


    public function check_user_status ($status)
    {
        if ($status === 'B') {
            return ['status' => false, 'data' => 'Account is banned.'];
        }
        return ['status' => true];
    }

    public function get_user_by ($col, $val)
    {
        $q = "SELECT * FROM `{$this->table_name}` WHERE `$col` = :v";
        $s = $this->db->prepare($q);
        $s->bindParam(":v", $val);

        if (!$s->execute()) {
            $failure = $this->class_name.'.get_user_by - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        if ($s->rowCount() === 0) {
            return ['status' => false, 'type' => 'empty'];
        }
        return ['status' => true, 'data' => $s->fetch()];
    }

    public function get_occupations_by_user ($user_id, $type)
    {
        $q = "SELECT * FROM `user_jobs` WHERE `user_job_user_id` = :u AND `user_job_partner_type` = :t"; 
        $s = $this->db->prepare($q);
        $s->bindParam(":u", $user_id);
        $s->bindParam(":t", $type);

        if (!$s->execute()) {
            $failure = $this->class_name.'.get_occupations_by_user - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        if ($s->rowCount() === 0) {
            return ['status' => false, 'type' => 'empty'];
        }
        return ['status' => true, 'data' => $s->fetchAll()];
    }

    public function get_educations_by_user ($user_id, $type)
    {
        $q = "SELECT * FROM `user_education` WHERE `user_education_user_id` = :u AND `user_education_partner_type` = :t"; 
        $s = $this->db->prepare($q);
        $s->bindParam(":u", $user_id);
        $s->bindParam(":t", $type);

        if (!$s->execute()) {
            $failure = $this->class_name.'.get_occupations_by_user - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        if ($s->rowCount() === 0) {
            return ['status' => false, 'type' => 'empty'];
        }
        return ['status' => true, 'data' => $s->fetchAll()];
    }

    public function get_childrens_by_user ($user_id)
    {
        $q = "SELECT * FROM `user_children` WHERE `user_children_user_id` = :u"; 
        $s = $this->db->prepare($q);
        $s->bindParam(":u", $user_id);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_childrens_by_user - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        if ($s->rowCount() === 0) {
            return ['status' => false, 'type' => 'empty'];
        }
        return ['status' => true, 'data' => $s->fetchAll()];
    }

    public function get_all_users ()
    {
        $q = "SELECT * FROM `{$this->table_name}`";
        $s = $this->db->prepare($q);
        if (!$s->execute()) {
            $failure = $this->class_name.'.get_all_users - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        if ($s->rowCount() === 0) {
            return ['status' => false, 'type' => 'empty'];
        }
        return ['status' => true, 'data' => $s->fetchAll()];
    }

    public function update_user_partner ($data, $jobs, $educations, $childrens, $partner_type, $user_id)
    {
        $q = "DELETE FROM `user_jobs` WHERE `user_job_user_id` = :u AND `user_job_partner_type` = :t";
        $s = $this->db->prepare($q);
        $s->bindParam(':u', $user_id);
        $s->bindParam(':t', $partner_type);
        if (!$s->execute()) {
            $failure = $this->class_name.'.update_user_partner - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        $q = "DELETE FROM `user_education` WHERE `user_education_user_id` = :u AND `user_education_partner_type` = :t";
        $s = $this->db->prepare($q);
        $s->bindParam(':u', $user_id);
        $s->bindParam(':t', $partner_type);
        if (!$s->execute()) {
            $failure = $this->class_name.'.update_user_partner - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        $q = "DELETE FROM `user_children` WHERE `user_children_user_id` = :u";
        $s = $this->db->prepare($q);
        $s->bindParam(':u', $user_id);
        if (!$s->execute()) {
            $failure = $this->class_name.'.update_user_partner - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        if (!empty($jobs)) {
            $vals = "";
            $d = [];
            foreach ($jobs as $i => $job) {
                if (!empty($vals)) { $vals .= ", "; }
    
                $d[":u$i"] = $user_id;
                $d[":c$i"] = $job['company'];
                $d[":p$i"] = $job['position'];
                $d[":s$i"] = $job['start'];
                $d[":e$i"] = $job['end'];
                $d[":t$i"] = $job['type'];
                $d[":d$i"] = $job['description'];
                $d[":pt$i"] = $partner_type;
    
                $vals .= "(:u$i, :c$i, :p$i, :s$i, :e$i, :t$i, :d$i, :pt$i)";
            }
            $q = "INSERT INTO `user_jobs` (`user_job_user_id`, `user_job_company`, `user_job_position`, `user_job_start`, `user_job_end`, `user_job_type`, `user_job_description`, `user_job_partner_type`) VALUES $vals";
    
            $s = $this->db->prepare($q);
            if (!$s->execute($d)) {
                $failure = $this->class_name.'.update_user_partner - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
        }
        
        if (!empty($educations)) {
            $vals = "";
            $d = [];
            foreach ($educations as $i => $education) {
                if (!empty($vals)) { $vals .= ", "; }

                $d[":u$i"] = $user_id;
                $d[":t$i"] = $education['title'];
                $d[":m$i"] = $education['major'];
                $d[":i$i"] = $education['institute'];
                $d[":q$i"] = $education['qualification'];
                $d[":c$i"] = $education['certificate'];
                $d[":pt$i"] = $partner_type;

                $vals .= "(:u$i, :t$i, :m$i, :i$i, :q$i, :c$i, :pt$i)";
            }
            $q = "INSERT INTO `user_education` (`user_education_user_id`, `user_education_title`, `user_education_major`, `user_education_institute`, `user_education_qualification`, `user_education_certificate`, `user_education_partner_type`) VALUES $vals";
            $s = $this->db->prepare($q);
            if (!$s->execute($d)) {
                $failure = $this->class_name.'.update_user_partner - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
        }

        if (!empty($childrens)) {
            $vals = "";
            $d = [];
            foreach ($childrens as $i => $children) {
                if (!empty($vals)) { $vals .= ", "; }
    
                $d[":u$i"] = $user_id;
                $d[":n$i"] = $children['child_name'];
                $d[":d$i"] = $children['dob'];
                $d[":c$i"] = $children['country'];
    
                $vals .= "(:u$i, :n$i, :d$i, :c$i)";
            }
            $q = "INSERT INTO `user_children` (`user_children_user_id`, `user_children_name`, `user_children_dob`, `user_children_country`) VALUES $vals";
            $s = $this->db->prepare($q);
            if (!$s->execute($d)) {
                $failure = $this->class_name.'.update_user_partner - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
        }

        $cols = "";
        $d = [];
        foreach ($data as $col => $val) {
            if (!empty($cols)) { $cols .= ", "; }
            $cols .= "`$col` = :$col";
            $d[":$col"] = $val;
        }

        $q = "UPDATE `{$this->table_name}` SET $cols WHERE `user_id` = :u";
        $s = $this->db->prepare($q);
        $d[':u'] = $user_id;
        if (!$s->execute($d)) {
            $failure = $this->class_name.'.update_user_partner - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }
        return ['status' => true];
    }

    public function update_user ($data, $jobs, $educations, $partner_type, $user_id)
    {
        $q = "DELETE FROM `user_jobs` WHERE `user_job_user_id` = :u AND `user_job_partner_type` = :t";
        $s = $this->db->prepare($q);
        $s->bindParam(':u', $user_id);
        $s->bindParam(':t', $partner_type);
        if (!$s->execute()) {
            $failure = $this->class_name.'.update_user - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        $q = "DELETE FROM `user_education` WHERE `user_education_user_id` = :u AND `user_education_partner_type` = :t";
        $s = $this->db->prepare($q);
        $s->bindParam(':u', $user_id);
        $s->bindParam(':t', $partner_type);
        if (!$s->execute()) {
            $failure = $this->class_name.'.update_user - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }

        if (!empty($jobs)) {
            $vals = "";
            $d = [];
            foreach ($jobs as $i => $job) {
                if (!empty($vals)) { $vals .= ", "; }
    
                $d[":u$i"] = $user_id;
                $d[":c$i"] = $job['company'];
                $d[":p$i"] = $job['position'];
                $d[":s$i"] = $job['start'];
                $d[":e$i"] = $job['end'];
                $d[":t$i"] = $job['type'];
                $d[":d$i"] = $job['description'];
                $d[":pt$i"] = $partner_type;
    
                $vals .= "(:u$i, :c$i, :p$i, :s$i, :e$i, :t$i, :d$i, :pt$i)";
            }
            $q = "INSERT INTO `user_jobs` (`user_job_user_id`, `user_job_company`, `user_job_position`, `user_job_start`, `user_job_end`, `user_job_type`, `user_job_description`, `user_job_partner_type`) VALUES $vals";
            $s = $this->db->prepare($q);
            if (!$s->execute($d)) {
                $failure = $this->class_name.'.update_user - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
        }
        
        if (!empty($educations)) {
            $vals = "";
            $d = [];
            foreach ($educations as $i => $education) {
                if (!empty($vals)) { $vals .= ", "; }

                $d[":u$i"] = $user_id;
                $d[":t$i"] = $education['title'];
                $d[":m$i"] = $education['major'];
                $d[":i$i"] = $education['institute'];
                $d[":q$i"] = $education['qualification'];
                $d[":c$i"] = $education['certificate'];
                $d[":pt$i"] = $partner_type;

                $vals .= "(:u$i, :t$i, :m$i, :i$i, :q$i, :c$i, :pt$i)";
            }
            $q = "INSERT INTO `user_education` (`user_education_user_id`, `user_education_title`, `user_education_major`, `user_education_institute`, `user_education_qualification`, `user_education_certificate`, `user_education_partner_type`) VALUES $vals";
            $s = $this->db->prepare($q);
            if (!$s->execute($d)) {
                $failure = $this->class_name.'.update_user - E.02: Failure';
                $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
                return ['status' => false, 'type' => 'query', 'data' => $failure];
            }
        }

        $cols = "";
        $d = [];
        foreach ($data as $col => $val) {
            if (!empty($cols)) { $cols .= ", "; }
            $cols .= "`$col` = :$col";
            $d[":$col"] = $val;
        }

        $q = "UPDATE `{$this->table_name}` SET $cols WHERE `user_id` = :u";
        $s = $this->db->prepare($q);
        $d[':u'] = $user_id;
        if (!$s->execute($d)) {
            $failure = $this->class_name.'.update_user - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }
        return ['status' => true];
    }


    public function update_user_data ($data, $user_id)
    {
        $cols = "";
        $d = [];
        foreach ($data as $col => $val) {
            if (!empty($cols)) { $cols .= ", "; }
            $cols .= "`$col` = :$col";
            $d[":$col"] = $val;
        }

        $q = "UPDATE `{$this->table_name}` SET $cols WHERE `user_id` = :u";
        $s = $this->db->prepare($q);
        $d[':u'] = $user_id;
        if (!$s->execute($d)) {
            $failure = $this->class_name.'.update_user_data - E.02: Failure';
            $this->logs->create($this->class_name_lower, $failure, json_encode($s->errorInfo()));
            return ['status' => false, 'type' => 'query', 'data' => $failure];
        }
        return ['status' => true];
    }

    
    public function login ($email, $password)
    {
        $user = $this->get_user_by('user_email', $email);
        if (!$user['status']) {
            return ['status' => false, 'data' => 'Provided email is not accociated with any account.', 'type' => 'no'];
        }
        $user = $user['data'];
        
        if ($user['user_status'] === 'B') {
            return ['status' => false, 'data' => 'Account is banned.', 'type' => 'banned'];
        }

        if (!password_verify($password, $user['user_password'])) {
            return ['status' => false, 'data' => 'Provided password is incorrect.', 'type' => 'password'];
        }

        $this->set_session($user['user_id']);

        return ['status' => true, 'user' => $user];
    }

}
