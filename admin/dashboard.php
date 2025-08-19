<?php
        session_start();
        include("header.php");
        include("connection.php");
?>
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<div style="text-align: center; font-weight:700; font-size: x-large; margin-bottom:20px;">
    Users in your page
</div>

<div class="container-fluid">
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead style="background-color: #2C2F33; color: white;">
                <tr>
                    <th>Sr No.</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // initialize counter
            $srno = 0;

            // fetch all users
            $res = mysqli_query($link, "SELECT * FROM user_registration ORDER BY id DESC");

            // loop through all users
            while ($row = mysqli_fetch_assoc($res)) {
                $srno++;
                echo "<tr>";
                echo "<td>" . $srno . "</td>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                echo "<td>
                        <a href='delete_user.php?id=" . $row['id'] . "' 
                           onclick=\"return confirm('Are you sure you want to remove this user?');\" 
                           class='btn btn-danger btn-sm'>
                           Remove
                        </a>
                      </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

</div><!-- /#right-panel -->

<?php
        include("footer.php");
?>
