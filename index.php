<?php
require_once ('controller/class.php');
$data = new Database('');

if (isset($_POST['detele_btn_confirm'])){  
    $data->delete_category();
}

if (isset($_POST['addCategory'])){  
    $data->insert_category();
}
if (isset($_POST['update_btn_confirm'])){  
    $data->update_category();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>My Blog - Home</title>
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
        <!-- Page header with logo and tagline-->
        <header class="py-5 bg-light border-bottom mb-4">
            <div class="container">
                <div class="text-center my-5">
                    <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                    <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
                </div>
            </div>
        </header>
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                <div class="col-lg-8">
                    <!-- Featured blog post-->
                    <div class="card mb-4">
                        <a href="#!"><img class="card-img-top" src="https://dummyimage.com/850x350/dee2e6/6c757d.jpg" alt="..." /></a>
                        <div class="card-body">
                            <?php
                                

                                $feature = $data->select_feature_post();
                                for ($a=0; $a<1; $a++){
                                        echo   
                                        '<div class="small text-muted">'. $feature[$a]['created'] .'</div>
                                        <h2 class="card-title">'. $feature[$a]['title'] .'</h2>
                                        <p class="card-text">'.nl2br($feature[$a]['descriptions']).'</p>
                                        <a class="btn btn-primary" href="article.php?articlepage='.$feature[$a]['id'].'">Read more →</a>';
                                }
                        ?>
                        </div>
                    </div>
                    <!-- Nested row for non-featured blog posts-->
                    
                     
                    <div class="row">
                        <?php 
                        for ($a=1; $a < count($feature); $a++){
                            
                            echo 
                            '<div class="col-lg-6">
                                <div class="card mb-4">
                                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg" alt="..." /></a>
                                    <div class="card-body"> 
                                        <div class="small text-muted">'.$feature[$a]['created'].'</div>
                                        <h2 class="card-title h4">'.$feature[$a]['title'].'</h2>
                                        <p class="card-text">'.nl2br($feature[$a]['descriptions']).'</p>
                                        <a class="btn btn-primary" href="article.php?articlepage='.$feature[$a]['id'].'">Read more →</a>
                                    </div>
                                </div>
                            </div>';

                        }
                        ?>
                        
                    
                        
                    </div>
                    
                        
                    
                    

                    
                    <!-- Pagination-->
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                            <li class="page-item"><a class="page-link" href="#!">2</a></li>
                            <li class="page-item"><a class="page-link" href="#!">3</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                            <li class="page-item"><a class="page-link" href="#!">15</a></li>
                            <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                        </ul>
                    </nav>
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
