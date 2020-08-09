@extends('layouts.app')

@section('content')
    <div class="row my-5">
        <div class="col-lg-8 offset-lg-2 col-10 offset-1 frame pt-5 pb-3 px-5">
            <h2 class="mb-5">コーディネート編集</h2>
            
            <!--フォーム-->
            {!! Form::open(['route' => ['coordinates.update', $coordinate->id], 'method' => 'put','files' => true]) !!}
                <div class="form mb-5">
                    <div class="row">
                        <div class="col-lg-4">
                            {!! Form::label('file', 'コーディネート画像', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-lg-8">
                            {!! Form::file('file', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="form mb-3">
                    <div class="row">
                        <div class="col-lg-4">
                            コーディネート詳細
                        </div>
                        <div class="col-lg-8">
                            @if($items->isEmpty())
                                <div class="form mt-5 mb-5 items">
                                    {!! Form::label('item', '着用アイテム', ['class' => 'control-label']) !!}
                                    <select class="form-control item-form mb-3" name="items[]">
                                        <option value ="">アイテムがありません</option>
                                    </select>
                                </div>
                            @else
                            <div class="form mt-5 mb-5 items">
                                {!! Form::label('item', '着用アイテム', ['class' => 'control-label']) !!}
                                <select class="form-control item-form mb-3" name="items[]">
                                    
                                    @foreach($items as $item)
                                        <option value ="">選択してください</option>
                                        <option value = "{{ $item->id }}" >{{ $item->id }}【{{ $item->brand }}】{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="btn btn-secondary mb-5" id="add-form">アイテムを追加</div>
                            @endif
                            
                            <div class="form mb-5">
                                {!! Form::label('coordinate_type', 'シーズン', ['class' => 'control-label']) !!}
                                {!! Form::select('coordinate_type', App\Coordinate::$coordinate_types, $coordinate->coordinate_type, ['class' => 'form-control']) !!}
                            </div>
                            
                            <div class="form mb-5">
                                {!! Form::label('content', 'コーディネート紹介文', ['class' => 'control-label']) !!}
                                {!! Form::textarea('content', $coordinate->content, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group col-4 offset-4">
                            {!! Form::submit('編集', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
            <div class="row">
                <div class="form-group col-4 offset-4">
                    @if (Auth::id() == $coordinate->user_id)
                            {{-- 投稿削除ボタンのフォーム --}}
                            {!! Form::open(['route' => ['coordinates.destroy', $coordinate->id], 'method' => 'delete']) !!}
                                {!! Form::submit('削除', ['class' => 'btn btn-danger form-control']) !!}
                            {!! Form::close() !!}
                    @endif
                </div>
            </div>
             
        </div>
    </div>
@endsection