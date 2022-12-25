<?php
    class ordermodel extends DB{
        //Lấy toàn bộ danh sách đơn hàng theo trang
        function GetAllOrder($limit,$offset){
            $sql = "SELECT * FROM donhang as d
            INNER JOIN khachhang as k on k.makh=d.makh
            ORDER BY 'madonhang' ASC LIMIT $limit OFFSET $offset";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }

        //Lấy số lượng tất cả các đơn hàng để làm phân trang
        function GetNumberOrder(){
            $sql = "SELECT * FROM donhang ";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->rowCount();
            return $result;
        }

        //Lấy thông tin khách hàng theo madonhang(để làm trang chi tiết đơn hàng)
        function GetInfoUserById($id){
            $sql = "SELECT * FROM khachhang as k INNER JOIN donhang as d  ON
            d.makh=k.makh
             WHERE d.makh= $id";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return json_decode(json_encode($result),true);
        }

        //Lấy chi tiết đơn hàng<thuan client>
        function GetOrderDetails($id_order){
            $sql = "SELECT * FROM chitietdonhang WHERE madonhang = $id_order";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        //Lay chi tiet don hang admin
        function GetOrderDetailsadmin($id_order){
            $sql = "SELECT * FROM chitietdonhang as c
            INNER JOIN sanpham as s on
            c.masp= s.masp
             WHERE madonhang = $id_order";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        //Lay order thong tin by id admin
        function GetorderByIdadmin($id){
            $sql = "SELECT * FROM donhang as d
            INNER JOIN trangthaidonhang as t
            on t.matrangthai=d.matrangthai
             WHERE d.madonhang= $id";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return json_decode(json_encode($result),true);
        }


        //Xử Lý đơn hàng
        function orderprocessing($id){
            $sql = "UPDATE donhang SET status='Đã Xử Lý' WHERE madonhang= $id";
            $query = $this->conn->prepare($sql);
            $query->execute();
        }
        //hàm lấy trạng thái đơn hàng đã được xử lý hay chưa
        function GetStatusOrder($id){
            $sql = "SELECT * FROM donhang WHERE madonhang= $id";
            $query = $this->conn->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
    }
?>