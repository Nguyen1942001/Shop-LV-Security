

// ======================== Giới hạn phiên đăng nhập của tài khoản quản trị ========================

function check_session_id()
{
    fetch('?c=checklogin&a=checkSession').then(function(response){

        return response.json();

    }).then(function(responseData){

        if(responseData.output == 'logout')
        {
            window.location.href = '?c=auth&a=logout';
        }

    });
}

setInterval(function(){

    check_session_id();
    
}, 10000);


function deleteObject(self, url, id_name, e, confirm_message) {
    /* Act on the event */
    e.preventDefault();
    if(!confirm(confirm_message)) {
        return;
    }

    var object_id = $(self).attr("data"); // Ví dụ về danh mục sp: object_id là mã danh mục sp
    var data = {};
    data[id_name] = object_id;   // Ví dụ về danh mục sp: data["category_id"] = mã danh mục sp
    
    $.ajax({
        url: url,
        data: data,
        success: function (response) {
            rs = JSON.parse(response);
            var can_delete = rs.can_delete; 
            if (can_delete == 1) {
                var href = $(self).attr("href");
                window.location.href = href;
            }
            else {
                $(".alert-1").show();
                $(".alert-1").html(rs.message);
                $(".alert-1").addClass("alert-danger");
            }
        }
    });
}

// Xóa danh mục sp
$(".btn-delete-category").click(function (e) {
    var url = "index.php?c=category&a=checkDelete";
    var id_name = "category_id";
    var confirm_message = "Bạn muốn xóa danh mục này phải không?";
    deleteObject(this, url, id_name, e, confirm_message);
});


// Xóa khách hàng
$(".btn-delete-customer").click(function (e) {
    var url = "index.php?c=customer&a=checkDelete";
    var id_name = "customer_id";
    var confirm_message = "Bạn muốn xóa khách hàng này phải không?";
    deleteObject(this, url, id_name, e, confirm_message);
});


// Xóa vai trò
$(".btn-delete-role").click(function(e) {
    /* Act on the event */
    var url = "index.php?c=permission&a=checkDeleteRole";
    var id_name = "role_id";
    var confirm_message = "Bạn muốn xóa vai trò này phải không?";
    deleteObject(this, url , id_name, e, confirm_message);
     
});


// Update sản phẩm trên màn hình khi upload file ảnh mới
var loadFile = function(event) {
	var image = document.getElementById('image');
	image.src = URL.createObjectURL(event.target.files[0]);
};


// Update thông tin khi chọn khách hàng trong phần thêm đơn hàng mới
$(".chosen-customer").change(function (e) {
    $(".email").val("");
    $(".shipping_mobile").val("");
    $(".address").val("");

    var customer_id = $(this).val();

    // Khi chọn phần "Chọn khách hàng" thì không làm gì nữa
    if (!customer_id) {
        return;
    }    

    $.ajax({
        type: "GET",
        url: "index.php?c=order&a=getCustomerInfomation",
        data: {customer_id: customer_id},
        success: function (response) {
            response = JSON.parse(response);
            $(".email").val(response.email);
            $(".shipping_mobile").val(response.shipping_mobile);
            $(".address").val(response.address);
        }
    });
});




// ======================== Ajax search: ô tìm kiếm sản phẩm ở phần thêm vào đơn hàng ========================
var timeout = null;
$("div.search-product .search").keyup(function(event) {
    /* Act on the event */
    clearTimeout(timeout);
    var pattern = $(this).val();
    $(".search-result").html("");
    timeout = setTimeout(function(){
        if (pattern) {
            $.ajax({
                type: "GET",
                url: "index.php?c=order&a=ajaxSearchProduct",
                data: {pattern: pattern},
                success: function (response) {
                    displaySearchProduct(response);
                }
            });
        }
        else {
            $(".search-result").hide();
        }
        
    },300);
});

function displaySearchProduct(response) {
    // Định dạng tiền tệ
    const numberFormat = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
      });

    var totalProductArray = JSON.parse(response);
    var rows = "";
    var stt = 0;

    for (let i in totalProductArray) {
        stt++;
        var product = totalProductArray[i];
        var row = 
                '<div class="row">'+
                    '<div class="col-1">'+
                        '<span>'+ stt +'</span>'+
                    '</div>'+
                    '<div class="col-2">'+
                        '<span><img src="../upload/'+ product.featured_image +'" style="width: 80px" title="'+ product.name +'"></span>'+
                    '</div>'+
                    '<div class="col-6">'+
                        '<span>'+ product.name +'</span>'+
                    '</div>'+
                    '<div class="col-2">'+
                        '<span>'+ numberFormat.format(product.price) +'</span>'+
                    '</div>'+
                    '<div class="col-1">'+
                        '<a href="javascript:void(0)" onclick="updateProduct('+ product.product_id +')" class="btn btn-primary btn-sm save-product">Lưu</a>'+
                    '</div>'+
                '</div>';
        rows += row;
    }
    $(".search-result").html(rows);  // Thêm vào danh sách các sp được tìm thấy
    $(".search-result").show();
}



// ============= Thêm danh sách sp được chọn vào bảng (phần thêm mới đơn hàng - view/order/add.php) =============

function updateProduct(product_id) { 
    $.ajax({
        type: "GET",
        url: "index.php?c=order&a=updateProduct",
        data: {product_id: product_id},
        success: function (response) { 
            displayChosenProduct(response);
        }
    });
}

function displayChosenProduct(response) {
    const numberFormat = new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: 'VND',
      });

    var product = JSON.parse(response);
    var row = 
            '<tr class="product-'+ product.product_id +'">'+
                '<td><input type="number" class="chosen-product-id" name="product_id" value="'+ product.product_id +'" style="width: 50%;" disabled></td>'+
                '<td>'+ product.name +'</td>'+
                '<td>'+ numberFormat.format(product.price) +'</td>'+
                '<td><input type="number" name="qty" value="" min="1" max="" class="chosen-qty-'+ product.product_id +'" style="width: 70%;" required></td>'+
                '<td>'+
                    '<select class="form-control select2" name="size" style="width: 110%;" onchange="updateQtyOfSize(this, '+ product.product_id +')">'+
                        '<option value=""></option>'+
                        '<option value="S">S</option>'+
                        '<option value="M">M</option>'+
                        '<option value="L">L</option>'+
                        '<option value="XL">XL</option>'+
                    '</select>'+
                '</td>'+
                '<td class="quantity-in-stock-of-'+ product.product_id +'"></td>'+
                '<td><a href="javascript:void(0)" class="btn btn-danger btn-sm btn-delete" onclick="deleteChosenProduct('+ product.product_id +')">Xóa</a></td>'+
            '</tr>';
    
    $("table.list-product tbody").append(row);  // thêm vào bảng danh sách sp được chọn
}

// Update số lượng tồn khi chọn size của sp (phần thêm đơn hàng mới - view/order/add.php - chỗ danh sách sp)
function updateQtyOfSize(self, product_id) {
    var size = $(self).val();

    if (!size) {
        return;
    }

    $.ajax({
        type: "GET",
        url: "index.php?c=order&a=getQtyOfSize",
        data: {product_id: product_id, size: size},
        success: function (response) {
            response = response.replace(/\r?\n/g, "");
            // var classQtyInStock = ".quantity-in-stock-of-";
            // var selector1 = classQtyInStock + product_id;
            $(".quantity-in-stock-of-" + product_id).html(response); // cập nhật số lượng tồn

            // var classQty = ".chosen-qty-";
            // var selector2 = classQty + product_id;
            $(".chosen-qty-" + product_id).attr("max", response);  // cập nhật số lượng max
        }
    });
}

function deleteChosenProduct(product_id) {
    $("table.list-product tbody tr.product-" + product_id).hide();
    // $("table.list-product tbody tr.product-" + product_id).attr("disabled", "disabled");
}

// =========================  Validate register form  =========================

//Phần register
$(".form-add-customer").validate({
    rules: {
        fullname: {
            required: true,
            maxlength: 50,
            regex:
            /^[a-zA￾ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i,
        },
    
        phoneNumber: {
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

        address: {
            required: true
        }
    },

    
    messages: {
        fullname: {
            required: "Vui lòng nhập họ tên",
            maxlength: "Vui lòng nhập không quá 50 ký tự",
            regex: "Không được nhập số và ký tự đặc biệt",
        },
    
        phoneNumber: {
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
        
        address: {
            required: "Vui lòng nhập địa chỉ"
        }
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





