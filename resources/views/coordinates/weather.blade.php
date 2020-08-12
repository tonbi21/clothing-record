    <div class='text-center mt-5 mb-2'>
        <h2>Weather</h2>
    </div>

    <div class="row">
        <div class="card mb-3 p-0 col-md-8 offset-md-2">
            <div class="row no-gutters">
                
                <!--大阪の天気-->
                <div class="col-6">
                    <div type="button" data-toggle="modal" data-target="#osakaModal">
                        <img src="images/osaka.jpg" class="card-img" alt="osaka-weather" data-toggle="modal" data-target="#osakaModal">
                        <div class="card-img-overlay">
                            <h1 class="card-title">Osaka</h1>
                        </div>
                    </div>
                </div>
                
                <!--東京の天気-->
                <div class="col-6">
                    <div type="button" data-toggle="modal" data-target="#tokyoModal">
                        <img src="images/tokyo.jpg" class="card-img" alt="tokyo-weather">
                        <div class="card-img-overlay">
                            <h1 class="card-title">Tokyo</h1>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="osakaModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="m-2 gray">{{ $o_date }} ＠{{ $o_name }}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="media">
                        <div class="text-center">
                            <img src="/images/weather/{{ $o_icon }}.png" class="weather-icon">
                            <h5>{{ $o_description }}</h5>
                        </div>
                        <div class="media-body">
                            <div class="mt-5">
                                <h3><span class="badge badge-pill badge-danger">{{ $o_temp_max }}℃</span></h3>
                                <h3><span class="badge badge-pill badge-primary">{{ $o_temp_min }}℃</span></h3>
                            </div>
                            <div class="p-2 temp-coordinate">
                                @if($o_temp >= 26)
                                    <p>現在の気温は<span class="now-temp">{{ $o_temp }}℃</span></p>
                                    <p>外に出て少し歩くと汗ばむ気温なので、トップスは半袖1枚で大丈夫。帽子や日傘、日焼け止めといった紫外線対策も必要です。</p>
                                @elseif($o_temp >= 21)
                                    <p>現在の気温は<span class="now-temp">{{ $o_temp }}℃</span></p>
                                    <p>半袖と長袖の分かれ目の気温です。晴れて日差しがある日は半袖を、曇りや雨で日差しがない日は長袖がおすすめ。</p>
                                @elseif($o_temp >= 16)
                                    <p>現在の気温は<span class="now-temp">{{ $o_temp }}℃</span></p>
                                    <p>少し肌寒いかな？というくらいの過ごしやすい気温。薄手のジャケットやカーディガンを羽織ったりとレイヤードスタイルがおすすめ。</p>
                                @elseif($o_temp >= 12)
                                    <p>現在の気温は<span class="now-temp">{{ $o_temp }}℃</span></p>
                                    <p>冬物を着始める気温です。本格的なコートにはまだ早いけれど、軽めのアウターは準備しておきたいところです。</p>
                                @elseif($o_temp >= 7)
                                    <p>現在の気温は<span class="now-temp">{{ $o_temp }}℃</span></p>
                                    <p>全国平均でいくと11月～12月くらいの気温で、寒さが前面に感じられる時期。冬服の上にアウターを羽織ってちょうどいいくらいです。</p>
                                @else
                                    <p>現在の気温は<span class="now-temp">{{ $o_temp }}℃</span></p>
                                    <p>凍えるほどの寒さになります。冬素材をしっかり重ね着して、あったかインナーやカイロもほしいところです。</p>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="mr-5">{!! link_to_route('coordinates.create', 'この気温のコーディネートを投稿', ['type' => 'button'], ['class' => 'btn btn-outline-primary']) !!}</p>
                    <p class="text-right mr-2 gray">{{ $o_time }} 発表</p>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="modal fade" id="tokyoModal" tabindex="-1" role="dialog" aria-labelledby="tokyoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="m-2 gray">{{ $t_date }} ＠{{ $t_name }}</p>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="media">
                        <div class="text-center">
                            <img src="/images/weather/{{ $t_icon }}.png" class="weather-icon">
                            <h5>{{ $t_description }}</h5>
                        </div>
                        <div class="media-body">
                            <div class="mt-5">
                                <h3><span class="badge badge-pill badge-danger">{{ $t_temp_max }}℃</span></h3>
                                <h3><span class="badge badge-pill badge-primary">{{ $t_temp_min }}℃</span></h3>
                            </div>
                            <div class="p-2 temp-coordinate">
                                @if($t_temp >= 26)
                                    <p>現在の気温は<span class="now-temp">{{ $t_temp }}℃</span></p>
                                    <p>外に出て少し歩くと汗ばむ気温なので、トップスは半袖1枚で大丈夫。帽子や日傘、日焼け止めといった紫外線対策も必要です。</p>
                                @elseif($t_temp >= 21)
                                    <p>現在の気温は<span class="now-temp">{{ $t_temp }}℃</span></p>
                                    <p>半袖と長袖の分かれ目の気温です。晴れて日差しがある日は半袖を、曇りや雨で日差しがない日は長袖がおすすめ。</p>
                                @elseif($t_temp >= 16)
                                    <p>現在の気温は<span class="now-temp">{{ $t_temp }}℃</span></p>
                                    <p>少し肌寒いかな？というくらいの過ごしやすい気温。薄手のジャケットやカーディガンを羽織ったりとレイヤードスタイルがおすすめ。</p>
                                @elseif($t_temp >= 12)
                                    <p>現在の気温は<span class="now-temp">{{ $t_temp }}℃</span></p>
                                    <p>冬物を着始める気温です。本格的なコートにはまだ早いけれど、軽めのアウターは準備しておきたいところです。</p>
                                @elseif($t_temp >= 7)
                                    <p>現在の気温は<span class="now-temp">{{ $t_temp }}℃</span></p>
                                    <p>全国平均でいくと11月～12月くらいの気温で、寒さが前面に感じられる時期。冬服の上にアウターを羽織ってちょうどいいくらいです。</p>
                                @else
                                    <p>現在の気温は<span class="now-temp">{{ $t_temp }}℃</span></p>
                                    <p>凍えるほどの寒さになります。冬素材をしっかり重ね着して、あったかインナーやカイロもほしいところです。</p>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p class="mr-5">{!! link_to_route('coordinates.create', 'この気温のコーディネートを投稿', ['type' => 'button'], ['class' => 'btn btn-outline-primary']) !!}</p>
                    <p class="text-right mr-2 gray">{{ $t_time }} 発表</p>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
