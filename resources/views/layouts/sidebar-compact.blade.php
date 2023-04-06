<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if (Auth::user()->level != 2 && Auth::user()->status == 0)
            {{-- 管理員常用 --}}
            <li class="nav-item">
                <a class="nav-link " href="{{ route('dashboard_index') }}"
                    class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i>
                    <span>當月總表</span>
                </a>
            </li><!-- End Dashboard Nav -->
            <li class="nav-heading">常用</li>
            <li class="nav-item">
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
                <a class="nav-link collapsed" href="{{ route('new-cash') }}"
                    class="{{ request()->is('new-cash') ? 'active' : '' }}">
                    <i class="bi bi-journal-text"></i>
                    <span>零用金Key單</span>
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
                        <a href="{{ route('user-wait-sale') }}"
                            class="{{ request()->is('user-wait-sale') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>業務待確認對帳</span>
                        </a>
                    </li>
                    
                    
                </ul>
            </li>
            
            {{-- <a class="nav-link collapsed" href="{{ route('personwork') }}"
                class="{{ request()->is('personwork') ? 'active' : '' }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>出勤狀況</span>
            </a> --}}

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
            <a class="nav-link collapsed" href="{{ route('new-debit') }}"
                class="{{ request()->is('new-debit') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>借出補錢單</span>
            </a>
            <a class="nav-link collapsed" href="{{ route('person.inventory') }}"
                class="{{ request()->is('person.inventory') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>商品盤點調整</span>
            </a>
            </li>
        @endif
        
        @if (Auth::user()->level != 2)
         @if(Auth::user()->level == 0 || Auth::user()->job_id == 2)
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
                        <a href="{{ route('users-check') }}" class="{{ request()->is('users-check') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>用戶修改確認</span>
                        </a>
                    </li> --}}
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
                @if(Auth::user()->level != 2)
                <li>
                    <a href="{{ route('customer.group') }}" class="{{ request()->is('customer.group') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>客戶群組</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('customer') }}" class="{{ request()->is('customer') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>客戶資料</span>
                    </a>
                </li>
            </ul>
        </li>
        
        @if (Auth::user()->level != 2 && Auth::user()->status == 0)
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>商品管理</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('gdpaper') }}" class="{{ request()->is('gdpaper') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>金紙資料</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('gdpaper-restock') }}"
                        class="{{ request()->is('gdpaper-restock') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>金紙進貨</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('inventory') }}"
                        class="{{ request()->is('inventory') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>商品盤點</span>
                    </a>
                </li>
            </ul>
        </li><!-- 進貨設定 -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#other-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>其他管理</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="other-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('jobs') }}" class="{{ request()->is('jobs') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>職稱資料</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('source') }}" class="{{ request()->is('source') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>來源資料</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('plan') }}" class="{{ request()->is('plan') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>方案資料</span>
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
                    <li>
                        <a href="{{ route('vender') }}" class="{{ request()->is('vender') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>廠商資料</span>
                        </a>
                    </li>
                </ul>
            </li>

            

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
                    <li>
                        <a href="{{ route('debit') }}" class="{{ request()->is('debit') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>借出補錢管理</span>
                        </a>
                    </li>

                </ul>
            </li><!-- 收入管理 -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#cash-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>零用金管理</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="cash-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('cashs') }}" class="{{ request()->is('cashs') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>零用金管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('new-cash') }}" class="{{ request()->is('new-cash') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>零用金Key單</span>
                        </a>
                    </li>
                </ul>
            </li>

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
                    </li>
                    <li>
                        <a href="{{ route('wait-sale') }}"
                            class="{{ request()->is('wait-sale') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i>
                            <span>業務對帳確認</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- @if(Auth::user()->level == 0) --}}
            @if(Auth::user()->level == 0 || Auth::user()->level == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-rpg" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>報表管理</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-rpg" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('rpg01') }}"
                            class="{{ request()->is('rpg01') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>方案報表</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rpg02') }}"
                            class="{{ request()->is('rpg02') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>支出報表</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rpg03') }}"
                            class="{{ request()->is('rpg03') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>零用金報表</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rpg04') }}"
                            class="{{ request()->is('rpg04') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>金紙報表</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rpg05') }}"
                            class="{{ request()->is('rpg05') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>營收總表</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rpg06') }}"
                            class="{{ request()->is('rpg06') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>法會查詢</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rpg07') }}"
                            class="{{ request()->is('rpg07') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>團火查詢</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rpg08') }}"
                            class="{{ request()->is('rpg08') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>業務派單統計</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rpg09') }}"
                            class="{{ request()->is('rpg09') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>年度營收表</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('rpg10') }}"
                            class="{{ request()->is('rpg10') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>專員金紙抽成</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('pays') }}" class="{{ request()->is('pays') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>支出管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('new-pay') }}" class="{{ request()->is('new-pay') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>支出Key單</span>
                        </a>
                    </li> --}}
                </ul>
            </li><!-- 收入管理 -->
            @endif
            
        @endif
        @if(Auth::user()->level == 2 || Auth::user()->id == 11)
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-rpg" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>報表管理</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-rpg" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('rpg07') }}"
                            class="{{ request()->is('rpg07') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>團火查詢</span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('pays') }}" class="{{ request()->is('pays') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>支出管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('new-pay') }}" class="{{ request()->is('new-pay') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>支出Key單</span>
                        </a>
                    </li> --}}
                </ul>
            </li><!-- 收入管理 -->
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
