@extends('layouts.app')
<style type="text/css">
    .comment-box{
        border: #87c1ff solid 1px;
        padding: 8px;
        border-radius: 8px;
        background: #fff;
    }
</style>
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4>By: {{$note->name}}</h4>
                    
                
            
                @php if($note->access == 'public') $text = 'text-success'; else $text = ''; @endphp
            <div class="card">     
                <div class="card-header">
                    <small>                    
                    Created At: <b>{{$note->created_at}}</b>
                    </small>
                    <!-- @if(Request::is('user/notes'))
                    <a href="javascript:;" class="{{$text}}" style="float: right">{{$note->access}} note</a>
                    @endif -->
                </div>
                <div class="card-body">
                    {{$note->note}}
                </div>
            </div>
            <br>
            <h4>Comments </h4>
            <hr>
            @foreach($comments as $comment)
                <div class="comment-box">
                    {{$comment->comment}}
                    <br>
                    <small>By: {{$comment->name}}</small> 
                </div>
                <br>
            @endforeach
            <br><br>
            <form method="POST" action="{{ url('note/comment-appln') }}">
                @csrf

                        <div class="form-group row">
                            
                            <div class="col-md-6">                              
                                <textarea name="comment" class="form-control" required></textarea>                               
                            </div>
                        </div>
                        
                        <input type="hidden" name="note_id" value="{{$note->note_id}}">
                        <input type="hidden" name="slug" value="{{$note->slug}}">

                        <div class="form-group">
                            
                                <button type="submit" class="btn btn-primary">
                                   Post comment
                                </button>
                           
                        </div>
            </form>
            
            
        </div>
    </div>
</div>
@endsection
