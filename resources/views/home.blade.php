@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ようこそ</div>
                <p>注意：idを変えたらログインし直せ</p>
                <div class="card-body">
                    <a href="#" data-toggle="modal" data-target="#createt" class="btn btn-lg btn-block btn-success">予約ツイートの新規作成</a>
                    <form action="{{ route('tweetnow') }}" method="POST">
                      @csrf
                      <textarea name="tweet" class="form-control"></textarea>
                      <button class="btn btn-sm btn-block btn-secondary" type="submit">今すぐツイート</button>
                    </form>
                </div>
            </div>
            <div class="card">
              <div class="card-header">{{ $searchdate }} の予約ツイート一覧</div>

              <div class="card-body">
                <h2>予約つ威遠</h2>
                <form action="{{route('home')}}">
                  <input name="date" type="date" value="{{ $searchdate }}">
                  <input type="submit" value="Search">
                </form>
                <table  class="table">
                  <thead>
                    <tr>
                      <th scope="col">ツイート予定時刻</th>
                      <th scope="col">ツイート内容</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($tweets as $tweet)
                    <tr class="tweetstable">
                      <td>{{$tweet->tweetdate}}&nbsp;{{$tweet->tweettime}}:00</td>
                      <td><pre>{{$tweet->content}}</pre></td> 
                      <td class="controll">
                        <a href="#" class="btn btn-warning">削除</a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
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
