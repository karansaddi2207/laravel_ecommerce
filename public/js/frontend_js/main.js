/*price range*/

if ($.fn.slider) {
    $('#sl2').slider();
}

var RGBChange = function () {
    $('#RGB').css('background', 'rgb(' + r.getValue() + ',' + g.getValue() + ',' + b.getValue() + ')')
};

/*scroll to top*/

$(document).ready(function () {
    $(function () {
        $.scrollUp({
            scrollName: 'scrollUp', // Element ID
            scrollDistance: 300, // Distance from top/bottom before showing element (px)
            scrollFrom: 'top', // 'top' or 'bottom'
            scrollSpeed: 300, // Speed back to top (ms)
            easingType: 'linear', // Scroll to top easing (see http://easings.net/)
            animation: 'fade', // Fade, slide, none
            animationSpeed: 200, // Animation in speed (ms)
            scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
            //scrollTarget: false, // Set a custom target element for scrolling to the top
            scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
            scrollTitle: false, // Set a custom <a> title if required.
            scrollImg: false, // Set true to use image
            activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
            zIndex: 2147483647 // Z-Index for the overlay
        });
    });
});

$(document).ready(function(){
    //script for changing price and stock with size
    $('#selSize').change(function(){
        var idSize = $(this).val();
        if(idSize=='')
        {
            return false;
        }
        $.ajax({
            type:'ajax',
            method:'GET',
            url:'/get_product_price',
            data:{idSize:idSize},
            success:function(resc){
                //alert(data);
                var arr = resc.split("#");
                $('#get_price').html("INR:"+arr[0]);
                $('#product_price').val(arr[0]);
                if(arr[1]==0)
                {
                    $('#cartButton').hide();
                    $('#Availability').text('Out of stock');
                }
                else
                {
                    $('#cartButton').show();
                    $('#Availability').text('In stock');
                }
            },
            error:function(){
                alert('error');
            }
        });
    });

    //script for changing image on click on product details page
    $('.changeImage').click(function(){
        var image = $(this).attr('src');
        //alert(image);
        $('.mainImage').attr('src',image);
    });

var $easyzoom = $('.easyzoom').easyZoom();

        // Setup thumbnails example
        var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

        $('.thumbnails').on('click', 'a', function(e) {
            var $this = $(this);

            e.preventDefault();

            // Use EasyZoom's `swap` method
            api1.swap($this.data('standard'), $this.attr('href'));
        });

        // Setup toggles example
        var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

        $('.toggle').on('click', function() {
            var $this = $(this);

            if ($this.data("active") === true) {
                $this.text("Switch on").data("active", false);
                api2.teardown();
            } else {
                $this.text("Switch off").data("active", true);
                api2._init();
            }
        });
        //for registering form
        $('#registerForm').validate({
            rules:{
                name:{
                    required:true,
                    minlength:2,
                    accept:"[a-zA-Z]+"
                },
                password:{
                    required:true,
                    minlength:5,
                    maxlength:100
                },
                email:{
                    required:true,
                    minlength:12,
                    maxlength:100,
                    email:true,
                    remote:"/check_email"
                }
            },
            messages:{
                name:{
                    required:"Please enter name",
                    minLength:"Your name must be atleast 6 character long",
                    accept:"Your name must contain letters only"
                },
                password : {
                    required:"Please enter password",
                    minLength:"Your password must be atleast 6 character long"
                },
                email:{
                    required:"Please enter your email",
                    email:"Please enter valid email",
                    remote:"Email already exists"
                }
            }
        });

        //for login form
        $('#loginForm').validate({
            rules:{
                email:{
                    required:true,
                    minlength:10,
                    maxlength:100,
                    email:true
                },
                password:{
                    required:true,
                    minLength:5,
                    maxlength:100
                }
            },
            messages:{
                email:{
                    required:"This field is required",
                    minlength:"Min length is 5 characters",
                    maxlength:"Max length is 100 characters",
                    email:"Please enter valid email"
                },
                password:{
                    required:"This field is required",
                    minlength:"Min length is 5 characters",
                    maxlength:"Max length is 100 characters"
                }
            }
        });

        //validation for account update form
        $('#accountForm').validate({
            rules:{
                name:{
                    required:true,
                    minlength:2,
                    accept:"[a-zA-Z]+"
                },
                address:{
                    required:true,
                    minlength:5,
                    maxlength:100
                },
                city:{
                    required:true,
                    minlength:12,
                    maxlength:100,
                },
                state:{
                    required:true
                },
                country:{
                    required:true
                },
                pincode:{
                    required:true
                },
                mobile:{
                    required:true
                }
            },
            messages:{
                name:{
                    required:"Please enter name",
                    minLength:"Your name must be atleast 6 character long",
                    accept:"Your name must contain letters only"
                },
                password : {
                    required:"Please enter password",
                    minLength:"Your password must be atleast 6 character long"
                },
                email:{
                    required:"Please enter your email",
                    email:"Please enter valid email",
                    remote:"Email already exists"
                },
                state:{
                    required:"This Field is required",
                },
                country:{
                    required:"This Field is required",
                },
                pincode:{
                    required:"This Field is required",
                },
                mobile:{
                    required:"This Field is required",
                }

            }
        });

        //for updating password
        $('#passwordForm').validate({
            rules:{
                new_pwd:{
                    required:true
                },
                confirm_pwd:{
                    required:true,
                    equalTo: '#new_pwd'
                }
            }

        });

        //for checking password correction in update password form
       /* $('#current_pwd').keyup(function(){
            var current_pwd = $(this).val();
            $.ajax({
                
                dataType : 'json',
                type: 'POST',
                url:'/check_user_pwd',
                data:{_token: '{{csrf_token()}}',current_pwd:current_pwd},
                contentType: false,
          processData: false,
                success:function(data){
                    alert(data);
                },
                error:function(){
                    alert('Error!');
                }
            });
        });*/
        

        //password strength script
        $('#myPassword').passtrength({
          minChars: 4,
          passwordToggle: true,
          tooltip: true,
          eyeImg : "/images/frontend_images/eye.svg"
        });

        //copy billing addresses to shipping addresses

        $('input#billtoship').click(function(){
            if(this.checked)
            {
                $('#shipping_name').val($('#billing_name').val());
                $('#shipping_address').val($('#billing_address').val());
                $('#shipping_city').val($('#billing_city').val());
                $('#shipping_state').val($('#billing_state').val());
                $('#shipping_country').val($('#billing_country').val());
                $('#shipping_pincode').val($('#billing_pincode').val());
                $('#shipping_mobile').val($('#billing_mobile').val());
            }
            else
            {
                $('#shipping_name').val();
                $('#shipping_address').val();
                $('#shipping_city').val();
                $('#shipping_state').val();
                $('#shipping_country').val();
                $('#shipping_pincode').val();
                $('#shipping_mobile').val();
            }
        });


});

function selectPaymentMehtod()
{
    //alert('dfsd');
    if($('#Paypal').is(':checked') || $('#COD').is(':checked'))
    {
        //alert('checked');
    }
    else
    {
        alert('Please select payment method');
        return false;
    }
    
 }

// Instantiate EasyZoom instances
        