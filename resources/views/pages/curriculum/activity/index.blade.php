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
                    {{-- @if (Auth::user()->role_id === 1)
                        <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                            href="{{ route('admin.alat-kerja.pengajuan.indexpribadi') }}">
                        @elseif(Auth::user()->role_id === 2)
                            <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                                href="{{ route('user.alat-kerja.pengajuan.indexpribadi') }}">
                            @else
                                <a class="btn btn-primary btn-sm mr-2 float-sm-right"
                                    href="{{ route('management.alat-kerja.pengajuan.indexpribadi') }}">
                    @endif
                    <i class="fas fa-bell mr-2"></i>Pengajuan
                    </a> --}}
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
                                                <td class="text-center">{{ $i }}</td>
                                                <td>{{ $item->activityType->name }}</td>
                                                <td>{{ $item->school_year . ' / ' . ++$item->school_year }}</td>
                                                <td>{{ $item->start_date }}</td>
                                                <td>{{ $item->end_date }}</td>
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
        </section>
    @endsection
