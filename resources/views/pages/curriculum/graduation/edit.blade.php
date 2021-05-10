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
                            <form action="{{ route('graduation.update', ['graduation' => $data['graduation']->id]) }}"
                                method="post" class="form-horizontal" id="updateForm">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="kegiatan">Kegiatan</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="activityId" name="activityId"
                                                style="width: 100%;">
                                                <option value="{{ $data['graduation']->activity_id }}" selected>
                                                    {{ $data['graduation']->activity->note }}</option>
                                                @foreach ($data['activity']->except($data['graduation']->activity_id) as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->note }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <label for="kegiatan">Siswa</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="studentId" name="studentId"
                                                style="width: 100%;">
                                                <option value="{{ $data['graduation']->student_id }}" selected>
                                                    {{ $data['graduation']->student->user->name }}</option>
                                                @foreach ($data['student']->except($data['graduation']->student_id) as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->user->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="kegiatan">Status</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="status" name="status"
                                                style="width: 100%;">
                                                <option value="{{ $data['graduation']->status }}" selected>
                                                    @if ($data['graduation']->status == 1)
                                                        Lulus
                                                    @elseif ($data['graduation']->status == 2)
                                                        Tidak Lulus
                                                    @endif
                                                </option>
                                                @if ($data['graduation']->status == 1)
                                                    <option value="2">
                                                        Tidak Lulus
                                                    </option>
                                                @elseif ($data['graduation']->status == 2)
                                                    <option value="1">
                                                        Lulus
                                                    </option>
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
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
        $(function() {
            $('#updateForm').validate({
                rules: {
                    activityId: {
                        required: true,
                    },
                    studentId: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    // certificate: {
                    //     required: true,
                    // },
                },
                messages: {
                    activityId: {
                        required: "Silahkan pilih kegiatan",
                    },
                    studentId: {
                        required: "Silahkan pilih siswa",
                    },
                    status: {
                        required: "Silahkan pilih status kelulusan",
                    },
                    // certificate: {
                    //     required: "Silahkan upload surat kelulusan",
                    // },
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
@endsection
