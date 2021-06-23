
<!DOCTYPE html>
<html lang="en">

    <head>
        <?php $this->load->view('includes/header_links'); ?>

        <style>
            .form_control{
                border-radius: 0px;
                margin-bottom: 10px;
            }
        </style>
    </head>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Employees</h1>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4 form_control">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Search Here</h6>
                            </div>
                            <div class="box" style="padding: 23px">
                                <div class="filter_style"> 
                                    <!--<div class="box-header" style="padding-left: 10px"><h3 class="box-title">Filter</h3></div>-->
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <?php
                                                echo form_open_multipart('home/employees', array('autocomplete' => 'off'));
                                                $save = form_input(array('name' => 'search', 'id' => 'submit', 'class' => 'btn btn-primary form_control', 'type' => 'submit', 'value' => 'Search'));
                                                $clear = form_input(array('name' => 'clear', 'id' => 'clear', 'class' => 'btn btn-primary form_control color_style', 'type' => 'submit', 'value' => 'Clear'));
                                                ?>
                                                <div class="col-md-12 search_box row">

                                                    <div class="col-md-2 form-group" >
                                                        <label >Employee Code</label>
                                                        <?php
                                                        $val = "";
                                                        if($filter['employee_code']){
                                                            $val=$filter['employee_code'];
                                                        }
                                                        echo form_input(array('name' => 'employee_code', 'id' => 'employee_code', 'class' => 'form-control form_control', 'value' => $val));
                                                        ?>
                                                    </div>

                                                    <div class="col-md-2 form-group">
                                                        <label >Employee name</label>
                                                        <?php
                                                        $val = "";
                                                        if($filter['employee_name']){
                                                            $val=$filter['employee_name'];
                                                        }
                                                        echo form_input(array('name' => 'employee_name', 'id' => 'employee_name', 'class' => ' form-control form_control', 'value' => $val));
                                                        ?> 
                                                    </div>
                                                    <div class="col-md-2 form-group" >
                                                        <label >Department</label>
                                                        <?php
                                                        $val = "";
                                                        if($filter['department']){
                                                            $val=$filter['department'];
                                                        }
                                                        echo form_input(array('name' => 'department', 'id' => 'department', 'class' => 'form-control form_control', 'value' => $val));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-2 form-group" >
                                                        <label >Age</label>
                                                        <?php
                                                        $val = "";
                                                        if($filter['age']){
                                                            $val=$filter['age'];
                                                        }
                                                        echo form_input(array('name' => 'age', 'id' => 'age', 'class' => 'form-control form_control', 'value' => $val));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-2 form-group" >
                                                        <label >Experience</label>
                                                        <?php
                                                        $val = "";
                                                        if($filter['experience']){
                                                            $val=$filter['experience'];
                                                        }
                                                        echo form_input(array('name' => 'experience', 'id' => 'experience', 'class' => 'form-control form_control', 'value' => $val));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <?php
                                                        echo $save;
                                                        echo $clear;
                                                        ?>
                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                                    <!--<div class="col-md-6">-->
                                    <a  class="btn btn-primary form_control"  href="<?php echo base_url('index.php/home/employees/add'); ?>"> Add New</a>
                                    <!--</div>-->

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Employee Code</th>
                                                <th>Employee name</th>
                                                <th>Department</th>
                                                <th>Age</th>
                                                <th>Experience in Organization</th>
                                                <th>Date of Birth</th>
                                                <th>Date of Joining</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($employees) {
                                                foreach ($employees as $value) {
                                                    $dob = date('d-m-Y', strtotime($value->dob));
                                                    $doj = date('d-m-Y', strtotime($value->doj));
                                                    echo '<tr>
                                            <td>' . $value->employee_code . '</td>
                                            <td>' . $value->employee_name . '</td>
                                            <td>' . $value->department . '</td>
                                            <td>' . $value->age . '</td>
                                            <td>' . $value->experience . '</td>
                                            <td>' . $dob . '</td>
                                            <td>' . $doj . '</td>
                                        </tr>';
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>

                                    <div class="col-md-12 row" style="padding-right: 0px">
                                        <div class="col-md-6 nopadding" style="padding-left: 0px">Total Records: <?php echo $total_rows ?></div>
                                        <div class="col-md-6 nopadding" style="padding-right: 0px">
                                            <div style="float: right"> <?php echo $links; ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>



        <!-- Bootstrap core JavaScript-->
        <?php $this->load->view('includes/footer_links') ?>
        <script>
            $(document).ready(function () {
                $(function () {
                    $('#dob').datepicker({
                        format: 'dd-mm-yyyy',
                    });
                });
                $(function () {
                    $('#doj').datepicker({
                        format: 'dd-mm-yyyy',
                    });
                });
            });
        </script>
    </body>

</html>