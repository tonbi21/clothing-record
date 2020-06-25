@extends('layouts.app')

@section('content')
    <div class="row mt-5">
        <div class="col-md-8 offset-md-2 frame p-5">
            <h2 class="mb-5">コーディネート投稿</h2>
            
            <!--フォーム-->
            {!! Form::open(['route' => ['coordinates.update', $coordinate->id], 'method' => 'put','files' => true]) !!}
                <div class="form mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('file', 'コーディネート画像', ['class' => 'control-label']) !!}
                        </div>
                        <div class="colmd-8">
                            {!! Form::file('file', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
              
                <div class="form mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('coordinate_type', 'シーズン', ['class' => 'control-label']) !!}
                        </div>
                        <div class="colmd-8">
                            {!! Form::select('coordinate_type', App\Coordinate::$coordinate_types, $coordinate->coordinate_type, ['class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                    
                <div class="form mb-5">
                    <div class="row">
                        <div class="col-md-4">
                            {!! Form::label('content', 'コーディネート詳細', ['class' => 'control-label']) !!}
                        </div>
                        <div class="colmd-8">
                            {!! Form::textarea('content', $coordinate->content, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                    
                    
                <div class="form-group text-center">
                    {!! Form::submit('編集', ['class' => 'btn btn-primary my-1']) !!}
                </div>
            {!! Form::close() !!}
                <div class="form-group text-center">
                    @if (Auth::id() == $coordinate->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['coordinates.destroy', $coordinate->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                    @endif
                </div>
             
        </div>
    </div>
@endsection