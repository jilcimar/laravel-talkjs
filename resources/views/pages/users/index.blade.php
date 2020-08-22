@extends('adminlte::page')

@section('title', 'Contatos')

@section('content_header')
    <h1>Contatos</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Contatos registrados no sistema</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th class="col-md-3">Nome</th>
                                        <th class="col-md-2">E-mail</th>
                                        <th class="col-md-3">Criado em</th>
                                        <th class="col-md-2">Opções</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('d/m/Y H:i')}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a class="btn btn-warning" title="Editar"
                                                       href="{{route('users.edit', $user->id)}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    @if(\auth()->user()->id != $user->id)
                                                        <a class="btn btn-danger destroy-user" title="Apagar"
                                                           href="#" data-user-id="{{$user->id}}">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        <form action="{{route('users.destroy', $user->id)}}"
                                                              method="POST"
                                                              id="form-destroy-{{$user->id}}">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center">O sistema não possui users
                                                registrados.
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('js')
    <script>
        $('.destroy-user').click(function () {
            let userId = $(this).data('userId');
            Swal.fire({
                title: 'Apagar Contato',
                text: "Você tem certeza que deseja apagar esse contato?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, tenho certeza!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value) {
                    $('#form-destroy-' + userId).submit();
                }
            });
        });
    </script>
@endsection
