<div class="col-xl-3 col-lg-3 d-lg-block d-none frame categories">
    <h4>コーディネート</h4>
    <h5 class="mt-2">性別</h5>
        <ul>
            <li class="mb-1"><a href="/">All</a></li>
            @foreach(App\User::$genders as $code => $gender)
                <li class="mb-1">
                    <a href="{{route('gender.get', ['gender' => $code])}}">{{ $gender }}</a>
                </li>
            @endforeach
        </ul>
            
    <h5 class="mt-3">タイプ</h5>
        <ul>
            @foreach(App\Coordinate::$coordinate_types as $code => $coordinate_type)
                <li class="mb-1">
                    <a href="{{route('coordinate_type.get', ['coordinate_type' => $code])}}">{{ $coordinate_type }}</a>
                </li>
            @endforeach
        </ul>
            
    <h4 class="mt-3">{!! link_to_route('users.index', 'ユーザーを探す', ['class' => 'dropdown-item']) !!}</h4>
    <h4 class="mt-3">{!! link_to_route('items.index', 'アイテムを探す', ['class' => 'dropdown-item']) !!}</h4>
</div>



<div class="col-12 d-block d-lg-none frame categories mb-5 text-center">
    <h4 class="mt-2">コーディネート</h4>
    <h5 class="mt-2">性別</h5>
        <ul class="pl-0">
            <li class="d-inline-block mr-2"><a href="/">All</a></li>
            @foreach(App\User::$genders as $code => $gender)
                <li class="d-inline-block  mr-2">
                    <a href="{{route('gender.get', ['gender' => $code])}}">{{ $gender }}</a>
                </li>
            @endforeach
        </ul>
            
    <h5 class="mt-3">タイプ</h5>
        <ul class="pl-0">
            @foreach(App\Coordinate::$coordinate_types as $code => $coordinate_type)
                <li class="d-inline-block  mr-2">
                    <a href="{{route('coordinate_type.get', ['coordinate_type' => $code])}}">{{ $coordinate_type }}</a>
                </li>
            @endforeach
        </ul>
            
    <h4 class="mt-3">{!! link_to_route('users.index', 'ユーザーを探す', ['class' => 'dropdown-item']) !!}</h4>
    <h4 class="mt-3">{!! link_to_route('items.index', 'アイテムを探す', ['class' => 'dropdown-item']) !!}</h4>
</div>