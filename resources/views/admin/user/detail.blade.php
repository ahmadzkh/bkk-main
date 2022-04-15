<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Main | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../../../assets/css/style.css">
    <style>
        .title-page h1.fw-bold {
            margin-bottom: 60px;
        }
        
        .swal-modal {
            border-radius: 15px;
        }
        /* STYLING DETAIL WRAPPER */
        
        .detail-outer-wrapper .header {
            border-radius: 15px 15px 0px 0px;
            height: 150px;
            background-image: linear-gradient(to right, #2e51d1, #9cb0f0);
        }
        
        .detail-outer-wrapper .content .prestasi div.img div {
            width: 100px;
            height: 100px;
            background-color: rgb(165, 163, 163);
        }
        
        .detail-outer-wrapper .content div.tools div {
            width: 30px;
            height: 30px;
            color: #fff;
        }
        
        .detail-outer-wrapper .content div.tools div:nth-child(1) {
            background: rgb(242, 180, 46);
        }
        
        .detail-outer-wrapper .content div.tools div:nth-child(2) {
            background: rgb(242, 42, 42);
        }
    </style>
</head>

<body>
    <div class="main-page">
        <div class="shadow navbar-wrapper mr-5">
            <div class="py-2">
                <a class="text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="#">
                    <i class='bx bx-home-alt align-middle text-center d-block'></i>
                    <span>Home</span>
                </a>
                <a class="text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="#">
                    <i class='bx bx-grid-alt align-middle text-center d-block'></i>
                    <span>Dashboard</span>
                </a>
                <a class="text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="#">
                    <i class='bx bx-book-reader align-middle text-center d-block'></i>
                    <span>Alumni</span>
                </a>
                <a class="nav-active text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="#">
                    <i class='bx bx-user-circle align-middle text-center d-block'></i>
                    <span>User</span>
                </a>
                <a class="text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="#">
                    <i class='bx bx-news align-middle text-center d-block'></i>
                    <span>News</span>
                </a>
                <a class="text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="#">
                    <i class='bx bx-briefcase-alt-2 align-middle text-center d-block'></i>
                    <span>Job</span>
                </a>
                <a class="text-decoration-none text-black navbar-item text-center d-block py-2 my-2" href="#">
                    <i class='bx bx-building-house align-middle text-center d-block'></i>
                    <span>Company</span>
                </a>
                <div class="navbar-logout text-center d-block py-3">
                    <div class="btn btn-primary">
                        <i class='bx bx-log-out-circle align-middle text-center d-block'></i>
                        <span>Logout</span>
                    </div>
                </div>
            </div>
        </div>

        <img src="../../../assets/img/wave2.svg" class="position-absolute waves">

        <div class="container py-3 content-wrapper">
            <div class="title-back">
                <a href="#" class="d-flex align-items-center text-decoration-none text-white"><i class='bx bx-left-arrow-alt'></i>Back</a>
            </div>
            <div class="title-page text-white my-5">
                <h1 class="fw-light">Detail</h1>
                <h1 class="fw-bold">Alumni</h1>
            </div>

            <div class="detail-outer-wrapper shadow-custom-2 rounded-20">
                <div class="header">
                </div>
                <div class="content py-3 px-5">
                    <div class="mb-4 d-flex justify-content-between">
                        <h2 class="fw-900">tysonngo</h2>
                        <div class="tools d-flex">
                            <div class="rounded-15 d-flex justify-content-center align-items-center me-1">
                                <a href="#" class="text-white"><i class='bx bxs-edit'></i></a>
                            </div>
                            <div class="rounded-15 d-flex justify-content-center align-items-center">
                                <a href="#" class="text-white"><i class='bx bxs-trash-alt'></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-4">
                            <h5 class="fw-bold mb-1">NIS</h5>
                            <p>192010382</p>
                        </div>
                        <div class="col-4">
                            <h5 class="fw-bold mb-1">Email</h5>
                            <p>tysonngo@mail.com</p>
                        </div>
                        <div class="col-4">
                            <h5 class="fw-bold mb-1">Level</h5>
                            <p>Alumni</p>
                        </div>
                        <!-- <div class="blue-line rounded-20 w-50"></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>