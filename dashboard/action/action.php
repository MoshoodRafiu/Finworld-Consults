<?php

// Require database file
require_once "db.php";

/*-------------------------
   SQL Operations Object
--------------------------*/

class Operations extends Database {

    // Register users function
    public function register($values){

        //get values from the VALUES array
        $fname = $values["first_name"];
        $lname = $values["last_name"];
        $uname = $values["user_name"];
        $email = $values["email"];
        $phone = $values["phone"];
        $hash =  password_hash($values["password"], PASSWORD_BCRYPT, ["cost" => 8]);
        $acct = $values["acct_num"];
        $bank = $values["bank_name"];
        $question = $values['question'];
        $answer = password_hash($values['answer'], PASSWORD_BCRYPT, ["cost" => 8]);
        $date = date("y/m/d", strtotime('+9 days'));

        // Check if username already exist
        $sql = "SELECT * FROM user WHERE user_name = ?";

        // Prepared statement
        $stmp = $this->con->prepare($sql);
        $stmp->bind_param("s", $uname);
        $stmp->execute();
        $result = $stmp->get_result();

        // if username doesn't exist
        if ($result->num_rows == 0) {

            // Check if email already exist

            // SQL statement
            $sql = "SELECT * FROM user WHERE email = ?";

            // Prepared statment
            $stmp = $this->con->prepare($sql);
            $stmp->bind_param("s", $email);
            $stmp->execute();
            $result = $stmp->get_result();

            // if email doesn't exist
            if ($result->num_rows == 0) {
                // Check If Account Number Has Been Used
                // SQL statement
                $sql = "SELECT * FROM user WHERE acct_num = ? AND bank_name = ?";
                // Prepared Statement
                $stmp = $this->con->prepare($sql);
                $stmp->bind_param("ss", $acct, $bank);
                $stmp->execute();
                $result = $stmp->get_result();
                // if account num not exists
                if ($result->num_rows == 0){
                    // Register user

                    // SQL statement
                    $sql = "INSERT INTO user ( ";
                    $sql .= implode(",", array_keys($values));
                    $sql .= ", basic_plan_expiry)";
                    $sql .= "VALUES (?,?,?,?,?,?,?,?,?,?,?)";

                    // Prepare Statement
                    $stmt = $this->con->prepare($sql);
                    $stmt->bind_param("sssssssssss", $fname,$lname,$uname,$email,$phone,$hash,$acct,$bank,$question,$answer,$date);
                    if ($stmt->execute()){
                        return "success";
                    }
                }else {
                    return "acct_error";
                }
            } else {
                return "email_error";
            }

        } else {
            return "username_error";
        }
    }

    // User Login function
    public function login($username, $password) {
        // Start session
        session_start();

        // SQL statement
        $sql = "SELECT * FROM user WHERE user_name = ? OR email = ?";

        // Prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();

        // verify if password matches hash
        if (password_verify($password, $result['password'])){
            if ($result['special'] == 0) {
                $_SESSION['user'] = $result['user_name'];
                return "user";
            } else if ($result['special'] == 1) {
                $_SESSION['admin'] = $result['user_name'];
                return "admin";
            }

        }
    }

    public function verifytype($type, $file, $val) {
        if ($type == "image/jpeg" || $type == "image/jpg" || $type == "image/png") {
            return true;
        }else if ($file == ""){
            return $val;
        } else {
            return false;
        }
    }
    // Upload Task function
    public function uploadtask($values){
        // extract first task from array
        $task1 = $values['task1'];
        $inst1 = $values['inst1'];
        $file1 = $values['file1'];
        $tmp1 = $values['tmp1'];
        $type1 = $values['type1'];

        // extract second task from array
        $task2 = $values['task2'];
        $inst2 = $values['inst2'];
        $file2 = $values['file2'];
        $tmp2 = $values['tmp2'];
        $type2 = $values['type2'];

        // extract third task from array
        $task3 = $values['task3'];
        $inst3 = $values['inst3'];
        $file3 = $values['file3'];
        $tmp3 = $values['tmp3'];
        $type3 = $values['type3'];
        $date = date("Y/m/d");

        // Check if type is image
        if ($this->verifytype($type1, $file1, true) && $this->verifytype($type2, $file2, true) && $this->verifytype($type3, $file3, true)) {
            // move files to folder
            move_uploaded_file($tmp1, "../../images/tasks/$file1");
            move_uploaded_file($tmp2, "../../images/tasks/$file2");
            move_uploaded_file($tmp3, "../../images/tasks/$file3");

            // SQL statement
            $sql = "INSERT INTO task (first_task, first_task_url, first_task_inst, second_task, second_task_url, second_task_inst, third_task, third_task_url, third_task_inst, date)";
            $sql .= "VALUES (?,?,?,?,?,?,?,?,?,?)";

            // Prepared statement
            $stmp = $this->con->prepare($sql);
            $stmp->bind_param("ssssssssss", $task1, $file1, $inst1, $task2, $file2, $inst2, $task3, $file3, $inst3, $date);
            if ($stmp->execute()) {
                return "success";
            }

        } else {
            return "failed";
        }
    }

    // Display Tasks on Users Dashboard
    public function displaytask(){
        $date = date("Y/m/d");
        // SQL statement
        $sql = "SELECT * FROM task WHERE date = '".$date."' ORDER BY task_id DESC LIMIT 1";
        $result = $this->con->query($sql);
        $result = $result->fetch_assoc();
        return Array (
            "first_task" => $result['first_task'],
            "first_task_url" => $result['first_task_url'],
            "first_task_inst" => $result['first_task_inst'],
            "second_task" => $result['second_task'],
            "second_task_url" => $result['second_task_url'],
            "second_task_inst" => $result['second_task_inst'],
            "third_task" => $result['third_task'],
            "third_task_url" => $result['third_task_url'],
            "third_task_inst" => $result['third_task_inst']
        );
    }

    // Update Dashboard Earning
    public function updateearning(){
        // SQL statement
        $sql = "SELECT * FROM user WHERE user_name = ?";
        // Prepares statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $_SESSION['user']);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $plan = $result['plan'];
        $daily_earning = $result['daily_earning'];
        $total_earning = $result['total_earning'];
        $withdrawn = $result['withdrawn_earning'];
        $basic_expiry = $result['basic_plan_expiry'];
        $other_expiry =$result['other_plans_expiry'];
        return Array (
            "plan" => $plan,
            "daily_earning" => $daily_earning,
            "total_earning" => $total_earning,
            "withdrawn" => $withdrawn,
            "basic_expiry" => $basic_expiry,
            "other_expiry" => $other_expiry
        );
    }
    public function submittask($values){
        // Extractin first values from array
        $file1 = $values["file1"];
        $tmp1 = $values["tmp1"];
        $type1 = $values["type1"];
        // Extractin second values from array
        $file2 = $values["file2"];
        $tmp2 = $values["tmp2"];
        $type2 = $values["type2"];
        // Extractin third values from array
        $file3 = $values["file3"];
        $tmp3 = $values["tmp3"];
        $type3 = $values["type3"];

        // check if type is image
        if ($this->verifytype($type1, $file1, false) && $this->verifytype($type2, $file2, false) && $this->verifytype($type3, $file3, false)){
            // move files to folder
            move_uploaded_file($tmp1, "../../images/submit/$file1");
            move_uploaded_file($tmp2, "../../images/submit/$file2");
            move_uploaded_file($tmp3, "../../images/submit/$file3");
            // Get user id

            // SQL statement
            $sql = "SELECT * FROM user WHERE user_name = ? ";
            // Prepared Statement
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("s", $_SESSION['user']);
            $stmt->execute();
            $result = $stmt->get_result();
            $result = $result->fetch_assoc();
            $user_id = $result['user_id'];
            $plan = $result['plan'];
            $expiry = $result['other_plans_expiry'];
            $expiry++;
            // Get task id

            // SQL statement
            $date = date("Y/m/d");
            $sql = "SELECT * FROM task WHERE date = ? ORDER BY task_id DESC LIMIT 1";
            // Prepared Statement
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("s", $date);
            $stmt->execute();
            $result = $stmt->get_result();
            $result = $result->fetch_assoc();
            $task_id = $result['task_id'];

            // Check if id user already submitted task
            $sql = "SELECT * FROM approval WHERE user_id = '".$user_id."' AND task_id = '".$task_id."' AND date = '".$date."' ";
            $count = $this->con->query($sql);
            if ($count->num_rows == 0){
                // INSERT into database

                // SQL statement
                $sql = "INSERT INTO approval (task_id,user_id,task_1,task_2,task_3,date) VALUES (?,?,?,?,?,?)";

                // prepared statement
                $stmt = $this->con->prepare($sql);
                $stmt->bind_param("iissss", $task_id,$user_id,$file1,$file2,$file3,$date);
                // Incerement expiry date by 1 if post submitted amd user isnt Basic
                if ($stmt->execute()){
                    if ($plan != "basic"){
                        // SQL statement
                        $sql = "UPDATE user SET other_plans_expiry = '".$expiry."' WHERE user_id = '".$user_id."'";
                        $this->con->query($sql);
                    }
                    return "success";
                }
            } else {
                return "exists";
            }


        } else {
            return "failed";
        }
    }
    public function displaytasks() {
        // display all carried out tasks

        //SQL statement
        $date = date("Y/m/d");
        $sql = "SELECT * FROM approval WHERE date = '".$date."' AND approval_status = 'pending'  ORDER BY approval_id";
        $result = $this->con->query($sql);
        $count = $result->num_rows;
        if ($count != 0) {
            while ($row = $result->fetch_assoc()){
                $array[] = $row;
            }
            return $array;
        }
    }
    // Generate user details from user ID
    public function userdetails($id){
        $sql = "SELECT * FROM user WHERE user_id = '".$id."' ";
        $values = $this->con->query($sql);
        $values = $values->fetch_assoc();
        return $array = Array(
            "user_name" => $values['user_name'],
            "email" => $values['email'],
            "plan" => $values['plan'],
            "total" => $values['total_earning'],
            "withdrawn" => $values["withdrawn_earning"],
            "question" => $values['question']
        );
    }
    // profile details
    public function profiledetails(){

        // SQL statement
        $sql = "SELECT * FROM user WHERE user_name = '".$_SESSION['user']."' ";
        $result = $this->con->query($sql);
        $result = $result->fetch_assoc();
        return Array (
            "id" => $result['user_id'],
            "fname" => $result['first_name'],
            "lname" => $result['last_name'],
            "uname" => $result['user_name'],
            "email" => $result['email'],
            "phone" => $result['phone'],
            "acct" => $result['acct_num'],
            "bank" => $result['bank_name'],
            "plan" => $result['plan'],
            "available" => $result['total_earning'] - $result['withdrawn_earning']
        );
    }
    // Update user profile
    public function updateprofile($values){
        //extract values from array
        $fname = $values['fname'];
        $lname = $values['lname'];
        $acctnum = $values['acctnum'];
        $bankname = $values['bankname'];
        $pass = $values['pass'];
        $npass = $values['npass'];
        $hash = password_hash($npass, PASSWORD_BCRYPT, ["cost" => 8]);

        // Check if user wants to update password
        if ($npass == "") {
            // SQL statement
            $sql = "UPDATE user SET first_name = ?,  last_name = ?, acct_num = ?, bank_name = ? WHERE user_name = ?";

            // Preapred Statement
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("sssss", $fname, $lname, $acctnum, $bankname, $_SESSION['user']);
            if ($stmt->execute()){
                return "success";
            }
        }else {
            // Select user password to verify
            $sql = "SELECT password FROM user where user_name = '".$_SESSION['user']."' ";
            $result = $this->con->query($sql);
            $result = $result->fetch_assoc();
            if (password_verify($pass, $result['password'])) {
                // SQL statement
                $sql = "UPDATE user SET first_name = ?,  last_name = ?, password = ?, acct_num = ?, bank_name = ? WHERE user_name = ?";

                // Prepared statement
                $stmt = $this->con->prepare($sql);
                $stmt->bind_param("ssssss", $fname, $lname,$hash ,$acctnum, $bankname, $_SESSION['user']);
                if ($stmt->execute()){
                    return "success";
                }
            } else {
                return "failed";
            }
        }
    }
    // Withdrawal
    public function withdrawal($id, $amount,$available, $plan) {
        // Check if user is basic and balance after withdrawal is > 1000
        if ($plan == 'basic' && (($available - $amount) < 1000 )){
            return "error";
        }else {
            // Check if account is sufficient
            if ($available >= $amount && $amount >= 500){
                //SQL statement
                $date = date("Y/m/d");
                $sql = "SELECT * FROM withdrawal WHERE user_id = ? AND date = ?";
                //Prepared statement
                $stmt = $this->con->prepare($sql);
                $stmt->bind_param("ss", $id,$date);
                $stmt->execute();
                $result = $stmt->get_result();
                // Check if user already requested withdrawal
                if ($result->num_rows == 0){

                    // DELETE previous withdrawal from user

                    //SQL statement
                    $sql = "DELETE FROM withdrawal WHERE user_id = ? ";
                    //Prepared statement
                    $stmt = $this->con->prepare($sql);
                    $stmt->bind_param("s", $id);
                    $stmt->execute();

                    // INSERT into withdrawal

                    //SQL statement
                    $sql = "INSERT INTO withdrawal (user_id,withdrawal_amount,date) VALUES (?,?,?)";
                    //Prepared statement
                    $stmt = $this->con->prepare($sql);
                    $stmt->bind_param("sss", $id, $amount, $date);
                    if ($stmt->execute()){
                        return "success";
                    }
                }else {
                    return "failed";
                }
            }else {
                return "invalid";
            }
        }
    }
    // Approve task
    public function approvetask($user_id, $task_id){
        $date = date("Y/m/d");
        // SQL statement
        $sql = "UPDATE approval SET approval_status = 'approved' WHERE task_id = ? AND user_id = ? AND date = ? ";
        // Prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sss", $task_id, $user_id, $date);
        $stmt->execute();

        // Update Completed Task

        // SQL statement
        $sql = "SELECT * FROM user WHERE user_id = ?";
        // prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $total_earning = $result['total_earning'];
        $daily_earning = $result['daily_earning'];
        $completed = $result['completed_task'];

        $earning = $total_earning + $daily_earning;
        $completed++;

        //upload in database
        $sql = "UPDATE user SET completed_task = ?, total_earning = ? WHERE user_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sss", $completed, $earning, $user_id);
        $stmt->execute();
    }
    // Decline task
    public function declinetask($user_id, $task_id){
        $date = date("Y/m/d");
        // SQL statement
        $sql = "UPDATE approval SET approval_status = 'declined' WHERE task_id = ? AND user_id = ? AND date = ? ";
        // Prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("sss", $task_id, $user_id, $date);
        $stmt->execute();
    }
    // Show All Withdrawal
    public function displaywithdrawals() {
        // display all carried out tasks

        //SQL statement
        $date = date("Y/m/d");
        $sql = "SELECT * FROM withdrawal WHERE date = '".$date."' AND payment_status = 'pending' ORDER BY withdrawal_id";
        $result = $this->con->query($sql);
        $count = $result->num_rows;
        if ($count != 0) {
            while ($row = $result->fetch_assoc()){
                $array[] = $row;
            }
            return $array;
        }
    }

    // approve withdrawal
    public function approvewithdrawal($user, $withdrawal, $amount){

        // SQL statement
        $sql = "SELECT * FROM user WHERE user_id = ?";

        // prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $withdrawn_earning = $result['withdrawn_earning'];

        $withdrawn_earning = $withdrawn_earning + $amount;
        //upload in database
        $sql = "UPDATE user SET withdrawn_earning = ? WHERE user_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss",$withdrawn_earning, $user);
        $stmt->execute();

        // SQL statement
        $sql = "UPDATE withdrawal SET withdrawal_status = 'approved' WHERE withdrawal_id = ? AND user_id = ?";
        // Prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $withdrawal, $user);
        $stmt->execute();
    }

    // decline withdrawal
    public function declinewithdrawal($user, $withdrawal, $amount){
        // get the withdrawal status

        // SQL statement
        $sql = "SELECT withdrawal_status FROM withdrawal WHERE withdrawal_id = ? AND user_id = ?";
        // Prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $withdrawal, $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        $status = $result['withdrawal_status'];
        if ($status != 'pending'){
            // SQL statement
                $sql = "SELECT * FROM user WHERE user_id = ?";

                // prepared statement
                $stmt = $this->con->prepare($sql);
                $stmt->bind_param("s", $user);
                $stmt->execute();
                $result = $stmt->get_result();
                $result = $result->fetch_assoc();
                $withdrawn_earning = $result['withdrawn_earning'];

                $withdrawn_earning = $withdrawn_earning - $amount;
                //upload in database
                $sql = "UPDATE user SET withdrawn_earning = ? WHERE user_id = ?";
                $stmt = $this->con->prepare($sql);
                $stmt->bind_param("ss",$withdrawn_earning, $user);
                $stmt->execute();
        }
        // SQL statement
        $sql = "UPDATE withdrawal SET withdrawal_status = 'declined' WHERE withdrawal_id = ? AND user_id = ?";
        // Prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ss", $withdrawal, $user);
        $stmt->execute();
    }

    // display all users
    public function displayallusers($type){
        if ($type == "admin"){
            $val = 1;
        }else if ($type == "user"){
            $val = 0;
        }
        // SQL statement
        $sql = "SELECT * FROM user WHERE special = ".$val." ";
        $result = $this->con->query($sql);

        // check if there is a user
        $count = $result->num_rows;
        if ($count != 0) {
            while ($row = $result->fetch_assoc()){
                $array[] = $row;
            }
            return $array;
        }
    }
    // Approve account
    public function approveuser($user){
        // SQL statement
        $sql = "UPDATE user SET account_status = 'approved' WHERE user_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
    }
    // Approve account
    public function restrictuser($user){
        // SQL statement
        $sql = "UPDATE user SET account_status = 'restricted' WHERE user_id = ?";
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
    }
    // Remove Admin
    public function removeAdmin($id) {
        // SQL statement
        $sql = "DELETE FROM user WHERE user_id = ?";
        // Prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }
    // Add new admin
    public function addadmin($username, $email, $password){
        // Check if username already exist
        $sql = "SELECT * FROM user WHERE user_name = ?";

        // Prepared statement
        $stmp = $this->con->prepare($sql);
        $stmp->bind_param("s", $username);
        $stmp->execute();
        $userresult = $stmp->get_result();

        // if username doesnt exist
        if ($userresult->num_rows == 0) {
            // Check if email already exist

            // SQL statement
            $sql = "SELECT * FROM user WHERE email = ?";

            // Prepared statment
            $stmp = $this->con->prepare($sql);
            $stmp->bind_param("s", $email);
            $stmp->execute();
            $emailresult = $stmp->get_result();

            if ($emailresult->num_rows == 0) {
                $special = 1;
                $hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
                // SQL statement
                $sql = "INSERT INTO user (user_name, email, password, special) VALUES (?,?,?,?)";
                // Prepared statment
                $stmt = $this->con->prepare($sql);
                $stmt->bind_param("ssss", $username, $email, $hash, $special);
                if ($stmt->execute()){
                    return "success";
                }
            } else {
                return "email_error";
            }
        }else {
            return "user_error";
        }
    }
    // Search user
    public function searchuser($user) {
        // SQL statement
        $sql = "SELECT * FROM user WHERE user_name = ?";

        // Prepared statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $results = $stmt->get_result();
        $result = $results->fetch_assoc();
        if ($results->num_rows != 0){
            return $result['user_id'];
        }else {
            return "No result";
        }
    }
    // Export Withdrawal
    public function exportwithdrawals(){
        // SQL statement
        $date = date("l, jS \of F Y");
        $id = 1;
        $sql = "SELECT * FROM withdrawal JOIN user ON withdrawal.user_id = user.user_id WHERE withdrawal_status = 'approved'";
        $result = $this->con->query($sql);
        $output = '<h2 style="background-color: gray;"><center>Finworld Consults Withdrawal List For '.$date.'</center></h2><table border="1px" width="80%">
                        <thead>
                            <tr style="background-color: gray;">
                                <td><center>Withdrawal ID</center></td>
                                <td><center>UserName</center></td>
                                <td><center>Email</center></td>
                                <td><center>Active Plan</center></td>
                                <td><center>Amount</center></td>
                                <td><center>Bank Name</center></td>
                                <td><center>Account Number</center></td>
                                <td><center>Status</center></td>
                            </tr>
                        </thead>';
        if ($result->num_rows > 0){
            while ($row = $result->fetch_array()){
                $output .= '
                <tbody>
                    <tr>
                        <td><center>'.$id.'</center></td>
                        <td><center>'.$row['user_name'].'</center></td>
                        <td><center>'.$row['email'].'</center></td>
                        <td><center>'.$row['plan'].'</center></td>
                        <td><center>#'.$row['withdrawal_amount'].'</center></td>
                        <td><center>'.$row['bank_name'].'</center></td>
                        <td><center>'.$row['acct_num'].'</center></td>
                        <td><center>'.$row['withdrawal_status'].'</center></td>
                    </tr>';
                $id++;
            }
            $output .= '</tbody></table>';
            header("Content-type: application/vnd.ms-excel; name='excel'");
            header("Content-Disposition: attachment; filename=withdrawals.xls");
            echo $output;
            exit;
        }else{
            return "empty";
        }
    }
    // Clear Weekly Withdrawal
    public function clearwithdrawals(){
        // check if table is not empty
        $sql = "SELECT * FROM withdrawal WHERE payment_status = 'pending'";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0){
            // SQL statement
            $sql = "UPDATE withdrawal SET payment_status = 'cleared'";
            $this->con->query($sql);
        } else {
            return "empty";
        }
    }
    // Upgrade Plan
    public function upgradeplan($user, $plan) {
        // Get earning based on plan
        if ($plan == "Tier-1"){
            $earning = 250;
        }else if ($plan == "Tier-2"){
            $earning = 600;
        }else if ($plan == "Tier-3"){
            $earning = 950;
        }else if ($plan == "Tier-4"){
            $earning = 1400;
        }else if ($plan == "Tier-5"){
            $earning = 3000;
        }
        $expiry = 0;

        // SQL statement
        $sql = "UPDATE user SET plan = ?, daily_earning = ?, other_plans_expiry = ? WHERE user_id = ?";

        // Prepared Statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("ssss", $plan ,$earning ,$expiry ,$user);
        $stmt->execute();
    }
    // get withdrawal History
    public function withdrawalhistory(){
        // Get user ID from session

        // SQL statement
        $sql = "SELECT user_id FROM user WHERE user_name = '".$_SESSION['user']."'";
        $result = $this->con->query($sql);
        $result = $result->fetch_assoc();
        $id = $result['user_id'];

        // Get Withdrawal History Based on user ID

        // SQL statement
        $sql = "SELECT * FROM withdrawal WHERE user_id = '".$id."'  ORDER BY date DESC LIMIT 10";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $array[] = $row;
            }
            return $array;
        }
    }
    public function taskhistory(){
        // Get user ID from session

        // SQL statement
        $sql = "SELECT user_id FROM user WHERE user_name = '".$_SESSION['user']."'";
        $result = $this->con->query($sql);
        $result = $result->fetch_assoc();
        $id = $result['user_id'];


        // Get Task History Based on user ID

        // SQL statement
        $sql = "SELECT * FROM approval WHERE user_id = '".$id."'  ORDER BY date DESC LIMIT 10";
        $result = $this->con->query($sql);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $array[] = $row;
            }
            return $array;
        }
    }
    // Reset Pssword
    public function resetpassword($email){
        // SQL statement
        $sql = "SELECT * FROM user WHERE email = ?";
        // Prepared Statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $results = $stmt->get_result();
        $result = $results->fetch_assoc();
        if ($results->num_rows > 0){
            session_start();
            $_SESSION['reset'] = $result['user_id'];
            header("Location: ../../change.php");
        }else {
            return "empty";
        }
    }
    // Update Password
    public function updatepassword($answer, $password){
        $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
        // Get the answer

        // SQL statement
        $sql = "SELECT * FROM user WHERE user_id = ?";
        // Prepared Statement
        $stmt = $this->con->prepare($sql);
        $stmt->bind_param("s", $_SESSION['reset']);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_assoc();
        if (password_verify($answer, $result['answer'])){
            // SQL statement
            $sql = "UPDATE user SET password = ? WHERE user_id = ?";
            // Prepared Statement
            $stmt = $this->con->prepare($sql);
            $stmt->bind_param("ss", $password, $_SESSION['reset']);
            if ($stmt->execute()){
                return "success";
            }
        }else{
            return "wrong";
        }
    }

}

/*-------------------------
   Create a new Operations
--------------------------*/
$con = new Operations();

// Check if user registers
if (isset($_POST['register'])) {
    $values = Array(
        "first_name" => $_POST['fname'],
        "last_name" => $_POST['lname'],
        "user_name" => $_POST['uname'],
        "email" => $_POST['email'],
        "phone" => $_POST['phone'],
        "password" => $_POST['password'],
        "acct_num" => $_POST['acctnum'],
        "bank_name" => $_POST['bname'],
        "question" => $_POST['question'],
        "answer" => $_POST['answer']
    );
    if ($con->register($values) == "success"){
        header("Location: ../../register.php?registered=1");
    } else if ($con->register($values) == "username_error") {
        header("Location: ../../register.php?registered=username_error");
    } else if ($con->register($values) == "email_error") {
        header("Location: ../../register.php?registered=email_error");
    } else if ($con->register($values) == "acct_error") {
        header("Location: ../../register.php?registered=acct_error");
    }
}

// Check if user logins
if (isset($_POST['login'])) {
    $useremail = $_POST['useremail'];
    $password = $_POST['password'];
    if ($con->login($useremail, $password) == "user"){
        header("Location: ../../login.php?valid=userlogin");
    } else if ($con->login($useremail, $password) == "admin") {
        header("Location: ../../login.php?valid=adminlogin");
    } else {
        header("Location: ../../login.php?valid=failed");
    }
}

// Check if task is uploaded
if (isset($_POST['uploadtask'])){
    $values = Array(
        // first task
        "task1" => $_POST['tasktitle1'],
        "inst1" => $_POST['inst1'],
        "file1" => $_FILES['file1']['name'],
        "tmp1" => $_FILES['file1']['tmp_name'],
        "type1" => $_FILES['file1']['type'],
        // second task
        "task2" => $_POST['tasktitle2'],
        "inst2" => $_POST['inst2'],
        "file2" => $_FILES['file2']['name'],
        "tmp2" => $_FILES['file2']['tmp_name'],
        "type2" => $_FILES['file2']['type'],
        // thirs task
        "task3" => $_POST['tasktitle3'],
        "inst3" => $_POST['inst3'],
        "file3" => $_FILES['file3']['name'],
        "tmp3" => $_FILES['file3']['tmp_name'],
        "type3" => $_FILES['file3']['type']
    );
    if ($con->uploadtask($values) == "failed") {
        header("Location: ../admin/dashboard.php?status=failed");
    }else if ($con->uploadtask($values) == "success") {
        header("Location: ../admin/dashboard.php?status=success");
    }
}
if (isset($_POST['submittask'])) {
    $values = Array(
        // first task
        "file1" => $_FILES['task1']['name'],
        "tmp1" => $_FILES['task1']['tmp_name'],
        "type1" => $_FILES['task1']['type'],
        // second task
        "file2" => $_FILES['task2']['name'],
        "tmp2" => $_FILES['task2']['tmp_name'],
        "type2" => $_FILES['task2']['type'],
        // third task
        "file3" => $_FILES['task3']['name'],
        "tmp3" => $_FILES['task3']['tmp_name'],
        "type3" => $_FILES['task3']['type']
    );
    if ($con->submittask($values) == "success") {
        echo "<div class=\"alert alert-success mx-auto text-center col-md-10 mt-5\" role=\"alert\">Task Submitted Successfully</div>";
    } else if ($con->submittask($values) == "failed") {
        echo "<div class=\"alert alert-danger mx-auto text-center col-md-10 mt-5\" role=\"alert\">Please Select an Image File</div>";
    }  else if ($con->submittask($values) == "exists") {
        echo "<div class=\"alert alert-danger mx-auto text-center col-md-10 mt-5\" role=\"alert\">You Have Already Submitted Today's Task</div>";
    }
}
if (isset($_POST['updateprofile'])){
    $values = Array (
        "fname" => $_POST['fname'],
        "lname" => $_POST['lname'],
        "acctnum" => $_POST['acctnum'],
        "bankname" => $_POST['bankname'],
        "acctnum" => $_POST['acctnum'],
        "bankname" => $_POST['bankname'],
        "pass" => $_POST['pass'],
        "npass" => $_POST['npass']
    );
    if ($con->updateprofile($values) == "success"){
        echo "<div class=\"alert alert-success mx-auto text-center col-md-8 col-lg-7 mt-5\" role=\"alert\">Profile Updated Successfully</div>";
    }else if ($con->updateprofile($values) == "failed"){
        echo "<div class=\"alert alert-danger mx-auto text-center col-md-8 col-lg-7 mt-5\" role=\"alert\">Old Password Incorrect</div>";
    }
}
if (isset($_POST['withdraw'])){
    $amount = $_POST['amount'];
    $userid = $_POST['id'];
    $available = $_POST['available'];
    $plan = $_POST['plan'];
    if ($con->withdrawal($userid, $amount, $available, $plan) == "success"){
        echo "<div class=\"alert alert-success mx-auto text-center col-md-8 col-lg-7 mt-5\" role=\"alert\">Withdrawal Request Successful, Please Do Not Resend</div>";
    }else if ($con->withdrawal($userid, $amount, $available, $plan) == "invalid"){
        echo "<div class=\"alert alert-danger mx-auto text-center col-md-8 col-lg-7 mt-5\" role=\"alert\">Invalid Withdrawal Request Due To Low Balance Or Invalid Amount</div>";
    }else if ($con->withdrawal($userid, $amount, $available, $plan) == "failed"){
        echo "<div class=\"alert alert-danger mx-auto text-center col-md-8 col-lg-7 mt-5\" role=\"alert\">You Already Requested Withdrawal For This Week</div>";
    }else if ($con->withdrawal($userid, $amount, $available, $plan) == "error"){
        echo "<div class=\"alert alert-danger mx-auto text-center col-md-8 col-lg-7 mt-5\" role=\"alert\">Your Balance Must Not Be Less Than #1,000 For Basic Plan</div>";
    }
}
if (isset($_POST['addadmin'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($con->addadmin($username, $email, $password) == "success"){
        header("Location: ../admin/addadmin.php?add=1");
    }else if ($con->addadmin($username, $email, $password) == "user_error"){
        header("Location: ../admin/addadmin.php?add=user_error");
    }else if ($con->addadmin($username, $email, $password) == "email_error"){
        header("Location: ../admin/addadmin.php?add=email_error");
    }
}
if (isset($_POST['exportwithdrawal'])){
    if ($con->exportwithdrawals() == "empty"){
        header("Location: ../admin/list.php?export=empty");
    }
}
if (isset($_POST['clearwithdrawal'])){
    if ($con->clearwithdrawals() == "empty"){
        header("Location: ../admin/list.php?clear=empty");
    }else {
        header("Location: ../admin/list.php");
    }
}
if (isset($_POST['reset'])){
    $email = $_POST['email'];
    if ($con->resetpassword($email)  == "empty"){
        header("Location: ../../reset.php?empty=1");
    }
}
if (isset($_POST['updatepassword'])){
    $answer = $_POST['answer'];
    $password = $_POST['password'];
    if ($con->updatepassword($answer, $password) == "wrong"){
        echo "<div class=\"alert alert-danger mx-auto text-center col-md-12\" role=\"alert\">Wrong Provided Answer</div>";
    }if ($con->updatepassword($answer, $password) == "success"){
        echo "<div class=\"alert alert-success mx-auto text-center col-md-12\" role=\"alert\">Password Updated Successfully, Redirecting..</div>";
        header("refresh: 2; url= dashboard/action/logout.php");
    }
}