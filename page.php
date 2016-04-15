<meta charset="utf-8">
<?php
    include 'db.php';
    class Page extends db
    {
        private $total;//all record
        private $pagesize = 100;//record for each line
        private $limit;
        private $page;//page number now
        private $pageMax;//max page number

        public function __construct($dsn,$password,$username,$tableName) { 
            db::__construct($dsn,$password,$username);

            $this->total = db::countLines($tableName);
            //echo $this->total;
            $pagesize = 100;//record for each line

            $this->pageMax = $this->total / $this->pagesize;
            $this->getPage();
        }

        public function getPage() {
            if (isset($_GET['page'])) {
                if ($_GET['page'] <= 0) {
                    $_GET['page'] = 1;
                } elseif ($_GET['page'] > $this->pageMax) {
                    $_GET['page'] = $this->pageMax;
                }    
            } else {
                $_GET['page'] = 1;
            }
            return $_GET['page'];
        }//get page number
        public function firstPage() {
            if ($_GET['page'] != 1) {
                echo '<a href="http://localhost/page.php?page=1"/>首页';
            }
        }
        public function lastPage() {
            if ($_GET['page'] != $this->pageMax) {
                echo '<a href="http://localhost/page.php?page='.$this->pageMax.'"/>尾页';
            }
        }
        public function prevPage() {
            if ($_GET['page'] != 1) {
                $this->page = $_GET['page'] - 1;
                echo '<a href="http://localhost/page.php?page='.$this->page.'"/>上一页';
            }
        }
        public function nextPage() {
            if ($_GET['page'] != $this->pageMax) { 
                $this->page = $_GET['page'] + 1;
                echo '<a href="http://localhost/page.php?page='.$this->page.'"/>下一页';
            }
        }
        public function showPage($tableName) {
            $startLine = ($_GET['page'] - 1) * $this->pagesize ;
            $showPage = "SELECT * FROM $tableName LIMIT $startLine,$this->pagesize";
            echo $showPage;
            $res = $this->dbh->query($showPage);
            $res->setFetchMode(PDO::FETCH_ASSOC);
            while($row=$res->fetch()){
                $rows[]=$row;
            }
            foreach ($rows as $row) {

              echo $row['id']." ";
              echo $row['page']." ";
              echo $row['content']."<br/>";
              }
          
        }
    }
    
    $dsn = "mysql:host=localhost;dbname=page";
    $password = '';
    $username = 'root';
    $tableName = 'page';
    $myPage = new Page($dsn,$password,$username,$tableName);
    $myPage->showPage('page');
    $myPage->firstPage();
    $myPage->prevPage();
    echo $_GET['page'];
    $myPage->nextPage();
    $myPage->lastPage();
