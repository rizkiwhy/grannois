<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="/src/dist/img/11.png" />

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $data['page'] }} | {{ $data['app'] }} Information System</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('src/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('src/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('src/plugins/toastr/toastr.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('src/dist/css/adminlte.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('src/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>



<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('src/dist/img/11.png') }}" alt="User Avatar" class="img-size-50"><br>
            {{-- <a href="../../index2.html"><b>Assek</b>APP</a> --}}
            <b>Granno</b>IS
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login.action') }}" method="post" id="form-login">
                    @csrf
                    <label for="exampleInputEmail1">Email address</label>
                    <div class="input-group form-group">
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <label for="exampleInputPassword1">Password</label>
                    <div class="input-group form-group">
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Enter Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-8">
                            {{-- <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div> --}}
                            <p class="mb-1">
                                <a href="#" data-toggle="modal" data-target="#modal-sm" data-backdrop="static">I forgot
                                    my password</a>
                            </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                {{-- <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div> --}}
                <!-- /.social-auth-links -->

                {{-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> --}}
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('src/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('src/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('src/plugins/toastr/toastr.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('src/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->

    @if (Session::has('error_message'))
        <script>
            toastr.error('{!! Session::get('error_message') !!}', {
                "progressBar": true,
            })

        </script>
    @endif

    <script>
        $(function() {
            $('#form-login').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                },
                messages: {
                    email: {
                        required: "Silahkan masukkan alamat email",
                        email: "Silahkan masukkan alamat email yang valid"
                    },
                    password: {
                        required: "Silahkan masukkan password",
                        minlength: "Password harus terdiri dari minimal 5 karakter"
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });

    </script>


    <div class="modal fade" id="modal-sm">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">User Credentials</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>admin@gais.com</td>
                                <td>gais123
                                </td>
                                <td>administrator</td>
                            </tr>
                            <tr>
                                <td>currstaff@gais.com</td>
                                <td>gais123
                                </td>
                                <td>curriculum staff</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
</body>

</html>
<!-- DataTables  & Plugins -->
<script src="{{ asset('src/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('src/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('src/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('src/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('src/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('src/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });

    /* To Disable Inspect Element */
    $(document).bind("contextmenu",function(e) {
        e.preventDefault();
    });

    $(document).keydown(function(e){
        if(e.which === 123){
        return false;
        }
    });

    document.onkeydown = function(e) {
        if(event.keyCode == 123) {
            return false;
        }
        if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.keyCode == 'S'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.keyCode == 'H'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.keyCode == 'A'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.keyCode == 'F'.charCodeAt(0)){
            return false;
        }
        if(e.ctrlKey && e.keyCode == 'E'.charCodeAt(0)){
            return false;
        }
    }
</script>
