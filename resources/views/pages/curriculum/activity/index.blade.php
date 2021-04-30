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
                                <form action="{{ route('activity.store') }}" method="post" class="form-horizontal"
                                    id="storeForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-7 form-group">
                                            <label for="kegiatan">Tipe Kegiatan</label>
                                            <div class="input-group">
                                                <select class="form-control select2" id="activityTypeId"
                                                    name="activityTypeId" style="width: 100%;">
                                                    <option value="" disabled selected>Pilih Tipe Kegiatan</option>
                                                    @foreach ($data['activityType'] as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 form-group">
                                            <label for="exampleInputEmail1">Tahun Ajaran</label>
                                            <div class="input-group">
                                                <select class="form-control select2" id="schoolYear" name="schoolYear"
                                                    style="width: 100%">
                                                    <option value="" disabled selected>Pilih Tahun Ajaran</option>
                                                    @foreach (range($data['startYear'], $data['endYear']) as $tahun)
                                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 form-group ">
                                            <label for="tanggalPenerbitan">Tanggal Mulai</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="startDate"
                                                    class="form-control datetimepicker-input" id="startDate"
                                                    data-target="#reservationdate" />
                                                <div class="input-group-append" data-target="#reservationdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group ">
                                            <label for="tanggalPenerbitan">Tanggal Selesai</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="endDate" class="form-control datetimepicker-input"
                                                    id="endDate" data-target="#reservationdate" />
                                                <div class="input-group-append" data-target="#reservationdate"
                                                    data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
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
                                <table id="dataTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Jenis Kegiatan</th>
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Tanggal Mulai</th>
                                            <th class="text-center">Tanggal Selesai</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data['activity'] as $item)
                                            <tr>
                                                <td class="text-center">{{ $item->id }}</td>
                                                <td>{{ $item->activityType->name }}</td>
                                                <td>{{ $item->school_year . ' / ' . ++$item->school_year }}</td>
                                                <td>{{ $item->start_date }}</td>
                                                <td>{{ $item->end_date }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ route('activity.edit', ['activity' => $item->id]) }}"
                                                        data-bs-toggle="tooltip" title="Ubah"><i
                                                            class="fas fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm delete" data-toggle="modal"
                                                        onclick="deleteItem({{ $item }})"
                                                        data-target="#modalDelete" data-backdrop="static"
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
                                            <th class="text-center">Tahun Ajaran</th>
                                            <th class="text-center">Tanggal Mulai</th>
                                            <th class="text-center">Tanggal Selesai</th>
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
            <div class="modal fade" id="modalDelete">
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
                                {{-- <input type="hidden" name="deleteId" id="deleteId" value="" /> --}}
                                <input type="hidden" name="deleteNote" id="deleteNote" value="" />
                                Apakah anda yakin akan menghapus Kegiatan <span name="textNote" id="textNote"></span>?
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
                $('#textNote').text(arr.note)
                $('#deleteForm').attr('action', `activity/${arr.id}`)
            }
        </script>
    @endsection
