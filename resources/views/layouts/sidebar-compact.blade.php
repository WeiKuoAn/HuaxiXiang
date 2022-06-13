<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}"
                class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid"></i>
                <span>首頁</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if (Auth::user()->level != 2)
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>用戶管理</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('users-add') }}" class="{{ request()->is('is') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>新增用戶</span>
                        </a>
                    </li>
                    <li>
                    <li>
                        <a href="{{ route('users') }}" class="{{ request()->is('users') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>用戶資料</span>
                        </a>
                    </li>
                    {{-- <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>方案資料</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>金紙資料</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>後續處理A</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>後續處理B</span>
            </a>
          </li> --}}
                </ul>
            </li><!-- 資料設定 -->
        @endif

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#customer-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>客戶管理</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="customer-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('new-customer') }}"
                        class="{{ request()->is('new_customers') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>新增客戶</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer') }}" class="{{ request()->is('customer') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>客戶資料</span>
                    </a>
                </li>
            </ul>
        </li>
        @if (Auth::user()->level != 2 && Auth::user()->status == 0)
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#other-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>其他管理</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="other-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('plan') }}" class="{{ request()->is('plan') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>方案資料</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('gdpaper') }}" class="{{ request()->is('gdpaper') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>金紙資料</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('promA') }}" class="{{ request()->is('promA') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>後續處理A</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('promB') }}" class="{{ request()->is('promB') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>後續處理B</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>進貨設定</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('gdpaper-restock') }}"
                            class="{{ request()->is('gdpaper-restock') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>金紙進貨</span>
                        </a>
                    </li>
                </ul>
            </li><!-- 進貨設定 -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-income" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>收入管理</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-income" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('incomes_suject') }}"
                            class="{{ request()->is('incomes_suject') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>收入科目</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('incomes') }}" class="{{ request()->is('incomes') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>收入管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('new-income') }}"
                            class="{{ request()->is('new-income') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>收入Key單</span>
                        </a>
                    </li>
                </ul>
            </li><!-- 收入管理 -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-pay" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>支出管理</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-pay" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('pays_suject') }}"
                            class="{{ request()->is('pays_suject') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>支出科目</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pays') }}" class="{{ request()->is('pays') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>支出管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('new-pay') }}" class="{{ request()->is('new-pay') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>支出Key單</span>
                        </a>
                    </li>
                </ul>
            </li><!-- 收入管理 -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#sale-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>業務管理</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="sale-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('sale') }}" class="{{ request()->is('sale') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>業務Key單管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('new-sale') }}" class="{{ request()->is('new-sale') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>業務Key單</span>
                        </a>
                        <a href="{{ route('wait-sale') }}"
                            class="{{ request()->is('wait-sale') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>業務對帳確認</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->level != 2 && Auth::user()->status == 0)
            {{-- 管理員常用 --}}
            <li class="nav-heading">常用</li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('new-sale') }}"
                    class="{{ request()->is('new-sale') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>業務Key單</span>
                </a>
                <a class="nav-link collapsed" href="{{ route('new-income') }}"
                    class="{{ request()->is('new-income') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>收入Key單</span>
                </a>
                <a class="nav-link collapsed" href="{{ route('new-pay') }}"
                    class="{{ request()->is('new-pay') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>支出Key單</span>
                </a>
                <a class="nav-link collapsed" href="{{ route('customer') }}"
                    class="{{ request()->is('customer') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>客戶資料</span>
                </a>
                <a class="nav-link collapsed" href="{{ route('new-customer') }}"
                    class="{{ request()->is('new-customer') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>新增客戶</span>
                </a>


                <a class="nav-link collapsed" href="{{ route('wait-sale') }}"
                    class="{{ request()->is('wait-sale') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>業務確認對帳</span>
                </a>
            </li>
        @endif

        {{-- 使用者常用 --}}
        @if (Auth::user()->level == 2 && Auth::user()->status == 0)
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#sale-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>業務管理</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="sale-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('preson-sale') }}"
                            class="{{ request()->is('preson-sale') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>查看業務Key單</span>
                        </a>
                    </li>
                    <li>

                        <a href="{{ route('new-sale') }}"
                            class="{{ request()->is('new-sale') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>業務Key單</span>
                        </a>
                        <a href="{{ route('wait-sale') }}"
                            class="{{ request()->is('wait-sale') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>業務待確認對帳</span>
                        </a>
                    </li>
                </ul>
            </li>
            <a class="nav-link collapsed" href="{{ route('personwork') }}"
                class="{{ request()->is('personwork') ? 'active' : '' }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>出勤狀況</span>
            </a>

            <li class="nav-item">

            <li class="nav-heading">常用</li>
            <a class="nav-link collapsed" href="{{ route('customer') }}"
                class="{{ request()->is('customer') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>客戶資料</span>
            </a>
            <a class="nav-link collapsed" href="{{ route('new-customer') }}"
                class="{{ request()->is('new-customer') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>新增客戶</span>
            </a>
            <a class="nav-link collapsed" href="{{ route('new-sale') }}"
                class="{{ request()->is('new-sale') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>業務Key單</span>
            </a>
            <a class="nav-link collapsed" href="{{ route('user-wait-sale') }}"
                class="{{ request()->is('wait-sale') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>業務待確認對帳</span>
            </a>
            </li>
        @endif

        {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.html">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>F.A.Q</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-error-404.html">
          <i class="bi bi-dash-circle"></i>
          <span>Error 404</span>
        </a>
      </li><!-- End Error 404 Page Nav --> --}}

        <!-- End Blank Page Nav -->

    </ul>

</aside>
