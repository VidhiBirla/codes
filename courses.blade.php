@extends('front.layouts.master')
@section('page-title')
    Courses
@endsection
@section('content')
    @include('front._partials.header')
    <section class="margin30">
    <div id="app">
        <div class="ui container">
            <h1 class="text-center">Courses</h1>
            <form class="ui form">
            <h4 class="ui dividing header">Filters</h4>
                <div class="two fields">
                    <div class="field">
                        <input type="text" v-model="search" name="" placeholder="Course Name">
                    </div>
                    <div class="field">
                        <input type="text" v-model="address_search" name="" placeholder="Location">
                    </div>
                </div>
        </form>
        </div>
        {{--@{{ items }}--}}
        <div class="ui container">



            <div class="ui link four stackable cards">

                    <div v-for="item in namefilter"  class="card" >
                        <div class="image">
                            <img src="{{ asset('assets/front/images/curacao-beach.jpg') }}">
                        </div>
                        <div class="content" v-bind:data-info="item.course_name">
                            <div class="header">@{{ item.course_name }}</div>
                            <div class="meta">
                                <a>@{{ item.id }}</a>
                            </div>
                            <div class="description">
                                @{{ item.location_address }}
                            </div>
                        </div>
                        <div class="extra content">
                          <span class="right floated">
                            <a href="#" class="ui blue button">Book Now</a>
                          </span>
                          <span>
                            <i class="user icon"></i>
                           Ipsum
                          </span>
                        </div>
                    </div>

            </div>
        </div>

    </div>
    </section>

    <div class="ui small modal scu-course-detail">
        <div class="ui icon header">
            <div><img src="{{ asset('assets/front/images/curacao-beach.jpg') }}" style="width:100%;height:70px"></div>
            <h2 class="scu-modal-header"></h2>
        </div>
        <div class="content">
           <div class="ui two column grid">
               <div class="column">
                   <h4>Included</h4>
                   <ul>
                       <li>Feature 1</li>
                       <li>Feature 2</li>
                       <li>Feature 3</li>
                   </ul>
               </div>
               <div class="column">
                   <h4>Not Included</h4>
                   <ul>
                       <li>Feature 1</li>
                       <li>Feature 2</li>
                       <li>Feature 3</li>
                   </ul>
               </div>
           </div>
            <h4>Lorem ipsum dolor sit amet</h4>
            <p>Mauris in varius eros,
                quis posuere velit. Ut tincidunt velit nec sem gravida, vel faucibus massa condimentum. Cras
                venenatis ornare dui sed dictum. Praesent sollicitudin in leo sit amet finibus.</p>
            <h4>Consectetur adipiscing elit.</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse suscipit eget mi eu
                interdum. Sed interdum porttitor augue, quis efficitur ipsum convallis a. Integer
                sollicitudin viverra egestas. Praesent blandit justo sit amet .</p>


        </div>
        <div class="actions text-center">
            <a class="ui blue button">
                Book Now
            </a>
        </div>
    </div>

@endsection
@section('script-extra')
    <script src="{{ asset('assets/front/js/vue.js') }}" type="text/javascript"></script>
    <script>
        var app = new Vue({
            el: '#app',

            data: function () {
                return {
                    search: '',
                    address_search: '',
                    items: JSON.parse('{!! $courses !!}')
                }
            },
            computed: {
                namefilter: function () {
                    var self = this;
                    return this.items.filter(function (course) {
                        var a = course.location_address.toLowerCase().indexOf(self.address_search.toLowerCase()) >= 0;
                        var b = course.course_name.toLowerCase().indexOf(self.search.toLowerCase()) >= 0;
                        if(a==1 && b==1){
                            return true;
                        }else{
                          return false;
                        }

                    });

                }

            }

        });

        $(document).ready(function() {
            $(document.body).on('click', '.card',function(){
                var info = $(this).find(".content").data('info');
                $('.scu-course-detail').find('.scu-modal-header').html(info);
                $('.ui.modal.scu-course-detail')
                        .modal('setting', 'transition', 'horizontal flip')
                        .modal('show')
                        .modal('refresh');
            });
        });

    </script>
@endsection

