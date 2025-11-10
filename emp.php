<html>
    <form action="#" method="post">
        <input type="text" placeholder="employee Id" name="eid"><br><br>
        <input type="text" placeholder="employee Name" name="ename"><br><br>
        <input type="text" placeholder="employee Department" name="dept"><br><br>
        <input type="text" placeholder="employee Salary" name="sal"><br><br>
        <input type="submit">

    </form>
</html>

<?php

$servername="localhost";
$username="root";
$password="";
$dbname="empdb";
$table="emp_register";

$conn=mysqli_connect($servername,$username,$password,$dbname);

if(!$conn)
{
    die("connection failed".mysqli_connect_error());
}
else
{
   echo"<h2 align=center>Succusfully Connected</h2>";
}

// This checks how the form data was sent to the server.
// When a form uses method="POST", the data is sent through the HTTP POST method.
// $_SERVER["REQUEST_METHOD"] stores the request type used to access the page.
// So, this 'if' condition runs only when the form is submitted via POST.
if($_SERVER["REQUEST_METHOD"]=="POST")
{

// $id=$_POST['eid']  eid ->  is input name attributs value
    $id=$_POST['eid'];  
    $ename=$_POST['ename'];
    $dept=$_POST['dept'];
    $sal=$_POST['sal'];


    //emp_register (emp_id, emp_name, emp_dept, emp_sal) "emp_id, emp_name, emp_dept, emp_sal"-> db table colume name
    $Iquery = "INSERT INTO emp_register (emp_id, emp_name, emp_dept, emp_sal) 
           VALUES ('$id', '$ename', '$dept', '$sal')";


    $res=mysqli_query($conn,$Iquery);

    if($res)
    {
    echo"<h5 align=center>Data are successfully inserted</h5>";
    }
    else{
    echo"ERROR";
       } 

    //   show dtata in table manner
    
    $Ssql="SELECT*FROM emp_register";
    $res=mysqli_query($conn,$Ssql);
    
    if(mysqli_num_rows($res)>0)
    {
    echo"<table border=2 align=center>";
    echo"<tr><th>Employee ID</th>";
    echo"<th>Employee Name</th>";
    echo"<th>Department</th>";
    echo"<th>Salary</th></tr>";

    while($row=mysqli_fetch_assoc($res))
    {
        // table colume name ->$row[emp_id]
        echo"<tr><td>$row[emp_id]</td>";
        echo"<td>$row[emp_name]</td>";
        echo"<td>$row[emp_dept]</td>";
        echo"<td>$row[emp_sal]</td></tr>";
    }
    echo"</table>";
    }
    else{
        echo"0 Data!...";
    }
}
mysqli_close($conn)
?>