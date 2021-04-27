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
                                <form action="{{ route('announcement.store') }}" method="post" class="form-horizontal"
                                    id="storeForm">
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
                                                            {{ $item->activityType->name . ' ' . $item->school_year . ' / ' . ++$item->school_year }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-group ">
                                            <label for="tanggalPenerbitan">Tanggal Penerbitan</label>
                                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                <input type="date" name="publishDate" class="form-control datetimepicker-input"
                                                    id="publishDate" data-target="#reservationdate" />
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
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Jenis Kegiatan</th>
                                            <th class="text-center">Tanggal Penerbitan</th>
                                            <th class="text-center">Penerbit</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($data['announcement'] as $item)
                                            <tr>
                                                <td class="text-center">{{ $i }}</td>
                                                <td>{{ $item->activity->activityType->name . ' ' . $item->activity->school_year . ' / ' . ++$item->activity->school_year }}
                                                </td>
                                                <td>{{ $item->publish_date }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td></td>
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
                                            <th class="text-center">Tanggal Penerbitan</th>
                                            <th class="text-center">Penerbit</th>
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
        </section>
    @endsection
