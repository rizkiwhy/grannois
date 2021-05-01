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
                        data-target="#modalCreate" data-backdrop="static">
                        <i class="fas fa-plus mr-2"></i>Tambah
                    </button>
                </div>
                <div class="modal fade" id="modalCreate">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah {{ $data['page'] }}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('graduation.store') }}" method="post" class="form-horizontal"
                                    id="storeForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label for="kegiatan">Kegiatan</label>
                                            <div class="input-group">
                                                <select class="form-control select2" id="activityId" name="activityId"
                                                    style="width: 100%;">
                                                    <option value="" disabled selected>Pilih Kegiatan</option>
                                                    @foreach ($data['activity'] as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->note }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label for="kegiatan">Siswa</label>
                                            <div class="input-group">
                                                <select class="form-control select2" id="studentId" name="studentId"
                                                    style="width: 100%;">
                                                    <option value="" disabled selected>Pilih Siswa</option>
                                                    @foreach ($data['student'] as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->user->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label for="kegiatan">Status</label>
                                            <div class="input-group">
                                                <select class="form-control select2" id="status" name="status"
                                                    style="width: 100%;">
                                                    <option value="" disabled selected>Pilih Status</option>
                                                    <option value="1">
                                                        Lulus
                                                    </option>
                                                    <option value="2">
                                                        Tidak Lulus
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input class="form-control" type="file" id="certificate" name="certificate">
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fas fa-upload"></i></span>
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
                                            <th class="text-center">Jenis Kegiatan</th>
                                            <th class="text-center">Siswa</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Sertifikat</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data['graduation'] as $item)
                                            <tr>
                                                <td class="text-center">{{ $i }}</td>
                                                <td>
                                                    {{ $item->activity->note }}
                                                </td>
                                                <td>{{ $item->student->user->name }}</td>
                                                <td>
                                                    @if ($item->status)
                                                        Lulus
                                                    @else
                                                        Tidak Lulus
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ asset('certificate/') . '/' . $item->certificate }}"
                                                        target="_blank" aria-disabled="true">
                                                        {{ $item->certificate }}
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('graduation.edit', ['graduation' => $item->id]) }}"
                                                        data-bs-toggle="tooltip" title="Ubah"><i
                                                            class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
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
                                            <th class="text-center">Jenis Kegiatan</th>
                                            <th class="text-center">Siswa</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Sertifikat</th>
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

                            <h4 class="modal-title">Delete {{ $data['page'] }}
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form action="#" method="post" class="form-horizontal" id="deleteForm">
                                @method('delete')
                                @csrf
                                Apakah anda yakin akan menghapus Kelulusan <span name="textStudent" id="textStudent"></span>?
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
                $('#textStudent').text(arr.student.user.name)
                $('#deleteForm').attr('action', `graduation/${arr.id}`)
            }

        </script>
    @endsection
