@extends($data['layout'])
@section('title', $data['page'] . ' | ' . $data['app'])
@section('content-header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $data['page'] }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">{{ $data['page'] }}</a></li>
                        <li class="breadcrumb-item active">{{ $data['subpage'] }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <button class="btn btn-primary btn-sm mr-2 float-sm-right" data-toggle="modal"
                        data-target="#createModal" data-backdrop="static">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>
                    <button class="btn btn-primary btn-sm mr-2 float-sm-right" data-toggle="modal"
                        data-target="#importModal" data-backdrop="static">
                        <i class="fas fa-file-import mr-2"></i>Import
                    </button>
                </div>
                <div class="modal fade" id="createModal">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah {{ $data['page'] }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('student.store') }}" method="post" class="form-horizontal"
                                    id="createForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label for="nama">Nama</label>
                                            <div class="input-group">
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Masukkan Nama">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label for="email">Email</label>
                                            <div class="input-group">
                                                <input type="email" name="email" class="form-control" id="email"
                                                    placeholder="Masukkan Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password" class="form-control" id="password"
                                                    placeholder="Masukkan Password">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="konfirmasiPassword">Konfirmasi Password</label>
                                            <div class="input-group">
                                                <input type="password" name="password_confirmation" class="form-control"
                                                    id="password_confirmation" placeholder="Konfirmasi Password">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="role">Role</label>
                                            <div class="input-group">
                                                <select class="form-control select2" id="roleId" name="roleId"
                                                    style="width: 100%">
                                                    <option value="{{ $data['role']->id }}" selected>
                                                        {{ $data['role']->name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="status">Status</label>
                                            <div class="input-group">
                                                <select class="form-control select2" id="active" name="active"
                                                    style="width: 100%">
                                                    <option value="" disabled selected>Pilih Status</option>
                                                    <option value="1">Aktif</option>
                                                    <option value="2">Tidak Aktif</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="tempatLahir">Tempat Lahir</label>
                                            <div class="input-group">
                                                <input type="text" name="placeOfBirth" class="form-control"
                                                    id="placeOfBirth" placeholder="Masukkan Tempat Lahir">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group ">
                                            <label for="tanggalLahir">Tanggal Lahir</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="dateOfBirth"
                                                    class="form-control datetimepicker-input" id="dateOfBirth"
                                                    data-target="#reservationdate" />
                                                <div class="input-group-append" data-target="#reservationdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label for="kompetensiKeahlian">Kompetensi Keahlian</label>
                                            <div class="input-group">
                                                <select class="form-control select2" id="competencyOfExpertiseId"
                                                    name="competencyOfExpertiseId" style="width: 100%;">
                                                    <option value="" disabled selected>Pilih Kompetensi Keahlian</option>
                                                    @foreach ($data['competencyOfExpertise'] as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 form-group">
                                            <label for="nis">NIS</label>
                                            <div class="input-group">
                                                <input type="text" name="studentParentNumber" class="form-control"
                                                    id="studentParentNumber" placeholder="Masukkan NIS">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label for="nisn">NISN</label>
                                            <div class="input-group">
                                                <input type="text" name="nationalStudentParentNumber" class="form-control"
                                                    id="nationalStudentParentNumber" placeholder="Masukkan NISN">
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <div class="modal fade" id="importModal">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Import {{ $data['page'] }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('student.import') }}" method="post" class="form-horizontal"
                                    id="importForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="position-relative p-3 bg-gray mb-3" style="width: 100%">
                                        <div class="ribbon-wrapper">
                                            <div class="ribbon bg-primary">
                                                Notes
                                            </div>
                                        </div>
                                        <small>
                                            <ul>
                                                <li>Data Siswa dapat diimport menggunakan file dengan format excel (.xlsx).
                                                </li>
                                                <li>Silahkan ubah data file berikut (<a
                                                        href="{{ asset('import/data_student.xlsx') }}" download>example
                                                        data
                                                        siswa</a>), agar meminimalisir kesalahan
                                                    pada saat import data siswa.</li>
                                                <li>Dilarang untuk mengubah nama kolom (table header).</li>
                                                <li>Id, Nama & Email harus unik (tidak boleh duplikat).</li>
                                                <li>Hubungi Staff Kurikulum jika terjadi permasalahan.</li>
                                            </ul>
                                        </small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File Upload</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input class="form-control" type="file" id="studentData" name="studentData">
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-upload"></i></span>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
    @endsection
    @section('main-content')
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Data {{ $data['page'] }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Tempat Lahir</th>
                                            <th class="text-center">Tanggal Lahir</th>
                                            <th class="text-center">NIS</th>
                                            <th class="text-center">NISN</th>
                                            <th class="text-center">Kompetensi Keahlian</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data['student'] as $item)
                                            <tr>
                                                <td class="text-center">{{ $i }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>
                                                    @if ($item->place_of_birth)
                                                        {{ $item->place_of_birth }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->date_of_birth)
                                                        {{ $item->date_of_birth }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->student_parent_number)
                                                        {{ $item->student_parent_number }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->national_student_parent_number)
                                                        {{ $item->national_student_parent_number }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->competency_of_expertise_id)
                                                        {{ $item->competencyOfExpertise->name }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('student.edit', ['student' => $item->id]) }}"
                                                        data-bs-toggle="tooltip" title="Ubah"><i
                                                            class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm delete" data-toggle="modal"
                                                        onclick="deleteItem({{ $item }})"
                                                        data-target="#deleteModal" data-backdrop="static"
                                                        data-bs-toggle="tooltip" title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Tempat Lahir</th>
                                            <th class="text-center">Tanggal Lahir</th>
                                            <th class="text-center">NIS</th>
                                            <th class="text-center">NISN</th>
                                            <th class="text-center">Kompetensi Keahlian</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal">
                <div class="modal-dialog modal-dialog-centered modal-md">
                    <div class="modal-content">
                        <div class="modal-header">

                            <h4 class="modal-title">Hapus {{ $data['page'] }}
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="#" method="post" class="form-horizontal" id="deleteForm">
                                @method('delete')
                                @csrf
                                Apakah anda yakin akan menghapus siswa <span name="textName" id="textName"></span>?
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </section>
        <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
        <script type="text/javascript">
            function deleteItem(arr) {
                // console.log(arr)
                $('#textName').text(arr.user.name)
                $('#deleteForm').attr('action', `student/${arr.id}`)
            }

        </script>
    @endsection
