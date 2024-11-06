<?php
session_start();
if (!$_SESSION['admin']) {
    header('Location: adminLogin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="../../style.css">
    <script src="https://cdn.lordicon.com/lordicon.js"></script>
    <!-- cdn for icons -->
    <script src="https://kit.fontawesome.com/d4532539ca.js" crossorigin="anonymous"></script>
    <!--    cdn sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!--chart js-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--    ajax cdn-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body style="background-color: #c8dae6" >
<div class="wrapper">
    <aside id="sidebar">
        <div class="d-flex">
            <button class="toggle-btn" type="button">
                <i class="lni lni-grid-alt"></i>
            </button>
            <div class="sidebar-logo mt-2">
                <a href="./dashboard.php">CDC</a>
                <h6 style="color:  #c8dae6">CHILD MANAGEMENT</h6>
            </div>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="./Dashboard.php" class="sidebar-link">
                    <i class="fa-solid fa-gauge"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="./StudentList.php" class="sidebar-link">
                    <i class="fa-solid fa-child"></i>
                    <span>Student Management</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="./Attendance.php" class="sidebar-link">
                    <i class="fa-regular fa-calendar-check"></i>
                    <span>Attendance</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="./parenList.php" class="sidebar-link">
                    <i class="fa-solid fa-person-breastfeeding"></i>
                    <span>Parent Management</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a href="./annoucement.php" class="sidebar-link">
                    <i class="fa-solid fa-bullhorn"></i>
                    <span>Announcement</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="./reqirementDash.php" class="sidebar-link">
                    <i class="fa-solid fa-file"></i>
                    <span>Requirements</span>
                </a>
            </li>

        </ul>
        <div class="sidebar-footer">
            <a href="#" class="sidebar-link">
                <i class="lni lni-exit"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>
    <div  style="background-color: #DDE8FO" class="p-3 container-fluid">
        <div class="container-fluid">
            <!-- fox boxes-->
            <div class="container-fluid row gap-3 p-3">
                <!-- card -->
                <div style="background-color:#018ABD" class="card  col-lg-3 text-light border-0">
                    <div class="card-body d-flex justify-content-around align-items-center ">
                        <div>
                            <h6 class="card-title fw-bold">PARENT</h6>
                            <?php
                            include_once '../Controller/studentConroller.php';
                            $controller = new \Controller\studentConroller();
                            $controller->countRegisterParents();
                            ?>
                        </div>
                        <i class="fa-solid fs-1 fa-person-breastfeeding"></i>
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        <a class="text-light"  href="./LowStacks_List.php" >View</a>
                    </div>
                </div>

                <!-- card -->
                <div  style="background-color:#018ABD" class="card  col-lg-3  text-light border-0">
                    <div class="card-body d-flex justify-content-around align-items-center ">
                        <div>
                            <h6 class="card-title fw-bold">ENROLLED</h6>
                            <?php
                             $controller = new \Controller\studentConroller();
                             $controller->DisplayEnrolledAndUnEnrolledStudent('Enrolled');
                            ?>
                        </div>
                        <i class="fa-solid fs-1 fa-children"></i>
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        <a class="text-light"  href="./LowStacks_List.php" >View</a>
                    </div>
                </div>

                <!-- card -->
                <div  style="background-color:#018ABD" class="card col-lg-3 text-light border-0">
                    <div class="card-body d-flex justify-content-around align-items-center ">
                        <div>
                            <h6 class="card-title fw-bold">ANNOUNCEMENT</h6>
                            <?php
                            include_once '../Controller/announcementController.php';
                            $con = new \Controller\announcementController();
                            $con->countAnnouncement();
                            ?>
                        </div>
                        <i class="fa-solid fs-1 fa-children"></i>
                    </div>
                    <div class="card-footer border-0 bg-transparent">
                        <a class="text-light"  href="./LowStacks_List.php" >View</a>
                    </div>
                </div>
            </div>
        </div>
<!--  contents-->
     <div class="card p-3">
         <div class="col-lg-4">
             <h >STUDENT ANALYTICS</h>
             <canvas id="myChart"></canvas>
         </div>
     </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
<script>
    // dashboard event
    const hamBurger = document.querySelector(".toggle-btn");
    hamBurger.addEventListener("click", function () {
        document.querySelector("#sidebar").classList.toggle("expand");
    });


    $.ajax({
        url: '../../Controller/studentConroller.php',
        type: "post",
        data:{action: 'displayChart'},
        dataType: 'json',
        success: function (data){
          const Label = data.map(row => row.Status);
          const Data = data.map(row => row.total)

            const ctx = document.getElementById('myChart');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: Label,
                    datasets: [{
                        label: 'Student',
                        data: Data,
                        borderWidth: 6
                    }]
                },
                devicePixelRatio: 6,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },

                }
            });

        }

    })


</script>

</body>

</html>