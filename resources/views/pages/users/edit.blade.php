@extends('adminlte::page')

@section('title', 'Editar contato')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Editar Contato</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{route('users.update',$user->id)}}" role="form">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nome <span class="text-red">*</span></label>
                            <input type="text" class="form-control" name="name"
                                   placeholder="Nome Completo" maxlength="250" value="{{$user->name}}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="text-red">*</span></label>
                            <input type="email" class="form-control" name="email"
                                   placeholder="Endereço de e-mail" maxlength="250" value="{{$user->email}}"
                                   required>
                        </div>
                        <div class="form-group ">
                            <label for="email">Senha <span class="text-red">*</span></label>
                            <input id="password" type="password"
                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                   name="password" required>
                        </div>
                        <div class="form-group ">
                            <div class="form-group ">
                                <label for="email">Confirmação de senha <span class="text-red">*</span></label>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <a href="{{route('users.index')}}" class="btn btn-default">Cancelar</a>
                        <button type="submit" class="btn btn-primary float-right">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
