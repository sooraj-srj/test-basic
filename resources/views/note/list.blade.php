@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4>List Notes</h4>
                    
                
            @foreach($notes as $note)
                @php if($note->access == 'public') $text = 'text-success'; else $text = ''; @endphp
            <div class="card">     
                <div class="card-header">
                    <small>
                    By: <b>{{$note->name}}</b><br>
                    Created At: <b>{{$note->created_at}}</b>
                    </small>
                    @if(Request::is('user/notes'))
                    <a href="javascript:;" class="{{$text}}" style="float: right">{{$note->access}} note</a>
                    @endif
                </div>
                <div class="card-body">
                    {{str_limit($note->note,90)}}
                    
                        <a href="{{url('note/'.$note->slug)}}" style="float: right">Read more</a>
                    
                </div>
            </div>
            <br>
            @endforeach
            
        </div>
    </div>
</div>
@endsection
