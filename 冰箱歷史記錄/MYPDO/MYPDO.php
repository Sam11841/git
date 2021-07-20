<?php
class MYPDO extends PDO{
private $dbname="";
private $username = "";
private $password = "";
private $encode="utf8";

    function __construct($username,$password,$dbname){
        
        $this->dbname=$dbname;
        $this->username=$username;
        $this->password=$password;

        try{
            //驅動器的名稱 mysql
            parent::__construct("mysql:host=localhost;dbname=".$this->dbname.";",$this->username,$this->password);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->setEncode();
        }catch (PDOException $e){
            print_r($e->getMessage());
        };
    } 
    private function setEncode(){
        $this->query("SET NAMES '{$this->encode}'");
    }
   
}

/*
setAttribute（）這一行是強制性的，它會告訴 PDO 禁用模擬預處理語句，並使用 real parepared statements 。
這可以確保SQL語句和相應的值在傳遞到mysql伺服器之前是不會被PHP解析的（禁止了所有可能的惡意SQL隱碼攻擊）。

查詢多條記錄
$sql='select * from t_teacher';
$pdo->prepare($sql);準備sql語句
$stmt=$pdo->prepare($sql);

execute():執行預處理語句
$res=$stmt->execute();
var_dump($res); //會返回bool(true)

查資料使用
fetch():得到結果集中的一條記錄(作為索引+關聯陣列)
if($res){
    while ($row=$stmt->fetch()){
        print_r($row);
        echo '<hr/>';
    }
}

fetchAll() 查詢所有記錄，以二維陣列（索引+關聯方式）
$rows=$stmt->fetchAll(PDO::FETCH_ASSOC); key欄位 value值
print_r($rows);

*/
?>