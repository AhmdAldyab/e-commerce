<!-- Modal effects -->
<div class="modal" id="modaldemo82">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">تسجيل الدخول</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="bg-gray-200 p-4">
                        <div class="form-group">
                            <input placeholder="ادخل الايميل الخاص بك" id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            &nbsp;&nbsp;&nbsp;
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">تسجيل</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">أغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modaldemo81">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">أنشاء حساب</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="bg-gray-200 p-4">
                        <div class="form-group">
                            <input placeholder="ادخل اسم المستخدم" id="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input placeholder="ادخل الايميل الخاص بك" id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <input placeholder="ادخل كلمة السر" id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                            <input placeholder="تاكيد كلمة السر" id="password-confirm" type="password"
                                class="form-control" name="password_confirmation" required
                                autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            &nbsp;&nbsp;&nbsp;
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn ripple btn-primary" type="submit">تسجيل</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">أغلاق</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- End Modal effects-->

<!-- Footer opened -->
<div class="main-footer ht-40">
    <div class="container-fluid pd-t-0-f ht-100p">
        <span>Copyright © 2020 <a href="#">Valex</a>. Designed by <a href="https://www.spruko.com/">Spruko</a> All
            rights reserved.</span>
    </div>
</div>
<!-- Footer closed -->
