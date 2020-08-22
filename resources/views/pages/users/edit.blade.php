@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Editar Contato</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Formulário de edição de contato</h3>
                </div>
                <div class="box-body with-border">
                    <form method="POST" action="{{route('users.update',$user->id)}}" role="form">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="name">Nome <span class="text-red">*</span></label>
                                    <input type="text" class="form-control" name="name"
                                           placeholder="Nome Completo" maxlength="250" value="{{$user->name}}"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-red">*</span></label>
                                    <input type="email" class="form-control" name="email"
                                           placeholder="Endereço de e-mail" maxlength="250" value="{{$user->email}}"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group ">
                                    <label for="email">Senha <span class="text-red">*</span></label>
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group ">
                                    <label for="email">Confirmação de senha <span class="text-red">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-left">
                            <a href="{{route('users.index')}}" class="btn btn-default">Cancelar</a>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
