@extends('layouts.main')
@section('content')
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="{{ asset('assets/img/logo_citrawarna.png') }}" alt="">
                            </a>
                        </div><!-- End Logo -->

                        <div class="d-flex justify-content-center py-2">
                            <a class="logo align-items-center w-auto">
                                <span class="d-lg-block">Admin Citra Warna</span>
                            </a>
                        </div>

                        <div class="card mb-4">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">Silahkan Login Ke Akun Anda</h5>
                                </div>

                                <form class="row g-3 needs-validation" novalidate
                                    action="{{ route('user.process_login') }}" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username :</label>
                                        <div class="input-group has-validation">
                                            <input type="text" name="username" class="form-control" id="yourUsername"
                                                required>
                                            <div class="invalid-feedback">Silahkan Masukkan Username Anda!</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password :</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                            required>
                                        <div class="invalid-feedback">Silahkan Masukkan Password Anda!</div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">Login</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
