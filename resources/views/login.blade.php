@extends('layouts.main')
@push ('title')
<title></title>
@endpush 
@section('main-section')
<div class="inner2">
@if (session('success'))
    <div class="danger-alert">
        {{ session('success')}}
    </div>
@endif
    <form method="post" action="{{Route('login.post')}}">
    @csrf
        <table class="logintable">
            <tr>
                <th colspan="2" class="login" >Login</th>
            </tr>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username" /></td>
            </tr> 
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Login" class="button" name="save"/></td>
            </tr>
        </table>
    </form>
</div>
@endsection