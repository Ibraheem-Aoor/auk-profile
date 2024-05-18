@extends('layouts.user.master')
@section('content')
    <!-- Hero Start -->
    <section class="cover-user">
        <div class="container-fluid px-0">
            <div class="row g-0 position-relative">
                <div class="col-lg-4 cover-my-30 order-2">
                    <div class="cover-user-img d-flex align-items-center">
                        <div class="row">
                            <div class="col-12">
                                <div class="card login-page border-0" style="z-index: 1">
                                    <div class="card-body p-0">
                                        <h4 class="card-title text-center">{{ __('auth.forgot_password') }}</h4>
                                        <form class="login-form mt-4 custom-form" action="{{ route('password.update' , ['token' => $token , 'email'  =>  $email]) }}"
                                            method="POST" method="POST">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card border-0" style="z-index: 1">
                                                        <div class="card-body p-0">
                                                            <h4 class="card-title text-center">
                                                                {{ __('auth.reset_password') }}</h4>
                                                            <form class="login-form mt-4">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <p class="text-muted">
                                                                            {{ __('auth.enter_new_password') }}</p>
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label">{{ __('auth.password') }}
                                                                                <span class="text-danger">*</span></label>
                                                                            <div class="form-icon position-relative">
                                                                                <i data-feather="lock"
                                                                                    class="fea icon-sm icons"></i>
                                                                                <input type="password"
                                                                                    class="form-control ps-5"
                                                                                    placeholder="{{ __('auth.enter_password') }}"
                                                                                    name="password" required="">
                                                                            </div>
                                                                        </div>
                                                                    </div><!--end col-->
                                                                    <div class="col-lg-12">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="form-label">{{ __('auth.confirm_password') }}
                                                                                <span class="text-danger">*</span></label>
                                                                            <div class="form-icon position-relative">
                                                                                <i data-feather="lock"
                                                                                    class="fea icon-sm icons"></i>
                                                                                <input type="password"
                                                                                    class="form-control ps-5"
                                                                                    placeholder="{{ __('auth.enter_confirm_password') }}"
                                                                                    name="password_confirmation" required="">
                                                                            </div>
                                                                        </div>
                                                                    </div><!--end col-->
                                                                    <div class="col-lg-12">
                                                                        <div class="d-grid">
                                                                            <button type="submit"
                                                                                class="btn btn-primary">{{ __('auth.submit') }}</button>
                                                                        </div>
                                                                    </div><!--end col-->
                                                                    <div class="mx-auto">
                                                                        <p class="mb-0 mt-3"><small
                                                                                class="text-dark me-2">{{ __('auth.remember_password') }}</small>
                                                                            <a href="{{ route('login') }}"
                                                                                class="text-dark fw-bold">{{ __('auth.sign_in') }}</a>
                                                                        </p>
                                                                    </div><!--end col-->
                                                                </div><!--end row-->
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->

                                        </form>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                    </div> <!-- end about detail -->
                </div> <!-- end col -->

                <div class="col-lg-8 offset-lg-4 padding-less img order-1 jarallax" data-jarallax data-speed="0.5"
                    style="background-image:url('{{ asset('assets/user/images/user/03.jpg') }}')"></div><!-- end col -->
            </div><!--end row-->
        </div><!--end container fluid-->
    </section><!--end section-->
    <!-- Hero End -->
@endsection
