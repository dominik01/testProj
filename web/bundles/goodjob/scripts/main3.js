"use strict";$(document).ready(function(){$("#heroSlider").slick({dots:!1,arrows:!1,infinite:!0,speed:300,slidesToShow:1,slidesToScroll:1}),$("#teacherSlider").slick({dots:!1,arrows:!0,infinite:!0,speed:300,slidesToShow:4,slidesToScroll:4,responsive:[{breakpoint:991,settings:{slidesToShow:2,slidesToScroll:2}},{breakpoint:768,settings:{slidesToShow:1,slidesToScroll:1}}]})}),$(document).ready(function(){$("#submit").click(function(e){console.log("submit clicked");var s=$("#name").val();if($("#name").next().text(""),s.length<5)return $("#name").next().text("Prosím, vyplňte svoje celé meno."),e.preventDefault(),0;var t=$("#email").val(),i=/^(([^<>()\[\]\.,;:\s@\']+(\.[^<>()\[\]\.,;:\s@\']+)*)|(\'.+\'))@(([^<>()[\]\.,;:\s@\']+\.)+[^<>()[\]\.,;:\s@\']{2,})$/i;if($("#email").next().text(""),!i.test(t))return $("#email").next().text("Prosím, zadajte spravnu emailovú adresu"),e.preventDefault(),0;var o=$("#phone").val(),n=$("#check-1").find("i").hasClass("checked");if($("#check-1").find(".error").text(""),!n)return $("#check-1").find(".error").text("Musíte súhlasiť s podmienkami."),e.preventDefault(),0;var r={name:s,email:t,phone:o,checkOne:n};r.checkOne=!1,$("#courseForm").hide(),$("#thankyou").show()}),$(".checkbox").click(function(){var e=$(this).find("i");e.hasClass("checked")?e.removeClass("checked"):e.addClass("checked")})});