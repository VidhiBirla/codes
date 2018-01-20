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

    <section id="dive-section" class="margin30">
        <div id="app">
            <div class="ui container" >
                <h1 class="text-center">Dive-Centers</h1>
                    <form class="ui form">
                        <h4 class="ui dividing header">Filters</h4>
                            <div class="two fields">
                                <div class="field">
                                    <input type="text" v-model="search" name="" placeholder="Type Dive-center Name">
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
                            <image v-bind:src="image_path + '/' + item.merchant_key + '/' + item.id + '-' + item.image" v-bind:alt="item.name"/>
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
                            <a class="ui blue button right floated" target="_blank" v-bind:href="link.replace('__diveCenter_id__/__diveCenter_name__',item.id+'/'+item.name)">Book Now</a>
                            <p>$10000</p>
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
                search              :   '',
                address_search      :   '',
                items               :   JSON.parse('{!! $diveCenters!!}'),
                image_path          :   '{{asset('assets/images/scubaya/dive_center/')}}',
                link                :   '{{ route('scubaya::register::dive_center_details',['__diveCenter_id__','__diveCenter_name__']) }}'


            }
        },

        computed: {
            namefilter: function () {
                var self = this;
                    return this.items.filter(function (diveCenters) {
                        var a    =  diveCenters.name.toLowerCase().indexOf(self.search.toLowerCase()) >= 0;
                        var b    =   diveCenters.location_address.toLowerCase().indexOf(self.address_search.toLowerCase()) >= 0;
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







