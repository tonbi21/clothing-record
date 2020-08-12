
                @foreach($timeline_coordinates as $coordinate)
                    <div class="col-lg-4 offset-md-0 col-md-6 col-8 offset-2 mb-4">
                        <div class="card coordinate-card">
                            <a href="{{ route('coordinates.show', ['coordinate' => $coordinate->id]) }}">
                                <img src= "{{ Storage::disk('s3')->url($coordinate->coordinate_image_url) }}" alt="coordinate-image" class="img-square">
                            </a>
                            <div class="card-body">
                                <div class="media">
                                    <!--ユーザーのアイコン-->
                                    <div class = "user-icon-coordinate">
                                        @if($coordinate->user->user_image_url === 'images/initial-icon.jpeg')
                                            <img src="{{ secure_asset('images/initial-icon.jpeg') }}" alt="user_icon" class="img-circle">
                                        @else
                                            <img src= "{{ Storage::disk('s3')->url($coordinate->user->user_image_url) }}" alt="user_icon" class="img-circle">
                                        @endif  
                                    </div>
                                    <div class="media-body ml-1">
                                        <h5 class="">{!! link_to_route('users.show', $coordinate->user->name, ['user' => $coordinate->user->id]) !!}</h5>
                                        <p>{{ $coordinate->user->getGenderLabel($coordinate->user->gender) }} ｜ {{ $coordinate->user->height }}cm</p>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    #{{ $coordinate->getCoordinateLabel($coordinate->coordinate_type) }}
                                    <div class="float-right">
                                        @if (Auth::check())
                                            @include('favorites.favorite_button')
                                        @endif
                                    </div>
                                    
                                </li>
                                
                            </ul>
                            
                        </div>
                    </div>
                @endforeach
           