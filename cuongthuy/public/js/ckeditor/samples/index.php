<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Replace Textarea by Code</title>
    
   <!-- (1): Khai báo s? d?ng thu vi?n CKEditor -->
   <script src="../ckeditor.js"></script>
    
</head>
<body>
   <h2>Replace Textarea Elements Using JavaScript Code</h2>
    
   <form action="" method="post">
    
       <!-- (2): textarea s? du?c thay th? b?i CKEditor -->
       <textarea id="editor1" name="editor1" cols="80" rows="10">
           <p>Hello <strong>CKEditor</strong></p>
       </textarea>
        
       <!-- (3): Code Javascript thay th? textarea có id='editor1' b?i CKEditor -->
       <script>
 
           CKEDITOR.replace( 'editor1' );
 
       </script>    
            
   </form>
</body>
</html>