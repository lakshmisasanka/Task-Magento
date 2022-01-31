define(
    ['jquery', 'carousel'],
    function ($) {
        $.get('feedback/index/approvedfeedback', function (resp) {
            let htmlContent = "";
            if (resp.feedback_status) {
                resp.data.forEach(function (item) {
                    htmlContent += "<div class='item'>" +
                        "<div><b>First name :</b> " + item.first_name + "</div>" +
                        "<div><b>Last name :</b> " + item.last_name + "</div>" +
                        "<div><b>Email ID :</b> " + item.email + "</div>" +
                        "<div><b>Comments :</b> " + item.comment + "</div>" +
                        "</div>"
                });
                $('#myCarousel').html(htmlContent);

                'use strict';
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    margin: 10,
                    items: 1,
                    nav: true,
                });
            }

        });
    }
);
