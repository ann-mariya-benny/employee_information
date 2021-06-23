
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
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Add Employee</h6>
                            </div>
                            <div class="card-body">
                                <?php
                                echo form_open_multipart('home/employees/save', array('autocomplete' => 'off', 'onsubmit' => 'return validate_form()'));

                                $save = form_input(array('name' => 'submit', 'id' => 'submit', 'class' => 'btn btn-primary form_control', 'type' => 'submit', 'value' => 'Save'));

                                $cancel = " <a href='" . site_url('home/employees') . "' class='btn  btn-primary form_control' style='background-color:#8c8c8c'>Cancel</a>";
                                ?>


                                <div class="col-md-12 row">
                                    <div class="form-group col-md-4" >
                                        <label>Employee name<sup class="Sup_style">*</sup></label>
                                        <?php echo form_input(array('name' => 'employee_name', 'id' => 'employee_name', 'class' => 'form-control form_control', 'value' => '')); ?>
                                    </div>

                                    <div class="form-group col-md-4" >
                                        <label>Department<sup class="Sup_style">*</sup></label>
                                        <?php echo form_input(array('name' => 'department', 'id' => 'department', 'class' => 'form-control form_control', 'value' => '')); ?>
                                    </div>

                                    <div class="form-group col-md-4" >
                                        <label>Age<sup class="Sup_style">*</sup></label>
                                        <?php echo form_input(array('name' => 'age', 'id' => 'age', 'class' => 'form-control form_control', 'value' => '')); ?>
                                    </div>
                                </div>

                                <div class="col-md-12 row">
                                    <div class="form-group col-md-4" >
                                        <label>Experience<sup class="Sup_style">*</sup></label>
                                        <?php echo form_input(array('name' => 'experience', 'id' => 'experience', 'class' => 'form-control form_control', 'value' => '')); ?>
                                    </div>

                                    <div class="form-group col-md-4" >
                                        <label>Date of Birth<sup class="Sup_style">*</sup></label>
                                        <?php echo form_input(array('name' => 'dob', 'id' => 'dob', 'class' => 'form-control form_control', 'value' => '')); ?>
                                    </div>

                                    <div class="form-group col-md-4" >
                                        <label>Date of Joining<sup class="Sup_style">*</sup></label>
                                        <?php echo form_input(array('name' => 'doj', 'id' => 'doj', 'class' => 'form-control form_control', 'value' => '')); ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-12">   
                                    <?php echo $save;
                                    echo $cancel ?>
                                </div>
<?php form_close(); ?>
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
                //                    CKEDITOR.replace('itinerary');
                new LiveValidation('employee_name').add(Validate.Presence);
                new LiveValidation('department').add(Validate.Presence);
                new LiveValidation('age').add(Validate.Presence);
                new LiveValidation('experience').add(Validate.Presence);
                new LiveValidation('dob').add(Validate.Presence);
                new LiveValidation('doj').add(Validate.Presence);

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