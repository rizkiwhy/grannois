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
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ $data['subpage'] . ' ' . $data['page'] }}</h3>

                            <div class="card-tools">
                                <button onclick="goBack()" type="button" class="btn btn-tool">
                                    <i class="fas fa-chevron-circle-left"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('activity.update', ['activity' => $data['activity']->id]) }}"
                                method="post" class="form-horizontal" id="updateForm">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="kegiatan">Tipe Kegiatan</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="activityTypeId" name="activityTypeId"
                                                style="width: 100%;">
                                                <option value="{{ $data['activity']->activity_type_id }}" selected>
                                                    {{ $data['activity']->activityType->name }}</option>
                                                @foreach ($data['activityType']->except($data['activity']->activity_type_id) as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="exampleInputEmail1">Tahun Ajaran</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="schoolYear" name="schoolYear"
                                                style="width: 100%">
                                                <option value="{{ $data['activity']->school_year }}" selected>
                                                    {{ $data['activity']->school_year }}</option>
                                                @foreach (range($data['startYear'], $data['endYear']) as $tahun)
                                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group ">
                                        <label for="tanggalPenerbitan">Tanggal Mulai</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="date" name="startDate" class="form-control datetimepicker-input"
                                                id="startDate" data-target="#reservationdate"
                                                value="{{ $data['activity']->start_date }}" />
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 form-group ">
                                        <label for="tanggalPenerbitan">Tanggal Selesai</label>
                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="date" name="endDate" class="form-control datetimepicker-input"
                                                id="endDate" data-target="#reservationdate"
                                                value="{{ $data['activity']->end_date }}" />
                                            <div class="input-group-append" data-target="#reservationdate"
                                                data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{-- Footer --}}
                            <div class="form-group row">
                                <div class="col-sm-2 offset-sm-10">
                                    <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <script src="{{ asset('src/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('src/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script>
        $('#form-edit-title').validate({
            rules: {
                nama: {
                    required: true,
                },
                aktif: {
                    required: true,
                },
            },
            messages: {
                nama: {
                    required: "Silahkan masukkan nama title",
                },
                aktif: {
                    required: "Silahkan pilih status",
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

    </script>
@endsection
