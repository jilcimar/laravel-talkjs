@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Chat</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Contatos do sistema</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        @forelse($users as $user)
                            <li class="nav-item item-user" data-user="{{$user->id}}">
                                <a href="#" class="nav-link">
                                    {{$user->name}} - ({{$user->email}})
                                </a>
                            </li>
                        @empty
                            Sem usuários
                        @endforelse

                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-6">
            <div id="talkjs-container" style="width: 100%; height: 500px;"></div>
        </div>
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
