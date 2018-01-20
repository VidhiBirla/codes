@extends('front.layouts.master')
@section('page-title')
    Hotels
@endsection
@section('content')
    @include('front._partials.header')

        @php
             use Jenssegers\Agent\Agent as Agent;
             $Agent = new Agent();

        @endphp


    <section id="hotel-section" class="margin30">
        <div id="app">
            <div class="ui container" >
                <h1 class="text-center">HOTELS</h1>
                <form class="ui form">
                     <h4 class="ui dividing header">Filters</h4>
                     <div class="two fields">
                          <div class="field">
                                <input type="text" v-model="search" name="" placeholder="Type Hotel Name">
                          </div>
                          <div class="field">
                                <input type="text" v-model="address_search" name="" placeholder="Type Location">
                          </div>
                          @if($Agent->isMobile())
                          <hr/>
                          @endif
                     </div>
                </form>
            </div>



            <div class="ui container">
                 <div class="ui link three stackable cards">
                      <div class=" card" v-for="item in namefilter">
                           <div class="image">
                                <image v-bind:src="image_path + '/' + item.merchant_primary_id + '/' + item.id + '-' + item.image" v-bind:alt="item.name"/>
                           </div>

                           <div  class="content" v-bind:data-info="item.name" >
                               <div class="header">
                                 @{{ item.name }}
                               </div>
                               <div class="meta">
                                 @{{ item.location_address }}
                               </div>
                           </div>

                           <div class="extra content">
                                <a class="ui blue button right floated" target="_blank" v-bind:href="link.replace('__hotel_id__/__hotel_name__',item.id+'/'+item.name)">Book Now</a>
                                <div class="outer_if_check1" v-if="marginPrice.hasOwnProperty(item.merchant_primary_id)">
                                      <div class="inner_if_check2" v-if="marginPrice[item.merchant_primary_id].hasOwnProperty(item.id)">
                                            <span> @{{ scubayaSynatx(marginexchangeRate[item.merchant_primary_id]['symbol'])}}    @{{ (marginPrice[item.merchant_primary_id][item.id]) * marginexchangeRate[item.merchant_primary_id]['rate'] }} Per Night </span>
                                      </div>
                                      <div class="inner_else_check2" v-else>
                                            <span> @{{ scubayaSynatx(marginexchangeRate[item.merchant_primary_id]['symbol'])}} 0 Per Night</span>
                                      </div>
                                </div>
                                <div class="outer_else_check1" v-else>
                                     <span> @{{ scubayaSynatx(marginexchangeRate[item.merchant_primary_id]['symbol'])}}  0 Per Night</span>
                                </div>
                           </div>
                      </div>
                 </div>
            </div>
        </div>
    </section>
@endsection
@section('script-extra')
    <script src="{{ asset('assets/front/js/vue.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
     var app = new Vue({
        el: '#app',
        data: function () {
            return {
                search: '',
                address_search:'',
                items: JSON.parse('{!! $hotelInfo!!}'),
                image_path:'{{asset('assets/images/scubaya/hotel/')}}',
                marginPrice:JSON.parse('{!! $minPrices !!}'),
                marginexchangeRate:JSON.parse('{!! $exchangeRate !!}'),
                link:'{{ route('scubaya::hotel::hotel_details',['__hotel_id__','__hotel_name__']) }}'
            }
        },
        methods: {
            scubayaSynatx: function (html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }
        },
        computed: {
            namefilter: function () {
                var self = this;
                return this.items.filter(function (hotelInfo) {
                       var a    =   hotelInfo.name.toLowerCase().indexOf(self.search.toLowerCase()) >= 0;
                       var b    =   hotelInfo.location_address.toLowerCase().indexOf(self.address_search.toLowerCase()) >= 0;
                       if(a==1 && b==1){
                            return true;
                       } else {
                            return false;
                       }
                });
            }
        }
     });
   </script>
@endsection