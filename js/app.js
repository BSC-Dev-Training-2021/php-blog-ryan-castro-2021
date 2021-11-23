$(document).ready(function() {
    $("#addCategoryForm").hide();
    $("#deleteCategotyForm").hide();
    $("#updateCategotyForm").hide();


        $(document).on("click","#addCategorybtn",function(){  
            $("#addCategoryForm").show();
            $("#deleteCategotyForm").hide();
            $("#updateCategotyForm").hide();
        })

        $(document).on("click","#deleteCategorybtn",function(){  
            $("#addCategoryForm").hide();
            $("#deleteCategotyForm").show();
            $("#updateCategotyForm").hide();
        })

        $(document).on("click","#updateCategorybtn",function(){  
            $("#addCategoryForm").hide();
            $("#deleteCategotyForm").hide();
            $("#updateCategotyForm").show();
        })

        



        
        $(document).on("click","#deletebtn",function(){
            
            var span = document.getElementById("delete_name_span");
            span.textContent = $(this).attr("delete_name");

            $("#todo_id_txt").val($(this).attr("delete_id"))          
            
        })

        $(document).on("click","#updatebtn",function(){
            
            var span = document.getElementById("update_name_span");
            span.textContent = $(this).attr("update_name");

            $("#update_todo_id_txt").val($(this).attr("update_id"))          
            $("#update_todo_name_txt").val($(this).attr("update_name"))
            
        })
    

        
});