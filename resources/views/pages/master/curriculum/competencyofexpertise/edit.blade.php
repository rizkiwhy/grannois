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
                                action="{{ route('competencyofexpertise.update', ['competencyofexpertise' => $data['competencyOfExpertise']->id]) }}"
                                method="post" class="form-horizontal" id="updateForm">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6 form-group">
                                        <label for="nama">Nama</label>
                                        <div class="input-group">
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Masukkan Nama" value="{{ $data['competencyOfExpertise']->name }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label for="label">Label</label>
                                        <div class="input-group">
                                            <input type="text" name="label" class="form-control" id="label"
                                                placeholder="Masukkan Label" value="{{ $data['competencyOfExpertise']->label }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label for="status">Status</label>
                                        <div class="input-group">
                                            <select class="form-control select2" id="active" name="active"
                                                style="width: 100%">
                                                <option value="{{ $data['competencyOfExpertise']->active }}" selected>
                                                    @if ($data['competencyOfExpertise']->active == 1)
                                                        Aktif
                                                    @elseif ($data['competencyOfExpertise']->active == 2)
                                                        Tidak Aktif
                                                    @endif
                                                </option>
                                                @if ($data['competencyOfExpertise']->active == 1)
                                                    <option value="0">
                                                        Tidak Aktif
                                                    </option>
                                                @elseif ($data['competencyOfExpertise']->active == 2)
                                                    <option value="1">
                                                        Lulus
                                                    </option>
                                                @endif

                                            </select>
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
