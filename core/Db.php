<?php

//mysql 数据库访问类

/**
 * Class Db
 */
class Db
{

    private static function db_connect()
    {
        require BASHPATH . '/config/database.php';
        $conn = mysqli_connect($db['db_host'], $db['db_user'], $db['db_pass'], $db['db_db']);
//        $conn = new mysqli('127.0.0.1', 'root', 'root', 'liuyan');
        if (mysqli_connect_errno()) {
            exit('mysqli connect error' . mysqli_connect_error());
        }
        $conn->set_charset('utf8');
        return $conn;
    }

    /**
     * @param $table
     * @param array $where
     * @return array|bool
     */
    public static function item($table, $where = array())
    {
        $conn = self::db_connect();
        $rows = false;
        $sql = "SELECT * FROM {$table}";
        if ($where) {
            $sql .= ' WHERE ' . self::getwhere($where);
        }
        $sql .= ' LIMIT 1';
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            mysqli_free_result($result);
        }
        mysqli_close($conn);
        if (!$rows) {
            return $rows;
        }
        return $rows[0];
    }

    /**
     * @param $table
     * @param $where
     * @param string $order
     * @return array|bool
     */
    public static function lists($table, $where, $order = '')
    {
        $conn = self::db_connect();
        $rows = false;
        $sql = "SELECT * FROM {$table}";
        if ($where) {
            $sql .= ' WHERE ' . self::getwhere($where);
        }
        if ($order) {
            //asc 升序
            //desc 降序
            $sql .= " ORDER BY {$order}";
        }
//        exit($sql);
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            mysqli_free_result($result);
        }
        mysqli_close($conn);
        if (!$rows) {
            return $rows;
        }
        return $rows;
    }


    //自定义列表索引

    /**
     * @param $table
     * @param $where
     * @param $index
     * @param string $order
     * @return array|bool
     */
    public static function cates($table, $where, $index, $order = '')
    {
        $lists = self::lists($table, $where, $order);
        if (!$lists) {
            return $lists;
        }
        $results = [];
        foreach ($lists as $key => $item) {
            $results[$item[$index]] = $item;
        }
        return $results;
    }

    /**
     * @param $table
     * @param $where
     * @return int
     */
    public static function totals($table, $where)
    {
        $conn = self::db_connect();
        $sql = "SELECT COUNT(*) as count FROM {$table}";
        if ($where) {
            $sql .= ' WHERE ' . self::getwhere($where);
        }
        $count = 0;
        if ($result = $conn->query($sql)) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
            mysqli_free_result($result);
        }
        mysqli_close($conn);
        return $count;
    }
    //分页

    /**
     * @param $table 表
     * @param $where 查询条件
     * @param $page  从第几条开始
     * @param $num 每页显示几条
     * @param string $order
     * @return array
     */
    public static function pagination($table, $where, $page, $num, $order = '')
    {
        $conn = self::db_connect();
        $count = self::totals($table, $where);
        /*$count = 0;
        $count_sql = "SELECT count(*) as count FROM {$table}";
        if ($where) {
            $count_sql .= " WHERE " . self::getwhere($where);
        }
//        exit($count_sql);
        if ($count_result = $conn->query($count_sql)) {
            $row = $count_result->fetch_assoc();
            $count = $row['count'];
        }*/
        $total_page = ceil($count / $num);//总页数
        $page = max(1, $page); // 处理$page,max(min,max) 返回最大数
        $offset = ($page - 1) * $num;// 每页的起始数
        // 拼接查询的SQL
        $sql = "SELECT * FROM {$table}";
        if ($where) {
            $sql .= ' WHERE ' . self::getwhere($where);
        }
        if ($order) {
            $sql .= " ORDER BY {$order}";
        }
        $sql .= " LIMIT {$offset} , {$num}";
        $rows = [];
        if ($result = $conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            mysqli_free_result($result);
        }
        mysqli_close($conn);
        return array('total' => $count, 'page' => $page, 'num' => $num, 'total_page' => $total_page, 'lists' => $rows);
    }

    /** 数据插入
     * @param $table
     * @param $data
     * @return array
     */
    public static function insert($table, $data)
    {
        $conn = self::db_connect();
        $filed = $value = [];
        foreach ($data as $key => $item) {
            $item = str_replace("'", '&apos;', $item);
            $item = str_replace('"', '&quot;', $item);
            $item = str_replace('<', '&lt;', $item);
            $item = str_replace('>', '&gt;', $item);
//            $item = gettype($item) == 'string' ? "'" . $item . "'" : $item;
            $filed[] = "`" . $key . "`";
            $value[] = "'" . $item . "'";
        }
        $sql = "INSERT INTO {$table} (" . implode(',', $filed) . ") VALUES (" . implode(',', $value) . ")";
        if ($conn->query($sql)) {
            return ['status' => 1, 'message' => '插入成功'];
        } else {
            return ['status' => 0, 'message' => '插入失敗'];
        }
       /* $conn->query($sql);
        return $conn->affected_rows==1?true:false;*/
    }

    /** 更新
     * @param $table
     * @param $data
     * @param array $where
     * @return array
     */
    public static function update($table, $data, $where = array())
    {
        $conn = self::db_connect();
        //處理字符串
        $str = '';
        foreach ($data as $key => $item) {
            $item = str_replace("'", '&apos;', $item);
            $item = str_replace('"', '&quot;', $item);
            $item = str_replace('<', '&lt;', $item);
            $item = str_replace('>', '&gt;', $item);
//            $item = gettype($item) === 'string' ? "'" . $item . "'" : $item;
            $str = "`".$key."`"."="."'".$item."'";
        }
        $sql = "UPDATE {$table} SET {$str}";
        if($where){
            $sql .=" WHERE ".self::getwhere($where);
        }
       /* if ($conn->query($sql)) {
            return ['status' => 1, 'message' => '更新成功'];
        } else {
            return ['status' => 0, 'message' => '更新失敗'];
        }*/
        $conn->query($sql);
        if(mysqli_affected_rows($conn)==1){
            $conn->close();
            return ['status' => 1, 'message' => '更新成功'];
        }else{
            $conn->close();
            return ['status' => 0, 'message' => '更新失敗,數據無變化'];
        }
    }



    /**    刪除
     * @param $table
     * @param $where
     * @return array
     */
    public static function delete($table, $where)
    {
        $conn = self::db_connect();
        $sql = "DELETE FROM {$table}";
        if($where){
            $sql .=" WHERE ".self::getwhere($where);
        }
        if($conn->affected_rows==1){
            $conn->close();
            return ['status' => 1, 'message' => '更新成功'];
        }else{
            $conn->close();
            return ['status' => 0, 'message' => '更新失敗,數據無變化'];
        }
    }

    //处理where条件

    /**
     * @param $params
     * @return string
     */
    private static function getwhere($params)
    {
        $_where = '';
        if (!$params) {
            return $_where;
        }
        foreach ($params as $key => $value) {
            $value = gettype($value) == 'string' ? "'" . $value . "'" : $value;
            if ($value) {
                $_where .= $key . '=' . $value . ' AND ';
            } else {
                $_where .= $key . 'AND ';
            }
        }
        //rtrim() 删除末尾空白字符（或指定字符）;
        $_where = rtrim($_where, 'AND ');
        return $_where;
    }

}


//链式操作类
class Sysdb
{

    /**
     * @param $table
     * @return $this
     */
    public function table($table)
    {
        $this->where = array();
        $this->data = array();
        $this->order = '';
        $this->table = $table;
        return $this;
    }

    /**
     * @param $where
     * @return $this
     */
    public function where($where)
    {
        $this->where = $where;
        return $this;
    }

    /**
     * @param $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param $order
     * @return $this
     */
    public function order($order)
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return array
     */
    public function insert()
    {
        $insert = Db::insert($this->table, $this->data);
        return $insert;
    }

    /**
     * @return array|bool
     */
    public function lists()
    {
        $lists = Db::lists($this->table, $this->where, $this->order);
        return $lists;
    }

    public function item()
    {
        $item = Db::item($this->table, $this->where);
        return $item;
    }
}