@extends('admin.main_layout')

@section('function_nav')

<div class="col-sm-2">
    <button class="btn btn-add btn-sm" data-toggle="modal" data-target="#createCategoryModal" title="Thêm">
        <i class="fas fa-plus"></i>
        Tạo mới danh mục
    </button>
</div>
@endsection

<style>
    .category-image {
        max-height: 32px;
        /* Adjust the max-height as needed */
        object-fit: cover;
        /* Ensure the image covers the area without distortion */
    }
</style>

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show bg-danger" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<table class="table table-hover table-bordered js-copytextarea" id="sampleTable" cellpadding="0" cellspacing="0" border="0">
    <thead>
        <tr>
            <th>ID</th>
            <th width="150">Tên</th>
            <th width="20" class="text-center">Logo</th>
            <th width="100">Tính năng</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td class="col-1">{{ $category->id }}</td>
            <td class="col-5">{{ $category->name }}</td>
            <td class="col-3 text-center"><img src="../{{ $category->imgURL}}" alt="" class="category-image"></td>
            <td class="col table-td-center">
                <button class="btn btn-primary btn-sm edit" type="button" title="Sửa" data-toggle="modal" data-target="#editCategoryModal{{ $category->id }}">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="btn btn-primary btn-sm btn-danger" type="button" title="Xóa" data-toggle="modal" data-target="#deleteCategoryModal{{ $category->id }}">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('modal')
<!-- Create Category Modal -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">Tạo mới danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên danh mục</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Ảnh danh mục</label>
                        <div id="myfileupload">
                            <input type="file" id="uploadfile" name="imgURL" onchange="readURL(this);" />
                        </div>
                        <div id="thumbbox">
                            <img height="450" width="400" alt="Thumb image" id="thumbimage" style="display: none" />
                            <a class="removeimg" href="javascript:"></a>
                        </div>
                        <div id="boxchoice">
                            <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn ảnh</a>
                            <p style="clear:both"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach($categories as $category)
<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Sửa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name{{ $category->id }}">Tên danh mục</label>
                        <input type="text" class="form-control" id="name{{ $category->id }}" name="name" value="{{ $category->name }}" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="control-label">Ảnh danh mục</label>
                        <div id="myfileupload">
                            <input type="file" id="uploadfile" name="imgURL" onchange="readURL(this);" />
                        </div>
                        <div id="thumbbox">
                            <img height="450" width="400" alt="Thumb image" id="thumbimage" style="display: none" />
                            <a class="removeimg" href="javascript:"></a>
                        </div>
                        <div id="boxchoice">
                            <a href="javascript:" class="Choicefile"><i class="fas fa-cloud-upload-alt"></i> Chọn ảnh</a>
                            <p style="clear:both"></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Category Modal -->
<div class="modal fade" id="deleteCategoryModal{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCategoryModalLabel{{ $category->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel{{ $category->id }}">Xóa danh mục</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn xóa danh mục này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" style="display:inline;" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection