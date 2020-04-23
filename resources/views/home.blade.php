<?php
// session_start();
// use CodeIgniter\View
?>
@include('layout.header')
@include('layout.navbar')


<div class="container-fluid">
    <div class="row">

        <?php


        ?>
        @include('layout.sidebar')


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-4 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h1 class="h2">Add Data Form</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">

                    </div>
                </div>
            </div>
            <div role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">

                <div class="row">



                    <form class="col-md-9 needs-validation" id="formAjax" novalidate>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @if($message=Session::get('success'))
                        <div class="alert alert-success">

                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Notification: </strong> {{ $message }} <br><br> <strong>Data Insert Successfully</strong>
                        </div>
                        @endif
                        @error('name')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Notification for Name: </strong> {{ $message }} <strong>Data not insert</strong>
                        </div>

                        @enderror
                        @error('email')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Notification for Email: </strong> {{ $message }} <strong>Data not insert</strong>
                        </div>

                        @enderror
                        @error('pincode')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <strong>Notification for Pincode: </strong> {{ $message }} <strong>Data not insert</strong>
                        </div>

                        @enderror
                        <div id="dataDIV"></div>

                        @csrf
                        <div class="form-row">
                            <div class="col">
                                <label for="name">Name</label>
                                <div id="checkName"></div>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>

                                <div class="valid-feedback">
                                    <!-- <div id="checkName1"></div> -->
                                    <!-- <div class="nameClass"></div> -->
                                    Box is Field
                                </div>
                                <div class="invalid-feedback">
                                    <!-- <div id="checkName2"></div> -->
                                    <!-- <div class="nameClass"></div> -->
                                    Please provide a Name.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                        </div>
                        <div class="form-row mt-2">
                            <div class="col">
                                <label for="email">Email Id</label>
                                <div id="checkEmail"></div>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email ID" required>
                                <div class="valid-feedback">
                                    <!-- <div id="checkEmail"></div> -->
                                    Box is Field

                                </div>
                                <div class="invalid-feedback">
                                    <!-- <div id="checkEmail"></div> -->
                                    Please provide a Email.
                                </div>
                            </div>
                            <!-- <div class="col-md-5 mb-3">
                                <label for="validationCustom03">Mobile No.</label>
                                <input type="number" class="form-control" min="1000000000" max="9999999999" onKeyPress="if(this.value.length==10) return false;" id="validationCustom03" name="mobile" placeholder="Mobile No." required>
                                <div class="valid-feedback">
                                                                        Box is Field

                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Mobile No of 10 Digit.
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom04">Date of Birth</label>
                                <input type="date" class="form-control" id="validationCustom04" name="dob" placeholder="Date of Birth" required>
                                <div class="valid-feedback">
                                                                        Box is Field

                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Date of Birth.
                                </div>
                            </div> -->
                            <div class="col-md-5 mb-3">
                                <label for="pincode">Pin Code</label>
                                <div id="checkPincode"></div>
                                <input type="number" class="form-control" min="100000" max="999999" onKeyPress="if(this.value.length==6) return false;" id="pincode" name="pincode" placeholder="Pin Code" required>
                                <div class="valid-feedback">
                                    Box is Field
                                    <!-- <div id="checkPincode"></div> -->

                                </div>
                                <div class="invalid-feedback">
                                    Please provide a valid Pin Code of 6 Digit.
                                    <!-- <div id="checkPincode"></div> -->

                                </div>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Agree to terms and conditions
                                </label>
                                <div class="invalid-feedback">
                                    You must agree before submitting.
                                </div>
                            </div>
                        </div>-->
                        <!-- <button class="btn btn-primary" type="button" id="resetBTN">Reset form</button><br><br> -->
                        <button class="btn btn-primary" type="submit" id='ajaxBtn'>Submit form</button>
                    </form>


                </div>
            </div>


    </div>
</div>
@include('layout.footer')
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#name').bind('input', function() {
        var name = $('#name').val();
        // $('#formAjax')[0].reset();
        $.post("api/checkName", {
                name: name
            },
            function(data) {
                // console.log(data);
                if (data.message.status == 0) {
                    var divele = '<div class="mb-0" style="padding-bottom: 6px;width: 100%;color: #dc3545;">'
                    for (var key in data.message.name) {
                        divele += '<span style="margin-bottom: 5px;">' + data.message.name[key] + '</span>';
                    }
                    divele += '</div>';
                    $('#checkName').html(divele);
                }
                if (data.message.status == 1) {
                    var divele1 = '<div class="mb-0" style="padding-bottom: 6px;width: 100%;color: #28a745;">'
                    for (var key in data.message.name) {
                        divele1 += '<span style="margin-bottom: 5px;">' + data.message.name[key] + '</span>';
                    }
                    divele1 += '</div>';
                    $('#checkName').html(divele1);
                    $('#checkName1').html(divele1);
                    $('#checkName2').html(divele1);
                }
            }
        );
    });
    $('#email').bind('input', function() {
        var email = $('#email').val();

        // $('#formAjax')[0].reset();
        $.post("api/checkEmail", {
                email: email
            },
            function(data) {
                console.log(data);
                if (data.message.status == 0) {
                    var divele = '<div class="mb-0" style="padding-bottom: 6px;width: 100%;color: #dc3545;">'
                    for (var key in data.message.name) {
                        divele += '<span style="margin-bottom: 5px;">' + data.message.name[key] + '</span>';
                    }
                    divele += '</div>';
                    $('#checkEmail').html(divele);
                }
                if (data.message.status == 1) {
                    var divele1 = '<div class="mb-0" style="padding-bottom: 6px;width: 100%;color: #28a745;">'
                    for (var key in data.message.name) {
                        divele1 += '<span style="margin-bottom: 5px;">' + data.message.name[key] + '</span>';
                    }
                    divele1 += '</div>';
                    $('#checkEmail').html(divele1);
                }
            }
        );
    });
    $('#pincode').bind('input', function() {
        var pincode = $('#pincode').val();

        // $('#formAjax')[0].reset();
        $.post("api/checkPincode", {
                pincode: pincode
            },
            function(data) {
                console.log(data);
                if (data.message.status == 0) {
                    var divele = '<div class="mb-0" style="padding-bottom: 6px;width: 100%;color: #dc3545;">'
                    for (var key in data.message.name) {
                        divele += '<span style="margin-bottom: 5px;">' + data.message.name[key] + '</span>';
                    }
                    divele += '</div>';
                    $('#checkPincode').html(divele);
                }
                if (data.message.status == 1) {
                    var divele1 = '<div class="mb-0" style="padding-bottom: 6px;width: 100%;color: #28a745;">'
                    for (var key in data.message.name) {
                        divele1 += '<span style="margin-bottom: 5px;">' + data.message.name[key] + '</span>';
                    }
                    divele1 += '</div>';
                    $('#checkPincode').html(divele1);
                }
            }
        );
    });



    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    // alert($('#validationCustom03').length);
                    if ((form.checkValidity() === false)) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                    if ((form.checkValidity() === true)) {
                        var name = $('#name').val();
                        var email = $('#email').val();
                        var pincode = $('#pincode').val();
                        $.ajax({
                            type: "POST",
                            url: "api/save",
                            data: {
                                name: name,
                                email: email,
                                pincode: pincode
                            },
                            success: function(data) {
                                // var jsonVar = $.parseJSON(data);
                                console.log(data.message);
                                console.log(data.message.Status);
                                if (data.message.Status == 0) {
                                    var txtHtml = '<div class="alert alert-danger" id="alertDID">';
                                    txtHtml += '<h5 class="alert-heading">Error</h5>';
                                    txtHtml += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                    for (var key in data.message.Error.ValidError) {
                                        // alert(data.message.Error.ValidError[key]);
                                        txtHtml += '<strong>Notification for ' + key.toUpperCase() + ': </strong> ' + data.message.Error.ValidError[key] + ' <strong> .</strong><br>';
                                        // console.log(data.message.Error.ValidError[key]);
                                    }
                                    txtHtml += '<br><strong>Notification for DATABASE: </strong> Data Not Insert';
                                    txtHtml += '<br><strong>Notification for Mail: </strong> Mail not Send';

                                    txtHtml += '</div>'

                                    $('#dataDIV').html(txtHtml);
                                    $('#alertDID').fadeOut(5999);
                                    // $('#formAjax')[0].reset();
                                    // form.classList.add('was-validated');
                                    // break;

                                }
                                if (data.message.Status == 1) {
                                    var txtHTML = '<div class="alert alert-success" id="alertDID">';
                                    txtHTML += '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                                    txtHTML += '<strong>Notification: </strong>' + name + ' You Recive a mail to: ' + email + ' from Across the Global (ATG).  <br><br> <strong>Data Insert Successfully</strong>';
                                    txtHTML += '</div>';
                                    $('#dataDIV').html(txtHTML);
                                    // $('#alertDID').fadeOut(5999);
                                }
                            }

                        });
                        event.preventDefault();
                    }
                    // break;
                }, false);
            });
        }, false);
    })();
</script>

<!-- </div> -->


<?php

// include(APPPATH. 'ViewAPPPATH. sViews/footer.blade.php');

?>