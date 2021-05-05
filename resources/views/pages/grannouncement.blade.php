@extends($data['layout'])
@section('title', $data['page'] . ' | ' . $data['app'])
@section('content-header')
    {{-- <meta http-equiv="refresh" content="5"> --}}
    <!-- Content Header (Page header) -->
    <div class="content-header mt-5">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> <small>{{ $data['greetingWord'] }}</small> {{ $data['school'] }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ $data['page'] }}</a></li>
                        {{-- <li class="breadcrumb-item active">{{ $data['subpage'] }}</li> --}}
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection
@section('main-content')

    <!-- Main content -->
    <div class="content">
        <div class="container">
            {{-- <div class="container-fluid"> --}}
            {{-- <h2 class="text-center display-4">Search</h2> --}}

            {{-- </div> --}}
            <div class="row">
                <div class="col-lg-8">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Card title</h5> --}}
                            <div class="row">
                                <label for="nis" class="col-sm-4 col-form-label">Nomor Induk Siswa (NIS)</label>
                                <div class="col-md-8">
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="search" class="form-control form-control-md"
                                                placeholder="Masukkan Nomor Induk Siswa (NIS)" name="nis" id="nis">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-md btn-default">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            {{-- <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a> --}}
                        </div>
                    </div><!-- /.card -->
                    <div id="report">

                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="position-relative p-3 bg-gray mb-3" style="width: 100%">
                        <div class="ribbon-wrapper">
                            <div class="ribbon bg-primary">
                                Notes
                            </div>
                        </div>
                        {{-- <p class="card-text">
                            &#8226; Grannois adalah sistem informasi yang mengumumkan hasil kelulusan seluruh siswa
                            SMKN 11
                            BANDUNG.<br>
                            &#8226; Silahkan masukkan Nomor Induk Siswa (NIS), maka hasil kelulusan akan
                            ditampilkan.<br>
                            &#8226; Hasil kelulusan dapat diunduh dalam bentuk file dengan format PDF.
                        </p> --}}
                        {{-- Ribbon Default <br /> --}}
                        <small>&#8226; Grannois adalah sistem informasi yang mengumumkan hasil kelulusan seluruh siswa
                            SMKN 11
                            BANDUNG.<br>
                            &#8226; Silahkan masukkan Nomor Induk Siswa (NIS), maka hasil kelulusan akan
                            ditampilkan.<br>
                            &#8226; Hasil kelulusan dapat diunduh dalam bentuk file dengan format PDF.<br>
                        </small>
                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $('#nis').on('input', function(event) {
            event.preventDefault();
            var nis = $(this).val();
            // var url = `http://localhost:8000/api/graduation/${nis}`;
            var url = `http://grannois.herokuapp.com/api/graduation/${nis}`;
            var html = '';

            if (nis.length === 9) {
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function(response) {
                        console.log(response)

                        function formatDate(input) {
                            var datePart = input.match(/\d+/g),
                                year = datePart[0]
                            month = datePart[1]
                            day = datePart[2];

                            return `${day}-${month}-${year}`
                        }
                        // console.log(response)
                        if (response.status == 'success') {
                            $('#report').empty();
                            html += `<div class="callout callout-success">
                                        <h5>${response.graduationMessage}</h5>
                                        <p>Anda dinyatakan lulus dalam menempuh Ujian Sekolah dan Ujian Nasional Tahun Pelajaran ${response.data.graduation.activity.school_year}/${++response.data.graduation.activity.school_year}.
                                        <a href="#" class="text-blue" data-toggle="modal" data-target="#modal-lg" data-backdrop="static">
                                        <u>Klik disini untuk informasi lebih lanjut</u>
                                        </a>
                                        </p>
                                        </div>
                                        <div class="modal fade" id="modal-lg">
                                        <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title" style="text-align: center;">Surat Pemberitahuan Kelulusan</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="px-3">
                                        ${response.data.graduation.activity.announcement[0].content}
                                        </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                        <p class="text-white">.</p>
                                        <div class="col-md-4 offset-md-8">
                                        <a class="btn btn-primary btn-flat float-sm-right mx-1" href="{{ asset('certificate/${response.data.graduation.certificate}') }}" target="_blank" aria-disabled="true">
                                        Lihat
                                        </a>
                                        <a class="btn btn-primary btn-flat float-sm-right mx-1" href="{{ asset('certificate/${response.data.graduation.certificate}') }}" download>
                                        Unduh
                                        </a>
                                        <p class="text-white">.</p>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>`;
                            $('#report').append(html);
                            $('#letterNumber').text(`: ${response.data.graduation.activity.announcement[0].letter_number}`)
                            $('#studentName').text(`: ${response.data.user.name}`)
                            $('#competencyOfExpertiseName').text(`: ${response.data.competency_of_expertise.name}`)
                            $('#studentParentNumber').text(`: ${response.data.student_parent_number}`)
                            $('#nationalStudentParentNumber').text(`: ${response.data.national_student_parent_number}`)
                            $('#schoolYear').text(`${response.data.graduation.activity.school_year}/${++response.data.graduation.activity.school_year}`)
                            $('#publishDate').text(`${formatDate(response.data.graduation.activity.announcement[0].publish_date)}`);
                        } else {
                            $('#report').empty();
                            html += `<div class="callout callout-danger">
                                        <h5>${response.message}!</h5>
                                        <p>
                                        &#8226; Tunggu pengumuman hasil kelulusan sesuai jadwal yang telah ditentukan (${formatDate(response.publish_date)})  <br>
                                        &#8226; Hubungi Staff Kurikulum jika terjadi permasalahan <br>
                                        </p>
                                        </div>`;
                            $('#report').append(html);
                        }
                    },
                    error: function(response) {
                        $('#report').empty();
                        html += `<div class="callout callout-danger">
                                    <h5>${response.responseJSON.message}!</h5>
                                    <p>
                                    &#8226; Silahkan periksa kembali NIS yang dimasukkan <br>
                                    &#8226; Hubungi Staff Kurikulum jika terjadi permasalahan <br>
                                    </p>
                                    </div>`;
                        $('#report').append(html);
                    }
                });
            } else {
                $('#report').empty();
            }
        });

    </script>
@endsection
