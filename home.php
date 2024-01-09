<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@100&display=swap" rel="stylesheet">>
    <title>Document</title>
    <style>
        body{
            background-color: whitesmoke;
            font-family: 'Noto Sans Arabic', sans-serif;
        }
        #mother{
            width: 100%;
            font-size: 20px;
        }
        main{
            float: left;
            border: 1px solid gray;
            padding: 5px;
        }
        input{
            padding: 4px;
            border: 2px solid black;
            text-align: right;
            font-size: 20px;
            font-family: 'Noto Sans Arabic', sans-serif;
        }
        aside{
            text-align: center;
            width: 400px;
            float: right;
            border: 1px solid black;
            padding: 10px;
            font-size: 20px;
            background-color: silver;
            color: white;
        }
        #tbl{
            width: 890px;
            font-size: 20px;
        }
        #tbl th{
            background-color: silver;
            color: black;
            font-size: 20px;
            padding: 10px;
        }
        aside button{
            width: 190px;
            padding: 8px;
            margin-top: 10px;
            font-size: 17px;
            font-family: 'Noto Sans Arabic', sans-serif;
            font-weight: bold;
        }
    </style>
</head>
<body dir="rtl">
    <?php
    //Database connection
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'students';
    $con = mysqli_connect($host, $user, $pass, $db);
    $result = mysqli_query($con,'SELECT * FROM student');
    //Button variables
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name='';
    $address= '';
    if (isset($_POST['id'])) {
        $id = $_POST['id'];
    }
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }
    if (isset($_POST['address'])) {
        $address = $_POST['address'];
    }    
    $sqls = '';
    if(isset($_POST['add'])){
        $sqls = "INSERT INTO student VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sqls);
        mysqli_stmt_bind_param($stmt, 'iss', $id, $name, $address);
        mysqli_stmt_execute($stmt);
        header("location:home.php");
    }
    if(isset($_POST['del'])){
        $sqls = "DELETE FROM student WHERE id = ?";
        $stmt = mysqli_prepare($con, $sqls);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        header($_SERVER['PHP_SELF']);
    }
    ?>
    <div id='mother'>
        <form  method="post">
            <aside>
                <div id='div'>
                <img src="https://th.bing.com/th/id/OIP.CTsmIkEVMgmpguoOa7iR2gHaKq?rs=1&pid=ImgDetMain" alt="لوجو الموقع" width="100px">
                <h3>لوحة المدير</h3>
                <label>رقم الطالب</label><br>
                <input type="text" name="id" id='id'><br>
                <label>اسم الطالب</label><br>
                <input type="text" name="name"id='name'><br>
                <label>عنوان الطالب</label><br>
                <input type="text" name="address"id='address'><br><br>
                <button name="add">اضافة طالب</button>
                <button name="del"> حذف طالب</button>
                </div>
            </aside>
            <main>
                <table id="tbl">
                    <tr>
                        <th>رقم الطالب</th>
                        <th>اسم الطالب</th>
                        <th>عنوان الطالب</th>
                    </tr>
                    <?php
                        while($row = mysqli_fetch_array($result)){
                            echo"<tr>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['name']."</td>";
                            echo "<td>".$row['address']."</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
            </main>
        </form>
    </div>
</body>
</html>