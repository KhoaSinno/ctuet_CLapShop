@extends('admin.main_layout') 
@section('head')
<link rel="stylesheet" type="text/css"
    href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="/e_adminSN/ckeditor/ckeditor.js"></script>

<style>
    .Choicefile {
        display: block;
        background: #14142B;
        border: 1px solid #fff;
        color: #fff;
        width: 150px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        padding: 5px 0px;
        border-radius: 5px;
        font-weight: 500;
        align-items: center;
        justify-content: center;
    }

    .Choicefile:hover {
        text-decoration: none;
        color: white;
    }

    #uploadfile,
    .removeimg {
        display: none;
    }

    #thumbbox {
        position: relative;
        width: 100%;
        margin-bottom: 20px; 
    }

    .removeimg {
        height: 25px;
        position: absolute;
        background-repeat: no-repeat;
        top: 5px;
        left: 5px;
        background-size: 25px;
        width: 25px;
        /* border: 3px solid red; */
        border-radius: 50%;

    }

    .removeimg::before {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        content: '';
        border: 1px solid red;
        background: red;
        text-align: center;
        display: block;
        margin-top: 11px;
        transform: rotate(45deg);
    }

    .removeimg::after {
        /* color: #FFF; */
        /* background-color: #DC403B; */
        content: '';
        background: red;
        border: 1px solid red;
        text-align: center;
        display: block;
        transform: rotate(-45deg);
        margin-top: -2px;
    }
</style>
@endsection

@section('function_nav')
<div class="col-sm-2">
    <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#exampleModalCenter"><i
            class="fas fa-folder-plus"></i> Thêm nhà cung cấp</a>
</div>
<div class="col-sm-2">
    <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#adddanhmuc"><i
            class="fas fa-folder-plus"></i> Thêm danh mục</a>
</div>
<div class="col-sm-2">
    <a class="btn btn-add btn-sm" data-toggle="modal" data-target="#addtinhtrang"><i
            class="fas fa-folder-plus"></i> Thêm tình trạng</a>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('content')

<form class="row" action="{{ route('admin.product.update',['id' => $product->id]) }}" method="POST" enctype = "multipart/form-data">
        @csrf
    <div class="form-group col-md-3">
        <label class="control-label">Tên sản phẩm</label>
        <input class="form-control" type="text" name="name" value="{{$product ->name}}">
    </div>

    <div class="form-group col-md-3">
        <label class="control-label">Số lượng</label>
        <input class="form-control" type="number" name="stock" value="{{$product ->stock}}">
    </div>


    <div class="form-group col-md-3">
        <label for="exampleSelect2" class="control-label">Danh mục</label>
        <select class="form-control" id="exampleSelect2" name="category">
            <option>-- Chọn danh mục --</option>
            @foreach ($categories as $category)
                @if($product->categoryID == $category->id)
                <option value="{{$category->id}}" selected>{{$category -> name}}</option>
                @else
                <option value="{{$category->id}}">{{$category -> name}}</option>
                @endif
            @endforeach
        </select>
    </div>

    <!-- <div class="form-group col-md-3">
        <label for="exampleSelect3" class="control-label">Nhà cung cấp</label>
        <select class="form-control" id="exampleSelect3">
            <option>-- Chọn nhà cung cấp --</option>
            <option>Phong vũ</option>
            <option>Thế giới di động</option>
            <option>FPT</option>
            <option>Sinoo</option>
        </select>
    </div> -->

    <div class="form-group col-md-3">
        <label class="control-label">Giá bán</label>
        <input class="form-control" type="number" name="price" value="{{$product ->price}}">
    </div>
    <!-- cpu -->
    <div class="form-group col-md-3">
        <label class="control-label">CPU</label>
        <input class="form-control" type="text" name="cpu" value="{{$product ->cpu}}">
    </div>
        <!-- ram -->
        <div class="form-group col-md-3">
        <label class="control-label">ram</label>
        <input class="form-control" type="text" name="ram" value="{{$product ->ram}}">
    </div>
        <!-- storage -->
        <div class="form-group col-md-3">
        <label class="control-label">storage</label>
        <input class="form-control" type="text" name="storage" value="{{$product ->storage}}">
    </div>
        <!-- screen -->
        <div class="form-group col-md-3">
        <label class="control-label">screen</label>
        <input class="form-control" type="text" name="screen" value="{{$product ->screen}}">
    </div>
            <!-- card -->
            <div class="form-group col-md-3">
        <label class="control-label">card</label>
        <input class="form-control" type="text" name="card" value="{{$product ->card}}">
    </div>
            <!-- connector -->
            <div class="form-group col-md-3">
        <label class="control-label">connector</label>
        <input class="form-control" type="text" name="connector" value="{{$product ->connector}}">
    </div>
            <!-- weight -->
            <div class="form-group col-md-3">
        <label class="control-label">weight</label>
        <input class="form-control" type="text" name="weight" value="{{$product ->weight}}">
    </div>
            <!-- keyboard -->
            <div class="form-group col-md-3">
        <label class="control-label">keyboard</label>
        <input class="form-control" type="text" name="keyboard" value="{{$product ->keyboard}}">
    </div>
            <!-- battery -->
            <div class="form-group col-md-3">
        <label class="control-label">battery</label>
        <input class="form-control" type="text" name="battery" value="{{$product ->battery}}">
    </div>
            <!-- os -->
            <div class="form-group col-md-3">
        <label class="control-label">os</label>
        <input class="form-control" type="text" name="os" value="{{$product ->os}}">
    </div>
            <!-- warranty -->
            <div class="form-group col-md-3">
        <label class="control-label">warranty</label>
        <input class="form-control" type="text" name="warranty" value="{{$product ->warranty}}">
    </div>
            <!-- color -->
            <div class="form-group col-md-3">
        <label class="control-label">color</label>
        <input class="form-control" type="text" name="color" value="{{$product ->color}}">
    </div>
            <!-- material -->
            <div class="form-group col-md-3">
        <label class="control-label">material</label>
        <input class="form-control" type="text" name="material" value="{{$product ->material}}">
    </div>

    <div class="custom-control custom-checkbox form-group col-md-3">
        <input type="checkbox" class="custom-control-input" id="customCheck1">
        <label class="custom-control-label" for="customCheck1">Active</label>
    </div>

    <div class="form-group col-md-12">
        <label class="control-label">Ảnh sản phẩm</label>
        <div id="thumbbox">
            <img height="450" width="400" alt="Thumb image" id="thumbimage" style="display: none" />
            <a class="removeimg" href="javascript:"></a>
        </div>
        <div id="myfileupload">
            @foreach($product_images as $image)
                <image src="{{$image->image_url}}" weight="400" height="400">
            @endforeach
        </div>
    </div>

    <div class="form-group col-md-12">
        <label class="control-label">Mô tả sản phẩm</label>
        <textarea class="form-control" name="description" id="mota" value="screen 1">{{$product->description}}</textarea>
        <script>
            CKEDITOR.replace('mota');
        </script>
    </div>

    <div class="form-group col-md-12">
        <button class="btn btn-save" type="submit" >Lưu lại</button>
        <a class="btn btn-cancel" href="{{route('admin.product')}}">Hủy bỏ</a>
    </div>
</form>

@endsection


@section('footer')
<script>
    function readURL(input, thumbimage) {
        if (input.files && input.files[0]) { //Sử dụng  cho Firefox - chrome
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#thumbimage").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else { // Sử dụng cho IE
            $("#thumbimage").attr('src', input.value);

        }
        $("#thumbimage").show();
        $('.filename').text($("#uploadfile").val());
        $('.Choicefile').css('background', '#14142B');
        $('.Choicefile').css('cursor', 'default');
        $(".removeimg").show();
        $(".Choicefile").unbind('click');

    }
    $(document).ready(function() {
        $(".Choicefile").bind('click', function() {
            $("#uploadfile").click();

        });
        $(".removeimg").click(function() {
            $("#thumbimage").attr('src', '').hide();
            $("#myfileupload").html('<input type="file" id="uploadfile"  onchange="readURL(this);" />');
            $(".removeimg").hide();
            $(".Choicefile").bind('click', function() {
                $("#uploadfile").click();
            });
            $('.Choicefile').css('background', '#14142B');
            $('.Choicefile').css('cursor', 'pointer');
            $(".filename").text("");
        });
    })
</script>

<!-- <script>
    const inpFile = document.getElementById("inpFile");
    const loadFile = document.getElementById("loadFile");
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview__image");
    const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");
    inpFile.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";
            reader.addEventListener("load", function() {
                previewImage.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        }
    });
</script> -->
@endsection