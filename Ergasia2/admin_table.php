<?php
session_start();
require("scripts/db_function.php");
$con = mysqli_connect($host, $username, $password, $db_name);

if (!$con) {
    die("connection Error");
}


$result = display_data();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/admin_table.css">
    <title>Database Table</title>

</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header  d-flex justify-content-between align-items-center">
                <a href="add_admin.php" class="btn btn-warning">Add As Administrator</a>
                <h2 class="display-6 text-center w-100">Amorgos-rooms Database</h2>
                <a href="edit_profile.php" class="btn btn-info">Edit Profile</a><br>
                <h2><a href="index.php"><img src="./media/images/home-icon.svg" alt=""></a></h2>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-hover text-center">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr id="row-<?php echo $row['id']; ?>">
                                <td><?php echo $row['id']; ?></td>
                                <td class="username-cell" onclick="toggleDetails(<?php echo $row['id']; ?>)" style="cursor: pointer;"><?php echo $row['username']; ?></td>
                            </tr>
                            <tr id="details-<?php echo $row['id']; ?>" class="details-row">
                                <td colspan="2">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Password</td>
                                            <td><?php echo $row['passwd']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $row['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>First Name</td>
                                            <td><?php echo $row['fname']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Last Name</td>
                                            <td><?php echo $row['lname']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Business Name</td>
                                            <td><?php echo $row['bname']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tel</td>
                                            <td><?php echo $row['tel']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Actions</td>
                                            <td>
                                                <a href="scripts/accept_user.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Accept user</a>
                                                <a href="scripts/reject_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Reject user</a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </table>
            </div>
        </div>
    </div>
    <script>
        function toggleDetails(id) {
            var rows = document.querySelectorAll(".username-cell");
            rows.forEach(function(row) {
                row.classList.remove("highlighted");
            });

            var row = document.getElementById("details-" + id);
            var mainRow = document.querySelector("#row-" + id + " .username-cell");
            if (row.style.display === "none" || row.style.display === "") {
                row.style.display = "table-row";
                mainRow.classList.add("highlighted");
            } else {
                row.style.display = "none";
                mainRow.classList.remove("highlighted");
            }
        }
    </script>

</body>

</html>
