@extends('admin.main2')
@section('content')

<div class="login-main p-5 mt-5" style="display:flex; justify-content:center; flex-direction:column; align-items:center">
    <div class="inner-login bg-white mt-5 rounded " style="width:50%;">
        <div class="logo-admin d-flex justify-content-center align-items-center mt-3">
            <img src="https://cdn.sanity.io/images/kts928pd/production/b46a6970cc0f064f5ba5d6370077c7f2e18dbb0f-1200x630.png" class="rounded" alt="logo" width="280px">
        </div>
        <form action="{{ route('admin.login') }}" method="POST" class="admin-login-form d-flex  flex-column">
            @csrf
            <label for="name" class="label-class" style="font-weight: 600; font-size:1.2rem">Username</label>
            <input class="adminlogin-input" type="text" id="name" name="name" placeholder="Enter Username" required /><br />


            <label for="password" class="label-class" style="font-weight: 600; font-size:1.2rem">Password</label>
            <input class="adminlogin-input" type="password" id="password" name="password" placeholder="Enter Password" /><br />



            <button type="submit" class="btn btn-primary submit-btn submit-admin p-2" style="font-weight: 600; font-size:1.2rem">Login</button>
        </form>

        <div class="social-media-container d-flex flex-column justify-content-around align-items-center">
            <h4 class="with mt-3">Or Login With Social Media</h4>
            <div class="list-unstyled social-icons-admin-login d-flex justify-content-around">
                <li class="rounded"><i class="fa-brands fa-facebook"></i></li>
                <li class="rounded"><i class="fa-brands fa-x-twitter"></i></li>
                <li class="rounded"><i class="fa-brands fa-google"></i></li>
                <li class="rounded"><i class="fa-brands fa-linkedin"></i></li>
            </div>
        </div>
    </div>
</div>
@endsection