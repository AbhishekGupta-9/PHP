<?php
$con=new mysqli("localhost","root","","newform");
if(isset($_GET['id']))
{
$id=$_GET['id'];
    $q3="select * from data where id=$id";
    $r3=$con->query($q3);
    $d1=$r3->fetch_assoc();}
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <form action="" method="post"enctype="multipart/form-data">
            <table border="1px"align="center">
                <tr>
                    <td>Name:</td>
                    <td><input type="text"name="a" placeholder="Enter Name"value="<?php if(isset($_GET['id'])){echo $d1['name'];}?>"/></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="email"name="b" placeholder="Enter Email"value="<?php if(isset($_GET['id'])){echo $d1['email'];}?>"/></td>
                </tr>
                <tr>
                    <td>File:</td>
                    <td><input type="file"name="e" placeholder="Choose File"required/><span><?php if(isset($_GET['id'])){echo $d1['img'];}?></span></td>
                </tr>
                <tr>
                    <td colspan="2"align="right"><input type="submit"id="c"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
extract($_POST);
class Inser
{
    public function upload($a,$b,$e)
    {
        $file=$_FILES['e'];
        $nm=$file['name'];
    $fileext=explode('.',$file['name']);
    $actext=strtolower(end($fileext));
    
    $allowed=array('jpg','jpeg','png','gif');
    
    if(in_array($actext,$allowed))
    {
        if($file['size']<=50000)
        {
            if($file['error']===0)
            {$newfilename=uniqid('',true).".".$actext;
                $dest=$newfilename;
                move_uploaded_file($file['tmp_name'],$dest);
                if(!isset($_GET['id'])){$this->insert($a,$b,$nm,$newfilename);}
             else{$this->update($a,$b,$nm,$newfilename);}
            }
            else
            {echo "upload error";}
        }
        else
        {echo "Size is Greater";}
    }
    else
    {echo "This is not a valid extension to upload";}
    }
    public function insert($a,$b,$nm,$newfilename)
    {$con=new mysqli("localhost","root","","newform");
        $q1="insert into data (name,email,img,convimgname) values ('$a','$b','$nm','$newfilename')";
                if($con->query($q1))
                {header('location:function.php');}
    }
    public function update($a,$b,$nm,$newfilename)
    {$con=new mysqli("localhost","root","","newform");
        $id=$_GET['id'];
           $q4="update data set name='$a',email='$b',img='$nm',convimgname='$newfilename' where id=$id";
 if($con->query($q4))
 {
     header('location:function.php');
 }
    }
    public function delete($did)
    {$con=new mysqli("localhost","root","","newform");
      //$did=$_GET['did'];
    $q5="delete from data where id=$did";
    if($con->query($q5))
    {
        header('location:function.php');
    }  
    }
}
?>
<?php
$q2="select * from data";
$r2=mysqli_query($con,$q2);
?>
<table border="1px"align="center">
    <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Email</th>
        <th>Image Name</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php $i=1;
    $count=mysqli_num_rows($r2);
    if($count>0)
    {
    while($data=mysqli_fetch_assoc($r2))
    {
        ?>
    <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $data['name'];?></td>
        <td><?php echo $data['email'];?></td>
        <td><?php echo $data['img'];?></td>
        <td><a href="function.php?id=<?php echo $data['id'];?>">Edit</a></td>
        <td><a href="function.php?did=<?php echo $data['id'];?>">Delete</a></td>
    </tr>
    <?php
    $i++;}}
    else{
        ?>
    <tr>
        <td colspan="5">No data found in Database</td>
    </tr>
    <?php
    }
    ?>
</table>
<?php
$obj=new inser();
if(isset($c)||isset($d))
{
    $obj->upload($a,$b,$e);
}
if(isset($_GET['did']))
{
    $obj->delete($_GET['did']);
}
?>
<?php 
if(!isset($_GET['id']))
{
    ?>
<script type="text/javascript">
$('#c').attr({value:"Submit",name:"c"});
</script>
<?php
}
else
{?>
<script type="text/javascript">
$('#c').attr({value:"Update",name:"d"});
</script>
<?php
}
?>