<html>
    <body>
        <form method="post"enctype="multipart/form-data">
            <input type="file"name="a"placeholder="Chooe">
            <input type="submit"name="b"value="upload"/>
        </form>
    </body>
</html>
<?php
extract($_POST);
if(isset($b))
{
    $file=$_FILES['a'];
    
    $fileext=explode('.',$file['name']);
    $actext=strtolower(end($fileext));
    
    $allowed=array('jpg','jpeg','png','gif');
    
    if(in_array($actext,$allowed))
    {
        if($file['size']<=50000)
        {
            if($file['error']===0)
            {$newfilename=uniqid('',true).".".$actext;
                $dest='uploads/'.$newfilename;
                move_uploaded_file($file['tmp_name'],$dest);
                echo "moved successfully";}
            else
            {echo "upload error";}
        }
        else
        {echo "Size is Greater";}
    }
    else
    {echo "This is not a valid extension to upload";}
}
?>