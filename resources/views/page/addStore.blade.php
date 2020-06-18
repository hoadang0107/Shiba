@extends('home')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="register-form">
                <h2 style="padding-top: 10px;">Add Store</h2>
                <form method="POST" action="{{ route('addStore') }}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="group-input">
                        <label for="name_f">Store Name *</label>
                        <input type="text" name="name" id="name_f" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required/>
                    </div>
                    <div class="group-input">
                        <label for="address">Store Address *</label>
                        <input type="text" id="address" name="address"  required autofocus>
                    </div>
                    <div class="group-input">
                        <label for="phone">Phone </label>
                        <input type="text" id="phone" name="phone"  />
                    </div>
                    
                    <div class="group-input">
                        <label for="address">Menu *</label>
                        <input type="text" id="menu" name="menu"  required autofocus>
                    </div>
                    <div class="group-input">
                        <label for="address">Price</label>
                        <input type="text" id="price" name="price"  required autofocus>
                    </div>
                    <div class="group-input" >
                        <label for="mota">Description</label>
                    </div>
                    <div class="group-input" >
                        <textarea  id="Description" name="description" style="width: 100%; height: 200px"></textarea>
                    </div>
                    <div class="group-input">
                        <label for="store_img">Store Image</label>
                        <img id="img_store" src="../fashi/img/upload.png" style="cursor: pointer; width: 40px; height: 40px"/>
                    </div>
                    <div class="group-input" id="image_store" style="display: inline-block">
                    </div>
                    <div class="group-input">
                        <input id="store_img" name="store_img" type="file" style="display: none" />
                    </div>
                    <button type="submit" class="site-btn register-btn" style="margin-top: 20px; margin-bottom: 20px">ADD</button>
                </form>
            
            </div>
        </div>
    </div>
</div>

@endsection