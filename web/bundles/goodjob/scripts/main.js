"use strict";$(document).ready(function(){$("#heroSlider").slick({dots:!1,arrows:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1}),$("#teacherSlider").slick({dots:!1,arrows:!0,infinite:!0,speed:300,slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:991,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:768,settings:{slidesToShow:1,slidesToScroll:1}}]})}),$(document).ready(function(){$("#contactUpSide").affix({offset:{top:$("#contactUpSide").offset().top-100}})})