<?php
    class usermodel extends DB{

        function sigin($email,$pass,$name,$address,$phonenumber,$gender){
            $sql ="INSERT INTO khachhang VALUES ('','$name','$email','$pass','$phonenumber','$address',current_time(),'','0')";
            $query = $this->conn->prepare($sql);
            $result = $query->execute();
            return $result;
        }
        function checkemail($email){
            $sql ="SELECT * FROM khachhang WHERE email = $email";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->rowCount();
            return $result;
        }
    }
?>