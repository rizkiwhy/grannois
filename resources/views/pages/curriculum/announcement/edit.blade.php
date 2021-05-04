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
                            <form
                                action="{{ route('announcement.update', ['announcement' => $data['announcement']->id]) }}"
                                method="post" class="form-horizontal" id="updateForm">
                                @method('put')
                                @csrf
                                <div class="row">
                                    @if (Auth::user()->role_id === 1)
                                        <div class="col-sm-6 form-group">
                                            <label for="penerbit">Penerbit</label>
                                            <div class="input-group">
                                                <select class="form-control select2" id="publisher" name="publisher"
                                                    style="width: 100%;">
                                                    <option value="{{ $data['announcement']->publisher }}" selected>
                                                        {{ $data['announcement']->user->name }}</option>
                                                    @foreach ($data['user']->except($data['announcement']->publisher) as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                        @elseif(Auth::user()->role_id === 2)
                                            <div class="col-sm-12 form-group">
                                    @endif
                                    <label for="kegiatan">Kegiatan</label>
                                    <div class="input-group">
                                        <select class="form-control select2" id="activityId" name="activityId"
                                            style="width: 100%;">
                                            <option value="{{ $data['announcement']->activity_id }}" selected>
                                                {{ $data['announcement']->activity->note }}</option>
                                            @foreach ($data['activity']->except($data['announcement']->activity_id) as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->note }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                        </div>
                        <div class="row">
                            <div class="col-sm-4 form-group ">
                                <label for="tanggalPenerbitan">Tanggal Penerbitan</label>
                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                    <input type="date" name="publishDate" class="form-control datetimepicker-input"
                                        id="publishDate" data-target="#reservationdate"
                                        value="{{ $data['announcement']->publish_date }}" />
                                    <div class="input-group-append" data-target="#reservationdate"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 form-group ">
                                <label for="noSurat">No. Surat</label>
                                <div class="input-group">
                                    <input type="text" name="letterNumber" class="form-control" id="letterNumber"
                                        placeholder="Masukkan No. Surat" value="{{$data['announcement']->letter_number}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <textarea id="content">
                                        {{ $data['announcement']->content }}
                                            {{-- Place <em>some</em> <u>text</u> <strong>here</strong> --}}
                                        </textarea>
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
    <!-- Summernote -->
    {{-- <script src="{{ asset('src/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
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
