<?php

include "header.php";
include "connection.php";
if (!isset($_SESSION["imam"])) {
  ?>
  <script type="text/javascript">
    window.location="../login.php";
  </script>
  <?php
}

mysqli_query($link, "UPDATE messages SET red = 'y1' WHERE dusername LIKE '$_SESSION[imam]'");

?>

        <!-- page content area main -->
        <div class="right_col" role="main">
            <div class="">
                <div class="page-title">
                    <div class="title_left">
                        <h3></h3>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="row" style="min-height:500px">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Answer Users</h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">



                <form name="form1" class="col-lg-12" action="message.php" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>
                                                <select class="form-control" name="dusername">
                                                    <?php
                                                    $res=mysqli_query($link, "SELECT * FROM user WHERE Type IN('Giver', 'Receiver')");
                                                    while ($row=mysqli_fetch_array($res)) {
                                                      ?><option value="<?php echo $row["User_Name"]; ?>">
                                                        <?php echo $row["User_Name"]; ?>
                                                      </option><?php  
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="title" placeholder="Title">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>message
                                            <textarea style="font-size: 30px;" name="message" class="form-control">
                                                
                                            </textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="submit" name="submit1" value="Send">
                                            </td>
                                        </tr>
                                    </table>
                                </form>

<table class="table table-bordered">
    <tr>
    <th>Messages</th>
    </tr>
</table> 
    </div>
       

                                <!-- /page content -->
        <?php
        $res=mysqli_query($link, "SELECT * FROM messages AS M JOIN user AS U ON U.ID = M.User_ID WHERE susername LIKE '$_SESSION[imam]' OR dusername LIKE '$_SESSION[imam]' ORDER BY M.ID DESC");

            while ($row=mysqli_fetch_array($res)) {

                $fullname = $row["First_Name"] . " " . $row["Last_Name"];
                                echo "<tr>";
                                echo "<td>"; echo "Name: "; echo $fullname; echo "</td><br>";
                                echo "<td>"; echo "Title: "; echo $row["title"]; echo "</td><br>";
                                echo "<td>"; echo "Message: "; echo $row["msg"]; echo "</td><br><br>";
                                echo "</tr>";
                                }
?>

        <?php

            if (isset($_POST["submit1"]))
            {

                
                $sql = mysqli_query($link, "INSERT INTO messages VALUES('', '$_SESSION[imam]', '$_POST[dusername]', '$_POST[title]', '$_POST[message]', 'n1', (SELECT ID FROM user WHERE User_Name LIKE '$_SESSION[imam]'))") or die(mysqli_error($link));
                
        if ($sql === TRUE) {
            echo "<script>window.alert('message send!')</script>"; 
        ?>
        <script type="text/javascript">
            window.location="message.php";
        </script>
        <?php  
                
        } else {
                echo "<script>window.alert('Something went wrong!')</script>";
              }
            }

            ?>



<?php

include "footer.php";

?>