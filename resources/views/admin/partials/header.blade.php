<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="header-left">
                    <div class="dashboard_bar">
                        {{ @$page_title ?? 'Dashboard' }}
                    </div>
                </div>

                @php
                    $count_notifications = count($notifications ?? []);
                @endphp

                <ul class="navbar-nav header-right">
                    @if (auth()->user()->isAdmin())
                        <li class="nav-item dropdown notification_dropdown">
                            <a class="nav-link  ai-icon" href="javascript:;" role="button" data-toggle="dropdown">
                                <svg width="26" height="26" viewBox="0 0 26 26" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21.75 14.8385V12.0463C21.7471 9.88552 20.9385 7.80353 19.4821 6.20735C18.0258 4.61116 16.0264 3.61555 13.875 3.41516V1.625C13.875 1.39294 13.7828 1.17038 13.6187 1.00628C13.4546 0.842187 13.2321 0.75 13 0.75C12.7679 0.75 12.5454 0.842187 12.3813 1.00628C12.2172 1.17038 12.125 1.39294 12.125 1.625V3.41534C9.97361 3.61572 7.97429 4.61131 6.51794 6.20746C5.06159 7.80361 4.25291 9.88555 4.25 12.0463V14.8383C3.26257 15.0412 2.37529 15.5784 1.73774 16.3593C1.10019 17.1401 0.751339 18.1169 0.75 19.125C0.750764 19.821 1.02757 20.4882 1.51969 20.9803C2.01181 21.4724 2.67904 21.7492 3.375 21.75H8.71346C8.91521 22.738 9.45205 23.6259 10.2331 24.2636C11.0142 24.9013 11.9916 25.2497 13 25.2497C14.0084 25.2497 14.9858 24.9013 15.7669 24.2636C16.548 23.6259 17.0848 22.738 17.2865 21.75H22.625C23.321 21.7492 23.9882 21.4724 24.4803 20.9803C24.9724 20.4882 25.2492 19.821 25.25 19.125C25.2486 18.117 24.8998 17.1402 24.2622 16.3594C23.6247 15.5786 22.7374 15.0414 21.75 14.8385ZM6 12.0463C6.00232 10.2113 6.73226 8.45223 8.02974 7.15474C9.32723 5.85726 11.0863 5.12732 12.9212 5.125H13.0788C14.9137 5.12732 16.6728 5.85726 17.9703 7.15474C19.2677 8.45223 19.9977 10.2113 20 12.0463V14.75H6V12.0463ZM13 23.5C12.4589 23.4983 11.9316 23.3292 11.4905 23.0159C11.0493 22.7026 10.716 22.2604 10.5363 21.75H15.4637C15.284 22.2604 14.9507 22.7026 14.5095 23.0159C14.0684 23.3292 13.5411 23.4983 13 23.5ZM22.625 20H3.375C3.14298 19.9999 2.9205 19.9076 2.75644 19.7436C2.59237 19.5795 2.50014 19.357 2.5 19.125C2.50076 18.429 2.77757 17.7618 3.26969 17.2697C3.76181 16.7776 4.42904 16.5008 5.125 16.5H20.875C21.571 16.5008 22.2382 16.7776 22.7303 17.2697C23.2224 17.7618 23.4992 18.429 23.5 19.125C23.4999 19.357 23.4076 19.5795 23.2436 19.7436C23.0795 19.9076 22.857 19.9999 22.625 20Z"
                                        fill="#36C95F" />
                                </svg>
                                @if ($count_notifications > 0)
                                    <span class="badge light text-white bg-primary">{{ $count_notifications }}</span>
                                @endif
                            </a>

                            @if ($count_notifications > 0)
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-end">
                                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3 height380">
                                        <ul class="timeline">
                                            @foreach ($notifications as $notification)
                                                <li>
                                                    <a
                                                        href="{{ route('admin.admin-notification.index', base64_encode($notification->id)) }}">
                                                        <div class="timeline-panel">
                                                            <div class="media mr-2 media-info">
                                                                N
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mb-1">{{ $notification->title }}</h6>
                                                                <small
                                                                    class="d-block">{{ $notification->created_at->diffForHumans() }}</small>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    {{-- <a class="all-notification" href="javascript:;">See all notifications <i
                                        class="ti-arrow-right"></i></a> --}}
                                </div>
                            @endif
                        </li>
                    @endif
                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="javascript:;" role="button" data-toggle="dropdown">
                            <img src="/admin/images/profile/12.png" width="20" alt="" />
                            <div class="header-info">
                                <span>Hello,<strong> {{ auth()->user()->name }}</strong></span>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-end">
                            <a href="javascript:void(0)" class="dropdown-item ai-icon" data-toggle="modal"
                                data-target="#change-password-modal">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                    width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ml-2">Change Password </span>
                            </a>
                            <a href="{{ route('admin.logout') }}" class="dropdown-item ai-icon">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                    width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ml-2">Logout </span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>

<!-- Start Change Password Modal -->
<div class="modal fade" id="change-password-modal" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>

            <form method="post" action="{{ route('admin.change-password') }}" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Current Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control password" id="current-password"
                                name="current_password" required placeholder="*********">
                            <div class="input-group-append" onclick="passwordShowHide()">
                                <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">New Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control password" id="new-password" name="password"
                                required placeholder="*********">
                            <div class="input-group-append" onclick="passwordShowHide()">
                                <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Match Password</label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control password" id="match-password"
                                name="password_confirmation" required placeholder="*********">
                            <div class="input-group-append" onclick="passwordShowHide()">
                                <span class="input-group-text"><i class="fa fa-eye-slash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End Change Password Modal -->

@push('js')
    <script>
        function passwordShowHide() {
            let password = $('.password');
            if (password.prop('type') == 'text') {
                password.prop("type", "password");
            } else {
                password.prop("type", "text");
            }
        }

        var allEditors = document.querySelectorAll('.note-ckeditor');
        for (var i = 0; i < allEditors.length; ++i) {
            ClassicEditor.create(
                allEditors[i]
            );
        }
    </script>
@endpush
