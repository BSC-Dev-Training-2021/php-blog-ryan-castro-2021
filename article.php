<?php 
require_once ('controller/class.php');
$data = new Database('');

if($_GET['articlepage']){
    $article_data = $data->article_info();
    foreach($article_data as $article_info){
        $post_title = $article_info["title"];
        $post_content = $article_info["contents"];
        $post_datetime = $article_info["created"];
        $post_name = $article_info["name"];
    }
}
else
{
    header('Location: index.php'); 
}

if(isset($_POST['submit_comment'])){
    $data->insert_comment();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog Post - Start Bootstrap Template</title>
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/app.js"></script>
        <script src="bootstrap.bundle.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/font-awesome.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">My Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="post.php">Post</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><button type="button" class="btn float-right ml-1" data-toggle="modal" data-target="#categoriesModal">Categories</button></li>
                                <li><a class="dropdown-item" href="#">Users</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="messages.php"><i class="fa fa-envelope-o"></i></a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?php echo $post_title;?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2"><?php echo $post_datetime;?> by <?php echo $post_name;?></div>
                            <!-- Post categories-->
                            <?php
                            
                            $article_categories = $data->article_categories();
                            foreach($article_categories as $categories){
                            echo '<a class="badge bg-secondary text-decoration-none link-light" href="#!">'.$categories["name"].'</a> ';
                            }
                            ?>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                            <p class="fs-5 mb-4"><?php echo nl2br($post_content);?></p>

                            <h2 class="fw-bolder mb-4 mt-5">I have odd cosmic thoughts every day</h2>
                            <p class="fs-5 mb-4">For me, the most fascinating interface is Twitter. I have odd cosmic thoughts every day and I realized I could hold them to myself or share them with people who might be interested.</p>
                            <p class="fs-5 mb-4">Venus has a runaway greenhouse effect. I kind of want to know what happened there because we're twirling knobs here on Earth without knowing the consequences of it. Mars once had running water. It's bone dry today. Something bad happened there as well.</p>
                        </section>
                    </article>
                    <!-- Comments section-->
                    <section class="mb-5">
                        <div class="card bg-light">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form class="mb-4" method="post" action="article.php?articlepage=<?php echo $_GET['articlepage'];?>">
                                    <div>
                                        <textarea class="form-control mb-2" name="comment_txt" rows="3" placeholder="Join the discussion and leave a comment!"></textarea>
                                    </div>
                                    <div>
                                        <button type="submit" name="submit_comment" class="btn btn-primary">Post Comment</button>
                                    </div>
                                </form>
                                <?php 
                                // <!-- Comment with nested comments-->
                                // <div class="d-flex mb-4">
                                //     <!-- Parent comment -->
                                //     <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                //     <div class="ms-3">
                                //         <div class="fw-bold">Commenter Name</div>
                                //         If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                //         <!-- Child comment 1-->
                                //         <div class="d-flex mt-4">
                                //             <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                //             <div class="ms-3">
                                //                 <div class="fw-bold">Commenter Name</div>
                                //                 And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                //             </div>
                                //         </div>
                                //         <!-- Child comment 2-->
                                //         <div class="d-flex mt-4">
                                //             <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                //             <div class="ms-3">
                                //                 <div class="fw-bold">Commenter Name</div>
                                //                 When you put money directly to a problem, it makes a good headline.
                                //             </div>
                                //         </div>
                                //     </div>
                                // </div> 
                                ?>
                                <!-- Single comment-->
                                <?php
                                $my_comment = $data->select_comment();
                                for ($a=0; $a<count($my_comment); $a++ ){
                                    echo  
                                    '<div class="d-flex">
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">'.$my_comment[$a]['name'].'</div>
                                            <p>'.nl2br($my_comment[$a]['comment']).'</p>
                                        </div>
                                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <div class="input-group">
                                <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                                <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                            </div>
                        </div>
                    </div>
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">Web Design</a></li>
                                        <li><a href="#!">HTML</a></li>
                                        <li><a href="#!">Freebies</a></li>
                                    </ul>
                                </div>
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="#!">JavaScript</a></li>
                                        <li><a href="#!">CSS</a></li>
                                        <li><a href="#!">Tutorials</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                </div>
            </div>
        </div>

        <section>
            <div class="modal" id="categoriesModal" tabindex="-1" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content modal-dialog-centered">
                        <div class="modal-header">
                            <form class="row">
                                <h5 class="modal-title">Category Crud</h5>
                                <button type="button" id="addCategorybtn" class="btn btn-light">Add</button>
                                <button type="button" id="updateCategorybtn" class="btn btn-light">Update</button>
                                <button type="button" id="deleteCategorybtn" class="btn btn-light">Delete</button>
                            </form>
                        </div>
                        <div class="modal-body modal-dialog-scrollable">
                            
                            <form id="addCategoryForm" method="post">
                                <h5 class="modal-title">Add New Category</h5>
                                <input type="text" class="btn-light" name="addCategorytxt">
                                <input type="submit" class="btn btn-primary" value="Add" name="addCategory">
                            </form>

                            <form id="updateCategotyForm">
                            <h5 class="modal-title">Update Category</h5>
                            <ul class="list-group list-group-flush">
                                
                                <?php 
                            
                                $categories = $data->select_categories();
                                for ($a=0; $a < count($categories); $a++){                                                                                  
                                ?>    
                                <li class="list-group-item" class="">
                                    <button type="button" id="updatebtn"  update_name="<?php echo $categories[$a]["name"]; ?>" update_id="<?php echo $categories[$a]["id"];?>" class="btn btn-light fa fa-check float-right" data-toggle="modal" data-target="#updateConfirmModal" data-dismiss="modal"></button>
                                    <?php echo $categories[$a]["name"]; ?>
                                </li>
                                <?php 
                                }
                                ?>
                            </ul>
                            </form>

                            <form id="deleteCategotyForm">
                            <h5 class="modal-title">Delete Category</h5>
                            <ul class="list-group list-group-flush">
                                
                                <?php 
                        
                                for ($a=0; $a < count($categories); $a++){                                                                                  
                                ?>    
                                <li class="list-group-item" class="">
                                    <button type="button" id="deletebtn"  delete_name="<?php echo $categories[$a]["name"]; ?>" delete_id="<?php echo $categories[$a]["id"];?>" class="btn btn-light fa fa-trash-o float-right ml-1" data-toggle="modal" data-target="#deleteConfirmModal" data-dismiss="modal"></button>
                                    <?php echo $categories[$a]["name"]; ?>
                                </li>
                                <?php 
                                }
                                ?>
                            </ul>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section>
            <div class="modal" id="deleteConfirmModal" tabindex="-1" data-backdrop="static">
                <form method="POST" action="">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Delete Category?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this "<span id="delete_name_span"></span>" Category?</p>
                            </div>
                            <div class="modal-footer">
                                <input type="text" name="todo_id_txt" id="todo_id_txt" hidden>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="detele_btn_confirm" class="btn btn-primary">Delete</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <section>
            <div class="modal" id="updateConfirmModal" tabindex="-1" data-backdrop="static">
                <form method="POST" action="">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Category?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to Update this "<span id="update_name_span"></span>" Category?</p>
                                <input type="text" name="update_todo_name_txt" id="update_todo_name_txt" required>
                            </div>
                            <div class="modal-footer">
                                <input type="text" name="update_todo_id_txt" id="update_todo_id_txt" hidden>
                                <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="update_btn_confirm" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
