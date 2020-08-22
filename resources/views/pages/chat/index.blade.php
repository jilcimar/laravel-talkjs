@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Chat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Todos os Contatos</h3>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        @forelse($users as $user)
                            <li class="item-user" data-user="{{$user->id}}">
                                <a href="#">
                                    <i class="fa fa-user"></i> {{$user->name}} - ({{$user->email}})
                                    <span class="label label-warning pull-right"></span>
                                </a>
                            </li>
                        @empty
                            Sem usuários
                        @endforelse

                    </ul>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-8">
            <div id="talkjs-container" style="width: 100%; height: 500px;"></div>
        </div>
        <!-- /.col -->
    </div>
@stop

@section('js')
    <script>
        function chatStart (fromId) {
            Talk.ready.then(async function() {
                var userMe = await $.get( "/api/user/{{\Auth::user()->id}}");
                var userOther = await $.get( "/api/user/"+fromId);

                var me = new Talk.User(userMe);

                window.talkSession = new Talk.Session({
                    appId: "trzOdjoD",
                    me: me,
                });

                var other = new Talk.User(userOther);

                var conversation = talkSession.getOrCreateConversation(Talk.oneOnOneId(me, other))
                conversation.setParticipant(me);
                conversation.setParticipant(other);

                var inbox = talkSession.createInbox({selected: conversation});
                inbox.mount($("#talkjs-container"));
            });
        }

        $('.item-user').click(function (){
            var userId = $(this).data("user");
            chatStart(userId);
        });
    </script>
@endsection
