@extends('front.layouts.master')
@section('page-title')
Dive-centers
@endsection
@section('content')
    @include('front._partials.header')

    @php
        use Jenssegers\Agent\Agent as Agent;
        $Agent = new Agent();
    @endphp

    <section class="dive-centers-details">
        <div class="ui fluid container">
            <div class="row">
                @if(!($Agent->isMobile()))
                <ul id="showImages" class="bxslider">
                        <li><img alt="Scubaya dive2" src="{{asset('assets/images/scubadive/1.jpg')}}" /></li>
                        <li><img alt="Scubaya dive2" src="{{asset('assets/images/scubadive/2.jpg')}}" /></li>
                        <li><img alt="Scubaya dive2" src="{{asset('assets/images/scubadive/3.jpg')}}" /></li>
                </ul>
                @endif
            </div>
        </div>


        <div class="ui fluid container" style="background-color: antiquewhite">
            <div class="ui container">
                <div class="row paddingTop20">
                    <div class="ui two column stackable grid">
                        <div class="column">
                            <h1>Dive2</h1>
                        </div>
                        <div class="column">
                            <div class="ui vertical animated right floated orange button" tabindex="0">
                                <div class="hidden content"><i class="hand pointer icon"></i> </div>
                                    <div class="visible content">
                                        <p>Book Now</p>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="ui container">
            {{--<div class="row margin30">--}}
                {{--<div class="ui two column stackable grid">--}}
                    {{--<div class="column">--}}
                        {{--<h1>Dive2</h1>--}}
                    {{--</div>--}}
                    {{--<div class="column">--}}
                        {{--<div class="ui vertical animated right floated orange button" tabindex="0">--}}
                          {{--<div class="hidden content"><i class="hand pointer icon"></i> </div>--}}
                          {{--<div class="visible content">--}}
                            {{--<p>Book Now</p>--}}
                          {{--</div>--}}
                        {{--</div>--}}
                        {{--<a class="ui right floated orange button" href="#">Book This Now</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class="ui hidden divider"></div>


            <div class="row">
                <div class="ui column">
                    <div class="column">
                        <h2 >Dive Center Description</h2>
                        <p class="dive-description">Description Blah Description Description
                                                    Description Description Description Description Description
                                                    Description Description Description Description
                                                     Description Description Description Description
                                                     Description Description Description Description
                                                     Description Description Description Description
                                                     Description Description Description Description
                                                     Description Description Description Description
                                                     Description Description Description Description</p>
                    </div>
                </div>
            </div>

            <div class="ui divider"></div>

             <div class="row">
                <div class="ui column grid">
                    <div class="center aligned column">
                        <h2><strong class="ui dividing  header">Pricing for Diving &amp; Courses</strong></h2>
                    </div>
                </div>
             </div><br/><br/>

            <div class="row">
                <div class="ui column grid">
                <h2>Dive Packages</h2>
                </div>
            </div><br/><br/>

            <div class="row">
                <div class=" ui link two stackable raised cards">
                    <div class="borderRadius blue card">
                        <div class="image">
                            <img src="{{asset('assets/images/scubadive/1.jpg')}}" class="borderRadius"/>
                        </div>

                        <div  class="content">
                            <div class="header">
                               Snorkeling
                            </div>
                        </div>

                        <div class="extra content">
                            <a class="ui orange button right floated">Book Now</a>
                            <p>$10000</p>
                        </div>
                    </div>
                    <div class="borderRadius blue card">
                        <div class="image">
                            <img src="{{asset('assets/images/scubadive/1.jpg')}}" class="borderRadius"/>
                        </div>

                        <div  class="content">
                            <div class="header">
                                Snorkeling
                            </div>
                        </div>

                        <div class="extra content">
                            <a class="ui orange button right floated">Book Now</a>
                            <p>$10000</p>
                        </div>
                    </div>
                    <div class="borderRadius blue card">
                        <div class="image">
                            <img src="{{asset('assets/images/scubadive/1.jpg')}}" class="borderRadius"/>
                        </div>

                        <div  class="content">
                            <div class="header">
                                Snorkeling
                            </div>
                        </div>

                        <div class="extra content">
                            <a class="ui orange button right floated">Book Now</a>
                            <p>$10000</p>
                        </div>
                    </div>
                </div>
            </div><br/><br/>

            <div class="row">
                <div class="ui column grid">
                <h2>Dive Courses</h2>
                </div>
            </div><br/><br/>

            <div class="row">
                <div class="ui link three stackable raised cards">
                    <div class="blue card" id="more">
                        <div class="image">
                            <img src="{{asset('assets/images/scubadive/1.jpg')}}" alt=""/>
                        </div>

                        <div  class="content">
                            <div class="header">
                                Open Water Dive
                            </div>
                        </div>

                        <div class="extra content">
                            <a class="ui orange button right floated">Book Now</a>
                            <p>$10000</p>
                        </div>
                    </div>

                    <div class="borderRadius blue card">
                        <div class="image">
                            <img src="{{asset('assets/images/scubadive/1.jpg')}}" class="borderRadius"/>
                        </div>

                        <div  class="content">
                            <div class="header">
                                Kite Surfing
                            </div>
                        </div>

                        <div class="extra content">
                            <a class="ui orange button right floated">Book Now</a>
                            <p>$20000</p>
                        </div>
                    </div>

                    <div class="borderRadius  blue card">
                        <div class="image">
                            <img src="{{asset('assets/images/scubadive/1.jpg')}}" class="borderRadius"/>
                        </div>
                        <div  class="content">
                           <div class="header">
                             Diving
                           </div>
                        </div>
                        <div class="extra content">
                            <a class="ui orange button right floated">Book Now</a>
                            <p>$20000</p>
                        </div>
                    </div>
                </div>
            </div><br/><br/>

            <div class="ui divider"></div>


            <div class="ui test modal">
                <h1 class="ui dividing header text-center">OPEN WATER DIVE</h1>
                <p class="ui blue segment">Open water is unrestricted water such as a sea, lake or flooded
                    quarries. It is the opposite of confined water (usually a swimming pool) where
                    diver training takes place. Open water also means the
                    diver has direct vertical access to the surface of the water
                    in contact with the Earth's atmosphere.<br/>
                    Open Water Diver course, you learn to use basic scuba gear,
                    including a mask, snorkel, fins, regulator, buoyancy control device
                    and a tank. The equipment you wear varies,
                    depending upon whether you’re diving in tropical, temperate or cold water.</p>
            </div>

            <div class="row">
                <div class="column">
                    <h2><strong>Diving Services</strong></h2>
                </div>
            </div><br/><br/>

            {{--<div class="row">--}}
                {{--<div class=" column">--}}
                    {{--<div class="ui blue segment">--}}
                        {{--<h2 class=" header">Equipment</h2>--}}
                        {{--<p style="margin-left: 20px;">Filling Station</p>--}}
                    {{--</div>--}}
                    {{--<div class="ui secondary blue  segment">--}}
                        {{--<h2 class=" header">Agencies</h2>--}}
                        {{--<p style="margin-left: 20px;">SSI</p>--}}
                    {{--</div>--}}
                    {{--<div class="ui blue segment">--}}
                        {{--<h2 class=" header">Equipment</h2>--}}
                        {{--<p style="margin-left: 20px;">Filling Station</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}



</div>
</section>
@endsection

@section('script-extra')
<script type="text/javascript">

$(document).ready(function(){
        $('.bxslider').bxSlider({
               auto: true,
               mode: 'fade',
               captions: true,
               slideWidth: 400,
               adaptiveHeight:true,
               pager:false
        });
        $("#more").click(function(){
            $('.test.modal').modal('show');
        });


});
</script>
@endsection