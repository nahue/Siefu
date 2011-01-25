function getPosition(trigger, el, conf) {

// get origin top/left position
var top = trigger.offset().top,
left = trigger.offset().left,
pos = conf.position.split(/,?\s+/),
y = pos[0],
x = pos[1];

top -= el.outerHeight() - conf.offset[0];
left += trigger.outerWidth() + conf.offset[1];


// iPad position fix
if (/iPad/i.test(navigator.userAgent)) {
top -= $(window).scrollTop();
}

// adjust Y
var height = el.outerHeight() + trigger.outerHeight();
if (y == 'center') { top += height / 2; }
if (y == 'bottom') { top += height; }

// adjust X
var width = trigger.outerWidth();
if (x == 'center') { left -= (width + el.outerWidth()) / 2; }
if (x == 'left') { left -= width; }

return {top: top, left: left};
} 

$.tools.validator.addEffect("efecto", function(errs, e) {

    var conf = this.getConf();

    // loop errors
    $.each(errs, function(i, err) {

        // add error class
        var input = err.input;
        
        input.addClass(conf.errorClass);

        // get handle to the error container
        var msg = input.data("msg.el");

        // create it if not present
        if (!msg) {
            msg = $(conf.message).addClass(conf.messageClass).appendTo(document.body);
            input.data("msg.el", msg);
        }

        // clear the container
        msg.css({
            visibility: 'hidden'
        }).find("p").remove();

        // populate messages
        $.each(err.messages, function(i, m) {
            $("<p/>").html(m).appendTo(msg);
        });

        // make sure the width is not full body width so it can be positioned correctly
        if (msg.outerWidth() == msg.parent().width()) {
            msg.add(msg.find("p")).css({
                display: 'inline'
            });
        }

        // insert into correct position (relative to the field)
        var pos = getPosition(input, msg, conf);

        msg.css({
            visibility: 'visible',
            position: 'absolute',
            top: pos.top,
            left: pos.left
        })
        .fadeIn(conf.speed);
        
        msg.attr("rel", input.attr("id"));
    });

    

// hide errors function
}, function(inputs) {

    var conf = this.getConf();
    inputs.removeClass(conf.errorClass).each(function() {
        var msg = $(this).data("msg.el");
        if (msg) {
            msg.css({
                visibility: 'hidden'
            });
        }
    });
}
);