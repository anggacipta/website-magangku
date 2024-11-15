@extends('dashboard.layouts.main')
@section('content')
    <!--  Header Start -->
    @include('dashboard.layouts.navbar')
    <!--  Header End -->
    <div class="container-fluid">
        <a class="btn btn-primary mb-3" href="{{ route('profile.perusahaan') }}"><i class="ti ti-arrow-left"></i>Back to Profile</a>
        <div class="card">
            <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3 active" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
                        <i class="ti ti-user-circle me-2 fs-6"></i>
                        <span class="d-none d-md-block">Account</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false" tabindex="-1">
                        <i class="ti ti-lock me-2 fs-6"></i>
                        <span class="d-none d-md-block">Security</span>
                    </button>
                </li>
            </ul>
            <div class="card-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Change Profile</h4>
                                        <p class="card-subtitle mb-4">Change your profile picture from here</p>
                                        <form action="{{ route('profile.perusahaan.update-photo') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="text-center">
                                                <img src="{{ asset('storage/images/perusahaan_profile/' . $perusahaan?->photo) }}" alt="Profile Picture" class="img-fluid rounded-circle" width="80" height="80">
                                                <div class="d-flex align-items-center justify-content-center my-4 gap-6">
                                                    <input type="file" name="photo" class="form-control">
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                    <button type="reset" class="btn bg-danger-subtle text-danger">Reset</button>
                                                </div>
                                                <p class="mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-stretch">
                                <div class="card w-100 border position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Change Password</h4>
                                        <p class="card-subtitle mb-4">To change your password please confirm here</p>
                                        <form action="{{ route('profile.perusahaan.update-password') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="current_password" class="form-label">Current Password</label>
                                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                                @error('current_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="new_password" class="form-label">New Password</label>
                                                <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                                                @error('new_password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                                <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation" required>
                                                @error('new_password_confirmation')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update Password</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card w-100 border position-relative overflow-hidden mb-0">
                                    <div class="card-body p-4">
                                        <h4 class="card-title">Personal Details</h4>
                                        <p class="card-subtitle mb-4">To change your personal detail , edit and save from here</p>
                                        <form action="{{ route('profile.perusahaan.update') }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext" class="form-label">Nama</label>
                                                        <input type="text" class="form-control" name="name" id="exampleInputtext" value="{{ auth()->user()->name }}">
                                                    </div>
{{--                                                    <div class="mb-3">--}}
{{--                                                        <label class="form-label">Location</label>--}}
{{--                                                        <select class="form-select" aria-label="Default select example">--}}
{{--                                                            <option selected="">United Kingdom</option>--}}
{{--                                                            <option value="1">United States</option>--}}
{{--                                                            <option value="2">United Kingdom</option>--}}
{{--                                                            <option value="3">India</option>--}}
{{--                                                            <option value="3">Russia</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext1" class="form-label">Email</label>
                                                        <input type="email" name="email" class="form-control" id="exampleInputtext1" value="{{ auth()->user()->email }}">
                                                    </div>
{{--                                                    <div class="mb-3">--}}
{{--                                                        <label class="form-label">Currency</label>--}}
{{--                                                        <select class="form-select" aria-label="Default select example">--}}
{{--                                                            <option selected="">India (INR)</option>--}}
{{--                                                            <option value="1">US Dollar ($)</option>--}}
{{--                                                            <option value="2">United Kingdom (Pound)</option>--}}
{{--                                                            <option value="3">India (INR)</option>--}}
{{--                                                            <option value="3">Russia (Ruble)</option>--}}
{{--                                                        </select>--}}
{{--                                                    </div>--}}
                                                </div>
                                                <div class="col-12">
                                                    <div>
                                                        <label for="exampleInputtext4" class="form-label">Deskripsi singkat</label>
                                                        <textarea class="form-control" name="deskripsi">{{ $perusahaan?->deskripsi }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-center justify-content-end mt-4 gap-6">
                                                        <button class="btn btn-primary">Save</button>
                                                        <button class="btn bg-danger-subtle text-danger">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card border shadow-none">
                                    <div class="card-body p-4">
                                        <h4 class="card-title mb-3">Two-factor Authentication</h4>
                                        <div class="d-flex align-items-center justify-content-between pb-7">
                                            <p class="card-subtitle mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Corporis sapiente
                                                sunt earum officiis laboriosam ut.</p>
                                            <button class="btn btn-primary">Enable</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">Authentication App</h5>
                                                <p class="mb-0">Google auth app</p>
                                            </div>
                                            <button class="btn bg-primary-subtle text-primary">Setup</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">Another e-mail</h5>
                                                <p class="mb-0">E-mail to send verification link</p>
                                            </div>
                                            <button class="btn bg-primary-subtle text-primary">Setup</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between py-3 border-top">
                                            <div>
                                                <h5 class="fs-4 fw-semibold mb-0">SMS Recovery</h5>
                                                <p class="mb-0">Your phone number or something</p>
                                            </div>
                                            <button class="btn bg-primary-subtle text-primary">Setup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <div class="text-bg-light rounded-1 p-6 d-inline-flex align-items-center justify-content-center mb-3">
                                            <i class="ti ti-device-laptop text-primary d-block fs-7" width="22" height="22"></i>
                                        </div>
                                        <h4 class="card-title mb-0">Devices</h4>
                                        <p class="mb-3">Lorem ipsum dolor sit amet consectetur adipisicing elit Rem.</p>
                                        <button class="btn btn-primary mb-4">Sign out from all devices</button>
                                        <div class="d-flex align-items-center justify-content-between py-3 border-bottom">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="ti ti-device-mobile text-dark d-block fs-7" width="26" height="26"></i>
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">iPhone 14</h5>
                                                    <p class="mb-0">London UK, Oct 23 at 1:15 AM</p>
                                                </div>
                                            </div>
                                            <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between py-3">
                                            <div class="d-flex align-items-center gap-3">
                                                <i class="ti ti-device-laptop text-dark d-block fs-7" width="26" height="26"></i>
                                                <div>
                                                    <h5 class="fs-4 fw-semibold mb-0">Macbook Air</h5>
                                                    <p class="mb-0">Gujarat India, Oct 24 at 3:15 AM</p>
                                                </div>
                                            </div>
                                            <a class="text-dark fs-6 d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)">
                                                <i class="ti ti-dots-vertical"></i>
                                            </a>
                                        </div>
                                        <button class="btn bg-primary-subtle text-primary w-100 py-1">Need Help ?</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-end gap-6">
                                    <button class="btn btn-primary">Save</button>
                                    <button class="btn bg-danger-subtle text-danger">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.layouts.footer')
    </div>

@endsection
