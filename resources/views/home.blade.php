@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ようこそ</div>

                <div class="card-body">
                    <a href="#" data-toggle="modal" data-target="#createt" class="btn btn-lg btn-block btn-success">予約ツイートの新規作成</a>
                    <form action="{{ route('tweetnow') }}" method="POST">
                      @csrf
                      <textarea name="tweet" class="form-control"></textarea>
                      <button class="btn btn-sm btn-block btn-secondary" type="submit">今すぐツイート</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<form action="{{route('tweet.schedule')}}" method="POST">
@csrf
<div class="modal fade" id="createt" tabindex="-1" aria-labelledby="createtb" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">予約ツイート作成</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
      <input class="form-control" type="date" name="date" value="{{date('Y-m-d')}}"/>
      <input class="form-control" type="number" max="23" min="0" name="time" value="{{date('H')}}"/>
      <textarea name="content" maxlength="140" class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>
@endsection
