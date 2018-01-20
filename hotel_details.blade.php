@extends('front.layouts.master')
@section('page-title')
    {{$hotelInfo->name}}
@endsection
@section('content')
    @include('front._partials.header')

    @php
         use Jenssegers\Agent\Agent as Agent;
         $Agent = new Agent();
    @endphp

    <section id="hotel-details-section">
        <div id="app">
        <div class="ui fluid container">
            <div class="row">
                @if(!($Agent->isMobile()))
                    <ul class="bxslider">
                        @if(count($hotelInfo->gallery) > 0)
                            @foreach(json_decode($hotelInfo->gallery) as $gallery)
                                <li><img alt="{{$hotelInfo->name}}" src="{{ asset('assets/images/scubaya/hotel/gallery/'.$hotelInfo->merchant_primary_id.'/hotel-'.$hotelInfo->id.'/'.$gallery) }}" /></li>
                            @endforeach
                        @else
                            <h3 class="text-center">No Images</h3>
                        @endif
                    </ul>
                @endif
            </div>

            <div class="row padding-20 hotel-detail-section">
                <div class="header text-center">
                    @if(!($Agent->isMobile()))
                    <i class="showHotels arrow-room angle double down icon right floated"></i>
                    @endif
                    <h1 class="hotel-name-color">@{{ hotel_name }}</h1>
                    <h2>@{{hotel_address}}</h2>
                    <p class="ui container">INK Hotel Amsterdam owes its name to the rich history of the building in which, as former home of the Dutch newspaper 'De Tijd', stories were conceived, written and brought to life in ink. INK Hotel is the place "where stories are yet to be written". INK Hotel Amsterdam is a luxury design hotel, where the traditional rules of hospitality are freely translated to the modern day, rewriting the definition of 'luxury'. Award winning, state-of-the-art design in the heart of Amsterdam</p>

                </div>

            </div>

            {{--<svg id="bigTriangleShadow" xmlns="http://www.w3.org/2000/svg" version="1.1" width="100%" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">--}}
            {{--<path id="trianglePath1" d="M0 0 L50 100 L100 0 Z"></path>--}}
            {{--<path id="trianglePath2" d="M50 100 L100 40 L100 0 Z"></path>--}}
            {{--</svg>--}}

        </div>
        @if(!($Agent->isMobile()))
        <div class="ui container">
            <div id="rooms" class="row">
                <h2>Rooms</h2>
                    @if(count($roomDetails) > 0)
                        @foreach($roomDetails as $detail)
                        <?php
                            $tariff   =   \App\Scubaya\model\RoomPricing::where('merchant_primary_id', $detail->merchant_primary_id)->where('room_id', $detail->id)->get();
                        ?>

                <div class="ui two column stackable grid">
                    <div class="column">
                        <div class="ui image">
                            <img class="image" alt="{{$detail->name}}" src="{{asset('assets/images/scubaya/rooms/'.$detail->id.'-'.$detail->room_image)}}"  style="height: 319px; width: 600px"/><br/>
                        </div>
                    </div>


                    <div class="column">
                        <div class="ui segment" id="room-block">
                            <div class="ui three row">
                                <div class="row">
                                    <h2 class="ui dividing header">{{ $detail->name }}</h2>
                                    <div>The {{ $detail->type }} has capacity of {{ $detail->max_people }} people <i class="user icon"></i> Brief description of {{ $detail->name }}
                                        The {{ $detail->type }} has capacity of {{ $detail->max_people }} people <i class="user icon"></i> Brief description of {{ $detail->name }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="ui two column grid">
                                        <div class="column">
                                            <div class="ui hidden divider"></div>
                                            <?php $features =   json_decode($detail->features);
                                                $featuresArray=array();
                                                    for($k=0;$k<=5;$k++)
                                                    {
                                                        $featuresArray[$k]=$features[$k];
                                                    }
                                                    for($i=0;$i<=2;$i++)
                                                    {
                                            ?>
                                                    <div class="ui bulleted list">
                                                        <div class="item"><strong>{{$featuresArray[$i]}}</strong></div>
                                                    </div>
                                              <?php } ?>
                                        </div>
                                        <div class="column">
                                            <div class="ui hidden divider"></div>
                                            <?php  $features =   json_decode($detail->features);
                                                for($j=3; $j<=5; $j++)
                                                {
                                            ?>
                                                <div class="ui bulleted list">
                                                    <div class="item"><strong>{{$featuresArray[$j]}}</strong></div>
                                                </div>
                                          <?php } ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="ui hidden divider"></div>
                                <div class="row">
                                    @if(count($tariff) > 0)
                                        <button class="tariff-btn ui blue basic right floated button " id="{{$detail->id}}" type="button" onclick="showTariffData(this)">TARIFF</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if(count($tariff) > 0)
                    <div class="scubaya-tariff-options" id="tariff{{$detail->id}}">

                        @foreach($tariff as $t)
                            <?php
                                $price_per_night_manually = json_decode($t->price_per_night_manually);
                                   // calculate merchant request time
                                $today  = date('Y-m-d', $_SERVER['REQUEST_TIME']);
                                $today  = explode('-', $today);
                                    /* mktime(hour, minute, second, month, day, year) */
                                $epoch  = mktime(0, 0, 0, $today[1], $today[2], $today[0]);
                                foreach($price_per_night_manually as $key => $value)
                                {
                                    if ($key == $epoch)
                                        $roomPrices =  $value;
                                }
                            ?>

                            <div class="ui three column grid">
                                <div class="column">
                                    <h2><strong>{{ ucfirst($t->tariff_title) }}</strong></h2>
                                    <p class="ui horizontal label"> Max Nights:{!!$t->max_nights!!}</p>
                                </div>

                                <div class="column text-center">
                                    <h1><strong>{{@$exchangeRate['symbol'] }}{{($roomPrices) * $exchangeRate['rate']}}</strong></h1>
                                </div>

                                <div class="column">
                                    <button class="ui blue button right floated" type="button">Book now</button>
                                </div>
                            </div>
                            <div class="ui column tariff-description">
                                <p>{!!$t->tariff_description!!}</p>
                            </div>

                            @if (!($loop->last))
                            <hr/>
                            @endif
                        @endforeach

                    </div>
                @endif
            @endforeach
            @else
                <div class="ui raised segment">No Rooms Available</div>
            @endif
        </div>

        <div class="row paddingTop20 marginBottom10">
            <h2 class="header">Policies</h2>
                <div class="ui raised segment">
                    <?php $policies =   (array)json_decode($hotelInfo->hotel_policies); ?>
                        @if(count($policies) > 0)
                            @foreach($policies as $key => $value)
                                @if(!empty($value))
                                    <div class="ui column">
                                        <div class="ui form">
                                            <label>{{ucwords(str_replace('_',' ',$key))}} :</label>&nbsp;{{$value}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>No Policies Available.</p>
                        @endif
                </div>
        </div>
    </div>

    @else
             <div class="ui container">
                <div class="ui link three stackable cards">
                     @if(count($roomDetails) > 0)
                        @foreach($roomDetails as $detail)
                             <?php
                                 $tariff   =   \App\Scubaya\model\RoomPricing::where('merchant_primary_id', $detail->merchant_primary_id)->where('room_id', $detail->id)->get();
                              ?>

                             <div class="card">
                                <div class="ui image">
                                    <img class="image" alt="{{$detail->name}}" src="{{asset('assets/images/scubaya/rooms/'.$detail->id.'-'.$detail->room_image)}}" />
                                </div>
                                <div class="content">
                                    <div class="header">
                                        {{ $detail->name }}
                                    </div>
                                    <div class="meta">
                                        The {{ $detail->type }} has capacity of {{ $detail->max_people }}
                                        people <i class="user icon"></i> Brief description of {{ $detail->name }},
                                        The {{ $detail->type }} has capacity of {{ $detail->max_people }}
                                        people <i class="user icon"></i> Brief description of {{ $detail->name }}
                                    </div>
                                    <div class="description">
                                        <?php $features =   json_decode($detail->features);
                                            $featuresArray=array();
                                            for($k=0;$k<=5;$k++)
                                            {
                                                $featuresArray[$k]=$features[$k];
                                            }
                                            for($i=0;$i<=5;$i++)
                                            {
                                        ?>

                                        <div class="ui bulleted list">
                                        <div class="item"><strong>{{$featuresArray[$i]}}</strong></div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="extra content">
                                    @if(count($tariff) > 0)
                                        <button class=" ui blue basic right floated button " id="{{$detail->id}}" type="button" onclick="showTariffData(this)">TARIFF</button>
                                    @endif
                                </div>
                            </div>

                                                                           @if(count($tariff) > 0)
                                                                            <div class="scubaya-tariff-options-mobile" id="tariff{{$detail->id}}">

                                                                                @foreach($tariff as $t)
                                                                                    <?php
                                                                                        $price_per_night_manually = json_decode($t->price_per_night_manually);
                                                                                            // calculate merchant request time
                                                                                        $today  = date('Y-m-d', $_SERVER['REQUEST_TIME']);
                                                                                        $today  = explode('-', $today);
                                                                                            /* mktime(hour, minute, second, month, day, year) */
                                                                                        $epoch  = mktime(0, 0, 0, $today[1], $today[2], $today[0]);
                                                                                        foreach($price_per_night_manually as $key => $value)
                                                                                        {
                                                                                            if ($key == $epoch)
                                                                                                $roomPrices =  $value;
                                                                                        }
                                                                                    ?>

                                                                                    <div class="ui three column grid">
                                                                                        <div class="column">
                                                                                            <h2><strong>{{ ucfirst($t->tariff_title) }}</strong></h2>
                                                                                            <p class="ui horizontal label"> Max Nights:{!!$t->max_nights!!}</p>
                                                                                        </div>

                                                                                        <div class="column text-center">
                                                                                            <h1><strong>{{@$exchangeRate['symbol'] }}{{($roomPrices) * $exchangeRate['rate']}}</strong></h1>
                                                                                        </div>

                                                                                        <div class="column">
                                                                                            <button class="ui blue button right floated" type="button">Book now</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="ui column tariff-description">
                                                                                        <p>{!!$t->tariff_description!!}</p>
                                                                                    </div>

                                                                                    @if (!($loop->last))
                                                                                        <hr/>
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                         @endif






                        @endforeach
                     @else
                        <div class="ui raised segment">No Rooms Available</div>
                     @endif
                </div>




























             </div>

        </div>

    @endif
    </section>
@endsection

@section('script-extra')
    <script src="{{ asset('assets/front/js/vue.js') }}" type="text/javascript"></script>
    <script  type="text/javascript">
    var apps=new Vue({
        el:'#app',
        data:function(){
            return{
             hotel_name: '{!! $hotelInfo->name!!}',
             hotel_address:'{!! $hotelInfo->address!!}',
//             hotel_description:'{!! $hotelInfo->description !!}'
             {{--merchant_primary_id:'{!! $hotelInfo->merchant_primary_id !!}',--}}
             {{--hotel_id     :'{!!  $hotelInfo->id !!}',--}}
             {{--hotel_image   :'{!! $hotelInfo->image !!}',--}}
             {{--image_path:'{{asset('assets/images/scubaya/hotel/')}}'--}}
              }
        }
    });

  function showTariffData(data)
  {
     $('#tariff'+ data.id).slideToggle("slow");
  }

  $(document).ready(function(){
        $('.bxslider').bxSlider({
               auto: true,
               mode: 'fade',
               captions: true,
               slideWidth: 800,
               adaptiveHeight:true,
               pager:false,
               touchEnabled: true,
               oneToOneTouch: true,
               preventDefaultSwipeX: true,
               preventDefaultSwipeY: true
        });

  });

  $(".showHotels").click(function() {
      $('html, body').animate({
          scrollTop: $("#rooms").offset().top
      }, 900);

  });

</script>
@endsection