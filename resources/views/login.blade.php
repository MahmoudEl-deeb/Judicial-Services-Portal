<x-layout>
    <x-slot:title>
        Login
    </x-slot:title>
<form method="POST" action="{{ route('loginProcess') }}">
  @csrf
  <div class="form-group">
    <label for="exampleInputEmail1">البريد الإلكتروني</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="أدخل البريد الإلكتروني">
    @error('email')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">كلمة المرور</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="أدخل كلمة المرور">
    @error('password')
        <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">تذكرني</label>
  </div>
  <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
</form>
</x-layout>
