<?php
$con=mysqli_connect("localhost","root","","newform");
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $q3="select * from data where id=$id";
    $r3=mysqli_query($con,$q3);
    $d1=mysqli_fetch_assoc($r3);
}
if(isset($_GET['did']))
{
    $did=$_GET['did'];
    $q5="delete from data where id=$did";
    $r5=mysqli_query($con,$q5);
    if($r5)
    {
        header('location:index.php');
    }
}
?>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <form action="" method="post">
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
                    <td colspan="2"align="right"><input type="submit"id="c"/></td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
$q2="select * from data";
$r2=mysqli_query($con,$q2);
?>
<table border="1px"align="center">
    <tr>
        <th>S.No</th>
        <th>Name</th>
        <th>Email</th>
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
        <td><a href="index.php?id=<?php echo $data['id'];?>">Edit</a></td>
        <td><a href="index.php?did=<?php echo $data['id'];?>">Delete</a></td>
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
extract($_POST);
if(isset($c))
{
    $q1="insert into data (name,email) values ('$a','$b')";
    $r1=mysqli_query($con,$q1);
    if($r1){header('location:index.php');}
}
if(isset($d))
{
    $q4="update data set name='$a',email='$b' where id=$id";
 if(mysqli_query($con,$q4))
 {
     header('location:index.php');
 }
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
/*if(isset($_GET['id'])) 
        {?>
<script type="text/javascript">
$(document).ready(function(){
    $('#c').attr({value:"Submit",name:"c"});
//alert(window.location);});</script><?php
        }
    else{?>
    <script type="text/javascript">
$(document).ready(function(){
        $('#c').attr({value:"Update",name:"d"});});   </script>
    <?php}*/?>