"use strict";function initMap(){map=new google.maps.Map(document.getElementById("map-canvas"),{zoom:7,center:new google.maps.LatLng(48.14271,17.109375),scrollwheel:!1}),window.ev=google.maps.event.addListener(map,"click",function(){map.setOptions({scrollwheel:!0})}),document.addEventListener("click",function(e){(e.pageX<mapPosition.x||e.pageX>mapPosition.x+mapSize.width||e.pageY<mapPosition.y||e.pageY>mapPosition.y+mapSize.height)&&map.setOptions({scrollwheel:!1})})}$(document).ready(function(){$("#heroSlider").slick({dots:!1,arrows:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1}),$("#teacherSlider").slick({dots:!1,arrows:!0,infinite:!0,speed:300,slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:991,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:768,settings:{slidesToShow:1,slidesToScroll:1}}]})});var mapPosition={},mapSize={};$(document).ready(function(){console.log($("#map-canvas")),$("#map-canvas").eq(0)&&(mapPosition.x=$("#map-canvas").offset().left,mapPosition.y=$("#map-canvas").offset().top,mapSize.width=$("#map-canvas").outerWidth(!0),mapSize.height=$("#map-canvas").outerHeight(!0)),$("#signUpSide").affix({offset:{top:$("#signUpSide").offset().top-100,bottom:$("section.signup").outerHeight(!0)+$("section.courses").outerHeight(!0)+$("section.contact").outerHeight(!0)+$("footer").outerHeight(!0)}})});var map;