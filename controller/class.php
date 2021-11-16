<?php
class Database {
    public $con;
    public $error;
    public $my_id;
    
    public function __construct($tableName){

        $this->tableName = $tableName;
        $this->con = mysqli_connect("localhost", "root", "", "blogdatabase");
        if(!$this->con)
        {
            echo 'Database Connection Error ' . mysqli_connect_error($this->con);
        }
    }

    public function insert ($table_name, $data){
        $string = "INSERT INTO $table_name (";
        $string .= implode(",", array_keys($data)) . ') VALUES (';
        $string .= "'" . implode("','", array_values($data)) . "')";
        if(mysqli_query($this->con, $string)) {
            return true;
        }
        else{
            echo mysqli_error($this->con);
        }
    }

    public function select($column_name, $table_name ,$where, $condition, $limit){
        $array = array();  
        $query = "SELECT ". $column_name ." FROM ".$table_name." ".$where." ". $condition." ".$limit;
        $result = mysqli_query($this->con, $query);
        while($row = mysqli_fetch_assoc($result))
        {
            $array[] = $row; 
        }
       return $array;
    }

    public function delete($table_name, $where) {
        
        $query = "DELETE FROM ".$table_name." WHERE ".$where;
        if(mysqli_query($this->con, $query)){
            return true;
        }
        else{
            echo 'Database Connection Error ' . mysqli_connect_error($this->con);
        }
    }

    
    public function update ($table_name, $fields, $where) {
        $query = '';
        $condition = '';
        foreach($fields as $key => $value) {  
            $query .= $key . "='".$value."', ";  
        }  

        $query = substr($query, 0, -2);  

        foreach($where as $key => $value) {
            $condition .= $key . "='".$value."' AND ";
        }  
        $condition = substr($condition, 0, -5);

        $query = "UPDATE ".$table_name." SET ".$query." WHERE ".$condition."";
        if(mysqli_query($this->con, $query)){
            return true;
        }
        else{
            echo 'Database Connection Error ' . mysqli_connect_error($this->con);
        }
    }


    // public function deletelist(){
    //     $data = new Database('todolist');
    //     if (empty($_GET['ID']) and empty($_GET['pagination']))
    //     {
    //         header("location:index.php"); 
    //     }

    //     if (!empty($_GET['ID'])){
    //         $id = intval($_GET['ID']);
    //         echo $id;

    //         if($data->delete($data->tableName, 'ID = '.$id))  
    //         {  
    //             header("location:index.php");  
    //         }  
    //     }
    // }

    // public function updatepagination(){
    //     $data = new Database('pagination');
    //     if(isset($_POST["savepagination"])) {  
    //         $update_data = array(  
    //             'Pagination' => $_POST['paginationtxt'],  
    //         );  
    //         $where_condition = array(  
    //             'ID' => intval($_GET['pagination'])
    //         );  
    //         if($data->update($data->tableName, $update_data, $where_condition))  
    //         {  
    //             header("location:completed.php");  
    //         }  
    //     }   
    // }

    // public function updatelist(){
    //     $data = new Database('todolist');
    //     $update_data = array(  
    //         'Status' => 'Completed',  
    //     );  
    //     $where_condition = array(  
    //         'ID' => intval($_GET['completed'])
    //     );  
    //     if($data->update($data->tableName, $update_data, $where_condition))  
    //     {  
    //         header("location:index.php");  
    //     }
    // }

    
    
    //user id and name
    public function select_user_info(){
        $data = new Database('users');
    
        $users_data = $data->select('*',$data->tableName,'WHERE id=1','',''); 

        foreach($users_data as $user){
            $_SESSION['$my_id'] = $user["id"];
            // $_SESSION['$my_name']= $user["name"]; 

        }
    }


    public function insert_post(){
        if(!empty($_POST['web_design_cbox']) OR !empty($_POST['html_cbox']) OR !empty($_POST['css_cbox']) OR !empty($_POST['tutorials_cbox']) OR !empty($_POST['freebies_cbox']) OR !empty($_POST['javascript_cbox'])){

            $data = new Database('blog_post');
            
            $array = explode("\n", $_POST["blog_content_txt"]);
            $content_array = array_unique($array);

            $array = explode("\n", $_POST["blog_description_txt"]);
            $desc_array = array_unique($array);

            $insert_data = array(
                'contents' => implode(',', $content_array),
                'title' => $_POST['blog_title_txt'],
                'descriptions' => implode(',', $desc_array),
                'created' => date('Y-m-d  H:i:s'),
                'created_by' => $_SESSION['$my_id']
            );

            if($data->insert($data->tableName , $insert_data)){
                $data = new Database('blog_post');
                $users_data = $data->select('id',$data->tableName,'ORDER BY id DESC','','LIMIT 1'); 

                foreach($users_data as $user){
                    $my_post_id = $user["id"];
                }
                
                //insert category
                $data = new Database('blog_post_categories');

                if(!empty($_POST['web_design_cbox'])) {
                    $insert_data = array(
                        'blog_post_id' => $my_post_id,
                        'category_id' => $_POST['web_design_cbox']
                    );
                    $data->insert($data->tableName , $insert_data);
                }

                if(!empty($_POST['html_cbox'])) {
                    $insert_data = array(
                        'blog_post_id' => $my_post_id,
                        'category_id' => $_POST['html_cbox']
                    );
                    $data->insert($data->tableName , $insert_data);
                }

                if(!empty($_POST['javascript_cbox'])) {
                    $insert_data = array(
                        'blog_post_id' => $my_post_id,
                        'category_id' => $_POST['javascript_cbox']
                    );
                    $data->insert($data->tableName , $insert_data);
                }

                if(!empty($_POST['css_cbox'])) {
                    $insert_data = array(
                        'blog_post_id' => $my_post_id,
                        'category_id' => $_POST['css_cbox']
                    );
                    $data->insert($data->tableName , $insert_data);
                }

                if(!empty($_POST['tutorials_cbox'])) {
                    $insert_data = array(
                        'blog_post_id' => $my_post_id,
                        'category_id' => $_POST['tutorials_cbox']
                    );
                    $data->insert($data->tableName , $insert_data);
                }

                if(!empty($_POST['freebies_cbox'])) {
                    $insert_data = array(
                        'blog_post_id' => $my_post_id,
                        'category_id' => $_POST['freebies_cbox']
                    );
                    $data->insert($data->tableName , $insert_data);
                }
                //end insert category
            }
            else
            {
                echo 'Database Connection Error ' . mysqli_connect_error($this->con);
            }  
        }
    }

    public function select_feature_post(){
        $data = new Database('blog_post');
        $column = "id, title, descriptions, created";
        $_SESSION['$post_data'] = $data->select($column,$data->tableName,'','ORDER BY created DESC','Limit 1'); 
    }


    public function article_info(){

        $data = new Database('blog_post');

        $column = "blog_post.contents, blog_post.title , blog_post.created, users.name ";

        $innerjoin = "INNER JOIN users ON blog_post.created_by = users.id";

        $where = "WHERE blog_post.id = ". intval($_GET['articlepage']);

        $_SESSION['$article_info'] = $data->select($column,$data->tableName,$innerjoin,$where,''); 
    }

    public function article_categories(){


        $data = new Database('blog_post_categories');

        $column = "category_types.name ";

        $innerjoin = "INNER JOIN category_types ON blog_post_categories.category_id = category_types.id ";

        $where = "WHERE blog_post_categories.blog_post_id = ". intval($_GET['articlepage']);

        $_SESSION['$article_categories'] = $data->select($column,$data->tableName,$innerjoin,$where,''); 
    }

} 

?>