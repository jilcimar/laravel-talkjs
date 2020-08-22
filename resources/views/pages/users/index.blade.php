@extends('adminlte::page')

@section('title', 'Contatos')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Contatos registrados no sistema</h3>
                </div>
                <div class="box-body">
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            <div class="row d-flex align-items-stretch">
                                @forelse($users as $user)
                                    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                                        <div class="card bg-light">
                                            <div class="card-header text-muted border-bottom-0">
                                                Usuário do sistema
                                            </div>
                                            <div class="card-body pt-0">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <h2 class="lead"><b>{{ $user->name }}</b></h2>
                                                        <p class="text-muted text-sm"><b>Email: </b>
                                                            {{ $user->email }}  </p>
                                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                                            <li class="small">
                                                                <span class="fa-li">
                                                                    <i class="fas fa-lg fa-calendar-alt"></i>
                                                                </span>Registrado em: {{ $user->created_at->format('d/m/Y')}}
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-5 text-center">
                                                        <img src="{{asset('vendor/adminlte/dist/img/user.png')}}"
                                                             alt=""
                                                             class="img-circle img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="text-right">
                                                    <a class="btn btn-warning" title="Editar"
                                                       href="{{route('users.edit', $user->id)}}">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
{{--                                                    <a href="#" class="btn btn-sm btn-primary">--}}
{{--                                                        <i class="fas fa-user"></i> View Profile--}}
{{--                                                    </a>--}}

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
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    O sistema não possui contatos registrados.
                                @endforelse
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
