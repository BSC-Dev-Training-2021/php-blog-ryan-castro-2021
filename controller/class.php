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
        $arrays = array();  
        $query = "SELECT ". $column_name ." FROM ".$table_name." ".$where." ". $condition." ".$limit;
        $result = mysqli_query($this->con, $query);
        while($row = mysqli_fetch_assoc($result))
        {
             $arrays[] = $row; 
            
        }
       return $arrays;
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
    
        return $data->select('*',$data->tableName,'WHERE id=1','','',''); 

        // foreach($users_data as $user){
        //     $_SESSION['$my_id'] = $user["id"];
        //     // $_SESSION['$my_name']= $user["name"]; 

        // }

    }

    public function select_categories(){
        $data = new Database('category_types');
    
        return $data->select('*',$data->tableName,'','','',''); 

    }


    public function insert_post(){
            $data = new Database('blog_post');
        
            $user_info = $data->select_user_info();

            $insert_data = array(
                'contents' => $_POST["blog_content_txt"],
                'title' => $_POST['blog_title_txt'],
                'descriptions' => $_POST["blog_description_txt"],
                'created' => date('Y-m-d  H:i:s'),
                'created_by' => $user_info[0]['id']
            );

            if($data->insert($data->tableName , $insert_data)){
                $data = new Database('blog_post');
                $post_info = $data->select('id',$data->tableName,'ORDER BY id DESC','','LIMIT 1',''); 

                $my_post_id = $post_info[0]["id"];

                $data = new Database('blog_post_categories');
                
                for ($a=0; $a<count($_POST['categories']); $a++){
                    $insert_data = array(
                        'category_id' => $_POST['categories'][$a],
                        'blog_post_id' => $my_post_id
                    );
                    $data->insert($data->tableName , $insert_data);
                }
            }
            else
            {
                echo 'Database Connection Error ' . mysqli_connect_error($this->con);
            }  
    }

    public function select_feature_post(){
        $data = new Database('blog_post');
        $column = "id, title, descriptions, created";

        return $data->select($column,$data->tableName,'','ORDER BY created DESC','Limit 5',''); 
    }


    public function article_info(){

        $data = new Database('blog_post');

        $column = "blog_post.contents, blog_post.title , blog_post.created, users.name ";

        $innerjoin = "INNER JOIN users ON blog_post.created_by = users.id";

        $where = "WHERE blog_post.id = ". intval($_GET['articlepage']);

        return $data->select($column,$data->tableName,$innerjoin,$where,'',''); 
    }

    public function article_categories(){

        $data = new Database('blog_post_categories');

        $column = "category_types.name ";

        $innerjoin = "INNER JOIN category_types ON blog_post_categories.category_id = category_types.id ";

        $where = "WHERE blog_post_categories.blog_post_id = ". intval($_GET['articlepage']);

        return $data->select($column,$data->tableName,$innerjoin,$where,'',''); 
    }

    public function select_comment(){

        $data = new Database('blog_post_comment');

        $column = "blog_post_comment.comment , users.name ";

        $innerjoin = "inner join users on blog_post_comment.user_id = users.id INNER join blog_post on blog_post_comment.blog_post_id = blog_post.id ";

        $where = "where blog_post.id = ". intval($_GET['articlepage']);

        $orderby = "ORDER BY blog_post_comment.id DESC";

        return $data->select($column,$data->tableName,$innerjoin,$where,$orderby,''); 
    }

    public function insert_comment(){
        $data = new Database('blog_post_comment');
                      
            $user_info = $data->select_user_info();

            $insert_data = array(
                'comment' => $_POST["comment_txt"],
                'user_id' => $user_info[0]['id'],
                'blog_post_id' => intval($_GET['articlepage']),
                'created' => date('Y-m-d  H:i:s')
            );

        $data->insert($data->tableName , $insert_data);
    }

} 

?>