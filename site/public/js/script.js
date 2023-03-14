(function ($) {
  "use strict";

  // Preloader
  $(window).on("load", function () {
    $("#preloader").fadeOut("slow", function () {
      $(this).remove();
    });
  });

  // Instagram Feed
  if ($("#instafeed").length !== 0) {
    var accessToken = $("#instafeed").attr("data-accessToken");
    var userFeed = new Instafeed({
      get: "user",
      resolution: "low_resolution",
      accessToken: accessToken,
      template:
        '<a href="{{link}}"><img src="{{image}}" alt="instagram-image"></a>',
    });
    userFeed.run();
  }

  setTimeout(function () {
    $(".instagram-slider").slick({
      dots: false,
      speed: 300,
      // autoplay: true,
      arrows: false,
      slidesToShow: 6,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 4,
          },
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
          },
        },
      ],
    });
  }, 1500);

  // e-commerce touchspin
  $("input[name='product-quantity']").TouchSpin();

  // Video Lightbox
  $(document).on("click", '[data-toggle="lightbox"]', function (event) {
    event.preventDefault();
    $(this).ekkoLightbox();
  });

  // Count Down JS
  $("#simple-timer").syotimer({
    year: 2022,
    month: 5,
    day: 9,
    hour: 20,
    minute: 30,
  });

  //Hero Slider
  $(".hero-slider").slick({
    // autoplay: true,
    infinite: true,
    arrows: true,
    prevArrow:
      "<button type='button' class='heroSliderArrow prevArrow tf-ion-chevron-left'></button>",
    nextArrow:
      "<button type='button' class='heroSliderArrow nextArrow tf-ion-chevron-right'></button>",
    dots: true,
    autoplaySpeed: 7000,
    pauseOnFocus: false,
    pauseOnHover: false,
  });
  $(".hero-slider").slickAnimation();


})(jQuery);



// ================================== CÁ NHÂN ==================================

// Kiểm tra phiên đăng nhâp
function check_session_id()
{
    fetch('?c=checklogin&a=checkSession').then(function(response){

        return response.json();

    }).then(function(responseData){

        if(responseData.output == 'logout')
        {
            window.location.href = '?c=login&a=logout';
        }

    });
}

setInterval(function(){

    check_session_id();
    
}, 10000);


// Phần viết đánh giá sản phẩm trong trang chi tiết sp

// $(".form-comment").submit(function (e) { 
//     e.preventDefault();
//     var form_data = $(this).serialize();
//     $.ajax({
//       type: "POST",
//       url: "index.php?c=product&a=storeComment",
//       data: form_data,
//       success: function (response) {
//         $(".comment-list").html(response);
//         $(".review-success").html("Gửi đánh giá thành công");
//         $(".review-success").addClass("alert-success");
//         $(".form-comment input, .form-comment textarea").val("");
//       }
//     });
// });


// Submit form liên hệ
$("form.form-contact").submit(function(event) {
    /* Act on the event */
    event.preventDefault(); //prevent default action
    var post_url = $(this).attr("action"); //get form action url
    var request_method = $(this).attr("method"); //get form GET/POST method
    var form_data = $(this).serialize(); //Encode form elements for submission

    $(".message").html('Hệ thống đang gởi email... Vui lòng chờ <i class="fas fa-sync fa-spin"></i>');
    $(".message").removeClass("hidden");

    // Vô hiệu hóa nút gửi trong quá trình gửi mail cho owner 
    $("button[type=submit]").attr("disabled", "disabled");
    
    $.ajax({
      type: request_method,
      url: post_url,
      data: form_data,
      success: function (response) {
          $(".message").html(response);
          $("button[type=submit]").removeAttr("disabled");
      }
    });
});


// =============== Các loại sắp xếp ở trang sản phẩm ===============

// Sắp xếp theo danh mục
$('#category').change(function(event) {
  var category_id = $(this).val();
  window.location.href = "index.php?c=product&category_id=" + category_id;
});


// Sắp xếp sản phẩm theo giá
$('#sort-price').change(function(event) {
  var str_param = getUpdatedParam("price-range", $(this).val());
  window.location.href = "index.php?" + str_param;
});


// Sort sản phẩm
$('#sort-select').change(function(event) {
  var str_param = getUpdatedParam("sort", $(this).val());
  window.location.href = "index.php?" + str_param;
});


// Cập nhật giá trị của 1 param cụ thể
function getUpdatedParam(k, v) {//sort, price-asc
  var params={};
  //params = {"c":"proudct", "category_id":"5", "sort": "price-desc"}
  // window.location.search = "?c=product&price-range=200000-300000&sort=price-desc"
  window.location.search
    .replace(/[?&]+([^=&]+)=([^&]*)/gi, function(str,key,value) {
      params[key] = value;
      // alert(str);
      // alert(key);
      // alert(value);

    }
  );
    
  //{c:"proudct", category_id:"5", sort: "price-desc"}
  params[k] = v;
  if (v == "") {
      delete params[k];
  }

  var x = [];//là array
  for (p in params) {
      //x[0] = 'c=product'
      //x[1] = 'category_id=5'
      //x[2] = 'sort=price-asc'
      x.push(p + "=" + params[p]);
  }
  return str_param = x.join("&");//c=product&category_id=5&sort=price-asc
}



// ====================  Cart - Giỏ hàng ====================


// Thêm sản phẩm vào cart
$(".product-item .buy").click(function (e) { 
  var product_id = $(this).attr("product-id");
  var size = $(this).attr("size");

  $.ajax({
    type: "GET",
    url: "index.php?c=cart&a=add",
    data: {product_id: product_id, qty: 1, size: size},
    success: function (response) {
        response = response.replace(/\r?\n/g, "");
        displayCart(response);
    }
  });
});


// Thêm sản phẩm vào cart ở trang chi tiết sản phẩm (view/product/show.php)
$(".single-product-details .buy").click(function (e) { 
  size = null;
  if ($(".product-size select").val() != null) {
    size = $(".product-size select").val();
  }
  var qty = $("#product-quantity").val();
  var product_id = $(this).attr("product-id");
  $.ajax({
    type: "GET",
    url: "index.php?c=cart&a=add",
    data: {product_id: product_id, qty: qty, size: size},
    success: function (response) {
        response = response.replace(/\r?\n/g, "");
        displayCart(response);
    }
  });
});


// Xóa sp trong cart detail (view/payment/cart.php)
$(".shopping.cart .product-list .product-remove").click(function (e) { 
    var product_id = $(this).attr("product-id");
    var size = $(this).attr("size");
    $.ajax({
        type: "GET",
        url: "index.php?c=cart&a=delete",
        data: {product_id: product_id, size: size},
        success: function (response) {
            displayCartDetail(response);
            displayCart(response);
        }
  });
});


// Cập nhật số lượng sản phẩm trong cart detail
function updateProductInCart(self, product_id, size) {
  var qty = $(self).val();

  $.ajax({
      type: "GET",
      url: "index.php?c=cart&a=update",
      data: {product_id: product_id, qty: qty, size: size},
      success: function (response) {
        displayCart(response);
        displayCartDetail(response);
      }
  });
}


// Xóa sản phẩm trong cart
function deleteProductInCart(product_id, size) {
  $.ajax({
    type: "GET",
    url: "index.php?c=cart&a=delete",
    data: {product_id: product_id, size: size},
    success: function (response) {
      displayCartDetail(response);
      displayCart(response);
    }
  });
}


//Hiển thị cart khi load xong trang web
$.ajax({
  type: "GET",
  url: "index.php?c=cart&a=display",
  success: function (response) {
      displayCart(response);
  }
});


// Hiển thị sản phẩm trong cart detail
function displayCartDetail(data) {
  
    // Định dạng tiền tệ
    const numberFormat = new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND',
    });

    var cart = JSON.parse(data);
    var items = cart.items;
    var rows = "";

    for (let i in items) {
      var item = items[i];
      var row = 
              '<tr class="">'+
                  '<td><img width="80" src="../upload/'+ item.img +'" title="'+ item.name +'"/></td>'+
                  '<td class="">'+
                    '<div class="product-info">'+
                      '<a href="index.php?c=product&a=show&id='+ item.product_id +'">'+ item.name +'</a>'+
                    '</div>'+
                  '</td>'+
                  '<td>'+ item.size +'</td>'+
                  '<td class="">'+ numberFormat.format(item.unit_price) +'</td>'+
                  '<td><input type="number" value="'+ item.qty +'" onchange="updateProductInCart(this, '+ item.product_id +', `'+ item.size +'`)"></td>'+
                  '<td class="">'+
                  '<a class="product-remove" href="javascript:void(0)" onclick="deleteProductInCart('+ item.product_id +', `'+ item.size +'`)">Xóa</a>'+
                  '</td>'+
              '</tr>';
      rows += row;
    }
    $(".product-list .table tbody").html(rows);
}


// Hiển thị sản phẩm trong cart
function displayCart(data) {

    // Định dạng tiền tệ
    const numberFormat = new Intl.NumberFormat('vi-VN', {
      style: 'currency',
      currency: 'VND',
    });

    //chuyển chuỗi json dạng object (trên trình duyệt) thành object
    var cart = JSON.parse(data);

    var total_price = numberFormat.format(cart.total_price);

    var items = cart.items;
    var rows = "";
    for (let i in items) {
        var item = items[i];
        var row = 
                '<div class="media">'+ 
                    '<a class="pull-left" href="index.php?c=product&a=show&id='+ item.product_id +'">'+ 
                        '<img class="media-object" src="../upload/' + item.img + '" alt="' + item.name + ' "/>'+
                    '</a>'+
                    '<div class="media-body">'+ 
                        '<h4 class="media-heading"><a href="index.php?c=product&a=show&id='+ item.product_id +'"></a></h4>'+
                        '<div class="cart-price">'+ 
                            '<span>'+ item.qty +' x </span>'+
                            '<span>' + numberFormat.format(item.unit_price) + '</span>'+
                        '</div>'+
                        '<div class="cart-price">'+ 
                            '<span>Size: '+ item.size +'</span>'+
                        '</div>'+
                        '<h5><strong>' + numberFormat.format(item.total_price) + '</strong></h5>'+
                    '</div>' + 
                    '<a href="javascript:void(0)" onclick="deleteProductInCart('+ item.product_id +', `'+ item.size +'`)" class="remove"><i class="tf-ion-close"></i></a>'+
                '</div>';
        rows += row; 
    }

    var row1 = 
            '<div class="cart-summary">'+
                '<span>Tổng</span>'+ 
                '<span class="total-price">' + total_price + '</span>'+
            '</div>'+
            '<ul class="text-center cart-buttons">'+
                  '<li><a href="index.php?c=payment&a=cartDetail" class="btn btn-small">Xem Giỏ Hàng</a></li>'+
                  '<li><a href="index.php?c=payment&a=checkout" class="btn btn-small btn-solid-border">Thanh Toán</a></li>'+
            '</ul>';

    rows += row1;

    $(".cart-nav .cart-dropdown").html(rows);
}




// =========================  Validate register form  =========================
    


    //Phần quên mật khẩu
    $(".form-forget-password").validate({
      rules: {
          password: {
              required: true,
              regex: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/,
          },
      
          password_confirmation: {
              required: true,
              equalTo: "[name=password]",
          }
      },
  
      messages: {
          password: {
              required: "Vui lòng nhập mật khẩu",
              regex:
              "Mật khẩu phải bao gồm số, ký tự đặc biệt, chữ hoa, chữ thường, hơn 8 ký tự",
          },
      
          password_confirmation: {
              required: "Vui lòng xác nhận mật khẩu",
              equalTo: "Vui lòng xác nhận đúng mật khẩu",
          }
      },
  });

  
    //Phần register
    $(".form-register").validate({
      rules: {
          name: {
              required: true,
              maxlength: 50,
              regex:
              /^[a-zA￾ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
          },
      
          mobile: {
              required: true,
              regex: /^0([0-9]{9,9})$/,
          },
      
          email: {
              required: true,
              maxlength: 50,
              email: true,
              remote: "/site/index.php?c=register&a=notExistingEmail"
          },
      
          password: {
              required: true,
              regex: /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/,
          },
      
          password_confirmation: {
              required: true,
              equalTo: "[name=password]",
          }
      },
  
      
      messages: {
          name: {
              required: "Vui lòng nhập họ tên",
              maxlength: "Vui lòng nhập không quá 50 ký tự",
              regex: "Không được nhập số và ký tự đặc biệt",
          },
      
          mobile: {
              required: "Vui lòng nhập số điện thoại",
              regex: "Vui lòng nhập đủ 10 số và bắt đầu bằng số 0",
          },
      
          email: {
              required: "Vui lòng nhập email",
              maxlength: "Vui lòng nhập không quá 50 ký tự",
              email: "Vui lòng nhập đúng định dạng email",
              remote: "Email đã tồn tại"
          },
      
          password: {
              required: "Vui lòng nhập mật khẩu",
              regex:
              "Mật khẩu phải bao gồm số, ký tự đặc biệt, chữ hoa, chữ thường, hơn 8 ký tự",
          },
      
          password_confirmation: {
              required: "Vui lòng xác nhận mật khẩu",
              equalTo: "Vui lòng xác nhận đúng mật khẩu",
          }
      },
  });


  //Phần liên hệ gửi mail
  $(".form-contact").validate({
    rules: {
        name: {
            required: true,
            maxlength: 50,
            regex:
            /^[a-zA￾ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
        },
    
        mobile: {
            required: true,
            regex: /^0([0-9]{9,9})$/,
        },
    
        email: {
            required: true,
            maxlength: 50,
            email: true
        },
    
        message: {
            required: true
        },
    },

    
    messages: {
        name: {
            required: "Vui lòng nhập họ tên",
            maxlength: "Vui lòng nhập không quá 50 ký tự",
            regex: "Không được nhập số và ký tự đặc biệt",
        },
    
        mobile: {
            required: "Vui lòng nhập số điện thoại",
            regex: "Vui lòng nhập đủ 10 số và bắt đầu bằng số 0",
        },
    
        email: {
            required: "Vui lòng nhập email",
            maxlength: "Vui lòng nhập không quá 50 ký tự",
            email: "Vui lòng nhập đúng định dạng email"
        },
    
        message: {
            required: "Vui lòng nhập nội dung",
        },
    },
});


//Phần đánh giá sản phẩm
$(".form-comment").validate({
  rules: {
      fullname: {
          required: true,
          maxlength: 50,
          regex:
          /^[a-zA￾ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
      },
  
      email: {
          required: true,
          maxlength: 50,
          email: true
      },
  
      description: {
          required: true
      },
  },

  
  messages: {
    fullname: {
          required: "Vui lòng nhập họ tên",
          maxlength: "Vui lòng nhập không quá 50 ký tự",
          regex: "Không được nhập số và ký tự đặc biệt",
      },
  
      email: {
          required: "Vui lòng nhập email",
          maxlength: "Vui lòng nhập không quá 50 ký tự",
          email: "Vui lòng nhập đúng định dạng email"
      },
  
      description: {
          required: "Vui lòng nhập nội dung",
      },
  },
});


  $.validator.addMethod(
      "regex",
      function (value, element, regexp) {
      if (regexp.constructor != RegExp) regexp = new RegExp(regexp);
      else if (regexp.global) regexp.lastIndex = 0;
      return this.optional(element) || regexp.test(value);
      },
      "Please check your input. It is not matched regex"
  );














