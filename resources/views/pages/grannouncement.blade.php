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
            var url = `http://grannois.herokuapp.com//api/graduation/${nis}`;
            var html = '';

            var mhs = $.ajax({
                url: url,
                method: "GET",
                success: function(response) {
                    function formatDate (input) {
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
                                    <h5>Selamat ${response.data.user.name}, anda lulus!</h5>
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
                                    <p style="text-align: center;">Nomor: 498/I02/SMKN 11 BDG/KM/2021</p><br>
                                    <p style="text-align: justify;">
                                    Kepala SMKN 11 Bandung sebagai Penanggung Jawab Penyelenggara Ujian Sekolah dan Ujian Nasional Tahun Pelajaran 2020/2021, berdasarkan peraturan Menteri Pendidikan dan Kebudayaan Republik Indonesia No. 3 tahun 2013, Prosedur Operasional Standar Penyelenggara Ujian Nasional Tahun Pelajaran 2020/2021 Badan Standar Nasional (BNSP) Nomor: 0022/P/BNSP/XI/2013 tanggal 30 November 2013 Serta hasil Rapat DInas Kepala Sekolah dengan Dewan Guru SMKN 11 Bandung pada tanggal 01 Mei 2021 pukul 09.00 WIB Tentang Keberhasilan kelas XII, dengan ini menyatakan bahwa:
                                    <table class="table table-sm table-borderless col-md-8 offset-md-2">
                                    <tbody>
                                    <tr>
                                    <td>Nama</td>
                                    <td class="text-uppercase">: ${response.data.user.name}</td>
                                    </tr>
                                    <tr>
                                    <td>Kompetensi Keahlian</td>
                                    <td>: ${response.data.competency_of_expertise.name}</td>
                                    </tr>
                                    <tr>
                                    <td>NIS</td>
                                    <td>: ${response.data.student_parent_number}</td>
                                    </tr>
                                    <tr>
                                    <td>NISN</td>
                                    <td>: ${response.data.national_student_parent_number}</td>
                                    </tr>
                                    </tbody>
                                    </table>
                                    <br>
                                    <table class="table table-bordered col-md-6 offset-md-3">
                                    <tbody>
                                    <tr>
                                    <td class="text-center">LULUS</td>
                                    <td class="text-center" style="text-decoration: line-through;">TIDAK LULUS</td>
                                    </tr>
                                    </tbody>
                                    </table><br>
                                    <p style="text-align: justify;">
                                    Dalam menempuh Ujian Sekolah dan Ujian Nasional Tahun Pelajaran ${response.data.graduation.activity.school_year}/${++response.data.graduation.activity.school_year}.
                                    </p>
                                    <table class="table table-sm table-borderless col-md-4 offset-md-8">
                                    <tbody>
                                    <tr>
                                    <td class="text-center">
                                    Bandung, ${formatDate(response.data.graduation.activity.announcement[0].publish_date)}<br>
                                    Kepala Sekolah<br>
                                    <br>
                                    <br>
                                    Febiannisa Utami, S.Kom<br>
                                    NIP 19980226 202104 2 0001<br>
                                    </td>
                                    </tr>
                                    </tbody>
                                    </table>
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
                    } else {
                        $('#report').empty();
                        html += `<div class="callout callout-danger">
                                    <h5>${response.message}!</h5>
                                    <p>
                                    &#8226; Tunggu pengumuman hasil kelulusan sesuai jadwal yang telah ditentukan (${response.publish_date})  <br>
                                    &#8226; Hubungi Staff Kurikulum jika terjadi permasalahan <br>
                                    </p>
                                    </div>`;
                        $('#report').append(html);
                    }
                },
                error: function(response) {
                    $('#report').empty();
                    html += `<div class="callout callout-danger">
                                <h5>Data siswa tidak ditemukan!</h5>
                                <p>
                                &#8226; Silahkan periksa kembali NIS yang dimasukkan <br>
                                &#8226; Hubungi Staff Kurikulum jika terjadi permasalahan <br>
                                </p>
                                </div>`;
                    $('#report').append(html);
                    // console.log(response)
                }
            });
        });

    </script>
@endsection
