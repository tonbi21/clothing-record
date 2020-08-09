@extends('layouts.app')

@section('content')
    <div class="row my-5">
        <div class="col-lg-8 offset-lg-2 col-10 offset-1 frame pt-5 pb-3 px-5">
            <h2 class="mb-5">アイテムを保管</h2>
            
            <!--フォーム-->
            {!! Form::open(['route' => 'items.store', 'method' => 'post','files' => true]) !!}
                <div class="form mb-5">
                    <div class="row">
                        <div class="col-lg-4">
                            {!! Form::label('file', 'アイテム画像', ['class' => 'control-label']) !!}
                        </div>
                        <div class="col-lg-8 mt-5">
                            {!! Form::file('file', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
              
                <div class="form mb-5">
                    <div class="row">
                        <div class="col-lg-4">
                            アイテム詳細
                        </div>
                        <div class="col-lg-8">
                            <div class="form mt-5 mb-5">
                                {!! Form::label('brand', 'ブランド名', ['class' => 'control-label']) !!}
                                {!! Form::text('brand', old('brand'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form mt-5 mb-5">
                                {!! Form::label('gender', '性別') !!}
                                {!! Form::select('gender', App\Item::$genders, 0, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form mb-5">
                                {!! Form::label('category_id', 'カテゴリー') !!}
                                {!! Form::select('category_id', App\Item::$item_category, 0, ['class' => 'form-control']) !!}
                            </div>    
                            <div class="form mb-5">
                                {!! Form::label('name', 'アイテム名', ['class' => 'control-label']) !!}
                                {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                            </div>    
                        </div>
                        <div class="form-group col-4 offset-4">
                            {!! Form::submit('保管', ['class' => 'btn btn-primary form-control']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection